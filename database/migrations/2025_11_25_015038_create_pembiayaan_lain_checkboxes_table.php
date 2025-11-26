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
        Schema::create('pembiayaan_lain_checkboxes', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->boolean('is_other')->default(true);
        });

        Schema::create('bantuan_pembiayaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bantuan_id')->constrained('bantuan_ziswaf_sections')->cascadeOnDelete();
            $table->foreignId('lain_id')->constrained('pembiayaan_lain_checkboxes')->cascadeOnDelete();
        });

        Schema::create('lain_syariah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('syariah_id')->constrained('pembiayaan_syariah_sections')->cascadeOnDelete();
            $table->foreignId('lain_id')->constrained('pembiayaan_lain_checkboxes')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembiayaan_lain_checkboxes');
    }
};
