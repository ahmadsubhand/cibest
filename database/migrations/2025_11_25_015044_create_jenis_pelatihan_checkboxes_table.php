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
        Schema::create('jenis_pelatihan_checkboxes', function (Blueprint $table) {
            $table->id();
            $table->string('value')->unique();
            $table->boolean('is_other')->default(true);
        });

        Schema::create('jenis_pembinaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembinaan_id')->constrained('pembinaan_pendampingan_sections')->cascadeOnDelete();
            $table->foreignId('jenis_id')->constrained('jenis_pelatihan_checkboxes')->cascadeOnDelete();
        });

        Schema::create('pelatihan_pembinaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembinaan_id')->constrained('pembinaan_pendampingan_sections')->cascadeOnDelete();
            $table->foreignId('jenis_id')->constrained('jenis_pelatihan_checkboxes')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_pelatihan_checkboxes');
    }
};
