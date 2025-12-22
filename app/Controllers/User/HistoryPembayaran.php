<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;

class HistoryPembayaran extends BaseController
{
    protected $pembayaranModel;

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
    }

    /**
     * List history pembayaran user (status = paid)
     */
    public function index()
    {
        $id_user = session()->get('id_user');

        $data['history'] = $this->pembayaranModel
            ->where('id_pemenang', $id_user)
            ->where('status', 'paid')
            ->orderBy('tanggal_bayar', 'DESC')
            ->findAll();

        return view('user/pembayaran/history', $data);
    }

    /**
     * Detail pembayaran
     */
    public function detail($id_bayar)
    {
        $id_user = session()->get('id_user');

        $data['pembayaran'] = $this->pembayaranModel
            ->where('id_bayar', $id_bayar)
            ->where('id_pemenang', $id_user)
            ->first();

        if (!$data['pembayaran']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Data pembayaran tidak ditemukan'
            );
        }

        return view('user/pembayaran/detail', $data);
    }

}
