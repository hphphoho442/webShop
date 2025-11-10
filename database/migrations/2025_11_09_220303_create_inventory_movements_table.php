<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignID('product_id')
                ->constrained('products')
                ->cascadeOnDelete();
            //số lượng lưu chuyển
            $table->integer('change');

            // lý do chuyển kho
            $table->enum('resion', ['purchase',
                    'sale','return_in',
                    'return_out','adjust','manual']);
            $table->unsignedBigInteger('reference_id')
                ->nullable();
            $table->string('note', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
    }
};
