<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Realisation extends Model
{
    protected $fillable = [
        'titre', 'slug', 'description_longue', 'lieu', 'date_realisation',
        'client', 'kwc', 'type_bien', 'service_id', 'est_epingle',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
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