<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TransaksiPemenangModel;

class Pemenang extends BaseController
{
    protected $pemenang;

    public function __construct()
    {
        $this->pemenang = new TransaksiPemenangModel();
    }

    // ================= LIST PEMENANG =================
    public function index()
    {
        $data['pemenang'] = $this->pemenang
            ->select('
                transaksi_pemenang.*,
                barang.nama_barang,
                barang.foto,
                users.nama
            ')
            ->join('transaksi_lelang','transaksi_lelang.id_lelang = transaksi_pemenang.id_lelang')
            ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
            ->join('users','users.id_user = transaksi_pemenang.id_user')
            ->orderBy('transaksi_pemenang.tanggal_menang','DESC')
            ->findAll();

        return view('admin/pemenang/index', $data);
    }

    // ================= DETAIL PEMENANG =================
   public function detail($id_lelang)
    {
        $pemenang = $this->pemenang
            ->select('
                transaksi_pemenang.*,

                users.nama,
                users.email,

                peserta.no_hp,
                peserta.alamat,

                barang.nama_barang,
                barang.foto,
                barang.harga_awal,

                transaksi_lelang.tanggal_selesai,

                transaksi_pembayaran.metode,
                transaksi_pembayaran.bukti_transfer,
                transaksi_pembayaran.status AS status_bayar,
                transaksi_pembayaran.tanggal_bayar
            ')
            ->join('users', 'users.id_user = transaksi_pemenang.id_user')
            ->join('peserta', 'peserta.id_user = users.id_user')
            ->join('transaksi_lelang', 'transaksi_lelang.id_lelang = transaksi_pemenang.id_lelang')
            ->join('barang', 'barang.id_barang = transaksi_lelang.id_barang')

            // 🔥 INI YANG KURANG
            ->join(
                'transaksi_pembayaran',
                'transaksi_pembayaran.id_pemenang = transaksi_pemenang.id_pemenang',
                'left'
            )

            ->where('transaksi_pemenang.id_lelang', $id_lelang)
            ->first();

        if (!$pemenang) {
            return redirect()->back()->with('error', 'Data pemenang tidak ditemukan');
        }

        return view('admin/pemenang/detail', compact('pemenang'));
    }
}