<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$judul;?></title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>konten/images/logo.png"> <!--link icon-->
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/font-awesome/css/font-awesome.min.css">    
    <link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page" style="background: #ffffff url(konten/images/back1.jpg) left bottom fixed;">
  <nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
     <!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>-->
      <img src="<?php echo base_url(); ?>konten/images/logo.png" style="width:50px;height:50px"></div>
      <a class="navbar-brand" href="<?=base_url();?>" style="color:white;">Sistem Pendukung Keputusan Pemilihan Gedung</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <!--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
      <li><a href="http://www.codeberkas.xyz/">Code Berkas</a></li>
      <li><a href="http://kautube.com/">Kautube</a></li> 
      </ul>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="login-box-body">
        <h3 class="login-box-msg"><b>UPT. Taman Budaya Jawa Timur</b></h3>
        <form action="<?=base_url();?>login" method="post">
          <div class="form-group has-feedback">
            <label for="InputUsername1">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Username" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label for="InputPassword1">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <small><small><p style="color:#f56954">
              Pastikan username dan password sudah terdaftar <br>
              agar dapat mengakses Sistem Pendukung Keputusan Pemilihan Gedung
              pada "UPT. Taman Budaya Jawa Timur"
          </p></small></small>          
          <div class="row">                      
            <div class="col-xs-4">
              <button type="submit" class="btn btn-success btn-block btn-flat">Sign In</button><br>
              <a href="<?=base_url();?>register" style="color:black;"><u>Register</u></a>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?=base_url();?>konten/tema/lte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?=base_url();?>konten/tema/lte/bootstrap/js/bootstrap.min.js"></script>    
  </body>
</html>
