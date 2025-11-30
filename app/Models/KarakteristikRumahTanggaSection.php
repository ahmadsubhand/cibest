<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KarakteristikRumahTanggaSection extends Model
{
    /** @use HasFactory<\Database\Factories\KarakteristikRumahTanggaSectionFactory> */
    use HasFactory;

    protected $fillable = [
        'cibest_form_id',
        'nama_anggota',
        'hubungan_kepala_keluarga',
        'usia',
        'jenis_kelamin_id',
        'status_perkawinan_id',
        'pendidikan_formal_id',
        'pendidikan_non_id',
    ];

    // Kembali ke CibestForm (one-to-many)
    public function cibestForm()
    {
        return $this->belongsTo(CibestForm::class);
    }

    // Jenis Kelamin
    public function jenisKelaminOption()
    {
        return $this->belongsTo(JenisKelaminOption::class, 'jenis_kelamin_option_id');
    }

    // Status Perkawinan
    public function statusPerkawinanOption()
    {
        return $this->belongsTo(StatusPerkawinanOption::class, 'status_perkawinan_option_id');
    }

    // Pendidikan Formal
    public function pendidikanFormalOption()
    {
        return $this->belongsTo(PendidikanFormalOption::class, 'pendidikan_formal_option_id');
    }

    // Pendidikan Non Formal
    public function pendidikanNonFormalOption()
    {
        return $this->belongsTo(PendidikanNonFormalOption::class, 'pendidikan_non_formal_option_id');
    }
}
