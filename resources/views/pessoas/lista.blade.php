@extends('layouts.app')

@section('title', 'Pessoas Cadastradas')

@section('content')
    <h1 class="mb-4">Pessoas Cadastradas</h1>

    @if (isset($pessoas) && count($pessoas) > 0)
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pessoas as $pessoa)
                    <tr>
                        <td>{{ $pessoa['id'] }}</td>
                        <td>{{ $pessoa['nome'] }}</td>
                        <td>{{ $pessoa['email'] }}</td>
                        <td>{{ $pessoa['tel'] }}</td>
                        <td>
                            <a href="{{ route('pessoa.edit', ['id' => $pessoa['id']]) }}" class="btn btn-primary btn-sm me-2">Editar</a>
                            <form action="{{ route('pessoa.delete', $pessoa['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir esta pessoa?')">Excluir</button>
                            </form>
                        </td>
                    </tr> 
                @endforeach
                
            </tbody>
        </table>
    @else
        <p class="text-muted">Nenhuma pessoa cadastrada.</p>
    @endif
@endsection
