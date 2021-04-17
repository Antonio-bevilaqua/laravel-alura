<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use App\Models\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(Temporada $temporada)
    {
        return view('episodios.index', compact('temporada'));
    }

    public function update(Episodio $episodio, Request $request)
    {
        $episodio->assistido = $request->assistido;
        $episodio->save();

        return json_encode(['type' => 'success', 'message' => 'Episódios atualizados com sucesso!']);
    }

    public function checaAssistidos(Temporada $temporada, Request $request)
    {
        $episodiosAssistidos = $request->episodios;
        $temporada->episodios->map(function ($episodio) use ($episodiosAssistidos) {
            $episodio->assistido = in_array($episodio->id, $episodiosAssistidos) ? true : false;
        });
        $temporada->push();

        $request->session()->flash('msg-sucesso', "Episodios atualizados com sucesso!");
        return redirect()->back();
    }
}