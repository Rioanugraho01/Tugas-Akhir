<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\ProdukModel;
use App\Models\MacamProdukModel;

class KelolaUserController extends BaseController
{
        public function kelola_user()
        {
            $userModel = new UserModel();
            $search = $this->request->getGet('search');
            $date_from = $this->request->getGet('date_from');
            $date_to = $this->request->getGet('date_to');
            $query = $userModel;
            if ($search) {
                $query = $query->like('name', $search)
                    ->orLike('username', $search)
                    ->orLike('phone', $search);
            }
            if ($date_from && $date_to) {
                $query = $query->where('created_at >=', $date_from)
                    ->where('created_at <=', $date_to);
            }
            $users = $query->findAll();
            return view('admin/kelola-user/index', ['users' => $users, 'search' => $search, 'date_from' => $date_from, 'date_to' => $date_to]);
        }
    
        public function create_user()
        {
            return view('admin/kelola-user/tambah-user');
        }
    
        public function store_user()
        {
            $userModel = new UserModel();
            $data = [
                'name' => $this->request->getPost('name'),
                'username' => $this->request->getPost('username'),
                'phone' => $this->request->getPost('phone'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];
            $userModel->insert($data);
            return redirect()->to('/kelola-user')->with('success', 'User berhasil ditambahkan.');
        }
    
        public function edit_user($id)
        {
            $userModel = new UserModel();
            $user = $userModel->find($id);
            if (!$user) {
                return redirect()->to('/kelola-user')->with('error', 'User tidak ditemukan.');
            }
            return view('admin/kelola-user/edit-user', ['user' => $user]);
        }
    
        public function update_user($id)
        {
            $userModel = new UserModel();
            $data = [
                'name' => $this->request->getPost('name'),
                'username' => $this->request->getPost('username'),
                'phone' => $this->request->getPost('phone'),
            ];
            $password = $this->request->getPost('password');
            if (!empty($password)) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
            
            $userModel->update($id, $data);
            return redirect()->to('/kelola-user')->with('success', 'User berhasil diperbarui.');
        }
    
        public function delete_user($id)
        {
            $userModel = new UserModel();
            if ($userModel->find($id)) {
                $userModel->delete($id);
                return redirect()->to('/kelola-user')->with('success', 'User berhasil dihapus.');
            } else {
                return redirect()->to('/kelola-user')->with('error', 'User tidak ditemukan.');
            }
        }
        // end
}

