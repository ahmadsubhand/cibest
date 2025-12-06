<?php

namespace Database\Seeders;

use App\Models\JenisPelatihanCheckbox;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPelatihanCheckboxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            ['value' => 'Pelatihan kewirausahaan', 'is_other' => false],
            ['value' => 'Perencanaan keuangan', 'is_other' => false],
            ['value' => 'Keuangan dan akuntansi sederhana', 'is_other' => false],
            ['value' => 'Literasi dan edukasi keuangan syariah', 'is_other' => false],
            ['value' => 'Pemasaran digital dan e-commerce', 'is_other' => false],
            ['value' => 'Pelatihan inovasi produk & desain kemasan', 'is_other' => false],
            ['value' => 'Keterampilan teknis (produksi, kerajinan, pertanian, peternakan, dsb.)', 'is_other' => false],
        ];

        foreach ($options as $option) {
            JenisPelatihanCheckbox::updateOrCreate(
                ['value' => $option['value']], // unique key to find the record
                $option
            );
        }
    }
}
