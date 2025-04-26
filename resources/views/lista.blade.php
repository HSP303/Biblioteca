<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Livros</title>
</head>
<body>
    <h1>Livros Cadastrados</h1>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Ano</th>
                <th>Edição</th>
                <th>Reservado</th>
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
                    <!--<td>{{ $livro['reservado'] ? 'Sim' : 'Não' }}</td> deixando comentado por enquanto esse atributo-->
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
