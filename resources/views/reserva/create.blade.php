@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Reserva de Livro</h2>

    <form action="{{ route('reserva.create') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="livro" class="form-label">Livro:</label>
            <select class="form-select" name="livro" id="livro" required>
                <option value="">Selecione um livro</option>
                @foreach($livros as $livro)
                    <option value="{{ $livro['id'] }}">{{ $livro['titulo'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="pessoa" class="form-label">Pessoa:</label>
            <select class="form-select" name="pessoa" id="pessoa" required>
                <option value="">Selecione uma pessoa</option>
                @foreach($pessoas as $pessoa)
                    <option value="{{ $pessoa['id'] }}">{{ $pessoa['nome'] }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Reservar</button>
        <a href="{{ url('/livro/lista') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
