<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageAPropos extends Model
{
    use HasFactory;

    protected $table = 'page_a_propos';

    protected $fillable = ['histoire', 'mission_valeurs', 'texte_equipe', 'photo_equipe'];
}