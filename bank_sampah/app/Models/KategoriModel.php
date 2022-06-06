<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori';
    protected $allowedFields = ['id', 'nama'];

    public function getKategori()
    {
        $builder = $this->db->table('kategori');
        $builder->orderBy('id', 'DESC');
        $query = $builder->get();
        // $query = $this->db->query("SELECT * FROM kategori ORDER BY id DESC");
        return $query->getResultArray();
    }

    public function getKategoriByNama($nama)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori');
        $builder->where('nama', $nama);
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function search($keyword)
    {
        $builder = $this->db->table('kategori');
        $builder->like('nama', $keyword);
        return $builder;
    }

    public function countKategori()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kategori');
        $builder->selectCount('id');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }
}
