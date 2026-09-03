<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['mediable_type', 'mediable_id', 'type', 'path', 'ordre', 'est_principale'];

    public function mediable()
    {
        return $this->morphTo();
    }

    protected static function booted(): void
    {
        static::saving(function (Media $media) {
            if ($media->est_principale) {
                static::where('mediable_type', $media->mediable_type)
                    ->where('mediable_id', $media->mediable_id)
                    ->where('id', '!=', $media->id)
                    ->update(['est_principale' => false]);
            }
        });
    }
}

