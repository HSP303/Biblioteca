@extends('layouts.app')

@section('title', 'Welcome to Raccoon Books')

@section('content')

<style>
    body {
        background: url('{{ asset('images/library-dark.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        color: white;
        margin: 0;
    }

    .welcome-container {
        height: 90vh; /* ou 100vh, conforme ajuste */
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .overlay {
        background-color: rgba(0, 0, 0, 0.6);
        padding: 50px;
        border-radius: 15px;
    }
</style>

<link rel="icon" type="image/png" href="{{ asset('images/umbrellacorporation.png') }}">

<div class="welcome-container">
    <div class="overlay">
        <h1>Raccoon Books</h1>
        <p class="lead">
            O conhecimento é a arma mais poderosa.<br>
            Sua biblioteca segura e eficiente!
        </p>
    </div>
</div>

@endsection
