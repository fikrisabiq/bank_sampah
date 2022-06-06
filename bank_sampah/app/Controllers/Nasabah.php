<?php

namespace App\Controllers;

use \App\Models\AdminModel;
use \App\Models\TunaiModel;
use \Myth\Auth\Entities\User;
use \Myth\Auth\Authorization\GroupModel;
use \Myth\Auth\Config\Auth as AuthConfig;
use \Myth\Auth\Controllers\AuthController;

class Nasabah extends BaseController
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
            'title' => 'Daftar Nasabah',
            'nasabah' => $this->AdminModel->getNasabah(),
            'judul' => 'Daftar Nasabah'
        ];
        return view('nasabah/index', $data);
    }

    public function profil()
    {
        $id = user_id();
        $data = [
            'title' => 'Profil Nasabah',
            'nasabah' => $this->AdminModel->getNasabahById($id),
            'tunai' => $this->TunaiModel->getTunai(user_id()),
            'judul' => 'Profil Nasabah',
            'config' => $this->config
        ];
        return view('nasabah/profil', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Nasabah',
            'validation' => \Config\Services::validation(),
            'judul' => 'Form Tambah Nasabah',
            'config' => $this->config
        ];
        return view('nasabah/create', $data);
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

        if (!$this->validate([
            'atm' => [
                'rules' => 'required|is_unique[atm.atm]',
                'errors' => [
                    'required' => 'No rekening harus diisi',
                    'is_unique' => 'No Rekening sudah terdaftar'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            return redirect()->to('/nasabah/create')->withInput();
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
        $groupModel->addUserToGroup(intval($terakhir), intval(2));
        $this->TunaiModel->addAcc($terakhir);
        $this->AdminModel->atm($terakhir, $this->request->getPost('atm'));

        // Success!
        if (in_groups(1)) {
            return redirect()->to(base_url('/nasabah/index'));
        } else {
            return redirect()->to('/nasabah/index' . user_id());
        }
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Nasabah',
            'nasabah' => $this->AdminModel->getNasabahById($id),
            'judul' => 'Edit Data Nasabah',
            'validation' => \Config\Services::validation(),
            'config' => $this->config
        ];
        return view('nasabah/edit', $data);
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
            if (!$this->validate([
                'atm' => [
                    'rules' => $rules_baru,
                    'errors' => [
                        'required' => 'No rekening harus diisi',
                        'is_unique' => 'No Rekening sudah terdaftar'
                    ]
                ]
            ])) {
                $validation = \Config\Services::validation();

                return redirect()->to('/nasabah/edit/' . user_id())->withInput();
            }
            $this->TunaiModel->where('id_user', $id)->set('atm', $atm)->update();
        } else {
            $rules_baru = 'required|is_unique[atm.atm]';
            if (!$this->validate([
                'atm' => [
                    'rules' => $rules_baru,
                    'errors' => [
                        'required' => 'No rekening harus diisi',
                        'is_unique' => 'No Rekening sudah terdaftar'
                    ]
                ]
            ])) {
                $validation = \Config\Services::validation();

                return redirect()->to('/nasabah/edit/' . user_id())->withInput();
            }
            $this->TunaiModel->where('id_user', $id)->set('atm', $atm)->update();
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
        if (in_groups(1)) {
            return redirect()->to(base_url('/nasabah/index'));
        } else {
            return redirect()->to('/nasabah/profil/');
        }
    }

    public function reset($id)
    {
        $data = [
            'title' => 'Reset Password Nasabah',
            'nasabah' => $this->AdminModel->getAdminById($id),
            'judul' => 'Reset Password Nasabah',
            'validation' => \Config\Services::validation(),
            'config' => $this->config
        ];
        return view('nasabah/reset', $data);
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
            return redirect()->to(base_url('/nasabah/index'));
        } else {
            return redirect()->to('/nasabah/profil');
        }
    }

    public function delete($id)
    {
        $this->AdminModel->hapusNasabah($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin');
    }

    public function tarik()
    {
        $data = [
            'title' => 'Form Tarik Tunai',
            'validation' => \Config\Services::validation(),
            'judul' => 'Form Tarik Tunai'
        ];
        return view('nasabah/tarik', $data);
    }

    public function tunai($id)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|checktunai',
                'errors' => [
                    'required' => 'No Rekening harus diisi',
                    'checktunai' => 'tunai tidak boleh melebihi yang dimiliki'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            return redirect()->to('/nasabah/tarik')->withInput();
        }
        $this->TunaiModel->tarik($id, $this->request->getPost('nama'));
        return redirect()->to('/nasabah/profil');
    }

    public function histori()
    {
        $data = [
            'title' => 'Histori Tranksaksi Nasabah',
            'histori' => $this->TunaiModel->histById(user_id()),
            'judul' => 'Histori Tranksaksi Nasabah'
        ];
        return view('nasabah/histori', $data);
    }

    public function hist()
    {
        $data = [
            'title' => 'Histori Tranksaksi Nasabah',
            'histori' => $this->TunaiModel->hist(),
            'judul' => 'Histori Tranksaksi Nasabah'
        ];

        return view('nasabah/hist', $data);
    }
}
