<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BeritaModel;

class Berita extends BaseController
{
    protected $BeritaModel;

    public function __construct()
    {
        $this->BeritaModel = new BeritaModel();
    }

    public function index()
    {
        $model = new BeritaModel();

        $keyword  = $this->request->getGet('search');
        $status   = $this->request->getGet('status');
        $tanggal  = $this->request->getGet('tanggal');
        $urutkan  = $this->request->getGet('urutkan');

        if ($keyword) {
            $model->like('judul_berita', $keyword);
        }

        if ($status) {
            $model->where('status_berita', $status);
        }

        if ($tanggal) {
            $model->where('tanggal_berita', $tanggal);
        }

        if ($urutkan == 'terbaru') {
            $model->orderBy('tanggal_berita', 'DESC');
        }

        if ($urutkan == 'terlama') {
            $model->orderBy('tanggal_berita', 'ASC');
        }

        $data = [
            'berita' => $model->paginate(8),
            'pager'   => $model->pager,
            'total'   => $model->countAll(),
            'keyword' => $keyword
        ];

        return view('admin/berita/index', $data);
    }

    public function create()
    {
        return view('admin/berita/create');
    }

    public function store()
    {
        $rules = [
            'judul_berita' => 'required',
            'deskripsi_berita' => 'required',
            'status_berita' => 'required',
            'gambar_berita' => 'uploaded[gambar_berita]|max_size[gambar_berita,2048]|is_image[gambar_berita]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $file = $this->request->getFile('gambar_berita');
        $namaGambar = $file->getRandomName();
        $file->move(FCPATH . 'uploads/berita', $namaGambar);

        $this->BeritaModel->save([
            'judul_berita'     => $this->request->getPost('judul_berita'),
            'deskripsi_berita' => $this->request->getPost('deskripsi_berita'),
            'status_berita'    => $this->request->getPost('status_berita'),
            'gambar_berita'    => $namaGambar,
            'tanggal_berita'   => date('Y-m-d')
        ]);

        return redirect()->to(base_url('admin/berita'))
            ->with('success', 'Data berhasil disimpan');
    }

    public function show($id)
    {
        $berita = $this->BeritaModel->find($id);

        return view('admin/berita/show', [
            'berita' => $berita
        ]);
    }

    public function toggle($id)
    {
        $berita = $this->BeritaModel->find($id);

        if (!$berita) {
            return $this->response->setJSON(['status' => 'error']);
        }

        $newStatus = $berita['status_berita'] === 'Publish'
            ? 'Unpublish'
            : 'Publish';

        $this->BeritaModel->update($id, [
            'status_berita' => $newStatus
        ]);

        return $this->response->setJSON([
            'status' => $newStatus
        ]);
    }

    public function delete($id)
    {
        $berita = $this->BeritaModel->find($id);

        if (!$berita) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        if (!empty($berita['gambar_berita'])) {
            $path = FCPATH . 'uploads/berita/' . $berita['gambar_berita'];
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $this->BeritaModel->delete($id);

        return redirect()->to(base_url('admin/berita'))
            ->with('success', 'Data berhasil dihapus');
    }

    public function edit($id)
    {
        $berita = $this->BeritaModel->find($id);

        if (!$berita) {
            return redirect()->to('admin/berita')
                ->with('error', 'Data tidak ditemukan');
        }

        return view('admin/berita/edit', [
            'berita' => $berita
        ]);
    }

    public function update($id)
    {
        $berita = $this->BeritaModel->find($id);

        if (!$berita) {
            return redirect()->back();
        }

        $file = $this->request->getFile('gambar_berita');
        $namaGambar = $berita['gambar_berita'];

        if ($file && $file->isValid() && !$file->hasMoved()) {

            if (!empty($berita['gambar_berita'])) {
                $oldPath = FCPATH . 'uploads/berita/' . $berita['gambar_berita'];
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $namaGambar = $file->getRandomName();
            $file->move(FCPATH . 'uploads/berita', $namaGambar);
        }

        $this->BeritaModel->update($id, [
            'judul_berita'     => $this->request->getPost('judul_berita'),
            'deskripsi_berita' => $this->request->getPost('deskripsi_berita'),
            'status_berita'    => $this->request->getPost('status_berita'),
            'gambar_berita'    => $namaGambar
        ]);

        return redirect()->to('admin/berita')
            ->with('success', 'Data berhasil diperbarui');
    }
}   