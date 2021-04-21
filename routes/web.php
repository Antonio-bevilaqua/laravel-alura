<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\EpisodiosController;
use App\Http\Controllers\TemporadasController;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/series', [SeriesController::class, 'index'])
->name('series');
Route::get('/series/nova-serie', [SeriesController::class, 'create'])
->name('series.create')
->middleware('autenticacao');

Route::post('/series/{id}/atualiza', [SeriesController::class, 'update'])
->name('series.update')
->middleware('autenticacao');

Route::post('/series/insert', [SeriesController::class, 'insert'])
->name('series.insert')
->middleware('autenticacao');

Route::delete('/series/{id}/remover', [SeriesController::class, 'destroy'])
->name('series.remove')
->middleware('autenticacao');


Route::get('/temporadas/{id_serie}', [TemporadasController::class, 'index'])
->name('temporadas');

Route::get('/temporadas/{temporada}/index', [EpisodiosController::class, 'index'])
->name('temporadas.episodios');

Route::post('/temporadas/{temporada}/checaAssistidos', [EpisodiosController::class, 'checaAssistidos'])
->name('episodios.checaAssistidos')
->middleware('autenticacao');

Route::get('/login', [LoginController::class, 'index'])
->name('autenticacao.login');

Route::post('/login', [LoginController::class, 'login'])
->name('autenticacao.login.efetuar');

Route::post('/logout', [LoginController::class, 'logout'])
->name('autenticacao.logout');

Route::get('/cadastro', [LoginController::class, 'register'])
->name('autenticacao.cadastro');

Route::post('/cadastro', [LoginController::class, 'create'])
->name('autenticacao.cadastro.efetuar');

Route::get('/visualizar-email', function () {
    return new \App\Mail\NovaSerie("Arrow", 5, 10);
});

Route::get('/enviando-email', function () {
    $email = new \App\Mail\NovaSerie("Arrow", 5, 10);
    $email->subject = "Nova série adcionada";
    $user = (object)[
        'email' => 'tonibevila@gmail.com',
        'name'  => "Antonio"
    ];
    Mail::to($user)->send($email);
    return "Email enviado!";
});
#require __DIR__.'/auth.php';
