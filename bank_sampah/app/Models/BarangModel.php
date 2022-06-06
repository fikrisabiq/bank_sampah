<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $useTimestamps = true;
    protected $allowedFields = ['id', 'nama', 'id_kategori', 'jumlah', 'harga_jual', 'harga_beli'];

    public function getBarang($nama = false)
    {
        if ($nama == false) {
            $builder = $this->db->table('barang');
            $builder->select('barang.id,kategori.id as id_kategori,barang.nama,kategori.nama as nama_kategori,barang.jumlah,barang.harga_jual,barang.harga_beli,barang.created_at,barang.updated_at');
            $builder->join('kategori', 'kategori.id = barang.id_kategori');
            $query = $builder->get();
            return $query->getResultArray();
        }

        $builder = $this->db->table('barang');
        $builder->select('barang.id,kategori.id as id_kategori,barang.nama,kategori.nama as nama_kategori,barang.jumlah,barang.harga_jual,barang.harga_beli,barang.created_at,barang.updated_at');
        $builder->join('kategori', 'kategori.id = barang.id_kategori');
        $query = $builder->getWhere(['barang.nama' => $nama]);
        return $query->getFirstRow('array');
    }

    public function tambah($nama, $kategori, $harga_jual, $harga_beli)
    {
        date_default_timezone_set('Asia/Bangkok');
        $now = date('Y-m-d H:i:s');
        $db      = \Config\Database::connect();
        $builder = $db->table('barang');
        $builder->insert([
            'nama' => $nama,
            'id_kategori' => $kategori,
            'jumlah' => 0,
            'harga_jual' => $harga_jual,
            'harga_beli' => $harga_beli,
            'updated_at' => $now,
            'created_at' => $now
        ]);
        $db      = \Config\Database::connect();
        $builder = $db->table('barang_hist');
        $builder->insert([
            'nama' => $nama,
            'id_kategori' => $kategori,
            'jumlah' => 0,
            'harga_jual' => $harga_jual,
            'harga_beli' => $harga_beli,
            'updated_at' => $now,
            'created_at' => $now
        ]);
    }

    public function ubah($nama, $kategori, $harga_jual, $harga_beli, $id)
    {
        date_default_timezone_set('Asia/Bangkok');
        $now = date('Y-m-d H:i:s');
        $db      = \Config\Database::connect();
        $builder = $db->table('barang');
        $db      = \Config\Database::connect();
        $builder = $db->table('barang');
        $builder->where('id', $id);
        $builder->update([
            'nama' => $nama,
            'id_kategori' => $kategori,
            'harga_jual' => $harga_jual,
            'harga_beli' => $harga_beli,
            'updated_at' => $now
        ]);
        $db      = \Config\Database::connect();
        $builder = $db->table('barang_hist');
        $builder->where('id', $id);
        $builder->update([
            'nama' => $nama,
            'id_kategori' => $kategori,
            'harga_jual' => $harga_jual,
            'harga_beli' => $harga_beli,
            'updated_at' => $now
        ]);
    }

    public function checkKategori($id)
    {
        $builder = $this->db->table('barang');
        $builder->set('id_kategori', 1, false);
        $builder->where('id_kategori', $id);
        $builder->update();
    }

    public function pendek()
    {
        $builder = $this->table('barang');
        $builder->select('barang.id,kategori.id as id_kategori,barang.nama,kategori.nama as nama_kategori,barang.jumlah,barang.harga_jual,barang.harga_beli,barang.created_at,barang.updated_at');
        $builder->join('kategori', 'kategori.id = barang.id_kategori');
        return $builder;
    }

    public function pendekSekali()
    {
        $builder = $this->table('barang');
        $builder->select('barang.id,kategori.id as id_kategori,barang.nama,kategori.nama as nama_kategori,barang.jumlah,barang.harga_jual,barang.harga_beli,barang.created_at,barang.updated_at');
        $builder->join('kategori', 'kategori.id = barang.id_kategori');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function sedikit()
    {
        $builder = $this->table('barang');
        $builder->select('barang.id,kategori.id as id_kategori,barang.nama,kategori.nama as nama_kategori,barang.jumlah,barang.harga_jual,barang.harga_beli');
        $builder->join('kategori', 'kategori.id = barang.id_kategori');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function cukup()
    {
        $builder = $this->table('barang');
        $builder->select('barang.id,kategori.id as id_kategori,barang.nama,kategori.nama as nama_kategori,barang.jumlah,barang.harga_jual,barang.harga_beli');
        $builder->join('kategori', 'kategori.id = barang.id_kategori');
        return $builder;
    }

    public function cukupSedikit($nama)
    {
        $builder = $this->db->table('barang');
        $builder->select('barang.id,kategori.id as id_kategori,barang.nama,kategori.nama as nama_kategori,barang.jumlah,barang.harga_jual,barang.harga_beli');
        $builder->join('kategori', 'kategori.id = barang.id_kategori');
        $query = $builder->getWhere(['barang.nama' => $nama]);
        return $query->getFirstRow('array');
    }

    public function search($keyword)
    {
        $builder = $this->cukup();
        $builder->like('barang.nama', $keyword);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getNamaBarang()
    {
        $builder = $this->table('barang');
        $builder->select('id,nama,jumlah');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getHargaBarang($nama)
    {
        $builder = $this->table('barang');
        $builder->select('harga_beli,harga_jual');
        $builder->where('nama', $nama);
        $query = $builder->getWhere(['nama' => $nama]);
        return $query->getFirstRow('array');
    }

    public function countBarang()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('barang');
        $builder->selectCount('id');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function total()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('barang');
        $builder->selectSum('jumlah');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }
}
