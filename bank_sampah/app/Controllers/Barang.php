<?php

namespace App\Controllers;

use \App\Models\BarangModel;
use \App\Models\KategoriModel;

class Barang extends BaseController
{
    protected $BarangModel;
    protected $KategoriModel;
    public function __construct()
    {
        $this->BarangModel = new BarangModel();
        $this->KategoriModel = new KategoriModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Barang',
            'barang' => $this->BarangModel->pendekSekali(),
            'judul' => 'Daftar Barang'
        ];
        // dd($data['barang']);
        return view('barang/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Barang',
            'kategori' => $this->KategoriModel->getKategori(),
            'validation' => \Config\Services::validation(),
            'judul' => 'Form Tambah Barang'
        ];
        return view('barang/create', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[barang.nama]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'harga_jual' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harga jual harus diisi'
                ]
            ],
            'harga_beli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harga beli harus diisi'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();

            return redirect()->to('/barang/create')->withInput();
        }
        $nama = ucwords($this->request->getVar('nama'));
        $kategori = $this->request->getVar('kategori');
        $harga_jual = $this->request->getVar('harga_jual');
        $harga_beli = $this->request->getVar('harga_beli');
        $this->BarangModel->tambah($nama, $kategori, $harga_jual, $harga_beli);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/barang');
    }

    public function delete($id)
    {
        $this->BarangModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/barang');
    }

    public function edit($nama)
    {
        $barang = $this->BarangModel->getBarang($nama);
        $data = [
            'title' => 'Form Edit Data Barang',
            'validation' => \Config\Services::validation(),
            'barang' => $barang,
            'kategori' => $this->KategoriModel->getKategori(),
            'judul' => 'Form Edit Data Barang'
        ];
        return view('barang/edit', $data);
    }

    public function update($id)
    {
        $nama = ucwords($this->request->getVar('nama'));
        $barangLama = $this->BarangModel->getBarang($this->request->getVar('namaLama'));
        if ($barangLama['nama'] == $nama) {
            $rules_nama = 'required';
        } else {
            $rules_nama = 'required|is_unique[barang.nama]';
        }
        if (!$this->validate([
            'nama' => [
                'rules' => $rules_nama,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'harga_jual' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harga jual harus diisi'
                ]
            ],
            'harga_beli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'harga beli harus diisi'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();

            return redirect()->to('/barang/edit/' . $this->request->getVar('namaLama'))->withInput();
        }
        $kategori = $this->request->getVar('kategori');
        $harga_jual = $this->request->getVar('harga_jual');
        $harga_beli = $this->request->getVar('harga_beli');
        $this->BarangModel->ubah($nama, $kategori, $harga_jual, $harga_beli, $id);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/barang');
    }
}
