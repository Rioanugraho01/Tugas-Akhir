<?php

namespace App\Controllers;

use App\Models\KetersediaanModel;

class KalenderKetersediaanController extends BaseController
{
    protected $ketersediaanModel;

    public function __construct()
    {
        $this->ketersediaanModel = new KetersediaanModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        $dateFrom = $this->request->getGet('date_from');
        $dateTo = $this->request->getGet('date_to');
        $status = $this->request->getGet('status');
    
        $model = new KetersediaanModel();
        $builder = $model->orderBy('tanggal', 'ASC');
    
        if ($search) {
            $builder->like('tanggal', $search);
        }
    
        if ($dateFrom && $dateTo) {
            $builder->where('tanggal >=', $dateFrom)
                    ->where('tanggal <=', $dateTo);
        }
    
        if ($status) {
            $builder->where('status', $status);
        }
    
        $data['ketersediaan'] = $builder->findAll();
    
        return view('admin/kalender-ketersediaan/index', $data);
    }        

    public function create()
    {
        return view('admin/kalender-ketersediaan/tambah-kalender');
    }

    public function store()
    {
        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'status' => $this->request->getPost('status')
        ];

        $this->ketersediaanModel->save($data);
        return redirect()->to('/kalender-ketersediaan');
    }

    public function edit($id)
    {
        $data['ketersediaan'] = $this->ketersediaanModel->find($id);
        return view('admin/kalender-ketersediaan/edit-kalender', $data);
    }

    public function update($id)
    {
        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'status' => $this->request->getPost('status')
        ];

        $this->ketersediaanModel->update($id, $data);
        return redirect()->to('/kalender-ketersediaan');
    }

    public function delete($id)
    {
        $this->ketersediaanModel->delete($id);
        return redirect()->to('/kalender-ketersediaan');
    }
}
