<?php

namespace Database\Seeders;

use App\Models\JenisPekerjaanOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPekerjaanOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisPekerjaanOption::factory()->createMany([
            ['value' => 'Karyawan swasta'],
            ['value' => 'Petani'],
            ['value' => 'Pedagang'],
            ['value' => 'Buruh'],
            ['value' => 'Nelayan'],
            ['value' => 'Lainnya'],
        ]);
    }
}
