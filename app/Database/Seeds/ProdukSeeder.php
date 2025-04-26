<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        $produkData = [
            
            [
                'nama' => 'Nasi Tumpeng',
                'deskripsi' => 'Nasi tumpeng tradisional',
                'kategori' => 'regular',
                'gambar' => 'nasi_tumpeng.jpeg',
            ],
            [
                'nama' => 'Nasi Kotak',
                'deskripsi' => 'Nasi kotak dengan berbagai pilihan lauk',
                'kategori' => 'regular',
                'gambar' => 'nasi_kotak.jpeg',
            ],
            [
                'nama' => 'Es Campur',
                'deskripsi' => 'Minuman segar es campur',
                'kategori' => 'regular',
                'gambar' => 'es_campur.jpeg',
            ],
            [
                'nama' => 'Kue Kering',
                'deskripsi' => 'Aneka kue kering untuk lebaran dan acara lainnya',
                'kategori' => 'regular',
                'gambar' => 'kue_kering.png',
            ],
            [
                'nama' => 'Kue Basah',
                'deskripsi' => 'Aneka kue basah tradisional',
                'kategori' => 'regular',
                'gambar' => 'kue_basah.jpeg',
            ],
            
            ['nama' => 'Gado Gado', 'deskripsi' => 'Gado Gado untuk 100 porsi', 'kategori' => 'khusus', 'gambar' => 'gado_gado.jpeg'],
            ['nama' => 'Bakso', 'deskripsi' => 'Bakso untuk 100 porsi', 'kategori' => 'khusus', 'gambar' => 'bakso.jpeg'],
            ['nama' => 'Sate Gulai', 'deskripsi' => 'Sate Gulai untuk 100 porsi', 'kategori' => 'khusus', 'gambar' => 'sate_gulai.jpeg'],
            ['nama' => 'Es Buah', 'deskripsi' => 'Es buah dalam porsi besar', 'kategori' => 'khusus', 'gambar' => 'es_buah.jpeg'],
            ['nama' => 'Aneka Bubur', 'deskripsi' => 'Aneka bubur untuk 100 orang', 'kategori' => 'khusus', 'gambar' => 'aneka_bubur.jpeg'],
            ['nama' => 'Nasi Sop', 'deskripsi' => 'Nasi sop untuk 100 porsi', 'kategori' => 'khusus', 'gambar' => 'nasi_sop.jpeg'],
            ['nama' => 'Soto Ayam', 'deskripsi' => 'Soto ayam untuk 100 porsi', 'kategori' => 'khusus', 'gambar' => 'soto_ayam.jpeg'],
            ['nama' => 'Nasi Goreng', 'deskripsi' => 'Nasi goreng untuk 100 porsi', 'kategori' => 'khusus', 'gambar' => 'nasi_goreng.jpeg'],
        ];

        $produkModel = model('App\Models\ProdukModel');

        foreach ($produkData as $produk) {
            $produkModel->insert($produk);
        }

        $produkList = $produkModel->where('kategori', 'regular')->findAll();

        $macamData = [
            'Nasi Tumpeng' => [
                ['nama' => 'Nasi Tumpeng Kuning', 'harga' => 650000, 'deskripsi' => 'Nasi tumpeng berwarna kuning, cocok untuk acara syukuran.'],
                ['nama' => 'Nasi Tumpeng Putih', 'harga' => 600000, 'deskripsi' => 'Nasi tumpeng putih yang sederhana dan lezat.'],
            ],
            'Nasi Kotak' => [
                ['nama' => 'Nasi Ayam Bakar', 'harga' => 25000, 'deskripsi' => 'Nasi kotak dengan lauk ayam bakar dan sambal.'],
                ['nama' => 'Nasi Urap', 'harga' => 20000, 'deskripsi' => 'Nasi dengan sayuran urap khas Jawa.'],
                ['nama' => 'Nasi Campur', 'harga' => 25000, 'deskripsi' => 'Nasi campur dengan berbagai lauk lengkap.'],
            ],
            'Es Campur' => [
                ['nama' => 'Es Buah', 'harga' => 7000, 'deskripsi' => 'Minuman es berisi buah-buahan segar.'],
            ],
            'Kue Kering' => [
                ['nama' => 'Nastar', 'harga' => 150000, 'deskripsi' => 'Kue kering isi selai nanas.'],
                ['nama' => 'Kastengel', 'harga' => 180000, 'deskripsi' => 'Kue kering keju khas lebaran.'],
                ['nama' => 'Semprit', 'harga' => 100000, 'deskripsi' => 'Kue semprit dengan bentuk bunga.'],
                ['nama' => 'Kue_Sagu', 'harga' => 100000, 'deskripsi' => 'Kue kering dari sagu, lembut dan renyah.'],
                ['nama' => 'Lidah_Kucing', 'harga' => 150000, 'deskripsi' => 'Kue tipis dan renyah berbentuk seperti lidah kucing.'],
                ['nama' => 'Kue_Coklat', 'harga' => 150000, 'deskripsi' => 'Kue coklat lezat favorit anak-anak.'],
            ],
            'Kue Basah' => [
                ['nama' => 'Lemper', 'harga' => 3000, 'deskripsi' => 'Lemper isi ayam, dibungkus daun pisang.'],
                ['nama' => 'Bikang', 'harga' => 3000, 'deskripsi' => 'Kue bikang warna-warni, kenyal dan manis.'],
                ['nama' => 'Apem', 'harga' => 3000, 'deskripsi' => 'Kue apem manis tradisional.'],
                ['nama' => 'Risol', 'harga' => 3000, 'deskripsi' => 'Gorengan isi sayur atau daging cincang.'],
                ['nama' => 'Donat', 'harga' => 3000, 'deskripsi' => 'Donat mini dengan topping manis.'],
                ['nama' => 'Sumping', 'harga' => 3000, 'deskripsi' => 'Kue sumping dari tepung beras dan santan.'],
            ]
        ];

        $macamModel = model('App\Models\MacamProdukModel');

        foreach ($produkList as $produk) {
            $macams = $macamData[$produk['nama']] ?? [];
            foreach ($macams as $macam) {
                $macamModel->insert([
                    'produk_id' => $produk['id'],
                    'nama' => $macam['nama'],
                    'harga' => $macam['harga'],
                    'deskripsi' => $macam['deskripsi'],
                    'gambar' => strtolower(str_replace(' ', '_', $macam['nama'])) . '.jpeg'
                ]);
            }
        }
    }
}