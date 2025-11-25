<?php

namespace Database\Seeders;

use App\Models\StatusPekerjaanOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusPekerjaanOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusPekerjaanOption::factory()->createMany([
            ['value' => 'Bekerja'],
            ['value' => 'Tidak bekerja'],
        ]);
    }
}
