<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = ['gallery_id', 'path'];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    protected function path(): Attribute
    {
        return \Attribute::make(
            get: fn(string $value) => 'alskdjfal'
        );
    }
}
