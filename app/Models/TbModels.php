<?php

namespace App\Models;

use CodeIgniter\Model;

class TbModel extends Model
{
    protected $table = 'tb_data';
    protected $primaryKey = 'id_tb';

    protected $allowedFields = [
        'id_pasien',

        'no_reg_fasyankes',
        'no_reg_tbc_kab',
        'no_register_sitb',
        'no_bpjs',
        'kode_fasyankes',
        'nama_fasyankes',

        'tgl_mulai_pengobatan',
        'pemeriksaan_igra',
        'panduan_oat',
        'tgl_akhir_pengobatan',
        'hasil_akhir_pengobatan',
        'tgl_tes_hiv',
        'hasil_tes_hiv',

        'status_pengobatan',
        'status_hamil',
        'nama_fasyankes_rujukan',
        'pemeriksaan_kontak',
        'dirujuk_oleh',
        'tipe_diagnosis',
        'klasifikasi_lokasi',
        'klasifikasi_riwayat',
        'skoring_anak',
        'hasil_foto_toraks',
        'dm',
        'terapi_dm'
    ];
}