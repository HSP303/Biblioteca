@extends('layouts.app')

@section('title', 'Cadastrar Pessoa')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header text-center fw-bold">
                Cadastrar Pessoa
            </div>
            <div class="card-body">
                <form action="{{ url('/pessoas') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" name="telefone" id="telefone" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-dark w-100">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
