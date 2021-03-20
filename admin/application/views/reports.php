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
     



      <div class="container-fluid">
        
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
           
            
            <div class="card card-primary" style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
              <div class="card-header">
                <h3 class="card-title">Graphical Report</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                  <div class="card-header">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="brand">Select Brand</label>
                            <select name="brand" id="brand" class="form-control select2" style="width: 100%;" required>
                                <option value="" disabled selected>Choose Brand First</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                              <label>Date range:</label>

                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                  </span>
                                </div>
                                <input type="text" class="form-control float-right" id="dateRange" disabled/>
                              </div>
                              <!-- /.input group -->
                          </div>
                        </div>
                      </div>
                      
                  </div><!-- /.card-header -->
                  <div class="card-body">
                    <div class="tab-content p-0">

                      <div class="chart tab-pane active" id="barChart" style="position: relative; height: 500px; width:100%;">
                          <div class="text-center" style="padding-top:25%;"><img src="<?php echo $this->config->base_url() ?>assets/dist/img/loading11.gif"/></div>
                      </div>

                      
                    </div>
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.card-body -->
            </div>

          </section>
          <!-- /.Left col -->


          <section class="col-lg-12 connectedSortable">
           
            
            <div class="card card-info" style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
              <div class="card-header">
                <h3 class="card-title">Download Report</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                  <div class="card-header">
                     Filtered Leads Download                      
                  </div><!-- /.card-header   /*table-loader*/ -->
                  <div class="card-body">


                    <div class="tab-content p-0" style="overflow: auto; white-space: nowrap;">
                      <table class="table table-striped table-hover table-condensed " id="records">
                        <thead>
                            <tr class="text-center" id="tableHeader" style="white-space: nowrap;overflow: hidden;">
                                <div class="text-center" id="filterDiv"><strong>Please adjust filters to see downloads</strong></div>
                            </tr>
                        </thead>
                      </table>
                      
                    </div>
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.card-body -->
            </div>

          </section>
        
        </div>
        <!-- /.row (main row) -->
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
var chart;
var table;
var reportBrandId;



var renderChart = function(chartData){
    am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_material);
    am4core.useTheme(am4themes_animated);
    // Themes end

    chart = am4core.create("barChart", am4charts.PieChart3D);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

    chart.legend = new am4charts.Legend();
    
    chart.data = [
        {
            category: "Home",
            count: chartData[0].total_home,
            color: am4core.color("#522822")
        },
        {
            category: "Educational",
            count : chartData[0].total_edu,
            color: am4core.color("#2196f3")
        },
        {
            category: "Business",
            count: chartData[0].total_business,
            color: am4core.color("#3f51b5")
        },
        {
            category: "Commercial",
            count : chartData[0].total_commercial,
            color: am4core.color("#F34BB1")
        },
        {
            category: "Duplicates",
            count : chartData[0].total_duplicates,
            color: am4core.color("#f44336")
        },
        {
            category: "Discarded",
            count : chartData[0].total_discard,
            color: am4core.color("#e91e63")
        }
        // ,
        // {
        //     category: "Free Mails",
        //     count : chartData[0].total_free_mails,
        //     color: am4core.color("#9c27b0")
        // }
    ];

    var series = chart.series.push(new am4charts.PieSeries3D());
    series.dataFields.value = "count";
    series.dataFields.category = "category";
    series.slices.template.propertyFields.fill = "color";
    
    // Enable export
    if(reportBrandId){
      chart.exporting.filePrefix = "brand##"+reportBrandId+"##";
    }else{
      chart.exporting.filePrefix = "brand##ALL##";
    }
    
    chart.exporting.menu = new am4core.ExportMenu();

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

var loadChartData = function(){
    $.ajax({
        url: '<?php base_url(); ?>reports/loadChartData',
        type: 'GET',
        contentType: 'application/json',
        cache: false,
        success : function(data){ 
            var data = JSON.parse(data);
            if(data[0].total_business == null){
                $('#barChart').html(`<div class="text-center" style="padding-top:30%;"><strong>Chart data generated after document uploading and will be shown here!</strong></div>`);
            }else{
                renderChart(data);
            }          
        },
        error : function(data,textStatus,errorMessage){
            alert( textStatus + " " + errorMessage);
        }
    });
}

