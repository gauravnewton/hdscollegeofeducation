<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link href="<?php echo $this->config->base_url() ?>assets/plugins/dropzone/dropzone.css" type="text/css" rel="stylesheet" />
<link href="<?php echo $this->config->base_url() ?>assets/plugins/dropzone/thumbnail-gallery.css" type="text/css" rel="stylesheet" />
<script src="<?php echo $this->config->base_url() ?>assets/plugins/dropzone/dropzone.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
     



      <div class="container-fluid">
        
        <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add images to gallery</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-12 col-12">
                            <form action="gallery/upload" class="dropzone" id="uploadWidget" enctype="multipart/form-data"></form>
                        </div>
                    </div>

                    <br/>

                    <div class="col-sm-12">
                        <button type='button' data-toggle='modal' data-target='#helpModal' title='Uploading Instructions' class='btn btn-primary pull-right' ><span class='fa fa-question-circle'> </span></button>
                        <br/><br/>
                    </div>
                    <!-- gallery starts here -->

                                    
                    <div class="container gallery-container">

                        <h1>H. D. S. PHOTO GALLERY</h1>

                        <!--
                        <p class="page-description text-center"></p>
                        -->
                        <div class="tz-gallery" style="height: 800px; width:100%; overflow: scroll;">

                            <div class="row" id="gallery-images">

                            </div>

                        </div>

                    </div>

                    <!-- end of gallery -->
                
                    
                </div>
                <!-- /.card-body -->


                <div class="modal fade" id="helpModal" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><span class="fa fa-question-circle">  </span>  Upload Instructions</h4>
                            </div>
                            <div class="modal-body">
                            <p>
                                <ul>
                                <li>Only images with 800 X 800 px dimension are allowed to upload</li>
                                <li>All images type (including .jpeg,.jpg,.png,.gif,.bmp,.svg) are allowed</li>
                                <li>Max file size should be 2 M.B.</li>
                                <li>Maximum 5 images are allowed simultaneously</li>
                                </ul>
                            </p>
                            </div>

                            <div class="modal-footer">
                            <button class="btn btn-success" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    
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
var productsImages = [];
  Dropzone.options.uploadWidget = {
      paramName: 'file',
      maxFilesize: 2, // MB
      maxFiles: 5,
      dictDefaultMessage: 'Drag one or more product image here to upload, or click to select one',
      headers: {
      'x-csrf-token': document.querySelectorAll('meta[name=csrf-token]')[0].getAttributeNode('content').value,
      },
      acceptedFiles: 'image/*',
      init: function() {
        this.on('success', function( file, resp ){debugger
            console.log( file );
            console.log( resp );
            //file = JSON.parse(file);
            resp = JSON.parse(resp);
            productsImages.push(resp.data);
            toastr.success('Product image '+resp.data+' successfully uploaded !');
        });
        this.on('error', function( file, resp ){debugger
            console.log( file );
            console.log( resp );
            //file = JSON.parse(file);
            
            toastr.error('File should be in <?php echo ALLOWED_WIDTH ?> x <?php echo ALLOWED_HEIGHT?>  resolution');
        });
        this.on('thumbnail', function(file) {
            // if ( file.width != <?php echo ALLOWED_WIDTH ?> || file.height != <?php echo ALLOWED_HEIGHT?> ) {
            //     file.rejectDimensions();
            // }
            // else {
            //     file.acceptDimensions();
            // }
            file.acceptDimensions();
        });
      },
      accept: function(file, done) {
        file.acceptDimensions = done;
        file.rejectDimensions = function() {
            done('The image must be (<?php echo ALLOWED_WIDTH ?> x <?php echo ALLOWED_HEIGHT?>) px')
        };
      }
  };
</script>

<script>

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

    $(document).ready(function(){
        getGalleryImages();
    });
</script>
