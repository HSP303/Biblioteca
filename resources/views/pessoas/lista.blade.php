<h1>Lista de Pessoas</h1>

@section('content')
    <h1>Lista de Pessoas</h1>

    @if (isset($pessoas) && count($pessoas) > 0)
        <ul>
            @foreach ($pessoas as $pessoa)
                <li>{{ $pessoa['nome'] }} - {{ $pessoa['email'] }}</li>
            @endforeach
        </ul>
    @else
        <p>Nenhuma pessoa cadastrada.</p>
    @endif
@endsection
