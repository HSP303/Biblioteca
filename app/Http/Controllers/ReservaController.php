<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use  GuzzleHttp\Client ;
use Illuminate\Support\Collection;

class ReservaController extends Controller
{
    private string $apiurl;
    private Client $client;

    function __construct() {
        $this->apiurl = "http://localhost:8080/reservas";
    }
   /* public function index(){
        return view ('reserva.create');
    }*/

    public function index() {
    $client = new Client();

    try {
        $livrosResponse = $client->get('http://localhost:8080/livros');
        $pessoasResponse = $client->get('http://localhost:8080/pessoas');

        $livros = json_decode($livrosResponse->getBody()->getContents(), true);
        $pessoas = json_decode($pessoasResponse->getBody()->getContents(), true);

        return view('reserva.create', compact('livros', 'pessoas'));
    } catch (Exception $e) {
        return view('api_error', ['error' => $e->getMessage()]);
    }
}


    public function postReserva(Request $request){
        $request->validate([
            'livro' => 'required|integer',
            'pessoa' => 'required|integer'
        ]);
    
        $this->client = new Client();
    
        try {
            $this->client->request(
                'POST', 
                $this->apiurl, 
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
