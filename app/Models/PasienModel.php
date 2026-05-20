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
        'id_user'
    ];
    // =====================
    // 📈 TAHUNAN
    // =====================
    public function getTrendTahun()
    {
        return $this->db->table('pasien_kasus')
            ->select("YEAR(tanggal_kasus) as label, COUNT(*) as jumlah")
            ->groupBy("YEAR(tanggal_kasus)")
            ->orderBy("label", "ASC")
            ->get()
            ->getResult();
    }

    // =====================
    // 📈 BULANAN
    // =====================
    public function getTrendBulanByTahun($tahun)
    {
        return $this->db->table('pasien_kasus')
            ->select("MONTH(tanggal_kasus) as bulan, COUNT(*) as jumlah")
            ->where("YEAR(tanggal_kasus)", $tahun)
            ->groupBy("MONTH(tanggal_kasus)")
            ->orderBy("bulan", "ASC")
            ->get()
            ->getResult();
    }

    // =====================
    // 📊 WILAYAH
    // =====================
    public function getWilayah()
    {
        return $this->db->table('wilayah_kasus')
            ->select('id_wilayah, kelurahan')
            ->get()
            ->getResultArray();
    }

    // =====================
    // 📊 JUMLAH PER WILAYAH
    // =====================
    public function getJumlahPerWilayah()
    {
        return $this->db->table('pasien_kasus')
            ->select('id_wilayah, COUNT(*) as jumlah')
            ->groupBy('id_wilayah')
            ->get()
            ->getResultArray();
    }

    // =====================
    // 📊 KELOMPOK USIA
    // =====================
    public function getKelompokUsia()
{
    return $this->db->query("
        SELECT kelompok_usia, COUNT(*) as jumlah
        FROM pasien_kasus
        GROUP BY kelompok_usia
    ")->getResultArray();
}

    // =====================
    // 💊 STATUS PENGOBATAN
    // =====================
    public function getStatusPengobatan()
    {
        return $this->db->table('pasien_kasus')
            ->select('status_pengobatan, COUNT(*) as jumlah')
            ->groupBy('status_pengobatan')
            ->get()
            ->getResultArray();
    }

    // =====================
    // 🚻 JENIS KELAMIN
    // =====================
    public function getJenisKelamin()
    {
        $data = $this->db->table('pasien_kasus')
            ->select('jenis_kelamin, COUNT(*) as jumlah')
            ->groupBy('jenis_kelamin')
            ->get()
            ->getResultArray();

        $result = [];
        foreach ($data as $d) {
            $result[$d['jenis_kelamin']] = $d['jumlah'];
        }

        return $result;
    }
}
