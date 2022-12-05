<!doctype html>
<html>

<head>
    <title>Cetak Laporan</title>
    <style>
        body {
            font-family: Verdana;
            font-size: 13px;
        }

        h1 {
            font-size: 14px;
            border-bottom: 4px double #000;
            padding: 3px 0;
        }

        table {
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        td,
        th {
            border: 1px solid #000;
            padding: 3px;
        }

        .wrapper {
            margin: 0 auto;
            width: 980px;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="wrapper">
        <h1>Perangkingan</h1>
        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>Ranking</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Fakultas</th>
                    <th>Total</th>
                </tr>
            </thead>
            <?php
            $rows = get_results("SELECT * FROM tb_alternatif  ORDER BY total DESC");
            $no = 1;
            foreach ($rows as $row) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row->kode_alternatif ?></td>
                    <td><?= $row->nama_alternatif ?></td>
                    <td><?= $row->nim ?></td>
                    <td><?= $row->fakultas ?></td>
                    <td><?= round($row->total, 4) ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</body>

</html>