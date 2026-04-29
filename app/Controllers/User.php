<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $model = new UserModel();

        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $model = $model
                ->groupStart()
                ->like('username', $keyword)
                ->orLike('email', $keyword)
                ->groupEnd();
        }

        $users = $model->paginate(10);

        $data = [
            'users'   => $users,
            'pager'   => $model->pager,
            'keyword' => $keyword
        ];

        return view('user/index', $data);
    }

    public function create()
    {
        return view('user/create');
    }

    public function store()
    {
        $model = new UserModel();

        $model->insert([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'email'    => $this->request->getPost('password'),
            'role'     => $this->request->getPost('role'),
        ]);
        // Menyimpan data user
        // Menyimpan pesan sukses untuk ditampilkan
        session()->setFlashdata('success', 'Data user berhasil ditambahkan');
        return redirect()->to('/user')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $model = new UserModel();

        $data['user'] = $model->find($id);

        return view('user/edit', $data);
    }

    public function update($id)
    {
        $model = new UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'role'     => $this->request->getPost('role'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            );
        }

        $model->update($id, $data);

        return redirect()->to('/user')->with('success', 'User berhasil diupdate');
    }

    public function delete($id)
    {
        $model = new UserModel();
        $model->delete($id);

        return redirect()->to('/user')->with('success', 'User berhasil dihapus');
    }
}