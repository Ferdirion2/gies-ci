<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvisClient extends Model
{
// AvisClient.php
protected $fillable = ['nom_client', 'note', 'commentaire', 'statut', 'date_avis'];
}

