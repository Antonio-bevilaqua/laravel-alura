<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Temporada;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Episodio;
use App\Services\CriadorDeSeries;
use App\Services\RemovedorDeSeries;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('nome')->get();

        return view('series.index', compact('series'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function update(int $id, Request $request)
    {
        $serie = Serie::find($id);

        if ($serie){
            $serie->nome = $request->nome;
            $serie->save();

            return json_encode(['type' => 'success', 'message' => 'série atualizada com sucesso!']);
        }


        return json_encode(['type' => 'danger', 'message' => 'falha ao atualizar a série!']);
    }

    public function insert(SeriesFormRequest $request, CriadorDeSeries $criadorDeSeries)
    {
        $serie = $criadorDeSeries->criarSerie(
            $request->nome, 
            $request->qtd_temporadas, 
            $request->ep_por_temporada
        );

        $request->session()->flash('msg-sucesso', "Série #".$serie->id." - ".$serie->nome." e suas temporadas e episódios criados com sucesso!");


        return redirect()->route('series');
    }

    public function destroy(int $id, Request $request, RemovedorDeSeries $removedorDeSeries)
    {
        $nomeSerie = $removedorDeSeries->remover($id);
        if ($nomeSerie !== ""){
            $request->session()->flash('msg-sucesso', "Série $nomeSerie removida com sucesso!");
        } else {
            $request->session()->flash('msg-sucesso', "Falha ao remover a série!");
        }

        return redirect()->route('series');
    }
}
