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
                    <td>{{ $reserva['dataIni'] }}</td>
                    <td>{{ $reserva['dataFim'] }}</td>
                </tr> 
            @endforeach
        </tbody>
    </table>
@endsection
