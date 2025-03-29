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
        Schema::create('sales_team_schedules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('sales_team_id');
            $table->uuid('route_id');
            $table->integer('day');
            $table->timestamps();
            $table->foreign('sales_team_id')
                ->references('id')
                ->on('sales_teams');
            $table->foreign('route_id')
                ->references('id')
                ->on('routes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_team_schedules');
    }
};
