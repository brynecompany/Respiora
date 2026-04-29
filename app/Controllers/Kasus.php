<?php

namespace App\Controllers;

use App\Models\PasienModel;
use App\Controllers\BaseController;

class Kasus extends BaseController
{
    public function index()
    {
        $model = new PasienModel();

        // =====================
        // 📈 DATA TREND
        // =====================
        $tahunList = $model->getTrendTahun(); 
        $tahunDefault = $tahunList[0]->label ?? date('Y');

        // =====================
        // 📊 DATA KELURAHAN
        // =====================
        $wilayah = $model->getWilayah();          // dari wilayah_kasus
        $jumlah  = $model->getJumlahPerWilayah(); // dari pasien_kasus

        // mapping ID → nama kelurahan
        $mapKel = [
            1 => 'Jemberkidul',
            2 => 'Tegalbesar',
            3 => 'Kaliwates',
            4 => 'Kebonagung',
            5 => 'Sempusari',
            6 => 'Mangli',
            7 => 'Kepatihan'
        ];

        // mapping jumlah kasus
        $mapJumlah = [];
        foreach ($jumlah as $j) {
            $mapJumlah[$j['id_wilayah']] = $j['jumlah'];
        }

        $kelLabels = [];
        $kelValues = [];

        foreach ($wilayah as $w) {
            $idWilayah = $w['id_wilayah'];
            $idKel     = $w['kelurahan']; // ini ID kelurahan (angka)

            $kelLabels[] = $mapKel[$idKel] ?? 'Unknown';
            $kelValues[] = $mapJumlah[$idWilayah] ?? 0;
        }

        return view('kasus/index', [
            'tahun' => $tahunList,
            'bulan' => $model->getTrendBulanByTahun($tahunDefault),
            'tahunDefault' => $tahunDefault,
            'kelurahanLabels' => json_encode($kelLabels),
            'kelurahanValues' => json_encode($kelValues)
        ]);
    }

    // =====================
    // 🔥 AJAX BULAN
    // =====================
    public function getBulan($tahun)
    {
        $model = new PasienModel();
        $data = $model->getTrendBulanByTahun($tahun);

        $bulanMap = [
            '01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr',
            '05'=>'Mei','06'=>'Jun','07'=>'Jul','08'=>'Agu',
            '09'=>'Sep','10'=>'Okt','11'=>'Nov','12'=>'Des'
        ];

        $labels = [];
        foreach ($data as $d) {
            $labels[] = $bulanMap[$d->bulan];
        }

        return $this->response->setJSON([
            'labels' => $labels,
            'data' => array_column($data, 'jumlah')
        ]);
    }
}