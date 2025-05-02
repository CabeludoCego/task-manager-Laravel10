<?php

use App\Http\Controllers\TarefaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/tarefa/export', [TarefaController::class, 'export'])
    ->name('tarefa.export');  // Resource cria uma 'rota' dummy para export, que não existe.
                              // Declarando antes, evitamos isso.

Route::resource('tarefa', TarefaController::class);
    // ->middleware('verified');
    // ->middleware('auth');
