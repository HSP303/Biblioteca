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
            'endereco' => 'required|string|max:255',
            'tel' => 'nullable|string|max:20'
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
                        'endereco' => $request->input('endereco'),
                        'tel' => $request->input('tel')
                    ]
                ]
            );

            $response = $this->client->get($this->apiurl);
            $data = json_decode($response->getBody(), true);

            return view('pessoas.lista', ['pessoas' => $data]);

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $body = $response->getBody()->getContents();
        
            $decoded = json_decode($body, true);
            $message = $decoded['message'] ?? $body;
        
            return view('api_error', ['error' => $message]);
        } catch (Exception $e) {
            return view('api_error', ['error' => $e->getMessage()]);
        }
        
    }

    public function deletePessoa($id) {
        $this->client = new Client();
        try {
            $this->client->delete($this->apiurl . '/' . $id);
            return redirect()->route('pessoas.lista')->with('success', 'Pessoa excluída com sucesso!');
        } catch (Exception $e) {
            return view('api_error', ['error' => $e->getMessage()]);
        }
    }
    public function editPessoa($id) {
        $this->client = new Client();
        try {
            $response = $this->client->get($this->apiurl . '/' . $id);
            $data = json_decode($response->getBody(), true);
            return view('pessoas.edit', ['pessoa' => $data]);
        } catch (Exception $e) {
            return view('api_error', ['error' => $e->getMessage()]);
        }
    }

    public function updatePessoa(Request $request, $id) {
        $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'endereco' => 'required|string|max:255',
            'tel' => 'nullable|string|max:20'
        ]);

        $this->client = new Client();

        try {
            $this->client->put($this->apiurl . '/' . $id, [
                'json' => [
                    'nome' => $request->input('nome'),
                    'email' => $request->input('email'),
                    'enredeco' => $request->input('endereco'),
                    'tel' => $request->input('tel')
                ]
            ]);

            return redirect()->route('pessoas.lista')->with('success', 'Pessoa atualizada com sucesso!');
        } catch (Exception $e) {
            return view('api_error', ['error' => $e->getMessage()]);
        }
    }

}

?>