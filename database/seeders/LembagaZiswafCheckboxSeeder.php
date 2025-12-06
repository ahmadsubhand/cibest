<?php

namespace Database\Seeders;

use App\Models\LembagaZiswafCheckbox;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LembagaZiswafCheckboxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            ['value' => 'BAZNAS Pusat', 'is_other' => false],
            ['value' => 'BAZNAS Provinsi/Daerah', 'is_other' => false],
            ['value' => 'LAZ', 'is_other' => false],
        ];

        foreach ($options as $option) {
            LembagaZiswafCheckbox::updateOrCreate(
                ['value' => $option['value']], // unique key to find the record
                $option
            );
        }
    }
}