var loadTableHeader = function(brandId){
    $.ajax({
        url: '<?php base_url(); ?>reports/getBrandDetailsWithDemplateById?brandId='+brandId,
        type: 'GET',
        contentType: 'application/json',
        cache: false,
        success : function(data){ 
            var data = JSON.parse(data);
            if(data && data.template_details.length > 0){
              $('#tableHeader').empty();
              $(data.template_details).each(function(i,v){
                $('#tableHeader').append(`<th>`+v.header_title+`</th>`);
              });
              $('#tableHeader').append(`<th>Category</th>`);
            }
        },
        error : function(data,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
        },
        complete : function(){

          loadDataTableForBrand($('#brand').val());
        }
    });
}

var loadDataTableForBrand = function(brandId){
    reportBrandId = brandId;
    $.ajax({
        url: '<?php base_url(); ?>reports/loadDataTableForBrand?brandId='+brandId,
        type: 'GET',
        contentType: 'application/json',
        cache: false,
        success : function(data){ 
            $(".table-loader:eq(0)").removeClass('table-loader').show();
            var data = JSON.parse(data);
            var filteredDataArray = [];
            var filteredColumn = [];
            
            $(data).each(function(i,v){
              var row = JSON.parse(v.original_row);
              row.category_id = convertCategoryIdToText(v.category_id);
              $(row).each(function(key,value){
                filteredDataArray.push(value);
                if(filteredColumn.length == 0){
                  filteredColumn.push(Object.keys(value));
                }                
              });
            });

            renderDataTable(filteredDataArray,filteredColumn);
        },
        error : function(data,textStatus,errorMessage){
            alert( textStatus + " " + errorMessage);
        }
    });
}


var renderDataTable = function(filteredDataArray,filteredColumn){

  var columns = [];
  $(filteredColumn[0]).each(function(i,j){
    if( j != "Tags" && j != "commercialCampaign" && j != "eduCampaign" && j != "homeCampaign"){
        columns.push({
        mData : j,
        sClass: 'text-center vertically-align'
      });
    }              
  });



  

  if(table){
    table.fnClearTable();
    table.fnDestroy();
  }

  if(filteredDataArray.length != 0){
    table = $("#records").dataTable({
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
          "aoColumns" : columns
         
        });
  }else{
    table = $("#records").dataTable();
  }
}

