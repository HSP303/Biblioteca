<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cadastro de Livro</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h3>Cadastrar Livro</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('livro.post') }}" method="post">
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
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
