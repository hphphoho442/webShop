<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    // Mỗi bình luận thuộc về 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mỗi bình luận thuộc về 1 product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
