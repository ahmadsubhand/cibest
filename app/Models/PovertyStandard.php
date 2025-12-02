<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PovertyStandard extends Model
{
    /** @use HasFactory<\Database\Factories\PovertyStandardFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name', 'nilai_keluarga', 'nilai_per_tahun', 'log_natural', 'index_kesejahteraan_cibest', 'besaran_nilai_cibest_model'
    ];

    public function cibestForms()
    {
        return $this->belongsToMany(CibestForm::class, 'cibest_quadrants', 'poverty_id', 'form_id');
    }
}
