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
        Schema::create('item_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('image_path')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('based_price', 10, 2);
            $table->unsignedInteger('stocks')->default(0);
            $table->foreignId('category_id')->nullable()->constrained('item_categories', 'id')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_products');
    }
};
