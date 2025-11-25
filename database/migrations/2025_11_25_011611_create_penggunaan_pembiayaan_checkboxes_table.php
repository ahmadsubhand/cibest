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
        Schema::create('penggunaan_pembiayaan_checkboxes', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->boolean('is_other')->default(true);
        });

         Schema::create('pembiayaan_syariah_section_penggunaan_pembiayaan_checkbox', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembiayaan_syariah_section_id')->constrained()->cascadeOnDelete();
            $table->foreignId('penggunaan_pembiayaan_checkbox_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunaan_pembiayaan_checkboxes');
    }
};
