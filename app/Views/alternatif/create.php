<div class="row">
    <div class="col-sm-6">
        <?= print_error() ?>
        <form method="post" action="<?= site_url('alternatif/store') ?>">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_alternatif" value="<?= old('kode_alternatif', kode_oto('kode_alternatif', 'tb_alternatif', 'A', 2)) ?>" />
            </div>
            <div class="form-group">
                <label>Nama <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_alternatif" value="<?= old('nama_alternatif') ?>" />
            </div>


            <div class="form-group">
                <label>NIM <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nim" value="<?= old('nim') ?>" />
            </div>


            <!-- <div class="form-group">
                <label>FAKULTAS <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="fakultas" value="<?= old('fakultas') ?>" />
            </div> -->

            <div class="form-group">
                <label> FAKULTAS <span class="text-danger">*</span></label>
                <select class="form-control" type="text" name="fakultas" value="<?= old('fakultas') ?>">
                    <option>FT</option>
                    <option>FIK</option>
                    <option>FMIPA</option>
                    <option>FIS</option>
                    <option>FBS</option>
                    <option>FIP</option>
                </select>
            </div>



            <?php foreach ($KRITERIA as $key => $val) : ?>
                <div class="form-group">
                    <label><?= $val->nama_kriteria ?> <span class="text-danger">*</span></label>
                    <select class="form-control" name="nilai[<?= $key ?>]">
                        <?= get_crisp_option(old('nilai.' . $key), $key) ?>
                    </select>
                </div>
            <?php endforeach ?>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="<?= site_url('alternatif') ?>"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>