@extends('layouts.app')

@section('title', 'Pessoas Cadastradas')

@section('content')
    <h1 class="mb-4">Multas Registradas</h1>

    @if (isset($multas) && count($multas) > 0)
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Valor</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($multas as $multa)
                    <tr>
                        <td>{{ $multa['id'] }}</td>
                        <td>{{ $multa['pessoa']['nome'] }}</td>
                        <td>{{ $multa['descricao'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($multa['dataMulta'])->format('d/m/Y') }}</td>
                        <td>R$ {{ $multa['valor'] }}</td>
                        <td>
                            <a href="{{ route('multas.edit', $multa['id']) }}" class="btn btn-primary btn-sm me-2">Editar</a>

                            @if(!empty($multa['pago']) && $multa['pago'] === true)
                                <button class="btn btn-sm me-2 btn-outline-success" disabled>
                                    <i class="bi bi-check-circle-fill"></i> Pago
                                </button>
                            @else
                                <form action="{{ route('multas.pagar', $multa['id']) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="valor" value="{{ old('edicao', $multa['valor']) }}">
                                    <input type="hidden" name="data" value="{{ old('edicao', $multa['dataMulta']) }}">
                                    <input type="hidden" name="descricao" value="{{ old('edicao', $multa['descricao']) }}">
                                    <button type="submit" class="btn btn-success btn-sm me-2">
                                        <i class="bi bi-cash"></i> Pagar
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('multas.delete', $multa['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm me-2" onclick="return confirm('Deseja excluir este livro?')">Excluir</button>
                            </form>
                        </td>
                    </tr> 
                @endforeach
                
            </tbody>
        </table>
    @else
        <p class="text-muted">Nenhuma multa registrada.</p>
    @endif
@endsection
