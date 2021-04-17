<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\CriadorDeSeries;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    private function throttleKey($uniqueInput, $ip): string
    {
        #pode mudar o email por qualquer coisa aqui
        return Str::lower($uniqueInput).'|'.$ip;
    }

    public function index()
    {
        return view('autenticacao.index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
            
        if (!Auth::guard('usuario')->attempt(['email' => $request->email, 'password' => $request->password])){
            #limita o numero de vezes que um usuário pode ter seus dados digitados incorretamente
            RateLimiter::hit($this->throttleKey($request->email, $request->ip));

            return redirect()->back()->withErrors('Email ou senha incorretos!');
        }

        $request->session()->regenerate();

        RateLimiter::clear($this->throttleKey($request->email, $request->ip));

        return redirect()->route('series');
    }


    public function register()
    {
        return view('autenticacao.cadastro');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);
        
        $dataSend = $request->except('_token');
        $dataSend['password'] = Hash::make($dataSend['password']);
        $user = User::create($dataSend);

        Auth::guard('usuario')->login($user);
        
        return redirect()->route('series');
        
    }

    public function logout()
    {
        Auth::guard('usuario')->logout();

        return redirect()->route('autenticacao.login');
    }

    

    public function cadastro()
    {
        return view('autenticacao.cadastro');
    }
}