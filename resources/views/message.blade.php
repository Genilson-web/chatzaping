@extends('layouts.app')
@section('content')
<h2>Message Page</h2>
<div>
    <div>
        <img id="image" class="image" src="" alt="QR code" />

    </div>
    <div>
        <button class="btn btn-primary" onclick="clicar()">Rodar a fetch</button><br>
        <button class="btn btn-secondary mt-2" onclick="mudar()">Troca Image</button><br>
        <button class="btn btn-warning mt-2" onclick="janela()">Abrir Janela</button>
    </div>
    <div>
        @foreach ($mensagens as $msg)
        <p>User_ID: {{ $msg->user_id }}</p>
        <p>Numero: {{ $msg->numero }}</p>
        <p>Mensagem: {{ $msg->mensagem }}</p>
        <hr>
        @endforeach
    </div>
    <hr>
    <hr>
    <div>
        @foreach ($clients as $item)
        <p>User_ID: {{ $item->user_id }}</p>
        <p>Nome: {{ $item->nome }}</p>
        <p>Numero: {{ $item->numero }}</p>
        <hr>
        @endforeach
    </div>
</div>

<script>
    function clicar() {
            fetch("http://localhost:9070/data").then(req => req.text()).then(
                val => {
                    console.log(val)
                    document.getElementById('image').src = `http://chart.apis.google.com/chart?&chs=300x300&cht=qr&chl=${val}`;
                }
            )
        }
        function mudar ()
        {
            let imagem = '2@YvFLrFyQz3k1VH3WlxPGmStROEc72LXIh6O7mIdeX9iCufF2+7oQTEnjPRhZkCVNeoaCaIx1ffEKGA==,6VAu4UYEKgHSoZbjPIAOqR6BmBAWzQ5VQ1jO2TUiaGQ=,j5Ry4MHwTh9X+stMCovpzOkJcD8mSz25DKL0pUbLvGM=,qTJ3/ZsheOHnF5qK/954BSsuc/E6IVDQTiIZKCAT5BI=';
                    document.getElementById('image').src = `http://chart.apis.google.com/chart?&chs=300x300&cht=qr&chl=${imagem}`;
        }

        function janela ()
        {
            let currentPage = 'https://www.uol.com.br/';
            window.close();
            let pop = window.open( 
            currentPage,
            "_blank", 
            "toolbar=yes, scrollbars=yes,resizable=yes," +
            "top=0,left=window.screen.availWidth/2," +
            "window.screen.availWidth/2,window.screen.availHeight");
        }
</script>
@endsection