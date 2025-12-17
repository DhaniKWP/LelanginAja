<?php
namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\TransaksiPemenangModel;
use App\Models\PembayaranModel;
use App\Models\BarangModel;
use App\Models\TransaksiLelangModel;

class Pemenang extends BaseController
{
    protected $pemenang, $pembayaran, $barang, $lelang;

    public function __construct()
    {
        $this->pemenang   = new TransaksiPemenangModel();
        $this->pembayaran = new PembayaranModel();
        $this->barang     = new BarangModel();
        $this->lelang     = new TransaksiLelangModel();
    }

    public function status()
{
    $id_user = session()->get('id_user');

    $data['pemenang'] = $this->pemenang
        ->select('
            transaksi_pemenang.id_pemenang,
            transaksi_pemenang.harga_menang,
            barang.nama_barang,

            transaksi_pembayaran.metode,
            transaksi_pembayaran.status AS status_bayar,
            transaksi_pembayaran.bukti_transfer,
            transaksi_pembayaran.tanggal_bayar
        ')
        ->join('transaksi_lelang','transaksi_lelang.id_lelang = transaksi_pemenang.id_lelang')
        ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
        ->join(
            'transaksi_pembayaran',
            'transaksi_pembayaran.id_pemenang = transaksi_pemenang.id_pemenang',
            'left'
        )
        ->where('transaksi_pemenang.id_user', $id_user)
        ->orderBy('transaksi_pemenang.tanggal_menang','DESC')
        ->findAll();

    return view('user/lelang/status_pemenang', $data);
}

}
