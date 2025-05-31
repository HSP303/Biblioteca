@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Livros Cadastrados</h1>

    <form method="GET" action="{{ route('livro.get') }}" class="mb-4">
    <div class="row">
        <div class="col">
            <input type="text" name="titulo" class="form-control" placeholder="Título"
                value="{{ $filtros['titulo'] ?? '' }}">
        </div>
        <div class="col">
            <input type="text" name="autor" class="form-control" placeholder="Autor"
                value="{{ $filtros['autor'] ?? '' }}">
        </div>
        <div class="col">
            <input type="number" name="ano" class="form-control" placeholder="Ano"
                value="{{ $filtros['ano'] ?? '' }}">
        </div>
        <div class="col">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="{{ route('livro.get') }}" class="btn btn-secondary">Limpar</a>
        </div>
    </div>
    </form>


    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Ano</th>
                <th>Edição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($livros as $livro)
                <tr>
                    <td>{{ $livro['id'] }}</td>
                    <td>{{ $livro['titulo'] }}</td>
                    <td>{{ $livro['autor'] }}</td>
                    <td>{{ $livro['ano'] }}</td>
                    <td>{{ $livro['edicao'] }}</td>
                    <td>
                        <a href="{{ route('livro.edit', ['id' => $livro['id']]) }}" class="btn btn-primary btn-sm me-2">Editar</a>
                        <form action="{{ route('livro.delete', $livro['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm me-2" onclick="return confirm('Deseja excluir este livro?')">Excluir</button>
                        </form>
                        <a href="{{ route('reserva.get', ['id' => $livro['id']]) }}" class="btn btn-success btn-sm me-2">Reservar</a>
                    </td>
                </tr> 
            @endforeach
        </tbody>
    </table>
@endsection
