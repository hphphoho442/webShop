<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductLike extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'like_at'
    ];
    public $timestamps = false;
    public function user(){
        return $this->hasma
    }
}
