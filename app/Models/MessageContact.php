<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageContact extends Model
{
    protected $fillable = ['nom', 'email', 'sujet', 'message', 'statut', 'client_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
