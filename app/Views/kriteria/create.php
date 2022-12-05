<div class="row">
    <div class="col-sm-6">
        <?= print_error() ?>
        <form method="post" action="<?= site_url('kriteria/store') ?>">
            <div class="form-group">
                <label>Kode kriteria <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_kriteria" value="<?= old('kode_kriteria', kode_oto('kode_kriteria', 'tb_kriteria', 'C', 2)) ?>" />
            </div>
            <div class="form-group">
                <label>Nama kriteria <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_kriteria" value="<?= old('nama_kriteria') ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="<?= site_url('kriteria') ?>"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>