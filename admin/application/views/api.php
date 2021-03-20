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
    <div class="content-fluid">
        <div class="row">
            <section class=" col-lg-6 connectedSortable">
            
                <div class="card card-outline card-primary">
                    <div class="card-header">
                    <h3 class="card-title">Clear Out API Config</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    
                        <form name="clear-out-api" id="clear-out-api"  enctype="multipart/form-data">
                            
                            <div class="clear-out-api">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <div class="form-group">
                                            <input type="text" id="clear-out-api-name" name="api-name" placeholder="API Name" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                            <input type="text" id="clear-out-timeout" name="time-out" placeholder="Delay b/w APIs" class="form-control" required>
                                        </div>
                                    </div>  
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                    <div class="form-group">
                                        <input type="text" id="clear-out-auth-token" name="auth-token" placeholder="Auth Token" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                        <input type="text" id="clear-out-api-url" name="api-url" placeholder="Clear out url" class="form-control" required>
                                        </div>
                                    </div>                 
                                
                                    <input type="hidden" id="clear-out-hook-type" name="hook-type"/>

                                </div>

                                <div class="row text-right">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary">Save <span class="fa fa-check"></span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            
            </section>

            <section class="col-lg-6 connectedSortable">
                <div class="card card-outline card-success">
                    <div class="card-header">
                    <h3 class="card-title">Clear Phone API Config</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    
                        <form method="post" id="clear-phone-api">
                            
                            <div class="clear-phone-api">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <div class="form-group">
                                            <input type="text" id="clear-phone-api-name" name="api-name" placeholder="API Name" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                            <input type="text" id="clear-phone-timeout" name="time-out" placeholder="Delay b/w APIs" class="form-control" required>
                                        </div>
                                    </div>  
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                    <div class="form-group">
                                        <input type="text" id="clear-phone-auth-token" name="auth-token" placeholder="Auth Token" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                        <input type="text" id="clear-phone-api-url" name="api-url" placeholder="Clear out url" class="form-control" required>
                                        </div>
                                    </div>                 
                                
                                    <input type="hidden" id="clear-phone-hook-type" name="hook-type"/>

                                </div>

                                <div class="row text-right">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success">Save  <span class="fa fa-check"></span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </section>
        </div>

        <div class="row">
            <section class=" col-lg-6 connectedSortable">
            
                <div class="card card-outline card-danger">
                    <div class="card-header">
                    <h3 class="card-title">Zapier Business Campagin</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    
                        <form method="post" id="zapier-business-api">
                            
                            <div class="zapier-business-api">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <div class="form-group">
                                            <input type="text" id="zapier-business-api-name" name="api-name" placeholder="API Name" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                            <input type="text" id="zapier-business-timeout" name="time-out" placeholder="Delay b/w APIs" class="form-control" required>
                                        </div>
                                    </div>  
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                    <div class="form-group">
                                        <input type="text" id="zapier-business-auth-token" name="auth-token" placeholder="Auth Token" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                        <input type="text" id="zapier-business-api-url" name="api-url" placeholder="Clear out url" class="form-control" required>
                                        </div>
                                    </div>                 
                                
                                    <input type="hidden" id="zapier-business-hook-type" name="hook-type"/>

                                </div>

                                <div class="row text-right">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-danger">Save <span class="fa fa-check"></span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            
            </section>

            <section class="col-lg-6 connectedSortable">
                <div class="card card-outline card-warning">
                    <div class="card-header">
                    <h3 class="card-title">Zapier Edu Free Mail Compagin</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    
                        <form method="post" id="zapier-edu-free-mail-api">
                            
                            <div class="zapier-edu-free-mail-api">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <div class="form-group">
                                            <input type="text" id="zapier-edu-free-mail-api-name" name="api-name" placeholder="API Name" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                            <input type="text" id="zapier-edu-free-mail-timeout" name="time-out" placeholder="Delay b/w APIs" class="form-control" required>
                                        </div>
                                    </div>  
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                    <div class="form-group">
                                        <input type="text" id="zapier-edu-free-mail-auth-token" name="auth-token" placeholder="Auth Token" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                        <input type="text" id="zapier-edu-free-mail-api-url" name="api-url" placeholder="Clear out url" class="form-control" required>
                                        </div>
                                    </div>                 
                                
                                    <input type="hidden" name="hook-type" id="zapier-edu-free-hook-type"/>

                                    

                                </div>

                                <div class="row text-right">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-warning">Save  <span class="fa fa-check"></span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </section>
        </div>

        <div class="row">
            <section class=" col-lg-6 connectedSortable">
            
                <div class="card card-outline card-info">
                    <div class="card-header">
                    <h3 class="card-title">Zapier Edu Campagin</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    
                        <form method="post" id="zapier-edu-api">
                            
                            <div class="zapier-edu-api">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <div class="form-group">
                                            <input type="text" id="zapier-edu-api-name" name="api-name" placeholder="API Name" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                            <input type="text" id="zapier-edu-timeout" name="time-out" placeholder="Delay b/w APIs" class="form-control" required>
                                        </div>
                                    </div>  
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                    <div class="form-group">
                                        <input type="text" id="zapier-edu-auth-token" name="auth-token" placeholder="Auth Token" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                        <input type="text" id="zapier-edu-api-url" name="api-url" placeholder="Clear out url" class="form-control" required>
                                        </div>
                                    </div>                 
                                
                                    

                                    <input type="hidden" id="zapier-edu-hook-type" name="hook-type"/>

                                </div>

                                <div class="row text-right">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-info">Save <span class="fa fa-check"></span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            
            </section>

            <section class="col-lg-6 connectedSortable">
                <div class="card card-outline card-default">
                    <div class="card-header">
                    <h3 class="card-title">Zapier Home Campaign</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    
                        <form method="post" id="zapier-home-api">
                            
                            <div class="zapier-home-api">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <div class="form-group">
                                            <input type="text" id="zapier-home-api-name" name="api-name" placeholder="API Name" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                            <input type="text" id="zapier-home-timeout" name="time-out" placeholder="Delay b/w APIs" class="form-control" required>
                                        </div>
                                    </div>  
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                    <div class="form-group">
                                        <input type="text" id="zapier-home-auth-token" name="auth-token" placeholder="Auth Token" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                        <input type="text" id="zapier-home-api-url" name="api-url" placeholder="Clear out url" class="form-control" required>
                                        </div>
                                    </div>                 

                                    <input type="hidden" id="zapier-home-hook-type" name="hook-type"/>
                                
                                    

                                </div>

                                <div class="row text-right">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-default">Save  <span class="fa fa-check"></span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </section>
        </div>


        <div class="row">
            <section class=" col-lg-6 connectedSortable">
            
                <div class="card card-outline card-primary">
                    <div class="card-header">
                    <h3 class="card-title">Zapier Research Task</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    
                        <form method="post" id="zapier-research-task">
                            
                            <div class="zapier-research-task">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <div class="form-group">
                                            <input type="text" id="zapier-research-task-api-name" name="api-name" placeholder="API Name" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                            <input type="text" id="zapier-research-task-timeout" name="time-out" placeholder="Delay b/w APIs" class="form-control" required>
                                        </div>
                                    </div>  
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                    <div class="form-group">
                                        <input type="text" id="zapier-research-task-auth-token" name="auth-token" placeholder="Auth Token" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                        <input type="text" id="zapier-research-task-api-url" name="api-url" placeholder="Clear out url" class="form-control" required>
                                        </div>
                                    </div>                 
                                
                                    

                                    <input type="hidden" id="zapier-research-task-hook-type" name="hook-type"/>

                                </div>

                                <div class="row text-right">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary">Save <span class="fa fa-check"></span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            
            </section>

            <section class="col-lg-6 connectedSortable">
                <div class="card card-outline card-warning">
                    <div class="card-header">
                    <h3 class="card-title">Zapier Call Follow Up Task</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    
                        <form method="post" id="zapier-call-follow-up-api">
                            
                            <div class="zapier-call-follow-up-api">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <div class="form-group">
                                            <input type="text" id="zapier-call-follow-up-api-name" name="api-name" placeholder="API Name" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                            <input type="text" id="zapier-call-follow-up-timeout" name="time-out" placeholder="Delay b/w APIs" class="form-control" required>
                                        </div>
                                    </div>  
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                    <div class="form-group">
                                        <input type="text" id="zapier-call-follow-up-auth-token" name="auth-token" placeholder="Auth Token" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                        <input type="text" id="zapier-call-follow-up-api-url" name="api-url" placeholder="Clear out url" class="form-control" required>
                                        </div>
                                    </div>                 

                                    <input type="hidden" id="zapier-call-follow-up-hook-type" name="hook-type"/>
                                
                                    

                                </div>

                                <div class="row text-right">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-warning">Save  <span class="fa fa-check"></span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </section>
        </div>
    </div>
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


