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
        Schema::create('attendances', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('route_id'); // Relasi ke tabel sales
            $table->date('date'); // Tanggal absensi
            $table->string('status')->default('missed'); // Status (completed, missed, late)
            $table->text('reason')->nullable(); // Alasan, bersifat nullable
            $table->text('image')->nullable(); // Alasan, bersifat nullable
            $table->timestamps();

            // Foreign keys
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
