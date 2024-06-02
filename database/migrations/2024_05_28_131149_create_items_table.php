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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('quantity');
            $table->decimal('price', 8, 2);
            $table->string('image')->nullable();
            $table->foreignId('shop_id')->constrained(
                table: 'shops',
                indexName: 'items_shops_id'
            );
            $table->foreignId('categories_id')->constrained(
                table: 'categories',
                indexName: 'items_categories_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
