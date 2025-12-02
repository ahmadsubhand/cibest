<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendapatanKetenagakerjaanSection extends Model
{
    /** @use HasFactory<\Database\Factories\PendapatanKetenagakerjaanSectionFactory> */
    use HasFactory;

    protected $fillable = [
        'cibest_form_id',
        'nama_anggota',
        'status_id',
        'jenis_id',
        'rata_rata_pendapatan',
        'pendapatan_tidak_tetap',
        'pendapatan_aset',
        'total_pendapatan_sebelum',
        'total_pendapatan_setelah'
    ];

    // --- Kembali ke form induk
    public function cibestForm()
    {
        return $this->belongsTo(CibestForm::class);
    }

    // --- Status Pekerjaan (single select)
    public function statusPekerjaanOption()
    {
        return $this->belongsTo(StatusPekerjaanOption::class);
    }

    // --- Jenis Pekerjaan (single select)
    public function jenisPekerjaanOption()
    {
        return $this->belongsTo(JenisPekerjaanOption::class);
    }
}
