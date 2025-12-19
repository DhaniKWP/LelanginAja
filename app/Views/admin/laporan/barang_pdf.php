<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Barang Lelang</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #111827;
        }

        .container {
            padding: 20px;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }

        .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .subtitle {
            font-size: 12px;
            color: #374151;
        }

        .system-name {
            font-size: 13px;
            font-weight: bold;
            margin-top: 2px;
        }

        .info-box {
            border: 1.5px solid #000;
            padding: 10px;
            margin: 15px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        thead {
            background-color: #e5e7eb;
        }

        th {
            border: 1.5px solid #000;
            padding: 8px;
            font-size: 11px;
            font-weight: bold;
            text-align: center;
        }

        td {
            border: 1px solid #000;
            padding: 7px;
            font-size: 11px;
        }

        .summary {
            margin-top: 15px;
            border: 1.5px solid #000;
            padding: 10px;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            font-size: 11px;
            text-align: right;
        }
    </style>
</head>

<body>
<div class="container">

    <!-- HEADER -->
    <div class="text-center">
        <div class="title">LAPORAN DATA BARANG LELANG</div>
        <div class="system-name">SISTEM LELANGIN AJA</div>
        <div class="subtitle">Platform Lelang Barang Online</div>
    </div>

    <!-- PERIODE -->
    <div>
        <strong>Periode Laporan :</strong>
        <?php if (!empty($_GET['start_date']) && !empty($_GET['end_date'])): ?>
            <?= date('d M Y', strtotime($_GET['start_date'])) ?>
            s/d
            <?= date('d M Y', strtotime($_GET['end_date'])) ?>
        <?php else: ?>
            Semua Periode
        <?php endif; ?>
    </div>

    <!-- TABLE -->
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Pemilik</th>
                <th width="15%">Harga Awal</th>
                <th width="12%">Status</th>
                <th width="12%">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1; 
            $totalBarang = count($barang);
            ?>

            <?php if($barang): foreach($barang as $b): ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= $b['nama_barang'] ?></td>
                <td><?= $b['nama_kategori'] ?></td>
                <td><?= $b['nama_user'] ?></td>
                <td class="text-right">
                    Rp <?= number_format($b['harga_awal'],0,',','.') ?>
                </td>
                <td class="text-center">
                    <?= ucfirst($b['status_pengajuan']) ?>
                </td>
                <td class="text-center">
                    <?= date('d-m-Y', strtotime($b['tanggal_pengajuan'])) ?>
                </td>
            </tr>
            <?php endforeach; else: ?>
            <tr>
                <td colspan="7" class="text-center">
                    Tidak ada data barang
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- SUMMARY -->
    <div class="summary">
        Total Barang Lelang : <?= $totalBarang ?> Item
    </div>

    <!-- FOOTER -->
    <div class="footer">
        Dicetak melalui Sistem LelanginAja <br>
        Tanggal Cetak : <?= date('d M Y H:i') ?>
    </div>

</div>
</body>
</html>
