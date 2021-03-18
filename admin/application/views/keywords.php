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
          <h3 class="card-title">Add New Keyword</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        
          <form method="post" id="add-keywords">
                  
            <div class="add-keywords">


              <div class="row">
                <div class="form-group col-sm-5">
                  <select name="category" id="category" class="form-control select2" style="width: 100%;" required>
                      <option value="" disabled selected>Choose Category First</option>
                  </select>
                </div>
                
                
                <div class="col-sm-5">
                    <div class="form-group">
                      <input type="text" id="keyword" name="keyword" placeholder="Keyword" class="form-control" required>
                    </div>
                </div>
              
              
                

                <div class="col-sm-2">
                  <button type="submit" class="btn btn-primary">Save <span class="fa fa-check"></span></button>
                </div>

              </div>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
      </div>

          

      <div class="card card-outline card-success">
        <div class="card-header">
          <h3 class="card-title">Keyword List</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        
          <table class="table table-striped table-hover table-condensed table-loader" id="keywordList">
            <thead>
                <tr class="text-center">
                    <th>
                        Sr. No.
                    <th>
                        Category
                    </th>
                    <th>
                        Keywords
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

<div class="modal fade" id="edit-xl" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form  method="post" id="keyword-edit-form" enctype="multipart/form-data">
        
          <div class="modal-header">
            <h3><i class="fas fa-key"> </i> Keyword Details (Edit Mode)</h3>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>

          <input type="hidden" name="keyword-edit-id" id="keyword-edit-id"/>

          <div class="modal-body keyword-edit">
            
          <div class="row">
            <div class="form-group col-sm-6">
              <select name="brand_edit" id="brand_edit" class="form-control select2" style="width: 100%;" required>
                  <option value="" disabled selected>Choose Category First</option>
              </select>
            </div>
            
            
            <div class="col-sm-6">
                <div class="form-group">
                  <input type="text" name="keyword_edit" id="keyword_edit" placeholder="Keyword" class="form-control" required>
                </div>
            </div>
            


            
          </div>


          <div class="modal-footer">
            <div class="pull-left">
              <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                <input type="checkbox" class="custom-control-input" onclick="toggleStatus(this);" id="status_edit" name="status_edit" checked="checked">
                <label class="custom-control-label" for="status_edit" id="status_edit_label" title="User Status">Enabled</label>
              </div>
            </div>


            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancle <span class="fa fa-close"></sapn></button>
            <button type="submit" class="btn btn-primary">Save <span class="fa fa-check"></span></button>
          </div>
  
        </form>
      </div>
      <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

<?php include ('includes/footer.php'); ?>

<script tyep="text/javascript">

var keyWordTable;



var getAllCategoriesWithKeywords = function(){
  $.ajax({  
        type: "GET",
        url: "<?php echo base_url()?>keywords/getAllCategoriesWithKeywords",
        processData: false,
        contentType: false,
        cache: false,
        success : function(response){
            response = JSON.parse(response);
            if(response && response.length > 0){ 
              dataTable(response);
              $(".table-loader:eq(0)").removeClass('table-loader').show(); //for header
              $(".table-loader:eq(0)").removeClass('table-loader').show(); // for body
            }
            
        },
        error : function(data,textStatus,errorMessage){
            alert( textStatus + " " + errorMessage);
        }
    });
}

