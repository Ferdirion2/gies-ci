<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['titre', 'slug', 'image_couverture', 'extrait', 'contenu', 'categorie', 'date_publication'];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
