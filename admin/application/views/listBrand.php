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


  
   <!-- loader -->
   <div id="loading">
   
   </div>
   <!-- loader -->


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
            <h3 class="card-title">Brand List</h3>

            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
                
          <table class="table table-striped table-hover table-condensed table-loader" id="brandList">
                <thead>
                    <tr class="text-center">
                        <th>
                            Brand Id
                        <th>
                            Brand Name
                        </th>
                        <th>
                            Brand Tag
                        </th>
                        <th>
                            Added By
                        </th>
                        <th>
                            Template Format
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



<div class="modal fade" id="edit-xl" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">


        <div class="modal-header">
            <h3><i class="fa fa-user"> </i> Brands Details (Edit Mode)</h3>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
             <div class="modal-body user-edit">
             <form   method="post" id="brand-template-form" name="brand-template-form" enctype="multipart/form-data">
                
                <div class="brand-template-form">

                    

                    <div class="row">
                        <div class="form-group col-sm-2">
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

                        <div class="form-group col-sm-3">
                            <label for="template">Brand's Current Template File</label>
                            <input type="text" name="current_template" id="current_template" placeholder="Current Templeate File" class="form-control" style="border:0px;" disabled/>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="template">Over Ride Brand's Template File</label>
                            <input type="file" name="template" id="template" placeholder="Template FIle" class="form-control" style="border:0px;">
                        </div>
                    </div>

                
        
                    <div class="modal-footer">
                        <button type="submit" id="verify_template" class="btn btn-primary" disabled>Validate template and fill brand details <span class="fa fa-check"></span></button>
                    </div>
                </div>
            </form> 

                <form   method="post" id="brand-registration-edit" name="brand-registration-edit" enctype="multipart/form-data">
                    <input type="hidden" name="isTemplateChanged" id="isTemplateChanged" value="0"/>
                    <input type="hidden" name="brand_id" id="brand_id"/>
                    <input type="hidden" name="file_type" id="file_type"/>
                    <input type="hidden" name="uploaded_file_name"  id="uploaded_file_name" />
                    <input type="hidden" name="hassheets" id="hassheets" />
                    <div class="brand-registration-edit">

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
            



            
    
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<div class="modal fade" id="view-xl" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <form action=""  method="post" id="user-view-form" enctype="multipart/form-data">
          
            <div class="modal-header">
              <h3><i class="fa fa-user"> </i> User Details (view Mode)</h3>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body user-view">
              <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label for="fullName_view">Full Name</label>
                        <input type="text" name="fullName_view" id="fullName_view" placeholder="Full name" class="form-control" disabled>
                      </div>
                  </div>
          
          
                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="email_view">Email Address</label>
                      <input type="text" name="email_view" id= "email_view" placeholder="Email Address" class="form-control" disabled>
                    </div>
                </div>
              </div>

              

              <div class="row">
                <div class="form-group col-sm-6">
                    <label for="role_view">Role</label>
                    <select name="role_view" id="role_view" class="form-control" disabled>
                        <option value="" disabled selected>Choose Role</option>
                        <option value="<?php echo ROLE_ADMIN ?>">Admin</option>
                        <option value="<?php echo ROLE_UPLOAD ?>">Upload only</option>
                        <option value="<?php echo ROLE_DOWNLOAD ?>">Download Only</option>
                        <option value="<?php echo ROLE_DOWNLOAD_UPLOAD ?>">Upload and Download</option>
                    </select>
                </div>

                <div class="form-group col-sm-6">
                    <label for="apiKey_view">API Key</label>
                    <input type="text" name="apiKey_view" id="apiKey_view" placeholder="API Key" class="form-control" disabled>
                </div>
              </div>

              <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                <input type="checkbox" class="custom-control-input" onclick="toggleStatus(this);" id="status_view" name="status_view" checked="checked" disabled>
                <label class="custom-control-label" for="status_view_label" id="status_view_label" title="User Status">Active user</label>
              </div>

            </div>


            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close <span class="fa fa-close"></sapn></button>
            </div>
    
          </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php include ('includes/footer.php'); ?>

