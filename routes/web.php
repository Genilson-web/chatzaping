<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController,MessageController};
use App\Http\Middleware\Bronze;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware([Bronze::class])->group(function () {
    // ROTAS PRINCIPAIS DO SISTEMA
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/message',[MessageController::class,'message'])->name('message');
Route::get('/comunicado',[MessageController::class,'comunicado'])->name('comunicado');
Route::get('/crawler',[MessageController::class,'crawler'])->name('crawler');
// ROTA DE TESTE, REMOVER POSTERIORMENTE JUTO COM O METODO DO CONTROLLER
Route::post('/crawlerr',[MessageController::class,'crawlerr'])->name('crawlerr');

// ROTAS DE VERBO POST
Route::post('/postarMensagem',[MessageController::class,'postarMensagem'])->name('postarMensagem');
Route::post('/salvarSetor',[MessageController::class,'salvarSetor'])->name('salvarSetor');
Route::post('/salvarAtendentes',[MessageController::class,'salvarAtendentes'])->name('salvarAtendentes');
Route::post('/salvarNumero',[MessageController::class,'salvarNumero'])->name('salvarNumero');
Route::post('/salvarRespostas',[MessageController::class,'salvarRespostas'])->name('salvarRespostas');

// ROTAS DE VERBO GET
Route::get('/show',[MessageController::class,'show'])->name('show');
Route::get('/setor',[MessageController::class,'setor'])->name('setor');
Route::get('/mostrarSetor',[MessageController::class,'mostrarSetor'])->name('mostrarSetor');
Route::get('/contarRespostas',[MessageController::class,'contarRespostas'])->name('contarRespostas');
Route::get('/mostrarSetorAtendente',[MessageController::class,'mostrarSetorAtendente'])->name('mostrarSetorAtendente');
Route::get('/atendentes',[MessageController::class,'atendentes'])->name('atendentes');
Route::get('/mostrarAtendentes',[MessageController::class,'mostrarAtendentes'])->name('mostrarAtendentes');
Route::get('/respostas',[MessageController::class,'respostas'])->name('respostas');
Route::get('/mostrarRespostas',[MessageController::class,'mostrarRespostas'])->name('mostrarRespostas');
});


