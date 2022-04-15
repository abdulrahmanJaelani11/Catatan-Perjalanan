<?php

namespace App\Controllers;

class IsiCatatan extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Isi Catatan'
        ];

        return view('isiCatatan', $data);
    }
}
