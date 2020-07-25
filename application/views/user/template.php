<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>User - <?=$section ?></title>

  <!-- Font Awesome Icons -->
  <link href="<?=base_url('assets/user/')?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="<?=base_url('assets/user/')?>vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="<?=base_url('assets/user/')?>css/creative.css" rel="stylesheet">

  <!-- datepicker -->
  <script src="<?=base_url('assets/user/')?>vendor/jquery/jquery.min.js"></script>
  <script src="<?=base_url('assets/')?>vendor/datepicker/js/bootstrap-datepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendor/datepicker/css/datepicker.css">

</head>

<?php 
$hal = $this->uri->segment(1);
$aktif = 'active';

 ?>

<body id="page-top">
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 navShadow navbar-scrolled" id="mainNav">
    <div class="container">
      <a class="navbar-brand p-0" href="<?=base_url() ?>"><img src="<?=base_url('assets/img/imm2.png')?>" width="25px"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link <?=($hal=='')?$aktif:''; ?>" href="<?=base_url('') ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?=($hal=='rangking')?$aktif:''; ?>" href="<?=base_url('rangking')?>">Rangking</a>
          </li>

            <?php 
            if($this->session->userdata('masuk')==TRUE && $this->session->userdata('access')=='user'){ ?>
              <li class="nav-item">
                <a class="nav-link <?=($hal=='kriteria'||$hal=='tambah_kriteria'||$hal=='save_kriteria')?$aktif:''; ?>" href="<?=base_url('kriteria') ?>">Input Kriteria</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?=($hal=='profile'||$hal=='edit_profile'||$hal=='update_profile'||$hal=='ubah_password')?$aktif:''; ?>" href="<?=base_url('profile') ?>">Data Diri</a>
              </li>
              <li class="nav-item login">
                <a class="btn btn-info btn-sm" href="<?=base_url('logout') ?>">Logout</a>
              </li>
            <?php }else{ ?>
            <li class="nav-item login">
              <a class="btn btn-danger btn-sm" href="<?=base_url('login') ?>">Login</a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>


  <?php 
    if(!defined('BASEPATH')) exit ('No direct script access allowed');
    if($content){$this->load->view($content);}
  ?>
 

  

  <!-- Footer -->
  <footer class="bg-dark py-5">
    <div class="container">
      <div class="small text-center text-muted">Copyright &copy; 2019 - Start Bootstrap</div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="<?=base_url('assets/user/')?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="<?=base_url('assets/user/')?>vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?=base_url('assets/user/')?>vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="<?=base_url('assets/user/')?>js/creative.js"></script>

</body>

</html>
