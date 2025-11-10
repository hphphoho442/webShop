<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable=[
        'parent_id',
        'name',
        'slug',
        'description',
        'is_active'
    ];

    public function parent() {
        return $this->belongsTo(category::class, 'parent_id');
    }

    public function children(){
        return $this->hasMany(Category::class, 'parent_id');
    }
}
