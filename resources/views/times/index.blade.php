<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Escolha um Time') }}
        </h2>
    </x-slot>
    
    <x-slot name="slot">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 container">
            
            <!-- Formulário de Busca -->
            <form id="formBuscarTime" class="flex justify-end gap-2 mb-5">                
                <!-- Campo de Busca -->
                <input type="text" name="nome_time" id="nome_time" placeholder="Digite o nome de um time (ex: Flamengo, Real Madrid...)" class="w-full md:w-[60%] border border-gray-300 dark:border-gray-700 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white" value="{{ $nome_time ?? '' }}">
            
                <!-- Botão de Busca -->
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg h-full">
                    Buscar
                </button>
            </form>
            
            <div id="card-times-container" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 hidden">
                <div id="times-container" class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Os Times serão carregados aqui via JavaScript -->
                </div>
            </div>
            
            <div class="hidden" id="card-alert">
                <!-- As Mensagens de alertas ou erros seram carregadas aqui -->
            </div>
        </div>
        
        <!-- Script para busca e renderização dos Cards com os Jogos -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                
                // Pegando o elemento "formBuscarTime" pelo ID
                const formBuscarTime = document.getElementById('formBuscarTime');                
                
                formBuscarTime.addEventListener('submit', function(event) {
                    // Impedindo o envio do formulário    
                    event.preventDefault();            
                    
                    // Pegando o valor do input SOMENTE quando o botão for clicado
                    let nomeTime = document.getElementById('nome_time').value.trim();
                    
                    // Pegando o elemento "cardAlert" pelo ID
                    const cardAlert = document.getElementById("card-alert");
                    
                    // Pegando os elementos "cardTimesContainer" & "timesContainer" pelo ID
                    const cardTimesContainer = document.getElementById("card-times-container");
                    const timesContainer = document.getElementById("times-container");
                    
                    // Realizando requisição HTTP
                    fetch("{{ route('times.buscar') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                nome_time: nomeTime
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                        
                        // Verificando se "data.messageAlert" foi definida
                        if (data.messageAlert) {                            
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
                            
                            // Removendo os times antigos e esconde o card
                            cardTimesContainer.classList.add('hidden');
                            timesContainer.innerHTML = '';

                            // Removendo a classe "hidden" do elemento cardAlert
                            cardAlert.classList.remove('hidden');                            
                            
                            // Finaliza a execução
                            return;
                        }
                        
                        // Colocando classe "hidden" no elemento cardAlert
                        cardAlert.classList.add('hidden'); 
                        
                        // Removendo os times antigos
                        timesContainer.innerHTML = '';
                        
                        // Foreach nos resultados
                        data.forEach(time => {
                            const card = document.createElement("div");
                            card.className = "bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow hover:shadow-lg transition";
                            
                            // Criando novo elemento com dados do time
                            card.innerHTML = `
                                <div class="flex justify-center">
                                    <img src="${time.time_logo}" alt="${time.time_nome}" class="w-16 h-16">
                                </div>
                                <h3 class="text-lg font-semibold text-gray-700 dark:text-white text-center mt-2">${time.time_nome}</h3>
                                <p class="text-center text-gray-500 dark:text-gray-400">${time.time_pais}</p>
                                
                                <!-- Formulário para enviar o ano junto com a requisição -->
                                <form action="${time.rota}" method="GET" class="mt-4 text-center">
                                    <label for="ano" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Selecione o Ano:</label>
                                    <select name="ano" id="ano" required class="mt-2 p-2 border rounded-lg w-full dark:bg-gray-700 dark:text-white">
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                    </select>
                                
                                    <button type="submit" class="block mt-4 w-full text-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">
                                        Ver Jogos
                                    </button>
                                </form>
                            `;
                            
                            // Incluindo novo elemento no Container HTML
                            timesContainer.appendChild(card);
                        });
                        
                        // Mostrando o Card com os Times
                        cardTimesContainer.classList.remove('hidden');
                    });
                });
            });
        </script>        
    </x-slot>
    
</x-app-layout>