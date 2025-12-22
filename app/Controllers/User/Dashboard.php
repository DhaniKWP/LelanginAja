<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\BarangModel;
use App\Models\TransaksiLelangModel;
use App\Models\TransaksiPenawaranModel;

class Dashboard extends BaseController
{
    protected $userModel;
    protected $barangModel;
    protected $lelangModel;
    protected $penawaranModel;

    public function __construct()
    {
        $this->userModel      = new UserModel();
        $this->barangModel    = new BarangModel();
        $this->lelangModel    = new TransaksiLelangModel();
        $this->penawaranModel = new TransaksiPenawaranModel();
    }

    public function index()
    {
        $id_user = session()->get('id_user');

        // =========================
        // USER INFO
        // =========================
        $data['users'] = $this->userModel
            ->where('id_user', $id_user)
            ->first();

        // =========================
        // STATS (TANPA BULAN INI)
        // =========================
        $data['stats'] = [
            'total_barang' => $this->barangModel
                ->where('id_user', $id_user)
                ->countAllResults(),

            'barang_aktif' => $this->lelangModel
                ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
                ->where('barang.id_user', $id_user)
                ->where('transaksi_lelang.status', 'aktif')
                ->where('transaksi_lelang.tanggal_selesai >', date('Y-m-d H:i:s'))
                ->countAllResults(),

            'total_penawaran' => $this->penawaranModel
                ->where('id_user', $id_user)
                ->countAllResults(),
        ];

        // =========================
        // BARANG LELANG POPULER
        // =========================
        $barang = $this->lelangModel
            ->select('
                transaksi_lelang.id_lelang,
                barang.nama_barang,
                barang.foto,
                barang.nama_kategori,
                kondisi_barang.nama_kondisi,
                barang.harga_awal,
                transaksi_lelang.tanggal_selesai
            ')
            ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
            ->join('kondisi_barang','kondisi_barang.id_kondisi = barang.kondisi_id')
            ->where('transaksi_lelang.status','aktif')
            ->where('transaksi_lelang.tanggal_selesai >', date('Y-m-d H:i:s'))
            ->orderBy('transaksi_lelang.tanggal_selesai','ASC')
            ->limit(6)
            ->findAll();

        $data['barang_populer'] = [];

        foreach ($barang as $b) {

            $totalBid = $this->penawaranModel
                ->where('id_lelang', $b['id_lelang'])
                ->countAllResults();

            $highest = $this->penawaranModel
                ->where('id_lelang', $b['id_lelang'])
                ->orderBy('harga_penawaran','DESC')
                ->first();

            $sisa   = strtotime($b['tanggal_selesai']) - time();
            $jam    = floor($sisa / 3600);
            $menit  = floor(($sisa % 3600) / 60);

            $data['barang_populer'][] = [
                'id'             => $b['id_lelang'],
                'nama'           => $b['nama_barang'],
                'foto'           => $b['foto'],
                'kategori'       => $b['nama_kategori'],
                'kondisi'        => $b['nama_kondisi'],
                'harga_saat_ini' => $highest['harga_penawaran'] ?? $b['harga_awal'],
                'total_bid'      => $totalBid,
                'waktu_tersisa'  => ($sisa > 0)
                    ? $jam.' jam '.$menit.' menit'
                    : 'Selesai'
            ];
        }

        return view('user/dashboard', $data);
    }
}
