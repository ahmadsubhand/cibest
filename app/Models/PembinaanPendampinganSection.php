<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembinaanPendampinganSection extends Model
{
    /** @use HasFactory<\Database\Factories\PembinaanPendampinganSectionFactory> */
    use HasFactory;

    protected $fillable = [
        'frekuensi_pendampingan_option_id',
        'pembinaan_spiritual',
        'pembinaan_usaha',
        'pendampingan_rutin',
    ];

    // Frekuensi Pendampingan (single select)
    public function frekuensiPendampinganOption()
    {
        return $this->belongsTo(FrekuensiPendampinganOption::class);
    }

    // --- Jenis Pelatihan (checkbox)
    public function jenisPelatihanCheckboxes()
    {
        return $this->belongsToMany(JenisPelatihanCheckbox::class);
    }

    // --- Pelatihan Sangat Membantu (checkbox)
    public function pelatihanSangatMembantuCheckboxes()
    {
        return $this->belongsToMany(JenisPelatihanCheckbox::class);
    }
}
