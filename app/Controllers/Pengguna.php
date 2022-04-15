<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\CatatanModel;
use App\Models\UserModel;

class Pengguna extends BaseController
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
            'dataUser' => $this->UserModel->semua(),
            'admin' => $this->AdminModel->find(session('id'))
        ];
        return view('admin/dataPengguna', $data);
    }

    public function detailCatatan($id)
    {
        $data = [
            'judul' => "Detail Catatan | Admin",
            'admin' => $this->AdminModel->find(session('id')),
            'user' => $this->UserModel->find($id),
            'catatan' => $this->CatatanModel->db->table('catatan')->join('users', 'catatan.id_user=users.id')->getWhere(['catatan.id_user' => $id])->getResultArray()

        ];
        // dd($data['catatan']);

        return view('admin/detailCatatan', $data);
    }
}
