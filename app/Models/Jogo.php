<?php

// app/Models/Jogo.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    use HasFactory;
    protected $fillable = ['campeonato_id', 'time_casa_id', 'time_fora_id', 'data_hora', 'gols_casa', 'gols_fora'];
    public function campeonato() {
        return $this->belongsTo(Campeonato::class);
    }
    public function timeCasa() {
        return $this->belongsTo(Time::class, 'time_casa_id');
    }
    public function timeFora() {
        return $this->belongsTo(Time::class, 'time_fora_id');
    }
}