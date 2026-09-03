<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageDevis extends Model
{
    use HasFactory;

    protected $table = 'page_devis';

    protected $fillable = ['texte_intro'];
}