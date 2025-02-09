<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use function Psy\debug;

class JogoTimeController extends Controller{
    
    /**
     * Método responsável por buscar os jogos futuros e os últimos resultados de um time específico.
     *
     * @author MATHEUS PEREIRA
     *
     * @param \Illuminate\Http\Request
     * @param int
     * 
     * @return \Illuminate\View\View
     */
    public function index(Request $request, $teamId){
        
        // OBTENDO A CHAVE DA API DO ARQUIVO .ENV
        $apiKey = env('API_FOOTBALL_KEY');
        
        // OBTENDO O ANO SELECIONADO PELO USUÁRIO A PARTIR DA REQUISIÇÃO
        $anoPermitido = $request->input('ano');
        
        // VERIFICANDO SE OS PARÂMETROS FORAM ENVIADOS CORRETAMENTE
        if (!$teamId || !$anoPermitido) {
            // RETORNANDO A VIEW 'times.jogos' COM UMA MENSAGEM DE AVISO E UM ARRAY VAZIO
            return view('times.jogos', [
                    'typeAlert' => 'Aviso',
                    'colorAlert' => 'yellow',
                    'messageAlert' => 'Nenhum Time ou Temporada definido. Não foi possível listar os Jogos do Time.',
                    'jogosFuturos' => [],
                    'ultimosResultados' => []
                ]);
        }

        // FAZENDO UMA REQUISIÇÃO GET PARA BUSCAR OS JOGOS FUTUROS DO TIME SELECIONADO
        $responseFuturos = Http::withHeaders([
            'x-apisports-key' => $apiKey
        ])->get('https://v3.football.api-sports.io/fixtures', [
            'team' => $teamId,
            'season' => $anoPermitido,
            'status' => 'NS' // "NS" SIGNIFICA JOGOS NÃO INICIADOS (FUTUROS)
        ]);
        
        // CONVERTENDO A RESPOSTA DA API PARA UM ARRAY ASSOCIATIVO
        $responseRequest = $responseFuturos->json();
        
        // INICIANDO VARIÁVEL
        $jogosFuturos = null;
        
        // VALIDANDO OS DADOS DA API
        if(isset($responseRequest) && !empty($responseRequest['response'])){
            // EXTRAINDO APENAS A LISTA DE RESULTADOS DA RESPOSTA DA API
            $jogosFuturos = [
                'jogosFuturos' => $responseRequest['response']
            ];            
        }else if(isset($responseRequest) && !empty($responseRequest['errors'])){
            // ERRO NA REQUISIÇÃO
            $jogosFuturos = [
                'typeAlert' => 'Erro',
                'colorAlert' => 'red',
                'messageAlert' => 'Houve algum erro ao buscar os Jogos Futuros para o Time Fornecido. Por favor, tente novamente mais tarde.',
                'jogosFuturos' => []
            ];
        }else{
            // API NÃO RETORNOU DADOS
            $jogosFuturos = [
                'typeAlert' => 'Aviso',
                'colorAlert' => 'yellow',
                'messageAlert' => 'Não foram encontrados Jogos Futuros para o Time Fornecido. Tente com outro Time.',
                'jogosFuturos' => []
            ];
        }
        
        // FAZ UMA REQUISIÇÃO GET PARA BUSCAR OS ÚLTIMOS RESULTADOS DO TIME SELECIONADO
        $responseResultados = Http::withHeaders([
            'x-apisports-key' => $apiKey
        ])->get('https://v3.football.api-sports.io/fixtures', [
            'team' => $teamId,
            'season' => $anoPermitido,
            'status' => 'FT' // "FT" SIGNIFICA JOGOS FINALIZADOS (ÚLTIMOS RESULTADOS)
        ]);
                
        // CONVERTENDO A RESPOSTA DA API PARA UM ARRAY ASSOCIATIVO
        $responseRequest = $responseResultados->json();
        
        // INICIANDO VARIÁVEL
        $ultimosResultados = null;

        // VALIDANDO OS DADOS DA API
        if(isset($responseRequest) && !empty($responseRequest['response'])){
            // EXTRAINDO APENAS A LISTA DE RESULTADOS DA RESPOSTA DA API
            $ultimosResultados = [
                'ultimosResultados' => $responseRequest['response']
            ];
        }else if(isset($responseRequest) && !empty($responseRequest['errors'])){
            // ERRO NA REQUISIÇÃO
            $ultimosResultados = [
                'typeAlert' => 'Erro',
                'colorAlert' => 'red',
                'messageAlert' => 'Houve algum erro ao buscar os Últimos Resultados para o Time Fornecido. Por favor, tente novamente mais tarde.',
                'ultimosResultados' => []
            ];
        }else{
            // API NÃO RETORNOU DADOS
            $ultimosResultados = [
                'typeAlert' => 'Aviso',
                'colorAlert' => 'yellow',
                'messageAlert' => 'Não foram encontrados Últimos Resultados para o Time Fornecido. Tente com outro Time.',
                'ultimosResultados' => []
            ];
        }

        // RETORNANDO A VIEW 'times.jogos' COM OS JOGOS FUTUROS E ÚLTIMOS RESULTADOS
        return view('times.jogos', compact('jogosFuturos', 'ultimosResultados'));
    }
}
