<?php

namespace Database\Seeders;

use App\Models\PembiayaanLainCheckbox;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembiayaanLainCheckboxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PembiayaanLainCheckbox::factory()->createMany([
            ['value' => 'Pinjaman keluarga/kerabat/teman', 'is_other' => false],
            ['value' => 'Kredit (bank konvensional/BPR/Koperasi)', 'is_other' => false],
            ['value' => 'Pinjaman rentenir/bank keliling/bank emok', 'is_other' => false],
            ['value' => 'Bantuan pemerintah', 'is_other' => false],
        ]);
    }
}
