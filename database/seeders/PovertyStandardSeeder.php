<?php

namespace Database\Seeders;

use App\Models\PovertyStandard;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PovertyStandardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PovertyStandard::factory()->createMany([
            [
                'name' => 'Miskin Ekstrem',
                'index_kesejahteraan_cibest' => 0.75,
                'besaran_nilai_cibest_model' => 0.67,
                'nilai_keluarga' => 1657717,
                'nilai_per_tahun' => 19892604,
                'log_natural' => 16.80585856,
            ],
            [
                'name' => 'Garis Kemiskinan',
                'index_kesejahteraan_cibest' => 0.25,
                'besaran_nilai_cibest_model' => 0.39,
                'nilai_keluarga' => 2592657,
                'nilai_per_tahun' => 31111884,
                'log_natural' => 17.25310043,
            ],
            [
                'name' => 'UMP',
                'index_kesejahteraan_cibest' => 0.25,
                'besaran_nilai_cibest_model' => 0.35,
                'nilai_keluarga' => 2922769,
                'nilai_per_tahun' => 35073228,
                'log_natural' => 17.37294866,
            ],
            [
                'name' => 'Had Kifayah',
                'index_kesejahteraan_cibest' => null,
                'besaran_nilai_cibest_model' => 0.13,
                'nilai_keluarga' => 4226553,
                'nilai_per_tahun' => 50718636,
                'log_natural' => 17.74180397,
            ],
            [
                'name' => 'Nishab Zakat',
                'index_kesejahteraan_cibest' => null,
                'besaran_nilai_cibest_model' => 0.04,
                'nilai_keluarga' => 6828806,
                'nilai_per_tahun' => 81945672,
                'log_natural' => 18.22156705,
            ],
        ]);
    }
}
