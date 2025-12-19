<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Lelang</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #1f2937;
        }

        .container {
            padding: 20px;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }

        .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .subtitle {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 10px;
        }

        .info-box {
            border: 1px solid #d1d5db;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #374151;
            padding: 8px;
            font-size: 11px;
        }

        th {
            background: #e5e7eb;
            text-align: center;
            font-weight: bold;
        }

        .summary-table {
            width: 40%;
            margin-top: 15px;
            border-collapse: collapse;
        }

        .summary-table td {
            border: 1px solid #374151;
            padding: 8px;
            font-size: 12px;
        }

        .footer {
            margin-top: 30px;
            font-size: 11px;
            text-align: right;
            color: #6b7280;
        }
    </style>
</head>

<body>
<div class="container">

    <!-- HEADER -->
    <div class="text-center">
        <div class="title">LAPORAN DATA LELANG</div>
        <div class="subtitle">
            Platform Lelang Barang Online — <b>LelanginAja</b>
        </div>
    </div>

    <!-- PERIODE -->
    <div>
        <strong>Periode Laporan:</strong>
        <?php if (!empty($_GET['start_date']) && !empty($_GET['end_date'])): ?>
            <?= date('d M Y', strtotime($_GET['start_date'])) ?>
            s/d
            <?= date('d M Y', strtotime($_GET['end_date'])) ?>
        <?php else: ?>
            Semua Periode
        <?php endif; ?>
    </div>

    <!-- TABEL LELANG -->
    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th>Nama Barang</th>
                <th>Pemilik</th>
                <th width="12%">Harga Awal</th>
                <th width="12%">Harga Tertinggi</th>
                <th width="8%">Total Bid</th>
                <th width="10%">Status</th>
                <th width="12%">Tanggal Mulai</th>
                <th width="12%">Tanggal Selesai</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $totalLelang = count($lelang);
            $lelangAktif = 0;
            $lelangSelesai = 0;
            ?>

            <?php if($lelang): foreach($lelang as $l): ?>
                <?php
                    if ($l['status'] === 'aktif') $lelangAktif++;
                    if ($l['status'] === 'selesai') $lelangSelesai++;
                ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= esc($l['nama_barang']) ?></td>
                    <td><?= esc($l['pemilik']) ?></td>
                    <td class="text-right">
                        Rp <?= number_format($l['harga_awal'],0,',','.') ?>
                    </td>
                    <td class="text-right">
                        <?= $l['harga_tertinggi']
                            ? 'Rp '.number_format($l['harga_tertinggi'],0,',','.')
                            : '-' ?>
                    </td>
                    <td class="text-center"><?= $l['total_penawaran'] ?></td>
                    <td class="text-center"><?= ucfirst($l['status']) ?></td>
                    <td class="text-center">
                        <?= date('d-m-Y', strtotime($l['tanggal_mulai'])) ?>
                    </td>
                    <td class="text-center">
                        <?= date('d-m-Y', strtotime($l['tanggal_selesai'])) ?>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr>
                    <td colspan="9" class="text-center">
                        Tidak ada data lelang
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- SUMMARY -->
    <table class="summary-table">
        <tr>
            <td><strong>Total Lelang</strong></td>
            <td class="text-right"><?= $totalLelang ?> item</td>
        </tr>
        <tr>
            <td><strong>Lelang Aktif</strong></td>
            <td class="text-right"><?= $lelangAktif ?> item</td>
        </tr>
        <tr>
            <td><strong>Lelang Selesai</strong></td>
            <td class="text-right"><?= $lelangSelesai ?> item</td>
        </tr>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        Dicetak melalui Sistem LelanginAja <br>
        Tanggal Cetak : <?= date('d M Y H:i') ?>
    </div>

</div>
</body>
</html>
