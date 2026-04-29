<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PasienModel;

class Pasien extends BaseController
{
    // =========================
    // LIST DATA
    // =========================
   public function index()
{
    $model = new PasienModel();

    $keyword = $this->request->getGet('keyword');

    if ($keyword) {
        $model->groupStart()
              ->like('NIK', $keyword)
              ->orLike('nama_pasien', $keyword)
              ->groupEnd();
    }

    $data['pasien'] = $model->paginate(10, 'default');
    $data['pager'] = $model->pager;
    $data['keyword'] = $keyword;

    return view('admin/data_pasien/data_pasien', $data);
}

    // =========================
    // STEP 1 - DATA DIRI (READ)
    // =========================
    public function detailDiri($id)
    {
        $model = new PasienModel();

        $data['pasien'] = $model->find($id);
        $data['mode'] = 'view';

        return view('admin/data_pasien/detail_diri', $data);
    }

    // =========================
    // STEP 2 - DATA WILAYAH (READ)
    // =========================
    public function detailWilayah($id)
{
    $db = \Config\Database::connect();

    $data['pasien'] = $db->table('pasien_kasus p')
    ->select('p.*, w.provinsi, w.kabupaten, w.kecamatan, w.kelurahan, w.kode_pos')
    ->join('wilayah_kasus w', 'w.id_wilayah = p.id_wilayah', 'left')
    ->where('p.id_pasien', $id)
    ->get()
    ->getRowArray();

    $data['pasien'] = $this->mapWilayah($data['pasien']);
    $data['mode'] = 'view';

    return view('admin/data_pasien/detail_wilayah', $data);
}

    // =========================
    // EDIT STEP 1
    // =========================
    public function editDiri($id)
    {
        $model = new PasienModel();

        $data['pasien'] = $model->find($id);
        $data['mode'] = 'edit';

        return view('admin/data_pasien/detail_diri', $data);
    }

    // =========================
    // LANJUT KE STEP 2 (SAVE DATA DIRI DULU)
    // =========================
public function editWilayah($id)
{
    $model = new PasienModel();

    // 🔥 AMBIL DATA LAMA DULU
    $dataLama = $model->find($id);

    if (!$dataLama) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    // 🔥 UPDATE DATA DIRI (JANGAN SAMPAI KEISI NULL)
    $model->update($id, [
        'id_user' => 3,

        'NIK' => $this->request->getPost('NIK') ?: $dataLama['NIK'],
        'no_rm' => $this->request->getPost('no_rm') ?: $dataLama['no_rm'],
        'nama_pasien' => $this->request->getPost('nama_pasien') ?: $dataLama['nama_pasien'],
        'tempat_lahir' => $this->request->getPost('tempat_lahir') ?: $dataLama['tempat_lahir'],
        'tanggal_lahir' => $this->request->getPost('tanggal_lahir') ?: $dataLama['tanggal_lahir'],
        'no_hp' => $this->request->getPost('no_hp') ?: $dataLama['no_hp'],
        'jumlah_keluarga' => $this->request->getPost('jumlah_keluarga') ?: $dataLama['jumlah_keluarga'],
        'jenis_kelamin' => $this->request->getPost('jenis_kelamin') ?: $dataLama['jenis_kelamin'],
        'pendidikan' => $this->request->getPost('pendidikan') ?: $dataLama['pendidikan'],
        'pekerjaan' => $this->request->getPost('pekerjaan') ?: $dataLama['pekerjaan'],
        'status_pernikahan' => $this->request->getPost('status_pernikahan') ?: $dataLama['status_pernikahan'],
        'kelompok_usia' => $this->request->getPost('kelompok_usia') ?: $dataLama['kelompok_usia'],
        'pendapatan' => $this->request->getPost('pendapatan') ?: $dataLama['pendapatan'],
    ]);

    // 🔥 LANJUT AMBIL DATA WILAYAH
    $db = \Config\Database::connect();

    $data['pasien'] = $db->table('pasien_kasus p')
        ->select('p.*, w.provinsi, w.kabupaten, w.kecamatan, w.kelurahan, w.kode_pos')
        ->join('wilayah_kasus w', 'w.id_wilayah = p.id_wilayah', 'left')
        ->where('p.id_pasien', $id)
        ->get()
        ->getRowArray();

    $data['pasien'] = $this->mapWilayah($data['pasien']);
    $data['mode'] = 'edit';

    return view('admin/data_pasien/detail_wilayah', $data);
}

