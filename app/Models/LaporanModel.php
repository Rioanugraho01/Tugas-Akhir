<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $DBGroup = 'default';

    protected $table = 'laporan';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [];

    // Fungsi untuk dapatkan daftar tahun (tahun yang ada di data)
    public function getListTahun()
    {
        $db = \Config\Database::connect();

        $tahunReguler = $db->table('pemesanan')
            ->select("YEAR(tanggal_pemesanan) as tahun")
            ->groupBy('tahun')
            ->orderBy('tahun', 'DESC')
            ->get()
            ->getResultArray();

        $tahunKhusus = $db->table('pemesanan_khusus')
            ->select("YEAR(tanggal_pemesanan) as tahun")
            ->groupBy('tahun')
            ->orderBy('tahun', 'DESC')
            ->get()
            ->getResultArray();

        $tahunGabungan = [];

        foreach ($tahunReguler as $t) {
            $tahunGabungan[$t['tahun']] = true;
        }

        foreach ($tahunKhusus as $t) {
            $tahunGabungan[$t['tahun']] = true;
        }

        $listTahun = array_keys($tahunGabungan);
        rsort($listTahun); // descending

        return $listTahun;
    }

    // Fungsi pemasukan bulanan dari pemesanan reguler
    public function getPemasukanBulanan()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('pemesanan');
        $builder->select("DATE_FORMAT(created_at, '%Y-%m') as bulan, SUM(total_harga) as total");
        $builder->groupBy('bulan');
        $builder->orderBy('bulan', 'ASC');

        return $builder->get()->getResultArray();
    }

    // Fungsi pemasukan bulanan dari pemesanan khusus
    public function getPemasukanBulananKhusus()
    {
        return $this->db->table('pemesanan_khusus')
            ->select("DATE_FORMAT(created_at, '%Y-%m') AS bulan, SUM(total_harga) AS total")
            ->where('status_pembayaran', 'lunas')
            ->groupBy("DATE_FORMAT(created_at, '%Y-%m')")
            ->orderBy("bulan", "ASC")
            ->get()
            ->getResultArray();
    }

    // Fungsi laba bulanan dari pemesanan reguler
    public function getLabaBulanan()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('pemesanan');
        $builder->select("DATE_FORMAT(created_at, '%Y-%m') as bulan, SUM(total_harga * 0.4) as laba");
        $builder->groupBy('bulan');
        $builder->orderBy('bulan', 'ASC');

        return $builder->get()->getResultArray();
    }

    // Fungsi laba bulanan dari pemesanan khusus
    public function getLabaBulananKhusus()
    {
        return $this->db->table('pemesanan_khusus')
            ->select("DATE_FORMAT(created_at, '%Y-%m') AS bulan, SUM(total_harga * 0.4) as laba")
            ->where('status_pembayaran', 'lunas')
            ->groupBy("DATE_FORMAT(created_at, '%Y-%m')")
            ->orderBy("bulan", "ASC")
            ->get()
            ->getResultArray();
    }

    // Hitung total jumlah pemesanan reguler dan khusus
    public function getTotalPemesanan()
    {
        $db = \Config\Database::connect();

        $totalReguler = $db->table('pemesanan')->countAllResults();
        $totalKhusus = $db->table('pemesanan_khusus')->countAllResults();

        return [
            'reguler' => $totalReguler,
            'khusus' => $totalKhusus
        ];
    }
}
