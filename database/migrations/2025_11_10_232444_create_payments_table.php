<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                  ->constrained('orders')
                  ->cascadeOnDelete();

            $table->enum('method', ['cod', 'bank', 'card', 'wallet']);
            $table->decimal('amount', 12, 2);
            $table->enum('status', ['pending', 'succeeded', 'failed', 'refunded'])->default('pending');
            $table->string('transaction_ref', 191)->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps(); // created_at + updated_at

            $table->index(['order_id'], 'idx_payment_order');
            $table->index(['status'], 'idx_payment_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
