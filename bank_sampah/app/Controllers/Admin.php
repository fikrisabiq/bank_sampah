<?php

namespace App\Controllers;

use \App\Models\AdminModel;
use \App\Models\TunaiModel;
use \Myth\Auth\Entities\User;
use \Myth\Auth\Authorization\GroupModel;
use \Myth\Auth\Config\Auth as AuthConfig;
use \Myth\Auth\Controllers\AuthController;

class Admin extends BaseController
{
    protected $auth;
    protected $AdminModel;
    protected $TunaiModel;
    protected $config;
    protected $groupmodel;
    public function __construct()
    {
        $this->AdminModel = new AdminModel();
        $this->TunaiModel = new TunaiModel();
        $this->config = config('Auth');
        $this->auth = service('authentication');
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Admin',
            'admin' => $this->AdminModel->getAdmin(),
            'judul' => 'Daftar Admin'
        ];
        return view('admin/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Admin',
            'validation' => \Config\Services::validation(),
            'judul' => 'Form Tambah Admin',
            'config' => $this->config
        ];
        return view('admin/create', $data);
    }

    public function save()
    {
        $users = model(UserModel::class);
        $username = $this->request->getPost('username');
        $rules = [
            'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $rules = [
            'password'     => 'required|strong_password',
            'pass_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save the user
        $allowedPostFields = array_merge(['password'], $this->config->validFields, $this->config->personalFields);
        $user = new User($this->request->getPost($allowedPostFields));

        $this->config->requireActivation === null ? $user->activate() : $user->generateActivateHash();

        if (!$users->save($user)) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }
        $this->AdminModel->save([
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username')
        ]);
        $groupModel = new GroupModel();
        $terakhir = intval($this->AdminModel->terakhir()['id']);
        $groupModel->addUserToGroup(intval($terakhir), intval(1));

        // Success!
        return redirect()->to(base_url('/admin/index'));
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Admin',
            'nasabah' => $this->AdminModel->getAdminById($id),
            'judul' => 'Edit Data Admin',
            'validation' => \Config\Services::validation(),
            'config' => $this->config
        ];
        return view('admin/edit', $data);
    }

    public function update($id)
    {
        $users = model(UserModel::class);
        $username = $this->request->getPost('username');
        $usernameLama = $this->request->getPost('usernameLama');
        $email = $this->request->getPost('email');
        $emailLama = $this->request->getPost('emailLama');
        $atm = $this->request->getVar('atm');
        $atmLama = $this->request->getVar('atmLama');
        if ($atm == $atmLama) {
            $rules_baru = 'required';
        } else {
            $rules_baru = 'required|is_unique[atm.atm]';
        }

        if (($username !== $usernameLama) && ($email !== $emailLama)) {
            $rules = [
                'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
                'email'    => 'required|valid_email|is_unique[users.email]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            if (!$users->save([
                'id' => $id,
                'username' => $username,
                'email' => $email
            ])) {
                return redirect()->back()->withInput()->with('errors', $users->errors());
            }
            $this->AdminModel->save([
                'id' => $id,
                'email' => $email,
                'username' => $username
            ]);
        } else if (($username !== $usernameLama) && ($email == $emailLama)) {
            $rules = [
                'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
                'email'    => 'valid_email',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            if (!$users->save([
                'id' => $id,
                'username' => $username
            ])) {
                return redirect()->back()->withInput()->with('errors', $users->errors());
            }
            $this->AdminModel->save([
                'id' => $id,
                'username' => $username
            ]);
        } else if (($username == $usernameLama) && ($email !== $emailLama)) {
            $rules = [
                'username' => 'alpha_numeric_space|min_length[3]|max_length[30]',
                'email'    => 'required|valid_email|is_unique[users.email]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            if (!$users->save([
                'id' => $id,
                'email' => $email
            ])) {
                return redirect()->back()->withInput()->with('errors', $users->errors());
            }
            $this->AdminModel->save([
                'id' => $id,
                'email' => $email
            ]);
        }

        // Success!
        return redirect()->to(base_url('/admin/index'));
    }

    public function reset($id)
    {
        $data = [
            'title' => 'Reset Password Admin',
            'nasabah' => $this->AdminModel->getAdminById($id),
            'judul' => 'Reset Password Admin',
            'validation' => \Config\Services::validation(),
            'config' => $this->config
        ];
        return view('admin/reset', $data);
    }

    public function res($id)
    {
        $users = model(UserModel::class);
        $rules = [
            'password'     => 'required|strong_password',
            'pass_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user = $users->where('id', $id)->first();

        $user->password         = $this->request->getPost('password');
        $user->reset_hash         = null;
        $user->reset_at         = date('Y-m-d H:i:s');
        $user->reset_expires    = null;
        $user->force_pass_reset = false;
        $users->save($user);

        // Success!
        if (in_groups(1)) {
            return redirect()->to(base_url('/admin/index'));
        } else {
            return redirect()->to('/admin/profil');
        }
    }

    public function delete($id)
    {
        $this->AdminModel->hapus($id, user_id());
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin');
    }
}
