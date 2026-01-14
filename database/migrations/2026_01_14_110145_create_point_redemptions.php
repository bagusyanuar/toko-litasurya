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
        Schema::create('point_redemptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('date');
            $table->uuid('customer_id')->nullable();
            $table->uuid('reward_id')->nullable();
            $table->integer('point_used')->default(0);
            $table->timestamps();
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');
            $table->foreign('reward_id')
                ->references('id')
                ->on('rewards');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_redemptions');
    }
};
