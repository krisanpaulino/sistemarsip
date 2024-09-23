<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background-color: #f4f7fa;
            color: #333;
        }

        .container {
            max-width: 1100px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header h1 {
            font-size: 2.5em;
            color: #2c3e50;
        }

        .report-date {
            color: #7f8c8d;
            margin-top: 5px;
            font-size: 1em;
        }

        .summary {
            margin-bottom: 30px;
        }

        .summary h2 {
            font-size: 1.8em;
            color: #34495e;
            margin-bottom: 10px;
        }

        .summary p {
            font-size: 1.1em;
            line-height: 1.5;
            color: #555;
        }

        .report-table h2 {
            font-size: 1.8em;
            color: #34495e;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #34495e;
            color: white;
            font-weight: bold;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tbody tr:hover {
            background-color: #d3d3d3;
            cursor: pointer;
        }

        table td {
            color: #555;
        }

        table td:first-child {
            font-weight: bold;
        }

        @media (max-width: 768px) {
            body {
                padding: 0 15px;
            }

            .container {
                padding: 10px;
            }

            table th,
            table td {
                font-size: 14px;
                padding: 10px;
            }

            header h1 {
                font-size: 2em;
            }

            .report-date {
                font-size: 0.9em;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1><?= $title ?></h1>
            <p class="report-date">Tahun : <?= $tahun ?></p>
        </header>

        <!-- <section class="summary">
            <h2>Summary</h2>
            <p>This report provides an overview of the monthly sales performance, detailing key metrics and highlights.</p>
        </section> -->

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
        </section>
    </div>
</body>

</html>