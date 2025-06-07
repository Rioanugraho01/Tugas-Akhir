<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\ProdukModel;
use App\Models\MacamProdukModel;

class DataProdukController extends BaseController
{
        public function data_produk()
        {
            $produkModel = new ProdukModel();
            $search = $this->request->getGet('search');
            $kategori = $this->request->getGet('kategori');
            $date_from = $this->request->getGet('date_from');
            $date_to = $this->request->getGet('date_to');

            $query = $produkModel;
            if ($search) {
                $query = $query->like('nama', $search);
            }
            if ($kategori) {
                $query = $query->where('kategori', $kategori);
            }
            if ($date_from && $date_to) {
                $query = $query->where('created_at >=', $date_from)
                    ->where('created_at <=', $date_to);
            }
    
            $produk = $query->findAll();
    
            return view('admin/data-produk/index', [
                'produk' => $produk,
                'search' => $search,
                'kategori' => $kategori,
                'date_from' => $date_from,
                'date_to' => $date_to
            ]);
        }
    
        public function create_produk()
        {
            return view('admin/data-produk/tambah-produk');
        }
    
        public function store_produk()
        {
            $produkModel = new ProdukModel();
    
            $validated = $this->validate([
                'gambar' => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/png,image/jpg,image/jpeg]',
                'nama' => 'required',
                'deskripsi' => 'required',
                'kategori' => 'required|in_list[regular,khusus]'
            ]);
    
            if (!$validated) {
                return redirect()->back()->with('error', 'Validasi gagal, periksa kembali input Anda.');
            }
    
            $gambar = $this->request->getFile('gambar');
            $gambarName = $gambar->getRandomName();
            $gambar->move('uploads/produk', $gambarName);
    
            $data = [
                'gambar' => $gambarName,
                'nama' => $this->request->getPost('nama'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'kategori' => $this->request->getPost('kategori')
            ];
    
            $produkModel->insert($data);
            return redirect()->to('/data-produk')->with('success', 'Produk berhasil ditambahkan.');
        }
    
        public function edit_produk($id)
        {
            $produkModel = new ProdukModel();
            $produk = $produkModel->find($id);
    
            if (!$produk) {
                return redirect()->to('/data-produk')->with('error', 'Produk tidak ditemukan.');
            }
    
            return view('admin/data-produk/edit-produk', ['produk' => $produk]);
        }
    
        public function update_produk($id)
        {
            $produkModel = new ProdukModel();
            $produk = $produkModel->find($id);
    
            if (!$produk) {
                return redirect()->to('/data-produk')->with('error', 'Produk tidak ditemukan.');
            }
    
            $data = [
                'nama' => $this->request->getPost('nama'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'kategori' => $this->request->getPost('kategori'),
            ];
    
            if ($this->request->getFile('gambar')->isValid()) {
                $gambar = $this->request->getFile('gambar');
                $gambarName = $gambar->getRandomName();
                $gambar->move('uploads/produk', $gambarName);
                $data['gambar'] = $gambarName;
    
                if (file_exists('uploads/produk/' . $produk['gambar'])) {
                    unlink('uploads/produk/' . $produk['gambar']);
                }
            }
    
            $produkModel->update($id, $data);
            return redirect()->to('/data-produk')->with('success', 'Produk berhasil diperbarui.');
        }
    
        public function delete_produk($id)
        {
            $produkModel = new ProdukModel();
            $produk = $produkModel->find($id);
    
            if (!$produk) {
                return redirect()->to('/data-produk')->with('error', 'Produk tidak ditemukan.');
            }
    
            if (file_exists('uploads/produk/' . $produk['gambar'])) {
                unlink('uploads/produk/' . $produk['gambar']);
            }
    
            $produkModel->delete($id);
            return redirect()->to('/data-produk')->with('success', 'Produk berhasil dihapus.');
        }
}
