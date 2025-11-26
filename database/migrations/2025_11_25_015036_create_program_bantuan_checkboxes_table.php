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
        Schema::create('program_bantuan_checkboxes', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->boolean('is_other')->default(true);
        });

        Schema::create('bantuan_program', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bantuan_id')->constrained('bantuan_ziswaf_sections')->cascadeOnDelete();
            $table->foreignId('program_id')->constrained('program_bantuan_checkboxes')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_bantuan_checkboxes');
    }
};
