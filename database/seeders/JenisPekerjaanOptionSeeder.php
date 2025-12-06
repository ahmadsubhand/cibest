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
        $options = [
            ['value' => 'Karyawan swasta', 'is_other' => false],
            ['value' => 'Petani', 'is_other' => false],
            ['value' => 'Pedagang', 'is_other' => false],
            ['value' => 'Buruh', 'is_other' => false],
            ['value' => 'Nelayan', 'is_other' => false],
            ['value' => 'Tidak disebutkan', 'is_other' => false]
        ];

        foreach ($options as $option) {
            JenisPekerjaanOption::updateOrCreate(
                ['value' => $option['value']], // unique key to find the record
                $option
            );
        }
    }
}
