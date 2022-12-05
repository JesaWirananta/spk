<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>LOGIN</title>
    <link rel="icon" href="<?= base_url('favicon.ico') ?>" />
    <link href="<?= base_url('assets/css/yeti-bootstrap.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/general.css') ?>" rel="stylesheet" />
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
</head>

<body>
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">Silahkan Masuk</div>
                    <div class="panel-body">
                        <?= print_error() ?>
                        <form method="post" action="<?= site_url('user/login_action') ?>">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username" name="user" autofocus value="<?= old('user') ?>" />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" name="pass" />
                            </div>


                            <button class="btn btn-primary btn-block" type="submit">Masuk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('.form-control').attr('autocomplete', 'off');
    </script>
</body>

</html>