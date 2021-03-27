<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link href="<?php echo $this->config->base_url() ?>assets/plugins/dropzone/dropzone.css" type="text/css" rel="stylesheet" />
<link href="<?php echo $this->config->base_url() ?>assets/plugins/dropzone/thumbnail-gallery.css" type="text/css" rel="stylesheet" />
<script src="<?php echo $this->config->base_url() ?>assets/plugins/dropzone/dropzone.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php include ('includes/header.php'); ?>
<div id="loading" class="">
   
</div>
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
                <h3 class="card-title">Upload a new notification</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            
            <!-- /.card-header -->
            <div class="card-body">
                <form   method="post" id="brand-template-form" name="brand-template-form" enctype="multipart/form-data">
                
                    <div class="brand-template-form">

                        <div class="row">
                            <div class="form-group col-sm-12">
                            <label for="title">Notification Title</label>
                                <textarea rows="5"  name="title" id="title" placeholder="" class="form-control" required></textarea>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                        <input type="checkbox" class="custom-control-input" onclick="toggleStatus(this);" id="notification-type" name="notification-type">
                                        <label class="custom-control-label" for="notification-type" id="notification-type-text">This notification doesn't requires a file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-sm-12" id="file-division">
                                <label for="notification-file">Notification related file</label>
                                <input type="file" name="notification-file" id="notification-file" placeholder="templNotification File" class="form-control" style="border:0px;">
                            </div>
                        </div>

                    
            
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Upload &nbsp; <span class="fa fa-check"></span></button>
                        </div>
                    </div>
                </form>            
            </div>
            <!-- /.card-body -->
        </div>


        <div class="card card-outline card-success">
            <div class="card-header">
            <h3 class="card-title">All Notifications</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content p-0" style="overflow: auto; white-space: nowrap;">
                    <table class="table table-striped table-hover table-condensed table-loader" id="recordList">
                        <thead>
                            <tr class="text-center">
                                <th>
                                    Notification Id
                                </th>
                                <th>
                                    Notification Title
                                </th>
                                <th>
                                    Contains Attachment
                                </th>
                                <th>
                                    Uploaded On
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
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


