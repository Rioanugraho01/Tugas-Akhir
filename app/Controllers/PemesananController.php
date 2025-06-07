<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PemesananModel;
use App\Models\ProdukModel;
use App\Models\MacamProdukModel;
use App\Models\PembayaranModel;
use CodeIgniter\HTTP\ResponseInterface;

class PemesananController extends BaseController
{

    protected $pemesananModel;

    public function __construct()
    {
        $this->pemesananModel = new PemesananModel();
    }

    public function pemesanan()
    {
        $userId = session()->get('user_id');
        $phone = session()->get('phone');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $cart = session()->get('cart_' . $userId) ?? [];

        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['harga'] * $item['jumlah']);
        }, 0);

        $macamProdukId = $cart[0]['id'] ?? null;

        $produk = null;
        if ($macamProdukId) {
            $macamModel = new \App\Models\MacamProdukModel();
            $macam = $macamModel->find($macamProdukId);
            if ($macam) {
                $produkModel = new \App\Models\ProdukModel();
                $produk = $produkModel->find($macam['produk_id']);
            }
        }

        $pemesananModel = new \App\Models\PemesananModel();
        $pemesanan = $pemesananModel
            ->where('no_hp', $phone)
            ->orderBy('created_at', 'DESC')
            ->first();

        return view('user/booking/pemesanan', [
            'cart'   => $cart,
            'total'  => $total,
            'produk' => $produk,
            'macam'  => $macam ?? null,
            'phone'  => $phone,
            'pemesanan' => $pemesanan
        ]);
    }

    public function form($produkId)
    {
        $produkModel = new \App\Models\ProdukModel();
        $macamModel = new \App\Models\MacamProdukModel();

        $produk = $produkModel->find($produkId);
        $macam = $macamModel->where('produk_id', $produkId)->findAll();

        return view('pemesanan/form', [
            'produk' => $produk,
            'macam' => $macam
        ]);
    }

    public function index($produkId = null)
    {
        $produkModel = new ProdukModel();
        $macamModel = new MacamProdukModel();

        if (!$produkId) {
            return redirect()->to('/');
        }

        $produk = $produkModel->find($produkId);
        if (!$produk) {
            return redirect()->to('/')->with('error', 'Produk tidak ditemukan.');
        }

        $macam = $macamModel->where('produk_id', $produkId)->first();

        $pemesanan = null;
        if (!session()->has('cart')) {
            session()->set('cart', [[
                'id' => $produk['id'],
                'nama' => $macam['nama_macam'],
                'harga' => $macam['harga'],
                'jumlah' => 1
            ]]);
        }

        return view('pemesanan/index', [
            'produk' => $produk,
            'macam' => [$macam],
            'pemesanan' => $pemesanan,
        ]);
    }

    public function pembayaran($id)
    {
        $model = new \App\Models\PemesananModel();
        $pemesanan = $model->find($id);

        if (!$pemesanan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pemesanan tidak ditemukan');
        }

        return view('pemesanan/pembayaran', ['pemesanan' => $pemesanan]);
    }

    public function konfirmasi()
    {
        $produkModel = new \App\Models\ProdukModel();
        $macamModel = new \App\Models\MacamProdukModel();
        $pemesananModel = new \App\Models\PemesananModel();

        $validation = \Config\Services::validation();

        $produkId = $this->request->getPost('produk_id');
        $macamProdukId = $this->request->getPost('macam_produk_id');

        $validation->setRules([
            'produk_id'           => 'required|numeric',
            'macam_produk_id'     => 'required|numeric',
            'nama'                => 'required|string',
            'no_hp'               => 'required|string',
            'tanggal_pemesanan'   => 'required|valid_date',
            'tanggal_pengambilan' => 'required|valid_date',
            'waktu_pengambilan'   => 'required|regex_match[/^([01]\d|2[0-3]):([0-5]\d)$/]',
            'jenis_pembayaran'    => 'required|string',
            'total_harga'         => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal. Pastikan semua data sudah benar.');
        }

        $totalHarga = str_replace(['.', ','], '', $this->request->getPost('total_harga'));

        $total = $this->request->getPost('total_harga');
        $persentase_dp = 30;
        $dp = $total * ($persentase_dp / 100);
        $sisa = $total - $dp;

        $jenis_pembayaran = $this->request->getPost('jenis_pembayaran');

        if ($jenis_pembayaran === 'bayar_nanti') {
            $status_pembayaran = 'terverifikasi - belum lunas';
        } else {
            $status_pembayaran = 'menunggu verifikasi';
        }

        $userId = session()->get('user_id');

        $data = [
            'user_id'             => $userId,
            'produk_id'           => $produkId,
            'macam_produk_id'     => $macamProdukId,
            'nama'                => $this->request->getPost('nama'),
            'no_hp'               => $this->request->getPost('no_hp'),
            'macam_produk'        => $this->request->getPost('macam_produk'),
            'total_harga'         => (float) $totalHarga,
            'jumlah_dp'           => $dp,
            'sisa_pembayaran'     => $sisa,
            'persentase_dp'       => $persentase_dp,
            'tanggal_pemesanan'   => $this->request->getPost('tanggal_pemesanan'),
            'tanggal_pengambilan' => $this->request->getPost('tanggal_pengambilan'),
            'waktu_pengambilan'   => $this->request->getPost('waktu_pengambilan'),
            'jenis_pembayaran'    => $this->request->getPost('jenis_pembayaran'),
            'catatan'             => $this->request->getPost('catatan'),
            'status_pemesanan'    => 'pending',
            'status_pembayaran'   => $status_pembayaran,
            'created_at'          => date('Y-m-d H:i:s'),
        ];

        $pemesananModel->insert($data);
        $pemesananId = $pemesananModel->getInsertID();

        if ($pemesananId) {
            session()->set('pemesanan_id', $pemesananId);
            session()->set('phone', $this->request->getPost('no_hp'));

            $adminPhone = '6282337406335';
            $pesan = "*Pesanan Baru*\n\n";
            $pesan .= "Nama: {$data['nama']}\n";
            $pesan .= "No HP: {$data['no_hp']}\n";
            $pesan .= "Macam Produk: {$data['macam_produk']}\n";
            $pesan .= "Total Harga: Rp " . number_format($data['total_harga'], 0, ',', '.') . "\n";
            $pesan .= "Tanggal Pemesanan: {$data['tanggal_pemesanan']}\n";
            $pesan .= "Tanggal Pengambilan: {$data['tanggal_pengambilan']}\n";
            $pesan .= "Pembayaran: {$data['jenis_pembayaran']}\n";
            $pesan .= "Catatan: " . ($data['catatan'] ?: '-') . "\n\n";
            $pesan .= "*Status:* {$data['status_pemesanan']} | {$data['status_pembayaran']}";

            $this->sendWhatsAppFonnte($adminPhone, $pesan);

            return redirect()->to('/pemesanan?tab=profile')
                ->with('success', 'Pesanan berhasil dikirim.');
        }

        $macamProdukModel = new MacamProdukModel();

        $macamProdukIds = $this->request->getPost('macam_produk');
        $jumlahProduk = $this->request->getPost('jumlah');

        $macamProdukStrings = [];

        if (is_array($macamProdukIds) && is_array($jumlahProduk)) {
            foreach ($macamProdukIds as $index => $id) {
                $produk = $macamProdukModel->find($id);
                if ($produk) {
                    $nama = $produk['nama']; 
                    $qty = isset($jumlahProduk[$index]) ? intval($jumlahProduk[$index]) : 0;
                    if ($qty > 0) {
                        $macamProdukStrings[] = $nama . " x" . $qty;
                    }
                }
            }
        }

        $macamProdukString = implode(", ", $macamProdukStrings);

        return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan pemesanan.');
    }

    private function sendWhatsAppFonnte($phoneNumber, $message)
    {
        $token = 'cb6doqhkmo7LPsacZTrB';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.fonnte.com/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
                "target" => $phoneNumber,
                "message" => $message,
                "countryCode" => "62",
            ]),
            CURLOPT_HTTPHEADER => [
                "Authorization: $token"
            ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            log_message('error', "Fonnte Error: $err");
            return false;
        }

        $result = json_decode($response, true);
        log_message('info', "Fonnte response: " . print_r($result, true));

        return $result;
    }

    public function formPembayaran($id)
    {
        $model = new \App\Models\PemesananModel();
        $pemesanan = $model->find($id);

        if (!$pemesanan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pemesanan tidak ditemukan');
        }

        return view('pembayaran/form', ['pemesanan' => $pemesanan]);
    }

    public function ubahStatus($id)
    {
        $model = new \App\Models\PemesananModel();
        $model->update($id, ['status_pembayaran' => 'diterima']);

        return redirect()->back()->with('success', 'Status diubah menjadi diterima.');
    }

    public function uploadBukti($id)
    {
        $pemesanan = $this->pemesananModel->find($id);
        $bukti = $this->request->getFile('bukti_pembayaran');

        if (!$pemesanan) {
            return redirect()->back()->with('error', 'Data pemesanan tidak ditemukan.');
        }

        if ($bukti && $bukti->isValid() && !$bukti->hasMoved()) {
            $newName = time() . '_' . $bukti->getRandomName();
            $bukti->move('uploads/bukti/', $newName);

            $this->pemesananModel->update($id, [
                'bukti_pembayaran' => $newName,
                'status_pembayaran' => 'menunggu_verifikasi'
            ]);

            return redirect()->back()->with('success', 'Bukti transfer berhasil diupload, silakan tunggu admin memverifikasi.');
        }

        return redirect()->back()->with('error', 'Upload bukti pembayaran gagal.');
    }

    public function selesai($id)
    {
        $pemesanan = $this->pemesananModel->find($id);

        if (!$pemesanan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $this->pemesananModel->update($id, ['status_pemesanan' => 'selesai']);

        return redirect()->back()->with('success', 'Pesanan telah ditandai selesai.');
    }
}
