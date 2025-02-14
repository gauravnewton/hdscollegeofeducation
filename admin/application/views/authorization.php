<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>H. D. S. College (Authorization)</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--site fav icon -->
  <!-- <link rel="icon" href="<?=base_url()?>assets/dist/img/LOGO AUFIERO GRANDE.png" > -->

  <!-- Custom Style -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url() ?>assets/dist/css/custom-style.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url() ?>assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo $this->config->base_url() ?>assets/plugins/toastr/toastr.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <div class="row">
      <div class="col-sm-12">
      <!-- <img src='<?=base_url()?>assets/dist/img/LOGO AUFIERO GRANDE.png' class="img-responsive brand-logo"/> -->
      </div>
    </div>
    <a href=""><b>H. D. S. College </b> <small>of Education</small></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="<?php echo base_url() ?>accounts/login" method="post" id="authorization">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="form-group">
                  <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                      <input type="checkbox" class="custom-control-input" id="login-type" name="login-type">
                      <label class="custom-control-label" for="login-type">Login as admin</label>
                  </div>
              </div>
          </div>
        </div>



        <div class="social-auth-links text-center mb-3">
            <button type="submit" class="btn btn-block btn-primary">
            <i class="ionicons ion-log-in"></i> Sign in 
            </button>
            <!-- <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </a> -->
        </div>
        <!-- /.social-auth-links -->

        <p class="mb-1">
            <a href="forgot-password.html">I forgot my password</a>
        </p>
        <!-- <p class="mb-0">
            <a href="register.html" class="text-center">Register a new membership</a>
        </p> -->
      </form>


      
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo $this->config->base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo $this->config->base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $this->config->base_url() ?>assets/dist/js/adminlte.min.js"></script>

<!-- Toastr -->
<script src="<?php echo $this->config->base_url() ?>assets/plugins/toastr/toastr.min.js"></script>
<!-- Validate -->
<script src="<?php echo $this->config->base_url() ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
  


<script type="text/javascript">
    $(function () {
      <?php
       if($successMessage = $this->session->flashdata('success'))
       {
         ?>
         toastr.success('<?php echo $successMessage ?>');
         <?php
       }else if($errorMessage =  $this->session->flashdata('error')){
        ?>
        toastr.error('<?php echo $errorMessage ?>');
        <?php
       }          
      ?>
    });
    
  </script>
</body>
</html>
