<?php

namespace App\Controllers;

use App\Models\CatatanModel;
use App\Models\UserModel;

class Home extends BaseController
{
	protected $CatatanModel;
	protected $UserModel;
	protected $jumlahCatatan;
	protected $catatanSaya;
	public function __construct()
	{
		$this->CatatanModel = new CatatanModel();
		$this->UserModel = new UserModel();
	}
	public function index()
	{

		$this->jumlahCatatan = count($this->CatatanModel->findAll());
		$this->catatanSaya = count($this->CatatanModel->catatanSaya(session('id')));
		if ($this->catatanSaya > 0) {
			$persentase = floor(($this->catatanSaya * 100) / $this->jumlahCatatan);
		} else {
			$persentase = 0;
		}

		$data = [
			'judul' => 'Beranda',
			'jumlahCatatan' => count($this->CatatanModel->findAll()),
			'catatanSaya' => count($this->CatatanModel->catatanSaya(session('id'))),
			'jumlahUsers' => count($this->UserModel->semua()),
			'dataUser' => $this->UserModel->find(session('id')),
			'persentase' => $persentase
		];
		return view('beranda', $data);
	}
}
