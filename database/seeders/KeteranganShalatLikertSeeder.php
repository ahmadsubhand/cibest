<?php

namespace Database\Seeders;

use App\Models\KeteranganShalatLikert;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeteranganShalatLikertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KeteranganShalatLikert::factory()->createMany([
            ['value' => '1', 'description' => 'Melarang orang lain shalat'],
            ['value' => '2', 'description' => 'Menolak konsep shalat'],
            ['value' => '3', 'description' => 'Melaksanakan shalat wajib tidak rutin'],
            ['value' => '4', 'description' => 'Melaksanakan shalat rutin wajib tapi tidak selalu berjamaah'],
            ['value' => '5', 'description' => 'Melaksanakan shalat wajib rutin berjamaah dan melakukan shalat sunnah'],
        ]);
    }
}
