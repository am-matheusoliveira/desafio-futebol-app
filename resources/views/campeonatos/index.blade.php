<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Escolha um Campeonato') }}
        </h2>
    </x-slot>
    
    <x-slot name="slot">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 container">
            @if(session('typeAlert'))
                <div role="alert">
                    <div class="bg-{{ $colorAlert }}-500 text-white font-bold rounded-t px-4 py-2">
                        {{ session('typeAlert') }}
                    </div>
                    <div class="border border-t-0 border-{{ $colorAlert }}-400 rounded-b bg-{{ $colorAlert }}-100 px-4 py-3 text-{{ $colorAlert }}-700">
                        <p>{{ session('messageAlert') }}</p>
                    </div>
                </div>
            @endif
            
            @if(count($ligasFiltradas) > 0)         
                <div class="mb-4 flex flex-col md:flex-row md:items-center justify-start md:justify-between gap-2">                
                    <!-- Campo de Filtro -->
                    <div class="w-full md:w-[60%] md:ml-auto">
                        <input type="text" id="searchInput" placeholder="Filtrar campeonatos..." class="w-full border border-gray-300 dark:border-gray-700 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white">
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">                
                        @foreach($ligasFiltradas as $campeonato)
                            <div class="campeonato-card bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow hover:shadow-lg transition">
                                <div class="flex justify-center">
                                    <img src="{{ $campeonato['league']['logo'] }}" alt="{{ $campeonato['league']['name'] }}" class="w-16 h-16 mx-auto">
                                </div>
                                <h2 class="text-lg font-semibold text-gray-700 dark:text-white text-center mt-2">
                                    {{ $campeonato['league']['name'] }}
                                </h2>
                                <p class="text-center text-gray-500 dark:text-gray-400">{{ $campeonato['country']['name'] }}</p>
                                
                                <!-- Selecionar Campeonato com Temporada -->
                                <form action="{{ route('campeonato.selecionar') }}" method="POST" class="mt-4 text-center">
                                    @csrf
                                    <input type="hidden" name="campeonato_id" value="{{ $campeonato['league']['id'] }}">
                                    <input type="hidden" name="campeonato_nome" value="{{ $campeonato['league']['name'] }}">

                                    <label for="temporada" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Selecione o Ano:</label>
                                    <select name="temporada" class="mt-2 p-2 border rounded-lg w-full dark:bg-gray-700 dark:text-white" id="temporada">
                                        @foreach($campeonato['seasons'] as $season)
                                            <option value="{{ $season['year'] }}">{{ $season['year'] }}</option>
                                        @endforeach
                                    </select>
                                    
                                    <button type="submit" class="block mt-4 w-full text-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">
                                        Selecionar
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                @if($typeAlert)
                    <div role="alert">
                        <div class="bg-{{ $colorAlert }}-500 text-white font-bold rounded-t px-4 py-2">
                            {{ $typeAlert }}
                        </div>
                        <div class="border border-t-0 border-{{ $colorAlert }}-400 rounded-b bg-{{ $colorAlert }}-100 px-4 py-3 text-{{ $colorAlert }}-700">
                            <p>{{ $messageAlert }}</p>
                        </div>
                    </div>
                @endif
            @endif
        </div>
        
        <!-- Script para Filtragem dos Campeonatos -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const searchInput = document.getElementById("searchInput");
                const cards = document.querySelectorAll(".campeonato-card");
                
                if(searchInput){
                    searchInput.addEventListener("keyup", function() {
                        const searchTerm = searchInput.value.toLowerCase();
                    
                        cards.forEach(card => {
                            const championshipName = card.querySelector("h2").textContent.toLowerCase();
                            const countryName = card.querySelector("p").textContent.toLowerCase();
                        
                            if (championshipName.includes(searchTerm) || countryName.includes(searchTerm)) {
                                card.style.display = "block";
                            } else {
                                card.style.display = "none";
                            }
                        });
                    });
                }
            });
        </script>
    </x-slot>   

</x-app-layout>