<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Serie;
use App\Services\CriadorDeSeries;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    private array $dadosUser;
    protected function setUp() : void
    {
        parent::setUp();
        $dadosUser = [
            'name' => "teste",
            "email" => "teste@teste.com",
            "password" => "123456"
        ];
        $this->dadosUser = $dadosUser;

        $this->refreshDatabase();
    }

    public function test_login_user()
    {
        $dadosEnvio = $this->dadosUser;
        $dadosEnvio['password'] = Hash::make($dadosEnvio['password']);

        $user = User::create($dadosEnvio);

        $response = $this->post('/login', [
            'email' => $this->dadosUser['email'],
            'password' => $this->dadosUser['password'],
        ]);

        $response->assertRedirect('/series');
        $this->assertAuthenticatedAs($user);
    }
}
