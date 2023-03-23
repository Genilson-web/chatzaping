@extends('layouts.app')
@section('title', 'Atendentes')
@section('content')

<div class="container mt-2 p-4 col-md-6 d-flex justify-content-center">
    @if ($numero == 'null')
    <div class="d-flex justify-content-center">
        <h1 class="text-info">Por favor, cadastre um Número para adminstrar o sistema antes de cadastrar Atendentes.
        </h1>
    </div>
    @else
    <div class="row">
        <!-- CADASTRAR ATENDENTES -->
        <div class="border border-info border-2 p-5">
            <div>
                <h3>Cadastrar Atendentes</h3>
            </div>
            <form action="{{ route('salvarAtendentes') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome">
                </div>
                <div class="mb-3">
                    <label for="numero" class="form-label">Número</label>
                    <input type="number" name="numero" class="form-control" id="numero" placeholder="Ex.: 1100001111">
                </div>
                <div class="mb-3">
                    <label for="setor" class="form-label">Setor</label>
                    <select class="form-select" name="setor" id="opcoes" aria-label="Default select example">
                        <option selected>Selecione um Setor</option>
                    </select>
                    <div id="info" class="text-danger">
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <button id="botao" type="submit" class="btn btn-primary w-50">Enviar</button>
                </div>
            </form>
        </div>

        <!-- ATENDENTES CADASTRADOS-->
        <div class="border border-success border-2 p-5 mt-3">
            <div class="row">
                <div class="row">
                    <div class="col">
                        <button class="btn btn-success btn-sm float-end" id="atualizar">Atualizar</button>
                    </div>
                </div>
                <div class="col">
                    <h3>Atendentes Cadastrados</h3>
                </div>

            </div>
            <div>
                <table class="table table-success table-striped">
                    <tbody>
                        <tr id="content">

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>

<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">

<script>
    const botao = document.getElementById('botao');
    botao.addEventListener('click', function(e) {
        e.preventDefault();
        const token = document.getElementById('_token').value;

        const nome = document.getElementById('nome').value;
        const numero = document.getElementById('numero').value;
        const opcoes = document.getElementById('opcoes').value;
        let arrayInput = [nome, numero, opcoes];
        const crawler = fetch("{{ route('salvarAtendentes') }}", {
                method: "POST",
                body: JSON.stringify(arrayInput),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                }
            })
            .then(response => alert(`Atendente: ${nome}, cadastrado com sucesso.`))

        document.getElementById('nome').value = '';
        document.getElementById('numero').value = '';
    });
    // CHAMA A FETCH ASSIM QUE OBOTÃO 'ATUALIZAR' É CLICADO
    const atualizar = document.getElementById('atualizar');
    atualizar.addEventListener('click', (e) => {
        e.preventDefault();
        const conteudo = document.getElementById('content');
        conteudo.textContent = '';
        fetch("{{ route('mostrarAtendentes') }}")
            .then(response => response.json())
            .then(data => {
                for (let i = 0; i < data.length; i++) {
                    const content = document.createElement('p');
                    content.textContent = data[i]['nome'];
                    conteudo.appendChild(content);
                }
            })
    });

    // CHAMA A FETCH ASSIM QUE O DOM É TOTALMENTE CARREGADO
    document.addEventListener("DOMContentLoaded", function(e) {
        fetch("{{ route('mostrarAtendentes') }}")
            .then(response => response.json())
            .then(data => {
                for (let i = 0; i < data.length; i++) {
                    const content = document.createElement('p');
                    content.textContent = data[i]['nome'];
                    document.getElementById('content').appendChild(content);
                }
            })
        // FETCH QUE CARREGA OS SETORES NO SELECT
        fetch("{{ route('mostrarSetorAtendente') }}")
            .then(response => response.json())
            .then(data => {
                // VERIFICA SE EXISTE SETOR CADASTRADO
                if (data == '') {
                    const content = document.createElement('small');
                    content.textContent =
                        'Você não possui nenhum Setor cadastrado. Crie um Setor antes de continuar.';
                    document.getElementById('info').appendChild(content);

                    // DESATIVA O BOTÃO CASO NÃO EXISTA SETOR CADASTRADO
                    const botao = document.getElementById('botao');
                    const att = document.createAttribute("disabled");
                    botao.setAttributeNode(att);
                } else {
                    for (let i = 0; i < data.length; i++) {
                        const opContent = document.createElement('option');
                        opContent.textContent = data[i]['nome'];
                        opContent.value = data[i]['id'];
                        document.getElementById('opcoes').appendChild(opContent);
                    }
                }
            })
    });
</script>
@endsection