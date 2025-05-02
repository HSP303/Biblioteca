@extends('layouts.app')

@section('title', 'Lista de Pessoas')

@section('content')
    <h1 class="mb-4">Pessoas Cadastradas</h1>

    @if (isset($pessoas) && count($pessoas) > 0)
        <div class="table-responsive">
            <table class="table table-dark table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pessoas as $pessoa)
                        <tr>
                            <td>{{ $pessoa['nome'] }}</td>
                            <td>{{ $pessoa['email'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-light">Nenhuma pessoa cadastrada.</p>
    @endif

    <a href="{{ route('welcome') }}" class="btn btn-outline-light mt-4">
        <i class="bi bi-house-door"></i> Voltar ao início
    </a>
@endsection
