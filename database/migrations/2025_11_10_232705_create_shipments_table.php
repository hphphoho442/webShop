<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();

            // Liên kết với đơn hàng
            $table->foreignId('order_id')
                  ->constrained('orders')
                  ->cascadeOnDelete();

            $table->string('carrier', 100)->nullable();
            $table->string('tracking_no', 150)->nullable();

            $table->enum('status', [
                'preparing',
                'shipped',
                'in_transit',
                'delivered',
                'returned',
                'cancelled'
            ])->default('preparing');

            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps(); // created_at + updated_at

            // Indexes
            $table->index(['order_id'], 'idx_ship_order');
            $table->index(['status'], 'idx_ship_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
