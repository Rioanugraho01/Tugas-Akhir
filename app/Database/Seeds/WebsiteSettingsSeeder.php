<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class WebsiteSettingsSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('website_settings')->insert([
            'email_header'           => 'imacatering@gmail.com',
            'phone_header'           => '+62 823-3740-6335',
            'address_header'         => 'Banyuwangi, Jawa Timur',
            'logo_navbar'            => 'catering-logo.png',
            'slider_image'           => 'beranda.jpeg',
            'icon1_text'             => 'Catering dengan bahan segar',
            'icon2_text'             => 'Pelayanan profesional',
            'icon3_text'             => 'Harga terjangkau',
            'icon4_text'             => 'Pengiriman cepat',
            'tentang_kami_text'      => 'Ima Catering merupakan suatu usaha rumahan makanan, minuman dan kue rumahan yang sudah dijalankan oleh Ibu Ima sejak tahun 2015 hingga sekarang yang bertempat di Kecamatan Giri Kabupaten Banyuwangi. Ima Catering telah menawarkan beragam macam produk seperti Nasi Tumpeng, Nasi Kotak, Es Campur, Kue Kering dan Kue Basah. Seiring berjalan nya waktu, Ima Catering telah melayani berbagai acara, seperti pernikahan, khitanan, perayaan ulang tahun, hingga acara kantor di perusahaan japfa.',
            'tentang_kami_image'     => 'slider-1.png',
            'lokasi_embed_map'       => '<iframe
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.6435268685854!2d114.32624967495704!3d-8.164564582261398!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd15a9963f9a4b7%3A0xaeb2f0e57e8e7e5b!2sGiri%2C%20Banyuwangi%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1709399876543"
                                            width="100%"
                                            height="400"
                                            style="border:0;"
                                            allowfullscreen=""
                                            loading="lazy"
                                            referrerpolicy="no-referrer-when-downgrade">
                                        </iframe>',
            'footer_text'            => 'Menyediakan makanan berkualitas dengan layanan terbaik untuk berbagai acara.',
            'footer_contact_address' => 'Banyuwangi, Jawa Timur',
            'footer_contact_phone'   => '+62 823-3740-6335',
            'footer_contact_email'   => 'imacatering@gmail.com',
            'social_facebook'        => 'https://www.facebook.com/siti.naimah.311493',
            'social_whatsapp'        => '6282337406335',
        ]);
    }
}
