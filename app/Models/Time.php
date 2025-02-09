<?php

// app/Models/Time.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'abreviacao', 'escudo', 'campeonato_id'];
    public function campeonato() {
        return $this->belongsTo(Campeonato::class);
    }
    public function jogosCasa() {
        return $this->hasMany(Jogo::class, 'time_casa_id');
    }
    public function jogosFora() {
        return $this->hasMany(Jogo::class, 'time_fora_id');
    }
}