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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('total_quantity');
            $table->decimal('total_price', 8, 2);
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'transactions_users_id'
            );
            $table->foreignId('status_id')->constrained(
                table: 'statuses',
                indexName: 'statuses_transactions_id'
            );
            $table->foreignId('shop_id')->constrained(
                table: 'shops',
                indexName: 'shops_transactions_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
