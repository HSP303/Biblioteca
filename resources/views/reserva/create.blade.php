@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('/opt/lampp/htdocs/Trabalho_PW/Biblioteca/resources/css/reserva.css') }}">

<div class="container mt-4">
    <h2 class="mb-4">Reserva</h2>

    <form action="{{ route('reserva.create') }}" method="POST">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label for="livro" class="form-label">Livro:</label>
            <input type="search" class="form-control" name="livro" id="livro" value={{ @Request::segment(3) }} readonly>
        </div>

        <div class="mb-3">
            <label for="pessoa" class="form-label">Pessoa:</label>
            <input type="text" class="form-control" name="pessoa" id="pessoa" required>
        </div>

        <div class="state-select-list">
            <input type="text" class="state-select-list__search" placeholder="Selecionar Setor...">  
            <ul>
                <li class="state-select-list__item" data-id="hsp">Hospital</li>
                <li class="state-select-list__item" data-id="1">Recepção</li>
                <li class="state-select-list__item" data-id="2">Enfermaria</li>
                <li class="state-select-list__item" data-id="3">Sala de Espera</li>
                <li class="state-select-list__item" data-id="4">Ambulatório</li>
                <li class="state-select-list__item" data-id="5">Leito</li>
            </ul>
        </div>

        <button type="submit" class="btn btn-success">Reservar</button>
        <a href="{{ url('/livro/lista') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
