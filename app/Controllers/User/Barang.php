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

    // =======================
    // LIST BARANG USER
    // =======================
    public function index()
    {
        $data['barang'] = $this->barang
            ->select('
                barang.*,
                transaksi_lelang.id_lelang,
                transaksi_lelang.status AS status_lelang,
                transaksi_lelang.tanggal_mulai,
                transaksi_lelang.tanggal_selesai
            ')
            ->join(
                'transaksi_lelang',
                'transaksi_lelang.id_barang = barang.id_barang',
                'left'
            )
            ->where('barang.id_user', session('id_user'))
            ->orderBy('barang.id_barang','DESC')
            ->findAll();

        return view('user/barang/index', $data);
    }

    // =======================
    // CREATE BARANG
    // =======================
    public function create()
    {
        return view('user/barang/create', [
            'mode'         => 'create',
            'barang'       => null,
            'kategoriList' => ['Properti','Roda Dua','Roda Empat','Elektronik','Fashion'],
            'kondisi'      => $this->kondisi->findAll()
        ]);
    }

    // =======================
    // STORE BARANG
    // =======================
    public function store()
    {
        $file = $this->request->getFile('foto');

        if (!$file || !$file->isValid()) {
            return redirect()->back()
                ->withInput()
                ->with('error','Foto barang wajib diupload');
        }

        $namaFoto = $file->getRandomName();
        $file->move('uploads/barang/', $namaFoto);

        $this->barang->insert([
            'nama_barang'       => $this->request->getPost('nama_barang'),
            'nama_kategori'     => $this->request->getPost('nama_kategori'),
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
            ->with('success','Barang berhasil diajukan. Menunggu verifikasi admin.');
    }

    // =======================
    // EDIT / AJUKAN ULANG
    // =======================
    public function edit($id)
    {
        $barang = $this->barang
            ->where('id_barang', $id)
            ->where('id_user', session('id_user'))
            ->first();

        if (!$barang) {
            return redirect()->to('/user/barang')
                ->with('error','Barang tidak ditemukan');
        }

        // hanya boleh edit jika REJECTED
        if ($barang['status_pengajuan'] !== 'rejected') {
            return redirect()->to('/user/barang')
                ->with('error','Barang ini tidak dapat diedit');
        }

        return view('user/barang/create', [
            'mode'         => 'edit',
            'barang'       => $barang,
            'kategoriList' => ['Properti','Roda Dua','Roda Empat','Elektronik','Fashion'],
            'kondisi'      => $this->kondisi->findAll()
        ]);
    }

    // =======================
    // UPDATE / SUBMIT ULANG
    // =======================
    public function update($id)
    {
        $barang = $this->barang
            ->where('id_barang', $id)
            ->where('id_user', session('id_user'))
            ->first();

        if (!$barang) {
            return redirect()->to('/user/barang')
                ->with('error','Barang tidak ditemukan');
        }

        if ($barang['status_pengajuan'] !== 'rejected') {
            return redirect()->to('/user/barang')
                ->with('error','Barang ini tidak dapat diajukan ulang');
        }

        $data = [
            'nama_barang'        => $this->request->getPost('nama_barang'),
            'nama_kategori'      => $this->request->getPost('nama_kategori'),
            'kondisi_id'         => $this->request->getPost('kondisi_id'),
            'harga_awal'         => $this->request->getPost('harga_awal'),
            'deskripsi'          => $this->request->getPost('deskripsi'),
            'status_pengajuan'   => 'pending', // reset
            'tanggal_pengajuan'  => date('Y-m-d H:i:s')
        ];

        // upload foto baru (opsional)
        $file = $this->request->getFile('foto');
        if ($file && $file->isValid()) {
            $namaFoto = $file->getRandomName();
            $file->move('uploads/barang/', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $this->barang->update($id, $data);

        return redirect()->to('/user/barang')
            ->with('success','Barang berhasil diajukan ulang. Menunggu verifikasi admin.');
    }
}
