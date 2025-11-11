<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_comments', function (Blueprint $table) {
            $table->id();

            // Khóa ngoại đến users và products
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('product_id')
                  ->constrained('products')
                  ->cascadeOnDelete();

            // Nội dung đánh giá
            $table->unsignedTinyInteger('rating')->nullable(); // 1–5 sao
            $table->text('comment');

            $table->timestamps(); // created_at + updated_at

            // Index để tối ưu truy vấn
            $table->index(['product_id', 'created_at'], 'idx_cmt_product');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_comments');
    }
};
