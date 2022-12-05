<div class="row">
    <div class="col-sm-6">
        <?= print_error() ?>
        <form method="post" action="<?= site_url('crisp/store') ?>">
            <div class="form-group">
                <label>Kode crisp <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_crisp" value="<?= old('kode_crisp', kode_oto('kode_crisp', 'tb_crisp', 'X', 2)) ?>" />
            </div>
            <div class="form-group">
                <label>Kriteria <span class="text-danger">*</span></label>
                <select class="form-control" name="kode_kriteria">
                    <?= get_kriteria_option(old('kode_kriteria')) ?>
                </select>
            </div>
            <div class="form-group">
                <label>Nama crisp <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_crisp" value="<?= old('nama_crisp') ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="<?= site_url('crisp') ?>"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>