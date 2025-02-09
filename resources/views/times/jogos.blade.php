<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Jogos do Time') }}
        </h2>
    </x-slot>
    
    <x-slot name="slot">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 container">           
            <!-- Botão de Voltar -->
            <div class="mb-4">
                <a href="{{ route('times.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-semibold text-sm rounded-lg shadow">
                    Voltar para Busca
                </a>
            </div>
            
            @if(!empty($jogosFuturos['typeAlert']))
                <!-- Jogos Programados -->
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-5 mb-5">🟢 Jogos Programados</h2>
                            
                <div role="alert">
                    <div class="bg-{{ $jogosFuturos['colorAlert'] }}-500 text-white font-bold rounded-t px-4 py-2">
                        {{ $jogosFuturos['typeAlert'] }}
                    </div>
                    <div class="border border-t-0 border-{{ $jogosFuturos['colorAlert'] }}-400 rounded-b bg-{{ $jogosFuturos['colorAlert'] }}-100 px-4 py-3 text-{{ $jogosFuturos['colorAlert'] }}-700">
                        <p>{{ $jogosFuturos['messageAlert'] }}</p>
                    </div>
                </div>
            @endif
            
            @if(!empty($jogosFuturos['jogosFuturos']))
                <!-- Jogos Programados -->
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-5 mb-5">🟢 Jogos Programados</h2>

                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 ">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">
                        @foreach ($jogosFuturos['jogosFuturos'] as $jogo)
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow hover:shadow-lg transition">
                                <div class="flex items-center justify-between">
                                    <div class="text-center">
                                        <img src="{{ $jogo['teams']['home']['logo'] }}" alt="{{ $jogo['goals']['home'] }}" class="w-12 h-12 mx-auto">
                                        <p class="text-gray-800 dark:text-white font-semibold">{{ $jogo['teams']['home']['name'] }}</p>
                                        <p class="text-gray-800 dark:text-white font-semibold">{{ $jogo['goals']['home'] }}</p>
                                    </div>
                                    <span class="text-lg font-bold text-gray-600 dark:text-gray-300">VS</span>
                                    <div class="text-center">
                                        <img src="{{ $jogo['teams']['away']['logo'] }}" alt="{{ $jogo['goals']['away'] }}" class="w-12 h-12 mx-auto">
                                        <p class="text-gray-800 dark:text-white font-semibold">{{ $jogo['teams']['away']['name'] }}</p>
                                        <p class="text-gray-800 dark:text-white font-semibold">{{ $jogo['goals']['away'] }}</p>
                                    </div>
                                </div>

                                <p class="text-center text-gray-600 dark:text-gray-400">{{ date('d/m/Y H:i', strtotime($jogo['fixture']['date'])) }}</p>
                                <p class="text-center text-gray-500 dark:text-gray-400">
                                    {{ $jogo['fixture']['venue']['name'] ?? 'Estádio não disponível' }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
            @if(!empty($ultimosResultados['typeAlert']))
                <!-- Últimos Resultados -->
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-5 mb-5">🔴 Últimos Resultados</h2>
                            
                <div role="alert">
                    <div class="bg-{{ $ultimosResultados['colorAlert'] }}-500 text-white font-bold rounded-t px-4 py-2">
                        {{ $ultimosResultados['typeAlert'] }}
                    </div>
                    <div class="border border-t-0 border-{{ $ultimosResultados['colorAlert'] }}-400 rounded-b bg-{{ $ultimosResultados['colorAlert'] }}-100 px-4 py-3 text-{{ $ultimosResultados['colorAlert'] }}-700">
                        <p>{{ $ultimosResultados['messageAlert'] }}</p>
                    </div>
                </div>
            @endif
                     
            @if(!empty($ultimosResultados['ultimosResultados']))
                <!-- Últimos Resultados -->
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-5 mb-5">🔴 Últimos Resultados</h2>

                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 ">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">
                        @foreach ($ultimosResultados['ultimosResultados'] as $jogo)
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow hover:shadow-lg transition">
                                <div class="flex items-center justify-between">
                                    <div class="text-center">
                                        <img src="{{ $jogo['teams']['home']['logo'] }}" alt="{{ $jogo['goals']['home'] }}" class="w-12 h-12 mx-auto">
                                        <p class="text-gray-800 dark:text-white font-semibold">{{ $jogo['teams']['home']['name'] }}</p>
                                        <p class="text-gray-800 dark:text-white font-semibold">{{ $jogo['goals']['home'] }}</p>
                                    </div>
                                    <span class="text-lg font-bold text-gray-600 dark:text-gray-300">VS</span>
                                    <div class="text-center">
                                        <img src="{{ $jogo['teams']['away']['logo'] }}" alt="{{ $jogo['goals']['away'] }}" class="w-12 h-12 mx-auto">
                                        <p class="text-gray-800 dark:text-white font-semibold">{{ $jogo['teams']['away']['name'] }}</p>
                                        <p class="text-gray-800 dark:text-white font-semibold">{{ $jogo['goals']['away'] }}</p>
                                    </div>
                                </div>

                                <p class="text-center text-gray-600 dark:text-gray-400">{{ date('d/m/Y H:i', strtotime($jogo['fixture']['date'])) }}</p>
                                <p class="text-center text-gray-500 dark:text-gray-400">
                                    {{ $jogo['fixture']['venue']['name'] ?? 'Estádio não disponível' }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(empty($jogosFuturos['jogosFuturos']) && empty($ultimosResultados['ultimosResultados']))
                @if(!empty($typeAlert))
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
    </x-slot>
    
</x-app-layout>