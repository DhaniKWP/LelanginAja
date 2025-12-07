<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TransaksiRegistrasiModel;
use App\Models\PesertaModel;
use App\Models\UserModel;

class Peserta extends BaseController
{
    protected $registrasi;
    protected $peserta;
    protected $user;

    public function __construct()
    {
        $this->registrasi = new TransaksiRegistrasiModel();
        $this->peserta    = new PesertaModel();
        $this->user       = new UserModel();  // pastikan sudah ada UserModel.php
    }

    // ====================== LIST PESERTA ===========================
    public function index()
    {
        $data['registrasi'] = $this->registrasi
                                  ->select('transaksi_registrasi.*, users.nama, users.email')
                                  ->join('users','users.id_user=transaksi_registrasi.id_user')
                                  ->orderBy('id_reg','DESC')
                                  ->findAll();

        return view('admin/peserta/index', $data);
    }

    // ====================== APPROVE PESERTA =========================
    public function approve($id_reg)
    {
        $reg = $this->registrasi->find($id_reg);
        if(!$reg) return redirect()->back()->with('error','Data tidak ditemukan.');

        // masukkan ke tabel peserta jika belum ada
        if(!$this->peserta->where('id_user',$reg['id_user'])->first()){
            $this->peserta->save([
                'id_user' => $reg['id_user'],
                'alamat'  => 'Belum diisi',  // nanti user bisa edit
                'no_hp'   => '-'
            ]);
        }

        // update status registrasi
        $this->registrasi->update($id_reg, ['status'=>'approved']);

        return redirect()->back()->with('success','Peserta berhasil disetujui!');
    }

    // ====================== REJECT PESERTA =========================
    public function reject($id_reg)
    {
        $this->registrasi->update($id_reg, ['status'=>'rejected']);

        return redirect()->back()->with('success','Pendaftaran ditolak.');
    }
}
