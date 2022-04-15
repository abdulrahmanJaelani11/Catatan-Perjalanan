<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\CatatanModel;
use App\Models\UserModel;

class HomeAdmin extends BaseController
{
    protected $CatatanModel;
    protected $UserModel;
    protected $AdminModel;
    protected $jumlahCatatan;
    protected $catatanSaya;
    public function __construct()
    {
        $this->CatatanModel = new CatatanModel();
        $this->UserModel = new UserModel();
        $this->AdminModel = new AdminModel();
    }
    public function index()
    {
        $data = [
            'judul' => 'Beranda | Admin',
            'jumlahCatatan' => count($this->CatatanModel->findAll()),
            'catatanSaya' => count($this->CatatanModel->catatanSaya(session('id'))),
            'jumlahUsers' => count($this->UserModel->semua()),
            'dataUser' => $this->UserModel->find(session('id')),
            'admin' => $this->AdminModel->find(session('id'))
        ];
        return view('admin/beranda', $data);
    }
}
