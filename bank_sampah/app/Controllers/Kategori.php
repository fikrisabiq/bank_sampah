<?php

namespace App\Controllers;

use \App\Models\KategoriModel;
use \App\Models\BarangModel;

class Kategori extends BaseController
{
    protected $KategoriModel;
    public function __construct()
    {
        $this->KategoriModel = new KategoriModel();
        $this->BarangModel = new BarangModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Kategori',
            'kategori' => $this->KategoriModel->getKategori(),
            'pager' => $this->KategoriModel->pager,
            'judul' => 'Daftar Kateogri'
        ];
        return view('kategori/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Kategori',
            'validation' => \Config\Services::validation(),
            'judul' => 'Form Tambah Kateogri'
        ];
        return view('kategori/create', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[kategori.nama]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            return redirect()->to('/kategori/create')->withInput();
        }
        $nama = ucwords($this->request->getVar('nama'));
        $this->KategoriModel->save([
            'nama' => $nama
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/kategori');
    }

    public function delete($id)
    {
        $this->BarangModel->checkKategori($id);
        $this->KategoriModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/kategori');
    }

    public function edit($nama)
    {
        $data = [
            'title' => 'Form Edit Data Kategori',
            'validation' => \Config\Services::validation(),
            'kategori' => $this->KategoriModel->getKategoriByNama($nama),
            'judul' => 'Form Edit Data Kategori'
        ];
        return view('kategori/edit', $data);
    }

    public function update($id)
    {
        $nama = ucwords($this->request->getVar('nama'));
        $kategoriLama = $this->request->getVar('namaLama');
        if ($kategoriLama == $nama) {
            $rules_nama = 'required';
        } else {
            $rules_nama = 'required|is_unique[kategori.nama]';
        }
        if (!$this->validate([
            'nama' => [
                'rules' => $rules_nama,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            return redirect()->to('/kategori/edit/' . $this->request->getVar('nama'))->withInput();
        }

        $this->KategoriModel->save([
            'id' => $id,
            'nama' => $nama
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/kategori');
    }
}
