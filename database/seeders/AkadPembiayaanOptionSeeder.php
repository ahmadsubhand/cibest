<?php

namespace Database\Seeders;

use App\Models\AkadPembiayaanOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AkadPembiayaanOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AkadPembiayaanOption::factory()->createMany([
            ['value' => 'Murabahah', 'is_other' => false],
            ['value' => 'Mudharabah', 'is_other' => false],
            ['value' => 'Musyarakah', 'is_other' => false],
            ['value' => 'Qardhul Hasan', 'is_other' => false],
            ['value' => 'Ijarah', 'is_other' => false],
        ]);
    }
}
