<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\CatatanModel;
use App\Models\UserModel;
use CodeIgniter\CodeIgniter;

class Catatan extends BaseController
{
    protected $CatatanModel;
    protected $validasi;
    protected $AdminModel;
    protected $UserModel;
    public function __construct()
    {
        $this->CatatanModel = new CatatanModel();
        $this->validasi = \Config\Services::validation();
        $this->AdminModel = new AdminModel();
        $this->UserModel = new UserModel();
    }
    public function index()
    {
        $data = [
            'judul' => 'Data Catatan',
            'catatan' => $this->CatatanModel->getWhere(['id_user' => session('id')])->getResultArray()
        ];
        // var_dump($data['catatan']);

        return view('catatan', $data);
    }

    public function isiCatatan()
    {
        $catatan = $this->request->getVar();

        if (!$this->validate([
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'jam' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'suhu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],

        ])) {
            $pesan = [
                'error' => [
                    'tanggal' => $this->validasi->getError('tanggal'),
                    'jam' => $this->validasi->getError('jam'),
                    'lokasi' => $this->validasi->getError('lokasi'),
                    'suhu' => $this->validasi->getError('suhu'),
                ]
            ];

            echo json_encode($pesan);
        } else {
            if ($catatan['keterangan'] == '') {
                $keterangan = "<i class= 'text-danger'> Tanpa Keterangan </i>";
            } else {
                $keterangan = htmlspecialchars($catatan['keterangan']);
            }
            $this->CatatanModel->save([
                'id_user' => session('id'),
                'tanggal' => htmlspecialchars($catatan['tanggal']),
                'jam' => htmlspecialchars($catatan['jam']),
                'lokasi' => htmlspecialchars($catatan['lokasi']),
                'suhu' => htmlspecialchars($catatan['suhu'] . "C"),
                'keterangan' => $keterangan,
            ]);

            $pesan = [
                'sukses' => "Berhasil Menyipan Catatan"
            ];

            echo json_encode($pesan);
        }
    }

    public function cariData()
    {
        $data = $this->request->getVar('data');
        // echo $data;
        $id = session('id');
        // echo $id;
        // die;

        $data = [
            'catatan' => $this->CatatanModel->db->query("SELECT * FROM catatan WHERE id_user = $id AND lokasi LIKE '%$data%' OR tanggal LIKE '%$data%' OR jam LIKE '%$data%' OR suhu LIKE '%$data%' OR keterangan LIKE '%$data%' ")->getResultArray()
        ];

        echo json_encode(view('Pencarian/getPencarian', $data));
    }

    public function dataCatatanUser()
    {
        $data = [
            'judul' => 'Data Catatan | Admin',
            'admin' => $this->AdminModel->getWhere(['email' => session('email')])->getRowArray(),
            'user' => $this->UserModel->findAll(),
            'catatan' => $this->CatatanModel->findAll()
        ];

        return view('admin/dataCatatan', $data);
    }

    public function getCatatan()
    {
        $id = $this->request->getVar('id');
        $data = $this->CatatanModel->db->table('catatan')->join('users', 'users.id=catatan.id_user')->getWhere(['id_user' => $id])->getResultArray();

        // var_dump($data);
        // die;
        $data = [
            'catatan' => $data
        ];

        echo json_encode(view("admin/getCatatan", $data));
    }

    public function hapusCatatan()
    {
        $id = $this->request->getVar('id');

        $this->CatatanModel->delete($id);
        $pesan = [
            'sukses' => "Berhasil Menghapus data"
        ];

        echo json_encode($pesan);
    }
}
