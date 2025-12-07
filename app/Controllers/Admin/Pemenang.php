<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TransaksiPenawaranModel;
use App\Models\TransaksiPemenangModel;
use App\Models\TransaksiLelangModel;
use App\Models\UserModel;

class Pemenang extends BaseController
{
    protected $penawaran, $pemenang, $lelang, $user;

    public function __construct()
    {
        $this->penawaran = new TransaksiPenawaranModel();
        $this->pemenang  = new TransaksiPemenangModel();
        $this->lelang    = new TransaksiLelangModel();
        $this->user      = new UserModel();
    }

    // ================== LIST LELANG SELESAI ==================
    public function index()
    {
        $data['lelang'] = $this->lelang
            ->select('transaksi_lelang.*, barang.nama_barang, barang.foto, barang.harga_awal')
            ->join('barang','barang.id_barang=transaksi_lelang.id_barang')
            ->where('transaksi_lelang.status','selesai')
            ->findAll();
        
        return view('admin/pemenang/index',$data);
    }

    // ================== TENTUKAN PEMENANG ==================
    public function pilih($id_lelang)
    {
        $winner = $this->penawaran
            ->select('transaksi_penawaran.*, users.nama')
            ->join('users','users.id_user=transaksi_penawaran.id_user')
            ->where('id_lelang',$id_lelang)
            ->orderBy('harga_penawaran','DESC')
            ->first();

        if(!$winner){
            return redirect()->back()->with('error','⚠ Tidak ada penawaran pada lelang ini.');
        }

        // simpan pemenang
        $this->pemenang->save([
            'id_lelang'     => $id_lelang,
            'id_user'       => $winner['id_user'],
            'harga_menang'  => $winner['harga_penawaran'],
            'tanggal_menang'=> date('Y-m-d H:i:s')
        ]);

        // update status lelang --> tetap selesai
        $this->lelang->update($id_lelang, ['status' => 'selesai']);

        return redirect()->to('/admin/pemenang')
                        ->with('success','🏆 Pemenang berhasil ditentukan: '.$winner['nama']);
    }

}
