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
            'validation' => \Config\Services::validation()
        ];
        return view('admin/produk/index', $data);
    }

    public function form_tambah()
    {
        $data = [
            'title' => 'Tambah Produk',
            'validation' => \Config\Services::validation()

        ];
        return view('admin/produk/tambah', $data);
    }

    // Tambah produk
    public function tambah_produk()
    {
        $rules = $this->validate([
            'nama_produk'   => 'required',
            'deskripsi'     => 'required',
            'foto_produk'   => 'uploaded[foto_produk]|max_size[foto_produk,2048]|is_image[foto_produk]|mime_in[foto_produk,image/png,image/jpg,image/jpeg]|ext_in[foto_produk,png,jpg,jpeg]'
        ]);
        // Jikaa validate GAGAL!!!!

        if(!$rules){
            session()->setFlashdata('failed', 'Data Produk Gagal Ditambahkan!');
            return redirect()->back()->withInput();
        }
        // Ambil File
        $gambar = $this->request->getFile('foto_produk');
        // ambil Rndom Nama File
        $namaGambar = $gambar->getRandomName();
        // Pindahkan File
        $gambar->move(WRITEPATH. '../public/sb2/img/produk/', $namaGambar);

        // Jika Validate BERHASIL!!!
        $this->ProdukModel->insert([
            'nama_produk'   =>esc($this->request->getPost('nama_produk')),
            'deskripsi'     =>esc($this->request->getPost('deskripsi')),
            'foto_produk'   =>$namaGambar

        ]);
        return redirect()->to(base_url('data-produk'))->with('success','Data Produk Berhasil Ditambahkan!');
    }

    // Edit Produk
    public function update_produk($id_produk)
    {
         $rules = $this->validate([
            'nama_produk'   => 'required',
            'deskripsi'     => 'required',
            'foto_produk'   => 'max_size[foto_produk,2048]|is_image[foto_produk]|mime_in[foto_produk,image/png,image/jpg,image/jpeg]|ext_in[foto_produk,png,jpg,jpeg]'
        ]);
        // Jikaa validate GAGAL!!!!

        if(!$rules){
            session()->setFlashdata('failed', 'Data produk Gagal Diubah!');
            return redirect()->back()->withInput();
        }


        // Ambil File
        $gambar = $this->request->getFile('foto_produk');

        if ($gambar->getError() == 4) {

            $namaGambar = $this->request->getPost('foto_lama');
        }else{
            // ambil Rndom Nama File
            $namaGambar = $gambar->getRandomName();
            // Pindahkan File
            $gambar->move(WRITEPATH. '../public/sb2/img/produk/', $namaGambar);

            // Hapus Gambar Lama
            unlink(WRITEPATH. '../public/sb2/img/produk/' .  $this->request->getPost('foto_lama'));
    

        }
        // Jika Validate BERHASIL!!!
        $this->ProdukModel->update($id_produk, [
            'nama_produk'   =>esc($this->request->getPost('nama_produk')),
            'deskripsi'     =>esc($this->request->getPost('deskripsi')),
            'foto_produk'   =>$namaGambar

        ]);
        return redirect()->to(base_url('data-produk'))->with('success','Data Produk Berhasil Diubah!');
    }

// Deatil produk
    public function detail_produk($id_produk)
    {
        $data = [
            'title' => 'Detail Produk',
            'data_produk' => $this->ProdukModel->find($id_produk)
        ];
        return view('admin/produk/detail', $data);
    
    }

    // Hapus Produk
    public function delete_produk($id_produk)
    {
      $this->ProdukModel->where('id_produk', $id_produk)->delete();

      return redirect()->back()->with('success', 'Kategori Produk Berhasil Dihapus!');
    
    }
}
