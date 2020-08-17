<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brewery extends Model
{
    protected $fillable = [
        'name', 'address', 'city', 'description', 'profil'
    ];

    public function beer()
        {
            return $this->hasMany(Beer::class);
        }
}
