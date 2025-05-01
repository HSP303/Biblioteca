<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PessoaController extends Controller
{
    private string $apiurl;
    private Client $client;

    function __construct() {
        $this->apiurl = "http://localhost:8080/pessoas";
    }

    public function getPessoa() {
        $this->client = new Client();
        try {
            $response = $this->client->get($this->apiurl);
            $data = json_decode($response->getBody(), true); 
            return var_dump($data);
        } catch (Exception $e) { 
            return view('api_error', ['error' => $e->getMessage()]); 
        } 
    }

    public function listaPessoas() {
        $this->client = new Client();
        try {
            $response = $this->client->get($this->apiurl);
            $data = json_decode($response->getBody(), true);
            return view('pessoas.lista', ['pessoas' => $data]);
        } catch (Exception $e) {
            return view('api_error', ['error' => $e->getMessage()]);
        }
    }

    public function postPessoa(Request $request) {
        $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'telefone' => 'nullable|string|max:20'
        ]);

        $this->client = new Client();

        try {
            $this->client->request(
                'POST',
                $this->apiurl,
                [
                    'json' => [
                        'nome' => $request->input('nome'),
                        'email' => $request->input('email'),
                        'telefone' => $request->input('telefone')
                    ]
                ]
            );

            $response = $this->client->get($this->apiurl);
            $data = json_decode($response->getBody(), true);

            return view('pessoas.lista', ['pessoas' => $data]);

        } catch (Exception $e) {
            return view('api_error', ['error' => $e->getMessage()]);
        }
    }
}

?>