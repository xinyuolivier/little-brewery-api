<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'bill', 'beer_id', 'user_id', 'brewery_id', 'quantity', 'price', 'delivered'
    ];

    public function user()
        {
            return $this->belongsTo(User::class);
        }

    public function beer()
        {
            return $this->belongsTo(Beer::class);
        }
}
