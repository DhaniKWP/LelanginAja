<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Pembayaran</title>

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
        .text-right  { text-align: right; }

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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
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
        <div class="title">LAPORAN DATA PEMBAYARAN</div>
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

    <!-- TABEL PEMBAYARAN -->
    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th>Nama Barang</th>
                <th>Pemenang</th>
                <th width="14%">Harga Menang</th>
                <th width="10%">Metode</th>
                <th width="10%">Status</th>
                <th width="12%">Tanggal Bayar</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php if($pembayaran): foreach($pembayaran as $p): ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= esc($p['nama_barang']) ?></td>
                    <td><?= esc($p['nama_pemenang']) ?></td>
                    <td class="text-right">
                        Rp <?= number_format($p['harga_menang'],0,',','.') ?>
                    </td>
                    <td class="text-center"><?= strtoupper($p['metode']) ?></td>
                    <td class="text-center"><?= ucfirst($p['status']) ?></td>
                    <td class="text-center">
                        <?= date('d-m-Y', strtotime($p['tanggal_bayar'])) ?>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr>
                    <td colspan="7" class="text-center">
                        Tidak ada data pembayaran
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        Dicetak melalui Sistem LelanginAja <br>
        Tanggal Cetak : <?= date('d M Y H:i') ?>
    </div>

</div>
</body>
</html>
