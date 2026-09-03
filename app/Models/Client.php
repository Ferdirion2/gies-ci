<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    protected $fillable = ['nom', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function devis()
    {
        return $this->hasMany(Devis::class);
    }

    public function messages()
    {
        return $this->hasMany(MessageContact::class);
    }
}