<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;

class HistoryPembayaran extends BaseController
{
    protected $pembayaranModel;

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
    }

    /**
     * List history pembayaran user (status = paid)
     */
    public function index()
    {
        $id_user = session()->get('id_user');

        $data['history'] = $this->pembayaranModel
            ->select('
                transaksi_pembayaran.id_bayar,
                transaksi_pembayaran.metode,
                transaksi_pembayaran.status,
                transaksi_pembayaran.tanggal_bayar,
                barang.nama_barang
            ')
            ->join(
                'transaksi_pemenang',
                'transaksi_pemenang.id_pemenang = transaksi_pembayaran.id_pemenang'
            )
            ->join(
                'transaksi_lelang',
                'transaksi_lelang.id_lelang = transaksi_pemenang.id_lelang'
            )
            ->join(
                'barang',
                'barang.id_barang = transaksi_lelang.id_barang'
            )
            ->where('transaksi_pemenang.id_user', $id_user)
            ->orderBy('transaksi_pembayaran.tanggal_bayar', 'DESC')
            ->findAll();

        return view('user/pembayaran/history', $data);
    }

    /**
     * Detail pembayaran
     */
    public function detail($id_bayar)
    {
        $id_user = session()->get('id_user');

        $data['pembayaran'] = $this->pembayaranModel
            ->select('
                transaksi_pembayaran.*,
                barang.nama_barang,
                barang.harga_awal
            ')
            ->join(
                'transaksi_pemenang',
                'transaksi_pemenang.id_pemenang = transaksi_pembayaran.id_pemenang'
            )
            ->join(
                'transaksi_lelang',
                'transaksi_lelang.id_lelang = transaksi_pemenang.id_lelang'
            )
            ->join(
                'barang',
                'barang.id_barang = transaksi_lelang.id_barang'
            )
            ->where('transaksi_pembayaran.id_bayar', $id_bayar)
            ->where('transaksi_pemenang.id_user', $id_user) // ✅ AMAN
            ->first();

        if (!$data['pembayaran']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Data pembayaran tidak ditemukan'
            );
        }

        return view('user/pembayaran/detail', $data);
    }

}
