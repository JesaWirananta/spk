<?= show_msg() ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?= $q ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="<?= site_url('alternatif/create') ?>"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama alternatif</th>
                    <th>NIM</th>
                    <th>FAKULTAS</th>
                    <?php foreach ($kriteria as $key => $val) : ?>
                        <th><?= $val->nama_kriteria ?></th>
                    <?php endforeach ?>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php foreach ($rows as $row) : ?>
                <tr>
                    <td><?= $row->kode_alternatif ?></td>
                    <td><?= $row->nama_alternatif ?></td>
                    <td><?= $row->nim ?></td>
                    <td><?= $row->fakultas ?></td>
                    <?php foreach ($rel_alternatif[$row->kode_alternatif] as $k => $v) : ?>
                        <td><?= isset($crisp[$v]) ? $crisp[$v]->nama_crisp : $v ?></td>
                    <?php endforeach ?>
                    <td>
                        <a class="btn btn-xs btn-warning" href="<?= site_url("alternatif/edit/$row->kode_alternatif") ?>"><span class="glyphicon glyphicon-edit"></span></a>
                        <a class="btn btn-xs btn-danger" href="<?= site_url("alternatif/destroy/$row->kode_alternatif") ?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>