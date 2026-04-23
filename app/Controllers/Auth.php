<?php

namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login($role = null)
    {
        return view('login', ['role' => $role]);
    }

    public function prosesLogin()
    {
    $session = session();
    $model = new UserModel();

    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    $user = $model->where('username', $username)->first();

    // Kalau username tidak ditemukan
    if(!$user)
    {
        return redirect()->back()
                         ->withInput()
                         ->with('username_error', 'Username salah. Silakan coba lagi.');
    }

    // Kalau password salah
    if($user['password'] !== $password)
    {
        return redirect()->back()
                         ->withInput()
                         ->with('password_error', 'Password  minimal 8 karakter.');
    }

    // Kalau keduanya benar
    $session->set([
        'id_user' => $user['id_user'],
        'username' => $user['username'],
        'role' => $user['role'],
        'logged_in' => true
    ]);

    return redirect()->to('/sidebar_layl');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function forgotPassword($role = null)
    {
    return view('forgot_password', ['role' => $role]);
    }

    public function sendResetLink()
    {
    $model = new \App\Models\UserModel();

    $email = $this->request->getPost('email');
    $role  = $this->request->getPost('role');

    $user = $model->where('email', $email)
                  ->where('role', $role)
                  ->first();

    if(!$user){
        return redirect()->back()
                         ->with('error','Email yang Anda masukkan tidak terdaftar.');
    }

    /* 1. Untuk generate token*/
    $token = bin2hex(random_bytes(32));
    $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

    /* 2. Untuk simpan ke database*/
    $model->update($user['id_user'], [
        'reset_token' => $token,
        'token_expiry' => $expiry
    ]);

    /* 3. Untuk buat link reset*/
    $link = base_url('reset-password/'.$token);

    /* 4. Untuk kirim email
    $emailService = \Config\Services::email();*/
    $emailService = \Config\Services::email(true);
    $emailService->setFrom('bryne.company@gmail.com', 'RESPIORA');
    $emailService->setTo($email);
    $emailService->setSubject('Reset Kata Sandi RESPIORA');
    $emailService->setMessage("Klik link berikut untuk reset password:<br><a href='$link'>$link</a><br>Link berlaku 1 jam.");
    
    /*if($emailService->send()){
        return redirect()->back()
            ->with('success','Link reset berhasil dikirim. Silakan cek email.');
    } else {
        return redirect()->back()
            ->with('error',$emailService->printDebugger(['headers']));
    }*/
    if($emailService->send()){
    $emailService->clear();
        return redirect()->back()
        ->with('success','Link reset berhasil dikirim.');
    } else {
        return redirect()->back()
            ->with('error',$emailService->printDebugger(['headers']));
    }
    }

    public function resetPassword($token = null)
    {
    $model = new \App\Models\UserModel();

    $user = $model->where('reset_token', $token)->first();

    if(!$user){
        return redirect()->to('/')
            ->with('error','Token tidak valid.');
    }

    if(strtotime($user['token_expiry']) < time()){
        return redirect()->to('/')
            ->with('error','Token sudah kadaluarsa.');
    }

    return view('reset_password', ['token' => $token]);
    }

    public function updatePassword()
    {
    $model = new \App\Models\UserModel();

    $token = $this->request->getPost('token');
    $password = $this->request->getPost('password');
    $confirm  = $this->request->getPost('confirm_password');

    $user = $model->where('reset_token', $token)->first();

    if(!$user){
        return redirect()->back()
            ->with('error','Token tidak valid.');
    }

    if($password !== $confirm){
        return redirect()->back()
            ->with('error','Konfirmasi password tidak cocok.');
    }

    $model->update($user['id_user'], [
        'password' => ($password),  
        'reset_token' => null,
        'token_expiry' => null
    ]);

    return redirect()->to('/login/'.$user['role'])
        ->with('success','Kata Sandi berhasil diubah. Silakan login.');
    }

}