<script tyep="text/javascript">
var table;
$(function () {

    var encodings = <?php echo(json_encode(mb_list_encodings())) ?>;

    $(encodings).each(function(index,value){
        $('#fileEncoding').append('<option value="'+value+'">'+value+'</option>');                 
    })

    $('#fileEncoding').val("UTF-8").trigger('change');



    viwAllBrands();
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    

    $('#brand-registration-edit').on('submit', function( event ){
        event.preventDefault();        

        if($('#brand-registration-edit').valid()){
            $('#loading').addClass('loading');
            setTimeout(function(){
                updateBrand();               
            },2000);
        }
        
        
    });
});

var updateBrand = function(){
    var templateForm = new FormData($('#brand-registration-edit')[0]);
        
        $.ajax({  
            type: "POST",
            enctype: 'multipart/form-data',
            url: "updateBrand",
            data: templateForm,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success : function(response){
                
                response = JSON.parse(response);
                if(response.isSuccess){
                    $('#loading').removeClass('loading');
                    toastr.success('Brand updated successfully!');
                    setTimeout(function(){
                        window.location.href="<?php echo $this->config->base_url() ?>brand/listBrand";
                    },1000);
                }
            },
            error : function(data,textStatus,errorMessage){
                alert( textStatus + " " + errorMessage);
            }
        });
}

$('#template').on('change', function() {
        $.confirm({
            title: 'Attention!',
            content: `This will override the existing template of brand! Do you wish to continue`,
            type: 'green',
            typeAnimated: true,
            buttons: {
                ok: {
                    text: 'Okay',
                    btnClass: 'btn-green',
                    action: function(){
                        $('#verify_template').prop('disabled',false);
                        $('#isTemplateChanged').val(1);
                    }
                },
                close: function () {

                }
            }
        });
    }); 


var viwAllBrands = function(){
    $.ajax({
        url: 'getAllBrands',
        dataType: 'json',
        type: 'GET',
        contentType: 'application/json',
        cache: false,
        success : function(data){
            if(table){
                table.fnClearTable();
                table.fnDestroy();
            }
            dataTable(data);
            $(".table-loader:eq(0)").removeClass('table-loader').show(); //for header
            $(".table-loader:eq(0)").removeClass('table-loader').show(); // for body
        },
        error : function(data,textStatus,errorMessage){
            alert( textStatus + " " + errorMessage);
        }
    });
};

$('#brand-template-form').on('submit', function( event ){
    event.preventDefault();
    if($('#brand-template-form').valid()){
        $('#loading').addClass('loading');
        setTimeout(function(){
            populateDropDownsForMappingFromNewTemplate();
        },2000);
    }
});

