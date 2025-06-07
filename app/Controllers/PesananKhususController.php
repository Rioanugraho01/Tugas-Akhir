<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PemesananKhususModel;


class PesananKhususController extends BaseController
{
    protected $pemesananModel;

    public function __construct()
    {
        $this->pemesananModel = new PemesananKhususModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pemesanan_khusus');
        $builder->select('pemesanan_khusus.*, users.username');
        $builder->join('users', 'users.id = pemesanan_khusus.user_id', 'left');

        if ($search = $this->request->getGet('search')) {
            $builder->groupStart()
                ->like('pemesanan_khusus.nama', $search)
                ->orLike('produk', $search)
                ->orLike('nama_acara', $search)
                ->orLike('users.username', $search)
                ->groupEnd();
        }

        if ($from = $this->request->getGet('date_from')) {
            $builder->where('tanggal_pemesanan >=', $from);
        }
        if ($to = $this->request->getGet('date_to')) {
            $builder->where('tanggal_pemesanan <=', $to);
        }

        $data['pemesanan'] = $builder->get()->getResultArray();
        return view('admin/data-pemesanan-khusus/index', $data);
    }

    public function create()
    {
        $userModel = new \App\Models\UserModel();
        $data['users'] = $userModel->findAll();

        return view('admin/data-pemesanan-khusus/create', $data);
    }

    public function store()
    {
        $this->pemesananModel->save([
            'user_id' => $this->request->getPost('user_id'),
            'nama' => $this->request->getPost('nama'),
            'nomor_hp' => $this->request->getPost('nomor_hp'),
            'nama_acara' => $this->request->getPost('nama_acara'),
            'produk' => $this->request->getPost('produk'),
            'tanggal_pemesanan' => $this->request->getPost('tanggal_pemesanan'),
            'waktu_pemesanan' => $this->request->getPost('waktu_pemesanan'),
            'jumlah_tamu' => $this->request->getPost('jumlah_tamu'),
            'pembayaran' => $this->request->getPost('pembayaran'),
            'total_harga' => $this->request->getPost('total_harga'),
            'catatan' => $this->request->getPost('catatan'),
            'status_pemesanan' => 'terima',
            'status_pembayaran' => 'dp',
        ]);

        return redirect()->to('data-pemesanan-khusus')->with('success', 'data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pemesanan = $this->pemesananModel->find($id);
        if (!$pemesanan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pemesanan tidak ditemukan');
        }
        $userModel = new \App\Models\UserModel();
        $data['users'] = $userModel->findAll();
        $data['pemesanan'] = $pemesanan;

        return view('admin/data-pemesanan-khusus/edit', $data);
    }

    public function update($id)
    {

        $pemesanan = $this->pemesananModel->find($id);
        if ($pemesanan['status_pemesanan'] === 'selesai' && $pemesanan['status_pembayaran'] === 'lunas') {
            return redirect()->to('/data-pemesanan-khusus')->with('error', 'Data tidak bisa diupdate karena sudah selesai dan lunas.');
        }
        $this->pemesananModel->update($id, [
            'nama' => $this->request->getPost('nama'),
            'nomor_hp' => $this->request->getPost('nomor_hp'),
            'nama_acara' => $this->request->getPost('nama_acara'),
            'produk' => $this->request->getPost('produk'),
            'tanggal_pemesanan' => $this->request->getPost('tanggal_pemesanan'),
            'waktu_pemesanan' => $this->request->getPost('waktu_pemesanan'),
            'jumlah_tamu' => $this->request->getPost('jumlah_tamu'),
            'pembayaran' => $this->request->getPost('pembayaran'),
            'total_harga' => $this->request->getPost('total_harga'),
            'catatan' => $this->request->getPost('catatan'),
            'status_pemesanan' => 'terima',
            'status_pembayaran' => 'dp',
        ]);

        $status_pemesanan = $this->request->getPost('status_pemesanan');
        if ($status_pemesanan !== null) {
            $dataUpdate['status_pemesanan'] = $status_pemesanan;
        }
        $status_pembayaran = $this->request->getPost('status_pembayaran');
        if ($status_pembayaran !== null) {
            $dataUpdate['status_pembayaran'] = $status_pembayaran;
        }
        $this->pemesananModel->update($id, $dataUpdate);    

        return redirect()->to('/data-pemesanan-khusus')->with('success', 'data berhasil diupdate');
    }

    public function delete($id)
    {
        $this->pemesananModel->delete($id);
        return redirect()->to('/data-pemesanan-khusus')->with('success', 'data berhasil dihapus');
    }
}
