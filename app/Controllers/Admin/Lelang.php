<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\TransaksiLelangModel;
use App\Models\TransaksiPenawaranModel;

class Lelang extends BaseController
{
    protected $lelang;
    protected $barang;
    protected $penawaran;

    public function __construct()
    {
        $this->lelang     = new TransaksiLelangModel();
        $this->barang     = new BarangModel();
        $this->penawaran  = new TransaksiPenawaranModel();
    }

    /* ========================================================
       1. JADWAL LELANG (LIST)
    ======================================================== */
    public function jadwal()
    {
        $data['lelang'] = $this->lelang
            ->select('transaksi_lelang.*, barang.nama_barang, barang.foto')
            ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
            ->orderBy('tanggal_mulai','DESC')
            ->findAll();

        return view('admin/lelang/jadwal', $data);
    }

    /* ========================================================
       2. FORM BUAT JADWAL LELANG
    ======================================================== */
    public function create()
    {
        $data['barang'] = $this->barang->where('status_pengajuan','approved')->findAll();
        return view('admin/lelang/create', $data);
    }

    /* ========================================================
       3. SIMPAN DATA LELANG
    ======================================================== */
    public function store()
    {
        $this->lelang->save([
            'id_barang'       => $this->request->getPost('id_barang'),
            'tanggal_mulai'   => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
            'status'          => 'aktif',
        ]);

        return redirect()->to('/admin/lelang/jadwal')->with('success','Jadwal lelang berhasil dibuat!');
    }


    /* ========================================================
       4. LELANG AKTIF
    ======================================================== */
    public function aktif()
    {
        $data['lelang'] = $this->lelang
            ->select('transaksi_lelang.*, barang.nama_barang, barang.harga_awal, barang.foto')
            ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
            ->where('transaksi_lelang.status','aktif')
            ->findAll();

        // ambil highest bid
        foreach($data['lelang'] as &$l){
            $highest = $this->penawaran->where('id_lelang',$l['id_lelang'])
                                      ->orderBy('harga_penawaran','DESC')
                                      ->first();

            $l['highest_bid'] = $highest['harga_penawaran'] ?? $l['harga_awal'];
        }

        return view('admin/lelang/aktif',$data);
    }


    /* ========================================================
       5. STOP LELANG
    ======================================================== */
    public function stop($id)
    {
        $this->lelang->update($id, ['status'=>'selesai']);
        return redirect()->back()->with('success','Lelang dihentikan.');
    }


    /* ========================================================
       6. MONITORING LELANG (REALTIME VIEW)
       Nanti kita isi penawaran realtime
    ======================================================== */
    public function monitoring($id)
    {
        $data['lelang'] = $this->lelang
            ->select('transaksi_lelang.*, barang.nama_barang, barang.foto')
            ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
            ->find($id);

        $data['penawaran'] = $this->penawaran
            ->where('id_lelang',$id)
            ->orderBy('harga_penawaran','DESC')
            ->findAll();

        return view('admin/lelang/monitoring', $data);
    }
}
