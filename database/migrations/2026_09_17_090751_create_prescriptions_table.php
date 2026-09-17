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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel rekam medis & obat
            $table->foreignId('medical_record_id')->constrained('medical_records')->onDelete('cascade');
            $table->foreignId('medicine_id')->constrained('medicines')->onDelete('cascade');
            
            $table->integer('quantity'); // Jumlah obat yang diberikan
            $table->string('dosage'); // Aturan pakai (contoh: 3x1 sesudah makan)
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
