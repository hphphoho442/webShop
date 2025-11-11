<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Khóa ngoại
            $table->foreignId('user_id')
                  ->constrained('users'); // on delete RESTRICT (mặc định)

            $table->foreignId('billing_address_id')
                  ->nullable()
                  ->constrained('addresses')
                  ->nullOnDelete();       // ON DELETE SET NULL

            $table->foreignId('shipping_address_id')
                  ->nullable()
                  ->constrained('addresses')
                  ->nullOnDelete();

            // Trạng thái đơn/ thanh toán
            $table->enum('status', [
                'pending','paid','processing','shipped','delivered','cancelled','refunded'
            ])->default('pending');

            $table->enum('payment_status', [
                'unpaid','paid','refunded','failed'
            ])->default('unpaid');

            // Tiền tệ
            $table->decimal('subtotal_amount', 12, 2)->default(0);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->decimal('shipping_amount', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);

            // Thời điểm đặt
            $table->timestamp('placed_at')->useCurrent();

            // Thời gian Laravel
            $table->timestamps(); // created_at, updated_at

            // Index
            $table->index(['user_id', 'status'], 'idx_orders_user_status');
            $table->index('placed_at', 'idx_orders_placed');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
