<?php

namespace Database\Seeders;

use App\Models\StatusPerkawinanOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusPerkawinanOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            ['value' => 'Kawin'],
            ['value' => 'Belum kawin'],
            ['value' => 'Cerai mati'],
            ['value' => 'Cerai hidup'],
            ['value' => 'Tidak disebutkan'],
        ];

        foreach ($options as $option) {
            StatusPerkawinanOption::updateOrCreate(
                ['value' => $option['value']], // unique key to find the record
                $option
            );
        }
    }
}
