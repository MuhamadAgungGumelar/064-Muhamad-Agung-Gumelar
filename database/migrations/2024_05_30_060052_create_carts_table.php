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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'users_carts_id'
            );
            $table->foreignId('item_id')->constrained(
                table: 'items',
                indexName: 'items_carts_id'
            );
            $table->foreignId('status_id')->constrained(
                table: 'statuses',
                indexName: 'statuses_carts_id'
            );
            $table->integer('quantity');
            $table->boolean('completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
