<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $table = 'pasien_kasus'; // 🔥 SESUAI DB
    protected $primaryKey = 'id_pasien';

    protected $allowedFields = [
        'NIK',
        'nama_pasien',
        'jenis_kelamin',
        'pekerjaan',
        'jumlah_keluarga',
        'pendidikan',
        'status_pernikahan',
        'tanggal_lahir',
        'tempat_lahir',
        'kelompok_usia',
        'pendapatan',
        'no_rm',
        'no_hp',
        'id_wilayah',
        'rt',
        'rw',
        'jumlah_keluarga',
        'id_user'
    ];
}