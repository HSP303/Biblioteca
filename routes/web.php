<?php

use App\Http\Controllers\LivroController;
use App\Http\Controllers\PessoaController;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//Rotas para entidade livros
Route::get('/livro/lista', [LivroController::class, 'getLivro']);
Route::post('/livro/create', [LivroController::class, 'postLivro'])->name('livro.post');
Route::get('/livro/lista', [LivroController::class, 'listaLivros']);
Route::get('/livro', function (): View {
    return view('livros.cadlivro');
});
Route::delete('/livro/delete/{id}', [LivroController::class, 'deleteLivro'])->name('livro.delete');
Route::put('/livro/update/{id}', [LivroController::class, 'updateLivro'])->name('livro.update');
Route::get('/livro/edit/{id}', [LivroController::class, 'editLivro'])->name('livro.edit');
//Route::get('/livro/lista', [LivroController::class, 'getLivro']);

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


    
    /*
    Route::get('/livro', function () {
        return view('cadlivro'); // comentei aqui Pedro
    */



