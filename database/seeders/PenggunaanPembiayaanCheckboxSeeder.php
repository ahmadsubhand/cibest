<?php

namespace Database\Seeders;

use App\Models\PenggunaanPembiayaanCheckbox;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenggunaanPembiayaanCheckboxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            ['value' => 'Modal kerja', 'is_other' => false],
            ['value' => 'Investasi/tabungan', 'is_other' => false],
            ['value' => 'Pendidikan', 'is_other' => false],
            ['value' => 'Kesehatan', 'is_other' => false],
            ['value' => 'Bayar utang', 'is_other' => false],
            ['value' => 'Dana darurat', 'is_other' => false],
        ];

        foreach ($options as $option) {
            PenggunaanPembiayaanCheckbox::updateOrCreate(
                ['value' => $option['value']], // unique key to find the record
                $option
            );
        }
    }
}
