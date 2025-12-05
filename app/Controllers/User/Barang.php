<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\KondisiModel;

class Barang extends BaseController
{
    public function index()
    {
        $model = new BarangModel();
        $data['barang'] = $model->where('id_user',session('id_user'))->findAll();
        return view('user/barang/index',$data);
    }

    public function create()
    {
        $data = [
            'kategori' => (new KategoriModel())->findAll(),
            'kondisi'  => (new KondisiModel())->findAll()
        ];
        return view('user/barang/create',$data);
    }

    public function store()
    {
        $file = $this->request->getFile('foto');
        $namaFoto = $file->getRandomName();
        $file->move('uploads/barang/',$namaFoto);

        $model = new BarangModel();
        $model->save([
            'nama_barang' => $this->request->getPost('nama_barang'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'kondisi_id'  => $this->request->getPost('kondisi_id'),
            'id_user'     => session('id_user'),
            'harga_awal'  => $this->request->getPost('harga_awal'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'foto'        => $namaFoto,
            'tanggal_pengajuan' => date('Y-m-d H:i:s'),
            'status_pengajuan'  => 'pending',
            'status' => 'nonaktif'
        ]);

        return redirect()->to('/user/barang')->with('success','Barang berhasil diajukan, menunggu verifikasi admin.');
    }
}
