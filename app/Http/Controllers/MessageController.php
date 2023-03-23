<?php

namespace App\Http\Controllers;

use App\Models\Atendente;
use Illuminate\Http\Request;
use Goutte\Client;
use Illuminate\Support\Facades\Auth;
use App\Models\Client as Clients;
use App\Models\Message;
use App\Models\Numero;
use App\Models\Pergunta;
use App\Models\Resposta;
use App\Models\Setor;

class MessageController extends Controller
{
    public function crawler()
    {
        $response = [];
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.symfony.com/blog/');

        $crawler->filter('h2 > a')->each(function ($node) {
            $this->response[] = $node->text() . "\n";
        });
        return response($this->response);
    }
    //_____________________ CRAWLER DE UM FETCH POST ______________________//
    public function crawlerr(Request $request)
    {
        $response = [];
        $this->response[] = $request[0];
        return response($this->response);
    }
    //______________________________________________________________
    //_____________________ FUNÇÕES DE VIEW ______________________//
    public function comunicado()
    {
        return view('comunicado');
    }
    public function message()
    {
        $mensagens = Message::where('client_id', 1)->get();
        $clients = Clients::where('user_id', 1)->get();

        return view('message', compact('mensagens', 'clients'));
    }
    public function setor()
    {
        $numeros = Numero::where('user_id', Auth::user()->id)->get();
        if (empty($numeros[0]->numero)) {
            $numero = 'null';
        } else {
            $numero = $numeros[0]->numero;
        }
        return view('setor', compact('numero'));
    }
    public function atendentes()
    {
        $numeros = Numero::where('user_id', Auth::user()->id)->get();
        if (empty($numeros[0]->numero)) {
            $numero = 'null';
        } else {
            $numero = $numeros[0]->numero;
        }
        return view('atendentes', compact('numero'));
    }
    public function respostas()
    {
        $numeros = Numero::where('user_id', Auth::user()->id)->get();
        if (empty($numeros[0]->numero)) {
            $numero = 'null';
        } else {
            $numero = $numeros[0]->numero;
        }
        return view('resposta', compact('numero'));
    }
    //______________________________________________________________
    //_____________________ FUNÇÕES DE POST ______________________//
    public function salvarRespostas(Request $request)
    {
        $resposta = new Resposta();
        $pergunta = new Pergunta();
        $setor = Setor::first()->id;
        // dd($setor);
        $numero = Setor::where('id', $setor)->first()->numero;

        $pergunta->pergunta = $request->pergunta;
        $pergunta->numero = $numero;
        $pergunta->setor_id = $setor;
        $pergunta->user_id = Auth::user()->id;
        $pergunta->save();

        $resposta->resposta = $request->resposta;
        $resposta->numero = $numero;
        $resposta->setor_id = $setor;
        $resposta->user_id = Auth::user()->id;
        $resposta->save();
        return redirect('/respostas')->with('status', 'Pergunta / Resposta salva! Apenas uma pergunta e uma resposta podem ser salvas no momento. O sistema ainda enconta-se em Desenvolvimento.');
    }
    public function postarMensagem(Request $request)
    {
        $message = new Message();
        $message->client_id = 1;
        $message->user_id = 1;
        $message->numero = $request->numero;
        $message->mensagem = $request->mensagem;
        // $message->save();
    }
    // REQUEST POST VINDO DO FETCH DA VIEW SETOR
    public function salvarSetor(Request $request)
    {
        $setor = new Setor();
        $setor->nome = $request->setor;
        $setor->numero = $request->numero;
        $setor->user_id = Auth::user()->id;
        $setor->save();
        return redirect('/setor')->with('status', 'Setor salvo! Apenas um setor pode ser salvo no momento. O sistema ainda enconta-se em Desenvolvimento.');
    }
    // REQUEST POST VINDO DO FETCH DA VIEW ATENDENTES
    public function salvarAtendentes(Request $request)
    {
        $atendentes = new Atendente();
        $atendentes->nome = $request[0];
        $atendentes->numero = $request[1];
        $atendentes->setor_id = $request[2];
        $atendentes->user_id = Auth::user()->id;
        $atendentes->save();
    }
    // REQUEST POST VINDO DO FETCH DA VIEW NUMEROS (VIEW HOME)
    public function salvarNumero(Request $request)
    {
        $file = 'Api/server.js';
        $newfile = 'Api/' . $request[0] . '.js';

        if (!copy($file, $newfile)) {
            $resposta = 'erro';
        }
        $resposta = 'ativo';
        $numero = new Numero();
        $numero->numero = $request[0];
        $numero->user_id = Auth::user()->id;
        $numero->save();
        exec('node ' . $newfile);
        return response($resposta);
    }
    // REQUEST GET VINDO DO FETCH DA VIEW SETOR
    public function mostrarSetor()
    {
        $setores = Setor::all();
        $totalSetores = count($setores);
        return response($totalSetores);
    }
    // REQUEST GET VINDO DO FETCH DA VIEW SETOR
    public function contarRespostas()
    {
        $respostas = Resposta::all();
        $totalrespostas = count($respostas);
        return response($totalrespostas);
    }
    // REQUEST GET VINDO DO FETCH DA VIEW ATENDENTES
    public function mostrarSetorAtendente()
    {
        $setores = Setor::all();
        return response($setores);
    }
    public function mostrarAtendentes()
    {
        $atendentes = Atendente::all();
        return response($atendentes);
    }
    //______________________________________________________________//
    // VIEW PARA VERIFICAR DEPOIS SE VAI UTILIZAR
    public function show()
    {
        $mensagens = Message::where('client_id', 1)->get();
        $clients = Clients::where('user_id', 1)->get();

        return view('message', compact('mensagens', 'clients'));
    }
}
