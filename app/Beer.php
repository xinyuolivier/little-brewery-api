<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    protected $fillable = [
        'name', 'brewery_id', 'description', 'flavor','color','packaging', 'image', 'price', 'quantity',
    ];

    public function brewery(){
        return $this->belongsTo(Brewery::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }
}
