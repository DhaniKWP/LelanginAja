<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class Kategori extends BaseController
{
    protected $kategori;

    public function __construct()
    {
        $this->kategori = new KategoriModel();
    }

    public function index()
    {
        $data['kategori'] = $this->kategori->findAll();
        return view('admin/kategori/index', $data);
    }

    public function create()
    {
        return view('admin/kategori/create');
    }

    public function store()
    {
        $this->kategori->save([
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);

        return redirect()->to('/admin/kategori')->with('success','Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['kategori'] = $this->kategori->find($id);
        return view('admin/kategori/edit', $data);
    }

    public function update($id)
    {
        $this->kategori->update($id, [
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);

        return redirect()->to('/admin/kategori')->with('success','Kategori berhasil diupdate');
    }

    public function delete($id)
    {
        $this->kategori->delete($id);
        return redirect()->to('/admin/kategori')->with('success','Kategori berhasil dihapus');
    }
}
