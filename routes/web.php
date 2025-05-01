<?php

use App\Http\Controllers\LivroController;
use App\Http\Controllers\PessoaController;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/livro/lista', [LivroController::class, 'getLivro']);
Route::post('/livro/create', [LivroController::class, 'postLivro'])->name('livro.post');
Route::get('/livro/lista', [LivroController::class, 'listaLivros']);
//Route::get('/livro/lista', [LivroController::class, 'getLivro']);

Route::get('/pessoas', [PessoaController::class, 'listaPessoas']);
Route::post('/pessoas', [PessoaController::class, 'postPessoa']);

Route::get('/livro', function (): View {
    return view('livros.cadlivro');
});

Route::get('/pessoas/cadastrar', function () {
    return view('pessoas.cad');
    
    /*
    Route::get('/livro', function () {
        return view('cadlivro'); // comentei aqui Pedro
    */
});

Route::delete('/livro/delete/{id}', [LivroController::class, 'deleteLivro'])->name('livro.delete');
Route::put('/livro/update/{id}', [LivroController::class, 'updateLivro'])->name('livro.update');
Route::get('/livro/edit/{id}', [LivroController::class, 'editLivro'])->name('livro.edit');

