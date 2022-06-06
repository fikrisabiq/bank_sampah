<?php

namespace App\Controllers;

use \App\Models\BarangModel;
use \App\Models\KategoriModel;
use \App\Models\TranksaksiModel;
use \App\Models\AdminModel;

class Tranksaksi extends BaseController
{
    protected $BarangModel;
    protected $KategoriModel;
    protected $TranksaksiModel;
    protected $AdminModel;

    public function __construct()
    {
        $this->BarangModel = new BarangModel();
        $this->KategoriModel = new KategoriModel();
        $this->TranksaksiModel = new TranksaksiModel();
        $this->AdminModel = new AdminModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Tranksaksi Masuk',
            'tranksaksi' => $this->TranksaksiModel->getTranksaksiMasuk(),
            'judul' => 'Daftar Tranksaksi Masuk'
        ];

        return view('tranksaksi/index', $data);
    }

    public function keluars()
    {
        $data = [
            'title' => 'Daftar Tranksaksi Keluar',
            'tranksaksi' => $this->TranksaksiModel->getTranksaksiKeluar(),
            'judul' => 'Daftar Tranksaksi Keluar'
        ];

        return view('tranksaksi/keluars', $data);
    }

    public function detailmasuk($id)
    {
        $data = [
            'title' => 'Detail Tranksaksi Masuk',
            'tranksaksi' => $this->TranksaksiModel->getMasuk($id),
            'judul' => 'Detail Tranksaksi Masuk'
        ];

        return view('tranksaksi/detail_masuk', $data);
    }

    public function detailkeluar($id)
    {
        $data = [
            'title' => 'Detail Tranksaksi Keluar',
            'tranksaksi' => $this->TranksaksiModel->getKeluar($id),
            'judul' => 'Detail Tranksaksi Keluar'
        ];

        return view('tranksaksi/detail_keluar', $data);
    }

    public function masuk()
    {
        $namabarang = [];
        $barang = $this->TranksaksiModel->hasilMasuk(user_id());
        for ($i = 0; $i < count($barang); $i++) {
            $namabarang[$i] = $barang[$i]['nama'];
        }
        $data = [
            'title' => 'Form Barang Masuk',
            'barang' => $this->BarangModel->getNamaBarang(),
            'kategori' => $this->KategoriModel->getKategori(),
            'hasil' => $barang,
            'validation' => \Config\Services::validation(),
            'namaBarang' => $namabarang,
            'judul' => 'Form Barang Masuk',
            'nasabah' => $this->AdminModel->getNasabah()
        ];
        return view('tranksaksi/create_masuk', $data);
    }

    public function keluar()
    {
        $namabarang = [];
        $barang = $this->TranksaksiModel->hasilKeluar(user_id());
        for ($i = 0; $i < count($barang); $i++) {
            $namabarang[$i] = $barang[$i]['nama'];
        }
        $data = [
            'title' => 'Form Barang Keluar',
            'barang' => $this->BarangModel->getNamaBarang(),
            'kategori' => $this->KategoriModel->getKategori(),
            'hasil' => $barang,
            'validation' => \Config\Services::validation(),
            'namaBarang' => $namabarang,
            'judul' => 'Form Barang Keluar'
        ];
        // dd($data['hasil']);
        return view('tranksaksi/create_keluar', $data);
    }

    public function getData()
    {
        $keyword = $this->request->getVar('keyword');
        echo json_encode($this->BarangModel->search($keyword));
    }

    public function getHargaBarang()
    {
        $nama = $this->request->getVar('nama');
        echo $this->BarangModel->getHargaBarang($nama)['harga_beli'];
    }

    public function getHargaBarangKeluar()
    {
        $nama = $this->request->getVar('nama');
        echo $this->BarangModel->getHargaBarang($nama)['harga_jual'];
    }

    public function checkMasuk($id)
    {
        $user = $id;
        $barang = $this->request->getVar('barang');
        for ($i = 0; $i < count($barang); $i++) {
            $this->TranksaksiModel->tambahMasuk($user, $barang[$i]);
        }
        return redirect()->to('/tranksaksi/masuk');
    }

    public function checkKeluar($id)
    {
        $user = $id;
        $barang = $this->request->getVar('barang');
        for ($i = 0; $i < count($barang); $i++) {
            $this->TranksaksiModel->tambahKeluar($user, $barang[$i]);
        }
        return redirect()->to('/tranksaksi/keluar');
    }

    public function tambahMasuk()
    {
        // validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/tranksaksi/masuk')->withInput();
        }

        $barang = $this->request->getVar('barang');
        $jumlah = $this->request->getVar('jumlah');
        $total = $this->request->getVar('total');
        $nama = $this->request->getVar('nama');
        $user = $this->request->getVar('user');
        if ($this->request->getVar('user')) {
            $user = $nama;
        }

        $nama = ucwords($this->request->getVar('nama'));

        $this->TranksaksiModel->tranksaksiMasuk($nama);
        for ($i = 0; $i < count($barang); $i++) {
            $this->TranksaksiModel->detail_masuk($barang[$i], $jumlah[$i], $total[$i], $user);
        }
        if (in_groups(1)) {
            return redirect()->to('/tranksaksi');
        } else {
            return redirect()->to('/tranksaksi/nasabah');
        }
    }

    public function tambahKeluar()
    {
        // validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/tranksaksi/keluar')->withInput();
        }
        // dd($this->request->getVar());
        $barang = $this->request->getVar('barang');
        $jumlah = $this->request->getVar('jumlah');
        $total = $this->request->getVar('total');
        $nama = $this->request->getVar('nama');
        $user = $this->request->getVar('user');
        $this->TranksaksiModel->tranksaksiKeluar($nama);
        for ($i = 0; $i < count($barang); $i++) {
            $this->TranksaksiModel->detail_keluar($barang[$i], $jumlah[$i], $total[$i], $user);
        }
        return redirect()->to('/tranksaksi/keluars');
    }


    public function hapusmasuk($id)
    {
        $this->TranksaksiModel->hapusmasuk($id);
        return redirect()->to('/tranksaksi/masuk');
    }

    public function hapuskeluar($id)
    {
        $this->TranksaksiModel->hapuskeluar($id);
        return redirect()->to('/tranksaksi/keluar');
    }

    public function nasabah()
    {
        $data = [
            'title' => 'Histori Tranksaksi Nasabah',
            'histori' => $this->TranksaksiModel->nasabah(user_id()),
            'judul' => 'Histori Tranksaksi Nasabah'
        ];
        return view('tranksaksi/nasabah', $data);
    }
}
