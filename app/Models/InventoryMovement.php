<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'change_qty',
        'reason', 'reference_id', 'note'
    ];

    protected $casts = [
        'change_qty' => 'interger',
        'reference_id' => 'interger',
    ];

    // (tuỳ chọn) hằng số để dùng thống nhất trong code
    public const REASONS = [
        'purchase','sale','return_in','return_out','adjust','manual'
    ];

    public function product(){
        return $this->belongsTo('Product');
    }
        // (tuỳ chọn) scope lọc theo sản phẩm
    public function scopeOfProduct($query, $productId)
    {
        return $query->where('product_id', $productId);
    }

    // (tuỳ chọn) scope lọc theo lý do
    public function scopeReason($query, $reason)
    {
        return $query->where('reason', $reason);
    }
}
