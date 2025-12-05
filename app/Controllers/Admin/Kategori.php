<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class Kategori extends BaseController
{
    public function index()
    {
        $model = new KategoriModel();
        $data['kategori'] = $model->findAll();

        return view('admin/kategori/index', $data);
    }

    public function create()
    {
        return view('admin/kategori/create');
    }

    public function store()
    {
        $model = new KategoriModel();
        $model->insert([
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);

        return redirect()->to('/admin/kategori')->with('success','Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $model = new KategoriModel();
        $data['kategori'] = $model->find($id);

        return view('admin/kategori/edit', $data);
    }

    public function update($id)
    {
        $model = new KategoriModel();
        $model->update($id, [
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);

        return redirect()->to('/admin/kategori')->with('success','Kategori berhasil diperbarui');
    }

    public function delete($id)
    {
        $model = new KategoriModel();
        $model->delete($id);

        return redirect()->to('/admin/kategori')->with('success','Kategori berhasil dihapus');
    }
}
