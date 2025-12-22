<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\TransaksiLelangModel;
use App\Models\TransaksiPenawaranModel;
use App\Models\TransaksiPemenangModel;

class Lelang extends BaseController
{
    protected $lelang;
    protected $barang;
    protected $penawaran;
    protected $pemenang;

    public function __construct()
    {
        $this->lelang     = new TransaksiLelangModel();
        $this->barang     = new BarangModel();
        $this->penawaran  = new TransaksiPenawaranModel();
        $this->pemenang  = new TransaksiPemenangModel();
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
    $data['barang'] = $this->barang
        ->where('status_pengajuan', 'approved')
        ->whereNotIn('id_barang', function($builder){
            $builder->select('id_barang')
                    ->from('transaksi_lelang');
        })
        ->orderBy('id_barang', 'DESC')
        ->find();

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
       4. EDIT LELANG
    ======================================================== */
    public function edit($id)
    {
        $data['lelang'] = $this->lelang
            ->select('transaksi_lelang.*, barang.nama_barang')
            ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
            ->find($id);

        if(!$data['lelang']) return redirect()->back()->with('error','Data tidak ditemukan');

        $data['barang'] = $this->barang->where('status_pengajuan','approved')->findAll();

        return view('admin/lelang/edit', $data);
    }

    /* ========================================================
       5. UPDATE LELANG
    ======================================================== */
    public function update($id)
    {
        $this->lelang->update($id,[
            'id_barang'       => $this->request->getPost('id_barang'),
            'tanggal_mulai'   => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
            'status'          => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/lelang/jadwal')->with('success','Lelang berhasil diperbarui!');
    }

    /* ========================================================
       6. DELETE LELANG
    ======================================================== */
    public function delete($id)
    {
        // Hapus penawaran lelang yang terkait
        $this->penawaran->where('id_lelang',$id)->delete();

        // Hapus jadwal lelang
        $this->lelang->delete($id);

        return redirect()->back()->with('success','Lelang berhasil dihapus!');
    }

    /* ========================================================
       7. LELANG AKTIF
    ======================================================== */
    public function aktif()
    {
        $filter = $this->request->getGet('filter'); // running | expired
        $now = time();

        $lelang = $this->lelang
            ->select('transaksi_lelang.*, barang.nama_barang, barang.harga_awal, barang.foto')
            ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
            ->where('transaksi_lelang.status','aktif')
            ->orderBy('transaksi_lelang.tanggal_selesai','ASC')
            ->findAll();

        $data['lelang'] = [];

        foreach ($lelang as $l) {
            $isExpired = strtotime($l['tanggal_selesai']) <= $now;

            // FILTER
            if ($filter === 'running' && $isExpired) continue;
            if ($filter === 'expired' && !$isExpired) continue;

            // Highest bid
            $highest = $this->penawaran
                ->where('id_lelang',$l['id_lelang'])
                ->orderBy('harga_penawaran','DESC')
                ->first();

            $l['highest_bid'] = $highest
                ? $highest['harga_penawaran']
                : null;
            $l['is_expired']  = $isExpired;

            $data['lelang'][] = $l;
        }

        return view('admin/lelang/aktif',$data);
    }

    /* ========================================================
       8. STOP LELANG
    ======================================================== */
    public function stop($id)
    {
        // Ambil data lelang
        $lelang = $this->lelang->find($id);
        if (!$lelang) {
            return redirect()->back()->with('error', 'Lelang tidak ditemukan.');
        }

        // Cegah stop dua kali
        if ($lelang['status'] === 'selesai') {
            return redirect()->back()->with('info', 'Lelang sudah selesai.');
        }

        // Ambil bid tertinggi
        $winner = $this->penawaran
            ->where('id_lelang', $id)
            ->orderBy('harga_penawaran', 'DESC')
            ->first();

        // Jika ada penawaran → simpan pemenang
        if ($winner) {
            $exists = $this->pemenang
                ->where('id_lelang', $id)
                ->first();

            if (!$exists) {
                $this->pemenang->insert([
                    'id_lelang'      => $id,
                    'id_user'        => $winner['id_user'],
                    'harga_menang'   => $winner['harga_penawaran'],
                    'tanggal_menang' => date('Y-m-d H:i:s'),
                ]);
            }
        }

        // Update status lelang
        $this->lelang->update($id, [
            'status' => 'selesai'
        ]);

        return redirect()->back()->with(
            'success',
            $winner
                ? 'Lelang dihentikan & pemenang otomatis ditentukan.'
                : 'Lelang dihentikan (tidak ada penawaran).'
        );
    }

    /* ========================================================
       9. MONITORING REALTIME
    ======================================================== */
    public function monitoring($id)
    {
        $data['lelang'] = $this->lelang
            ->select('transaksi_lelang.*, barang.nama_barang, barang.foto')
            ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
            ->find($id);

        $data['penawaran'] = $this->penawaran
            ->select('
                transaksi_penawaran.*,
                users.nama
            ')
            ->join('users', 'users.id_user = transaksi_penawaran.id_user')
            ->where('transaksi_penawaran.id_lelang', $id)
            ->orderBy('transaksi_penawaran.harga_penawaran', 'DESC')
            ->findAll();


        return view('admin/lelang/monitoring', $data);
    }
}
