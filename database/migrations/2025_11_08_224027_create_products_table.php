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
    Schema::create('products', function (Blueprint $table) {
        $table->id();

        $table->foreignId('category_id')
            ->constrained('categories')
            ->cascadeOnUpdate()
            ->restrictOnDelete();

        $table->foreignId('supplier_id')
            ->nullable()
            ->constrained('suppliers')
            ->cascadeOnUpdate()
            ->nullOnDelete();

        $table->string('name', 180);
        $table->string('slug', 191)->unique();
        $table->string('sku', 64)->unique()->nullable();
        $table->string('barcode', 64)->unique()->nullable();

        $table->text('description')->nullable();

        $table->decimal('cost_price', 12, 2)->nullable();
        $table->decimal('price', 12, 2);              // nên bắt buộc có giá
        $table->decimal('tax_rate', 5, 2)->nullable();

        $table->unsignedInteger('stock_quantity')->default(0);
        $table->boolean('is_active')->default(true);

        $table->timestamps();

        $table->index('category_id', 'idx_products_category');
        $table->index('supplier_id', 'idx_products_supplier');
        // Nếu dùng LIKE nhiều trên name, cân nhắc fulltext (MySQL 8+):
        // $table->fullText('name');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
