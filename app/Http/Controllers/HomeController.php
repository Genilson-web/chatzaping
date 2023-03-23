<?php

namespace App\Http\Controllers;

use App\Models\Numero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $numeros = Numero::where('user_id', Auth::user()->id)->get();
        if (empty($numeros[0]->numero)) {
            $numero = 'null';
        } else {
            $numero = $numeros[0]->numero;
        }
        return view('home', compact('numero'));
    }
}
