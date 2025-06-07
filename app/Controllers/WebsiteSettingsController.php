<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\WebsiteSettingsModel;

class WebsiteSettingsController extends BaseController
{

    protected $settingModel;

    public function __construct()
    {
        $this->settingModel = new WebsiteSettingsModel();
    }

    public function index()
    {
        $allSettings = $this->settingModel->findAll();
        $data['settings'] = $allSettings;
        $data['setting'] = $allSettings[0] ?? [];

        return view('admin/settings/index', $data);
    }

    public function edit($id)
    {
        $model = new WebsiteSettingsModel();
        $data['settings'] = $model->find($id);
        return view('admin/settings/edit', $data);
    }

    public function update()
    {
        $model = new WebsiteSettingsModel();

        $id = $this->request->getPost('id');

        $data = [
            'email_header' => $this->request->getPost('email_header'),
            'phone_header' => $this->request->getPost('phone_header'),
            'address_header' => $this->request->getPost('address_header'),
            'logo_navbar' => $this->request->getPost('logo_navbar'),
            'slider_image' => $this->request->getPost('slider_image'),
            'icon1_text' => $this->request->getPost('icon1_text'),
            'icon2_text' => $this->request->getPost('icon2_text'),
            'icon3_text' => $this->request->getPost('icon3_text'),
            'icon4_text' => $this->request->getPost('icon4_text'),
            'tentang_kami_text' => $this->request->getPost('tentang_kami_text'),
            'tentang_kami_image' => $this->request->getPost('tentang_kami_image'),
            'lokasi_embed_map' => $this->request->getPost('lokasi_embed_map'),
            'footer_text' => $this->request->getPost('footer_text'),
            'footer_contact_address' => $this->request->getPost('footer_contact_address'),
            'footer_contact_phone' => $this->request->getPost('footer_contact_phone'),
            'footer_contact_email' => $this->request->getPost('footer_contact_email'),
            'social_facebook' => $this->request->getPost('social_facebook'),
            'social_whatsapp' => $this->request->getPost('social_whatsapp'),
        ];

        $model->update($id, $data);

        return redirect()->to('/settings')->with('success', 'Pengaturan berhasil diperbarui');
    }

    public function detail($id)
    {
        $model = new WebsiteSettingsModel();
        $setting = $model->find($id);

        if (!$setting) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Setting tidak ditemukan');
        }

        return view('admin/settings/detail', ['setting' => $setting]);
    }
}
