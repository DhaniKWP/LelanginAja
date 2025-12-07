<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\TransaksiLelangModel;
use App\Models\BarangModel;
use App\Models\PesertaModel;
use App\Models\TransaksiPenawaranModel;

class Lelang extends BaseController
{
    protected $lelang, $barang, $peserta, $penawaran;

    public function __construct()
    {
        $this->lelang    = new TransaksiLelangModel();
        $this->barang    = new BarangModel();
        $this->peserta   = new PesertaModel();
        $this->penawaran = new TransaksiPenawaranModel();
    }

    // ================== LIST LELANG AKTIF ==================
    public function aktif()
    {
        $data['lelang'] = $this->lelang->select('transaksi_lelang.*, barang.nama_barang, barang.harga_awal, barang.foto')
                                       ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
                                       ->where('transaksi_lelang.status','aktif')
                                       ->orderBy('id_lelang','DESC')
                                       ->findAll();

        return view('user/lelang/aktif', $data);
    }

    // ================== DETAIL LELANG ==================
    public function detail($id_lelang)
    {
        $userId = session()->get('id_user');

        // ambil data lelang + barang
        $data['lelang'] = $this->lelang->select('transaksi_lelang.*, barang.nama_barang, barang.harga_awal, barang.deskripsi, barang.foto, transaksi_lelang.tanggal_selesai')
                                       ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
                                       ->where('transaksi_lelang.id_lelang', $id_lelang)
                                       ->first();

        if(!$data['lelang']){
            return redirect()->to('/user/lelang/aktif')->with('error','Data lelang tidak ditemukan');
        }

        // cek user sudah peserta?
        $data['isPeserta'] = $this->peserta->where('id_user',$userId)->first() ? true:false;

        // BID TERTINGGI (REAL)
        $data['maxBid'] = $this->penawaran->where('id_lelang',$id_lelang)
                                          ->orderBy('harga_penawaran','DESC')
                                          ->first();

        // RIWAYAT PENAWARAN REAL
        $data['riwayat'] = $this->penawaran->select('transaksi_penawaran.*, users.nama as nama_user')
                                           ->join('users','users.id_user = transaksi_penawaran.id_user')
                                           ->where('id_lelang',$id_lelang)
                                           ->orderBy('harga_penawaran','DESC')
                                           ->findAll();

        return view('user/lelang/detail', $data);
    }
}
