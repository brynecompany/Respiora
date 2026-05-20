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
        // 📈 DATA TAHUN
        // =====================
        $tahunList = $model->getTrendTahun(); 
        $tahunDefault = $tahunList[0]->label ?? date('Y');

        // =====================
        // 📈 DATA BULAN (FULL 12)
        // =====================
        $bulanRaw = $model->getTrendBulanByTahun($tahunDefault);

        $bulanMap = [
            1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',
            5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',
            9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'
        ];

        $bulanFull = array_fill(1, 12, 0);

        foreach ($bulanRaw as $b) {
            $bulanFull[(int)$b->bulan] = (int)$b->jumlah;
        }

        $bulanLabels = array_values($bulanMap);
        $bulanValues = array_values($bulanFull);

        // =====================
        // 📊 KELURAHAN
        // =====================
        $wilayah = $model->getWilayah();
        $jumlah  = $model->getJumlahPerWilayah();

        $mapKel = [
            1=>'Jemberkidul',2=>'Tegalbesar',3=>'Kaliwates',
            4=>'Kebonagung',5=>'Sempusari',6=>'Mangli',7=>'Kepatihan'
        ];

        $mapJumlah = [];
        foreach ($jumlah as $j) {
            $mapJumlah[$j['id_wilayah']] = $j['jumlah'];
        }

        $kelLabels = [];
        $kelValues = [];

        foreach ($wilayah as $w) {
            $idWilayah = $w['id_wilayah'];
            $idKel     = $w['kelurahan'];

            $kelLabels[] = $mapKel[$idKel] ?? 'Unknown';
            $kelValues[] = $mapJumlah[$idWilayah] ?? 0;
        }

        // =====================
        // 📊 KELOMPOK USIA
        // =====================
       $usia = $model->getKelompokUsia();

$mapUsia = [
    1 => '0-4 tahun',
    2 => '5-9 tahun',
    3 => '10-18 tahun',
    4 => '19-59 tahun',
    5 => '>60 tahun'
];

$defaultUsia = [
    1 => 0,
    2 => 0,
    3 => 0,
    4 => 0,
    5 => 0
];

foreach ($usia as $u) {
    $defaultUsia[$u['kelompok_usia']] = $u['jumlah'];
}

$usiaLabels = [];
$usiaValues = [];

foreach ($defaultUsia as $key => $val) {
    $usiaLabels[] = $mapUsia[$key];
    $usiaValues[] = $val;
}

        // =====================
        // 💊 STATUS PENGOBATAN
        // =====================
        $pengobatan = $model->getStatusPengobatan();

        $pengobatanLabels = [];
        $pengobatanValues = [];

        foreach ($pengobatan as $p) {
            $pengobatanLabels[] = $p['status_pengobatan'];
            $pengobatanValues[] = $p['jumlah'];
        }

        // =====================
        // 🚻 JENIS KELAMIN
        // =====================
        $jk = $model->getJenisKelamin();

        $jkLabels = ['Laki-laki','Perempuan'];
        $jkValues = [
            $jk[1] ?? 0,
            $jk[2] ?? 0
        ];

        // =====================
        // RETURN VIEW grafik/kasus/index
        // =====================
        return view('kasus/index', [
            'tahun' => $tahunList,
            'tahunDefault' => $tahunDefault,

            'bulanLabels' => json_encode($bulanLabels),
            'bulanValues' => json_encode($bulanValues),

            'kelurahanLabels' => json_encode($kelLabels),
            'kelurahanValues' => json_encode($kelValues),

            'usiaLabels' => json_encode($usiaLabels),
            'usiaValues' => json_encode($usiaValues),

            'pengobatanLabels' => json_encode($pengobatanLabels),
            'pengobatanValues' => json_encode($pengobatanValues),

            'jkLabels' => json_encode($jkLabels),
            'jkValues' => json_encode($jkValues)
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
            1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',
            5=>'Mei',6=>'Jun',7=>'Jul',8=>'Agu',
            9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'
        ];

        $full = array_fill(1, 12, 0);

        foreach ($data as $d) {
            $full[(int)$d->bulan] = (int)$d->jumlah;
        }

        return $this->response->setJSON([
            'labels' => array_values($bulanMap),
            'data' => array_values($full)
        ]);
    }
}