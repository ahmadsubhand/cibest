<?php

namespace Database\Seeders;

use App\Models\JenisKelaminOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisKelaminOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisKelaminOption::factory()->createMany([
            ['value' => 'Laki-laki'],
            ['value' => 'Perempuan'],
        ]);
    }
}
