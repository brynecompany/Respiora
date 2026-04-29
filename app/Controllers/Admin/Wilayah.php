<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Wilayah extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // ================= PROVINSI =================
    public function provinsi()
    {
        return $this->response->setJSON(
            $this->db->query("
                SELECT DISTINCT provinsi 
                FROM wilayah_kasus
            ")->getResult()
        );
    }

    // ================= KABUPATEN =================
    public function kabupaten($provinsi)
    {
        return $this->response->setJSON(
            $this->db->query("
                SELECT DISTINCT kabupaten 
                FROM wilayah_kasus 
                WHERE provinsi = ?
            ", [$provinsi])->getResult()
        );
    }

    // ================= KECAMATAN =================
    public function kecamatan($kabupaten)
    {
        return $this->response->setJSON(
            $this->db->query("
                SELECT DISTINCT kecamatan 
                FROM wilayah_kasus 
                WHERE kabupaten = ?
            ", [$kabupaten])->getResult()
        );
    }

    // ================= KELURAHAN =================
    public function kelurahan($kecamatan)
    {
        return $this->response->setJSON(
            $this->db->query("
                SELECT id_wilayah, kelurahan, kode_pos 
                FROM wilayah_kasus 
                WHERE kecamatan = ?
            ", [$kecamatan])->getResult()
        );
    }
}