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
        Schema::create('poverty_standards', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->integer('nilai_keluarga');
            $table->integer('nilai_per_tahun');
            $table->double('log_natural');
            $table->double('index_kesejahteraan_cibest')->nullable();
            $table->double('besaran_nilai_cibest_model')->nullable();
        });

        Schema::create('cibest_quadrants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poverty_id')->constrained('poverty_standards')->cascadeOnDelete();
            $table->foreignId('form_id')->constrained('cibest_forms')->cascadeOnDelete();
            $table->integer('kuadran_sebelum');
            $table->integer('kuadran_setelah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poverty_standards');
    }
};
