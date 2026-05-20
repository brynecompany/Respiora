<?php
namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $wilayahNames = [
        1 => 'Jemberkidul',
        2 => 'Tegalbesar',
        3 => 'Kaliwates',
        4 => 'Kebonagung',
        5 => 'Sempusari',
        6 => 'Mangli',
        7 => 'Kepatihan'];

        $db = \Config\Database::connect();

        // TOTAL SEMUA KASUS

        $totalKasus = $db->table('pasien_kasus')->countAll();

        $bulan = date('m');
        $tahun = date('Y');

        $kasusBulanIni = $db->table('pasien_kasus')
            ->where('MONTH(tanggal_kasus)', $bulan)
            ->where('YEAR(tanggal_kasus)', $tahun)
            ->countAllResults(); 

        // TOTAL KELURAHAN 
        $totalKelurahan = $db->table('wilayah_kasus')->countAll();
        
        $tahunIni = date('Y');
        //$tahunIni = 2019;

        $bulanQuery = $db->query("
            SELECT MONTH(tanggal_kasus) as bulan, COUNT(*) as total 
            FROM pasien_kasus 
            WHERE YEAR(tanggal_kasus) = {$tahunIni}
            GROUP BY MONTH(tanggal_kasus)
            ORDER BY bulan ASC
        ");

        $bulanData = $bulanQuery->getResultArray();

        $namaBulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agst','Sep','Okt','Nov','Des'];

        $bulanLabels = [];
        $bulanValues = [];

        // isi default 0 biar ga bolong grafiknya
        for ($i=1; $i<=12; $i++) {
            $bulanLabels[] = $namaBulan[$i-1];
            $bulanValues[] = 0;
        }

        foreach ($bulanData as $row) {
            $index = $row['bulan'] - 1;
            $bulanValues[$index] = (int)$row['total'];
        }

        // TREND TAHUNAN
        $trendQuery = $db->query("
            SELECT YEAR(tanggal_kasus) as tahun, COUNT(*) as total 
            FROM pasien_kasus 
            GROUP BY YEAR(tanggal_kasus)
            ORDER BY tahun ASC
        ");

        $trendData = $trendQuery->getResultArray();

        $trend_labels = json_encode(array_column($trendData, 'tahun'));
        $trend_values = json_encode(array_map('intval', array_column($trendData, 'total')));

        // =========================
        // TAMBAHAN PETA (K-MEANS)
        // =========================

        $dataWilayah = $db->query(" 
            SELECT 
                w.id_wilayah,
                w.kelurahan as nama_wilayah,
                w.jumlah_penduduk,
                COUNT(p.id_pasien) as jumlah_kasus,
                (COUNT(p.id_pasien)/NULLIF(w.jumlah_penduduk,0))*100000 as incidence_rate
            FROM wilayah_kasus w
            LEFT JOIN pasien_kasus p 
            ON p.id_wilayah = w.id_wilayah
            GROUP BY w.id_wilayah
        ")->getResult();

        // ambil incidence rate
        $rates = array_map(function($item){
            return $item->incidence_rate ?? 0;
        }, $dataWilayah);

        // centroid awal (AMAN)
        $centroids = [
            $rates[0] ?? 1,
            $rates[1] ?? 5,
            $rates[2] ?? 10
        ];

        // K-MEANS ITERASI
        for($iter=0; $iter<10; $iter++) {

            $clusters = [[],[],[]];

            foreach($dataWilayah as $key => $item) {
                $rate = $item->incidence_rate ?? 0;

                $distances = [
                    abs($rate - $centroids[0]),
                    abs($rate - $centroids[1]),
                    abs($rate - $centroids[2])
                ];

                $clusterIndex = array_search(min($distances), $distances);

                $clusters[$clusterIndex][] = $rate;
                $dataWilayah[$key]->cluster = $clusterIndex;
            }

            for($i=0; $i<3; $i++){
                if(count($clusters[$i]) > 0){
                    $centroids[$i] = array_sum($clusters[$i]) / count($clusters[$i]);
                }
            }
        }

        // URUTKAN CLUSTER (RENDAH → TINGGI)
        $sortedCentroids = $centroids;
        asort($sortedCentroids);

        $clusterLabel = [];
        $rank = 0;

        foreach($sortedCentroids as $index => $value){
            $clusterLabel[$index] = $rank;
            $rank++;
        }

        foreach($dataWilayah as $key => $item){
            $dataWilayah[$key]->cluster = $clusterLabel[$item->cluster];
        }

        $risiko = [
            'tinggi' => [],
            'sedang' => [],
            'rendah' => []
        ];

        foreach($dataWilayah as $w){

            if($w->cluster == 2){
                $risiko['tinggi'][] = $w;
            } elseif($w->cluster == 1){
                $risiko['sedang'][] = $w;
            } else {
                $risiko['rendah'][] = $w;
            }
        }
        // =========================
        // RETURN VIEW
        // =========================

        return view('dashboard', [
            'totalKasus' => $totalKasus,
            'kasusBulanIni' => $kasusBulanIni,
            'totalKelurahan' => $totalKelurahan,
            'bulanLabels' => json_encode($bulanLabels),
            'bulanValues' => json_encode($bulanValues),
            'wilayahNames' => $wilayahNames,
            'trend_labels' => $trend_labels,
            'trend_values' => $trend_values,
            'risiko' => $risiko,
            // INI WAJIB UNTUK MAP
            'wilayah_kasus' => $dataWilayah
        ]);
    }

    // =========================
    // FILTER PER TAHUN (ASLI)
    // =========================
    public function getByYear($tahun)
    {
        $db = \Config\Database::connect();

        $query = $db->query("
            SELECT MONTH(tanggal_kasus) as bulan, COUNT(*) as total 
            FROM pasien_kasus 
            WHERE YEAR(tanggal_kasus) = {$tahun}
            GROUP BY MONTH(tanggal_kasus)
            ORDER BY bulan ASC
        ");

        $data = $query->getResultArray();

        $namaBulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agst','Sep','Okt','Nov','Des'];

        $labels = [];
        $values = [];

        for ($i=1; $i<=12; $i++) {
            $labels[] = $namaBulan[$i-1];
            $values[] = 0;
        }

        foreach ($data as $row) {
            $values[$row['bulan']-1] = (int)$row['total'];
        }

        return $this->response->setJSON([
            'labels' => $labels,
            'data' => $values
        ]);
    }
}