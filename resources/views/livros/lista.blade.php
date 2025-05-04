@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Livros Cadastrados</h1>

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
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir este livro?')">Excluir</button>
                        </form>
                    </td>
                </tr> 
            @endforeach
        </tbody>
    </table>
@endsection
