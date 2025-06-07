<?php

namespace App\Models;

use CodeIgniter\Model;

class PemesananModel extends Model
{
    protected $table            = 'pemesanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'user_id',
        'jenis_produk',
        'produk_id',
        'macam_produk_id',
        'nama',
        'no_hp',
        'macam_produk',
        'total_harga',
        'persentase_dp',
        'jumlah_dp',
        'sisa_pembayaran',
        'tanggal_pemesanan',
        'tanggal_pengambilan',
        'waktu_pengambilan',
        'jenis_pembayaran',
        'catatan',
        'status_pemesanan',
        'status_pembayaran',
        'status_progress',
        'bukti_pembayaran',
        'created_at',
        'updated_at',
    ];

    public function updateStatus($id, $status)
    {
        return $this->update($id, ['status_pemesanan' => $status]);
    }

    public function updateStatusPembayaran($id, $statusPembayaran)
    {
        return $this->update($id, ['status_pembayaran' => $statusPembayaran]);
    }

    public function getById($id)
    {
        return $this->find($id);
    }

    public function getRiwayatByUser($userId)
    {
        return $this->where('user_id', $userId)
                    ->whereIn('status_pembayaran', ['terverifikasi - belum lunas', 'terverifikasi - sudah lunas'])
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
