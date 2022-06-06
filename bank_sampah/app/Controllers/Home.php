<?php

namespace App\Controllers;

use \App\Models\BarangModel;
use \App\Models\KategoriModel;
use \App\Models\TranksaksiModel;
use \App\Models\AdminModel;

class Home extends BaseController
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
            'title' => "Halaman Utama",
            'judul' => "Dashboard",
            'jenis_barang' => $this->BarangModel->countBarang()['id'],
            'total_barang' => $this->BarangModel->total()['jumlah'],
            'kategori' => $this->KategoriModel->countKategori()['id'],
            'admin' => $this->AdminModel->countAdmin()['id'],
            'masuk' => $this->TranksaksiModel->countMasuk()['id'],
            'keluar' => $this->TranksaksiModel->countKeluar()['id'],
            'tranksaksi' => $this->TranksaksiModel->countMasuk()['id'] + $this->TranksaksiModel->countKeluar()['id'],
            'masuk_sum' => $this->TranksaksiModel->sumMasuk()['total'],
            'keluar_sum' => $this->TranksaksiModel->sumKeluar()['total'],
            'tranksaksi_sum' => $this->TranksaksiModel->sumMasuk()['total'] + $this->TranksaksiModel->sumKeluar()['total'],
            'masuk_jumlah' => $this->TranksaksiModel->jumlahMasuk()['jumlah'],
            'keluar_jumlah' => $this->TranksaksiModel->jumlahKeluar()['jumlah'],
            'tranksaksi_jumlah' => $this->TranksaksiModel->jumlahMasuk()['jumlah'] + $this->TranksaksiModel->jumlahKeluar()['jumlah']
        ];
        return view('home/index', $data);
    }
}
