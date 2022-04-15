<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\CodeIgniter;

class Profil extends BaseController
{
    protected $UserModel;
    protected $validasi;
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->validasi = \Config\Services::validation();
    }
    public function index()
    {
        $data = [
            'judul' => 'My Profil',
            'data' => $this->UserModel->find(session('id')),
            'validasi' => \Config\Services::validation()
        ];

        // dd($data['data']);

        return view('profil', $data);
    }

    public function ubahInfo()
    {
        $data = $this->request->getVar();

        $user = $this->UserModel->find($data['id']);


        if (!$this->validate([
            "nik" => [
                'rules' => 'required|max_length[16]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'max_length' => '{field} tidak boleh lebih dari 16'
                ]
            ],
            "telepon" => [
                'rules' => "required|max_length[12]",
                "errors" => [
                    'required' => "{field} tidak boleh kosong",
                    'max_length' => "{field} yang anda masukan sepertinya salah"
                ]
            ]
        ])) {
            $pesan = [
                'errors' => [
                    'nik' => $this->validasi->getError('nik'),
                    'telepon' => $this->validasi->getError('telepon'),
                    'img' => $this->validasi->getError('img')
                ]
            ];

            echo json_encode($pesan);
        } else {

            $cekTelp = $this->UserModel->getWhere(['telepon' => $data['telepon']])->getResultArray();

            if ($data['telepon'] == $user['telepon']) {

                if ($data['nama'] != $user['namaLengkap']) {
                    session()->remove('nama');
                    session()->set(['nama' => $data['nama']]);
                }

                $this->UserModel->update($data['id'], [
                    'nik' => $data['nik'],
                    'namaLengkap' => $data['nama'],
                    'password' => $user['password'],
                    'telepon' => $data['telepon'],
                    'alamat' => $data['alamat'],
                    'img' => $user['img']
                ]);

                $pesan = [
                    'sukses' => "Behasil Mengubah Data",
                    'nama' => $data['nama']
                ];

                echo json_encode($pesan);
            } else if (count($cekTelp) > 0) {
                $pesan = [
                    'errors' => [
                        'telp' => "Telepon Sudah Terdaftar"
                    ]
                ];

                echo json_encode($pesan);
            } else {

                if ($data['nama'] != $user['namaLengkap']) {
                    session()->remove('nama');
                    session()->set(['nama' => $data['nama']]);
                }

                $this->UserModel->update($data['id'], [
                    'nik' => $data['nik'],
                    'namaLengkap' => $data['nama'],
                    'password' => $user['password'],
                    'telepon' => $data['telepon'],
                    'alamat' => $data['alamat'],
                    'img' => ''
                ]);

                $pesan = [
                    'sukses' => "Behasil Mengubah Data",
                    'nama' => $data['nama']
                ];

                echo json_encode($pesan);
            }
        }
    }

    public function ubahImg()
    {
        $img = $this->request->getFile('img');

        $id = $this->request->getPost('id');
        $dataUser = $this->UserModel->find($id);
        $namaImg = $img->getRandomName();

        if (!$this->validate([
            'img' => [
                'rules' => 'max_size[img,1500]|is_image[img]|mime_in[img,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => "Ukuran Gambar Terlalu Besar",
                    'is_image' => "Maaf, Yang Anda Masukan bukan Gambar",
                    'mime_in' => "Maaf, Yang Anda Masukan bukan Gambar",
                ]
            ]
        ])) {
            $error = $this->validasi->getError('img');

            session()->setFlashdata("pesan", $error);
            return redirect()->to("Profil");
        } else {
            $img->move('assets/img/pp', $namaImg);
            if ($dataUser['img'] != "undraw_profile.svg") {
                unlink('assets/img/pp/' . $dataUser['img']);
            }
            session()->remove('img');
            $this->UserModel->update($id, [
                'nik' => $dataUser['nik'],
                'namaLengkap' => $dataUser['namaLengkap'],
                'password' => $dataUser['password'],
                'telepon' => $dataUser['telepon'],
                'alamat' => $dataUser['alamat'],
                'img' => $namaImg
            ]);
            session()->set(['img' => $namaImg]);

            session()->setFlashdata('sukses', "Berhasil Mengupload Foto");
            return redirect()->to('Profil');
        }
    }
}
