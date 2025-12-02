<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            AkadPembiayaanCheckboxSeeder::class,
            FrekuensiPendampinganOptionSeeder::class,
            JangkaWaktuOptionSeeder::class,
            JenisKelaminOptionSeeder::class,
            JenisPekerjaanOptionSeeder::class,
            JenisPelatihanCheckboxSeeder::class,
            KeteranganKebijakanPemerintahLikertSeeder::class,
            KeteranganLingkunganKeluargaLikertSeeder::class,
            KeteranganPuasaLikertSeeder::class,
            KeteranganShalatLikertSeeder::class,
            KeteranganZakatInfakLikertSeeder::class,
            LembagaZiswafCheckboxSeeder::class,
            PembiayaanLainCheckboxSeeder::class,
            PendidikanFormalOptionSeeder::class,
            PendidikanNonformalOptionSeeder::class,
            ProgramBantuanCheckboxSeeder::class,
            StatusPekerjaanOptionSeeder::class,
            StatusPerkawinanOptionSeeder::class,
            PenggunaanPembiayaanCheckboxSeeder::class,
            ProvinceSeeder::class,
            PovertyStandardSeeder::class,
        ]);
    }
}
