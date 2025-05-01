<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use  GuzzleHttp\Client ; 
use Illuminate\Support\Collection;

class LivroController extends Controller
{
    private string $apiurl;
    private Client $client;

    function __construct() {
        $this->apiurl = "http://localhost:8080/livros";
    }

    public function getLivro(){
        $this->client = new Client();
        try {
            $response = $this->client -> get($this->apiurl);
    
            $data = json_decode ( $response -> getBody (), true ); 

            $collection = collect();

            foreach ($data as $json) {
                $collection->push(Collection::fromJson(json_encode($json)));  
            }
            //$collection = $collection->get(1);
            return view ( 'lista' , compact('collection'));
            //return view ('lista')->with('collection', $collection);
        } catch (Exception  $e ) { 
            return  view ( 'api_error' , [ 'error' => $e -> getMessage ()]); 
        } 
    }

    /*
    public function listaLivros() 
    {
        $this->client = new Client();
        try {
            $responde = $this->client->get($this->apiurl);
            $data = json_decode($responde->getBody(), true);

            return view('livros.lista', ['livros' => $data]);
        } catch (Exception $e) {
            return view('api_error', ['error' => $e->getMessage()]);
        }
    } em construção ainda */
    
 public function postLivro(Request $request){
        $request->validate([
            'titulo' => 'required|string|max:100',
            'autor' => 'required|string|max:100',
            'ano' => 'required|integer',
            'edicao' => 'required|integer'
        ]);
    
        $this->client = new Client();
    
        try {
            $this->client->request(
                'POST', 
                $this->apiurl, 
                [
                    'json' => [
                        'titulo' => $request->input('titulo'),
                        'autor' => $request->input('autor'),
                        'ano' => $request->input('ano'),
                        'edicao' => $request->input('edicao')
                    ]
                ]
            );
    
            // Recarrega os dados após salvar
            $response = $this->client->get($this->apiurl);
            $data = json_decode($response->getBody(), true); 
    
            $collection = collect();

            foreach ($data as $json) {
                $collection->push(Collection::fromJson(json_encode($json)));  
            }
            //$collection = $collection->get(1);
            return view ( 'lista' , compact('collection'));
    
        } catch (Exception $e) { 
            return view('api_error', ['error' => $e->getMessage()]); 
        } 
    }
}