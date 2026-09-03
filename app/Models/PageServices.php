<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageServices extends Model
{
    use HasFactory;

    protected $table = 'page_services';

    protected $fillable = ['texte_intro'];
}