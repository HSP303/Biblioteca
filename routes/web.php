<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\ReservaController;
use Illuminate\View\View;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Rotas para entidade livros
Route::get('/livro/lista', [LivroController::class, 'getLivro']);
Route::post('/livro/create', [LivroController::class, 'postLivro'])->name('livro.post');
//Route::get('/livro/lista', [LivroController::class, 'listaLivros']);
Route::get('/livro', function (): View {
    return view('livros.cadlivro');
});
Route::delete('/livro/delete/{id}', [LivroController::class, 'deleteLivro'])->name('livro.delete');
Route::put('/livro/update/{id}', [LivroController::class, 'updateLivro'])->name('livro.update');
Route::get('/livro/edit/{id}', [LivroController::class, 'editLivro'])->name('livro.edit');
Route::get('/livro/reserve/{id}', [LivroController::class, 'reserveLivro'])->name('livro.reserve');
//Route::get('/livro/lista', [LivroController::class, 'getLivro']);

Route::get('/reserva/new/{id}', [ReservaController::class, 'index'])->name('reserva.get');
Route::get('/reserva/lista', [ReservaController::class, 'getReserva'])->name('reserva.lista');
Route::post('/reserva/create', [ReservaController::class, 'postReserva'])->name('reserva.create');
Route::delete('/reserva/delete', [ReservaController::class, 'deleteReserva'])->name('reserva.delete');

//Rotas para entidade pessoas
Route::get('/pessoas/lista', [PessoaController::class, 'listaPessoas'])->name('pessoas.lista');
Route::post('/pessoas', [PessoaController::class, 'postPessoa'])->name('pessoas.store');
//Route::post('/pessoas', [PessoaController::class, 'postPessoa']);

Route::get('/pessoas/cadastrar', function () {
    return view('pessoas.cad');
})->name('pessoas.form');

Route::get('/pessoas', function () {
    return view('pessoas.cad');
});
Route::delete('/pessoas/delete/{id}', [PessoaController::class, 'deletePessoa'])->name('pessoa.delete');
Route::put('/pessoas/update/{id}', [PessoaController::class, 'updatePessoa'])->name('pessoa.update');
Route::get('/pessoas/edit/{id}', [PessoaController::class, 'editPessoa'])->name('pessoa.edit');

//Rotas para entidade reserva
//by Vini 31/05/2025
Route::get('/reserva/new/{id}', [ReservaController::class, 'index'])->name('reserva.get');
//by Vini 31/05/2025
Route::get('/reserva/{idlivro}', [ReservaController::class, 'index'])->name('reserva.create');
//by Vini 31/05/2025
Route::post('/reserva', [ReservaController::class, 'postReserva'])->name('reserva.store');
require __DIR__.'/auth.php';
