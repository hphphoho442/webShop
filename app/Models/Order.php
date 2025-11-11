<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'billing_address_id',
        'shipping_address_id',
        'status',
        'payment_status',
        'subtotal_amount',
        'discount_amount',
        'tax_amount',
        'shipping_amount',
        'total_amount',
        'placed_at',
    ];

    protected $casts = [
        'subtotal_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount'      => 'decimal:2',
        'shipping_amount' => 'decimal:2',
        'total_amount'    => 'decimal:2',
        'placed_at'       => 'datetime',
    ];

    // Quan hệ
    public function user()         { return $this->belongsTo(User::class); }
    public function billingAddress(){ return $this->belongsTo(Address::class, 'billing_address_id'); }
    public function shippingAddress(){ return $this->belongsTo(Address::class, 'shipping_address_id'); }
    public function items()        { return $this->hasMany(OrderItem::class); }
    public function payments()     { return $this->hasMany(Payment::class); }     // nếu có bảng payments
    public function shipments()    { return $this->hasMany(Shipment::class); }    // nếu có bảng shipments
    public function couponRedemptions()
{
    return $this->hasMany(CouponRedemption::class);
}

}
