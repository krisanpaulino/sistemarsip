<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.2;
            /* Reduced line spacing */
            font-size: 12px;
            /* Reduced font size */
            color: #333;
            background-color: #fff;
            margin: 10px;
            /* Reduced margin for content area */
        }

        .container {
            width: 100%;
            margin: auto;
            padding: 10px;
            /* Reduced padding */
            box-sizing: border-box;
        }

        header {
            text-align: center;
            margin-bottom: 10px;
            /* Reduced space below header */
        }

        .company-info {
            width: 100%;
            margin-bottom: 10px;
            /* Reduced margin below company info */
            border-collapse: collapse;
            /* Ensures a clean layout */
        }

        .company-info td {
            vertical-align: middle;
            padding: 3px;
            /* Reduced padding for compactness */
            border: none;
            /* Removed all borders */
        }

        .logo {
            width: 40px;
            /* Smaller logo */
            height: 40px;
        }

        .company-name {
            font-size: 1.2em;
            /* Slightly smaller font for the company name */
            color: #2c3e50;
            font-weight: bold;
        }

        .company-details {
            font-size: 10px;
            /* Reduced font size for details */
            color: #555;
        }

        .separator {
            border-top: 1px solid #d3d3d3;
            /* Reduced thickness of the separator */
            margin: 10px 0;
        }

        h1 {
            font-size: 1.5em;
            /* Reduced font size */
            color: #2c3e50;
        }

        .report-date {
            color: #7f8c8d;
            font-size: 10px;
            /* Reduced font size for date */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            /* Reduced space below table */
            font-size: 10px;
            /* Smaller font for table content */
        }

        table th,
        table td {
            text-align: left;
            padding: 6px;
            /* Reduced padding for tighter spacing */
            border: 1px solid #ddd;
        }

        .ttd td {
            text-align: left;
            padding: 6px;
            /* Reduced padding for tighter spacing */
            border: 0px none;
        }

        table th {
            background-color: #34495e;
            color: white;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <table class="company-info">
                <tr>
                    <td><img src="<?= base_url('assets/images/logo_big.png') ?>" alt="Company Logo" class="logo"></td>
                    <td>
                        <div>
                            <p class="company-name">BKD Kabupaten Sikka</p>
                            <p class="company-details">Uneng City, Alok, Sikka Regency, East Nusa Tenggara</p>
                            <p class="company-details">Phone: 0382-23025</p>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="separator"></div>
            <h1><?= $title ?></h1>
            <p class="report-date">Tahun : <?= $tahun ?></p>
        </header>

        <section class="summary">
            <h5>Tanggal Cetak</h5>
            <p><?= date('d-m-Y') ?></p>
        </section>

        <section class="report-table">
            <h2>Data Arsip</h2>
            <table>
                <thead>
                    <tr>
                        <td width="5%">No</td>
                        <td width="15%">No. Arsip</td>
                        <td width="25%">Perihal</td>
                        <td width="15%">Jenis Arsip</td>
                        <td width="15%">Tanggal Arsip</td>
                        <td width="15%">Tanggal Upload</td>
                        <td width="10%">Unit</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($laporan as $row) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row->arsip_nomor ?></td>
                            <td><?= $row->arsip_perihal ?></td>
                            <td><?= $row->jenis_nama ?></td>
                            <td><?= $row->arsip_tanggalarsip ?></td>
                            <td><?= $row->arsip_tanggalrekam ?></td>
                            <td><?= $row->unit_nama ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <table style="border: none;" class="ttd">
                <tr>
                    <td style="width: 70%;"></td>
                    <td>
                        <center>
                            Maumere, <?= date('d-m-Y') ?>
                            <br>
                            Sekretaris BKD Maumere
                        </center>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 25px;"></td>
                </tr>
                <tr>
                    <td style="width: 70%;"></td>
                    <td>
                        <center>
                            <b>ALWAN MAHMUD, SE</b> <br>
                            NIP 19700421 199904 1001
                        </center>
                    </td>
                </tr>
            </table>
        </section>
    </div>
</body>

</html>