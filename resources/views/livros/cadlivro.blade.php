@extends('layouts.app')

@section('title', 'Cadastrar Livro')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header text-center fw-bold">
                Cadastrar Livro
            </div>
            <div class="card-body">
                <form action="{{ route('livro.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" id="titulo" name="titulo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <input type="text" id="autor" name="autor" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="ano" class="form-label">Ano</label>
                        <input type="number" id="ano" name="ano" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edicao" class="form-label">Edição</label>
                        <input type="number" id="edicao" name="edicao" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
