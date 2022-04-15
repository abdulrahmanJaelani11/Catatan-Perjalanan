<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = "users";
    protected $primaryKey = "id";
    protected $allowedFields = ["nik", "namaLengkap", "password", "telepon", "alamat", "img"];

    public function semua()
    {
        return $this->findAll();
    }
}
