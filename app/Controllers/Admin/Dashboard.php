<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        // ===== COUNT =====
        $totalBarang = $this->db->table('barang')->countAllResults();

        $lelangAktif = $this->db->table('transaksi_lelang')
            ->where('status', 'aktif')
            ->countAllResults();

        $totalPemenang = $this->db->table('transaksi_pemenang')
            ->countAllResults();

        $totalPembayaran = $this->db->table('transaksi_pembayaran')
            ->where('status', 'paid')
            ->countAllResults();

        // ===== PEMBAYARAN TERBARU =====
        $pembayaranTerbaru = $this->db->table('transaksi_pembayaran')
            ->select('
                barang.nama_barang,
                users.nama AS nama_pemenang,
                transaksi_pembayaran.metode,
                transaksi_pembayaran.status,
                transaksi_pembayaran.tanggal_bayar,
                transaksi_pemenang.harga_menang
            ')
            ->join('transaksi_pemenang','transaksi_pemenang.id_pemenang = transaksi_pembayaran.id_pemenang')
            ->join('transaksi_lelang','transaksi_lelang.id_lelang = transaksi_pemenang.id_lelang')
            ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
            ->join('users','users.id_user = transaksi_pemenang.id_user')
            ->orderBy('transaksi_pembayaran.tanggal_bayar','DESC')
            ->limit(5)
            ->get()->getResultArray();

        return view('admin/dashboard', [
            'totalBarang'       => $totalBarang,
            'lelangAktif'       => $lelangAktif,
            'totalPemenang'     => $totalPemenang,
            'totalPembayaran'   => $totalPembayaran,
            'pembayaranTerbaru' => $pembayaranTerbaru
        ]);
    }
}
