<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Config\Database;

class Laporan extends BaseController
{
    protected $barang;
    protected $db;

    public function __construct()
    {
        $this->barang = new BarangModel();
        $this->db = Database::connect();
    }

    // ================= LAPORAN BARANG =================
    public function barang()
    {
        $builder = $this->barang
            ->select('
                barang.nama_barang,
                barang.nama_kategori,
                users.nama AS nama_user,
                barang.harga_awal,
                barang.status_pengajuan,
                barang.tanggal_pengajuan
            ')
            ->join('users', 'users.id_user = barang.id_user');

        // ===== FILTER TANGGAL =====
        $start = $this->request->getGet('start_date');
        $end   = $this->request->getGet('end_date');

        if ($start && $end) {
            $builder->where('DATE(barang.tanggal_pengajuan) >=', $start)
                    ->where('DATE(barang.tanggal_pengajuan) <=', $end);
        }

        // ===== FILTER STATUS =====
        $status = $this->request->getGet('status');
        if ($status) {
            $builder->where('barang.status_pengajuan', $status);
        }

        $data = [
            'barang' => $builder
                ->orderBy('barang.tanggal_pengajuan', 'DESC')
                ->findAll(),

            // kirim balik ke view (biar form gak reset)
            'filter' => [
                'start_date' => $start,
                'end_date'   => $end,
                'status'     => $status
            ]
        ];

        return view('admin/laporan/barang', $data);
    }

    // ================= EXPORT PDF =================
    public function barangPdf()
    {
        $builder = $this->barang
            ->select('
                barang.nama_barang,
                barang.nama_kategori,
                users.nama AS nama_user,
                barang.harga_awal,
                barang.status_pengajuan,
                barang.tanggal_pengajuan
            ')
            ->join('users', 'users.id_user = barang.id_user');

        // FILTER TANGGAL
        $start  = $this->request->getGet('start_date');
        $end    = $this->request->getGet('end_date');
        $status = $this->request->getGet('status');

        if ($start && $end) {
            $builder->where('DATE(barang.tanggal_pengajuan) >=', $start)
                    ->where('DATE(barang.tanggal_pengajuan) <=', $end);
        }

        // FILTER STATUS
        if ($status) {
            $builder->where('barang.status_pengajuan', $status);
        }

        $data['barang'] = $builder
            ->orderBy('barang.tanggal_pengajuan', 'DESC')
            ->findAll();

        $html = view('admin/laporan/barang_pdf', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $dompdf->stream('laporan-barang.pdf', ['Attachment' => false]);
    }

    // ================= EXPORT EXCEL =================
    public function barangExcel()
    {
        $builder = $this->barang
            ->select('
                barang.nama_barang,
                barang.nama_kategori,
                users.nama AS nama_user,
                barang.harga_awal,
                barang.status_pengajuan,
                barang.tanggal_pengajuan
            ')
            ->join('users', 'users.id_user = barang.id_user');

        // FILTER TANGGAL
        $start  = $this->request->getGet('start_date');
        $end    = $this->request->getGet('end_date');
        $status = $this->request->getGet('status');

        if ($start && $end) {
            $builder->where('DATE(barang.tanggal_pengajuan) >=', $start)
                    ->where('DATE(barang.tanggal_pengajuan) <=', $end);
        }

        // FILTER STATUS
        if ($status) {
            $builder->where('barang.status_pengajuan', $status);
        }

        $barang = $builder
            ->orderBy('barang.tanggal_pengajuan', 'DESC')
            ->findAll();

        // ================= BUAT EXCEL =================
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // ================= JUDUL =================
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'LAPORAN DATA BARANG LELANG');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14
            ],
            'alignment' => [
                'horizontal' => 'center'
            ]
        ]);

        // ================= SUB JUDUL =================
        $sheet->mergeCells('A2:G2');
        $sheet->setCellValue('A2', 'Sistem Informasi Lelangin Aja');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

        // ================= PERIODE =================
        $sheet->mergeCells('A3:G3');
        $sheet->setCellValue(
            'A3',
            'Periode: ' .
            ($start && $end
                ? date('d M Y', strtotime($start)) . ' s/d ' . date('d M Y', strtotime($end))
                : 'Semua Periode'
            )
        );
        $sheet->getStyle('A3')->getAlignment()->setHorizontal('center');

        // JARAK
        $sheet->getRowDimension(4)->setRowHeight(10);

        // ================= HEADER TABLE =================
        $headerRow = 5;
        $sheet->fromArray([
            'No',
            'Nama Barang',
            'Kategori',
            'Pemilik',
            'Harga Awal',
            'Status',
            'Tanggal'
        ], null, 'A'.$headerRow);

        // STYLE HEADER
        $sheet->getStyle("A{$headerRow}:G{$headerRow}")->applyFromArray([
            'font' => [
                'bold' => true
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical'   => 'center'
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => 'E5E7EB'] // abu2
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin'
                ]
            ]
        ]);

        // ================= DATA =================
        $row = $headerRow + 1;
        $no  = 1;

        foreach ($barang as $b) {
            $sheet->fromArray([
                $no++,
                $b['nama_barang'],
                $b['nama_kategori'],
                $b['nama_user'],
                $b['harga_awal'],
                ucfirst($b['status_pengajuan']),
                date('d-m-Y', strtotime($b['tanggal_pengajuan']))
            ], null, 'A'.$row);

            // BORDER DATA
            $sheet->getStyle("A{$row}:G{$row}")->getBorders()
                ->getAllBorders()->setBorderStyle('thin');

            // FORMAT RUPIAH
            $sheet->getStyle("E{$row}")
                ->getNumberFormat()
                ->setFormatCode('#,##0');

            // ALIGN
            $sheet->getStyle("A{$row}:D{$row}")
                ->getAlignment()->setVertical('center');

            $sheet->getStyle("A{$row}")
                ->getAlignment()->setHorizontal('center');

            $sheet->getStyle("F{$row}:G{$row}")
                ->getAlignment()->setHorizontal('center');

            $row++;
        }

        // ================= TOTAL =================
        $sheet->mergeCells("A{$row}:D{$row}");
        $sheet->setCellValue("A{$row}", 'TOTAL BARANG');
        $sheet->setCellValue("E{$row}", count($barang));
        $sheet->mergeCells("F{$row}:G{$row}");

        // STYLE TOTAL ROW
        $sheet->getStyle("A{$row}:G{$row}")->applyFromArray([
            'font' => [
                'bold' => true
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical'   => 'center'
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => 'F3F4F6'] // abu muda
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'medium'
                ]
            ]
        ]);

        // ================= AUTO WIDTH =================
        foreach (range('A','G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // ================= EXPORT =================
        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan-barang.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function lelang()
{
    $builder = $this->db->table('transaksi_lelang')
        ->select('
            transaksi_lelang.id_lelang,
            barang.nama_barang,
            users.nama AS pemilik,
            transaksi_lelang.tanggal_mulai,
            transaksi_lelang.tanggal_selesai,
            barang.harga_awal,
            MAX(transaksi_penawaran.harga_penawaran) AS harga_tertinggi,
            COUNT(transaksi_penawaran.id_penawaran) AS total_penawaran,
            transaksi_lelang.status
        ')
        ->join('barang', 'barang.id_barang = transaksi_lelang.id_barang')
        ->join('users', 'users.id_user = barang.id_user')
        ->join(
            'transaksi_penawaran',
            'transaksi_penawaran.id_lelang = transaksi_lelang.id_lelang',
            'left'
        )
        ->groupBy('transaksi_lelang.id_lelang');

    // ===== FILTER TANGGAL =====
    $start = $this->request->getGet('start_date');
    $end   = $this->request->getGet('end_date');

    if ($start && $end) {
        $builder->where('DATE(transaksi_lelang.tanggal_mulai) >=', $start)
                ->where('DATE(transaksi_lelang.tanggal_mulai) <=', $end);
    }

    // ===== FILTER STATUS =====
    $status = $this->request->getGet('status');
    if ($status) {
        $builder->where('transaksi_lelang.status', $status);
    }

    // ===== FILTER HASIL =====
    $hasil = $this->request->getGet('hasil');
    if ($hasil == 'terjual') {
        $builder->having('harga_tertinggi IS NOT NULL');
    } elseif ($hasil == 'tidak') {
        $builder->having('harga_tertinggi IS NULL');
    }

    return view('admin/laporan/lelang', [
        'lelang' => $builder->get()->getResultArray(),
        'filter' => compact('start','end','status','hasil')
    ]);
}

}
