<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\UserModel;

class AuthAdmin extends BaseController
{
    protected $UserModel;
    protected $AdminModel;
    protected $validasi;
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->AdminModel = new AdminModel();
        $this->validasi = \Config\Services::validation();
    }


    public function index()
    {
        $data = [
            'judul' => "Login | Admin"
        ];
        return view("admin/login", $data);
    }

    public function prosesLogin()
    {
        $data = $this->request->getVar();
        $admin = $this->AdminModel->semua($data['email']);

        if (count($admin) > 0) {
            if ($data['password'] == $admin[0]['password']) {
                session()->set([
                    'email' => $admin[0]['email'],
                    'id' => $admin[0]['id'],
                    'nama' => $admin[0]['nama'],
                    'img' => $admin[0]['img']
                ]);
                echo "ok";
            } else {
                echo "PassSalah";
            }
        } else {
            echo "undifined";
        }
    }

    public function logout()
    {
        session()->remove('id');
        session()->remove('nama');
        session()->remove('email');

        return redirect()->to(base_url('Auth/welcome'));
    }
}
