<div class="row">
    <div class="col-sm-6">
        <?= show_msg() ?>
        <?= print_error() ?>
        <form method="post" action="<?= site_url('user/store') ?>">
            <div class="form-group">
                <label>ID user<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="id_user" />
            </div>
            <div class="form-group">
                <label>Username<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="user" />
            </div>
            <div class="form-group">
                <label>name<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_user" />
            </div>
            <div class="form-group">
                <label>Password <span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="pass" />
            </div>

            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
            </div>
        </form>
    </div>
</div>