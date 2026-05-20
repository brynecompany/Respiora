<?php

namespace App\Controllers;

use App\Models\Skrining_model;
use Dompdf\Dompdf;

class Skrining extends BaseController
{
    // STEP 1 (DATA DIRI)
    public function step1()
    {
        return view('skrining_data');
    }

    // STEP 2 (SIMPAN SESSION + KE GEJALA)
    public function step2()
{
    if (
        !$this->request->getPost('nik') ||
        !$this->request->getPost('nama') ||
        !$this->request->getPost('jenis_kelamin')
    ) {
        return redirect()->back()->with('error', 'Data wajib diisi!');
    }

    session()->set([
        'nik' => $this->request->getPost('nik'),
        'nama' => $this->request->getPost('nama'),
        'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
        'kategori_usia' => $this->request->getPost('kategori_usia'),
        'provinsi' => $this->request->getPost('provinsi_text'),
        'kabupaten' => $this->request->getPost('kabupaten_text'),
        'kecamatan' => $this->request->getPost('kecamatan_text'),
        'kelurahan' => $this->request->getPost('kelurahan'),
        'kode_pos' => $this->request->getPost('kode_pos'),
        'tanggal_skrining' => date('Y-m-d'),
    ]);

    return view('skrining_form');
}

    // PROSES AKHIR
    public function proses()
    {
        $model = new Skrining_model();

        $data = [
            // DATA DIRI (DARI SESSION)
            'nik' => session()->get('nik'),
            'nama' => session()->get('nama'),
            'jenis_kelamin' => session()->get('jenis_kelamin'),
            'tanggal_lahir' => session()->get('tanggal_lahir'),
            'kategori_usia' => session()->get('kategori_usia'),
            'provinsi' => session()->get('provinsi'),
            'kabupaten' => session()->get('kabupaten'),
            'kecamatan' => session()->get('kecamatan'),
            'kelurahan' => session()->get('kelurahan'),
            'kode_pos' => session()->get('kode_pos'),
            'tanggal_skrining' => session()->get('tanggal_skrining'),

            // GEJALA
            'batuk' => $this->request->getPost('batuk'),
            'berat' => $this->request->getPost('berat'),
            'benjol' => $this->request->getPost('benjol'),
            'punggung' => $this->request->getPost('punggung'),
            'lemas' => $this->request->getPost('lemas'),
            'demam' => $this->request->getPost('demam'),
            'darah' => $this->request->getPost('darah'),
            'dahak' => $this->request->getPost('dahak'),
            'nafsu' => $this->request->getPost('nafsu'),
            'kelenjar' => $this->request->getPost('kelenjar'),
            'keringat' => $this->request->getPost('keringat'),
            'dada' => $this->request->getPost('dada'),
            'sesak' => $this->request->getPost('sesak'),
        ];

        // LOGIC TB
        // LOGIC TB
if ($data['batuk'] == 0) {
    $hasil = "Tidak TB";
} else {
    if ($data['berat'] == 1 || $data['darah'] == 1 || $data['sesak'] == 1) {
        $hasil = "TB";
    } else {
        $hasil = "Tidak TB";
    }
}

// 🔥 WAJIB BANGET INI
$data['hasil'] = $hasil;

$model->insert($data);

// ambil data terakhir yang barusan disimpan
$id = $model->insertID();
$dataDB = $model->find($id);

// hapus session
session()->destroy();

// kirim SEMUA data ke view
return view('hasil', ['data' => $dataDB]);
    }
    public function getKodePos()
{
    $db = \Config\Database::connect();

    $kel = strtolower($this->request->getGet('kelurahan'));
    $kec = strtolower($this->request->getGet('kecamatan'));
    $kab = strtolower($this->request->getGet('kabupaten'));

    // 🔥 normalize kabupaten/kota
    $kab = str_replace(['kabupaten ', 'kota '], '', $kab);

    $builder = $db->table('tbl_kodepos');
    $builder->like('LOWER(kelurahan)', $kel);
    $builder->like('LOWER(kecamatan)', $kec);
    $builder->like('LOWER(kabupaten)', $kab);

    $result = $builder->get()->getRow();

    return $this->response->setJSON([
        'kodepos' => $result->kodepos ?? '-'
    ]);
    
}

public function cetak(int $id)
{
    $model = new Skrining_model();
    $data['data'] = $model->find($id);

    $html = view('hasil_pdf', $data); // 🔥 view khusus PDF

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $dompdf->stream("hasil_skrining.pdf", ["Attachment" => false]);
}
}
