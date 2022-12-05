<?= show_msg() ?>
<?= print_error() ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <div class="form-group">
                <select class="form-control" name="kode_kriteria" onchange="this.form.submit()">
                    <option value="">Pilih Kriteria</option>
                    <?= get_kriteria_option($kode_kriteria) ?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
        </form>
    </div>
    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-heading">
                <form class="form-inline" method="POST" action="<?= site_url('rel_crisp/update?kode_kriteria=' . $kode_kriteria) ?>">
                    <div class="form-group">
                        <select class="form-control" name="ID1">
                            <?= get_crisp_option(old('ID1'), $kode_kriteria) ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="nilai">
                            <?= get_nilai_option(old('nilai')) ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="ID2">
                            <?= get_crisp_option(old('ID2'), $kode_kriteria) ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <?php foreach ($crisp as $key => $val) :
                                if ($val->kode_kriteria != $kode_kriteria) continue ?>
                                <th><?= $key ?></th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <?php foreach ($rel_crisp as $key => $val) : ?>
                        <tr>
                            <td><?= $key ?></td>
                            <td><?= $crisp[$key]->nama_crisp ?></td>
                            <?php foreach ($val as $k => $v) : ?>
                                <td><?= round($v, 3) ?></td>
                            <?php endforeach ?>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
    </div>
</div>