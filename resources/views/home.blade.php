@extends('layouts.app')
@section('title', 'Meu Número')
@section('content')
@if ($numero == 'null')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <!-- CADASTRAR SETOR -->
            <div class="border border-info border-2 p-5">
                <div align="center">
                    <h3>Cadastrar Número</h3><br>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="numero" class="form-label">Digite o número que vai gerenciar o sistema</label>
                        <input type="numero" name="numero" class="form-control" id="numero"
                            placeholder="Ex.: 1100001111">
                        <small class="text-danger">Verifique se o número está correto antes de enviar.</small>
                    </div>

                    <div class="col-12 d-flex justify-content-center">
                        <button id="botao" type="submit" class="btn btn-primary w-50">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@else
<div>
    <h1 class="text-info text-center">Ja existe numero cadastrado {{$numero}}</h1>
    <h2 class="text-info text-center">Verifique se já existe Setores cadastrados.</h2>
</div>
@endif


<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
<script>
    const botao = document.getElementById('botao');
        botao.addEventListener('click', (e) => {
            e.preventDefault();

            let qrcode = window.open('http://localhost:3000', '_blank', 'top=500,left=-800,height=570,width=520,scrollbars=yes,status=yes');

            const token = document.getElementById('_token').value;

            const valInput = document.getElementById('numero').value;
            fetch("{{ route('salvarNumero') }}", {
                    method: "POST",
                    body: JSON.stringify(valInput),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    }
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    botao.disabled = true;
                });

        });
</script>
@endsection