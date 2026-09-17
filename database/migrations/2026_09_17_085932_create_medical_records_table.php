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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            // Menghubungkan rekam medis dengan data pendaftaran/antrean
            $table->foreignId('appointment_id')->constrained('appointments')->onDelete('cascade');
            
            $table->text('diagnosis'); // Penyakit yang diderita
            $table->text('notes')->nullable(); // Catatan tambahan dokter
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
