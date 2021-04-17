@extends('layout')

@section('cabecalho')
    Episódios da temporada {{ $temporada->numero }} da série {{ $temporada->serie->nome }}
@endsection

@section('corpo')


    <ul class="list-group">
        @csrf
        @foreach ($temporada->episodios as $episodio)
            <li class="list-group-item d-flex justify-content-between">
                Episódio {{ $episodio->numero }}
                <input type="checkbox" id="checkbox-{{ $episodio->id }}" @if ($episodio->assistido) checked @endif onclick="salvaAssistido({{ $episodio->id }})">
            </li>
        @endforeach
    </ul>
    <script>
        
        function salvaAssistido(id) {
            var formData = new FormData();
            var isChecked = false;
            const objRef = document.getElementById('checkbox-' + id);

            if (objRef.checked) {
                isChecked = true;
                formData.append("assistido", 1);
            } else {
                formData.append("assistido", 0);
            }

            const token = document.querySelector('input[name="_token"]').value;
            formData.append("_token", token);

            const sendUrl = "/episodios/" + id + "/update";

            fetch(sendUrl, {
                    body: formData,
                    method: "POST"
                })
                .then((resp) => resp.json())
                .then(function(data) {
                    mostrarMensagemResposta(data);

                    atualizaInputs(id, isChecked);
                });
        }

        function atualizaInputs(id, isChecked) {
            const objRef = document.getElementById('checkbox-' + id);
            const parent = objRef.parentNode;
            objRef.remove();
            var checkedVal = '';
            if (isChecked){
                checkedVal = 'checked';
            }
            newInput = `<input type="checkbox" id="checkbox-${id}" ${checkedVal} onclick="salvaAssistido(${id})">`;
            parent.innerHTML += newInput;
        }

        var timeoutRemove = null;
        var timeoutRemove2 = null;
        function mostrarMensagemResposta(data) {
            clearTimeout(timeoutRemove);
            clearTimeout(timeoutRemove2);
            var alert = document.querySelector('div.container div.card-body .alert');
            if (alert !== null) {
                alert.remove();
            }
            var cardBody = document.querySelector('div.container div.card-body');
            cardBody.innerHTML = `<div class="alert alert-${data.type}">${data.message}</div> ${cardBody.innerHTML}`;

            timeoutRemove = setTimeout(function () {
                document.querySelector('.alert').classList.add('fade');
                timeoutRemove2 = setTimeout(function () {
                    document.querySelector('.alert').remove();
                }, 200);
            }, 3000);
        }

    </script>
@endsection
