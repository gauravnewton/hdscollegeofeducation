<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include ('includes/header.php'); ?>

<div class="wrapper">

  <!-- navbar -->
  <?php include ('includes/navbar.php'); ?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo $this->config->base_url() ?>dashboard" class="brand-link">
      <img src="<?=base_url()?>assets/dist/img/LOGO AUFIERO GRANDE.png" alt="LA" class="brand-image "
           style="opacity: .8">
      <span class="brand-text font-weight-light">&nbsp;</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $this->config->base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            <?php 
              echo  $this->session->userdata('name');
            ?>
          </a>
        </div>
      </div>

      <!-- Main Menu -->
      <?php include ('includes/mainMenu.php'); ?>

      
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- including Breadcum -->
    <?php include('includes/breadCum.php'); ?>

    <!-- Main content -->
    <section class="content">
     
    <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">User Registration</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              
                <form action="<?php echo base_url() ?>user/savingUserData"  method="post" id="user-registration" enctype="multipart/form-data">
                        
                  <div class="user-registration">


                    <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" name="fullName" placeholder="Full name" class="form-control">
                          </div>
                      </div>
                    
                    
                      <div class="col-sm-6">
                          <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="text" name="email" placeholder="Email Address" class="form-control">
                          </div>
                      </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="conf_password">Confirm Password</label>
                            <input type="password" name="conf_password" placeholder="Confirm Password" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="role">Role</label>
                            <select name="role"  class="form-control">
                                <option value="" disabled selected>Choose Role</option>
                                <option value="<?php echo ROLE_ADMIN ?>">Admin</option>
                                <option value="<?php echo ROLE_UPLOAD ?>">Upload only</option>
                                <option value="<?php echo ROLE_DOWNLOAD ?>">Download Only</option>
                                <option value="<?php echo ROLE_DOWNLOAD_UPLOAD ?>">Upload and Download</option>
                            </select>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="apiKey">API Key</label>
                            <input type="text" name="apiKey" placeholder="API Key" class="form-control">
                        </div>
                    </div>

               
          
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancle <span class="fa fa-close"></sapn></button>
                        <button type="submit" class="btn btn-primary">Save <span class="fa fa-check"></span></button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>

          



    </section>
    <!-- /.content -->
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
  <?php include('includes/copyRightInfo.php'); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include ('includes/footer.php'); ?>

<script tyep="text/javascript">

$(document).ready(function(){
  
});
  
</script>