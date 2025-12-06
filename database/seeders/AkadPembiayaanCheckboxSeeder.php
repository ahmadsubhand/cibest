<?php

namespace Database\Seeders;

use App\Models\AkadPembiayaanCheckbox;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AkadPembiayaanCheckboxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            ['value' => 'Murabahah', 'is_other' => false],
            ['value' => 'Mudharabah', 'is_other' => false],
            ['value' => 'Musyarakah', 'is_other' => false],
            ['value' => 'Qardhul Hasan', 'is_other' => false],
            ['value' => 'Ijarah', 'is_other' => false],
        ];

        foreach ($options as $option) {
            AkadPembiayaanCheckbox::updateOrCreate(
                ['value' => $option['value']], // unique key to find the record
                $option
            );
        }
    }
}
