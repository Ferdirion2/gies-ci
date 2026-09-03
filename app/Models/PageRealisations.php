<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageRealisations extends Model
{
    use HasFactory;

    protected $table = 'page_realisations';

    protected $fillable = ['texte_intro'];
}