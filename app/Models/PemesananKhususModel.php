<?php

namespace App\Models;

use CodeIgniter\Model;

class PemesananKhususModel extends Model
{
    protected $table            = 'pemesanan_khusus';
    protected $primaryKey       = 'id_pemesanan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'user_id', 'nama', 'nomor_hp', 'nama_acara', 'produk',
        'tanggal_pemesanan', 'waktu_pemesanan', 'jumlah_tamu', 'pembayaran',
        'total_harga', 'status_pemesanan', 'status_pembayaran', 'catatan', 'created_at', 'updated_at'
    ];

    public function getRiwayatByUser($nomorHp)
    {
        return $this->where('nomor_hp', $nomorHp)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
