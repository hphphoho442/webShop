<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cart_id')
                  ->constrained('carts')        // đúng bảng
                  ->cascadeOnDelete();

            $table->foreignId('product_id')
                  ->constrained('products');

            $table->integer('quantity')
                  ->default(1);

            $table->timestamp('added_at')
                  ->useCurrent();               // thời điểm thêm vào

            $table->unique(['cart_id', 'product_id'], 'uq_cart_product');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