    // =========================
    // FINAL SAVE (STEP 2)
    // =========================
    public function updateWilayah($id)
{
    $model = new PasienModel();

    $model->update($id, [
        'id_wilayah' => $this->request->getPost('id_wilayah'),
        'rt' => $this->request->getPost('rt'),
        'rw' => $this->request->getPost('rw'),
    ]);

    return redirect()->to('/admin/data-pasien')
        ->with('success', 'Data berhasil disimpan');
}
    private function mapWilayah($row)
{
    $prov = [
        35 => 'Jawa Timur'
    ];

    $kab = [
        9 => 'Jember'
    ];

    $kec = [
        3 => 'Kaliwates'
    ];

    $kel = [
        1 => 'Jember Kidul',
        2 => 'Tegal Besar',
        3 => 'Kaliwates',
        4 => 'Kebonagung',
        5 => 'Sempusari',
        6 => 'Mangli',
        7 => 'Kepatihan'
    ];

    $row['provinsi_nama'] = $prov[$row['provinsi']] ?? '-';
    $row['kabupaten_nama'] = $kab[$row['kabupaten']] ?? '-';
    $row['kecamatan_nama'] = $kec[$row['kecamatan']] ?? '-';
    $row['kelurahan_nama'] = $kel[$row['kelurahan']] ?? '-';

    return $row;
}
public function delete($id)
{
    $model = new PasienModel();
    $model->delete($id);

    return redirect()->to('/admin/data-pasien')
        ->with('success', 'Data berhasil dihapus');
}
public function createDiri()
{
    return view('admin/data_pasien/detail_diri', [
        'mode' => 'create',
        'pasien' => []
    ]);
}
public function storeDiriTemp()
{
    session()->set('temp_pasien', [
        'NIK' => $this->request->getPost('NIK'),
        'no_rm' => $this->request->getPost('no_rm'),
        'nama_pasien' => $this->request->getPost('nama_pasien'),
        'tempat_lahir' => $this->request->getPost('tempat_lahir'),
        'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
        'no_hp' => $this->request->getPost('no_hp'),
        'jumlah_keluarga' => $this->request->getPost('jumlah_keluarga'),
        'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        'pendidikan' => $this->request->getPost('pendidikan'),
        'pekerjaan' => $this->request->getPost('pekerjaan'),
        'status_pernikahan' => $this->request->getPost('status_pernikahan'),
        'kelompok_usia' => $this->request->getPost('kelompok_usia'),
        'pendapatan' => $this->request->getPost('pendapatan'),
    ]);

    return redirect()->to('/admin/data-pasien/create/wilayah');
}
public function createWilayah()
{
    return view('admin/data_pasien/detail_wilayah', [
        'mode' => 'create',
        'pasien' => session()->get('temp_pasien')
    ]);
}
public function storeFinal()
{
    $model = new PasienModel();

    // ambil data diri dari session (step 1)
    $dataDiri = session()->get('temp_pasien');

    // gabung dengan wilayah (step 2)
    $data = [
        'id_user' => 3, 
        'NIK' => $dataDiri['NIK'],
        'no_rm' => $dataDiri['no_rm'],
        'nama_pasien' => $dataDiri['nama_pasien'],
        'tempat_lahir' => $dataDiri['tempat_lahir'],
        'tanggal_lahir' => $dataDiri['tanggal_lahir'],
        'no_hp' => $dataDiri['no_hp'],
        'jumlah_keluarga' => $dataDiri['jumlah_keluarga'],
        'jenis_kelamin' => $dataDiri['jenis_kelamin'],
        'pendidikan' => $dataDiri['pendidikan'],
        'pekerjaan' => $dataDiri['pekerjaan'],
        'status_pernikahan' => $dataDiri['status_pernikahan'],
        'kelompok_usia' => $dataDiri['kelompok_usia'],
        'pendapatan' => $dataDiri['pendapatan'],

        // 🔥 wilayah
        'id_wilayah' => $this->request->getPost('id_wilayah'),
        'rt' => $this->request->getPost('rt'),
        'rw' => $this->request->getPost('rw'),
    ];
    if(!$this->request->getPost('id_wilayah') ||
   !$this->request->getPost('rt') ||
   !$this->request->getPost('rw')){
       
    return redirect()->back()->with('error','Data wilayah belum lengkap');
}
    $model->insert($data);

    // hapus session
    session()->remove('temp_pasien');

    return redirect()->to('/admin/data-pasien')
        ->with('success', 'Data berhasil ditambahkan');
}

}