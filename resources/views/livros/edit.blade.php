@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Editar Livro</h2>

    <form action="{{ route('livro.update', $livro['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título:</label>
            <input type="text" class="form-control" name="titulo" id="titulo" value="{{ old('titulo', $livro['titulo']) }}" required>
        </div>

        <div class="mb-3">
            <label for="autor" class="form-label">Autor:</label>
            <input type="text" class="form-control" name="autor" id="autor" value="{{ old('autor', $livro['autor']) }}" required>
        </div>

        <div class="mb-3">
            <label for="ano" class="form-label">Ano:</label>
            <input type="number" class="form-control" name="ano" id="ano" value="{{ old('ano', $livro['ano']) }}" required>
        </div>

        <div class="mb-3">
            <label for="edicao" class="form-label">Edição:</label>
            <input type="number" class="form-control" name="edicao" id="edicao" value="{{ old('edicao', $livro['edicao']) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Salvar Alterações</button>
        <a href="{{ url('/pessoas/lista') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
