<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PemesananModel;

class DataPemesananController extends BaseController
{
    protected $pemesananModel;

    public function __construct()
    {
        $this->pemesananModel = new PemesananModel();
    }

    public function data_pemesanan()
    {
        $search = $this->request->getGet('search');
        $dateFrom = $this->request->getGet('date_from');
        $dateTo = $this->request->getGet('date_to');
        $progress = $this->request->getGet('progress');
        $metode = $this->request->getGet('metode');
        $status = $this->request->getGet('status');

        $builder = $this->pemesananModel->builder();

        $builder->select('pemesanan.*, users.username, nama as nama_user');
        $builder->join('users', 'users.id = pemesanan.user_id', 'left');

        if ($search) {
            $builder->groupStart()
                ->like('nama', $search)
                ->orLike('users.username', $search)
                ->groupEnd();
        }

        if ($dateFrom) {
            $builder->where('tanggal_pemesanan >=', $dateFrom);
        }

        if ($dateTo) {
            $builder->where('tanggal_pemesanan <=', $dateTo);
        }

        if ($progress) {
            $builder->where('status_progress', $progress);
        }

        if ($metode) {
            $builder->where('jenis_pembayaran', $metode);
        }

        if ($status) {
            $builder->where('status_pemesanan', $status);
        }

        $data['pemesanan'] = $builder->orderBy('pemesanan.id', 'ASC')->get()->getResultArray();

        return view('admin/data-pemesanan/index', $data);
    }

