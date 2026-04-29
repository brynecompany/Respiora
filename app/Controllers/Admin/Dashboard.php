<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        // Query tren tahunan
        $trendQuery = $db->query("
            SELECT YEAR(tanggal_lahir) as tahun, COUNT(*) as total 
            FROM pasien_kasus 
            GROUP BY YEAR(tanggal_lahir) 
            ORDER BY tahun ASC
        ");
        $trendData = $trendQuery->getResultArray();

        // Query tren bulanan
        $tahunIni = date('Y');
        $bulanQuery = $db->query("
            SELECT MONTH(tanggal_lahir) as bulan, COUNT(*) as total 
            FROM pasien_kasus 
            WHERE YEAR(tanggal_lahir) = {$tahunIni}
            GROUP BY MONTH(tanggal_lahir) 
            ORDER BY bulan ASC
        ");
        $bulanData = $bulanQuery->getResultArray();

        $namaBulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'];
        $bulanLabels = [];
        $bulanValues = [];
        foreach ($bulanData as $row) {
            $bulanLabels[] = $namaBulan[$row['bulan'] - 1];
            $bulanValues[] = (int)$row['total'];
        }

        // Query kelurahan
        $kelurahanQuery = $db->query("
            SELECT w.kelurahan, COUNT(p.id_pasien) as total 
            FROM pasien_kasus p 
            JOIN wilayah_kasus w ON p.id_wilayah = w.id_wilayah 
            GROUP BY w.kelurahan 
            ORDER BY total DESC 
            LIMIT 10
        ");
        $kelurahanData = $kelurahanQuery->getResultArray();

        // Query kelompok usia
        $usiaQuery = $db->query("
            SELECT kelompok_usia, COUNT(*) as total 
            FROM pasien_kasus 
            GROUP BY kelompok_usia 
            ORDER BY kelompok_usia ASC
        ");
        $usiaData = $usiaQuery->getResultArray();

        // Query jenis kelamin
        $jkQuery = $db->query("
            SELECT 
                SUM(CASE WHEN jenis_kelamin = 1 THEN 1 ELSE 0 END) as laki_laki,
                SUM(CASE WHEN jenis_kelamin = 2 THEN 1 ELSE 0 END) as perempuan 
            FROM pasien_kasus
        ");
        $jkData = $jkQuery->getRow();

        // Query total pasien
        $totalQuery = $db->query("SELECT COUNT(*) as total FROM pasien_kasus");
        $totalData  = $totalQuery->getRow();

        // Query status pengobatan — ambil status terakhir per pasien
        $statusQuery = $db->query("
            SELECT 
                SUM(CASE WHEN sp.status = 1 THEN 1 ELSE 0 END) as dalam_pengobatan,
                SUM(CASE WHEN sp.status = 2 THEN 1 ELSE 0 END) as sembuh,
                SUM(CASE WHEN sp.status = 3 THEN 1 ELSE 0 END) as drop_out,
                SUM(CASE WHEN sp.status = 4 THEN 1 ELSE 0 END) as meninggal
            FROM status_pengobatan sp
            INNER JOIN (
                SELECT id_pasien, MAX(id_status) as id_status
                FROM status_pengobatan
                GROUP BY id_pasien
            ) latest ON sp.id_status = latest.id_status
        ");
        $statusData = $statusQuery->getRow();

        $data = [
            'trend_labels'      => json_encode(array_column($trendData, 'tahun')),
            'trend_values'      => json_encode(array_map('intval', array_column($trendData, 'total'))),
            'bulan_labels'      => json_encode($bulanLabels),
            'bulan_values'      => json_encode($bulanValues),
            'kelurahan_labels'  => json_encode(array_column($kelurahanData, 'kelurahan')),
            'kelurahan_values'  => json_encode(array_map('intval', array_column($kelurahanData, 'total'))),
            'usia_labels'       => json_encode(array_map('intval', array_column($usiaData, 'kelompok_usia'))),
            'usia_values'       => json_encode(array_map('intval', array_column($usiaData, 'total'))),
            'laki_laki'         => (int)($jkData->laki_laki ?? 0),
            'perempuan'         => (int)($jkData->perempuan ?? 0),
            'total_pasien'      => (int)($totalData->total ?? 0),
            'dalam_pengobatan'  => (int)($statusData->dalam_pengobatan ?? 0),
            'sembuh'            => (int)($statusData->sembuh ?? 0),
            'drop_out'          => (int)($statusData->drop_out ?? 0),
            'meninggal'         => (int)($statusData->meninggal ?? 0),
        ];

       return view('dashboard/index', $data);   
    }
}