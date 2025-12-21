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
        ->select('
            transaksi_lelang.*,
            barang.nama_barang,
            barang.harga_awal,
            barang.foto,
            barang.nama_kategori
        ')
        ->join('barang', 'barang.id_barang = transaksi_lelang.id_barang')
        ->where('transaksi_lelang.status', 'aktif') // status belum di-stop admin
        ->where('transaksi_lelang.tanggal_selesai >', date('Y-m-d H:i:s')) // ⬅️ FILTER WAKTU
        ->orderBy('barang.nama_barang', 'ASC')
        ->findAll();

    return view('user/lelang/aktif', $data);
}

    // ------------------- DETAIL -------------------
    public function detail($id_lelang)
    {
        $userId = session()->get('id_user');

        $lelang = $this->lelang
            ->select('transaksi_lelang.*, barang.nama_barang, barang.harga_awal, barang.deskripsi, barang.foto, transaksi_lelang.tanggal_selesai')
            ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
            ->where('id_lelang', $id_lelang)
            ->first();

        if(!$lelang){
            return redirect()->to('/user/lelang/aktif')
                ->with('error','Data lelang tidak ditemukan');
        }

        // 🔴 CEK WAKTU HABIS ATAU BELUM
        $isExpired = (
            $lelang['status'] === 'selesai'
            || strtotime($lelang['tanggal_selesai']) <= time()
        );


        return view('user/lelang/detail', [
            'lelang'     => $lelang,
            'isExpired'  => $isExpired,

            // cek peserta
            'isPeserta'  => $this->peserta
                                ->where('id_user',$userId)
                                ->first() ? true : false,

            // bid tertinggi
            'maxBid'     => $this->penawaran
                                ->where('id_lelang',$id_lelang)
                                ->orderBy('harga_penawaran','DESC')
                                ->first(),

            // riwayat bid
            'riwayat'    => $this->penawaran
                                ->select('transaksi_penawaran.*, users.nama as nama_user')
                                ->join('users','users.id_user = transaksi_penawaran.id_user')
                                ->where('id_lelang',$id_lelang)
                                ->orderBy('harga_penawaran','DESC')
                                ->findAll()
        ]);
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

    // ------------------- JADWAL LELANG BARANG SAYA -------------------
    public function jadwalBarang()
    {
        $id_user = session()->get('id_user');

        $data['lelang'] = $this->lelang
            ->select('
                transaksi_lelang.*,
                barang.nama_barang,
                barang.foto,
                barang.harga_awal
            ')
            ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
            ->where('barang.id_user', $id_user)
            ->orderBy('tanggal_mulai','DESC')
            ->findAll();

        return view('user/barang/jadwal_lelang', $data);
    }
        // ------------------- HASIL LELANG BARANG SAYA -------------------
    public function hasilBarang()
    {
        $id_user = session()->get('id_user');

        $data['hasil'] = $this->lelang
            ->select('
                transaksi_lelang.id_lelang,
                barang.nama_barang,
                barang.foto,
                pemenang.harga_menang,
                users.nama AS nama_pemenang,
                pembayaran.status AS status_bayar
            ')
            ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
            ->join('transaksi_pemenang pemenang','pemenang.id_lelang = transaksi_lelang.id_lelang','left')
            ->join('users','users.id_user = pemenang.id_user','left')
            ->join('transaksi_pembayaran pembayaran','pembayaran.id_pemenang = pemenang.id_pemenang','left')
            ->where('barang.id_user', $id_user)
            ->where('transaksi_lelang.status','selesai')
            ->orderBy('transaksi_lelang.tanggal_selesai','DESC')
            ->findAll();

        return view('user/barang/hasil_lelang', $data);
    }

    // ------------------- MONITORING LELANG BARANG SAYA -------------------
    public function monitoringBarang($id_lelang)
    {
        $id_user = session()->get('id_user');

        // pastikan ini barang milik user
        $lelang = $this->lelang
            ->select('
                transaksi_lelang.*,
                barang.nama_barang,
                barang.foto
            ')
            ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
            ->where('barang.id_user', $id_user)
            ->where('transaksi_lelang.id_lelang', $id_lelang)
            ->first();

        if(!$lelang){
            return redirect()->back()->with('error','Lelang tidak ditemukan');
        }

        $penawaran = $this->penawaran
            ->select('transaksi_penawaran.*, users.nama')
            ->join('users','users.id_user = transaksi_penawaran.id_user')
            ->where('id_lelang',$id_lelang)
            ->orderBy('harga_penawaran','DESC')
            ->findAll();

        return view('user/lelang/monitoring', [
            'lelang'    => $lelang,
            'penawaran' => $penawaran
        ]);
    }
}
