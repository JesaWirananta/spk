<?php
if (!session()->get('logged_in')) {
    header('location:' . site_url('user/login'));
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="<?= base_url('assets/favicon.ico') ?>" />

    <title>Source Code Forecasting Single Exponential Smoothing CodeIgniter</title>
    <link href="<?= base_url('assets/css/yeti-bootstrap.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/general.css') ?>" rel="stylesheet" />
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/highcharts.js') ?>"></script>
</head>

<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= site_url() ?>">AHP CI4</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <!-- <li><a href="<?= site_url('user') ?>"><span class="glyphicon glyphicon-user"></span> User</a></li> -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kriteria <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= site_url('kriteria') ?>">Kriteria</a></li>
                            <li><a href="<?= site_url('rel_kriteria') ?>">Bobot Kriteria</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Crisp <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= site_url('crisp') ?>">Crisp</a></li>
                            <li><a href="<?= site_url('rel_crisp') ?>">Bobot Crisp</a></li>
                        </ul>
                    </li>
                    <li><a href="<?= site_url('alternatif') ?>">Alternatif</a></li>
                    <li><a href="<?= site_url('hitung') ?>">Hitung</a></li>
                    <li><a href="<?= site_url('user/password') ?>"> Password</a></li>
                    <li><a href="<?= site_url('user/create') ?>"> Tambah</a></li>
                    <li><a href="<?= site_url('user/logout') ?>"> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="page-header">
            <h1><?= $title ?></h1>
        </div>