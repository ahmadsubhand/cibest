<?php

namespace Database\Seeders;

use App\Models\ProgramBantuanCheckbox;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramBantuanCheckboxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            ['value' => 'Zakat Community Development (ZCD)', 'is_other' => false],
            ['value' => 'BAZNAS Micro Finance (BMFi)', 'is_other' => false],
            ['value' => 'Lembaga Pemberdayaan Ekonomi Mustahik (LPEM)', 'is_other' => false],
            ['value' => 'Layanan Aktif BAZNAS (LAB)', 'is_other' => false],
            ['value' => 'Lembaga Beasiswa BAZNAS (LBB)', 'is_other' => false],
            ['value' => 'Sekolah Cendekia BAZNAS', 'is_other' => false],
            ['value' => 'BAZNAS Tanggap Bencana (BTB)', 'is_other' => false],
            ['value' => 'Mualaf Center BAZNAS (MCB)', 'is_other' => false],
            ['value' => 'Rumah Sehat BAZNAS (RSB)', 'is_other' => false],
            ['value' => 'Layanan Publik', 'is_other' => false],
            ['value' => 'Lembaga Pemberdayaan Peternak Mustahik (LPPM)', 'is_other' => false],
        ];

        foreach ($options as $option) {
            ProgramBantuanCheckbox::updateOrCreate(
                ['value' => $option['value']], // unique key to find the record
                $option
            );
        }
    }
}
