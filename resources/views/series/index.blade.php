@extends('layout')

@section('cabecalho')
    Séries
@endsection

@section('corpo')

    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adcionar</a>
    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between">
                <span class="nome-serie" id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>
                @auth('usuario')
                <div class="input-group w-50 input-nome-serie" hidden id="input-nome-serie{{ $serie->id }}">
                    <input type="text" class="form-control" value="{{ $serie->nome }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                            <i class="fas fa-check"></i>
                        </button>
                        @csrf
                    </div>
                </div>
                @endauth
                <span class="d-flex">
                    @auth('usuario')
                    <button class="btn btn-primary btn-sm me-1" onclick="showInputSerie({{ $serie->id }})"><i
                            class="fa fa-edit"></i></button>
                    @endauth
                    <a href="{{ route('temporadas', $serie->id) }}" class="btn btn-primary btn-sm me-1"><i
                            class="fas fa-external-link-alt"></i></a>
                    @auth('usuario')
                    <form action="{{ route('series.remove', $serie->id) }}" method="post"
                        onsubmit="return confirm('Tem certeza que deseja remover a série {{ addslashes($serie->nome) }} ?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></button>
                    </form>
                    @endauth
                </span>
            </li>
        @endforeach
    </ul>
    <script>
        function resetInputs() {
            [...document.querySelectorAll('.nome-serie')].map(el => {
                el.removeAttribute("hidden");
            });
            [...document.querySelectorAll('.input-nome-serie')].map(el => {
                el.setAttribute("hidden", true);
            });
        }

        function showInputSerie(id) {
            const inputSerie = document.querySelector('#input-nome-serie' + id);
            const nomeSerie = document.querySelector('#nome-serie-' + id);
            if (inputSerie.hasAttribute("hidden")) {
                resetInputs();
                nomeSerie.setAttribute("hidden", true);
                inputSerie.removeAttribute("hidden");
            } else {
                resetInputs();
                inputSerie.setAttribute("hidden", true);
                nomeSerie.removeAttribute("hidden");
            }
        }

        function editarSerie(id) {
            const nome = document.querySelector('#input-nome-serie' + id + ' > input').value;
            const token = document.querySelector('input[name="_token"]').value;
            const sendUrl = "/series/" + id + "/atualiza";

            var formData = new FormData();
            formData.append("nome", nome);
            formData.append("_token", token);

            fetch(sendUrl, {
                    body: formData,
                    method: "POST"
                })
                .then((resp) => resp.json())
                .then(function(data) {
                    mostrarMensagemResposta(data);

                    atualizaInputs(id, nome);
                });
        }

        function mostrarMensagemResposta(data) {
            var alert = document.querySelector('div.container div.card-body .alert');
            if (alert !== null) {
                alert.remove();
            }
            var cardBody = document.querySelector('div.container div.card-body');
            cardBody.innerHTML = `<div class="alert alert-${data.type}">${data.message}</div> ${cardBody.innerHTML}`;
        }

        function atualizaInputs(id, nome) {
            const inputSerie = document.querySelector('#input-nome-serie' + id + ' > input');
            const nomeSerie = document.querySelector('#nome-serie-' + id);
            nomeSerie.textContent = nome;
            showInputSerie(id);
            inputSerie.value = nome;
        }

    </script>
@endsection
