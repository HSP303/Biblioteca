<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class ReservaController extends Controller
{
    private string $apiUrl;
    private Client $client;

    public function __construct() {
        $this->apiUrl = 'http://localhost:8080/reservas';
        $this->client = new Client();
    }

    // carrega a view de criação com as pessoas (la do java)
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

    public function getReserva(){
        $this->client = new Client();
        try {
            $response = $this->client -> get($this->apiUrl);
    
            $data = json_decode ( $response -> getBody (), true ); 

            $collection = collect();

            foreach ($data as $obj) {
                $collection->push(Collection::fromJson(json_encode($obj))); 
            }

            //return dd($collection);
            //$collection = $collection->get(1);
            return view('reserva.lista', ['reservas' => $collection]);
            //return view ('lista')->with('collection', $collection);
        } catch (Exception  $e ) { 
            return  view ( 'api_error' , [ 'error' => $e -> getMessage ()]); 
        } 
    }

    /*public function postReserva(Request $request): View {
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
    }*/

    public function postReserva(Request $request){
        $request->validate([
            'livro' => 'required|integer',
            'pessoa' => 'required|integer'
        ]);
    
        $this->client = new Client();
    
        try {
            $this->client->request(
                'POST', 
                $this->apiUrl, 
                [
                    'json' => [
                        'livroId' => $request->input('livro'),
                        'pessoaId' => $request->input('pessoa')
                    ]
                ]
            );
    
            //$collection = $collection->get(1);
            return view('welcome');
           // return view ( 'lista' , compact('collection'));
    
        } catch (Exception $e) { 
            return view('api_error', ['error' => $e->getMessage()]); 
        } 
    }

}
