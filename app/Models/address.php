<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    // Nếu tên bảng không phải "addresses" thì cần khai báo:
    // protected $table = 'addresses';

    // Những cột cho phép insert/update (tránh MassAssignmentException)
    protected $fillable = [
        'user_id',
        'label',
        'recipient',
        'phone',
        'line',
        'ward',
        'district',
        'province',
        'country',
    ];

    /**
     * Quan hệ 1 địa chỉ thuộc về 1 user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
