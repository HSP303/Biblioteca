@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Editar Pessoa</h2>

    <form action="{{ route('pessoa.update', $pessoa['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" name="nome" id="nome" value="{{ old('nome', $pessoa['nome']) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $pessoa['email']) }}" required>
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone:</label>
            <input type="text" class="form-control" name="telefone" id="tel" value="{{ old('telefone', $pessoa['tel']) }}" required>
        </div>

        <div class="">
            <label for="endereco" class="form-label">Endereço:</label>
            <input type="text" class="form-control" name="endereco" id="endereco" value="{{ old('endereco', $pessoa['endereco']) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Salvar Alterações</button>
        <a href="{{ route('pessoas.lista') }}" class="btn btn-secondary">Cancelar</a>
    </form>

</div>
@endsection