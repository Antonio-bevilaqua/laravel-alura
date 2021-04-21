<?php

namespace App\Http\Controllers;

use App\Events\NovaSerie as EventsNovaSerie;
use App\Models\Serie;
use App\Mail\NovaSerie;
use Illuminate\Http\Request;
use App\Services\CriadorDeSeries;
use App\Services\RemovedorDeSeries;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SeriesFormRequest;
use App\Models\User;

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

        if ($serie) {
            $serie->nome = $request->nome;
            $serie->save();

            return json_encode(['type' => 'success', 'message' => 'série atualizada com sucesso!']);
        }


        return json_encode(['type' => 'danger', 'message' => 'falha ao atualizar a série!']);
    }

    public function insert(SeriesFormRequest $request, CriadorDeSeries $criadorDeSeries)
    {
        $capa = ($request->hasFile('capa')) ? $request->file('capa')->store('series') : null;


        $serie = $criadorDeSeries->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_por_temporada,
            $capa
        );
        
        $eventoNovaSerie = new EventsNovaSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_por_temporada
        );

        event($eventoNovaSerie);

        $request->session()->flash('msg-sucesso', "Série #" . $serie->id . " - " . $serie->nome . " e suas temporadas e episódios criados com sucesso!");


        return redirect()->route('series');
    }

    public function destroy(int $id, Request $request, RemovedorDeSeries $removedorDeSeries)
    {
        $nomeSerie = $removedorDeSeries->remover($id);
        if ($nomeSerie !== "") {
            $request->session()->flash('msg-sucesso', "Série $nomeSerie removida com sucesso!");
        } else {
            $request->session()->flash('msg-sucesso', "Falha ao remover a série!");
        }

        return redirect()->route('series');
    }
}
