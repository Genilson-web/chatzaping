@extends('layouts.app')
@section('content')
@section('title', 'Setor')
<div class="container mt-2 p-4 col-md-6 d-flex justify-content-center">
    @if ($numero == 'null')
    <div class="d-flex justify-content-center">
        <h1 class="text-info">Por favor, cadastre um Número para adminstrar o sistema antes de cadastrar Setores.</h1>
    </div>
    @else
    <div class="row">
        <!-- CADASTRAR SETOR -->
        @if (session('status'))
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
        @endif
        <div class="border border-info border-2 p-5">
            <div>
                <h3>Cadastrar Setor</h3>
            </div>
            <form action="{{route('salvarSetor')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="setor" class="form-label">Setor</label>
                    <input type="text" name="setor" class="form-control" id="setor" placeholder="Ex.: Financeiro">
                </div>
                <div class="mb-3">
                    <label for="numero" class="form-label">Número de telefone do setor</label>
                    <input type="number" name="numero" class="form-control" id="numero" placeholder="Ex.: 1100001111">
                </div>
                <div class="d-flex justify-content-center">
                    <button id="botao" type="submit" class="btn btn-primary w-75">Enviar</button>
                </div>
                <p id="aviso" class="text-danger mt-2" style="display: none">Apenas um setor pode ser salvo no momento.
                    O sistema ainda enconta-se em desenvolvimento.<br>
                    Obrigado pela compreensão.
                </p>
            </form>
        </div>
    </div>
    @endif

</div>

<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
<script>
    // CHAMA A FETCH ASSIM QUE O DOM É TOTALMENTE CARREGADO
    document.addEventListener("DOMContentLoaded", function(e) {
        fetch("{{ route('mostrarSetor') }}")
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data == 1) {
                    document.getElementById('aviso').style.display = 'flex';
                    document.getElementById('botao').disabled = true;
                }
            })
    });
</script>
@endsection