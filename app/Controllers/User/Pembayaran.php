<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;
use App\Models\TransaksiLelangModel;

class Pembayaran extends BaseController
{
    protected $lelang, $pembayaran;

    public function __construct()
    {
        $this->lelang     = new TransaksiLelangModel();
        $this->pembayaran = new PembayaranModel();
    }

    public function form($id_lelang)
    {
        $data['lelang'] = $this->lelang
            ->select('
                transaksi_lelang.id_lelang,
                barang.nama_barang,
                barang.harga_awal
            ')
            ->join('barang', 'barang.id_barang = transaksi_lelang.id_barang')
            ->where('transaksi_lelang.id_lelang', $id_lelang)
            ->first();

        if (!$data['lelang']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Data lelang tidak ditemukan'
            );
        }

        return view('user/lelang/pembayaran_form', $data);
    }

    public function submit($id_lelang)
    {
        $id_user = session()->get('id_user');

        // 🔑 AMBIL DATA PEMENANG (INI KUNCI)
        $pemenang = $this->db->table('transaksi_pemenang')
            ->where('id_lelang', $id_lelang)
            ->where('id_user', $id_user)
            ->get()
            ->getRowArray();

        if (!$pemenang) {
            return redirect()->back()
                ->with('error', 'Data pemenang tidak ditemukan.');
        }

        // 🔑 CEK PEMBAYARAN PER LELANG + PEMENANG
        $existing = $this->pembayaran
            ->where('id_pemenang', $pemenang['id_pemenang'])
            ->where('id_lelang', $id_lelang)
            ->first();

        $file = $this->request->getFile('bukti_transfer');

        if (!$file || !$file->isValid()) {
            return redirect()->back()
                ->with('error', 'File bukti pembayaran tidak valid.');
        }

        $namaFile = $file->getRandomName();
        $file->move('uploads/bukti/', $namaFile);

        // =========================
        // UPDATE (REJECTED)
        // =========================
        if ($existing) {

            if ($existing['status'] === 'paid') {
                return redirect()->to('/user/pemenang')
                    ->with('error', 'Pembayaran sudah diverifikasi.');
            }

            if ($existing['status'] === 'pending') {
                return redirect()->to('/user/pemenang')
                    ->with('error', 'Pembayaran sedang menunggu verifikasi admin.');
            }

            // rejected → update
            $this->pembayaran->update($existing['id_bayar'], [
                'metode'         => $this->request->getPost('metode'),
                'bukti_transfer' => $namaFile,
                'status'         => 'pending',
                'tanggal_bayar'  => date('Y-m-d H:i:s'),
            ]);

            return redirect()->to('/user/pemenang')
                ->with('success', 'Bukti pembayaran berhasil diperbarui.');
        }

        // =========================
        // INSERT BARU (BENAR)
        // =========================
        $this->pembayaran->insert([
            'id_pemenang'    => $pemenang['id_pemenang'], // ✅ BENAR
            'id_lelang'      => $id_lelang,
            'metode'         => $this->request->getPost('metode'),
            'bukti_transfer' => $namaFile,
            'status'         => 'pending',
            'tanggal_bayar'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/user/pemenang')
            ->with('success', 'Pembayaran berhasil dikirim. Menunggu verifikasi admin.');
    }
}
