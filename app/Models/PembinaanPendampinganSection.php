<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembinaanPendampinganSection extends Model
{
    /** @use HasFactory<\Database\Factories\PembinaanPendampinganSectionFactory> */
    use HasFactory;

    protected $fillable = [
        'frekuensi_id',
        'pembinaan_spiritual',
        'pembinaan_usaha',
        'pendampingan_rutin',
    ];

    // Frekuensi Pendampingan (single select)
    public function frekuensiPendampinganOption()
    {
        return $this->belongsTo(FrekuensiPendampinganOption::class, 'frekuensi_id');
    }

    // Checkbox: jenis pelatihan yang diikuti
    public function jenisPelatihanCheckboxes()
    {
        return $this->belongsToMany(JenisPelatihanCheckbox::class, 'jenis_pembinaan', 'pembinaan_id', 'jenis_id');
    }

    // Checkbox: pelatihan yang sangat membantu
    public function pelatihanSangatMembantuCheckboxes()
    {
        return $this->belongsToMany(JenisPelatihanCheckbox::class, 'membantu_pembinaan', 'pembinaan_id', 'jenis_id');
    }
}
