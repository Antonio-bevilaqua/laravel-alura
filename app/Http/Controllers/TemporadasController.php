<?php

namespace App\Http\Controllers;

use App\Models\Serie;

class TemporadasController extends Controller
{
    public function index(int $id_serie)
    {
        $temporadas = Serie::find($id_serie)->temporadas;

        return view('temporadas.index', compact('temporadas'));
    }
}
