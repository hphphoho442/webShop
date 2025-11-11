<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            // Khóa ngoại tới orders
            $table->foreignId('order_id')
                  ->constrained('orders')
                  ->cascadeOnDelete();

            // Khóa ngoại tới products
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->cascadeOnUpdate();

            // Thông tin chi tiết sản phẩm trong đơn hàng
            $table->string('product_name', 180);
            $table->decimal('unit_price', 12, 2);
            $table->integer('quantity');
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->decimal('subtotal', 12, 2);

            $table->timestamps();

            // Tạo index để tăng tốc truy vấn theo order
            $table->index('order_id', 'idx_oi_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
