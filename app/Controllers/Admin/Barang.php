<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\KondisiModel;

class Barang extends BaseController
{
    protected $barang, $kategori, $kondisi;

    public function __construct()
    {
        $this->barang = new BarangModel();
        $this->kategori = new KategoriModel();
        $this->kondisi = new KondisiModel();
    }

    /* ======================
    |  LIST SEMUA BARANG
    =======================*/
    public function index()
    {
        $data['barang'] = $this->barang->orderBy('id_barang','DESC')->findAll();
        return view('admin/barang/index', $data);
    }

    /* ======================
    |  FORM EDIT BARANG
    =======================*/
    public function edit($id)
    {
        $data['barang']   = $this->barang->find($id);
        $data['kategori'] = $this->kategori->findAll();
        $data['kondisi']  = $this->kondisi->findAll();

        return view('admin/barang/edit', $data);
    }

    /* ======================
    |  UPDATE BARANG
    =======================*/
    public function update($id)
    {
        $file = $this->request->getFile('foto');

        // cek foto update atau tidak
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/barang/', $newName);
            $foto = $newName;
        } else {
            $foto = $this->request->getPost('foto_lama'); // tetap pakai foto lama
        }

        $this->barang->update($id, [
            'nama_barang'      => $this->request->getPost('nama_barang'),
            'kategori_id'      => $this->request->getPost('kategori_id'),
            'kondisi_id'       => $this->request->getPost('kondisi_id'),
            'harga_awal'       => $this->request->getPost('harga_awal'),
            'deskripsi'        => $this->request->getPost('deskripsi'),
            'tanggal_mulai'    => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai'  => $this->request->getPost('tanggal_selesai'),
            'status_pengajuan' => $this->request->getPost('status_pengajuan'),
            'status'           => $this->request->getPost('status'),
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
    | PENGAJUAN PENDING PAGE
    =======================*/
    public function pengajuan()
    {
        $data['barang'] = $this->barang->where('status_pengajuan','pending')->findAll();
        return view('admin/pengajuanbarang/index',$data);
    }

    public function approve($id)
    {
        $this->barang->update($id,['status_pengajuan'=>'approved']);
        return redirect()->back()->with('success','Barang berhasil disetujui!');
    }

    public function reject($id)
    {
        $this->barang->update($id,['status_pengajuan'=>'rejected']);
        return redirect()->back()->with('success','Barang ditolak!');
    }
}

