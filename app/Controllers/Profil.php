<?php

namespace App\Controllers;
use App\Models\UserModel;

class Profil extends BaseController
{
    public function index()
    {
        $model = new UserModel();

        $user = $model->find(session()->get('id_user'));

        return view('profil', [
            'user' => $user
        ]);
    }

    public function updatePassword()
    {
        $model = new UserModel();

        $id = session()->get('id_user');
        $password = $this->request->getPost('password');

        if (!$password) {
            return redirect()->to('/profil')
                ->with('error', 'Password tidak diubah');
        }

        $model->update($id, [
            'password' => $password
        ]);

        return redirect()->to('/profil')
            ->with('success', 'Password berhasil diubah');
    }
}