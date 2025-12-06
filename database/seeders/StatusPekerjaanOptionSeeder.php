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
        $options = [
            ['value' => 'Bekerja'],
            ['value' => 'Tidak bekerja'],
            ['value' => 'Tidak disebutkan'],
        ];

        foreach ($options as $option) {
            StatusPekerjaanOption::updateOrCreate(
                ['value' => $option['value']], // unique key to find the record
                $option
            );
        }
    }
}
