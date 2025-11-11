<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->unique(); // Mã coupon duy nhất
            $table->enum('type', ['percent', 'fixed']); // Loại giảm giá: phần trăm hoặc cố định
            $table->decimal('value', 12, 2);

            $table->integer('max_uses')->nullable();          // Tổng số lần có thể dùng
            $table->integer('max_uses_per_user')->nullable(); // Số lần mỗi user có thể dùng

            $table->timestamp('starts_at')->nullable(); // Thời gian bắt đầu
            $table->timestamp('ends_at')->nullable();   // Thời gian kết thúc

            $table->boolean('is_active')->default(true); // Có đang hoạt động không
            $table->timestamps(); // created_at + updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
