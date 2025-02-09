<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CampeonatoController extends Controller{
    
    /**
     * Método responsável por obter os campeonatos da API e filtrar os dados conforme os anos permitidos pelo plano gratuito.
     *
     * @author MATHEUS PEREIRA
     * 
     * @return \Illuminate\View\View
     */
    public function index(){
        
        // OBTENDO A CHAVE DA API
        $apiKey = env('API_FOOTBALL_KEY');
        
        // FAZENDO UMA REQUISIÇÃO GET PARA BUSCAR OS CAMPEONATOS
        $response = Http::withHeaders([
            'x-apisports-key' => $apiKey
        ])->get('https://v3.football.api-sports.io/leagues');
        
        // CONVERTENDO A RESPOSTA DA API PARA UM ARRAY ASSOCIATIVO
        $ligas = $response->json();
        
        // VALIDANDO OS DADOS DA API
        if(isset($ligas) && empty($ligas['errors'])){
            // EXTRAINDO APENAS O ARRAY DE LIGAS DA RESPOSTA
            $ligas = $ligas['response'];
            
            // DEFININDO OS ANOS PERMITIDOS (LIMITAÇÃO DO PLANO GRATUITO DA API)
            $anosPermitidos = [2021, 2022, 2023];
            
            // FILTRANDO AS LIGAS E SUAS TEMPORADAS
            $ligasFiltradas = collect($ligas)->map(function ($liga) use ($anosPermitidos) {
                return [
                    'league' => $liga['league'],   // INFORMAÇÕES DA LIGA (NOME, LOGO, ID)
                    'country' => $liga['country'], // PAÍS DA LIGA
                    'seasons' => collect($liga['seasons'])
                        ->whereIn('year', $anosPermitidos) // FILTRA APENAS TEMPORADAS DENTRO DOS ANOS PERMITIDOS
                        ->values()
                        ->all()
                ];
            })->filter(function ($liga) {
                return !empty($liga['seasons']); // REMOVENDO LIGAS QUE NÃO POSSUEM TEMPORADAS DENTRO DOS ANOS PERMITIDOS
            })->values()->all();
        }else{
            // RETORNANDO A VIEW 'campeonatos.index' COM UMA MENSAGEM DE ERRO E UM ARRAY VAZIO
            return view('campeonatos.index', [
                'typeAlert' => 'Erro',
                'colorAlert' => 'red',
                'messageAlert' => 'Nenhum campeonato disponível no momento. Por favor, tente novamente mais tarde.',
                'ligasFiltradas' => []
            ]);
        }
        
        // RETORNANDO A VIEW 'campeonatos.index' COM OS CAMPEONATOS FILTRADOS
        return view('campeonatos.index', compact('ligasFiltradas'));
    }
    
    /**
     * Método responsável por processar a seleção de um campeonato e temporada,
     * armazenando os dados na sessão e redirecionando para a página de jogos.
     *
     * @author MATHEUS PEREIRA
     * 
     * @param \Illuminate\Http\Request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function selecionarCampeonato(Request $request){

        // OBTENDO O ID, NOME DO CAMPEONATO E O ANO DA TEMPORADA A PARTIR DO FORMULÁRIO
        $temporada       = $request->input('temporada');
        $campeonatoId    = $request->input('campeonato_id');
        $campeonato_nome = $request->input('campeonato_nome');
        
        // VERIFICANDO SE OS PARÂMETROS FORAM ENVIADOS CORRETAMENTE
        if (!$campeonatoId || !$temporada || !$campeonato_nome) {
            // RETORNANDO UMA MENSAGEM DE AVISO
            return redirect()->back()->with([
                    'typeAlert' => 'Aviso',
                    'colorAlert' => 'yellow',
                    'messageAlert' => 'Por favor, selecione um campeonato e uma temporada válida.',
                ]);
        }
        
        // SALVANDO OS DADOS NA SESSÃO PARA SEREM UTILIZADOS EM OUTROS LOCAIS 
        session([
            'campeonato_id'   => $campeonatoId,
            'temporada'       => $temporada,
            'campeonato_nome' => $campeonato_nome
        ]);

        // REDIRECIONA PARA A PÁGINA DOS PRÓXIMOS JOGOS DESSE CAMPEONATO
        return redirect()->route('jogos.index');
    }
}