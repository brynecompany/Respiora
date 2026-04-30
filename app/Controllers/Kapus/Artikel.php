<?php
namespace App\Controllers\Kapus;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;

class Artikel extends BaseController
{
    protected $artikelModel;

    public function __construct()
    {
        $this->artikelModel = new ArtikelModel();
    }

    // Daftar artikel Kapus (view only)
    public function index()
    {
        $data['artikel'] = $this->artikelModel->where('status_artikel', 'Publish')->findAll(); // Hanya tampilkan artikel yang di-publish
        return view('kapus/artikel/index', $data);  // Kirim data ke view Kapus
    }

    // Menampilkan detail artikel
    public function show($id)
    {
        $artikel = $this->artikelModel->find($id);

        if (!$artikel) {
            return redirect()->to('/kapus'); // Jika artikel tidak ditemukan, redirect ke halaman utama Kapus
        }

        return view('kapus/artikel/show', ['artikel' => $artikel]); // Kirim artikel ke view
    }
}