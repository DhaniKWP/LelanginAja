<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\PesertaModel;
use App\Models\TransaksiRegistrasiModel;

class Peserta extends BaseController
{
    protected $peserta;
    protected $registrasi;

    public function __construct()
    {
        $this->peserta = new PesertaModel();
        $this->registrasi = new TransaksiRegistrasiModel();
    }

    public function index()
    {
        $id_user = session()->get('id_user');

        $data['registrasi'] = $this->registrasi
                                   ->where('id_user',$id_user)
                                   ->orderBy('id_reg','DESC')
                                   ->first();

        $data['peserta'] = $this->peserta
                               ->where('id_user',$id_user)
                               ->first(); // hanya ada kalau sudah di-approve admin

        return view('user/peserta/index', $data);
    }

    public function daftar()
    {
        $id_user = session()->get('id_user');

        // Jika sudah pernah daftar & pending approve
        if($this->registrasi->where('id_user',$id_user)->where('status','pending')->first()){
            return redirect()->to('/user/peserta')->with('info','Pengajuan sedang menunggu verifikasi admin.');
        }

        // Jika sudah peserta resmi
        if($this->peserta->where('id_user',$id_user)->first()){
            return redirect()->to('/user/peserta')->with('success','Kamu sudah menjadi peserta.');
        }

        return view('user/peserta/register');
    }

    public function store()
    {
        $id_user = session()->get('id_user');

        // Insert ke tabel registrasi bukan peserta
        $this->registrasi->save([
            'id_user' => $id_user,
            'tanggal_daftar' => date('Y-m-d H:i:s'),
            'status' => 'pending'
        ]);

        return redirect()->to('/user/peserta')->with('success','Pendaftaran peserta dikirim, menunggu persetujuan admin.');
    }
}
