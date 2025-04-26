<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function register()
    {
        return view('/user/autentikasi/register');
    }

    public function store()
    {
        $session = session();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'            => 'required',
            'username'        => 'required|is_unique[users.username]',
            'phone'           => 'required|numeric',
            'password'        => 'required|min_length[6]',
            'confirm_password' => 'matches[password]',
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $userModel = new UserModel();
        $userModel->save([
            'name'     => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'phone'    => $this->request->getPost('phone'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);
        $session->setFlashdata('success', 'Registrasi berhasil! Silakan login.');
        return redirect()->to('/login');
    }

    public function login()
    {
        return view('/user/autentikasi/login');
    }

    public function attemptLogin()
    {
        $session = session();
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $user = $userModel->where('username', $username)->first();
        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'isLoggedIn' => true
            ]);
            $session->setFlashdata('success', 'Login berhasil!');
            return redirect()->to(base_url('/produk-regular'));
        } else {
            $session->setFlashdata('error', 'Username atau password salah!');
            return redirect()->to(base_url('/login'));
        }
    }

    public function logout()
    {
        $session = session();
        $session->setFlashdata('success', 'Anda telah berhasil logout.');
        $session->remove('isLoggedIn');
        $session->destroy();
        return redirect()->to('/login');
    }
}
