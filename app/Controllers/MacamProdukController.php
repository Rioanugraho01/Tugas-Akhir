<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\ProdukModel;
use App\Models\MacamProdukModel;

class MacamProdukController extends BaseController
{
    // admin - macam produk
    public function macam_produk($produk_id = null)
    {
        $macamProdukModel = new MacamProdukModel();
        $produkModel = new ProdukModel();

        $search = $this->request->getGet('search');
        $produkFilter = $this->request->getGet('produk_id'); // dari dropdown
        $date_from = $this->request->getGet('date_from');
        $date_to = $this->request->getGet('date_to');

        $query = $macamProdukModel;

        if ($search) {
            $query = $query->like('nama', $search);
        }

        if ($produkFilter) {
            $query = $query->where('produk_id', $produkFilter);
        } elseif ($produk_id) {
            $query = $query->where('produk_id', $produk_id);
        }

        if ($date_from && $date_to) {
            $query = $query->where('created_at >=', $date_from)
                ->where('created_at <=', $date_to);
        }

        $macamProduk = $query->findAll();
        $produkList = $produkModel->findAll();
        $produk = $produk_id ? $produkModel->find($produk_id) : null;

        return view('admin/macam/index', [
            'macamProduk' => $macamProduk,
            'search' => $search,
            'produk_id' => $produkFilter ?: $produk_id,
            'produkList' => $produkList,
            'produk' => $produk,
            'date_from' => $date_from,
            'date_to' => $date_to
        ]);
    }


    // Tambah Macam Produk
    public function create_macam_produk($produk_id = null)
    {
        $produkModel = new ProdukModel();
        $produkList = $produkModel->findAll();
        return view('admin/macam/tambah-macam-produk', [
            'produk_id' => $produk_id,
            'produkList' => $produkList
        ]);
    }

    // menambahkan macam produk
    public function store_macam_produk()
    {
        $macamProdukModel = new MacamProdukModel();

        $validated = $this->validate([
            'nama'      => 'required',
            'deskripsi' => 'required',
            'harga'     => 'required|numeric',
            'gambar'    => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/png,image/jpg,image/jpeg]',
        ]);

        if (!$validated) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal. Periksa kembali input Anda.');
        }

        $gambar = $this->request->getFile('gambar');
        $namaGambar = $gambar->getRandomName();
        $gambar->move('uploads/macam-produk', $namaGambar);

        $data = [
            'nama'      => $this->request->getPost('nama'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga'     => $this->request->getPost('harga'),
            'gambar'    => $namaGambar,
            'produk_id' => $this->request->getPost('produk_id')
        ];

        $macamProdukModel->insert($data);
        return redirect()->to('/macam')->with('success', 'Macam Produk berhasil ditambahkan.');
    }


    // Form Edit Macam Produk
    public function edit_macam_produk($id)
    {
        $macamProdukModel = new MacamProdukModel();
        $produkModel = new ProdukModel();

        $macamProduk = $macamProdukModel->find($id);
        if (!$macamProduk) {
            return redirect()->to('/macam')->with('error', 'Macam Produk tidak ditemukan.');
        }

        $produkList = $produkModel->findAll();

        return view('admin/macam/edit-macam-produk', [
            'macamProduk' => $macamProduk,
            'produkList' => $produkList
        ]);
    }

    // Simpan Perubahan Macam Produk
    public function update_macam_produk($id)
    {
        $macamProdukModel = new MacamProdukModel();
        $macamProduk = $macamProdukModel->find($id);
        if (!$macamProduk) {
            return redirect()->to('/macam')->with('error', 'Macam Produk tidak ditemukan.');
        }

        $validated = $this->validate([
            'nama'      => 'required',
            'deskripsi' => 'required',
            'harga'     => 'required|numeric',
            'gambar'    => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/png,image/jpg,image/jpeg]',
        ]);

        if (!$validated) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal. Periksa kembali input Anda.');
        }

        $gambar = $this->request->getFile('gambar');
        $namaGambar = $macamProduk['gambar'];

        if ($gambar->isValid() && !$gambar->hasMoved()) {
            if ($macamProduk['gambar'] && file_exists('uploads/macam-produk/' . $macamProduk['gambar'])) {
                unlink('uploads/macam-produk/' . $macamProduk['gambar']);
            }

            $namaGambar = $gambar->getRandomName();
            $gambar->move('uploads/macam-produk', $namaGambar);
        }

        $data = [
            'nama'      => $this->request->getPost('nama'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga'     => $this->request->getPost('harga'),
            'gambar'    => $namaGambar,
            'produk_id' => $this->request->getPost('produk_id')
        ];

        $macamProdukModel->update($id, $data);
        return redirect()->to('/macam')->with('success', 'Macam Produk berhasil diperbarui.');
    }

    // Hapus Macam Produk
    public function delete_macam_produk($id)
    {
        $macamProdukModel = new MacamProdukModel();
        $macamProduk = $macamProdukModel->find($id);

        if (!$macamProduk) {
            return redirect()->to('/macam')->with('error', 'Macam Produk tidak ditemukan.');
        }

        if ($macamProduk['gambar'] && file_exists('uploads/macam-produk/' . $macamProduk['gambar'])) {
            unlink('uploads/macam-produk/' . $macamProduk['gambar']);
        }

        $macamProdukModel->delete($id);
        return redirect()->to('/macam')->with('success', 'Macam Produk berhasil dihapus.');
    }
}
