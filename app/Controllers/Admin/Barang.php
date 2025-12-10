<?php

namespace App\Controllers\Admin;

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

    public function index()
    {
        $data['barang'] = $this->barang->orderBy('id_barang','DESC')->findAll();
        return view('admin/barang/index', $data);
    }

    /* ======================
    | FORM EDIT BARANG
    =======================*/
    public function edit($id)
    {
        $data['barang']  = $this->barang->find($id);
        $data['kondisi'] = $this->kondisi->findAll();

        // kategori list fix 5 opsi (karena tabel kategori dihapus)
        $data['kategoriList'] = [
            'Properti',
            'Roda Dua',
            'Roda Empat',
            'Elektronik',
            'Fashion'
        ];

        return view('admin/barang/edit', $data);
    }

    /* ======================
    | UPDATE BARANG
    =======================*/
    public function update($id)
    {
        $file = $this->request->getFile('foto');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/barang/', $newName);
            $foto = $newName;
        } else {
            $foto = $this->request->getPost('foto_lama');
        }

        $this->barang->update($id, [
            'nama_barang'      => $this->request->getPost('nama_barang'),
            'nama_kategori'    => $this->request->getPost('nama_kategori'),
            'kondisi_id'       => $this->request->getPost('kondisi_id'),
            'harga_awal'       => $this->request->getPost('harga_awal'),
            'deskripsi'        => $this->request->getPost('deskripsi'),
            'status_pengajuan' => $this->request->getPost('status_pengajuan'),
            'foto'             => $foto
        ]);

        return redirect()->to('/admin/barang')->with('success','Data barang berhasil diperbarui!');
    }

    /* ======================
    | DELETE BARANG
    =======================*/
    public function delete($id)
    {
        $this->barang->delete($id);
        return redirect()->back()->with('success','Barang berhasil dihapus!');
    }

    /* ======================
    | LIST PENGAJUAN PENDING
    =======================*/
    public function pengajuan()
    {
        $data['barang'] = $this->barang->where('status_pengajuan','pending')->findAll();
        return view('admin/pengajuanbarang/index',$data);
    }

    /* ======================
    | APPROVE / REJECT
    =======================*/
    public function approve($id)
    {
        $this->barang->update($id,['status_pengajuan'=>'approved']);
        return redirect()->back()->with('success','Barang disetujui! silakan buat jadwal lelang.');
    }

    public function reject($id)
    {
        $this->barang->update($id,['status_pengajuan'=>'rejected']);
        return redirect()->back()->with('success','Barang ditolak!');
    }
}
