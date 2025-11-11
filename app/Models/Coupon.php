<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'max_uses',
        'max_uses_per_user',
        'starts_at',
        'ends_at',
        'is_active',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Kiểm tra xem coupon còn hiệu lực không
    public function isValid(): bool
    {
        $now = now();
        return $this->is_active &&
               (!$this->starts_at || $this->starts_at <= $now) &&
               (!$this->ends_at || $this->ends_at >= $now);
    }
    public function redemptions()
{
    return $this->hasMany(CouponRedemption::class);
}

}
