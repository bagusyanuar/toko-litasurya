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
            $table->uuid('id')->primary();
            $table->uuid('transaction_id')->nullable();
            $table->uuid('item_id')->nullable();
            $table->integer('qty')->default(0);
            $table->integer('price')->default(0);
            $table->integer('total')->default(0);
            $table->timestamps();
            $table->foreign('transaction_id')
                ->references('id')
                ->on('transactions');
            $table->foreign('item_id')
                ->references('id')
                ->on('items');
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
