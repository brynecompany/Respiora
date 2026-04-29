<?php

namespace App\Models;
use CodeIgniter\Model;

class PasienModel extends Model
{
    // 🔥 gak perlu bergantung ke 1 table
    protected $table = 'pasien_kasus';

    // =====================
    // 📈 TREND (PASIENT)
    // =====================
    public function getTrendTahun()
    {
        return $this->db->table('pasien_kasus')
            ->select("YEAR(tanggal_kasus) as label, COUNT(*) as jumlah")
            ->groupBy('label')
            ->orderBy('label', 'ASC')
            ->get()
            ->getResult();
    }

    public function getTrendBulanByTahun($tahun)
    {
        return $this->db->table('pasien_kasus')
            ->select("DATE_FORMAT(tanggal_kasus, '%m') as bulan, COUNT(*) as jumlah")
            ->where('YEAR(tanggal_kasus)', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan', 'ASC')
            ->get()
            ->getResult();
    }

    // =====================
    // 📊 KELURAHAN (WILAYAH)
    // =====================
    public function getKelurahan()
    {
        return $this->db->table('wilayah_kasus')
            ->select('id_wilayah, nama_kelurahan') // sesuaikan nama kolom!
            ->get()
            ->getResultArray();
    }

    public function getJumlahPerWilayah()
{
    return $this->db->table('pasien_kasus')
        ->select('id_wilayah, COUNT(*) as jumlah')
        ->groupBy('id_wilayah')
        ->get()
        ->getResultArray();
}

public function getWilayah()
{
    return $this->db->table('wilayah_kasus')
        ->select('id_wilayah, kelurahan') // ⬅️ ini angka
        ->get()
        ->getResultArray();
}

}