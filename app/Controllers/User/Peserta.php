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
        $this->peserta    = new PesertaModel();
        $this->registrasi = new TransaksiRegistrasiModel();
    }

    // ================= HALAMAN STATUS PESERTA =================
    public function index()
    {
        $id_user = session()->get('id_user');

        $data['registrasi'] = $this->registrasi
            ->where('id_user', $id_user)
            ->orderBy('id_reg', 'DESC')
            ->first();

        $data['peserta'] = $this->peserta
            ->where('id_user', $id_user)
            ->first();

        return view('user/peserta/index', $data);
    }

    // ================= FORM DAFTAR PESERTA =================
    public function daftar()
    {
        $id_user = session()->get('id_user');

        // 🔒 Masih pending
        if ($this->registrasi
            ->where('id_user', $id_user)
            ->where('status', 'pending')
            ->first()) {
            return redirect()->to('/user/peserta')
                ->with('info', 'Pengajuan kamu masih menunggu persetujuan admin.');
        }

        // ✅ Sudah peserta AKTIF
        if ($this->peserta
            ->where('id_user', $id_user)
            ->where('is_active', true)
            ->first()) {
            return redirect()->to('/user/peserta')
                ->with('success', 'Kamu sudah menjadi peserta.');
        }
        
        return view('user/peserta/register');
    }

    // ================= SIMPAN PENDAFTARAN =================
    public function store()
    {
        $id_user = session()->get('id_user');

        // 🔒 Kalau masih pending, tolak
        if ($this->registrasi
            ->where('id_user', $id_user)
            ->where('status', 'pending')
            ->first()) {
            return redirect()->to('/user/peserta')
                ->with('info', 'Pengajuan kamu masih diproses.');
        }

        // 🔒 Kalau sudah aktif, tolak
        if ($this->peserta
            ->where('id_user', $id_user)
            ->where('is_active', true)
            ->first()) {
            return redirect()->to('/user/peserta')
                ->with('success', 'Kamu sudah menjadi peserta.');
        }

        // 1️⃣ SIMPAN DATA PROFIL PESERTA (BELUM AKTIF)
        $this->peserta->insert([
            'id_user'   => $id_user,
            'alamat'    => $this->request->getPost('alamat'),
            'no_hp'     => $this->request->getPost('no_hp'),
            'is_active' => false,
            'tanggal_disetujui' => null
        ]);

        // 2️⃣ SIMPAN STATUS REGISTRASI
        $this->registrasi->insert([
            'id_user'        => $id_user,
            'tanggal_daftar' => date('Y-m-d H:i:s'),
            'status'         => 'pending'
        ]);

        return redirect()->to('/user/peserta')
            ->with('success', 'Pendaftaran berhasil, menunggu persetujuan admin.');
    }
}
