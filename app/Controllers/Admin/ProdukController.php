<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use \Myth\Auth\Models\UserModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    // Export Data
    public function export()
    {

        $data = $this->ProdukModel->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('D2', 'DAFTAR DATA PRODUK')->getColumnDimension('D')->setAutoSize(true);

        $sheet->setCellValue('A4', 'No')->getColumnDimension('A')->setAutoSize(true);
        $sheet->setCellValue('B4', 'NAMA PRODUK')->getColumnDimension('B')->setAutoSize(true);
        $sheet->setCellValue('C4', 'DESKRIPSI')->getColumnDimension('C')->setAutoSize(true);
        $sheet->setCellValue('D4', 'FOTO PRODUK')->getColumnDimension('D')->setAutoSize(true);
        $sheet->setCellValue('E4', 'TANGGAL DITAMBAHKAN')->getColumnDimension('E')->setAutoSize(true);
        $sheet->setCellValue('F4', 'TANGGAL DIUPDATE')->getColumnDimension('F')->setAutoSize(true);



        // tampil data
        $no = 1;
        $m = 5; // mulai dari bari ke 5

        foreach ($data as $data) {
            $sheet->setCellValue('A' . $m, $no++);
            $sheet->setCellValue('B' . $m, $data->nama_produk);
            $sheet->setCellValue('C' . $m, $data->deskripsi);
            $sheet->setCellValue('D' . $m, $data->foto_produk);
            $sheet->setCellValue('E' . $m, date('d-m-Y', strtotime($data->tanggal_ditambahkan)));
            $sheet->setCellValue('F' . $m, date('d-m-Y', strtotime($data->tanggal_update)));
            
            $m++;
        }

        // styling
        $style = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $baris = $m - 1;
        $sheet->getStyle('A4:F' . $baris)->applyFromArray($style);

        $writer = new Xlsx($spreadsheet);
        $fileName = ' Data Daftar Produk.xlsx'; // nama file ketika di download
        $writer->save($fileName);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Length: ' . filesize($fileName));
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        readfile($fileName); // send file
        unlink($fileName); // delete file
        exit;
    }


   
    protected $userModel;
    protected $db, $builder;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
    }

    public function index_akun()
    {
    
        $data = [
            'title' => 'Data Akun',
            'data_akun' => $this->builder->get()->getResultObject()
        ];
        return view('admin/akun/index', $data);

    }
}