$('#clear-out-api').on('submit', function( event ){
    event.preventDefault();        

    if(true){
      $.confirm({
        title: 'Alert!',
        content: `The will override the current <b>Clear Out</b> API configuration are you still want to continue! `,
        type: 'blue',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Okay',
                btnClass: 'btn-primary',
                action: function(){
                  $('#loading').addClass('loading');
                  submitClearOut();
                }
            },
            close: function () {

            }
        }
      });
    }
    
    
});

var submitClearOut = function(){
  var dataToSend =  $('#clear-out-api').serialize();
  $.ajax({  
      url: "api/submitForm",
      data: dataToSend,
      type: "post",
      dataType: 'json',
      success: function (response) {
          //$('#loading').removeClass('loading');
          //response = JSON.parse(response);
          if(response && response.isSuccess == true){
            toastr.success('Clear Out API configuration updated !');
          }         

      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
}



$('#clear-phone-api').on('submit', function( event ){
    event.preventDefault();        

    if(true){
      $.confirm({
        title: 'Alert!',
        content: `The will override the current <b>Clear Phone</b> API configuration are you still want to continue! `,
        type: 'green',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Okay',
                btnClass: 'btn-green',
                action: function(){
                 // $('#loading').addClass('loading');
                  submitClearPhone();
                }
            },
            close: function () {

            }
        }
      });
    }
    
    
});


var submitClearPhone = function(){
  var dataToSend =  $('#clear-phone-api').serialize();
  $.ajax({  
      url: "api/submitForm",
      data: dataToSend,
      type: "post",
      dataType: 'json',
      success: function (response) {
          //$('#loading').removeClass('loading');
          //response = JSON.parse(response);
          if(response && response.isSuccess == true){
            toastr.success('Clear Phone API configuration updated !');
          }         

      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
}


$('#zapier-business-api').on('submit', function( event ){
    event.preventDefault();        

    if(true){
      $.confirm({
        title: 'Alert!',
        content: `The will override the current <b>Zapier Business Compagin</b> API configuration are you still want to continue! `,
        type: 'red',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Okay',
                btnClass: 'btn-red',
                action: function(){
                 // $('#loading').addClass('loading');
                 submitZapierBusiness();
                }
            },
            close: function () {

            }
        }
      });
    }
    
    
});

var submitZapierBusiness = function(){
  var dataToSend =  $('#zapier-business-api').serialize();
  $.ajax({  
      url: "api/submitForm",
      data: dataToSend,
      type: "post",
      dataType: 'json',
      success: function (response) {
          //$('#loading').removeClass('loading');
          //response = JSON.parse(response);
          if(response && response.isSuccess == true){
            toastr.success('Zapier Business Compagin API configuration updated !');
          }         

      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
}



$('#zapier-edu-api').on('submit', function( event ){
    event.preventDefault();        

    if(true){
      $.confirm({
        title: 'Alert!',
        content: `The will override the current <b>Zapier EDU Compagin</b> API configuration are you still want to continue! `,
        type: 'info',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Okay',
                btnClass: 'btn-info',
                action: function(){
                 // $('#loading').addClass('loading');
                 submitZapierEdu();
                }
            },
            close: function () {

            }
        }
      });
    }
    
    
});


var submitZapierEdu = function(){
  var dataToSend =  $('#zapier-edu-api').serialize();
  $.ajax({  
      url: "api/submitForm",
      data: dataToSend,
      type: "post",
      dataType: 'json',
      success: function (response) {
          //$('#loading').removeClass('loading');
          //response = JSON.parse(response);
          if(response && response.isSuccess == true){
            toastr.success('Zapier Edu Compagin API configuration updated !');
          }         

      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
}


$('#zapier-edu-free-mail-api').on('submit', function( event ){
    event.preventDefault();        

    if(true){
      $.confirm({
        title: 'Alert!',
        content: `The will override the current <b>Zapier EDU Free Mail Compagin</b> API configuration are you still want to continue! `,
        type: 'info',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Okay',
                btnClass: 'btn-info',
                action: function(){
                 // $('#loading').addClass('loading');
                 submitZapierEduFreeMail();
                }
            },
            close: function () {

            }
        }
      });
    }
    
    
});



var submitZapierEduFreeMail = function(){
  var dataToSend =  $('#zapier-edu-free-mail-api').serialize();
  $.ajax({  
      url: "api/submitForm",
      data: dataToSend,
      type: "post",
      dataType: 'json',
      success: function (response) {
          //$('#loading').removeClass('loading');
          //response = JSON.parse(response);
          if(response && response.isSuccess == true){
            toastr.success('Zapier Edu Compagin API configuration updated !');
          }         

      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
}




$('#zapier-home-api').on('submit', function( event ){
    event.preventDefault();        

    if(true){
      $.confirm({
        title: 'Alert!',
        content: `The will override the current <b>Zapier Home Compagin</b> API configuration are you still want to continue! `,
        type: 'default',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Okay',
                btnClass: 'btn-default',
                action: function(){
                 // $('#loading').addClass('loading');
                 submitZapierHome();
                }
            },
            close: function () {

            }
        }
      });
    }
    
    
});

var submitZapierHome = function(){
  var dataToSend =  $('#zapier-home-api').serialize();
  $.ajax({  
      url: "api/submitForm",
      data: dataToSend,
      type: "post",
      dataType: 'json',
      success: function (response) {
          //$('#loading').removeClass('loading');
          //response = JSON.parse(response);
          if(response && response.isSuccess == true){
            toastr.success('Zapier Home Compagin API configuration updated !');
          }         

      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
}





$('#zapier-research-task').on('submit', function( event ){
    event.preventDefault();        

    if(true){
      $.confirm({
        title: 'Alert!',
        content: `The will override the current <b>Zapier Research Task</b> API configuration are you still want to continue! `,
        type: 'blue',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Okay',
                btnClass: 'btn-primary',
                action: function(){
                  $('#loading').addClass('loading');
                  submitResearchTask();
                }
            },
            close: function () {

            }
        }
      });
    }
    
    
});

var submitResearchTask = function(){
  var dataToSend =  $('#zapier-research-task').serialize();
  $.ajax({  
      url: "api/submitForm",
      data: dataToSend,
      type: "post",
      dataType: 'json',
      success: function (response) {
          //$('#loading').removeClass('loading');
          //response = JSON.parse(response);
          if(response && response.isSuccess == true){
            toastr.success('Zapier Research Task API Configuration Updated !');
          }         

      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
}



$('#zapier-call-follow-up-api').on('submit', function( event ){
    event.preventDefault();        

    if(true){
      $.confirm({
        title: 'Alert!',
        content: `The will override the current <b>Zapier Call Follow Up Task</b> API configuration are you still want to continue! `,
        type: 'blue',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Okay',
                btnClass: 'btn-primary',
                action: function(){
                  $('#loading').addClass('loading');
                  submitCallFollowUpTask();
                }
            },
            close: function () {

            }
        }
      });
    }
    
    
});

var submitCallFollowUpTask = function(){
  var dataToSend =  $('#zapier-call-follow-up-api').serialize();
  $.ajax({  
      url: "api/submitForm",
      data: dataToSend,
      type: "post",
      dataType: 'json',
      success: function (response) {
          //$('#loading').removeClass('loading');
          //response = JSON.parse(response);
          if(response && response.isSuccess == true){
            toastr.success('Zapier Call Follow Up Task API Configuration Updated !');
          }         

      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
}







var getClearOut = function(){
  $.ajax({  
      type: "GET",
      url: "api/getHookDetails?hookType="+<?php echo HOOK_TYPE_CLEAROUT ?>,
      processData: false,
      contentType: 'application/json',
      cache: false,
      timeout: 600000,
      
      success: function (response) {
          //$('#loading').removeClass('loading');
          response = JSON.parse(response);
          if(response[0] && response.length > 0){
              $('#clear-out-api-name').val(response[0].name);
              $('#clear-out-timeout').val(response[0].delay_between_posts);
              $('#clear-out-auth-token').val(response[0].auth_token);
              $('#clear-out-api-url').val(response[0].url);
              $('#clear-out-hook-type').val(response[0].hook_type);
          }

      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
}

var getClearPhone = function(){
  $.ajax({  
      type: "GET",
      url: "api/getHookDetails?hookType="+<?php echo HOOK_TYPE_CLEARPHONE ?>,
      processData: false,
      contentType: 'application/json',
      cache: false,
      timeout: 600000,
      
      success: function (response) {
          //$('#loading').removeClass('loading');
          response = JSON.parse(response);
          if(response[0] && response.length > 0){
              $('#clear-phone-api-name').val(response[0].name);
              $('#clear-phone-timeout').val(response[0].delay_between_posts);
              $('#clear-phone-auth-token').val(response[0].auth_token);
              $('#clear-phone-api-url').val(response[0].url);
              $('#clear-phone-hook-type').val(response[0].hook_type);
              
          }

      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
}

var getZapierBusiness = function(){
  $.ajax({  
      type: "GET",
      url: "api/getHookDetails?hookType="+<?php echo HOOK_TYPE_BUSINESS ?>,
      processData: false,
      contentType: 'application/json',
      cache: false,
      timeout: 600000,
      
      success: function (response) {
          //$('#loading').removeClass('loading');
          response = JSON.parse(response);
          if(response[0] && response.length > 0){
              $('#zapier-business-api-name').val(response[0].name);
              $('#zapier-business-timeout').val(response[0].delay_between_posts);
              $('#zapier-business-auth-token').val(response[0].auth_token);
              $('#zapier-business-api-url').val(response[0].url);
              $('#zapier-business-hook-type').val(response[0].hook_type);              
          }

      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
}


var getZapierEduFreeMail = function(){
  $.ajax({  
      type: "GET",
      url: "api/getHookDetails?hookType="+<?php echo HOOK_TYPE_EDU_FREE_MAIL ?>,
      processData: false,
      contentType: 'application/json',
      cache: false,
      timeout: 600000,
      
      success: function (response) {
          //$('#loading').removeClass('loading');
          response = JSON.parse(response);
          if(response[0] && response.length > 0){
              $('#zapier-edu-free-mail-api-name').val(response[0].name);
              $('#zapier-edu-free-mail-timeout').val(response[0].delay_between_posts);
              $('#zapier-edu-free-mail-auth-token').val(response[0].auth_token);
              $('#zapier-edu-free-mail-api-url').val(response[0].url);
              $('#zapier-edu-free-hook-type').val(response[0].hook_type);
          }

      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
}

var getZapierEdu = function(){
  $.ajax({  
      type: "GET",
      url: "api/getHookDetails?hookType="+<?php echo HOOK_TYPE_EDU ?>,
      processData: false,
      contentType: 'application/json',
      cache: false,
      timeout: 600000,
      
      success: function (response) {
          //$('#loading').removeClass('loading');
          response = JSON.parse(response);
          if(response[0] && response.length > 0){
              $('#zapier-edu-api-name').val(response[0].name);
              $('#zapier-edu-timeout').val(response[0].delay_between_posts);
              $('#zapier-edu-auth-token').val(response[0].auth_token);
              $('#zapier-edu-api-url').val(response[0].url);
              $('#zapier-edu-hook-type').val(response[0].hook_type);
          }

      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
}

var getZapierHome = function(){
  $.ajax({  
      type: "GET",
      url: "api/getHookDetails?hookType="+<?php echo HOOK_TYPE_HOME ?>,
      processData: false,
      contentType: 'application/json',
      cache: false,
      timeout: 600000,
      
      success: function (response) {
          //$('#loading').removeClass('loading');
          response = JSON.parse(response);
          if(response[0] && response.length > 0){
              $('#zapier-home-api-name').val(response[0].name);
              $('#zapier-home-timeout').val(response[0].delay_between_posts);
              $('#zapier-home-auth-token').val(response[0].auth_token);
              $('#zapier-home-api-url').val(response[0].url);
              $('#zapier-home-hook-type').val(response[0].hook_type);
          }

      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
}


var getZapierResearchTask = function(){
  $.ajax({  
      type: "GET",
      url: "api/getHookDetails?hookType="+<?php echo HOOK_TYPE_RESEARCH_TASK ?>,
      processData: false,
      contentType: 'application/json',
      cache: false,
      timeout: 600000,
      
      success: function (response) {
          //$('#loading').removeClass('loading');
          response = JSON.parse(response);
          if(response[0] && response.length > 0){
              $('#zapier-research-task-api-name').val(response[0].name);
              $('#zapier-research-task-timeout').val(response[0].delay_between_posts);
              $('#zapier-research-task-auth-token').val(response[0].auth_token);
              $('#zapier-research-task-api-url').val(response[0].url);
              $('#zapier-research-task-hook-type').val(response[0].hook_type);
          }

      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
}


var getZapierCallFollowUpTask = function(){
  $.ajax({  
      type: "GET",
      url: "api/getHookDetails?hookType="+<?php echo HOOK_TYPE_CALL_TASK ?>,
      processData: false,
      contentType: 'application/json',
      cache: false,
      timeout: 600000,
      
      success: function (response) {
          //$('#loading').removeClass('loading');
          response = JSON.parse(response);
          if(response[0] && response.length > 0){
              $('#zapier-call-follow-up-api-name').val(response[0].name);
              $('#zapier-call-follow-up-timeout').val(response[0].delay_between_posts);
              $('#zapier-call-follow-up-auth-token').val(response[0].auth_token);
              $('#zapier-call-follow-up-api-url').val(response[0].url);
              $('#zapier-call-follow-up-hook-type').val(response[0].hook_type);
          }

      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
}
$(document).ready(function(){
    getClearOut();
    getClearPhone();
    getZapierBusiness();
    getZapierEduFreeMail();
    getZapierEdu();
    getZapierHome();
    getZapierResearchTask();
    getZapierCallFollowUpTask();
});
  
</script>