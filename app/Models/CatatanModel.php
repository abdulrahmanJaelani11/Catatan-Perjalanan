<?php

namespace App\Models;

use CodeIgniter\Model;

class CatatanModel extends Model
{
    protected $table = 'catatan';
    protected $allowedFields = ['id_user', 'tanggal', 'jam', 'lokasi', 'suhu', 'keterangan'];
    protected $primaryKey = 'id_catatan';

    public function SemuaCatatan()
    {
        return $this->findAll();
    }

    public function catatanSaya($data)
    {
        return $this->db->query("SELECT * FROM catatan  WHERE id_user = $data")->getResultArray();
    }
}
