<?php

namespace Database\Seeders;

use App\Models\FrekuensiPendampinganOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrekuensiPendampinganOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FrekuensiPendampinganOption::factory()->createMany([
            ['value' => '1-2 kali'],
            ['value' => '3-5 kali'],
            ['value' => '6-10 kali'],
            ['value' => '> 10 kali'],
        ]);
    }
}
