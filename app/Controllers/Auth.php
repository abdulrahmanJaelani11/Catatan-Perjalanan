<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
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
            'judul' => "Login"
        ];
        return view("login", $data);
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function register()
    {
        $data = [
            'judul' => "Register"
        ];
        return view("register.php", $data);
    }

    public function prosesLogin()
    {
        $data = $this->request->getVar();

        if (!$this->validate([
            'nik' => [
                'rules' => 'required|max_length[16]',
                'errors' => [
                    'required' => "{field} tidak boleh kosong",
                    'max_length' => "{field} tidak boleh lebih dari 16 angka"
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "{field} tidak boleh kosong"
                ]
            ],

        ])) {
            $pesan = [
                'errors' => [
                    'nik' => $this->validasi->getError('nik'),
                    'password' => $this->validasi->getError('password'),
                ]
            ];

            echo json_encode($pesan);
        } else {
            $user = $this->UserModel->db->query("SELECT * FROM users WHERE nik = " . $data['nik'] . "")->getRowArray();
            $formatNik = substr($data['nik'], 0, 4);
            // echo $formatNik;
            // die;
            if ($formatNik == 3205) {
                if ($user) {
                    if (password_verify($data['password'], $user['password'])) {
                        $session = [
                            'nik' => $data['nik'],
                            'id' => $user['id'],
                            'img' => $user['img'],
                            'nama' => $user['namaLengkap']
                        ];
                        session()->set($session);
                        $pesan = [
                            'sukses' => "sukses"
                        ];
                        echo json_encode($pesan);
                    } else {
                        $pesan = [
                            'errorPass' => "Password Salah"
                        ];
                        echo json_encode($pesan);
                    }
                } else {
                    $pesan = [
                        'errorNik' => "Nik Tidak Ditemukan"
                    ];

                    echo json_encode($pesan);
                }
            } else {
                $pesan = [
                    'errorNik' => "Maaf, Sepertinya nik yang anda masukan salah"
                ];

                echo json_encode($pesan);
            }
        }
    }

    public function logout()
    {
        session()->remove('nik');
        session()->remove('id');
        session()->remove('img');
        session()->remove('nama');
        return redirect()->to(base_url("Auth/welcome"));
    }

    public function prosesRegister()
    {
        $data = $this->request->getVar();
        // var_dump($data);
        // die;

        if ($data['password'] != $data['konfirmasi']) {
            $pesan = [
                'errorKon' => "Konfirmasi password tidak sesuai"
            ];

            echo json_encode($pesan);
        } else {
            if (!$this->validate([
                'nik' => [
                    'rules' => 'required|is_unique[users.nik]|max_length[16]|numeric',
                    'errors' => [
                        'required' => "{field} tidak boleh kosong",
                        'is_unique' => "{field} sudah terdaftar",
                        'max_length' => "{field} tidak boleh lebih dari 16 angka",
                        'numeric' => "{field} tidak boleh mengandung karakter lain"
                    ]
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => "{field} tidak boleh kosong"
                    ]
                ],
                'password' => [
                    'rules' => 'required|max_length[20]|min_length[5]',
                    'errors' => [
                        'required' => "{field} tidak boleh kosong",
                        'min_length' => "{field} tidak boleh kurang dari 5 karakter",
                        'max_length' => "{field} tidak boleh lebih dari 20 karakter"
                    ]
                ],
                'konfirmasi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => "{field} password terlebih dahulu"
                    ]
                ],

            ])) {
                $pesan = [
                    'errors' => [
                        'nik' => $this->validasi->getError('nik'),
                        'nama' => $this->validasi->getError('nama'),
                        'password' => $this->validasi->getError('password'),
                        'konfirmasi' => $this->validasi->getError('konfirmasi'),
                    ]
                ];

                echo json_encode($pesan);
            } else {
                $formatNik = substr($data['nik'], 0, 4);
                if ($formatNik == 3205) {
                    $password = password_hash($data['password'], PASSWORD_BCRYPT);
                    $this->UserModel->save([
                        'nik' => $data['nik'],
                        'namaLengkap' => $data['nama'],
                        'password' => $password,
                        'img' => 'undraw_profile.svg'

                    ]);


                    $pesan = [
                        'sukses' => 'Berhasil Mendaftar'
                    ];

                    echo json_encode($pesan);
                } else {
                    $pesan = [
                        'errorNik' => 'Maaf, Sepertinya nik yang anda masukan salah'
                    ];

                    echo json_encode($pesan);
                }
            }
        }
    }

    public function prosesCariNik()
    {
        $nik = $this->request->getVar("nik");
        // echo $data['nik'];
        $data = $this->UserModel->db->query("SELECT * FROM users WHERE nik = $nik")->getRowArray();
        $formatNik = substr($nik, 0, 4);


        if (strlen($nik) < 16) {
            echo "nikPendek";
        } else if (strlen($nik) > 16) {
            echo "nikPanjang";
        } else {
            if ($formatNik == 3205) {
                if ($nik == $data['nik']) {
                    echo "ada";
                } else {
                    echo "tidakAda";
                }
            } else {
                echo "formatNikSalah";
            }
        }
    }

    public function prosesCekPass()
    {
        $pass = $this->request->getVar('pass');

        if (strlen($pass) < 5) {
            echo "passPendek";
        } else if (strlen($pass) > 20) {
            echo "passPanjang";
        } else {
            echo "ok";
        }
    }

    public function prosesCariNik_L()
    {
        $nik = $this->request->getVar('nik');

        $user = $this->UserModel->getWhere(['nik' => $nik])->getRowArray();

        if ($user) {
            echo "ada";
        } else {
            echo 'tidakAda';
        }
    }

    public function cariUser()
    {
        $data = $this->request->getGetPost('data');

        $data = [
            'user' => $this->UserModel->db->query("SELECT * FROM users WHERE namaLengkap LIKE '%$data%' OR nik LIKE '%$data%' OR alamat LIKE '%$data%' OR telepon LIKE '%$data%'")->getResultArray()
        ];

        echo json_encode(view('Pencarian/getPencarianUser', $data));
    }
}
