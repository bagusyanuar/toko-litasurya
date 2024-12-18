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
            $table->uuid('user_id')->nullable();
            $table->uuid('transaction_id')->nullable();
            $table->uuid('customer_id')->nullable();
            $table->uuid('item_id')->nullable();
            $table->integer('request_qty')->default(0);
            $table->integer('qty')->default(0);
            $table->integer('price')->default(0);
            $table->string('unit');
            $table->integer('total')->default(0);
            $table->string('status');
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('transaction_id')
                ->references('id')
                ->on('transactions');
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');
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
