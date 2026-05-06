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
public function detailTbc($id)
{
    $db = \Config\Database::connect();

    $data['pasien'] = $db->table('tb_data')
        ->where('id_pasien', $id)
        ->get()
        ->getRowArray();

    $data['pasien']['id_pasien'] = $id;

    $data['mode'] = 'view';

    return view('admin/data_pasien/detail_tbc', $data);
}
public function detailKontak($id)
{
    $db = \Config\Database::connect();

    // investigasi
    $investigasi = $db->table('tb_kontak_investigasi')
        ->where('id_pasien', $id)
        ->get()
        ->getRowArray();

    // kontak keluarga
    $kontak = [];

    if ($investigasi) {
        $kontak = $db->table('tb_kontak_keluarga')
            ->where('id_kontak_investigasi', $investigasi['id_kontak_investigasi'])
            ->get()
            ->getResultArray();
    }

    $data = [
        'mode' => 'view',
        'investigasi' => $investigasi,
        'kontak' => $kontak,
        'id_pasien' => $id
    ];

    return view('admin/data_pasien/detail_kontak', $data);
}
private function mapWilayah($pasien)
{
    $pasien['kelurahan_nama'] = $pasien['kelurahan'] ?? '-';
    $pasien['kecamatan_nama'] = $pasien['kecamatan'] ?? '-';
    $pasien['kabupaten_nama'] = $pasien['kabupaten'] ?? '-';
    $pasien['provinsi_nama'] = $pasien['provinsi'] ?? '-';

    return $pasien;
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

    // ✅ VALIDASI FIELD WAJIB
  $post = $this->request->getPost();

// cek yang wajib dari POST ASLI
if(
    empty(trim($post['NIK'])) ||
    empty(trim($post['nama_pasien'])) ||
    empty(trim($post['jenis_kelamin'])) ||
    empty(trim($post['kelompok_usia']))
){
    return redirect()->back()->with('error','Field wajib belum lengkap');
}

    // 🔥 OPTIONAL: VALIDASI NIK 16 DIGIT
    if(strlen($this->request->getPost('NIK')) != 16){
        return redirect()->back()->with('error','NIK harus 16 digit');
    }

    // 🔥 UPDATE DATA DIRI
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

    
    $data['mode'] = 'edit';

    return view('admin/data_pasien/detail_wilayah', $data);
}
    // =========================
    // FINAL SAVE (STEP 2)
    // =========================
   public function updateWilayah($id)
{
    $model = new PasienModel();
    if (!$this->request->getPost('id_wilayah')) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Wilayah wajib diisi');
    }

    // 🔥 TARUH VALIDASI RT/RW DI SINI (POTONGAN KODE BARU)
    $validation = \Config\Services::validation();
    $validation->setRules([
        'rt' => 'permit_empty|numeric|max_length[3]',
        'rw' => 'permit_empty|numeric|max_length[3]'
    ]);

    if (!$validation->run($this->request->getPost())) {
        return redirect()->back()->withInput()->with('error', 'Format RT/RW salah. Harus angka maksimal 3 digit atau biarkan kosong.');
    }
    // 🔥 BATAS AKHIR VALIDASI

    // Pastikan rt dan rw bisa kosong
    $rt = $this->request->getPost('rt');
    $rw = $this->request->getPost('rw');

    // Periksa apakah rt dan rw kosong, jika iya, simpan sebagai null
    if (empty($rt)) {
        $rt = null;
    }
    if (empty($rw)) {
        $rw = null;
    }

    // Update data
    $updateStatus = $model->update($id, [
        'id_wilayah' => $this->request->getPost('id_wilayah'),
        'rt' => $rt,
        'rw' => $rw,
    ]);

    // 🔥 CEK JIKA MODEL MENOLAK UPDATE
    if (!$updateStatus) {
        return redirect()->back()->withInput()->with('error', 'Gagal update database. Cek aturan di PasienModel.');
    }

    return redirect()->to('/admin/data-pasien/edit/tbc/' . $id);
}
public function delete($id)
{
    $db = \Config\Database::connect();

    $db->transStart();

    // =========================
    // AMBIL INVESTIGASI
    // =========================
    $investigasi = $db->table('tb_kontak_investigasi')
        ->where('id_pasien', $id)
        ->get()
        ->getRowArray();

    // =========================
    // HAPUS KONTAK KELUARGA
    // =========================
    if ($investigasi) {

        $db->table('tb_kontak_keluarga')
            ->where('id_kontak_investigasi', $investigasi['id_kontak_investigasi'])
            ->delete();
    }

    // =========================
    // HAPUS INVESTIGASI
    // =========================
    $db->table('tb_kontak_investigasi')
        ->where('id_pasien', $id)
        ->delete();

    // =========================
    // HAPUS DATA TBC
    // =========================
    $db->table('tb_data')
        ->where('id_pasien', $id)
        ->delete();

    // =========================
    // HAPUS PASIEN
    // =========================
    $db->table('pasien_kasus')
        ->where('id_pasien', $id)
        ->delete();

    $db->transComplete();

    return redirect()->to('/admin/data-pasien')
        ->with('success', 'Data pasien berhasil dihapus');
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
    // Validasi input
    $validation = \Config\Services::validation();
    $validation->setRules([
        'NIK' => 'required|min_length[16]|max_length[16]',
        'nama_pasien' => 'required',
        'jenis_kelamin' => 'required',
        'kelompok_usia' => 'required',
    ]);

    if (!$validation->run($this->request->getPost())) {
        return redirect()->back()->with('error', 'Tolong isi semua field yang wajib diisi.');
    }

    // Menyimpan data ke session
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
public function storeWilayahTemp()
{
    session()->set('temp_wilayah', [
        'id_wilayah' => $this->request->getPost('id_wilayah'),
        'rt' => $this->request->getPost('rt'),
        'rw' => $this->request->getPost('rw'),
    ]);

    return redirect()->to('/admin/data-pasien/create/tbc');
}
public function createTbc()
{
    return view('admin/data_pasien/detail_tbc', [
        'mode' => 'create',
        'pasien' => session()->get('temp_pasien')
    ]);
}
public function editTbc($id)
{
    $db = \Config\Database::connect();

    $data['pasien'] = $db->table('tb_data')
        ->where('id_pasien', $id)
        ->get()
        ->getRowArray();

    $data['pasien']['id_pasien'] = $id;
    $data['mode'] = 'edit';

    return view('admin/data_pasien/detail_tbc', $data);
}
public function editKontak($id)
{
    $db = \Config\Database::connect();

    // ambil investigasi
    $investigasi = $db->table('tb_kontak_investigasi')
        ->where('id_pasien', $id)
        ->get()
        ->getRowArray();

    // ambil kontak keluarga
    $kontak = [];

    if ($investigasi) {
        $kontak = $db->table('tb_kontak_keluarga')
            ->where('id_kontak_investigasi', $investigasi['id_kontak_investigasi'])
            ->get()
            ->getResultArray();
    }

    $data = [
        'mode' => 'edit',
        'investigasi' => $investigasi,
        'kontak' => $kontak,
        'id_pasien' => $id
    ];

    return view('admin/data_pasien/detail_kontak', $data);
}
public function updateTbc($id)
{
    $db = \Config\Database::connect();

    $db->table('tb_data')
        ->where('id_pasien', $id)
        ->update([

            'no_reg_fasyankes' => $this->request->getPost('no_reg_fasyankes'),
            'no_reg_tbc_kab' => $this->request->getPost('no_reg_tbc_kab'),

            // dst semua field TBC
        ]);

    return redirect()->to('/admin/data-pasien/edit/kontak/' . $id);
}
public function updateKontak($id)
{
    $db = \Config\Database::connect();

    // =========================
    // UPDATE INVESTIGASI
    // =========================
    $investigasi = $db->table('tb_kontak_investigasi')
        ->where('id_pasien', $id)
        ->get()
        ->getRowArray();

    if($investigasi){

        $db->table('tb_kontak_investigasi')
            ->where('id_pasien', $id)
            ->update([

                'nama_petugas' => $this->request->getPost('nama_petugas'),
                'nama_fasyankes' => $this->request->getPost('nama_fasyankes'),
                'tipe_diagnosis' => $this->request->getPost('tipe_diagnosis'),
                'no_register_sitb' => $this->request->getPost('no_register_sitb'),
                'nama_kasus_indeks' => $this->request->getPost('nama_kasus_indeks'),
                'tanggal_investigasi' => $this->request->getPost('tanggal_investigasi'),
            ]);

        // =========================
        // HAPUS KONTAK LAMA
        // =========================
        $db->table('tb_kontak_keluarga')
            ->where('id_kontak_investigasi', $investigasi['id_kontak_investigasi'])
            ->delete();

        // =========================
        // INSERT ULANG KONTAK BARU
        // =========================
        $nama = $this->request->getPost('nama_kontak');

        if($nama){

            for($i=0; $i<count($nama); $i++){

                $db->table('tb_kontak_keluarga')->insert([
                    'id_kontak_investigasi' => $investigasi['id_kontak_investigasi'],
                    'nama' => $this->request->getPost('nama_kontak')[$i],
                    'nik' => $this->request->getPost('nik_kontak')[$i],
                    'umur' => $this->request->getPost('umur_kontak')[$i],
                    'jenis_kelamin' => $this->request->getPost('jk_kontak')[$i],
                ]);

            }
        }
    }

    return redirect()->to('/admin/data-pasien')
        ->with('success', 'Data berhasil diupdate');
}
public function storeTbcTemp()
{
    // 🔥 ambil input dari form
    $post = $this->request->getPost();

    // =========================
    // 🔥 HANDLE "LAIN-LAIN" RIWAYAT
    // =========================
    $riwayat = $post['klasifikasi_riwayat'] ?? null;
    if ($riwayat == 'Lainnya') {
        $riwayat = $post['riwayat_lainnya'] ?? null;
    }

    // =========================
    // 🔥 HANDLE "DIRUJUK"
    // =========================
    $dirujuk = $post['dirujuk_oleh'] ?? null;
    if ($dirujuk == 'Lainnya') {
        $dirujuk = $post['dirujuk_lainnya'] ?? null;
    }

    // =========================
    // 🔥 SIMPAN KE SESSION
    // =========================
    session()->set('temp_tbc', [
        // kiri
        'no_reg_fasyankes' => $post['no_reg_fasyankes'],
        'no_reg_tbc_kab' => $post['no_reg_tbc_kab'],
        'no_register_sitb' => $post['no_register_sitb'],
        'no_bpjs' => $post['no_bpjs'],
        'kode_fasyankes' => $post['kode_fasyankes'],
        'nama_fasyankes' => $post['nama_fasyankes'],
        'tgl_mulai_pengobatan' => $post['tgl_mulai_pengobatan'],
        'pemeriksaan_igra' => $post['pemeriksaan_igra'],
        'panduan_oat' => $post['panduan_oat'],
        'tgl_akhir_pengobatan' => $post['tgl_akhir_pengobatan'],
        'hasil_akhir_pengobatan' => $post['hasil_akhir_pengobatan'],
        'tgl_tes_hiv' => $post['tgl_tes_hiv'],
        'hasil_tes_hiv' => $post['hasil_tes_hiv'],

        // kanan
        'status_pengobatan' => $post['status_pengobatan'],
        'status_hamil' => $post['status_hamil'],
        'nama_fasyankes_rujukan' => $post['nama_fasyankes_rujukan'],
        'pemeriksaan_kontak' => $post['pemeriksaan_kontak'],
        'dirujuk_oleh' => $dirujuk,
        'tipe_diagnosis' => $post['tipe_diagnosis'],
        'klasifikasi_lokasi' => $post['klasifikasi_lokasi'],
        'klasifikasi_riwayat' => $riwayat,
        'skoring_anak' => $post['skoring_anak'],
        'hasil_foto_toraks' => $post['hasil_foto_toraks'],
        'dm' => $post['dm'],
        'terapi_dm' => $post['terapi_dm'],
    ]);

    // 🔥 lanjut ke step 4
    return redirect()->to('/admin/data-pasien/create/kontak');
}
public function createKontak()
{
    return view('admin/data_pasien/detail_kontak', [
        'mode' => 'create'
    ]);
}
public function storeKontakTemp()
{
    $post = $this->request->getPost();

    if(!isset($post['nama_kontak'])){
        return redirect()->back()->with('error','Minimal 1 kontak');
    }

    $kontak = [];

    for($i=0; $i<count($post['nama_kontak']); $i++){
        $kontak[] = [
            'nama' => $post['nama_kontak'][$i],
            'nik' => $post['nik_kontak'][$i],
            'umur' => $post['umur_kontak'][$i],
            'jk' => $post['jk_kontak'][$i],
        ];
    }

    session()->set('temp_kontak', $kontak);

    // 🔥 WAJIB INI
    return $this->storeFinalAll();
}
public function storeFinal()
{
    
    $model = new PasienModel();

    // Cek jika wilayah harus diisi
    if (!$this->request->getPost('id_wilayah')) {
        return redirect()->back()->withInput()->with('error', 'Wilayah wajib diisi');
    }

    // 🔥 TARUH VALIDASI RT/RW DI SINI (POTONGAN KODE BARU)
    $validation = \Config\Services::validation();
    $validation->setRules([
        'rt' => 'permit_empty|numeric|max_length[3]',
        'rw' => 'permit_empty|numeric|max_length[3]'
    ]);

    if (!$validation->run($this->request->getPost())) {
        return redirect()->back()->withInput()->with('error', 'Format RT/RW salah. Harus angka maksimal 3 digit atau biarkan kosong.');
    }
    // 🔥 BATAS AKHIR VALIDASI

    // Ambil data dari session (step 1)
    $dataDiri = session()->get('temp_pasien');

    // Gabung dengan wilayah (step 2)
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
        
        // Wilayah
        'id_wilayah' => $this->request->getPost('id_wilayah'),
        'rt' => $this->request->getPost('rt') ?: null,  // Kalau kosong, null-kan
        'rw' => $this->request->getPost('rw') ?: null,  // Kalau kosong, null-kan
    ];

    // Simpan data
    $insertStatus = $model->insert($data);

    // 🔥 CEK JIKA MODEL MENOLAK SIMPAN (BIAR NGGAK SILENT ERROR)
    if (!$insertStatus) {
        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan ke database. Cek aturan di PasienModel.');
    }
    
    // Hapus session data
    session()->remove('temp_pasien');

    // Redirect ke halaman data pasien
    return redirect()->to('/admin/data-pasien')->with('success', 'Data berhasil ditambahkan');
}
public function storeFinalAll()
{

    $db = \Config\Database::connect();
    $db->transStart();

    // =========================
    // 🔥 AMBIL DATA SESSION
    // =========================
    $dataPasien = session()->get('temp_pasien');
    $dataTbc = session()->get('temp_tbc');
    $dataKontak = session()->get('temp_kontak');

    // =========================
    // 🔥 INSERT PASIEN
    // =========================
     $wilayah = session()->get('temp_wilayah');
     if (!$dataPasien) {
    return redirect()->back()->with('error','Session pasien hilang');
}

if (!$dataTbc) {
    return redirect()->back()->with('error','Session TBC hilang');
}

if (!$dataKontak) {
    return redirect()->back()->with('error','Data kontak kosong');
}
    $db->table('pasien_kasus')->insert([
        'id_user' => 3,
        'NIK' => $dataPasien['NIK'],
        'no_rm' => $dataPasien['no_rm'],
        'nama_pasien' => $dataPasien['nama_pasien'],
        'tempat_lahir' => $dataPasien['tempat_lahir'],
        'tanggal_lahir' => $dataPasien['tanggal_lahir'],
        'no_hp' => $dataPasien['no_hp'],
        'jumlah_keluarga' => $dataPasien['jumlah_keluarga'],
        'jenis_kelamin' => $dataPasien['jenis_kelamin'],
        'pendidikan' => $dataPasien['pendidikan'],
        'pekerjaan' => $dataPasien['pekerjaan'],
        'status_pernikahan' => $dataPasien['status_pernikahan'],
        'kelompok_usia' => $dataPasien['kelompok_usia'],
        'pendapatan' => $dataPasien['pendapatan'],
        'id_wilayah' => $wilayah['id_wilayah'] ?? null,
        'rt' => $wilayah['rt'] ?? null,
        'rw' => $wilayah['rw'] ?? null,
    ]);

    $id_pasien = $db->insertID();

    // =========================
    // 🔥 INSERT TBC
    // =========================
    $db->table('tb_data')->insert([
        'id_pasien' => $id_pasien,

        'no_reg_fasyankes' => $dataTbc['no_reg_fasyankes'],
        'no_reg_tbc_kab' => $dataTbc['no_reg_tbc_kab'],
        'no_register_sitb' => $dataTbc['no_register_sitb'],
        'no_bpjs' => $dataTbc['no_bpjs'],
        'kode_fasyankes' => $dataTbc['kode_fasyankes'],
        'nama_fasyankes' => $dataTbc['nama_fasyankes'],
        'tgl_mulai_pengobatan' => $dataTbc['tgl_mulai_pengobatan'],
        'pemeriksaan_igra' => $dataTbc['pemeriksaan_igra'],
        'panduan_oat' => $dataTbc['panduan_oat'],
        'tgl_akhir_pengobatan' => $dataTbc['tgl_akhir_pengobatan'],
        'hasil_akhir_pengobatan' => $dataTbc['hasil_akhir_pengobatan'],
        'tgl_tes_hiv' => $dataTbc['tgl_tes_hiv'],
        'hasil_tes_hiv' => $dataTbc['hasil_tes_hiv'],

        'status_pengobatan' => $dataTbc['status_pengobatan'],
        'status_hamil' => $dataTbc['status_hamil'],
        'nama_fasyankes_rujukan' => $dataTbc['nama_fasyankes_rujukan'],
        'pemeriksaan_kontak' => $dataTbc['pemeriksaan_kontak'],
        'dirujuk_oleh' => $dataTbc['dirujuk_oleh'],
        'tipe_diagnosis' => $dataTbc['tipe_diagnosis'],
        'klasifikasi_lokasi' => $dataTbc['klasifikasi_lokasi'],
        'klasifikasi_riwayat' => $dataTbc['klasifikasi_riwayat'],
        'skoring_anak' => $dataTbc['skoring_anak'],
        'hasil_foto_toraks' => $dataTbc['hasil_foto_toraks'],
        'dm' => $dataTbc['dm'],
        'terapi_dm' => $dataTbc['terapi_dm'],
    ]);

    // =========================
    // 🔥 INSERT INVESTIGASI
    // =========================
    $db->table('tb_kontak_investigasi')->insert([
        'id_pasien' => $id_pasien,
        'nama_petugas' => $this->request->getPost('nama_petugas'),
        'nama_fasyankes' => $this->request->getPost('nama_fasyankes'),
        'tipe_diagnosis' => $this->request->getPost('tipe_diagnosis'),
        'no_register_sitb' => $this->request->getPost('no_register_sitb'),
        'nama_kasus_indeks' => $this->request->getPost('nama_kasus_indeks'),
        'tanggal_investigasi' => $this->request->getPost('tanggal_investigasi'),
    ]);

    $id_investigasi = $db->insertID();

    // =========================
    // 🔥 INSERT KONTAK KELUARGA
    // =========================
    foreach ($dataKontak as $k) {
        $db->table('tb_kontak_keluarga')->insert([
            'id_kontak_investigasi' => $id_investigasi,
            'nama' => $k['nama'],
            'nik' => $k['nik'],
            'umur' => $k['umur'],
            'jenis_kelamin' => $k['jk'],
        ]);
    }

    // =========================
    // 🔥 COMMIT
    // =========================
    $db->transComplete();

    // =========================
    // 🔥 CEK ERROR
    // =========================
    if ($db->transStatus() === FALSE) {
        return redirect()->back()->with('error', 'Gagal simpan semua data');
    }

    // =========================
    // 🔥 HAPUS SESSION
    // =========================
    session()->remove('temp_pasien');
    session()->remove('temp_tbc');
    session()->remove('temp_kontak');

return redirect()->to('/admin/data-pasien')
    ->with('success', 'Semua data berhasil disimpan');
}
}