var loadBrands = function(){
  $.ajax({
      url: '<?php base_url(); ?>reports/getAllBrands',
      type: 'GET',
      contentType: 'application/json',
      cache: false,
      success : function(response){ 
        response = JSON.parse(response);

        $(response).each(function(i,v){        
            $('#brand').append('<option value="'+v.id+'">'+v.brand_name+'</option>');              
        });         
      },
      error : function(response,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
};

var settingRanges = function(start,end){
  $('#dateRange').daterangepicker({
        locale: {
        format: 'YYYY-MM-DD'
      },
      startDate: start,
      endDate: end
    }
  );
}

var loadDateRangeForBrand = function(brandId){
  $.ajax({
      url: '<?php base_url(); ?>reports/getDateRangeByBrandId?brandId='+brandId,
      type: 'GET',
      contentType: 'application/json',
      cache: false,
      success : function(response){ 
        response = JSON.parse(response);
        if(response[0].startDate != null){
          settingRanges(response[0].startDate,response[0].endDate);
          loadChartDataForDateRanger(response[0].startDate,response[0].endDate,brandId);
        }else{
          if(chart){
            chart.data = [];
          }
          $.confirm({
            title: 'Alert!',
            content: `No data found for selected filters, please adjust filters! `,
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Okay',
                    btnClass: 'btn-red',
                    action: function(){
                      
                    }
                }
            }
          });
          //$('#barChart').html(`<div class="text-center" style="padding-top:30%;"><strong>No data found based on search filters.!</strong></div>`);
        }
      
      },
      error : function(response,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
};

var loadChartDataForDateRanger = function(start,end,brandId){
  $.ajax({
      url: '<?php base_url(); ?>reports/loadImportStatsByDateRange',
      data : {"start": start, "end": end, "brandId": brandId},
      type: 'GET',
      contentType: 'application/json',
      cache: false,
      success : function(data){ 
        response = JSON.parse(data);
        if(response[0].totalCount == 0 ){
          if(chart){
            chart.data = [];
          }
          $.confirm({
            title: 'Alert!',
            content: `No data found for selected filters, please adjust filters! `,
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Okay',
                    btnClass: 'btn-red',
                    action: function(){
                      
                    }
                }
            }
          });
            //$('#barChart').html(`<div class="text-center" style="padding-top:30%;"><strong>No data found based on search filters.!</strong></div>`);
        }else{
          if(reportBrandId){
            chart.exporting.filePrefix = "brand##"+reportBrandId+"##";
          }else{
            chart.exporting.filePrefix = "brand##ALL##";
          }
          
          chart.exporting.menu = new am4core.ExportMenu();

          chart.data = [
            {
                category: "Home",
                count: response[0].total_home,
                color: am4core.color("#522822")
            },
            {
                category: "Educational",
                count : response[0].total_edu,
                color: am4core.color("#2196f3")
            },
            {
                category: "Business",
                count: response[0].total_business,
                color: am4core.color("#3f51b5")
            },
            {
                category: "Commercial",
                count : response[0].total_commercial,
                color: am4core.color("#F34BB1")
            },
            {
                category: "Duplicates",
                count : response[0].total_duplicates,
                color: am4core.color("#f44336")
            },
            {
                category: "Discarded",
                count : response[0].total_discard,
                color: am4core.color("#e91e63")
            }
            // ,
            // {
            //     category: "Free Mails",
            //     count : response[0].total_free_mails,
            //     color: am4core.color("#9c27b0")
            // }
            
        ];
        }
      },
      error : function(response,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
};

var refreshDataTableRecords = function(start,end,brandId){
  $.ajax({
      url: '<?php base_url(); ?>reports/refreshDataTableRecords',
      data : {"start": start, "end": end, "brandId": brandId},
      type: 'GET',
      contentType: 'application/json',
      cache: false,
      success : function(data){ 
        response = JSON.parse(data);
        $(".table-loader:eq(0)").removeClass('table-loader').show();
          var data = JSON.parse(data);
          var filteredDataArray = [];
          var filteredColumn = [];
          
          $(data).each(function(i,v){
            var row = JSON.parse(v.original_row);
            row.category_id = convertCategoryIdToText(v.category_id);
            $(row).each(function(key,value){
              filteredDataArray.push(value);
              if(filteredColumn.length == 0){
                filteredColumn.push(Object.keys(value));
              }                
            });
          });
          if(table){
            table.fnClearTable();
            table.fnDestroy();
          }
          renderDataTable(filteredDataArray,filteredColumn);
      },
      error : function(response,textStatus,errorMessage){
          alert( textStatus + " " + errorMessage);
      }
  });
};

$(document).ready(function(){
  //Initialize Select2 Elements
  $('.select2').select2();

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  });

  $('#dateRange').daterangepicker({
    locale: {
        format: 'YYYY-MM-DD'
      }
  });
  loadBrands();
  loadChartData();
  

  $('#brand').on('change',function(){
    $('#filterDiv').html('');
    if(table){
      table.fnClearTable();
      table.fnDestroy();
    }
    $('#records').addClass('table-loader');
    $('#dateRange').prop('disabled',false);
    loadDateRangeForBrand(this.value);
    loadTableHeader(this.value);
  });

  $('#dateRange').on('change',function(){
    $('#records').addClass('table-loader');
    var rangeArray = $('#dateRange').val().split(" ");
    var start = rangeArray[0];
    var end = rangeArray[2];
    var brandId = $('#brand').val();
    loadChartDataForDateRanger(start,end,brandId);
    refreshDataTableRecords(start,end,brandId);
  });

});


  
</script>