var populateDropDownsForMappingFromNewTemplate = function(){
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
                        $('#hassheets').val(response.hasSheets);
                        
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
                            firstRow[cellData[i][0]] = firstRow[cellData[i][0]].replace(/"/g, '');
                                    
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
                        content: `Template file validate successfuly! Now map template columns. Be careful while mapping corresponding coulmn.`,
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
                    $('organization').empty();
                    $('#country').append('<option value="">Choose Country Column In Template</option>');                 
                    $('#email').append('<option value="">Choose Email Column In Template</option>');                 
                    $('#telephone').append('<option value="">Choose Telephone Column In Template</option>');                 
                    $('#creationDate').append('<option value="">Choose Creation Date Column In Template</option>');  
                    $('#firstName').append('<option value="">Choose the correct mapping for first Name from template column</option>');                 
                    $('#lastName').append('<option value="">Choose the correct mapping for last Name from template column</option>');                 
                    $('#organization').append('<option value="">Choose the correct mapping for organization from template column</option>');                 
                    

                    $('#loading').removeClass('loading');
                    switch( response.errorCode ) {
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

var dataTable = function(data){
    var count = 0;
    table = $("#brandList").dataTable({
        "aaData" : data,
        "autoWidth": false,        
        "scrollX": true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "oLanguage" : {
            "sInfoEmpty" : "No user to show"
        },
        "sortable": true,
        "aoColumns" : [
            {
                mData : 'id',
                sClass: 'text-center vertically-align'
                //sWidth : '20px'
            },
            {
                mData : 'brand_name',
                sClass: 'text-center vertically-align'
                //sWidth : '100px'

            },
            {
                mData: 'brand_tag',
                sClass: 'text-center vertically-align'
                //sWidth : '150px'
            },
            {
                mData: 'added_by',
                sClass: 'text-center vertically-align'
                //sWidth : '100px'
            },
            {
                mData: 'file_format',
                sClass: 'text-center vertically-align'
                //sWidth : '500px'
            },
            {
                mData : null,
                sClass: 'text-center vertically-align'
                //sWidth : '100px'
            },
            {
                mData : null,
                sClass: 'text-center vertically-align'
                //sWidth : '100px'

            }
        ],
        "aoColumnDefs" : [
            {
                "aTargets" : [ 5 ],
                "mRender" : function ( data, type, bomModel ) {
                    return bomModel.hide == 0 ? 'Active' : 'In-Active';
                }
            },
            {
                "aTargets" : [ 6 ],
                "mRender" : function ( data, type, bomModel ) {
                    var editAccess = false;
                    var downloadAccess = true;
                    <?php
                    if( $this->session->userdata('roleId') == ROLE_ADMIN ||  $this->session->userdata('roleId') == SUPER_USER){ 
                      ?>
                      editAccess = true;
                      <?php
                    }
                    if( $this->session->userdata('roleId') == ROLE_UPLOAD){ 
                      ?>
                      downloadAccess = false;
                      <?php
                    }
                    ?>
                    var html = '<div class="btn-group">';
                    if(editAccess){
                      html += '<a onClick="fireEditCall('+bomModel.id+')" href="" class="btn btn-sm btn-primary" title="Edit this entry" data-toggle="modal" data-target="#edit-xl"><i class="fas fa-edit"></i></a>';
                    }

                    if (downloadAccess){
                      html += '<a onClick="fireDownloadCall('+bomModel.id+')" class="btn btn-sm btn-warning " title="Download this template file" ><i class="fa fa-download"></i></a>';
                    }
                    if(editAccess){
                        html +='<a onClick="deleteBrand('+bomModel.id+')" class="btn btn-sm btn-danger text-white" title="Delete this brand" ><i class="fa fa-trash"></i></a>';
                    }
                       html += '</div>';
                    return html;
                }
            }]
    });
};


var populateBrandDrownload = function(templateData){
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
                    
    $(templateData).each(function(key,value){
        $('#country').append('<option value="'+value.position+'">'+value.header_title+'</option>');
        $('#email').append('<option value="'+value.position+'">'+value.header_title+'</option>');
        $('#telephone').append('<option value="'+value.position+'">'+value.header_title+'</option>');
        $('#creationDate').append('<option value="'+value.position+'">'+value.header_title+'</option>');
        $('#firstName').append('<option value="'+value.position+'">'+value.header_title+'</option>');                 
        $('#lastName').append('<option value="'+value.position+'">'+value.header_title+'</option>');
        $('#organization').append('<option value="'+value.position+'">'+value.header_title+'</option>');
    });
    
}

var fireEditCall = function(id){
    $.ajax({
        url: 'getBrandById?id='+id,
        type: 'GET',
        contentType: 'application/json',
        cache: false,
        success : function(data){ 
            var data = JSON.parse(data);
            $("#brandName").val(data.brand_details[0].brand_name);
            $("#brandTag").val(data.brand_details[0].brand_tag);
            $('#commercialCategory').val(data.brand_details[0].commercial_category);            
            $("#educategory").val(data.brand_details[0].edu_category);
            $("#homeCategory").val(data.brand_details[0].home_category);
            $("#current_template").val(data.brand_details[0].template_url);

            $("#brand_id").val(data.brand_details[0].id);
            $("#uploaded_file_name").val(data.brand_details[0].template_url);
            $("#hassheets").val(data.brand_details[0].has_sheets);

            //setting dropdowns
            populateBrandDrownload(data.template_details);    

            $('#country').val(data.brand_details[0].county_position_in_template);
            $('#email').val(data.brand_details[0].email_position_in_template);
            $('#telephone').val(data.brand_details[0].telephone_position_in_template);
            $('#creationDate').val(data.brand_details[0].creation_date_in_position);
            $('#firstName').val(data.brand_details[0].first_name_position_in_template);
            $('#lastName').val(data.brand_details[0].last_name_position_in_template);
            $('#organization').val(data.brand_details[0].organization_position_in_template);
            
            switch( data.brand_details[0].file_format ) {
                case '<?php echo CSV_EXT ?>':
                    $('#fileFormat').val("1").trigger('change');
                    $('#file_type').val("CSV");
                    break;
                case '<?php echo XLS_EXT ?>':
                    $('#fileFormat').val("2").trigger('change');
                    $('#file_type').val("XLS");
                    break;
                case '<?php echo XLSX_EXT ?>':
                    $('#fileFormat').val("3").trigger('change'); 
                    $('#file_type').val("XLSX");
                    break;
            }

            
                   


        },
        error : function(data,textStatus,errorMessage){
            alert( textStatus + " " + errorMessage);
        }
    });
};

var fireViewCall = function(id){
    $.ajax({
        url: 'getUserById?id='+id,
        type: 'GET',
        contentType: 'application/json',
        cache: false,
        success : function(data){ 
          var data = JSON.parse(data);
            $("#fullName_view").val(data[0].name);
            $('#email_view').val(data[0].username);            
            $("#role_view").val(data[0].roleId);
            $("#apiKey_view").val(data[0].apikey);
            if(data[0].status == "1"){
              $("#status_view_label").html('Active user');              
              $("#status_view").prop('checked',true);
            }else{
              $("#status_view_label").html('In-Active user');
              $("#status_view").prop('checked',false);
            }            
        },
        error : function(data,textStatus,errorMessage){
            alert( textStatus + " " + errorMessage);
        }
    });
};

var deleteBrand = function(id){
    
    $.confirm({
        title: 'Alert!',
        content: `This will be delete all data associated with this particular brand(including report, import).Do you whish to continue?`,
        type: 'red',
        typeAnimated: true,
        buttons: {
            ok: {
                    text: 'Okay',
                    btnClass: 'btn-red',
                    action: function(){
                        $('#loading').addClass('loading');
                        //deleting brand by id and all it's associate data
                        $.ajax({
                            url: 'deleteBrand?brandId='+id,
                            dataType: 'json',
                            type: 'post',
                            contentType: 'application/json',
                            cache: false,
                            success : function(data){
                                $('#loading').removeClass('loading');
                                viwAllBrands();
                            },
                            error : function(data,textStatus,errorMessage){
                                alert( textStatus + " " + errorMessage);
                            }
                        });
                    }
                },
            close: function () {

            }
        }
    });
}

var fireDownloadCall = function(id){
    $('#loading').addClass('loading');
    $.ajax({
        url: 'getBrandTemplateFileName?brandId='+id,
        dataType: 'json',
        type: 'get',
        contentType: 'application/json',
        cache: false,
        success : function(data){
            $('#loading').removeClass('loading');
            window.location.href="<?php echo $this->config->base_url()  ?>uploads/"+data[0].template_url;
        },
        error : function(data,textStatus,errorMessage){
            alert( textStatus + " " + errorMessage);
        }
    });
}

</script>