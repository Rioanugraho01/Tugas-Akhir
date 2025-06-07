<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use CodeIgniter\HTTP\ResponseInterface;

class TransaksiController extends BaseController
{
    public function bayar($id)
    {
        $transaksiModel = new TransaksiModel();
        $transaksi = $transaksiModel->find($id);

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        $file = $this->request->getFile('bukti_pembayaran');
        if ($file && $file->isValid()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/bukti/', $namaFile);
        } else {
            $namaFile = null;
        }

        $transaksiModel->update($id, [
            'tanggal_transaksi' => date('Y-m-d'),
            'status_pembayaran' => 'diproses',
            'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
            'bukti_pembayaran'  => $namaFile
        ]);

        return redirect()->to('/user/pemesanan')->with('success', 'Pembayaran berhasil dikirim, menunggu verifikasi.');
    }
}
