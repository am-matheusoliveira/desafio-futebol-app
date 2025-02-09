<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//
use App\Http\Controllers\CampeonatoController;
use App\Http\Controllers\JogoController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\JogoTimeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // CAMPEONATO
    Route::get('/campeonatos', [CampeonatoController::class, 'index'])->name('campeonatos.index');
    Route::post('/campeonato/selecionar', [CampeonatoController::class, 'selecionarCampeonato'])->name('campeonato.selecionar');

    // JOGO
    Route::get('/jogos', [JogoController::class, 'index'])->name('jogos.index');
    Route::get('/jogos/listar', [JogoController::class, 'jogosListar'])->name('jogos.listar');
    Route::get('/campeonatos/{id}/resultados', [JogoController::class, 'listarResultados'])->name('jogos.resultados');
    
    // TIME
    Route::get('/buscar-time', [TimeController::class, 'index'])->name('times.index');
    Route::post('/buscar-time', [TimeController::class, 'buscar'])->name('times.buscar');
    
    // JOGOS DO TIME
    Route::get('/time/{id}/jogos', [JogoTimeController::class, 'index'])->name('jogos.porTime');
});

require __DIR__.'/auth.php';

