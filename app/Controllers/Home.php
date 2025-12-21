<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransaksiLelangModel;

class Home extends BaseController
{
    protected $lelang;

    public function __construct()
    {
        $this->lelang = new TransaksiLelangModel();
    }

    public function index()
    {
        $data['lelang'] = $this->lelang
            ->select('
                transaksi_lelang.*,
                barang.nama_barang,
                barang.harga_awal,
                barang.foto,
                transaksi_lelang.tanggal_selesai
            ')
            ->join('barang', 'barang.id_barang = transaksi_lelang.id_barang')
            ->where('transaksi_lelang.status', 'aktif')
            ->where('transaksi_lelang.tanggal_selesai >', date('Y-m-d H:i:s')) // 🔥 FILTER WAKTU
            ->orderBy('transaksi_lelang.tanggal_mulai', 'DESC')
            ->findAll();

        return view('home/index', $data); 
    }

            public function detail($id_lelang)
    {
        $lelang = $this->lelang
            ->select('
                transaksi_lelang.*,
                barang.nama_barang,
                barang.nama_kategori,
                barang.harga_awal,
                barang.deskripsi,
                barang.foto,
                kondisi_barang.nama_kondisi,
                barang.tanggal_pengajuan
            ')
            ->join('barang', 'barang.id_barang = transaksi_lelang.id_barang')
            ->join('kondisi_barang', 'kondisi_barang.id_kondisi = barang.kondisi_id')
            ->where('transaksi_lelang.id_lelang', $id_lelang)
            ->where('transaksi_lelang.status', 'aktif')
            ->where('transaksi_lelang.tanggal_selesai >', date('Y-m-d H:i:s')) // 🔥 FILTER WAKTU
            ->first();

        if (!$lelang) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Lelang tidak ditemukan atau sudah selesai'
            );
        }

        $sisa = strtotime($lelang['tanggal_selesai']) - time();
        $hari = floor($sisa / 86400);
        $jam  = floor(($sisa % 86400) / 3600);

        return view('home/detail', [
            'barang'   => $lelang,
            'sisaHari' => max(0, $hari),
            'sisaJam'  => max(0, $jam),
        ]);
    }
}
