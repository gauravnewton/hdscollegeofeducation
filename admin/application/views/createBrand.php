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
     


        <!--step 1/2-->
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Brand Template Selection (Step 1/2)</h3>

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
                            <div class="form-group col-sm-3">
                                <label for="fileFormat">Brand File Format</label>
                                <select name="fileFormat" id="fileFormat" class="form-control select2" style="width: 100%;" required>
                                    <option value="" disabled selected>Choose File Format</option>
                                    <option value="<?php echo FILE_CSV ?>">CSV</option>
                                    <option value="<?php echo FILE_XLS ?>">XLS</option>
                                    <option value="<?php echo FILE_XLSX ?>">XLSX</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-3">
                                <label for="fileEncoding">File Encoding Schema</label>
                                <select name="fileEncoding" id="fileEncoding" class="form-control select2" style="width: 100%;" required>
                                    <option value="" disabled selected>Choose Encoding Schema</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="template">Brand's Template File</label>
                                <input type="file" name="template" id="template" placeholder="template" class="form-control" style="border:0px;">
                            </div>
                        </div>

                    
            
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Validate template and fill brand details <span class="fa fa-check"></span></button>
                        </div>
                    </div>
                </form>            
            </div>
            <!-- /.card-body -->
        </div>


        <!-- step 2/2 -->
        <div class="card card-outline card-primary" id="step2">
            <div class="card-header">
                <h3 class="card-title">Brand Details (Step 2/2)</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            
            <!-- /.card-header -->
            <div class="card-body">
                <form   method="post" id="brand-registration" name="brand-registration" enctype="multipart/form-data">
                
                    <div class="brand-registration">

                        <input type="hidden" name="file_type" id="file_type"/>
                        <input type="hidden" name="uploaded_file_name"  id="uploaded_file_name" />
                        <input type="hidden" name="hassheets" id="hasSheets" />
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="brandName">Brand Name</label>
                                    <input type="text" name="brandName" id="brandName" placeholder="Brand Name" class="form-control">
                                </div>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="tags">Tags</label>
                                <input type="text" name="tags" id="brandTag" placeholder="Brand Tags (Seperated By Commas)" class="form-control">
                            </div>                            
                            
                           
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="firstName">Field For First Name</label>
                                <select name="firstName" id="firstName" class="form-control select2" style="width: 100%;">
                                    <option value="" disabled selected>Choose FirstName Column In Template</option>
                                </select>                                
                            </div>

                            <div class="form-group col-sm-4">
                                <label for="lastName">Field For Last Name</label>
                                <select name="lastName" id="lastName"  class="form-control select2">
                                    <option value="" disabled selected>Choose LastName Column In Template</option>
                                </select>                                
                            </div>

                            <div class="form-group col-sm-4">
                                <label for="organization">Field For Organization</label>
                                <select name="organization" id="organization"  class="form-control select2">
                                    <option value="" disabled selected>Choose Organization Column In Template</option>
                                </select>                                
                            </div>
                        </div>


                        <div class="row">
                                
                                
                            <div class="form-group col-sm-6">
                                <label for="country">Field For Country</label>
                                <select name="country" id="country" class="form-control select2" style="width: 100%;">
                                    <option value="" disabled selected>Choose Country Column In Template</option>
                                </select>                                
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="email">Field For Email</label>
                                <select name="email" id="email"  class="form-control select2">
                                    <option value="" disabled selected>Choose Email Column In Template</option>
                                </select>                                
                            </div>
                        </div>

                        <div class="row">
                            

                            <div class="form-group col-sm-6">
                                <label for="telephone">Field For Telephone</label>
                                <select name="telephone" id="telephone"  class="form-control select2">
                                    <option value="" disabled selected>Choose Telephone Column In Template</option>
                                </select>                                
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="creationDate">Field For Creation Date</label>
                                <select name="creationDate" id="creationDate"  class="form-control select2">
                                    <option value="" disabled selected>Choose Creation Date Column In Template</option>
                                </select>                                
                            </div>
                        </div>

                       

                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="commercialCategory">Campaign For Commercial Category</label>
                                <input type="text" name="commercialCategory" id="commercialCategory" placeholder="Campaign For Commercial Category" class="form-control">                             
                            </div>

                            <div class="form-group col-sm-4">
                                <label for="eduCategory">Campaign For EDU Category</label>
                                <input type="text" name="eduCategory" id="educategory" placeholder="Campaign For EDU Category" class="form-control">
                            </div>

                            <div class="form-group col-sm-4">
                                <label for="homeCategory">Campaign For Home Category</label>
                                <input type="text" name="homeCategory" id="homeCategory" placeholder="Campaign For Home Category" class="form-control">                             
                            </div>
                        </div>

                    
            
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-danger" data-dismiss="modal">Clear <span class="fa fa-close"></sapn></button>
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
    
    var encodings = <?php echo(json_encode(mb_list_encodings())) ?>;

    $(encodings).each(function(index,value){
        $('#fileEncoding').append('<option value="'+value+'">'+value+'</option>');                 
    })

    $('#fileEncoding').val("UTF-8").trigger('change');

    console.log(encodings);
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $('#brand-template-form').on('submit', function( event ){
        event.preventDefault();
        if($('#brand-template-form').valid()){
            $('#loading').addClass('loading');
            setTimeout(function(){
                populateDropDownsForMapping();
            },2000);
        }
    });



    $('#brand-registration').on('submit', function( event ){
        event.preventDefault();
        

        if($('#brand-registration').valid()){
            $('#loading').addClass('loading');
            setTimeout(function(){
                registerBrand();               
            },2000);
        }
        
        
    });
    

    var registerBrand = function(){
        var templateForm = new FormData($('#brand-registration')[0]);
        
        $.ajax({  
            type: "POST",
            enctype: 'multipart/form-data',
            url: "registerBrand",
            data: templateForm,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success : function(response){
                
                response = JSON.parse(response);
                if(response.isSuccess){
                    $('#loading').removeClass('loading');
                    toastr.success('Brand registered successfully!');
                    setTimeout(function(){
                        window.location.href="<?php echo $this->config->base_url() ?>brand/listBrand";
                    },2000);
                }
            },
            error : function(data,textStatus,errorMessage){
                alert( textStatus + " " + errorMessage);
            }
        });
    }




    var populateDropDownsForMapping = function(){
        var templateForm = new FormData($('#brand-template-form')[0]);
        $('#loading').addClass('loading');
        $.ajax({  
            type: "POST",
            enctype: 'multipart/form-data',
            url: "populateDropDownsForMapping",
            data: templateForm,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            
            success: function (response) {
                $('#loading').removeClass('loading');
                response = JSON.parse(response);
                if( response.isSuccess == true ){
                    $('#loading').removeClass('loading');
                    var result = Object.entries(response.data);
                    var firstRow = result[1][1];

                    counter = 0;
                    $(result).each(function(index,value){
                        var cellData = Object.entries(value[1]);
                        ++counter;

                        $('#file_type').val(response.templateExt);
                        $('#uploaded_file_name').val(response.templateName);
                        $('#hasSheets').val(response.hasSheets);
                        
                        $('#country').empty();
                        $('#email').empty();
                        $('#telephone').empty();
                        $('#creationDate').empty();
                        $('#firstName').empty();
                        $('#lastName').empty();
                        $('#organization').empty();
                        $('#country').append('<option value="">Choose the correct mapping for country from template column</option>');                 
                        $('#email').append('<option value="">Choose the correct mapping for email from template column</option>');                 
                        $('#telephone').append('<option value="">Choose the correct mapping for telephone from template column</option>');                 
                        $('#creationDate').append('<option value="">Choose the correct mapping for creation date from template column</option>');                 
                        $('#firstName').append('<option value="">Choose the correct mapping for first Name from template column</option>');                 
                        $('#lastName').append('<option value="">Choose the correct mapping for last Name from template column</option>');                 
                        $('#organization').append('<option value="">Choose the correct mapping for organization from template column</option>');                 
                        
                        $(cellData).each(function(i,v){  
                            cellData[i][1] = cellData[i][1].replace(/"/g, ''); 
                            if(firstRow[cellData[i][0]]){
                                firstRow[cellData[i][0]] = firstRow[cellData[i][0]].toString();
                                firstRow[cellData[i][0]] = firstRow[cellData[i][0]].replace(/"/g, '');
                            }                           
                            $('#country').append('<option value="'+cellData[i][0]+'">'+cellData[i][1]+' --> '+firstRow[cellData[i][0]]+' </option>');                 
                            $('#email').append('<option value="'+cellData[i][0]+'">'+cellData[i][1]+' --> '+firstRow[cellData[i][0]]+' </option>');                 
                            $('#telephone').append('<option value="'+cellData[i][0]+'">'+cellData[i][1]+' --> '+firstRow[cellData[i][0]]+' </option>');                 
                            $('#creationDate').append('<option value="'+cellData[i][0]+'">'+cellData[i][1]+' --> '+firstRow[cellData[i][0]]+' </option>'); 
                            $('#firstName').append('<option value="'+cellData[i][0]+'">'+cellData[i][1]+' --> '+firstRow[cellData[i][0]]+' </option>');                 
                            $('#lastName').append('<option value="'+cellData[i][0]+'">'+cellData[i][1]+' --> '+firstRow[cellData[i][0]]+' </option>');
                            $('#organization').append('<option value="'+cellData[i][0]+'">'+cellData[i][1]+' -> '+firstRow[cellData[i][0]]+' </option>');                
                        });
                        return false; //breaking loop because we need to read header here only.
                    });

                    $.confirm({
                        title: 'Alert!',
                        content: `Template file validate successfuly! Now map template columns on step 2. Be careful while mapping corresponding coulmn.`,
                        type: 'green',
                        typeAnimated: true,
                        buttons: {
                            
                            close: function () {
                                window.location.href="#step2";
                            }
                        }
                    });
                    
                }else{
                    //Issue in template file
                    $('#file_type').val('');
                    $('#uploaded_file_name').val('');
                    $('#hasSheets').val('');
                    
                    $('#country').empty();
                    $('#email').empty();
                    $('#telephone').empty();
                    $('#creationDate').empty();
                    $('#firstName').empty();
                    $('#lastName').empty();
                    $('#organization').empty();
                    $('#country').append('<option value="">Choose Country Column In Template</option>');                 
                    $('#email').append('<option value="">Choose Email Column In Template</option>');                 
                    $('#telephone').append('<option value="">Choose Telephone Column In Template</option>');                 
                    $('#creationDate').append('<option value="">Choose Creation Date Column In Template</option>');  
                    $('#firstName').append('<option value="">Choose the correct mapping for first Name from template column</option>');                 
                    $('#lastName').append('<option value="">Choose the correct mapping for last Name from template column</option>');                 
                    $('#organization').append('<option value="">Choose the correct mapping for organization from template column</option>');                 
                    
                    $('#loading').removeClass('loading');
                    switch( response.errorCode ) {
                        case <?php echo INVALID_SPREADSHEET ?> :
                            $.confirm({
                                title: 'Encountered an error!',
                                content: `Invalid SpreadSheet File`,
                                type: 'red',
                                typeAnimated: true,
                                buttons: {
                                    tryAgain: {
                                        text: 'Try again',
                                        btnClass: 'btn-red',
                                        action: function(){

                                        }
                                    },
                                    close: function () {

                                    }
                                }
                            });
                        break;
                        case <?php echo MISMATCH_FILE_TYPE ?>:
                            $.confirm({
                                title: 'Encountered an error!',
                                content: `Selected extension doesn't matched with uploaded template file! please upload valid template file.`,
                                type: 'red',
                                typeAnimated: true,
                                buttons: {
                                    tryAgain: {
                                        text: 'Try again',
                                        btnClass: 'btn-red',
                                        action: function(){

                                        }
                                    },
                                    close: function () {

                                    }
                                }
                            });

                            break;
                        case <?php echo UNSUPPORTED_FILE_TYPE?>:
                            $.confirm({
                                title: 'Encountered an error!',
                                content: `Unsupported template file format! Please upload only Csv,Xls or Xlsx file.`,
                                type: 'red',
                                typeAnimated: true,
                                buttons: {
                                    tryAgain: {
                                        text: 'Try again',
                                        btnClass: 'btn-red',
                                        action: function(){

                                        }
                                    },
                                    close: function () {

                                    }
                                }
                            });

                            break;
                        default:
                            // code block
                    }

                }

            },
            error : function(data,textStatus,errorMessage){
                alert( textStatus + " " + errorMessage);
            }
        });
    };
});
  
</script>