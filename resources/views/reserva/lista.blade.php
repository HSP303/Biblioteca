@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Livros Cadastrados</h1>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Pessoa</th>
                <th>Livro</th>
                <th>Data da Reserva</th>
                <th>Data de Vencimento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservas as $reserva)
                <tr>
                    <td>{{ $reserva['id'] }}</td>
                    <td>{{ $reserva['pessoa']['nome'] }}</td>
                    <td>{{ $reserva['livro']['titulo'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($reserva['dataIni'])->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($reserva['dataFim'])->format('d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('reserva.delete', $reserva['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm me-2" onclick="return confirm('Deseja devolver este livro?')">Devolver</button>
                        </form>
                    </td>
                </tr> 
            @endforeach
        </tbody>
    </table>
@endsection
