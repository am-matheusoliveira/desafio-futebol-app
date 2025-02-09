<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use function Psy\debug;

class TimeController extends Controller{
        
    /**
     * Método responsável por exibir a página inicial de jogos.
     *
     * @author MATHEUS PEREIRA
     * 
     * @return \Illuminate\View\View
     */
    public function index(){
        
        // RETORNANDO A VIEW 'times.index'
        return view('times.index');
    }
    
    /**
     * Método responsável por buscar um time na API com base no nome informado pelo usuário.
     *
     * @author MATHEUS PEREIRA
     *
     * @param \Illuminate\Http\Request
     * 
     * @return \Illuminate\View\View
     */
    public function buscar(Request $request){
        
        // INICIANDO VARIÁVEL
        $nome_time = '';
        
        // VALIDANDO OS DADOS RECEBIDOS DA REQUISIÇÃO
        if($request->has('nome_time') && !empty($request->nome_time)){
            // RECUPERANDO O NOME DO TIME DIGITADO PELO USUÁRIO
            $nome_time = $request->nome_time;
        }else{
            // RETORNANDO UM JSON COM UMA MENSAGEM DE AVISO
            return response()->json([
                'typeAlert' => 'Aviso',
                'colorAlert' => 'yellow',
                'messageAlert' => 'Nenhum time foi informado. Digite um nome no campo acima e tente novamente!'], 200);
        }

        // OBTENDO A CHAVE DA API
        $apiKey = env('API_FOOTBALL_KEY');
        
        // FAZENDO UMA REQUISIÇÃO GET PARA BUSCAR O TIME PELO NOME INFORMADO
        $response = Http::withHeaders([
            'x-apisports-key' => $apiKey
        ])->get('https://v3.football.api-sports.io/teams', [
            'search' => $nome_time
        ]);
        
        // CONVERTENDO A RESPOSTA DA API PARA UM ARRAY ASSOCIATIVO
        $dados = $response->json();

        // VERIFICANDO SE A API RETORNOU ALGUM ERRO
        if (isset($dados['errors']) && !empty($dados['errors'])) {
            return response()->json([
                'typeAlert' => 'Erro',
                'colorAlert' => 'red',
                'messageAlert' => 'Holve algum erro na busca pelos times. Por favor tente novamente mais tarde.'], 200);
        }     
        
        // PEGANDO A LISTA DE TIMES RETORNADOS PELA API
        $times = $dados['response'];
        
        // VERIFICANDO SE EXISTEM TIMES DISPONÍVEIS PARA EXIBIÇÃO
        if (empty($times)) {
            return response()->json([
                'typeAlert' => 'Aviso',
                'colorAlert' => 'yellow',
                'messageAlert' => 'Nenhum time encontrado para o termo digitado.'
            ], 200);
        }

        // FORMATANDO OS DADOS DOS JOGOS PARA EXIBIÇÃO
        $timesFormatados = array_map(function ($time) use ($nome_time){
            return [
                'time_logo' => $time['team']['logo']    ?? 'https://media.api-sports.io/football/teams/22721.png',
                'time_nome' => $time['team']['name']    ?? 'Desconhecido',
                'time_pais' => $time['team']['country'] ?? 'Desconhecido',
                'time_id'   => $time['team']['id']      ?? 0,
                'rota'      => route('jogos.porTime', $time['team']['id'] ?? 0), 
                'nome_time' => $nome_time              
            ];
        }, $times);
       
        // RETORNANDO A LISTA DE JOGOS FORMATADA EM JSON
        return response()->json($timesFormatados);
    }
}