<?php

use App\Http\Controllers\LivroController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get( '/livro/lista' , [ LivroController :: class , 'getLivro' ]);
Route::post( '/livro/create' , [ LivroController :: class , 'postLivro' ])->name('livro.post');
//Route::get('/livro/lista', [LivroController :: class, 'listaLivros']);

Route::get('/livro', function () {
    return view('cadlivro');
});