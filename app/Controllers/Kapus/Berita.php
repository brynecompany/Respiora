<?php
namespace App\Controllers\Kapus;

use App\Controllers\BaseController;
use App\Models\BeritaModel;

class Berita extends BaseController
{
    protected $beritaModel;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
    }

    // Menampilkan daftar berita (view only)
    public function index()
    {
        // Ambil berita dengan status 'Publish' saja
        $data['berita'] = $this->beritaModel->where('status_berita', 'Publish')->findAll();

        return view('kapus/berita/index', $data);  // Tampilkan ke view Kapus
    }

    // Menampilkan detail berita
    public function show($id)
    {
        $berita = $this->beritaModel->find($id);

        if (!$berita) {
            return redirect()->to('/kapus'); // Jika berita tidak ditemukan, kembali ke halaman utama Kapus
        }

        return view('kapus/berita/show', ['berita' => $berita]);
    }
}