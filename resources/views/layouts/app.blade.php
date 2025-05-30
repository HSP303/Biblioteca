<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Minha Biblioteca')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/opt/lampp/htdocs/Trabalho_PW/Biblioteca/resources/css/reserva.css') }}">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('welcome') }}">
                <img src="{{ asset('images/umbrellacorporation.png') }}" alt="Umbrella Logo" width="30" class="me-2">
                <span>Raccoon Books</span>
            </a> 
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/livro') }}" target="_blank">
                            <i class="bi bi-plus-square"></i> Cadastrar Livro
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/livro/lista') }}" target="_blank">
                            <i class="bi bi-book"></i> Lista de Livros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/pessoas/cadastrar') }}" target="_blank">
                            <i class="bi bi-person-plus"></i> Cadastrar Pessoa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/pessoas/lista') }}" target="_blank">
                            <i class="bi bi-person-lines-fill"></i> Lista de Pessoas
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- conteudo principal -->
    <div class="container mt-5">
        @yield('content')
    </div>

    <!--bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>
</html>