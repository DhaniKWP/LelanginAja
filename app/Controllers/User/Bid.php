<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\TransaksiPenawaranModel;
use App\Models\TransaksiLelangModel;
use App\Models\PesertaModel;

class Bid extends BaseController
{
    protected $penawaran, $lelang, $peserta;

    public function __construct()
    {
        $this->penawaran = new TransaksiPenawaranModel();
        $this->lelang    = new TransaksiLelangModel();
        $this->peserta   = new PesertaModel();
    }

    public function submit($id_lelang)
{
    $userId = session()->get('id_user');

    // 1️⃣ WAJIB: cek peserta AKTIF
    $pesertaAktif = $this->peserta
        ->where('id_user', $userId)
        ->where('is_active', true)
        ->first();

    if (!$pesertaAktif) {
        return redirect()->to('/user/peserta')
            ->with('error', 'Akun kamu belum disetujui admin.');
    }

    // 2️⃣ Ambil data lelang + barang
    $lelang = $this->lelang
        ->select('
            transaksi_lelang.*,
            barang.harga_awal,
            barang.id_user AS pemilik_barang
        ')
        ->join('barang', 'barang.id_barang = transaksi_lelang.id_barang')
        ->where('transaksi_lelang.id_lelang', $id_lelang)
        ->where('transaksi_lelang.status', 'aktif')
        ->first();

    // 🔒 BLOKIR JIKA LELANG TIDAK ADA / SELESAI
    if (!$lelang || $lelang['status'] === 'selesai') {
        return redirect()->back()
            ->with('error', 'Lelang sudah berakhir');
    }

    // ⛔ BLOKIR JIKA USER ADALAH PEMILIK BARANG
    if ((int)$lelang['pemilik_barang'] === (int)$userId) {
        return redirect()->back()
            ->with('error', 'Kamu tidak bisa menawar barang milikmu sendiri.');
    }

    // 3️⃣ Ambil bid tertinggi
    $lastBid = $this->penawaran
        ->where('id_lelang', $id_lelang)
        ->orderBy('harga_penawaran', 'DESC')
        ->first();

    $harga = (int) $this->request->getPost('harga_penawaran');

    $minBid = $lastBid
        ? (int) $lastBid['harga_penawaran']
        : (int) $lelang['harga_awal'];

    if ($harga <= $minBid) {
        return redirect()->back()
            ->with('error', 'Bid harus lebih tinggi dari Rp ' . number_format($minBid));
    }

    // 4️⃣ SIMPAN BID
    $this->penawaran->insert([
        'id_lelang'       => $id_lelang,
        'id_user'         => $userId,
        'harga_penawaran' => $harga,
        'waktu_penawaran' => date('Y-m-d H:i:s'),
    ]);

    return redirect()->back()
        ->with('success', 'Penawaran berhasil dikirim!');
}


}
