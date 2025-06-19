@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Editar Livro</h2>

    <form action="{{ route('multas.put') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Id</label>
            <input type="text" class="form-control" name="id" id="id" value="{{ old('titulo', $multa['id']) }}" readonly>
        </div>

        <div class="mb-3">
            <label for="autor" class="form-label">Pessoa</label>
            <input type="text" class="form-control" name="pessoa" id="pessoa" value="{{ old('autor', $multa['pessoa']['nome']) }}" readonly>
        </div>

        <div class="mb-3">
            <label for="ano" class="form-label">Descrição</label>
            <input type="text" class="form-control" name="descricao" id="descricao" value="{{ old('ano', $multa['descricao']) }}" required>
        </div>

        <div class="mb-3">
            <label for="edicao" class="form-label">Data</label>
            <input type="date" class="form-control" name="dataMulta" id="dataMulta" value="{{ old('edicao', $multa['dataMulta']) }}"required>
        </div>

        <div class="mb-3">
            <label for="edicao" class="form-label">Valor</label>
            <input type="real" class="form-control" name="valor" id="edicvalorao" value="{{ old('edicao', $multa['valor']) }}" required>
        </div>

         <input type="hidden" name="pago" id="pago" value="{{ old('edicao', $multa['pago']) }}" required>

        <button type="submit" class="btn btn-success">Salvar Alterações</button>
        <a href="{{ url('/multas') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
