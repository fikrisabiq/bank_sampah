<?php

namespace App\Models;

use CodeIgniter\Model;
use phpDocumentor\Reflection\PseudoTypes\False_;

class TranksaksiModel extends Model
{
    protected $table = 'tranksaksi';
    protected $useTimestamps = true;
    protected $allowedFields = ['id', 'nama', 'id_aliranbarang', 'created_at', 'updated_at'];

    public function getTranksaksiMasuk()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tranksaksi_masuk');
        $builder->join('users_hist', 'users_hist.id = tranksaksi_masuk.id_user');
        $builder->select('users_hist.username,tranksaksi_masuk.created_at,tranksaksi_masuk.id');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getTranksaksiKeluar()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tranksaksi_keluar');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getMasuk($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_masuk');
        $builder->join('barang', 'barang.id = detail_masuk.id_barang');
        $builder->join('kategori', 'barang.id_kategori = kategori.id');
        $builder->select('barang.nama as barang, kategori.nama as kategori, detail_masuk.jumlah, detail_masuk.total');
        $builder->where('id_tranksaksi', $id);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getKeluar($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_keluar');
        $builder->join('barang', 'barang.id = detail_keluar.id_barang');
        $builder->join('kategori', 'barang.id_kategori = kategori.id');
        $builder->select('barang.nama as barang, kategori.nama as kategori, detail_keluar.jumlah, detail_keluar.total');
        $builder->where('id_tranksaksi', $id);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function tambahMasuk($user, $barang)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('masuk');
        $builder->insert([
            'id_users' => $user,
            'id_barang' =>  $barang
        ]);
    }

    public function tambahKeluar($user, $barang)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('keluar');
        $builder->insert([
            'id_users' => $user,
            'id_barang' =>  $barang
        ]);
    }

    public function hasilMasuk($user)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('masuk');
        $builder->join('barang', 'barang.id = masuk.id_barang');
        $builder->join('kategori', 'kategori.id = barang.id_kategori');
        $builder->select('masuk.id as id_masuk,barang.id,barang.nama,barang.harga_beli,kategori.nama as nama_kategori');
        $builder->where('id_users', $user);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function hasilKeluar($user)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('keluar');
        $builder->join('barang', 'barang.id = keluar.id_barang');
        $builder->join('kategori', 'kategori.id = barang.id_kategori');
        $builder->select('keluar.id as id_keluar,barang.id,barang.nama,barang.harga_jual,kategori.nama as nama_kategori,barang.jumlah');
        $builder->where('id_users', $user);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getLastRowMasuk()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tranksaksi_masuk');
        $builder->selectMax('id');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function getLastRowKeluar()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tranksaksi_keluar');
        $builder->selectMax('id');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function tranksaksiMasuk($nama)
    {
        date_default_timezone_set('Asia/Bangkok');
        $now = date('Y-m-d H:i:s');
        $db      = \Config\Database::connect();
        $builder = $db->table('tranksaksi_masuk');
        $builder->insert([
            'id_user' => $nama,
            'created_at' => $now
        ]);
    }

    public function tranksaksiKeluar($nama)
    {
        date_default_timezone_set('Asia/Bangkok');
        $now = date('Y-m-d H:i:s');
        $db      = \Config\Database::connect();
        $builder = $db->table('tranksaksi_keluar');
        $builder->insert([
            'nama' => $nama,
            'created_at' => $now
        ]);
    }

    public function barangMasuk($barang, $jumlah)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('barang');
        $builder->set('jumlah', 'jumlah + ' . $jumlah, False);
        $builder->where('id', $barang);
        $builder->update();
        $builder = $db->table('barang_hist');
        $builder->set('jumlah', 'jumlah + ' . $jumlah, False);
        $builder->where('id', $barang);
        $builder->update();
    }

    public function barangKeluar($barang, $jumlah)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('barang');
        $builder->set('jumlah', 'jumlah - ' . $jumlah, False);
        $builder->where('id', $barang);
        $builder->update();
        $builder = $db->table('barang_hist');
        $builder->set('jumlah', 'jumlah - ' . $jumlah, False);
        $builder->where('id', $barang);
        $builder->update();
    }

    public function detail_masuk($barang, $jumlah, $total, $user)
    {
        $id = $this->getLastRowMasuk()['id'];
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_masuk');
        $builder->insert([
            'id_tranksaksi' => $id,
            'id_barang' => $barang,
            'jumlah' => $jumlah,
            'total' => $total
        ]);
        $this->barangMasuk($barang, $jumlah);
        $this->tunaiMasuk($user, $total);
        $db      = \Config\Database::connect();
        $builder = $db->table('masuk');
        $builder->delete(['id_users' => $user]);
    }

    public function detail_keluar($barang, $jumlah, $total, $user)
    {
        $id = $this->getLastRowKeluar()['id'];
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_keluar');
        $builder->insert([
            'id_tranksaksi' => $id,
            'id_barang' => $barang,
            'jumlah' => $jumlah,
            'total' => $total
        ]);
        $this->barangKeluar($barang, $jumlah);
        $db      = \Config\Database::connect();
        $builder = $db->table('keluar');
        $builder->delete(['id_users' => $user]);
    }

    public function hapusmasuk($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('masuk');
        $builder->delete(['id' => $id]);
    }

    public function hapuskeluar($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('keluar');
        $builder->delete(['id' => $id]);
    }

    public function countMasuk()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tranksaksi_masuk');
        $builder->selectCount('id');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function countKeluar()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tranksaksi_keluar');
        $builder->selectCount('id');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function sumMasuk()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_masuk');
        $builder->selectSum('detail_masuk.total');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function sumKeluar()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_keluar');
        $builder->selectSum('detail_keluar.total');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function jumlahMasuk()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_masuk');
        $builder->selectSum('detail_masuk.jumlah');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function jumlahKeluar()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_keluar');
        $builder->selectSum('detail_keluar.jumlah');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function tunaiMasuk($id, $total)
    {
        date_default_timezone_set('Asia/Bangkok');
        $now = date('Y-m-d H:i:s');
        $db      = \Config\Database::connect();
        $builder = $db->table('tunai');
        $builder->set('tunai', 'tunai + ' . $total, False);
        $builder->where('id_user', $id);
        $builder->update();
    }

    public function nasabah($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('detail_masuk');
        $builder->join('tranksaksi_masuk', 'tranksaksi_masuk.id = detail_masuk.id_tranksaksi');
        $builder->join('users', 'users.id = tranksaksi_masuk.id_user');
        $builder->join('barang', 'barang.id = detail_masuk.id_barang');
        $builder->join('kategori', 'barang.id_kategori = kategori.id');
        $builder->select('barang.nama as barang, kategori.nama as kategori, detail_masuk.jumlah, detail_masuk.total,barang.harga_beli as harga,tranksaksi_masuk.created_at');
        $builder->where('users.id', $id);
        $query = $builder->get();
        return $query->getResultArray();
    }
}
