<?php

namespace App\Models;

use CodeIgniter\Model;

class Skrining_model extends Model
{
    protected $table = 'skrining';

    protected $allowedFields = [
        'nik','nama','jenis_kelamin','tanggal_lahir', 'kategori_usia',
        'provinsi','kabupaten','kecamatan','kelurahan','kode_pos','tanggal_skrining',
        'batuk','berat','benjol','punggung','lemas','demam',
        'darah','dahak','nafsu','kelenjar','keringat','dada','sesak',
        'hasil'
    ];
}