    public function konfirmasi($id)
    {
        $pemesanan = $this->pemesananModel->find($id);
        if (!$pemesanan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
        $statusPembayaran = $pemesanan['status_pembayaran'];
        if ($pemesanan['jenis_pembayaran'] === 'bayar_nanti' && $statusPembayaran === 'menunggu verifikasi') {
            $statusPembayaran = 'terverifikasi - belum lunas';
        }
        $this->pemesananModel->update($id, [
            'status_pemesanan' => 'diterima',
            'status_pembayaran' => $statusPembayaran
        ]);
        return redirect()->to('/data-pemesanan')->with('success', 'Pesanan berhasil dikonfirmasi.');
    }

    public function tolak($id)
    {
        $this->pemesananModel->update($id, [
            'status_pemesanan' => 'ditolak',
            'status_pembayaran' => 'tidak_dibayar'
        ]);
        return redirect()->to('/data-pemesanan')->with('success', 'Pesanan berhasil ditolak.');
    }

    public function verifikasiPembayaran($id)
    {
        $pemesanan = $this->pemesananModel->find($id);
        if (!$pemesanan) {
            return redirect()->back()->with('error', 'Data pemesanan tidak ditemukan.');
        }
        $status_pembayaran = 'terverifikasi - belum lunas';
        if ($pemesanan['jenis_pembayaran'] === 'bayar_sekarang') {
            if (!$pemesanan['bukti_pembayaran']) {
                return redirect()->back()->with('error', 'Bukti pembayaran tidak ditemukan.');
            }
            $status_pembayaran = 'terverifikasi - lunas';
        } elseif ($pemesanan['jenis_pembayaran'] === 'dp') {
            if (!$pemesanan['bukti_pembayaran']) {
                return redirect()->back()->with('error', 'Bukti pembayaran DP tidak ditemukan.');
            }
            $status_pembayaran = 'terverifikasi - belum lunas';
        } elseif ($pemesanan['jenis_pembayaran'] === 'bayar_nanti') {
            $status_pembayaran = 'terverifikasi - belum lunas';
        }
        $this->pemesananModel->update($id, [
            'status_pembayaran' => $status_pembayaran,
            'status_pemesanan' => 'diterima'
        ]);
        return redirect()->to('/data-pemesanan')->with('success', 'Pembayaran telah diverifikasi.');
    }

    public function verifikasi($id)
    {
        $this->pemesananModel->update($id, [
            'status_pembayaran' => 'pembayaran_terverifikasi',
            'status_pemesanan' => 'diterima'
        ]);
        return redirect()->to('/data-pemesanan')->with('success', 'Pembayaran berhasil diverifikasi.');
    }

    public function edit($id)
    {
        $pemesanan = $this->pemesananModel->find($id);
        if (!$pemesanan) {
            return redirect()->to('/data-pemesanan')->with('error', 'Data tidak ditemukan.');
        }
        return view('admin/data-pemesanan/edit', ['pemesanan' => $pemesanan]);
    }

    public function update($id)
    {
        $pemesanan = $this->pemesananModel->find($id);
        if (!$pemesanan) {
            return redirect()->back()->with('error', 'Data pemesanan tidak ditemukan.');
        }
        $statusPembayaranBaru = $this->request->getPost('status_pembayaran');
        $jenisPembayaran = $pemesanan['jenis_pembayaran'];
        $statusPembayaran = $pemesanan['status_pembayaran'];
        if (in_array($jenisPembayaran, ['dp', 'bayar_nanti'])) {
            if ($statusPembayaranBaru === 'lunas' && $statusPembayaran === 'terverifikasi - belum lunas') {
                $statusPembayaran = 'terverifikasi - lunas';
            } elseif ($statusPembayaranBaru === 'belum lunas') {
                $statusPembayaran = 'terverifikasi - belum lunas';
            }
        } else {
            return redirect()->back()->with('error', 'Metode pembayaran tidak dapat diubah statusnya.');
        }
        if ($statusPembayaran === 'terverifikasi - lunas') {
            $statusPemesanan = 'terverifikasi - sudah lunas';
        } else {
            $statusPemesanan = 'terverifikasi - belum lunas';
        }
        $this->pemesananModel->update($id, [
            'status_pembayaran' => $statusPembayaran,
        ]);
        return redirect()->to('/data-pemesanan')->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    public function tandaiLunas($id)
    {
        $pemesanan = $this->pemesananModel->find($id);
        if (!$pemesanan) {
            return redirect()->back()->with('error', 'Data pemesanan tidak ditemukan.');
        }
        $this->pemesananModel->update($id, [
            'status_pembayaran' => 'terverifikasi - lunas'
        ]);
        return redirect()->back()->with('success', 'Status pembayaran diperbarui menjadi lunas.');
    }

    public function update_progress($id)
    {
        $pemesanan = $this->pemesananModel->find($id);
        $status_sekarang = $pemesanan['status_progress'];
        $status_baru = $this->request->getPost('status_progress');
        $urutan = ['proses pembuatan', 'proses packing', 'siap diambil', 'selesai'];
        $index_sekarang = array_search($status_sekarang, $urutan);
        $index_baru = array_search($status_baru, $urutan);

        if ($index_baru < $index_sekarang) {
            return redirect()->to('/data-pemesanan')->with('error', 'Tidak bisa kembali ke status sebelumnya.');
        }

        if ($status_sekarang == 'selesai') {
            return redirect()->to('/data-pemesanan')->with('error', 'Status sudah selesai dan tidak dapat diubah.');
        }

        $this->pemesananModel->update($id, ['status_progress' => $status_baru]);
        return redirect()->to('/data-pemesanan')->with('success', 'Status progress berhasil diperbarui.');
    }

    public function detail($id)
    {
        $model = new PemesananModel();

        $data['pemesanan'] = $model
            ->select('pemesanan.*, users.username, nama as nama_user, no_hp')
            ->join('users', 'users.id = pemesanan.user_id', 'left')
            ->where('pemesanan.id', $id)
            ->first();

        if (!$data['pemesanan']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pemesanan tidak ditemukan');
        }

        return view('admin/data-pemesanan/pemesanan_detail', $data);
    }

    public function updateStatus($id)
    {
        $pemesananModel = new \App\Models\PemesananModel();
        $statusPemesanan = $this->request->getPost('status_pemesanan');
        $statusPembayaran = $this->request->getPost('status_pembayaran');
        $dataUpdate = [];
        if ($statusPembayaran !== null) {
            $dataUpdate['status_pembayaran'] = $statusPembayaran;
            if ($statusPembayaran === 'lunas') {
                $dataUpdate['status_pembayaran'] = 'terverifikasi - lunas';
            }
        }
        if ($statusPemesanan !== null) {
            $dataUpdate['status_pemesanan'] = $statusPemesanan;
            if ($statusPemesanan === 'ditolak') {
                $pemesanan = $pemesananModel->find($id);
                if ($pemesanan && $pemesanan['status_progress'] == 'proses pembuatan') {
                    $dataUpdate['status_progress'] = 'selesai';
                }
            }
        }
        if (!empty($dataUpdate)) {
            $pemesananModel->update($id, $dataUpdate);
        }
        return redirect()->to('/admin/data-pemesanan')->with('success', 'Status berhasil diperbarui');
    }
}
