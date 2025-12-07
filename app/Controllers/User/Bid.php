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

        // 1. Pastikan user sudah jadi peserta
        if (!$this->peserta->where('id_user', $userId)->first()) {
            return redirect()->back()->with('error', 'Daftar peserta dulu untuk ikut lelang.');
        }

        // 2. Ambil data lelang + harga_awal dari tabel barang
        $lelang = $this->lelang
            ->select('transaksi_lelang.*, barang.harga_awal')
            ->join('barang', 'barang.id_barang = transaksi_lelang.id_barang')
            ->where('transaksi_lelang.id_lelang', $id_lelang)
            ->first();

        if (!$lelang) {
            return redirect()->back()->with('error', 'Lelang tidak ditemukan.');
        }

        // 3. Ambil bid tertinggi sekarang
        $lastBid = $this->penawaran->where('id_lelang', $id_lelang)
                                   ->orderBy('harga_penawaran', 'DESC')
                                   ->first();

        $harga = (int) $this->request->getPost('harga_penawaran');

        // 4. Minimal bid = bid tertinggi atau harga_awal kalau belum ada bid
        $minBid = $lastBid ? (int) $lastBid['harga_penawaran'] : (int) $lelang['harga_awal'];

        if ($harga <= $minBid) {
            return redirect()->back()
                ->with('error', 'Bid harus lebih tinggi dari Rp ' . number_format($minBid));
        }

        // 5. Simpan penawaran
        $this->penawaran->save([
            'id_lelang'       => $id_lelang,
            'id_user'         => $userId,
            'harga_penawaran' => $harga,
            'waktu_penawaran' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Penawaran berhasil dikirim!');
    }
}
