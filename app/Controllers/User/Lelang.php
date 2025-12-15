<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\TransaksiLelangModel;
use App\Models\BarangModel;
use App\Models\PesertaModel;
use App\Models\TransaksiPenawaranModel;
use App\Models\TransaksiPemenangModel;

class Lelang extends BaseController
{
    protected $lelang, $barang, $peserta, $penawaran, $pemenang;

    public function __construct()
    {
        $this->lelang    = new TransaksiLelangModel();
        $this->barang    = new BarangModel();
        $this->peserta   = new PesertaModel();
        $this->penawaran = new TransaksiPenawaranModel();
        $this->pemenang  = new TransaksiPemenangModel();
    }

    // ------------------- LELANG AKTIF -------------------
    public function aktif()
    {
        $data['lelang'] = $this->lelang
            ->select('transaksi_lelang.*, barang.nama_barang, barang.harga_awal, barang.foto')
            ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
            ->where('transaksi_lelang.status','aktif')
            ->orderBy('id_lelang','DESC')
            ->findAll();

        return view('user/lelang/aktif', $data);
    }

    // ------------------- DETAIL -------------------
    public function detail($id_lelang)
    {
        $userId = session()->get('id_user');

        $data['lelang'] = $this->lelang
            ->select('transaksi_lelang.*, barang.nama_barang, barang.harga_awal, barang.deskripsi, barang.foto, transaksi_lelang.tanggal_selesai')
            ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
            ->where('id_lelang', $id_lelang)
            ->first();

        if(!$data['lelang']){
            return redirect()->to('/user/lelang/aktif')->with('error','Data lelang tidak ditemukan');
        }

        // cek peserta
        $data['isPeserta'] = $this->peserta->where('id_user',$userId)->first() ? true : false;

        // penawaran tertinggi real
        $data['maxBid'] = $this->penawaran->where('id_lelang',$id_lelang)
                                          ->orderBy('harga_penawaran','DESC')
                                          ->first();

        // riwayat penawaran real data
        $data['riwayat'] = $this->penawaran
            ->select('transaksi_penawaran.*, users.nama as nama_user')
            ->join('users','users.id_user = transaksi_penawaran.id_user')
            ->where('id_lelang',$id_lelang)
            ->orderBy('harga_penawaran','DESC')
            ->findAll();

        return view('user/lelang/detail', $data);
    }

    // ------------------- RIWAYAT PENAWARAN -------------------
    public function riwayat()
    {
        $id_user = session('id_user');

        // Ambil riwayat bid user + informasi barang
        $riwayat = $this->penawaran
            ->select('
                transaksi_penawaran.*,
                transaksi_lelang.id_lelang,
                barang.nama_barang
            ')
            ->join('transaksi_lelang', 'transaksi_lelang.id_lelang = transaksi_penawaran.id_lelang')
            ->join('barang', 'barang.id_barang = transaksi_lelang.id_barang')
            ->where('transaksi_penawaran.id_user', $id_user)
            ->orderBy('transaksi_penawaran.waktu_penawaran','DESC')
            ->findAll();

        // Tandai apakah bid ini yang tertinggi
        foreach ($riwayat as &$r) {
            $highest = $this->penawaran
                ->where('id_lelang',$r['id_lelang'])
                ->orderBy('harga_penawaran','DESC')
                ->first();

            $r['is_highest'] = ($highest && $highest['harga_penawaran'] == $r['harga_penawaran']) ? 1 : 0;
        }

        return view('user/lelang/riwayat', ['riwayat'=>$riwayat]);
    }
}
