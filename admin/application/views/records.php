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

    <div class="card card-outline card-success">
        <div class="card-header">
          <h3 class="card-title">All Records</h3>

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
                                Record Id
                            <th>
                                Date
                            </th>
                            <th>
                                Country
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Telephone
                            </th>
                            <th>
                                Record Category as
                            </th>
                            <th>
                                Action
                            </th>
                            <th>
                                Brand
                            </th>
                            <th>
                                Batch
                            </th>
                            <th>
                                Original Row
                            </th>
                            <th>
                                Async Row Id
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

<script tyep="text/javascript">


var loadAllRecords = function(){
    $.ajax({  
        type: "GET",
        url: "<?php echo $this->config->base_url() ?>records/loadAllRecords",
        contentType: "application/json",
        success : function(response){
            $(".table-loader:eq(0)").removeClass('table-loader').show(); //for header
            $(".table-loader:eq(0)").removeClass('table-loader').show(); // for body
            if(response){
                response = JSON.parse(response);
                renderDataTable(response);
            }
        },
        error : function(data,textStatus,errorMessage){
            alert( textStatus + " " + errorMessage);
        }
    });
}

var renderDataTable = function(response){
  

  $.ajax({  
      type: "GET",
      url: "<?php echo $this->config->base_url() ?>records/loadAllCategories",
      contentType: "application/json",
      success : function(data){
        var allCategories = JSON.parse(data);

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
                    mData : 'recordId',
                    sClass: 'text-center vertically-align'
                    //sWidth : '20px'
                },
                {
                    mData : 'recordDate',
                    sClass: 'text-center vertically-align'
                    //sWidth : '100px'
                },
                {
                    mData: 'countryName', //country
                    sClass: 'text-center vertically-align'
                    //sWidth : '150px'
                },
                {
                    mData: 'recordEmail',
                    sClass: 'text-center vertically-align'
                    //sWidth : '150px'
                },
                {
                    mData: 'recordPhone',
                    sClass: 'text-center vertically-align'
                    //sWidth : '100px'
                },
                {
                    mData: null,//category
                    sClass: 'text-center vertically-align'
                    //sWidth : '100px'
                },
                {
                    mData: null,//action
                    sClass: 'text-center vertically-align'
                    //sWidth : '100px'
                },
                {
                    mData: 'brandName',//brand
                    sClass: 'text-center vertically-align'
                    //sWidth : '100px'
                },
                {
                    mData: 'recordBatchId',//batch id
                    sClass: 'text-center vertically-align'
                    //sWidth : '100px'
                },
                {
                    mData: 'originalRow',//original_row
                    sClass: 'text-center vertically-align'
                    //sWidth : '100px'
                },
                {
                    mData: 'asyncId',//async_record_id
                    sClass: 'text-center vertically-align'
                    //sWidth : '100px'
                }


            ],
            "aoColumnDefs" : [
                {
                    "aTargets" : [ 5 ],
                    "mRender" : function(d,t,r){
                        var $select = $("<select id='rec-category-"+d.recordId+"' class='form-control select2' style='width: 100%;'></select>", {
                            "id": r[0]+"start",
                            "value": d
                        });
                        $.each(allCategories, function(k,v){
                            var $option = $("<option></option>", {
                                "text": v.name,
                                "value": v.id
                            });
                            if(d.recordCategory === v.id){
                                $option.attr("selected", "selected")
                            }

                            if(v.id == <?php echo PHONE_API_RESPONSE_ERROR ?> ||
                                v.id == <?php echo EMAIL_API_RESPONSE_ERROR ?> ||
                                v.id == <?php echo FREE_MAILS ?> ||
                                v.id == <?php echo EDU_DOMAIN ?>){
                                $option.attr("disabled", "true")
                            }
                            $select.append($option);
                        });
                        return $select.prop("outerHTML");
                    }
                    
                },
                {
                    "aTargets" : [ 6 ],
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
                          html +='<a onClick="resendRecordLite('+bomModel.recordId+')" class="text-white btn btn-sm btn-success" title="Resend this record to web hooks"><i class="fas fa-recycle"></i></a>'+
                          '</div>';
                        }            
                            
                        return html;
                    }
            }]
             
        });
      },
      error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });


   
}

var resendRecordLite = function(recordId){

    $.ajax({  
      type: "POST",
      url: "<?php echo $this->config->base_url() ?>document/resendRecordWithDefinedCategory",
      data: JSON.stringify({"recordId" : recordId,"categoryId" : $('#rec-category-'+recordId).val()}),
      contentType: "application/json",
      success : function(data){
        var allCategories = JSON.parse(data);
        if(allCategories && allCategories.isSuccess){
            $.confirm({
            title: 'Alert!',
            content: allCategories.response,
            type: 'green',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Okay',
                    btnClass: 'btn-green',
                    action: function(){
                      
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


$(document).ready(function(){
    
  
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    loadAllRecords();
});
  
</script>