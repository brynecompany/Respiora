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

    public function index()
    {
        $data = [
            'berita' => $this->beritaModel
                ->orderBy('tanggal_berita', 'DESC')
                ->findAll()
        ];

        return view('kapus/berita/index', $data);
    }

    public function show($id)
    {
        $berita = $this->beritaModel->find($id);

        if (!$berita) {
            return redirect()->to('/kapus');
        }

        return view('kapus/berita/show', [
            'berita' => $berita
        ]);
    }
}   