<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\KondisiModel;

class Barang extends BaseController
{
    protected $barang, $kondisi;

    public function __construct()
    {
        $this->barang  = new BarangModel();
        $this->kondisi = new KondisiModel();
    }

    /* ========================
    | BARANG SAYA
    =========================*/
    public function index()
    {
        $data['barang'] = $this->barang
                            ->where('id_user', session('id_user'))
                            ->orderBy('id_barang','DESC')
                            ->findAll();

        return view('user/barang/index',$data);
    }

    /* ========================
    | FORM AJUKAN BARANG
    =========================*/
    public function create()
    {
        $data = [
            'kategoriList' => ['Properti','Roda Dua','Roda Empat','Elektronik','Fashion'],
            'kondisi'      => $this->kondisi->findAll()
        ];

        return view('user/barang/create',$data);
    }

    /* ========================
    | SIMPAN BARANG USER
    =========================*/
    public function store()
    {
        $file = $this->request->getFile('foto');
        $namaFoto = $file->getRandomName();
        $file->move('uploads/barang/', $namaFoto);

        $this->barang->save([
            'nama_barang'       => $this->request->getPost('nama_barang'),
            'nama_kategori'   => $this->request->getPost('nama_kategori'),
            'kondisi_id'        => $this->request->getPost('kondisi_id'),
            'id_user'           => session('id_user'),
            'harga_awal'        => $this->request->getPost('harga_awal'),
            'deskripsi'         => $this->request->getPost('deskripsi'),
            'foto'              => $namaFoto,
            'tanggal_pengajuan' => date('Y-m-d H:i:s'),
            'status_pengajuan'  => 'pending',
            'status'            => 'nonaktif'
        ]);

        return redirect()->to('/user/barang')
            ->with('success','Barang berhasil diajukan! Menunggu verifikasi admin.');
    }
}
