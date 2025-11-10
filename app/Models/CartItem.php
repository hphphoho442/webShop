<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fill = [
        'card_id', 'product_id',
        'quantity', 'added_at'
    ];
    public $timestamps = false;
    public function cart(){
        return $this->belongsTo(Cart::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }

}
