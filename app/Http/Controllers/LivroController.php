<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use  GuzzleHttp\Client ; 

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
        return var_dump($data);
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
            'ano' => 'required|integer', //alterei de number para integer, para tratar os erros que ocorriam com os tipos numéricos
            'edicao' => 'required|integer'// alterei também, Pedro
        ]);

        $this->client = new Client();

        try {
            $request = $this->client -> request(
                'POST', 
                $this->apiurl, 
                ['json' => ['titulo' => 'teste',//'$request->input('titulo')', 
                            'autor' => 'teste',//$request->input('autor'), 
                            'ano' => 2000,////$request->input('ano'), 
                            'edicao' => 1]]);//$request->input('edicao')]]);

            $response = $this->client -> get($this->apiurl);
            /*{
{
	"titulo":"Biblia",
	"autor":"Indefinido",
	"ano":"0000",
	"edicao":"1"
}
}*/ 
            $data = json_decode ( $response -> getBody (), true ); 
            return var_dump($data);
        } catch (Exception  $e ) { 
            // Manipule quaisquer erros que ocorram durante a solicitação da API 
            return  view ( 'api_error' , [ 'error' => $e -> getMessage ()]); 
        } 
    }
}