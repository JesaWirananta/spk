<?= show_msg() ?>
<?= print_error() ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline" method="POST" action="<?= site_url('rel_kriteria/update') ?>">
            <div class="form-group">
                <select class="form-control" name="ID1">
                    <?= get_kriteria_option(old('ID1')) ?>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="nilai">
                    <?= get_nilai_option(old('nilai')) ?>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="ID2">
                    <?= get_kriteria_option(old('ID2')) ?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
            </div>
        </form>
    </div>

    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <?php foreach ($kriteria as $key => $val) : ?>
                    <th><?= $key ?></th>
                <?php endforeach ?>
            </tr>
        </thead>
        <?php foreach ($rel_kriteria as $key => $val) : ?>
            <tr>
                <td><?= $key ?></td>
                <td><?= $kriteria[$key]->nama_kriteria ?></td>
                <?php foreach ($val as $k => $v) : ?>
                    <td><?= round($v, 3) ?></td>
                <?php endforeach ?>
            </tr>
        <?php endforeach ?>
    </table>
</div>