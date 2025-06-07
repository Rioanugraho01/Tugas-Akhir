<?php

namespace App\Controllers;

use App\Models\FormPemesanan;
use App\Models\FormPemesananModel;

class PemesananKhususController extends BaseController
{
    public function index()
    {
        $formModel = new FormPemesananModel();

        $search = $this->request->getGet('search');
        $dateFrom = $this->request->getGet('date_from');
        $dateTo = $this->request->getGet('date_to');

        $builder = $formModel->select('form_pemesanan.*, users.username')
        ->join('users', 'users.id = form_pemesanan.user_id', 'left')
        ->orderBy('id_pemesanan', 'asc');    

        if (!empty($search)) {
            $builder->groupStart()
                ->like('nama', $search)
                ->orLike('nama_acara', $search)
                ->orLike('produk', $search)
                ->groupEnd();
        }

        if (!empty($dateFrom)) {
            $builder->where('tanggal_pemesanan >=', $dateFrom);
        }
        if (!empty($dateTo)) {
            $builder->where('tanggal_pemesanan <=', $dateTo);
        }

        $data['pemesanan'] = $builder->findAll();

        $data['search'] = $search;
        $data['date_from'] = $dateFrom;
        $data['date_to'] = $dateTo;

        return view('admin/pemesanan-khusus/index', $data);
    }
}
