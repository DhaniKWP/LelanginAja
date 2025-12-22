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
        // Cek apakah sudah ada data pembayaran untuk pemenang ini
        $existing = $this->pembayaran
            ->where('id_pemenang', $id_pemenang)
            ->first();

        // Upload file
        $file = $this->request->getFile('bukti_transfer');

        if (!$file || !$file->isValid()) {
            return redirect()->back()
                ->with('error', 'File bukti pembayaran tidak valid.');
        }

        $namaFile = $file->getRandomName();
        $file->move('uploads/bukti/', $namaFile);

        // =============================
        // JIKA SUDAH ADA PEMBAYARAN
        // =============================
        if ($existing) {

            // ❌ Tidak boleh update kalau sudah PAID
            if ($existing['status'] === 'paid') {
                return redirect()->to('/user/pemenang')
                    ->with('error', 'Pembayaran sudah diverifikasi.');
            }

            // ❌ Tidak boleh update kalau masih PENDING
            if ($existing['status'] === 'pending') {
                return redirect()->to('/user/pemenang')
                    ->with('error', 'Pembayaran sedang menunggu verifikasi admin.');
            }

            // ✅ STATUS = REJECTED → UPDATE
            $this->pembayaran->update($existing['id_bayar'], [
                'metode'         => $this->request->getPost('metode'),
                'bukti_transfer' => $namaFile,
                'status'         => 'pending',
                'tanggal_bayar'  => date('Y-m-d H:i:s'),
            ]);

            return redirect()->to('/user/pemenang')
                ->with('success', 'Bukti pembayaran berhasil diperbarui. Menunggu verifikasi admin.');
        }

        // =============================
        // JIKA BELUM PERNAH BAYAR
        // =============================
        $this->pembayaran->insert([
            'id_pemenang'    => $id_pemenang,
            'metode'         => $this->request->getPost('metode'),
            'bukti_transfer' => $namaFile,
            'status'         => 'pending',
            'tanggal_bayar'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/user/pemenang')
            ->with('success', 'Pembayaran berhasil dikirim. Menunggu verifikasi admin.');
    }
}
