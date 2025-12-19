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

    // ===== FILTER =====
    $start  = $this->request->getGet('start_date');
    $end    = $this->request->getGet('end_date');
    $status = $this->request->getGet('status');

    if ($start && $end) {
        $builder->where('DATE(barang.tanggal_pengajuan) >=', $start)
                ->where('DATE(barang.tanggal_pengajuan) <=', $end);
    }

    if ($status) {
        $builder->where('barang.status_pengajuan', $status);
    }

    $barang = $builder
        ->orderBy('barang.tanggal_pengajuan', 'DESC')
        ->findAll();

    // ================= EXCEL =================
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    /* ================= JUDUL ================= */
    $sheet->mergeCells('A1:G1');
    $sheet->setCellValue('A1', 'LAPORAN DATA BARANG');
    $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(15);
    $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

    $sheet->mergeCells('A2:G2');
    $sheet->setCellValue('A2', 'Sistem LelanginAja');
    $sheet->getStyle('A2')->getFont()->setItalic(true);
    $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

    /* ================= PERIODE ================= */
    $periode = ($start && $end)
        ? 'Periode: '.date('d F Y', strtotime($start)).' – '.date('d F Y', strtotime($end))
        : 'Periode: Semua Data';

    $sheet->mergeCells('A4:G4');
    $sheet->setCellValue('A4', $periode);
    $sheet->getStyle('A4')->getAlignment()->setHorizontal('center');

    /* ================= HEADER ================= */
    $sheet->fromArray([
        ['No','Nama Barang','Kategori','Pemilik','Harga Awal','Status','Tanggal Pengajuan']
    ], null, 'A6');

    $sheet->getStyle('A6:G6')->applyFromArray([
        'font' => ['bold' => true],
        'alignment' => [
            'horizontal' => 'center',
            'vertical'   => 'center'
        ],
        'fill' => [
            'fillType' => 'solid',
            'color' => ['rgb' => 'F3F4F6']
        ],
        'borders' => [
            'allBorders' => ['borderStyle' => 'thin']
        ]
    ]);

    /* ================= DATA ================= */
    $row = 7;
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

        $sheet->getStyle("A{$row}:G{$row}")
            ->getBorders()->getAllBorders()
            ->setBorderStyle('thin');

        // ALIGNMENT
        $sheet->getStyle("A{$row}")
            ->getAlignment()->setHorizontal('center');

        $sheet->getStyle("E{$row}")
            ->getAlignment()->setHorizontal('right');

        $sheet->getStyle("F{$row}:G{$row}")
            ->getAlignment()->setHorizontal('center');

        // FORMAT RUPIAH
        $sheet->getStyle("E{$row}")
            ->getNumberFormat()
            ->setFormatCode('#,##0');

        $row++;
    }

    /* ================= AUTO SIZE ================= */
    foreach (range('A','G') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    /* ================= FOOTER ================= */
    $sheet->mergeCells("A".($row+1).":G".($row+1));
    $sheet->setCellValue(
        "A".($row+1),
        'Dicetak pada '.date('d F Y').' melalui Sistem LelanginAja'
    );
    $sheet->getStyle("A".($row+1))->getFont()->setItalic(true);
    $sheet->getStyle("A".($row+1))->getAlignment()->setHorizontal('right');

    /* ================= EXPORT ================= */
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
            ->groupBy([
                'transaksi_lelang.id_lelang',
                'barang.nama_barang',
                'users.nama',
                'transaksi_lelang.tanggal_mulai',
                'transaksi_lelang.tanggal_selesai',
                'barang.harga_awal',
                'transaksi_lelang.status'
            ]);

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

        // ===== FILTER HASIL LELANG =====
        $hasil = $this->request->getGet('hasil');
        if ($hasil === 'terjual') {
            $builder->having('MAX(transaksi_penawaran.harga_penawaran) IS NOT NULL');
        } elseif ($hasil === 'tidak') {
            $builder->having('MAX(transaksi_penawaran.harga_penawaran) IS NULL');
        }

        return view('admin/laporan/lelang', [
            'lelang' => $builder->get()->getResultArray(),
            'filter' => compact('start','end','status','hasil')
        ]);
    }
    public function lelangPdf()
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
            ->groupBy([
                'transaksi_lelang.id_lelang',
                'barang.nama_barang',
                'users.nama',
                'transaksi_lelang.tanggal_mulai',
                'transaksi_lelang.tanggal_selesai',
                'barang.harga_awal',
                'transaksi_lelang.status'
            ]);

        // FILTER
        $start  = $this->request->getGet('start_date');
        $end    = $this->request->getGet('end_date');
        $status = $this->request->getGet('status');
        $hasil  = $this->request->getGet('hasil');

        if ($start && $end) {
            $builder->where('DATE(transaksi_lelang.tanggal_mulai) >=', $start)
                    ->where('DATE(transaksi_lelang.tanggal_mulai) <=', $end);
        }

        if ($status) {
            $builder->where('transaksi_lelang.status', $status);
        }

        if ($hasil === 'terjual') {
            $builder->having('MAX(transaksi_penawaran.harga_penawaran) IS NOT NULL');
        } elseif ($hasil === 'tidak') {
            $builder->having('MAX(transaksi_penawaran.harga_penawaran) IS NULL');
        }

        $data = [
            'lelang' => $builder->get()->getResultArray(),
            'filter' => compact('start','end','status','hasil')
        ];

        $html = view('admin/laporan/lelang_pdf', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan-lelang.pdf', ['Attachment' => false]);
    }

    public function lelangExcel()
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
            ->join('transaksi_penawaran',
                'transaksi_penawaran.id_lelang = transaksi_lelang.id_lelang',
                'left'
            )
            ->groupBy([
                'transaksi_lelang.id_lelang',
                'barang.nama_barang',
                'users.nama',
                'transaksi_lelang.tanggal_mulai',
                'transaksi_lelang.tanggal_selesai',
                'barang.harga_awal',
                'transaksi_lelang.status'
            ]);

        // ===== FILTER =====
        $start  = $this->request->getGet('start_date');
        $end    = $this->request->getGet('end_date');
        $status = $this->request->getGet('status');
        $hasil  = $this->request->getGet('hasil');

        if ($start && $end) {
            $builder->where('DATE(transaksi_lelang.tanggal_mulai) >=', $start)
                    ->where('DATE(transaksi_lelang.tanggal_mulai) <=', $end);
        }

        if ($status) {
            $builder->where('transaksi_lelang.status', $status);
        }

        if ($hasil === 'terjual') {
            $builder->having('MAX(transaksi_penawaran.harga_penawaran) IS NOT NULL');
        } elseif ($hasil === 'tidak') {
            $builder->having('MAX(transaksi_penawaran.harga_penawaran) IS NULL');
        }

        $lelang = $builder->get()->getResultArray();

        // ================= EXCEL =================
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        /* ================= JUDUL ================= */
        $sheet->mergeCells('A1:I1');
        $sheet->setCellValue('A1', 'LAPORAN DATA LELANG');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(15);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        $sheet->mergeCells('A2:I2');
        $sheet->setCellValue('A2', 'Sistem LelanginAja');
        $sheet->getStyle('A2')->getFont()->setItalic(true);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

        /* ================= PERIODE ================= */
        $periode = ($start && $end)
            ? 'Periode: '.date('d F Y', strtotime($start)).' – '.date('d F Y', strtotime($end))
            : 'Periode: Semua Data';

        $sheet->mergeCells('A4:I4');
        $sheet->setCellValue('A4', $periode);
        $sheet->getStyle('A4')->getAlignment()->setHorizontal('center');

        /* ================= HEADER ================= */
        $sheet->fromArray([
            ['No','Nama Barang','Pemilik','Harga Awal','Harga Tertinggi','Total Penawaran','Status','Tanggal Mulai','Tanggal Selesai']
        ], null, 'A6');

        $sheet->getStyle('A6:I6')->applyFromArray([
            'font' => [
                'bold' => true
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical'   => 'center'
            ],
            'fill' => [
                'fillType' => 'solid',
                'color' => ['rgb' => 'F3F4F6']
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => 'thin']
            ]
        ]);

        /* ================= DATA ================= */
        $row = 7;
        $no  = 1;

        foreach ($lelang as $l) {
            $sheet->fromArray([
                $no++,
                $l['nama_barang'],
                $l['pemilik'],
                $l['harga_awal'],
                $l['harga_tertinggi'] ?? '-',
                $l['total_penawaran'],
                ucfirst($l['status']),
                date('d-m-Y', strtotime($l['tanggal_mulai'])),
                date('d-m-Y', strtotime($l['tanggal_selesai']))
            ], null, 'A'.$row);

            $sheet->getStyle("A{$row}:I{$row}")
                ->getBorders()->getAllBorders()
                ->setBorderStyle('thin');

            $sheet->getStyle("A{$row}")
                ->getAlignment()->setHorizontal('center');

            $sheet->getStyle("D{$row}:F{$row}")
                ->getAlignment()->setHorizontal('right');

            $sheet->getStyle("G{$row}:I{$row}")
                ->getAlignment()->setHorizontal('center');

            $row++;
        }

        /* ================= FORMAT ANGKA ================= */
        $sheet->getStyle("D7:E{$row}")
            ->getNumberFormat()
            ->setFormatCode('#,##0');

        /* ================= AUTO SIZE ================= */
        foreach (range('A','I') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        /* ================= FOOTER ================= */
        $sheet->mergeCells("A".($row+1).":I".($row+1));
        $sheet->setCellValue("A".($row+1),
            'Dicetak pada '.date('d F Y').' melalui Sistem LelanginAja'
        );
        $sheet->getStyle("A".($row+1))->getFont()->setItalic(true);
        $sheet->getStyle("A".($row+1))->getAlignment()->setHorizontal('right');

        /* ================= OUTPUT ================= */
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="laporan-lelang.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    // ================= LAPORAN PEMENANG =================
    public function pemenang()
    {
        $builder = $this->db->table('transaksi_pemenang')
            ->select('
                transaksi_pemenang.id_pemenang,
                barang.nama_barang,
                users.nama AS nama_pemenang,
                transaksi_pemenang.harga_menang,
                transaksi_pemenang.tanggal_menang,
                transaksi_lelang.status AS status_lelang
            ')
            ->join('transaksi_lelang', 'transaksi_lelang.id_lelang = transaksi_pemenang.id_lelang')
            ->join('barang', 'barang.id_barang = transaksi_lelang.id_barang')
            ->join('users', 'users.id_user = transaksi_pemenang.id_user');

        // ===== FILTER TANGGAL MENANG =====
        $start = $this->request->getGet('start_date');
        $end   = $this->request->getGet('end_date');

        if ($start && $end) {
            $builder->where('DATE(transaksi_pemenang.tanggal_menang) >=', $start)
                    ->where('DATE(transaksi_pemenang.tanggal_menang) <=', $end);
        }

        // ===== FILTER STATUS LELANG =====
        $status = $this->request->getGet('status');
        if ($status) {
            $builder->where('transaksi_lelang.status', $status);
        }

        return view('admin/laporan/pemenang', [
            'pemenang' => $builder
                ->orderBy('transaksi_pemenang.tanggal_menang', 'DESC')
                ->get()->getResultArray(),

            'filter' => compact('start','end','status')
        ]);
    }
    // ================= EXPORT PDF PEMENANG =================
    public function pemenangPdf()
    {
        $builder = $this->db->table('transaksi_pemenang')
            ->select('
                transaksi_pemenang.id_pemenang,
                barang.nama_barang,
                users.nama AS nama_pemenang,
                transaksi_pemenang.harga_menang,
                transaksi_pemenang.tanggal_menang,
                transaksi_lelang.status AS status_lelang
            ')
            ->join('transaksi_lelang', 'transaksi_lelang.id_lelang = transaksi_pemenang.id_lelang')
            ->join('barang', 'barang.id_barang = transaksi_lelang.id_barang')
            ->join('users', 'users.id_user = transaksi_pemenang.id_user');

        // FILTER TANGGAL
        $start = $this->request->getGet('start_date');
        $end   = $this->request->getGet('end_date');

        if ($start && $end) {
            $builder->where('DATE(transaksi_pemenang.tanggal_menang) >=', $start)
                    ->where('DATE(transaksi_pemenang.tanggal_menang) <=', $end);
        }

        // FILTER STATUS
        $status = $this->request->getGet('status');
        if ($status) {
            $builder->where('transaksi_lelang.status', $status);
        }

        $data = [
            'pemenang' => $builder->get()->getResultArray(),
            'filter'   => compact('start','end','status')
        ];

        $html = view('admin/laporan/pemenang_pdf', $data);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan-pemenang.pdf', ['Attachment' => false]);
    }

    // ================= EXPORT EXCEL PEMENANG =================
    public function pemenangExcel()
    {
        $builder = $this->db->table('transaksi_pemenang')
            ->select('
                barang.nama_barang,
                users.nama AS nama_pemenang,
                transaksi_pemenang.harga_menang,
                transaksi_pemenang.tanggal_menang,
                transaksi_lelang.status AS status_lelang
            ')
            ->join('transaksi_lelang', 'transaksi_lelang.id_lelang = transaksi_pemenang.id_lelang')
            ->join('barang', 'barang.id_barang = transaksi_lelang.id_barang')
            ->join('users', 'users.id_user = transaksi_pemenang.id_user');

        // ===== FILTER =====
        $start  = $this->request->getGet('start_date');
        $end    = $this->request->getGet('end_date');
        $status = $this->request->getGet('status');

        if ($start && $end) {
            $builder->where('DATE(transaksi_pemenang.tanggal_menang) >=', $start)
                    ->where('DATE(transaksi_pemenang.tanggal_menang) <=', $end);
        }

        if ($status) {
            $builder->where('transaksi_lelang.status', $status);
        }

        $data = $builder->get()->getResultArray();

        // ================= EXCEL =================
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        /* ================= JUDUL ================= */
        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', 'LAPORAN DATA PEMENANG');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(15);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        $sheet->mergeCells('A2:F2');
        $sheet->setCellValue('A2', 'Sistem LelanginAja');
        $sheet->getStyle('A2')->getFont()->setItalic(true);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

        /* ================= PERIODE ================= */
        $periode = ($start && $end)
            ? 'Periode: '.date('d F Y', strtotime($start)).' – '.date('d F Y', strtotime($end))
            : 'Periode: Semua Data';

        $sheet->mergeCells('A4:F4');
        $sheet->setCellValue('A4', $periode);
        $sheet->getStyle('A4')->getAlignment()->setHorizontal('center');

        /* ================= HEADER ================= */
        $sheet->fromArray([
            ['No','Nama Barang','Pemenang','Harga Menang','Tanggal Menang','Status Lelang']
        ], null, 'A6');

        $sheet->getStyle('A6:F6')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => 'center',
                'vertical'   => 'center'
            ],
            'fill' => [
                'fillType' => 'solid',
                'color' => ['rgb' => 'F3F4F6']
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => 'thin']
            ]
        ]);

        /* ================= DATA ================= */
        $row = 7;
        $no  = 1;

        foreach ($data as $d) {
            $sheet->fromArray([
                $no++,
                $d['nama_barang'],
                $d['nama_pemenang'],
                $d['harga_menang'],
                date('d-m-Y', strtotime($d['tanggal_menang'])),
                ucfirst($d['status_lelang'])
            ], null, 'A'.$row);

            // BORDER
            $sheet->getStyle("A{$row}:F{$row}")
                ->getBorders()->getAllBorders()
                ->setBorderStyle('thin');

            // ALIGNMENT
            $sheet->getStyle("A{$row}")
                ->getAlignment()->setHorizontal('center');

            $sheet->getStyle("D{$row}")
                ->getAlignment()->setHorizontal('right');

            $sheet->getStyle("E{$row}:F{$row}")
                ->getAlignment()->setHorizontal('center');

            // FORMAT RUPIAH
            $sheet->getStyle("D{$row}")
                ->getNumberFormat()
                ->setFormatCode('#,##0');

            $row++;
        }

        /* ================= AUTO SIZE ================= */
        foreach (range('A','F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        /* ================= FOOTER ================= */
        $sheet->mergeCells("A".($row+1).":F".($row+1));
        $sheet->setCellValue(
            "A".($row+1),
            'Dicetak pada '.date('d F Y').' melalui Sistem LelanginAja'
        );
        $sheet->getStyle("A".($row+1))->getFont()->setItalic(true);
        $sheet->getStyle("A".($row+1))->getAlignment()->setHorizontal('right');

        /* ================= EXPORT ================= */
        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan-pemenang.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    // ================= LAPORAN PEMBAYARAN =================
    public function pembayaran()
    {
        $builder = $this->db->table('transaksi_pembayaran')
            ->select('
                transaksi_pembayaran.id_bayar,
                barang.nama_barang,
                users.nama AS nama_pemenang,
                transaksi_pembayaran.metode,
                transaksi_pembayaran.status,
                transaksi_pembayaran.tanggal_bayar,
                transaksi_pemenang.harga_menang
            ')
            ->join('transaksi_pemenang', 'transaksi_pemenang.id_pemenang = transaksi_pembayaran.id_pemenang')
            ->join('transaksi_lelang', 'transaksi_lelang.id_lelang = transaksi_pemenang.id_lelang')
            ->join('barang', 'barang.id_barang = transaksi_lelang.id_barang')
            ->join('users', 'users.id_user = transaksi_pemenang.id_user');

        // ===== FILTER =====
        $start  = $this->request->getGet('start_date');
        $end    = $this->request->getGet('end_date');
        $status = $this->request->getGet('status');   // paid | pending | rejected
        $metode = $this->request->getGet('metode');   // QRIS | Transfer Bank | E-Wallet

        if ($start && $end) {
            $builder->where('DATE(transaksi_pembayaran.tanggal_bayar) >=', $start)
                    ->where('DATE(transaksi_pembayaran.tanggal_bayar) <=', $end);
        }

        if ($status) {
            $builder->where('transaksi_pembayaran.status', $status);
        }

        if ($metode) {
            $builder->where('transaksi_pembayaran.metode', $metode);
        }

        return view('admin/laporan/pembayaran', [
            'pembayaran' => $builder
                ->orderBy('transaksi_pembayaran.tanggal_bayar','DESC')
                ->get()->getResultArray(),
            'filter' => compact('start','end','status','metode')
        ]);
    }


    public function pembayaranPdf()
    {
        $builder = $this->db->table('transaksi_pembayaran')
            ->select('
                barang.nama_barang,
                users.nama AS nama_pemenang,
                transaksi_pemenang.harga_menang,
                transaksi_pembayaran.metode,
                transaksi_pembayaran.status,
                transaksi_pembayaran.tanggal_bayar
            ')
            ->join('transaksi_pemenang','transaksi_pemenang.id_pemenang = transaksi_pembayaran.id_pemenang')
            ->join('transaksi_lelang','transaksi_lelang.id_lelang = transaksi_pemenang.id_lelang')
            ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
            ->join('users','users.id_user = transaksi_pemenang.id_user');

        // ===== FILTER =====
        $start  = $this->request->getGet('start_date');
        $end    = $this->request->getGet('end_date');
        $status = $this->request->getGet('status');   // paid | pending | rejected
        $metode = $this->request->getGet('metode');   // QRIS | Transfer Bank | E-Wallet

        if ($start && $end) {
            $builder->where('DATE(transaksi_pembayaran.tanggal_bayar) >=', $start)
                    ->where('DATE(transaksi_pembayaran.tanggal_bayar) <=', $end);
        }

        if ($status) {
            $builder->where('transaksi_pembayaran.status', $status);
        }

        if ($metode) {
            $builder->where('transaksi_pembayaran.metode', $metode);
        }

        $data = [
            'pembayaran' => $builder->get()->getResultArray(),
            'filter'     => compact('start','end','status','metode')
        ];

        $html = view('admin/laporan/pembayaran_pdf', $data);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','landscape');
        $dompdf->render();
        $dompdf->stream('laporan-pembayaran.pdf', ['Attachment' => false]);
    }

   public function pembayaranExcel()
    {
        $builder = $this->db->table('transaksi_pembayaran')
            ->select('
                barang.nama_barang,
                users.nama AS nama_pemenang,
                transaksi_pemenang.harga_menang,
                transaksi_pembayaran.metode,
                transaksi_pembayaran.status,
                transaksi_pembayaran.tanggal_bayar
            ')
            ->join('transaksi_pemenang','transaksi_pemenang.id_pemenang = transaksi_pembayaran.id_pemenang')
            ->join('transaksi_lelang','transaksi_lelang.id_lelang = transaksi_pemenang.id_lelang')
            ->join('barang','barang.id_barang = transaksi_lelang.id_barang')
            ->join('users','users.id_user = transaksi_pemenang.id_user');

        // ===== FILTER (KONSISTEN DENGAN LIST & PDF) =====
        $start  = $this->request->getGet('start_date');
        $end    = $this->request->getGet('end_date');
        $status = $this->request->getGet('status');   // paid | pending | rejected
        $metode = $this->request->getGet('metode');   // QRIS | Transfer Bank | E-Wallet

        if ($start && $end) {
            $builder->where('DATE(transaksi_pembayaran.tanggal_bayar) >=', $start)
                    ->where('DATE(transaksi_pembayaran.tanggal_bayar) <=', $end);
        }

        if ($status) {
            $builder->where('transaksi_pembayaran.status', $status);
        }

        if ($metode) {
            $builder->where('transaksi_pembayaran.metode', $metode);
        }

        $data = $builder->get()->getResultArray();

        // ================= EXCEL =================
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        /* ================= JUDUL ================= */
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'LAPORAN DATA PEMBAYARAN');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(15);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        $sheet->mergeCells('A2:G2');
        $sheet->setCellValue('A2', 'Sistem LelanginAja');
        $sheet->getStyle('A2')->getFont()->setItalic(true);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

        /* ================= PERIODE ================= */
        $periode = ($start && $end)
            ? 'Periode: '.date('d F Y', strtotime($start)).' – '.date('d F Y', strtotime($end))
            : 'Periode: Semua Data';

        $sheet->mergeCells('A4:G4');
        $sheet->setCellValue('A4', $periode);
        $sheet->getStyle('A4')->getAlignment()->setHorizontal('center');

        /* ================= HEADER ================= */
        $sheet->fromArray([
            ['No','Nama Barang','Pemenang','Harga Menang','Metode','Status','Tanggal Bayar']
        ], null, 'A6');

        $sheet->getStyle('A6:G6')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => 'center',
                'vertical'   => 'center'
            ],
            'fill' => [
                'fillType' => 'solid',
                'color' => ['rgb' => 'F3F4F6']
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => 'thin']
            ]
        ]);

        /* ================= DATA ================= */
        $row = 7;
        $no  = 1;

        foreach ($data as $d) {
            $sheet->fromArray([
                $no++,
                $d['nama_barang'],
                $d['nama_pemenang'],
                $d['harga_menang'],
                $d['metode'],               // tampilkan sesuai DB
                ucfirst($d['status']),
                date('d-m-Y', strtotime($d['tanggal_bayar']))
            ], null, 'A'.$row);

            $sheet->getStyle("A{$row}:G{$row}")
                ->getBorders()->getAllBorders()
                ->setBorderStyle('thin');

            $sheet->getStyle("A{$row}")
                ->getAlignment()->setHorizontal('center');

            $sheet->getStyle("D{$row}")
                ->getAlignment()->setHorizontal('right');

            $sheet->getStyle("E{$row}:G{$row}")
                ->getAlignment()->setHorizontal('center');

            $sheet->getStyle("D{$row}")
                ->getNumberFormat()
                ->setFormatCode('#,##0');

            $row++;
        }

        /* ================= AUTO WIDTH ================= */
        foreach (range('A','G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        /* ================= FOOTER ================= */
        $sheet->mergeCells("A".($row+1).":G".($row+1));
        $sheet->setCellValue(
            "A".($row+1),
            'Dicetak pada '.date('d F Y').' melalui Sistem LelanginAja'
        );
        $sheet->getStyle("A".($row+1))->getFont()->setItalic(true);
        $sheet->getStyle("A".($row+1))->getAlignment()->setHorizontal('right');

        /* ================= EXPORT ================= */
        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan-pembayaran.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

}
