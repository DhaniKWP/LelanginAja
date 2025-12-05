<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KondisiModel;

class Kondisi extends BaseController
{
    public function index()
    {
        $model = new KondisiModel();
        $data['kondisi'] = $model->findAll();
        return view('admin/kondisi/index', $data);
    }

    public function create()
    {
        return view('admin/kondisi/create');
    }

    public function store()
    {
        $model = new KondisiModel();
        $model->save([
            'nama_kondisi' => $this->request->getPost('nama_kondisi')
        ]);

        return redirect()->to('/admin/kondisi')->with('success','Kondisi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $model = new KondisiModel();
        $data['kondisi'] = $model->find($id);
        return view('admin/kondisi/edit', $data);
    }

    public function update($id)
    {
        $model = new KondisiModel();
        $model->update($id,[
            'nama_kondisi' => $this->request->getPost('nama_kondisi')
        ]);

        return redirect()->to('/admin/kondisi')->with('success','Kondisi berhasil diperbarui');
    }

    public function delete($id)
    {
        $model = new KondisiModel();
        $model->delete($id);

        return redirect()->to('/admin/kondisi')->with('success','Kondisi berhasil dihapus');
    }
}
