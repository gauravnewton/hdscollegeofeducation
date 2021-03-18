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
                <h3 class="card-title">Batch List</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12" style="overflow: auto; white-space: nowrap;">
                  
                    <table class="table table-striped table-hover table-condensed table-loader" id="importList" >
                          <thead>
                              <tr class="text-center">
                                  <th>
                                      Import Id#
                                  <th>
                                      Brand Id
                                  </th>
                                  <th>
                                      Status
                                  </th>
                                  <th>
                                      Total Records
                                  </th>
                                  <th>
                                      Total Phone Error
                                  </th>
                                  <th>
                                      Total Home
                                  </th>
                                  <th>
                                      Total Free Mails
                                  </th>
                                  <th>
                                      Total Email Error
                                  </th>
                                  <th>
                                      Total Edu
                                  </th>
                                  <th>
                                      Total Duplicates
                                  </th>
                                  <th>
                                      Total Discarded
                                  </th>
                                  <th>
                                      Total Commercial
                                  </th> 
                                  <th>
                                      Total Business
                                  </th>
                                  <th>
                                      Records Processed
                                  </th>
                                  <th>
                                      Action
                                  </th>
                              </tr>
                          </thead>
                    </table>
                  </div>
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


<div class="modal fade" id="edit-xl" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">


          <div class="modal-header">
              <h3><i class="fa fa-user"> </i> Imported Records  for batch id #<span id="batchText"></span></h3>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
        
        
          <div class="modal-body user-edit" style="overflow: auto; white-space: nowrap;">
            <table class="table table-striped table-hover table-condensed table-loader" id="records">
                <thead>
                    <tr class="text-center" id="tableHeader" style="white-space: nowrap;overflow: hidden;"></tr>
                </thead>
            </table>                         
          </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php include ('includes/footer.php'); ?>

<script tyep="text/javascript">
var table;
var recordTable;

var viewAllImport = function(){
    $.ajax({
        url: 'getAllImports',
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

var dataTable = function(data){
    table = $("#importList").dataTable({
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
                mData : 'brand_id',
                sClass: 'text-center vertically-align'
                //sWidth : '100px'
            },
            {
                mData : null,
                sClass: 'text-center vertically-align'
                //sWidth : '100px'

            },
            {
                mData : 'total_records',
                sClass: 'text-center vertically-align'
                //sWidth : '100px'

            },
            {
                mData: 'total_phone_error',
                sClass: 'text-center vertically-align'
                //sWidth : '150px'
            },
            {
                mData: 'total_home',
                sClass: 'text-center vertically-align'
                //sWidth : '100px'
            },
            {
                mData: 'total_free_mails',
                sClass: 'text-center vertically-align'
                //sWidth : '500px'
            },
            {
                mData : 'total_email_error',
                sClass: 'text-center vertically-align'
                //sWidth : '100px'
            },
            {
                mData : 'total_edu',
                sClass: 'text-center vertically-align'
                //sWidth : '100px'

            },
            {
                mData : 'total_duplicates',
                sClass: 'text-center vertically-align'
                //sWidth : '100px'

            },
            {
                mData : 'total_discard',
                sClass: 'text-center vertically-align'
                //sWidth : '100px'

            },
            {
                mData : 'total_commercial',
                sClass: 'text-center vertically-align'
                //sWidth : '100px'

            },
            {
                mData : 'total_business',
                sClass: 'text-center vertically-align'
                //sWidth : '100px'

            },
            {
                mData : 'records_process',
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
              "aTargets" : [ 2 ],
              "mRender" : function ( data, type, bomModel ) {
                  return bomModel.is_processed_by_cron == 0 ? 'In Cron Queue' : 'Processed By Cron';
              }
          },
          {
            "aTargets" : [ 14 ],
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
                    if(editAccess || downloadAccess){
                      html += '<a onClick="loadBatchRecords('+bomModel.id+','+bomModel.brand_id+')" href="" class="btn btn-sm btn-primary" title="view all records under this batch" data-toggle="modal" data-target="#edit-xl"><i class="fas fa-eye"></i></a>';
                    }
                    html += '</div>';
                    return html;
                }
          }
        ]
        
        
    });
};


var loadTableHeader = function(brandId,batchId){
  $('#records').addClass('table-loader');
    $.ajax({
        url: '<?php echo base_url(); ?>reports/getBrandDetailsWithDemplateById?brandId='+brandId,
        type: 'GET',
        contentType: 'application/json',
        cache: false,
        success : function(data){
            var data = JSON.parse(data);
            if(data && data.template_details.length > 0){
              $('#records').removeClass('table-loader');
              $('#tableHeader').empty();
              $(data.template_details).each(function(i,v){
                $('#tableHeader').append(`<th>`+v.header_title+`</th>`);
              });
              $('#tableHeader').append(`<th>Category</th>`);
              $('#tableHeader').append('<th>Action</th>');
            }
        },
        error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
        },
        complete : function(){

            loadDataTableForBatch(batchId);
        }
    });
}

