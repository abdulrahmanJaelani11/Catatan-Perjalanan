<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = "admin";
    protected $primaryKey = "id";
    protected $allowedFields = ["email", "nama", "password", "img"];

    public function semua($email)
    {
        return $this->getWhere(['email' => $email])->getResultArray();
    }
}
