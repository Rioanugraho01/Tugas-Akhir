<?php

namespace App\Controllers;

use App\Models\FormPemesananModel;


class FormPemesananController extends BaseController
{
    public function index()
    {
        $formModel = new FormPemesananModel();
        $last = $formModel->orderBy('id_pemesanan', 'desc')->first();

        return view('user/form/form-pemesanan', [
            'status_pemesanan' => $last['status'] ?? null
        ]);
    }

    public function simpan()
    {
        $model = new FormPemesananModel();

        $model->save([
            'user_id' => session()->get('user_id'),
            'nama' => $this->request->getPost('nama'),
            'nomor_hp' => $this->request->getPost('nomor_hp'),
            'nama_acara' => $this->request->getPost('nama_acara'),
            'produk' => $this->request->getPost('produk'),
            'tanggal_pemesanan' => $this->request->getPost('tanggal_pemesanan'),
            'waktu_pemesanan' => $this->request->getPost('waktu_pemesanan'),
            'jumlah_tamu' => $this->request->getPost('jumlah_tamu'),
            'pembayaran' => $this->request->getPost('pembayaran'),
            'catatan' => $this->request->getPost('catatan'),
        ]);

        session()->setFlashdata('success', 'Pemesanan berhasil dikirim. Anda dapat menuju ke tempat Ima Catering untuk berdiskusi lebih lanjut.');
        return redirect()->to('/form-pemesanan');

    }

    public function konfirmasi($id)
    {
        $model = new FormPemesananModel();
        $model->update($id, ['status' => 'Diterima']);
    
        return redirect()->to('/form-pemesanan')->with('pesan_diterima', 'Pemesanan diterima. Silakan datang ke lokasi IMA Catering.');
    }    
}
