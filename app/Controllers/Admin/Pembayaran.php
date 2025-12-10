<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;
use App\Models\TransaksiPemenangModel;
use App\Models\BarangModel;
use App\Models\TransaksiLelangModel;

class Pembayaran extends BaseController
{
    protected $pembayaran, $pemenang, $barang, $lelang;

    public function __construct()
    {
        $this->pembayaran = new PembayaranModel();
        $this->pemenang   = new TransaksiPemenangModel();
        $this->barang     = new BarangModel();
        $this->lelang     = new TransaksiLelangModel();
    }

    // ✔ List Pembayaran masuk
    public function index()
    {
        $data['bayar'] = $this->pembayaran
            ->select('transaksi_pembayaran.*, transaksi_pemenang.harga_menang, barang.nama_barang, transaksi_pemenang.id_user')
            ->join('transaksi_pemenang','transaksi_pemenang.id_pemenang = transaksi_pembayaran.id_pemenang')
            ->join('transaksi_lelang','transaksi_lelang.id_lelang = transaksi_pemenang.id_lelang')
            ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
            ->orderBy('id_bayar','DESC')
            ->findAll();

        return view('admin/pembayaran/index', $data);
    }

    // ✔ Detail Pembayaran
    public function detail($id_bayar)
    {
        $data['bayar'] = $this->pembayaran
            ->select('transaksi_pembayaran.*, barang.nama_barang, transaksi_pemenang.harga_menang')
            ->join('transaksi_pemenang','transaksi_pemenang.id_pemenang = transaksi_pembayaran.id_pemenang')
            ->join('transaksi_lelang','transaksi_lelang.id_lelang = transaksi_pemenang.id_lelang')
            ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
            ->where('id_bayar', $id_bayar)
            ->first();

        return view('admin/pembayaran/detail', $data);
    }

    // ✔ Approve/Reject
    public function verifikasi($id_bayar, $status)
    {
        $this->pembayaran->update($id_bayar, [
            'status' => $status  // paid / rejected
        ]);

        return redirect()->to('/admin/pembayaran')->with('success',"Pembayaran berhasil diupdate!");
    }
}
