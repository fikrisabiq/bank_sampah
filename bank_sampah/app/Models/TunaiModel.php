<?php

namespace App\Models;

use CodeIgniter\Model;
use phpDocumentor\Reflection\PseudoTypes\False_;

class TunaiModel extends Model
{
    protected $table = 'atm';
    protected $allowedFields = ['id', 'id_user', 'atm'];

    public function addAcc($id)
    {
        date_default_timezone_set('Asia/Bangkok');
        $now = date('Y-m-d H:i:s');
        $db      = \Config\Database::connect();
        $builder = $db->table('tunai');
        $builder->insert([
            'id_user' => $id,
            'tunai' => 0,
            'updated_at' => $now
        ]);
    }

    public function getTunai($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tunai');
        $builder->where('id_user', $id);
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function tarik($id, $total)
    {
        date_default_timezone_set('Asia/Bangkok');
        $now = date('Y-m-d H:i:s');
        $db      = \Config\Database::connect();
        $builder = $db->table('tunai');
        $builder->set('tunai', 'tunai -' . $total, false);
        $builder->where('id_user', $id);
        $builder->update();
        $db      = \Config\Database::connect();
        $builder = $db->table('tunai_hist');
        $builder->insert([
            'id_user' => $id,
            'total' => $total,
            'created_at' => $now
        ]);
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

    public function hist()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tunai_hist');
        $builder->join('users_hist', 'users_hist.id = tunai_hist.id_user');
        $builder->select('users_hist.username,total,created_at');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function histById($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tunai_hist');
        $builder->select('total,created_at');
        $builder->where('id_user', $id);
        $query = $builder->get();
        return $query->getResultArray();
    }
}
