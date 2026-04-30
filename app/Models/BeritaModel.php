<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';

    protected $allowedFields = [
        'judul_berita',
        'status_berita',
        'gambar_berita',
        'deskripsi_berita',
        'tanggal_berita'
    ];

    protected $useTimestamps = false;
}