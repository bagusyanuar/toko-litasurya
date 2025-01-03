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
        Schema::create('routes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('sales_id'); // Relasi ke tabel sales
            $table->uuid('customer_id'); // Relasi ke tabel customers
            $table->string('day_of_week'); // Hari jadwal kunjungan (Senin, Selasa, dst.)
            $table->boolean('repeat')->default(true); // Apakah jadwal berulang
            $table->timestamps();

            // Foreign keys
            $table->foreign('sales_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
