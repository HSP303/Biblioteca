@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Reserva</h2>

    <form action="{{ route('reserva.create') }}" method="POST">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label for="livro" class="form-label">Livro:</label>
            <input type="text" class="form-control" name="livro" id="livro" required>
        </div>

        <div class="mb-3">
            <label for="pessoa" class="form-label">Pessoa:</label>
            <input type="text" class="form-control" name="pessoa" id="pessoa" required>
        </div>

        <button type="submit" class="btn btn-success">Reservar</button>
        <a href="{{ url('/livro/lista') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
