<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Exception;

class MultasController extends Controller
{
    public function index() {
        $client = new Client();

        try {
            $response = $client->get('http://localhost:8080/multas');

            $multas = json_decode($response->getBody()->getContents(), true);
            
            //return dd($multas);
            return view('multas.lista', compact('multas'));
        } catch (Exception $e) {
            return view('api_error', ['error' => $e->getMessage()]);
        }
    }

    public function editMultas($id) {
        $client = new Client();

        try {
            $response = $client->get('http://localhost:8080/multas/' . $id);

            $multa = json_decode($response->getBody()->getContents(), true);

            //return dd($multas);
            return view('multas.edit', compact('multa'));
        } catch (Exception $e) {
            return view('api_error', ['error' => $e->getMessage()]);
        }
    }

    public function putMultas(Request $request) {
        $request->validate([
            'id' => 'required|integer',
            'descricao' => 'required|string',
            'dataMulta' => 'required|date',
            'valor' => 'required|numeric'
        ]);
        $client = new Client();

        try {
            $client->request(
                'PUT', 
                'http://localhost:8080/multas/'.$request->input('id'), 
                [
                    'json' => [
                        'valor' => $request->input('valor'),
                        'descricao' => $request->input('descricao'),
                        'dataMulta' => $request->input('dataMulta'),
                        'pago' => (bool) $request->input('pago')
                    ]
                ]
            );
            return redirect('/multas')->with('success', 'Multa alterada com sucesso!');

        }
        catch (Exception $e) { 
            return view('api_error', ['error' => $e->getMessage()]); 
        }
    }

    public function deleteMultas($id) {
        $client = new Client();

        try {
            $client->request(
                'DELETE', 
                'http://localhost:8080/multas/'.$id
            );
            return redirect('/multas')->with('success', 'Multa excluida com sucesso!');

        }
        catch (Exception $e) { 
            return view('api_error', ['error' => $e->getMessage()]); 
        }
    }

    public function pagarMultas(Request $request, $id) {
        $request->validate([
            'data' => 'required|date',
            'valor' => 'required|numeric',
            'descricao' => 'required|string'
        ]);
        $client = new Client();

        try {
            $client->request(
                'PUT', 
                'http://localhost:8080/multas/'.$id, 
                [
                    'json' => [
                        'pago' => true,
                        'valor' => $request->input('valor'),
                        'dataMulta' => $request->input('data'),
                        'descricao' => $request->input('descricao')
                    ]
                ]
            );
            return redirect('/multas')->with('success', 'Multa paga com sucesso!');

        }
        catch (Exception $e) { 
            return view('api_error', ['error' => $e->getMessage()]); 
        }
    }
}
