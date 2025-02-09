<?php

// app/Models/Campeonato.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campeonato extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'pais'];
    public function times() {
        return $this->hasMany(Time::class);
    }
    public function jogos() {
        return $this->hasMany(Jogo::class);
    }
}