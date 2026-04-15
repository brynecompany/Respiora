<?php

namespace App\Controllers;

class Peta extends BaseController
{
    public function index()
    {

        $db = \Config\Database::connect(); //koneksi db

        //ambil dari db, hitung jumlah_kasus & incidence_rate
        $data = $db->query(" 
            SELECT 
                w.id_wilayah,
                w.jumlah_penduduk,
                COUNT(p.id_pasien) as jumlah_kasus,
                (COUNT(p.id_pasien)/w.jumlah_penduduk)*100000 as incidence_rate
            FROM wilayah_kasus w
            LEFT JOIN pasien_kasus p 
            ON p.id_wilayah = w.id_wilayah
            GROUP BY w.id_wilayah
            
        ")->getResult();
       

//ambil angka incidence_rate dari semua kelurahan
$rates = array_map(function($item){
    return $item->incidence_rate;
}, $data);

// Tentukan centroid awal (ambil 3 nilai pertama)
$centroids = [
    $rates[0],
    $rates[1],
    $rates[2]
];

// proses K-Means
for($iter=0; $iter<10; $iter++) {

    $clusters = [[],[],[]];

    foreach($data as $key => $item) {
        $distances = [
            abs($item->incidence_rate - $centroids[0]),
            abs($item->incidence_rate - $centroids[1]),
            abs($item->incidence_rate - $centroids[2])
        ];

        $clusterIndex = array_search(min($distances), $distances);

        $clusters[$clusterIndex][] = $item->incidence_rate;
        $data[$key]->cluster = $clusterIndex;
    }

    for($i=0; $i<3; $i++){
        if(count($clusters[$i]) > 0){
            $centroids[$i] = array_sum($clusters[$i]) / count($clusters[$i]);
        }
    }
}

//urutkan cluster dari resarnya risiko 
$sortedCentroids = $centroids;
asort($sortedCentroids);

$clusterLabel = [];
$rank = 0;

foreach($sortedCentroids as $index => $value){
    $clusterLabel[$index] = $rank;
    $rank++;
}

foreach($data as $key => $item){
    $data[$key]->cluster = $clusterLabel[$item->cluster];
}

        return view('peta_view', [ //kirim data ke view
            'wilayah_kasus' => $data,
            'menu' => 'petasebaran' //tombol aktif sidebar
        ]);
    }

    public function testdb() //TEST DB AJA
{
    $db = \Config\Database::connect();
    return "Koneksi Berhasil!";
}

}