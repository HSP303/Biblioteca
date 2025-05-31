<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;
use GuzzleHttp\Client;

class ReservaController extends Controller
{
    private string $apiUrl;
    private Client $client;

    public function __construct() {
        $this->apiUrl = 'http://localhost:8080';
        $this->client = new Client();
    }

    // Carrega a view de criação com as pessoas (vindo da API Java)
    public function index($idlivro): View {
        try {
            $response = $this->client->get($this->apiUrl . '/pessoas');
            $pessoas = json_decode($response->getBody(), true);

            return view('reserva.create', [
                'idlivro' => $idlivro,
                'pessoas' => $pessoas
            ]);
        } catch (Exception $e) {
            return view('api_error', ['error' => $e->getMessage()]);
        }
    }

    // Envia a reserva para o backend Java
    public function postReserva(Request $request): View {
        $request->validate([
            'livro' => 'required|integer',
            'pessoa' => 'required|integer'
        ]);

        try {
            $this->client->request(
                'POST',
                $this->apiUrl . '/reservas',
                [
                    'json' => [
                        'livroId' => $request->input('livro'),
                        'pessoaId' => $request->input('pessoa')
                    ]
                ]
            );

            return view('welcome'); // ou redirecionamento com mensagem
        } catch (Exception $e) {
            return view('api_error', ['error' => $e->getMessage()]);
        }
    }
}