<script>
    var toggleValue = 0;

    var updateNotificationStatus = function(toggleValue,productId){
        $('#loading').addClass('loading');
        $.ajax({  
            type: "POST",
            url: "<?php $this->config->base_url()?>notifications/updateNotificationStatus",
            data: JSON.stringify({"status": toggleValue, "productId":productId}),
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            
            success: function (response) {
                response = JSON.parse(response);
                if(response && response.isSuccess){
                    $('#loading').removeClass('loading');
                    toastr.success('Notification status updated !');
                }else{
                    toastr.error('Something went wrong !');
                }
                
            },
            error : function(data,textStatus,errorMessage){
                alert( textStatus + " " + errorMessage);
            }
        });
    }
    
    var toggleNotificationStatus = function(status){
        var toggleValue = 0;
        var html = 'In-Active';
        var productId = $(status).attr('productId');
        
        if(status.checked){
            toggleValue = 1;
            html = 'Active';
        }
        updateNotificationStatus(toggleValue,productId);
        $('#product-status-label-'+productId).html(html);
    }

    var renderDataTable = function(response){
  
        $("#recordList").dataTable({
            "aaData" : response,
            "autoWidth": false,        
            "scrollX": true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "oLanguage" : {
                "sInfoEmpty" : "No keyword to show"
            },
            "sortable": true,
            "aoColumns" : [
                {
                    mData : 'id',
                    sClass: 'text-center vertically-align'
                    //sWidth : '20px'
                },
                {
                    mData : null,
                    sClass: 'text-center vertically-align'
                    //sWidth : '100px'
                },
                {
                    mData: null, //country
                    sClass: 'text-center vertically-align'
                    //sWidth : '150px'
                },
                {
                    mData: 'uploaded_on',
                    sClass: 'text-center vertically-align'
                    //sWidth : '150px'
                },
                {
                    mData: null,//original_row
                    sClass: 'text-center vertically-align'
                    //sWidth : '100px'
                },
                {
                    mData: null,//original_row
                    sClass: 'text-center vertically-align'
                    //sWidth : '100px'
                }


            ],
            "aoColumnDefs" : [
                {
                    "aTargets" : [ 5 ],
                    "mRender" : function(d,t,r){
                        var html = ``;
                        if(d.status == 1){
                            html = `<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" class="custom-control-input" onclick="toggleNotificationStatus(this);" productId="`+d.id+`" id="prodduct-status-`+d.id+`" name="status" checked>
                                <label class="custom-control-label" for="prodduct-status-`+d.id+`" id="product-status-label-`+d.id+`" title="Activation Status within LMS">Active</label>
                            </div>`;
                        }else{
                            html = `<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" class="custom-control-input" onclick="toggleNotificationStatus(this);" productId="`+d.id+`" id="prodduct-status-`+d.id+`" name="status">
                                <label class="custom-control-label" for="prodduct-status-`+d.id+`" id="product-status-label-`+d.id+`" title="Activation Status within LMS">In-Active</label>
                            </div>`;
                        }
                            
                        return html;
                    }
                    
                },
                {
                    "aTargets" : [ 4 ],
                    "mRender" : function(d,t,r){
                        var html = ``;
                        if(d.status == 1)
                            html = `Active on site`;
                        else
                            html =  `Disabled on site`;
                            
                        return html;
                    }
                    
                },
                {
                    "aTargets" : [ 1 ],
                    "mRender" : function ( data, type, bomModel ) {
                        var html = data.notification_title;
                        if( html.length >   50)
                            html = data.notification_title.substring(0, 30) + " ...";                            
                        return html;
                    }
                    
                },
                {
                    "aTargets" : [ 2 ],
                    "mRender" : function ( data, type, bomModel ) {
                        var html =`No, Attachment`;
                        if( data.is_file_attached == 1 )
                            html = `Yes, Contains Attachment`;                            
                        return html;
                    }
                }
            ]
            
        });


   
}
    
    var getAllNotifications = function(){
        $('#loading').addClass('loading');
        $.ajax({  
            type: "GET",
            url: "<?php $this->config->base_url()?>notifications/getAllNotifications",
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            
            success: function (response) {
                $('#loading').removeClass('loading');
                response = JSON.parse(response);
                renderDataTable(response);          
                $(".table-loader:eq(0)").removeClass('table-loader').show(); //for header
                $(".table-loader:eq(0)").removeClass('table-loader').show(); // for body

            },
            error : function(data,textStatus,errorMessage){
                alert( textStatus + " " + errorMessage);
            }
        });
    };


    var getGalleryImages = function(){
        $('#loading').addClass('loading');
        $.ajax({  
            type: "GET",
            url: "<?php $this->config->base_url()?>gallery/getGalleryImages",
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            
            success: function (response) {
                $('#loading').removeClass('loading');
                response = JSON.parse(response);

                var html = ``;

                if(response && response.length > 0){debugger
                    $(response).each(function(key, value){debugger
                        html += ` <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <a class="lightbox" target="_blank" href="<?php echo $this->config->base_url() ?>assets/uploads/`+value.path+`">
                                            <img class="img-thumbnail" src="<?php echo $this->config->base_url() ?>assets/uploads/`+value.path+`" alt="`+value.path+`">
                                        </a>
                                    </div>
                                </div>                     
                            `;
                    });
                }else{
                    html = `<h3 class="text-center w-100">Gallery is empty !</h3>`;
                }

                $('#gallery-images').html(html);
            },
            error : function(data,textStatus,errorMessage){
                alert( textStatus + " " + errorMessage);
            }
        });
    };
    
    var postNotification = function(status,productId){
        var templateForm = new FormData($('#brand-template-form')[0]);
        $('#loading').addClass('loading');
        $.ajax({            
            type: "POST",
            enctype: 'multipart/form-data',
            url: "<?php echo $this->config->base_url()?>notifications/postNotification",
            data: templateForm,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            
            success: function (response) {
                response = JSON.parse(response);
                if(response && response.isSuccess){
                    $('#loading').removeClass('loading');
                    toastr.success(response.message);
                    setInterval(function(){ 
                        location.reload();
                    }, 3000);
                }else{
                    toastr.error('Something went wrong !');
                }
                
            },
            error : function(data,textStatus,errorMessage){
                alert( textStatus + " " + errorMessage);
            }
        });
    };

    var toggleStatus = function(status){
        $("#file-division").fadeToggle("slow");
        
        var html = "This notification doesn't requires a file";
        // var productId = $(status).attr('productId');
        
        if(status.checked){
            toggleValue = 1;
            html = "This notification requires a file";
        }else{
            toggleValue = 0;
        }
        $('#notification-type-text').html(html);
    }

    var customValidaton = function(){
        if( toggleValue == 1 ){
            if( $("#notification-file")[0].files.length == 0 ){
                toastr.error('Select notification file first !');
                return false;
            }else{
                return true;
            }
        }else{
            return true;
        }
    }

    $('#brand-template-form').on('submit', function( event ){debugger
        event.preventDefault();
        if($('#brand-template-form').valid() && customValidaton() ){
            $('#loading').addClass('loading');
            postNotification();
        }
    });

    $(document).ready(function(){
        $("#file-division").fadeOut();
        getAllNotifications();
    });
</script>
