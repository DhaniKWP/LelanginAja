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
        $this->user       = new UserModel();
    }

    // ====================== LIST PENDAFTARAN ======================
    public function index()
    {
        $data['registrasi'] = $this->registrasi
            ->select('transaksi_registrasi.*, users.nama, users.email')
            ->join('users', 'users.id_user = transaksi_registrasi.id_user')
            ->orderBy('id_reg', 'DESC')
            ->findAll();

        return view('admin/peserta/index', $data);
    }

    // ====================== APPROVE PESERTA ======================
    public function approve($id_reg)
{
    $reg = $this->registrasi->find($id_reg);
    if (!$reg) {
        return redirect()->back()->with('error', 'Data registrasi tidak ditemukan.');
    }

    // ✅ ambil data peserta
    $peserta = $this->peserta
        ->where('id_user', $reg['id_user'])
        ->first();

    // ❌ kalau peserta belum ada → ERROR LOGIKA
    if (!$peserta) {
        return redirect()->back()->with(
            'error',
            'Data peserta tidak ditemukan. User belum mendaftar peserta.'
        );
    }

    // ✅ update status registrasi
    $this->registrasi->update($id_reg, [
        'status' => 'disetujui'
    ]);

    // ✅ update peserta (SEKARANG AMAN)
    $this->peserta->update($peserta['id_peserta'], [
        'is_active' => true,
        'tanggal_disetujui' => date('Y-m-d H:i:s')
    ]);

    return redirect()->back()->with('success', 'Peserta berhasil disetujui!');
}


    // ====================== REJECT PESERTA ======================
    public function reject($id_reg)
    {
        $reg = $this->registrasi->find($id_reg);
        if (!$reg) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // update status registrasi
        $this->registrasi->update($id_reg, [
            'status' => 'ditolak'
        ]);

        return redirect()->back()->with('success', 'Pendaftaran ditolak.');
    }
}
