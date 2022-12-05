<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Mengukur Konsistensi Kriteria</h3>
    </div>
    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Matriks Perbandingan Kriteria</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <?php
                    echo "<thead><tr><th></th>";
                    foreach ($rel_kriteria as $key => $val) {
                        echo "<th>$key</th>";
                    }
                    echo "<tr></thead>";
                    foreach ($rel_kriteria as $key => $val) {
                        echo "<tr><th>$key - {$kriterias[$key]->nama_kriteria}</th>";
                        foreach ($val as $k => $v) {
                            echo "<td>" . round($v, 3) . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "<tfoot><tr><th>Total kolom</th>";
                    foreach ($ahp->baris_total as $key => $val) {
                        echo "<td class='text-primary'>" . round($val, 3) . "</td>";
                    }
                    echo "</tr></tfoot>";
                    ?>
                </table>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Matriks Bobot Prioritas Kriteria</div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <?php
                    echo "<thead><tr><th></th>";
                    $no = 1;
                    foreach ($ahp->normal as $key => $val) {
                        echo "<th>$key</th>";
                        $no++;
                    }
                    echo "<th>Bobot Prioritas</th></tr></thead>";
                    $no = 1;
                    foreach ($ahp->normal as $key => $val) {
                        echo "<tr>";
                        echo "<th>$key</th>";
                        foreach ($val as $k => $v) {
                            echo "<td>" . round($v, 3) . "</td>";
                        }
                        echo "<td class='text-primary'>" . round($ahp->prioritas[$key], 3) . "</td>";
                        echo "</tr>";
                        $no++;
                    }
                    echo "</tr>";
                    ?>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Matriks Konsistensi Kriteria</div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <?php

                    echo "<thead><tr><th></th>";
                    $no = 1;
                    foreach ($ahp->normal as $key => $val) {
                        echo "<th>$key</th>";
                        $no++;
                    }
                    echo "<th>Bobot</th></tr></thead>";
                    $no = 1;
                    foreach ($ahp->normal as $key => $val) {
                        echo "<tr>";
                        echo "<th>$key</th>";
                        foreach ($val as $k => $v) {
                            echo "<td>" . round($v, 3) . "</td>";
                        }
                        echo "<td class='text-primary'>" . round($ahp->cm[$key], 3) . "</td>";
                        echo "</tr>";
                        $no++;
                    }
                    echo "</tr>";
                    ?>
                </table>
            </div>
            <div class="panel-body">
                Berikut tabel ratio index berdasarkan ordo matriks.
            </div>
            <div class="panel-footer">
                <?php
                echo "<p>Consistency Index: " . round($ahp->CI, 3) . "<br />";
                echo "Ratio Index: " . round($ahp->RI, 3) . "<br />";
                echo "Consistency Ratio: " . round($ahp->CR, 3);
                if ($ahp->CR > 0.10) {
                    echo " (Tidak konsisten)<br />";
                } else {
                    echo " (Konsisten)<br />";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Hasil Analisa</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Alternatif</th>
                    <?php foreach ($kriterias as $key => $val) : ?>
                        <th><?= $val->nama_kriteria ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php
            foreach ($rel_alternatif as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $alternatifs[$key]->nama_alternatif ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= $crisps[$v]->nama_crisp ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Hasil Pembobotan</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th rowspan="2">Kode</th>
                    <th rowspan="2">Nama Alternatif</th>
                    <?php foreach ($kriterias as $key => $val) : ?>
                        <th><?= $val->nama_kriteria ?></th>
                    <?php endforeach ?>
                </tr>
                <tr>
                    <?php foreach ($ahp->prioritas as $key => $val) : ?>
                        <th><?= round($val, 4) ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php
            foreach ($rel_alternatif as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $alternatifs[$key]->nama_alternatif ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= round($crisps[$v]->nilai_crisp, 4) ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Perangkingan</h3>
    </div>
    <div class="table-responsive">
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
    <div class="panel-body">
        <?php
        $best = $rows[0];
        ?>
        <p>Jadi pilihan terbaik adalah <strong><?= $best->nama_alternatif ?></strong> dengan nilai <strong><?= round($best->total, 3) ?></strong></p>
        <p><a class="btn btn-default" target="_blank" href="<?= site_url('hitung/cetak') ?>"><span class="glyphicon glyphicon-print"></span> Cetak</a></p>
    </div>
</div>