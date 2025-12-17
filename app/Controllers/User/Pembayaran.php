<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;
use App\Models\TransaksiPemenangModel;

class Pembayaran extends BaseController
{
    protected $pemenang, $pembayaran;

    public function __construct()
    {
        $this->pemenang   = new TransaksiPemenangModel();
        $this->pembayaran = new PembayaranModel();
    }

    public function form($id_pemenang)
    {
        $data['pemenang'] = $this->pemenang->find($id_pemenang);
        return view('user/lelang/pembayaran_form', $data);
    }

    public function submit($id_pemenang)
    {
        $file = $this->request->getFile('bukti_transfer');
        $nama = $file->getRandomName();
        $file->move('uploads/bukti/', $nama);

        $this->pembayaran->save([
            'id_pemenang'   => $id_pemenang,
            'metode'        => $this->request->getPost('metode'),
            'bukti_transfer'=> $nama,
            'status'        => 'pending',
            'tanggal_bayar' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/user/pemenang')
            ->with('success', 'Pembayaran berhasil dikirim! Menunggu verifikasi admin.');
    }
}
