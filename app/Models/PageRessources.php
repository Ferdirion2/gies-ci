<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageRessources extends Model
{
    use HasFactory;

    protected $table = 'page_ressources';

    protected $fillable = ['texte_intro'];
}