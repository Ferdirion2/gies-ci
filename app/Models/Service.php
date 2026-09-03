<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'titre', 'slug', 'description_courte', 'description_longue',
        'points_cles', 'image', 'icone', 'est_epingle', 'ordre',
    ];

    public function realisations()
    {
        return $this->hasMany(Realisation::class);
    }

    public function realisationsMany()
    {
        return $this->belongsToMany(Realisation::class);
    }

    public function devis()
    {
        return $this->hasMany(Devis::class);
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
    public function getRouteKeyName(): string
{
    return 'slug';
}
}