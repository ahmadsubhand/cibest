<?php

namespace Database\Seeders;

use App\Models\KeteranganLingkunganKeluargaLikert;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeteranganLingkunganKeluargaLikertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KeteranganLingkunganKeluargaLikert::factory()->createMany([
            ['value' => '1', 'description' => 'Melarang anggota keluarga ibadah'],
            ['value' => '2', 'description' => 'Menolak pelaksanaan ibadah'],
            ['value' => '3', 'description' => 'Menganggap ibadah sebagai urusan pribadi anggota keluarga'],
            ['value' => '4', 'description' => 'Mendukung ibadah anggota keluarga'],
            ['value' => '5', 'description' => 'Membangun suasana keluarga yang mendukung ibadah secara bersama-sama'],
        ]);
    }
}
