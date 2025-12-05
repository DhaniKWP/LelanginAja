<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BarangModel;

class Barang extends BaseController
{
    public function index()
    {
        $model = new BarangModel();
        $data['barang'] = $model->findAll();
        return view('admin/barang/index',$data);
    }

    public function approve($id)
    {
        (new BarangModel())->update($id,['status_pengajuan'=>'approved','status'=>'aktif']);
        return redirect()->back()->with('success','Barang berhasil di-approve & siap lelang.');
    }

    public function reject($id)
    {
        (new BarangModel())->update($id,['status_pengajuan'=>'rejected']);
        return redirect()->back()->with('success','Barang ditolak.');
    }
}
