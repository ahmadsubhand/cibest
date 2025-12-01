<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Province::factory()->createMany([
            ['value' => 'Nanggroe Aceh Darussalam'],
            ['value' => 'Sumatera Utara'],
            ['value' => 'Sumatera Selatan'],
            ['value' => 'Sumatera Barat'],
            ['value' => 'Bengkulu'],
            ['value' => 'Riau'],
            ['value' => 'Kepulauan Riau'],
            ['value' => 'Jambi'],
            ['value' => 'Lampung'],
            ['value' => 'Bangka Belitung'],
            ['value' => 'Kalimantan Barat'],
            ['value' => 'Kalimantan Timur'],
            ['value' => 'Kalimantan Selatan'],
            ['value' => 'Kalimantan Tengah'],
            ['value' => 'Kalimantan Utara'],
            ['value' => 'Banten'],
            ['value' => 'DKI Jakarta'],
            ['value' => 'Jawa Barat'],
            ['value' => 'Jawa Tengah'],
            ['value' => 'Daerah Istimewa Yogyakarta'],
            ['value' => 'Jawa Timur'],
            ['value' => 'Bali'],
            ['value' => 'Nusa Tenggara Timur'],
            ['value' => 'Nusa Tenggara Barat'],
            ['value' => 'Gorontalo'],
            ['value' => 'Sulawesi Barat'],
            ['value' => 'Sulawesi Tengah'],
            ['value' => 'Sulawesi Utara'],
            ['value' => 'Sulawesi Tenggara'],
            ['value' => 'Sulawesi Selatan'],
            ['value' => 'Maluku Utara'],
            ['value' => 'Maluku'],
            ['value' => 'Papua Barat'],
            ['value' => 'Papua'],
            ['value' => 'Papua Tengah'],
            ['value' => 'Papua Pegunungan'],
            ['value' => 'Papua Selatan'],
            ['value' => 'Papua Barat Daya'],
        ]);
    }
}
