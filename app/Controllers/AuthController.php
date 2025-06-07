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
        if ($user) {
            if (password_verify($password, $user['password'])) {
                if ($session->get('isLoggedIn') && $session->get('role') !== $user['role']) {
                    $session->setFlashdata('error', 'Anda sudah login sebagai ' . $session->get('role') . '. Silakan logout terlebih dahulu.');
                    return redirect()->to('/' . ($session->get('role') === 'admin' ? 'admin' : 'produk-regular'));
                }

                $session->set([
                    'user_id'    => $user['id'],
                    'username'   => $user['username'],
                    'role'       => $user['role'],
                    'isLoggedIn' => true,
                ]);

                if ($user['role'] === 'admin') {
                    return redirect()->to('/admin');
                } else {
                    return redirect()->to('/produk-regular');
                }
            } else {
                $session->setFlashdata('error', 'Password salah.');
                return redirect()->back()->withInput();
            }
        } else {
            $session->setFlashdata('error', 'Username tidak ditemukan.');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        $session = session();
        $session->remove(['user_id', 'username', 'role', 'isLoggedIn']);
        session()->remove('cart');
        var_dump($session->get()); 
        $session->setFlashdata('success', 'Anda telah berhasil logout.');
        return redirect()->to('/login');
    }

    public function editProfileAdmin()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak.');
        }
        $userModel = new \App\Models\UserModel();
        $admin = $userModel->find(session()->get('user_id'));
        return view('admin/profile/edit', ['admin' => $admin]);
    }

    public function updateProfileAdmin()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak.');
        }
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'     => 'required',
            'username' => 'required',
            'phone'    => 'required|numeric',
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $userModel = new \App\Models\UserModel();
        $data = [
            'name'     => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'phone'    => $this->request->getPost('phone'),
        ];
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
        $userModel->update(session()->get('user_id'), $data);
        return redirect()->to('/admin/edit-profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
