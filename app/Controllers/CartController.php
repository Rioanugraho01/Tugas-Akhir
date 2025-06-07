<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CartController extends BaseController
{
    public function add()
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User not logged in']);
        }
    
        $cart = session()->get('cart_' . $user_id) ?? [];
    
        $item = $this->request->getPost(['id', 'nama', 'harga', 'jumlah']);
        $item['harga'] = (int)$item['harga'];
        $item['jumlah'] = (int)$item['jumlah'];
    
        $found = false;
    
        foreach ($cart as &$existing) {
            if ($existing['id'] == $item['id']) {
                $existing['jumlah'] += $item['jumlah'];
                $found = true;
                break;
            }
        }
    
        if (!$found) {
            $cart[] = $item;
        }
    
        session()->set('cart_' . $user_id, $cart);
    
        return $this->response->setJSON([
            'status' => $found ? 'updated' : 'added',
            'cart' => $cart
        ]);
    }
    
    public function remove($id)
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User not logged in']);
        }
    
        $cart = session()->get('cart_' . $user_id) ?? [];
    
        $cart = array_filter($cart, fn($item) => $item['id'] != $id);
        session()->set('cart_' . $user_id, array_values($cart));
    
        return $this->response->setJSON(['status' => 'removed']);
    }
    
    public function getCart()
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User not logged in']);
        }
    
        return $this->response->setJSON(session()->get('cart_' . $user_id) ?? []);
    }    
}
