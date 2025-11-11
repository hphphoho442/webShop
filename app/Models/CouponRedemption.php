<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponRedemption extends Model
{
    use HasFactory;

    protected $fillable = [
        'coupon_id',
        'user_id',
        'order_id',
        'redeemed_at',
    ];

    protected $casts = [
        'redeemed_at' => 'datetime',
    ];

    public $timestamps = false;

    // Liên kết tới coupon
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    // Liên kết tới user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Liên kết tới order (nếu có)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
