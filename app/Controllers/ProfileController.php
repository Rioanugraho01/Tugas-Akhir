<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class ProfileController extends Controller
{
    public function edit()
    {
        $session = session();
        $userModel = new UserModel();
        $user = $userModel->find($session->get('user_id'));

        return view('user/edit-profile/index', ['user' => $user]);
    }

    public function update()
    {
        $session = session();
        $userModel = new UserModel();

        $rules = [
            'name' => 'required',
            'username' => 'required',
            'phone' => 'required|numeric',
            'password' => 'permit_empty|min_length[6]',
            'confirm_password' => 'matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'phone' => $this->request->getPost('phone'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $userModel->update($session->get('user_id'), $data);
        $session->setFlashdata('success', 'Profil berhasil diperbarui.');
        return redirect()->to('/edit-profile');
    }
}
