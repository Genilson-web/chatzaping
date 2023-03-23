@extends('layouts.app')
@section('content')
<style>
    p {
        font-size: 20px;
        line-height: 1.25em;
        font-weight: 700;
        margin-top: 10%;
        padding: 15px;
        color: rgb(136, 136, 136);
        font-family: Arial Black;
    }

    .p {
        font-size: 24px;
        line-height: 1.25em;
        font-weight: 700;
        margin-top: 5%;
        color: rgb(136, 136, 136);
    }

    .p2 {
        font-size: 16px;
        line-height: 1.25em;
        font-weight: 700;
        margin-top: 5%;
        color: rgb(136, 136, 136);
    }

    #first-left {
        width: 100%;
    }

    #first-right {
        display: none;
    }

    .meio {
        padding: 0;
    }

    h3 {
        font-family: Arial Black;
    }

    .left {
        background-image: url("{{ asset('images/welcome/left.jpg') }}");
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        height: 150px;
    }

    .middle {
        background-image: url("{{ asset('images/welcome/middle.jpg') }}");
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        height: 150px;
    }

    .right {
        background-image: url("{{ asset('images/welcome/right.jpg') }}");
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        height: 150px;
    }

    #second-right {
        display: none;
    }

    #second-left {
        width: 100%;
    }

    #animation-left {
        width: 100%;
        position: relative;
        animation-name: nimation-left;
        animation-duration: 4s;
    }

    @keyframes nimation-left {
        0% {
            left: -400px;
        }

        75% {
            left: 250px;
        }

        100% {
            left: 0px;
        }
    }

    #animation-right {
        width: 100%;
        position: relative;
        animation-name: nimation-right;
        animation-duration: 4s;
    }

    @keyframes nimation-right {
        0% {
            right: -400px;
        }

        75% {
            right: 250px;
        }

        100% {
            right: 0px;
        }
    }

    /************** INICIO DA VERSÃO DESKTOP ****************/
    @media (min-width: 490px) {
        #first-right {
            display: block;
            background-image: url("{{ asset('images/welcome/first-left.jpg') }}");
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            height: 370px;
            opacity: 0.8;
        }

        p {
            font-size: 42px;
            margin-top: 15%;
        }

        .p {
            margin-top: 10%;
        }

        .p2 {
            font-size: 24px;
        }

        #first-left {
            width: 40%;
        }

        #second-left {
            width: 40%;
        }

        #animation-left {
            width: 40%;
        }

        #animation-right {
            width: 40%;
        }

        #second-right {
            display: block;
            background-image: url("{{ asset('images/welcome/sec-right.jpg') }}");
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            height: 400px;
            opacity: 0.9;
        }

        .meio {
            padding: 50px;
        }

        .left {
            height: 450px;
        }

        .middle {
            height: 450px;
        }

        .right {
            height: 450px;
        }

    }
</style>
<div id="main">
    <div class="row">
        <div id="first-left" class="col-5">
            <p class="">Conecte com seus clientes de forma rápida e automática com o <span class="text-success">Chat
                    Zaping</span>.</p>
        </div>
        <div id="first-right" class="col-7">

        </div>
    </div>

    <div class="row">
        <div class="meio d-flex justify-content-center">
            <div id="animation-left" class="col-5 p-2">
                <h3 class="text-center text-secondary">Com o
                    <span class="text-success">Chat Zaping</span>
                    você pode automatizar seus atendimnetos, economizando tempo e recursos para outras tarefas.
                </h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="second-right" class="col-7">

        </div>
        <div id="second-left" class="col-5">
            <p class="">Faça campanhas promocionais para seus clientes de maneira simples e instantânea.</p>
        </div>
    </div>

    <div class="row">
        <div class="meio d-flex justify-content-center">
            <div id="animation-right" class="col-5 p-2">
                <h3 class="text-center text-secondary">Crie agora mesmo uma conta gratuita no
                    <span class="text-success">Chat Zaping</span>
                    e comece a otimizar o seu tempo e dos seus clientes.
                </h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="left col-4">
            <p class="p2">Rápido</p>
        </div>
        <div class="middle col-4">
            <p class="p2">Prático</p>
        </div>
        <div class="right col-4">
            <p class="p2">Barato</p>
        </div>
    </div>

</div>
@endsection