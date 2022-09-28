<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ProdukController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Data produk',
            'data_produk' => $this->ProdukModel->findAll(),
        ];
        return view('admin/produk/index', $data);
    }

    public function form_tambah()
    {
        $data = [
            'title' => 'Tambah Produk',

        ];
        return view('admin/produk/tambah', $data);
    }
}
