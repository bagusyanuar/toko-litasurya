<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_team_visits', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('sales_team_id');
            $table->uuid('store_id');
            $table->timestamp('visited_at');
            $table->text('image')->nullable();
            $table->string('status')->default('visited');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('sales_team_id')
                ->references('id')
                ->on('sales_teams');
            $table->foreign('store_id')
                ->references('id')
                ->on('customers');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_team_visits');
    }
};
