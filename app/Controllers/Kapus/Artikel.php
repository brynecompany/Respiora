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

    public function index()
    {
        $data = [
            'artikel' => $this->artikelModel
                ->orderBy('tanggal_artikel', 'DESC')
                ->findAll()
        ];

        return view('kapus/artikel/index', $data);
    }

    public function show($id)
    {
        $artikel = $this->artikelModel->find($id);

        if (!$artikel) {
            return redirect()->to('/kapus');
        }

        return view('kapus/artikel/show', [
            'artikel' => $artikel
        ]);
    }
}   