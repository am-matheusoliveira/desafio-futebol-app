<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JogoController extends Controller{
    
    /**
     * Método responsável por exibir a página inicial de jogos.
     *
     * @author MATHEUS PEREIRA
     * 
     * @return \Illuminate\View\View
     */
    public function index(){

        // RETORNANDO A VIEW 'jogos.index'
        return view('jogos.index');
    }
    
    /**
     * Método responsável por buscar e listar os jogos futuros de um campeonato selecionado.
     *
     * @author MATHEUS PEREIRA
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function jogosListar(){
        
        // OBTENDO A CHAVE DA API
        $apiKey = env('API_FOOTBALL_KEY');
        
        // OBTENDO O ID DO CAMPEONATO E A TEMPORADA SELECIONADA NA SESSÃO
        $campeonatoId = session('campeonato_id');
        $temporada = session('temporada');
        
        // VERIFICANDO SE OS DADOS NECESSÁRIOS ESTÃO PRESENTES NA SESSÃO
        if (!$campeonatoId || !$temporada) {
            // RETORNANDO UM JSON COM UMA MENSAGEM DE AVISO
            return response()->json([
                'typeAlert' => 'Aviso',
                'colorAlert' => 'yellow',
                'messageAlert' => 'Nenhum campeonato definido. Não foi possível listar os jogos.'], 200);
        }
        
        // FAZENDO UMA REQUISIÇÃO GET PARA BUSCAR OS JOGOS FUTUROS DESSE CAMPEONATO E TEMPORADA
        $response = Http::withHeaders([
            'x-apisports-key' => $apiKey
        ])->get('https://v3.football.api-sports.io/fixtures', [
            'league' => $campeonatoId,
            'season' => $temporada,
        ]);
        
        // CONVERTENDO A RESPOSTA DA API PARA UM ARRAY ASSOCIATIVO
        $dados = $response->json();
        
        // VERIFICANDO SE A API RETORNOU ALGUM ERRO
        if (isset($dados['errors']) && !empty($dados['errors'])) {
            return response()->json([
                'typeAlert' => 'Erro',
                'colorAlert' => 'red',
                'messageAlert' => 'Holve algum erro na busca pelos jogos. Por favor tente novamente mais tarde.'], 200);
        }
        
        // PEGANDO A LISTA DE JOGOS RETORNADOS PELA API
        $jogos = $dados['response'];

        // VERIFICANDO SE EXISTEM JOGOS DISPONÍVEIS PARA EXIBIÇÃO
        if (empty($jogos)) {
            return response()->json([
                'typeAlert' => 'Aviso',
                'colorAlert' => 'yellow',
                'messageAlert' => 'Nenhum jogo encontrado para este campeonato.'
            ], 200);
        }
        
        // FORMATANDO OS DADOS DOS JOGOS PARA EXIBIÇÃO
        $jogosFormatados = array_map(function ($jogo) {
            return [
                'time_casa_logo'      => $jogo['teams']['home']['logo']    ?? 'https://media.api-sports.io/football/teams/22721.png',
                'time_visitante_logo' => $jogo['teams']['away']['logo']    ?? 'https://media.api-sports.io/football/teams/22721.png',
                'time_casa'           => $jogo['teams']['home']['name']    ?? 'Desconhecido',
                'time_visitante'      => $jogo['teams']['away']['name']    ?? 'Desconhecido',
                'data_hora'           => $jogo['fixture']['date']          ?? 'Data não disponível',
                'estadio'             => $jogo['fixture']['venue']['name'] ?? 'Estádio não disponível',
            ];
        }, $jogos);
        
        // RETORNANDO A LISTA DE JOGOS FORMATADA EM JSON
        return response()->json($jogosFormatados);
    }
    
    /**
     * Método responsável por listar os resultados de jogos finalizados de um campeonato selecionado.
     *
     * @author MATHEUS PEREIRA
     *
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function listarResultados($leagueId){

        // OBTENDO A CHAVE DA API
        $apiKey = env('API_FOOTBALL_KEY');

        // OBTENDO A TEMPORADA SELECIONADA PELO USUÁRIO NA SESSÃO
        $temporada = session('temporada');
        
        // VERIFICANDO SE OS PARÂMETROS FORAM DEFINIDOS CORRETAMENTE
        if (!$leagueId || !$temporada) {
            // RETORNANDO A VIEW 'jogos.resultados' COM UMA MENSAGEM DE AVISO E UM ARRAY VAZIO
            return view('jogos.resultados', [
                    'typeAlert' => 'Aviso',
                    'colorAlert' => 'yellow',
                    'messageAlert' => 'Nenhum campeonato definido. Não foi possível listar os últimos resultados.',
                    'resultados' => []
                ]);
        }        

        // FAZENDO UMA REQUISIÇÃO GET PARA BUSCAR OS JOGOS FINALIZADOS DO CAMPEONATO SELECIONADO
        $response = Http::withHeaders([
            'x-apisports-key' => $apiKey
        ])->get("https://v3.football.api-sports.io/fixtures", [
            'league' => $leagueId,
            'season' => $temporada,
            'status' => 'FT' // "FT" SIGNIFICA QUE O JOGO TERMINOU
        ]);
        
        // CONVERTENDO A RESPOSTA DA API PARA UM ARRAY ASSOCIATIVO
        $responseRequest = $response->json();
        
        // INICIANDO VARIÁVEL
        $resultados = null;

        // VALIDANDO OS DADOS DA API
        if(isset($responseRequest) && empty($responseRequest['errors'])){
            // EXTRAINDO APENAS A LISTA DE RESULTADOS DA RESPOSTA DA API
            $resultados = [
                'typeAlert' => '',
                'resultados' => $responseRequest['response']
            ];
        }else{
            // RETORNANDO A VIEW 'jogos.resultados' COM UMA MENSAGEM DE ERRO E UM ARRAY VAZIO
            return view('jogos.resultados', [
                'typeAlert' => 'Erro',
                'colorAlert' => 'red',
                'messageAlert' => 'Houve algum erro ao buscar os Últimos Resultados para o Campeonato Fornecido. Por favor, tente novamente mais tarde.',
                'resultados' => []
            ]);
        }
        
        // RETORNA A VIEW 'jogos.resultados' COM OS RESULTADOS OBTIDOS
        return view('jogos.resultados', compact('resultados'));
    }
}