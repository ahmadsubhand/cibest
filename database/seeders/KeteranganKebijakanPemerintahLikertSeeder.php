<?php

namespace Database\Seeders;

use App\Models\KeteranganKebijakanPemerintahLikert;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeteranganKebijakanPemerintahLikertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            ['value' => '1', 'description' => 'Melarang ibadah untuk setiap keluarga'],
            ['value' => '2', 'description' => 'Menolak pelaksanaan ibadah'],
            ['value' => '3', 'description' => 'Menganggap ibadah sebagai urusan pribadi masyarakat'],
            ['value' => '4', 'description' => 'Mendukung ibadah'],
            ['value' => '5', 'description' => 'Menciptakan lingkungan yang kondusif untuk ibadah'],
        ];

        foreach ($options as $option) {
            KeteranganKebijakanPemerintahLikert::updateOrCreate(
                ['value' => $option['value']], // unique key to find the record
                $option
            );
        }
    }
}