var loadDataTableForBatch = function(batchId){
    $.ajax({
        url: '<?php echo base_url(); ?>document/loadDataTableForBatch?batchId='+batchId,
        type: 'GET',
        contentType: 'application/json',
        cache: false,
        success : function(data){ 
            var data = JSON.parse(data);
            var filteredDataArray = [];
            var filteredColumn = [];
            
            $(data).each(function(i,v){
              var row = JSON.parse(v.original_row);
              row.category_id = convertCategoryIdToText(v.category_id);
              row.id = v.id;
              $(row).each(function(key,value){
                filteredDataArray.push(value);
                if(filteredColumn.length == 0){
                  filteredColumn.push(Object.keys(value));
                }                
              });
            });

            renderDataTableForBatch(filteredDataArray,filteredColumn);
        },
        error : function(data,textStatus,errorMessage){
            alert( textStatus + " " + errorMessage);
        }
    });
}


var renderDataTableForBatch = function(filteredDataArray,filteredColumn){

  var columns = [];
  $(filteredColumn[0]).each(function(i,j){
    if( j != "Tags" && j != "commercialCampaign" && j != "eduCampaign" && j != "homeCampaign" && j != "id"){
      columns.push({
        mData : j,
        sClass: 'text-center vertically-align'
      });

      if( j == 'id' ){
        columns.push({
        mData : null,
        sClass: 'text-center vertically-align'
      });
      }
    }
    
    
  });

  if(recordTable){
    recordTable.fnClearTable();
    recordTable.fnDestroy();
  }

  if(filteredDataArray.length != 0){
    recordTable = $("#records").dataTable({
          "aaData" : filteredDataArray,
          "dom": 'lBfrtip',
          "buttons": [ 
            {  
                extend: 'copy',  
                className: 'btn btn-dark rounded-0',  
                text: '<i class="far fa-copy"></i> Copy'  
            },  
            {  
                extend: 'excel',  
                className: 'btn btn-dark rounded-0',  
                text: '<i class="far fa-file-excel"></i> Excel'  
            },  
            {  
                extend: 'pdf',  
                className: 'btn btn-dark rounded-0',  
                text: '<i class="far fa-file-pdf"></i> Pdf'  
            },  
            {  
                extend: 'csv',  
                className: 'btn btn-dark rounded-0',  
                text: '<i class="fas fa-file-csv"></i> CSV'  
            },  
            {  
                extend: 'print',  
                className: 'btn btn-dark rounded-0',  
                text: '<i class="fas fa-print"></i> Print'  
            }  
          ],
          "autoWidth": false,        
          "scrollX": true,
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "oLanguage" : {
              "sInfoEmpty" : "No record to show"
          },
          "sortable" : true,
          "aoColumns" : columns,
          "aoColumnDefs" : [
            {
                "aTargets" : [ 9 ],
                "mRender" : function ( data, type, bomModel ) {
                    if(bomModel.category_id == 'Phone Api Error' || bomModel.category_id == 'Email Api Error'){
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
                      if(editAccess || downloadAccess){
                        html += '<a onClick="reprocessSingleRecord('+bomModel.id+','+bomModel.brand_id+')" class="btn btn-sm btn-primary" title="Re-categories this record" data-toggle="modal" data-target="#edit-xl"><i class="fa fa-refresh"></i></a>';
                      }
                      html += '</div>';
                      return html;
                    }
                    return null;
                }
            }
          ]
        
        });
  }else{
    recordTable = $("#records").dataTable();
  }
}

var reprocessSingleRecord = function(recordId,brandId){
  $.ajax({
        url: '<?php echo base_url(); ?>document/reProcessSingleRow?recordId='+recordId,
        type: 'GET',
        contentType: 'application/json',
        cache: false,
        success : function(data){ 
          $.confirm({
                  title: 'Alert !',
                  content: '<div>'+
                              '<p></p>'+
                              '<b> Record processed successfully.</b>'+ 
                            '<div>',
                  type: 'green',
                  typeAnimated: true,
                  buttons: {
                      tryAgain: {
                          text: 'Okay',
                          btnClass: 'btn-green',
                          action: function(){
                            window.location.href="<?php echo $this->config->base_url() ?>dashboard";
                          }
                      }
                  }
              });
        },
        error : function(data,textStatus,errorMessage){
            alert( textStatus + " " + errorMessage);
        }
    });
}

var convertCategoryIdToText = function(categoryId){
  if( categoryId == <?php echo DUPLICATE_CATEGORY ?>){
    return 'Duplicate';
  }else if( categoryId == <?php echo PROBABLE_BUSINESS ?>){
    return 'Probable Business';
  }else if( categoryId == <?php echo HOME_CATEGORY ?>){
    return 'Home';
  }else if( categoryId == <?php echo EDU_CATEGORY ?>){
    return 'Edu';
  }else if( categoryId == <?php echo BUSINESS_CATEGORY ?>){
    return 'Business';
  }else if( categoryId == <?php echo DISCARDED_CATEGORY ?>){
    return 'Discarded';
  }else if( categoryId == <?php echo PHONE_API_RESPONSE_ERROR ?>){
    return 'Phone Api Error';
  }else if( categoryId == <?php echo EMAIL_API_RESPONSE_ERROR ?>){
    return 'Email Api Error';
  }else if( categoryId == <?php echo FREE_MAILS ?>){
    return 'Free Mail';
  }else if( categoryId == <?php echo EDU_DOMAIN ?>){
    return 'Edu Domain';
  }
}


var loadBatchRecords = function(batchId,brandId){
    //loading brand template header
    $('#batchText').html(batchId);
    loadTableHeader(brandId,batchId);
};

$(document).ready(function(){
  viewAllImport();
});
  
</script>