<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'users_hist';
    protected $allowedFields = ['id', 'email', 'username'];

    public function getAdmin()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->select('users.id,users.username,users.email');
        $builder->where('auth_groups_users.group_id', 1);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getAdminById($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('id', $id);
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function terakhir()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->selectMax('id');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }


    public function ubah($id, $username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->update(['username' => $username]);
        $builder->where('id', $id);
    }

    public function hapus($id, $user)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('masuk');
        $builder->delete(['id' => $id]);
        $db      = \Config\Database::connect();
        $builder = $db->table('keluar');
        $builder->delete(['id' => $id]);
        $builder = $db->table('users');
        $builder->delete(['id' => $id]);
    }

    public function hapusNasabah($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('masuk');
        $builder->delete(['id' => $id]);
        $db      = \Config\Database::connect();
        $builder = $db->table('keluar');
        $builder->delete(['id' => $id]);
        $builder = $db->table('tunai');
        $builder->delete(['id_user' => $id]);
        $builder = $db->table('atm');
        $builder->delete(['id_user' => $id]);
        $builder = $db->table('users');
        $builder->delete(['id' => $id]);
    }

    public function countAdmin()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->selectCount('id');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function getNasabah()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->join('atm', 'atm.id_user = users.id');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->select('users.id,users.username,users.email,atm.atm');
        $builder->where('auth_groups_users.group_id', 2);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getNasabahById($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->join('atm', 'atm.id_user = users.id');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->select('users.id,users.username,users.email,atm.atm');
        $builder->where('users.id', $id);
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function atm($id, $atm)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('atm');
        $builder->insert([
            'id_user' => $id,
            'atm' => $atm
        ]);
    }

    public function ubahRekening($id, $atm)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('atm');
        $builder->set('atm', $atm);
        $builder->where('id_user', $id);
        $builder->update();
    }

    public function id_tunai($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tunai');
        $builder->join('users', 'users.id = tunai.id_user');
        $builder->where('id_user', $id);
        $builder->select('tunai.id');
        $query = $builder->get();
        return $query->getFirstRow('array');
    }
}
