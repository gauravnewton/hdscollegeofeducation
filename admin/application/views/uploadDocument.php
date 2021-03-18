<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include ('includes/header.php'); ?>



<!-- loader -->
<div id="loading">
   
</div>
<!-- loader -->


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
            <h3 class="card-title">Upload Batch</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body">
          
            <form  method="post" id="uploadDocument" enctype="multipart/form-data">
                    
              <div class="uploadDocument">

                <div class="row">
                  <div class="col-sm-12">
                    <div class="pull-right text-white">
                      <a class="btn btn-sm btn-primary" title="Document upload instruction" data-toggle="modal" data-target="#view-xl">
                        <i class="fas fa-question"></i>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-2">
                      &nbsp;
                  </div>
                
                
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label for="brand">Select Brand</label>
                        <select name="brand" id="brand" class="form-control select2" style="width: 100%;" required>
                            <option value="" disabled selected>Choose Brand First</option>
                        </select>
                      </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-sm-2">&nbsp;</div>
                  <div class="col-sm-6">
                    <label for="fileFormat">File Encoding Schema</label>
                    <select name="fileEncoding" id="fileEncoding" class="form-control select2" style="width: 100%;" required>
                        <option value="" disabled selected>Choose Encoding Schema</option>
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-2">
                      &nbsp;
                  </div>
                
                
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label for="brandFile">Choose a file to upload</label>
                        <input type="file" name="brandFile" id="brandFile" placeholder="brandFile" class="form-control" style="border:0px;">                            
                      </div>
                  </div>
                </div>

                <!-- <div class="row">
                    <div clss="col-sm-12">
                        <input id="range_6" type="text" name="range_6" value="">
                    </div>
                </div> -->

            
      
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



    <div class="modal fade" id="view-xl" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          
          <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fa fa-question"> </i> Document upload instruction</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <ul>
                <li>
                  Select a brand first from drop down
                </li>
                <li>
                  Choose a file to upload make sure the file format is exact matches with the template of brand you selected.
                </li>
                <li>
                  The uploaded file's structure should be same with brand's template structure
                </li>
                <li>
                  Only CSV, Xls and Xlsx files are supported till now.
                </li>
              </ul>
            </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
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

<script>

$(document).ready(function(){


    var encodings = <?php echo(json_encode(mb_list_encodings())) ?>;

    $(encodings).each(function(index,value){
        $('#fileEncoding').append('<option value="'+value+'">'+value+'</option>');                 
    })

    $('#fileEncoding').val("UTF-8").trigger('change');

    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })


    populateAllBrands();

    

});

var populateAllBrands = function(){
    $.ajax({  
        type: "GET",
        enctype: 'multipart/form-data',
        url: "<?php echo base_url()?>brand/getAllBrands",
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success : function(response){
            response = JSON.parse(response);

            $(response).each(function(i,v){        
                $('#brand').append('<option value="'+v.id+'">'+v.brand_name+'</option>');              
            });
            
        },
        error : function(data,textStatus,errorMessage){
            alert( textStatus + " " + errorMessage);
        }
    });
}

$('#uploadDocument').on('submit', function( event ){
        event.preventDefault();
        

    if($('#uploadDocument').valid()){
      $.confirm({
        title: 'Alert!',
        content: `The uploading process may take a while, it totally depends on your newtork bandwidth and the file size. Mean while please be patience `,
        type: 'blue',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Okay',
                btnClass: 'btn-blue',
                action: function(){
                  $('#loading').addClass('loading');
                  submitDocument();
                }
            },
            close: function () {

            }
        }
      });
    }
    
    
});



var submitDocument = function(){
  var documentData = new FormData($('#uploadDocument')[0]);
  $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: "submitFileAndReturnJson",//"submitDocument",
      data: documentData,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000,
      
      success: function (response) {
          $('#loading').removeClass('loading');
          
          if(response){
            response = JSON.parse(response);
            
            if(response.isSuccess == true){
                $.confirm({
                  title: 'Alert !',
                  content: '<div>'+
                              '<p></p>'+
                              '<b> All data inside uploaded file are preserved successfully and will be processed by cron job in background.</b>'+ 
                            '<div>',
                  type: 'green',
                  typeAnimated: true,
                  buttons: {
                      tryAgain: {
                          text: 'Okay',
                          btnClass: 'btn-green',
                          action: function(){
                            //window.location.href="<?php echo $this->config->base_url() ?>dashboard";
                          }
                      }
                  }
              });
            }


            
            
           
          }
          
         if(response && response.errorCode == '<?php echo INVALID_SPREADSHEET ?>'){
            $.confirm({
                title: 'Error !',
                content: '<div>'+
                            '<b> Error ( '+<?php echo INVALID_SPREADSHEET ?>+' )</b> Invalid  SpreadSheet</span><br/>'+ 
                          '<div>',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'Okay',
                        btnClass: 'btn-red',
                        action: function(){
                          //window.location.href="<?php echo $this->config->base_url() ?>dashboard";
                        }
                    }
                }
            });

          } else if(response && response.errorCode == '<?php echo TEMPLATE_MISMATCH ?>'){
            $.confirm({
                title: 'Error !',
                content: '<div>'+
                            '<b> Error ( '+<?php echo TEMPLATE_MISMATCH ?>+' )</b> Template Miss matched</span><br/>'+ 
                          '<div>',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'Okay',
                        btnClass: 'btn-red',
                        action: function(){
                          //window.location.href="<?php echo $this->config->base_url() ?>dashboard";
                        }
                    }
                }
            });

          }          
          else if(response && response.errorCode == '<?php echo MISMATCH_FILE_TYPE ?>'){
            $.confirm({
                title: 'Error !',
                content: '<div>'+
                            '<b> Error ( '+<?php echo MISMATCH_FILE_TYPE ?>+' )</b> Brand template file extension is not matched with uploaded one</span><br/>'+ 
                          '<div>',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'Okay',
                        btnClass: 'btn-red',
                        action: function(){
                          //window.location.href="<?php echo $this->config->base_url() ?>dashboard";
                        }
                    }
                }
            });
          }
          else if(response && response.errorCode == '<?php echo UNSUPPORTED_FILE_TYPE ?>'){
            $.confirm({
                title: 'Error !',
                content: '<div>'+
                            '<b> Error ( '+<?php echo UNSUPPORTED_FILE_TYPE ?>+' )</b> This file type currently not accepted</span><br/>'+ 
                          '<div>',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'Okay',
                        btnClass: 'btn-red',
                        action: function(){
                          //window.location.href="<?php echo $this->config->base_url() ?>dashboard";
                        }
                    }
                }
            });
          }
          

      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
}
  
</script>