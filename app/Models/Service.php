<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{


    public function images()
{
    return $this->hasMany(ImageService::class);
}


    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }
}