var fireEditCall = function(id){
  populateAllBrands(true);
  $.ajax({
      url: 'keywords/getKeywordById?id='+id,
      type: 'GET',
      contentType: 'application/json',
      cache: false,
      success : function(data){ 
          var data = JSON.parse(data);
          $('#keyword-edit-id').val(data[0].id);
          $("#brand_edit").val(data[0].category_id).trigger('change');
          $("#keyword_edit").val(data[0].name);
          if(data[0].status == "1"){
            $("#status_edit_label").html('Enabled');              
            $("#status_edit").prop('checked',true);
          }else{
            $("#status_edit_label").html('Disabled');
            $("#status_edit").prop('checked',false);
          }
      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
};


var dataTable = function(data){
    var count = 0;

    if(keyWordTable){
      keyWordTable.fnClearTable();
      keyWordTable.fnDestroy();
    }

    keyWordTable = $("#keywordList").dataTable({
        "aaData" : data,
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
                mData : null,
                sClass: 'text-center vertically-align'
                //sWidth : '20px'
            },
            {
                mData : 'category_name',
                sClass: 'text-center vertically-align'
                //sWidth : '100px'

            },
            {
                mData: 'keyword',
                sClass: 'text-center vertically-align'
                //sWidth : '150px'
            },
            {
                mData: null,
                sClass: 'text-center vertically-align'
                //sWidth : '150px'
            },
            {
                mData: null,
                sClass: 'text-center vertically-align'
                //sWidth : '100px'
            }
        ],
        "aoColumnDefs" : [
            {
                "aTargets" : [ 0 ],
                "mRender" : function ( data, type, bomModel ) {
                    count++;
                    return count;
                }
            },
            {
                "aTargets" : [ 3 ],
                "mRender" : function ( data, type, bomModel ) {
                  var html =  '';
                  if(data.status == '1'){
                    html = 'Enabled';
                  }else{
                    html = 'Disabled';
                  }
                  return html;
                }
            },
            {
                "aTargets" : [ 4 ],
                "mRender" : function ( data, type, bomModel ) {
                    var editAccess = false;
                    <?php
                    if( $this->session->userdata('roleId') == ROLE_ADMIN ||  $this->session->userdata('roleId') == SUPER_USER){ 
                      ?>
                      editAccess = true;
                      <?php
                    }
                    ?>
                    var html = '<div class="btn-group">';
                    if(editAccess){
                      html += '<a onClick="fireEditCall('+bomModel.id+')" href="" class="btn btn-sm btn-primary" title="Edit this entry" data-toggle="modal" data-target="#edit-xl"><i class="fas fa-edit"></i></a>';
                      html +='<a onClick="fireDisableCall('+bomModel.id+')" href="" class="btn btn-sm btn-success" title="Disable this keyword" data-toggle="modal" data-target="#view-xl"><i class="fa fa-ban"></i></a>'+
                      '</div>';
                    }else{
                      html += '<a onClick="fireEditCall('+bomModel.id+')" href="" class="btn btn-sm btn-primary disabled" title="Edit this entry" data-toggle="modal" data-target="#edit-xl"><i class="fas fa-edit"></i></a>';
                      html +='<a onClick="fireDisableCall('+bomModel.id+')" href="" class="btn btn-sm btn-success disabled" title="Disable this keyword" data-toggle="modal" data-target="#view-xl"><i class="fa fa-ban"></i></a>'+
                      '</div>';
                    }
                    
                        
                    return html;
                }
            }]
    });
};

function toggleStatus($this){
  if($this.checked){
      $("#status_edit_label").html('Enabled');              
    }else{
    $("#status_edit_label").html('Disabled');              
  }
}

var populateAllBrands = function(modalMode){
  $.ajax({  
      type: "GET",
      enctype: 'multipart/form-data',
      url: "<?php echo base_url()?>keywords/getAllCategories",
      processData: false,
      contentType: false,
      cache: false,
      success : function(response){
          response = JSON.parse(response);
          var isDisabled = false;
          $(response).each(function(i,v){
            isDisabled = false;
            if(v.id == <?php echo DUPLICATE_CATEGORY?> || v.id == <?php echo HOME_CATEGORY?>
              || v.id == <?php echo BUSINESS_CATEGORY?> || v.id == <?php echo DISCARDED_CATEGORY?>
              || v.id == <?php echo PHONE_API_RESPONSE_ERROR?> || v.id == <?php echo EMAIL_API_RESPONSE_ERROR?>){
                isDisabled = true;
            }
            
            if(!modalMode){                
                if(isDisabled){
                  //$('#category').append('<option value="'+v.id+'" disabled>'+v.name+'</option>');
                }else{
                  $('#category').append('<option value="'+v.id+'" >'+v.name+'</option>');
                }
            }else{                  
              if(isDisabled){
                //$('#brand_edit').append('<option value="'+v.id+'" disabled>'+v.name+'</option>');
              }else{
                $('#brand_edit').append('<option value="'+v.id+'" >'+v.name+'</option>');
              }
            }
            
                
          });
          
      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
}

$('#add-keywords').on('submit', function( event ){
    event.preventDefault();
    if($('#add-keywords').valid()){
        $('#loading').addClass('loading');
        setTimeout(function(){
          addNewKeyword();
        },2000);
    }
});


$('#keyword-edit-form').on('submit', function( event ){
    event.preventDefault();
    if($('#keyword-edit-form').valid()){
        $('#loading').addClass('loading');
        setTimeout(function(){
          updateKeyword();
        },2000);
    }
});

var updateKeyword = function(){
  var keywordForm = new FormData($('#keyword-edit-form')[0]);
  $('#loading').addClass('loading');
  $.ajax({  
      type: "POST",
      enctype: 'multipart/form-data',
      url: "<?php $this->config->base_url()?>keywords/updateKeyword",
      data: keywordForm,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000,
      
      success: function (response) {
          $('#loading').removeClass('loading');
          response = JSON.parse(response);
          toastr.success('Keyword updated !');
          setTimeout(function(){
            window.location.href="<?php echo $this->config->base_url() ?>keywords";
          },2000);
      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
};


  
var addNewKeyword = function(){
  var keywordForm = new FormData($('#add-keywords')[0]);
  $('#loading').addClass('loading');
  $.ajax({  
      type: "POST",
      enctype: 'multipart/form-data',
      url: "<?php $this->config->base_url()?>keywords/addNewKeyword",
      data: keywordForm,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000,
      
      success: function (response) {
          $('#loading').removeClass('loading');
          response = JSON.parse(response);
          toastr.success('Keyword added !');
          $('#keyword').val('');
          $("#category").prop('selectedIndex',0).trigger('change');
          getAllCategoriesWithKeywords();
      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
};

$(document).ready(function(){
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })


    populateAllBrands(false);
    getAllCategoriesWithKeywords();
    

});
</script>