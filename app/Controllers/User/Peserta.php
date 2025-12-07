<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\PesertaModel;

class Peserta extends BaseController
{
    protected $peserta;

    public function __construct()
    {
        $this->peserta = new PesertaModel();
    }

    // CEK STATUS PESERTA
    public function index()
    {
        $id_user = session()->get('id_user');
        $data['peserta'] = $this->peserta->where('id_user', $id_user)->first();

        return view('user/peserta/index', $data); // halaman informasi peserta
    }

    // FORM Pendaftaran
    public function daftar()
    {
        return view('user/peserta/register');
    }

    // STORE DATA PEMESERTAAN
    public function store()
    {
        $id_user = session()->get('id_user');

        // Cek jika sudah peserta, tidak bisa daftar lagi
        if($this->peserta->where('id_user', $id_user)->countAllResults() > 0){
            return redirect()->to('/user/peserta')->with('info','Kamu sudah terdaftar sebagai peserta!');
        }

        $this->peserta->save([
            'id_user' => $id_user,
            'alamat'  => $this->request->getPost('alamat'),
            'no_hp'   => $this->request->getPost('no_hp'),
        ]);

        return redirect()->to('/user/peserta')->with('success','Berhasil daftar peserta lelang!');
    }
}
