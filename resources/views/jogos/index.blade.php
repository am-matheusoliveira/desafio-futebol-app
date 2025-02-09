<x-app-layout>
        
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Jogos do Campeonato') }}
        </h2>
    </x-slot>
    
    <x-slot name="slot">
        <!-- <div class="container mx-auto px-4 py-8"> -->    
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 container">

            <!-- Botão de Voltar -->
            <div class="mb-4 flex justify-between">
                <a href="{{ route('campeonatos.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-semibold text-sm rounded-lg shadow">
                    Voltar para Campeonatos
                </a>
                
                @if(session('campeonato_id'))
                    <a href="{{ route('jogos.resultados', session('campeonato_id')) }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg hidden" id="btn-ultimos-resultados">
                        Ver Últimos Resultados
                    </a>
                @endif
            </div>
            
            @if(session('campeonato_id'))
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 hidden" id="card-container-jogos">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white text-center">
                        Próximos Jogos - <span class="text-blue-500">{{ session('temporada') }}</span>
                    </h2>
                    <p class="text-center text-gray-500 dark:text-gray-400 mt-2">
                        Campeonato: <span class="font-semibold">{{ session('campeonato_nome') }}</span>
                    </p>
                    
                    <div id="jogos-container" class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Os jogos serão carregados aqui via JavaScript -->
                    </div>
                </div>
            @endif
            
            <div class="hidden mt-5" id="card-alert">
                <!-- As Mensagens de alertas ou erros seram carregadas aqui -->
            </div>
        </div>
            
        <!-- Script para busca e renderização dos Cards com os Jogos -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Pegando os elementos "jogosContainer", "btnUltimosResultados" & "cardContainerJogos" peloID           
                const jogosContainer       = document.getElementById("jogos-container");
                const btnUltimosResultados = document.getElementById("btn-ultimos-resultados");
                const cardContainerJogos   = document.getElementById("card-container-jogos");
                
                // Realizando requisição HTTP
                fetch("{{ route('jogos.listar') }}")
                    .then(response => response.json())
                    .then(data => {
                    
                    // Verificando se "data.messageAlert" foi definida
                    if (data.messageAlert) {                        
                        // Pegando o elemento "cardAlert" pelo ID
                        const cardAlert = document.getElementById("card-alert");
                        
                        // Removendo a classe "hidden" do elemento cardAlert
                        cardAlert.classList.remove('hidden');
                        
                        // Criando novo elemento HTML - Mensagem de alerta
                        cardAlert.innerHTML = `
                            <div role="alert">
                                <div class="bg-${data.colorAlert}-500 text-white font-bold rounded-t px-4 py-2">
                                    ${data.typeAlert}
                                </div>
                                <div class="border border-t-0 border-${data.colorAlert}-400 rounded-b bg-${data.colorAlert}-100 px-4 py-3 text-${data.colorAlert}-700">
                                    <p>${data.messageAlert}</p>
                                </div>
                            </div>
                        `;
                        return;
                    }
                    
                    // Foreach nos resultados
                    data.forEach(jogo => {
                        // Verificando se foram definidos
                        if(btnUltimosResultados && cardContainerJogos){
                            // Exibindo os elementos
                            btnUltimosResultados.classList.remove('hidden');
                            cardContainerJogos.classList.remove('hidden');

                            // Criando um card
                            const card = document.createElement("div");
                            card.className = "bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow hover:shadow-lg transition";
                            
                            // Criando novo elemento com dados do jogo
                            card.innerHTML = `
                                <div class="flex items-center justify-between">
                                    <div class="text-center">
                                        <img src="${jogo.time_casa_logo}" alt="${jogo.time_casa}" class="w-12 h-12 mx-auto">
                                        <p class="text-gray-800 dark:text-white font-semibold">${jogo.time_casa}</p>
                                    </div>
                                    <span class="text-lg font-bold text-gray-600 dark:text-gray-300">VS</span>
                                    <div class="text-center">
                                        <img src="${jogo.time_visitante_logo}" alt="${jogo.time_visitante}" class="w-12 h-12 mx-auto">
                                        <p class="text-gray-800 dark:text-white font-semibold">${jogo.time_visitante}</p>
                                    </div>
                                </div>
                                <p class="text-center text-gray-600 dark:text-gray-400 mt-4">${new Date(jogo.data_hora).toLocaleString()}</p>
                                <p class="text-center text-gray-500 dark:text-gray-400 text-sm mt-1">${jogo.estadio}</p>
                            `;
                            
                            // Incluindo novo elemento no Container HTML
                            jogosContainer.appendChild(card);
                        }                    
                    });
                });
            });
        </script>
    </x-slot>        
</x-app-layout>

