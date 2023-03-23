@extends('layouts.app')
@section('title', 'Respostas')
@section('content')
<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
<style>
    #ground {
        padding: 10px;
        background: rgb(202, 255, 202);
    }
    /* @media (min-width: 490px) {

    } */
</style>

<div class="container mt-2">
    @if ($numero == 'null')
    <div class="d-flex justify-content-center">
        <h1 class="text-info">Por favor, cadastre um Número para adminstrar o sistema antes de cadastrar Perguntas e
            Respostas.</h1>
    </div>
    @else
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-6">
            <h4 class="text-secondary text-center">Crie suas perguntas e respostas nos campos indicados. Utilize os
                exemplos para se orientar.</h4>
            <h5 class="text-secondary text-center">Monte as perguntas e respostas com bastante cuidado, pois elas serão
                as respostas
                automáticas que aparecerão para os seus clientes.</h5>
        </div>
    </div>
    <div class="row d-flex justify-content-around">
        <div class="col-sm-12 col-md-6 bg-info mt-1">
            @if (session('status'))
            <div class="alert alert-info">
                {{ session('status') }}
            </div>
            @endif
           <p> exemplos</p>
        </div>
        <div class="col-sm-12 col-md-4" id="ground" style="min-height: 400px">
            <form action="{{ route('salvarRespostas') }}" method="post">
                @csrf
                <div class="card bg-transparent">
                    <ul class="list-group list-group-flush">
                        <label class="text-success text-center">Pergunta</label>
                        <li ondragenter="dragEnter(event)" ondragleave="dragLeave(event)" ondrop="drop(event)"
                            ondragover="allowDrop(event)" class="list-group-item" style="display: block;min-height: 60px; margin-top:5px;
                            overflow: auto;background-color:rgba(255, 99, 71, 0.1); height:auto">
                            <textarea class="form-control" id="pergunta" rows="3"
                                placeholder="Digite aqui sua pergunta"></textarea>
                        </li>
                        <label class="text-success mt-3 text-center">Resposta</label>
                        <li ondragenter="dragEnter(event)" ondragleave="dragLeave(event)" ondrop="drop(event)"
                            ondragover="allowDrop(event)" class="list-group-item" style="display: block;min-height: 60px;
                            overflow: auto;background-color:rgba(255, 99, 71, 0.1); height:auto">
                            <textarea class="form-control" id="resposta" rows="3"
                                placeholder="Digite aqui sua resposta"></textarea>
                        </li>
                    </ul>
                </div>

                <input id="input-pergunta" class="d-none" type="text" name="pergunta">
                <input id="input-resposta" class="d-none" type="text" name="resposta">
                <div class="d-flex justify-content-around">
                    <button type="submit" id="submit" class="btn btn-primary mt-4 w-50">Salvar</button>
                </div>
                <p id="aviso" class="text-danger mt-2" style="display: none">Apenas uma Pergunta / Resposta pode ser
                    salva no momento.
                    O sistema ainda enconta-se em desenvolvimento.<br>
                    Obrigado pela compreensão.
                </p>
            </form>
        </div>
    </div>
    @endif
</div>

<script>
    let submit = document.getElementById('submit');
        submit.addEventListener('click', () => {
            let pergunta = document.getElementById('pergunta').value;
            document.getElementById('input-pergunta').value = pergunta;

            let resposta = document.getElementById('resposta').value;
            document.getElementById('input-resposta').value = resposta;
        })
           // CHAMA A FETCH ASSIM QUE O DOM É TOTALMENTE CARREGADO
    document.addEventListener("DOMContentLoaded", function(e) {
        fetch("{{ route('contarRespostas') }}")
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data == 1) {
                    document.getElementById('aviso').style.display = 'flex';
                    document.getElementById('submit').disabled = true;
                }
            })
    });
        //____________________FUNÇÕES DO DRAG & DROP __________________________//
        function dragEnter(ev) {
            if (ev.target.className == "list-group-item") {
                ev.target.style.border = "3px dotted green";
            }
        }

        function dragLeave(ev) {
            if (ev.target.className == "list-group-item") {
                ev.target.style.border = "";
            }
        }

        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            const setor = document.getElementById('opcoes').value;
            if (setor == 00) {
                alert('Por favor, esolha um Setor antes de continuar');
            }
            var data = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(data));
        }
</script>
@endsection