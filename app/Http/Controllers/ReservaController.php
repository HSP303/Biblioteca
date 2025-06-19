<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use DateTimeZone;

class ReservaController extends Controller
{
    private string $apiUrl;
    private Client $client;

    public function __construct() {
        $this->apiUrl = 'http://localhost:8080/reservas';
        $this->client = new Client();
    }

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
             
           // return view ( 'lista' , compact('collection'));
            return redirect()->route('reserva.lista');
        } catch (Exception $e) { 
            return view('api_error', ['error' => $e->getMessage()]); 
        } 
    }

    public function deleteReserva($id) {
        try{
            $this->client = new Client();

            $reservasResponse = $this->client ->get('http://localhost:8080/reservas/'.$id);

            $reserva = json_decode($reservasResponse->getBody()->getContents(), true);

            $timezone = new DateTimeZone('America/Sao_Paulo');
            $hoje = new DateTime('now', $timezone);
            
            $multa = $this->calcularMulta($reserva['dataFim'], $hoje);
            
            $hoje = $hoje->format('Y-m-d');
            $pessoaId = $reserva['pessoa']['id'];
        } catch (Exception $e) { 
                return view('api_error', ['error' => $e->getMessage()]); 
            }

        if($multa > 0){
            try {
                $this->client->request(
                    'POST', 
                    'http://localhost:8080/multas', 
                    [
                        'json' => [
                            'valor' => $multa,
                            'descricao' => 'Atraso',
                            'dataMulta' => $hoje,
                            'Pago' => false,
                            'pessoaId' => $pessoaId
                        ]
                    ]
                );

            }
            catch (Exception $e) { 
                return view('api_error', ['error' => $e->getMessage()]); 
            }
        }
        try {
            $this->client->delete($this->apiUrl . '/' . $id);

            return redirect('/reserva/lista')->with('success', 'Livro devolvido com sucesso!');
        } catch (Exception $e) {
            return view('api_error', ['error' => $e->getMessage()]);
        }
    }

    private function calcularMulta($dataFim, $hoje){
        $multa = 7;

        $dataValidade = new DateTime($dataFim);

        // Normaliza ambas as datas para o mesmo horário (meia-noite) para evitar diferenças de horas/minutos
        $dataValidade->setTime(0, 0, 0);
        $hoje->setTime(0, 0, 0);

        $diasMulta = $dataValidade->diff($hoje);
        if($diasMulta->days > 0 && ($dataValidade < $hoje)){
            $multa += ($diasMulta->days) * 0.5;    
        } else {
            $multa = 0;
        }
        return $multa; // Retorna o total absoluto de dias
    }

}
