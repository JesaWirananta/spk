<div class="row">
    <div class="col-sm-6">
        <?= show_msg() ?>
        <?= print_error() ?>
        <form method="post" action="<?= site_url('user/password_update') ?>">
            <div class="form-group">
                <label>Password Lama<span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="pass1" />
            </div>
            <div class="form-group">
                <label>Password Baru<span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="pass2" />
            </div>
            <div class="form-group">
                <label>Conf. Password Baru <span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="pass3" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
            </div>
        </form>
    </div>
</div>