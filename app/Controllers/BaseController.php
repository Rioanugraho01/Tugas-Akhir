<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\WebsiteSettingsModel;

class BaseController extends Controller
{
    protected $request;
    protected $helpers = [];

    protected $setting;
    protected $data = [];

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, 
                                    \CodeIgniter\HTTP\ResponseInterface $response, 
                                    \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        if (!empty($this->helpers)) {
            helper($this->helpers);
        }
        $settingModel = new WebsiteSettingsModel();
        $allSettings = $settingModel->findAll();
        $this->setting = $allSettings[0] ?? [];
        \Config\Services::renderer()->setVar('setting', $this->setting);
        $this->data['title'] = 'Ima Catering';
        $this->data['meta_title'] = 'Ima Catering - Solusi Catering Terbaik';
        $this->data['meta_description'] = 'Layanan catering terpercaya di Banyuwangi';
    }
}
