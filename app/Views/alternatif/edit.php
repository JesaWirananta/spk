<div class="row">
    <div class="col-sm-6">
        <?= print_error() ?>
        <form method="post" action="<?= site_url('alternatif/update/' . $row->kode_alternatif) ?>">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_alternatif" value="<?= old('kode_alternatif', $row->kode_alternatif) ?>" readonly />
            </div>
            <div class="form-group">
                <label>Nama <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_alternatif" value="<?= old('nama_alternatif', $row->nama_alternatif) ?>" />
            </div>

            <div class="form-group">
                <label>NIM <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nim" value="<?= old('nim', $row->nim) ?>" />
            </div>

            <div class="form-group">
                <label> FAKULTAS <span class="text-danger">*</span></label>
                <select class="form-control" type="text" name="fakultas" value="<?= old('fakultas') ?>">
                    <option>FT</option>
                    <option>FBS</option>
                    <option>FIKKM</option>
                    <option>FIPP</option>
                    <option>FISH</option>
                    <option>FEB</option>
                    <option>FMIPAK</option>
                </select>
            </div>

            <?php foreach ($nilais as $key => $val) : ?>
                <div class="form-group">
                    <label><?= $kriterias[$val->kode_kriteria]->nama_kriteria ?> <span class="text-danger">*</span></label>
                    <select class="form-control" name="nilai[<?= $val->ID ?>]">
                        <?= get_crisp_option(old('nilai.' . $val->ID, $val->kode_crisp), $val->kode_kriteria) ?>
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