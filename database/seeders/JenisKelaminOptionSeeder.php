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
        $options = [
            ['value' => 'Laki-laki'],
            ['value' => 'Perempuan'],
        ];

        foreach ($options as $option) {
            JenisKelaminOption::updateOrCreate(
                ['value' => $option['value']], // unique key to find the record
                $option
            );
        }
    }
}
