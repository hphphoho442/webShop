<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_id', 'supplier_id',
        'name', 'slug', 'sku', 'barcode', 'unit',
        'description', 'cost_price', 'price', 'tax_rate',
        'stock_quantity', 'is_active',
    ];
    //lấy dữ liệu từ DB cho phù hợp với laravel
    protected $casts = [
        'cost_price'    => 'decimal:2',
        'price'         => 'decimal:2',
        'tax_rate'      => 'decimal:2',
        'stock_quantity'=> 'interger',
        'is_active'     => 'boolean',
    ];

    public function category(){
        return $this->belongsTo(Supplier::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function image(){
        return $this->hasMany(ProductImage::class);
    }
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
    public function cartItems(){
        return $this->belongsTo(CartItem::class);
    }

    // Scopes tiện dụng
    public function scopeActive($query){
        return $query->where('is_active', true);
    }
    public function scopeInStock($query, $min=1){
        return $query->where('stock_quantity', '>=', $min);
    }

    // dùng để người dùng nhập ô tìm kiếm và nó sẽ tìm theo 
    // $q lấy dữ liệu từ ô nhập
    
    public function scopeSearch($query, $q){
        return $query->when($q, fn($qq)
            =>$qq   ->where('name','like', "%{$q}%")
                    ->orWhere('sku', 'like', "%{$q}%")
                    ->orWhere('barcode', 'like', "%{$q}%")
                );
    }
    public function likes(){
        return $this->hasMany(ProductLike::class);
    }
    public function likeByUsers(){
        return $this->belongsToMany(User::class, 'ProductLikes')
                    ->withPivot('liked_at');
    }
    public function comments()
{
    return $this->hasMany(ProductComment::class);
}

}
