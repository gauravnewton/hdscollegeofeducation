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
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner" id="totalBrands">
                <div class="text-center"><img class="img-fluid" src="<?php echo $this->config->base_url() ?>assets/dist/img/loading11.gif"/></div>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner" id="totalKeywords">
                <div class="text-center"><img class="img-fluid" src="<?php echo $this->config->base_url() ?>assets/dist/img/loading11.gif"/></div>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner" id="totalBatchImported">
                <div class="text-center"><img class="img-fluid" src="<?php echo $this->config->base_url() ?>assets/dist/img/loading11.gif"/></div>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner" id="totalUsers">
                <div class="text-center"><img class="img-fluid" src="<?php echo $this->config->base_url() ?>assets/dist/img/loading11.gif"/></div>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->



        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-8 connectedSortable">
           
            
            <div class="card card-primary" style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
              <div class="card-header">
                <h3 class="card-title">Quick Report</h3>

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
                    <h3 class="card-title">
                      <i class="fas fa-chart-bar mr-1"></i>
                      All brand's overall report
                    </h3>
                    <div class="card-tools">
                      <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                          <!-- <a class="nav-link active" href="#monthlyChart" data-toggle="tab">Monthly</a> -->
                        </li>
                        
                      </ul>
                    </div>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                    <div class="tab-content p-0">

                      <div class="chart tab-pane active" id="barChart" style="position: relative; height: 500px; width:100%;">
                            <div class="text-center" style="padding-top:30%;"><img src="<?php echo $this->config->base_url() ?>assets/dist/img/loading11.gif"/></div>
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

          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-4 connectedSortable">


            <!-- USERS LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lead(s) Processed Till Now</h3>

                <div class="card-tools">
                  <!-- <span class="badge badge-danger">8 New Members</span> -->
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="users-list clearfix" id="totalRecordCount">
                  <br>
                  <div class="text-center"><img src="<?php echo $this->config->base_url() ?>assets/dist/img/loading11.gif"/></div>
                </ul>
                <!-- /.users-list -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="javascript::">View All Leads</a>
              </div>
              <!-- /.card-footer -->
             </div>
            <!--/.card -->

            <!-- USERS LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Additional Stats</h3>

                <div class="card-tools">
                  <!-- <span class="badge badge-danger">8 New Members</span> -->
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                
                  <div class="info-box mb-3 bg-info">


                    <span class="info-box-icon"><i id="totalMailError" ></i></span>

                    <div class="info-box-content" id="totalMailErrorContent">
                      <div class="text-center"><img src="<?php echo $this->config->base_url() ?>assets/dist/img/loading11.gif"/></div>
                    </div>
                    <!-- /.info-box-content -->
                  </div>


                  <!-- /.info-box -->
                  <div class="info-box mb-3 bg-danger">
                    <span class="info-box-icon"><i id="totalPhoneError"></i></span>

                    <div class="info-box-content" id="totalPhoneErrorContent">
                     <div class="text-center"><img src="<?php echo $this->config->base_url() ?>assets/dist/img/loading11.gif"/></div>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->


              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="javascript::"><!--View All Users--></a>
              </div>
              <!-- /.card-footer -->
             </div>
            <!--/.card -->

            <!-- Calendar -->
            <div class="card bg-gradient-success">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

             
          </section>
          <!-- right col -->
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


<script type="text/javascript">

  

  var renderChart = function(chartData){
    am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_material);
    am4core.useTheme(am4themes_animated);
    // Themes end

    var chart = am4core.create("barChart", am4charts.PieChart3D);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

    chart.legend = new am4charts.Legend();

    chart.data = [
      {
        category: "Home",
        count: chartData[0].total_home
      },
      {
        category: "Educational",
        count : chartData[0].total_edu
      },
      {
        category: "Business",
        count: chartData[0].total_business
      },
      {
        category: "Commercial",
        count : chartData[0].total_commercial
      }
    ];

    var series = chart.series.push(new am4charts.PieSeries3D());
    series.dataFields.value = "count";
    series.dataFields.category = "category";

    });
  }

  var loadChartData = function(){
    $.ajax({
        url: '<?php base_url(); ?>dashboard/loadChartData',
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
          
          loadTotalBrands();
    
        },
        error : function(data,textStatus,errorMessage){
            alert( textStatus + " " + errorMessage);
        }
    });
  }
  
  var loadTotalBrands = function(){
    $.ajax({
        url: '<?php base_url(); ?>dashboard/loadTotalBrands',
        type: 'GET',
        contentType: 'application/json',
        cache: false,
        success : function(data){ 
          var data = JSON.parse(data);
         
            var html = `<h3>`+data+`</h3>
                      <p>Unique Brand(s)</p>`;
            $('#totalBrands').html(html);

            loadTotalKeywords();
   
          
        },
        error : function(data,textStatus,errorMessage){
            alert( textStatus + " " + errorMessage);
        }
    });
  }

  var loadTotalKeywords = function(){
    $.ajax({
        url: '<?php base_url(); ?>dashboard/loadTotalKeywords',
        type: 'GET',
        contentType: 'application/json',
        cache: false,
        success : function(data){ 
          var data = JSON.parse(data);
          
            var html = `<h3>`+data+`</h3>
                      <p>Unique Keyword(s)</p>`;
            $('#totalKeywords').html(html);
          
            loadTotalBatchs();
    
        },
        error : function(data,textStatus,errorMessage){
            alert( textStatus + " " + errorMessage);
        }
    });
  }

  var loadTotalBatchs = function(){
    $.ajax({
        url: '<?php base_url(); ?>dashboard/loadTotalBatchs',
        type: 'GET',
        contentType: 'application/json',
        cache: false,
        success : function(data){ 
          var data = JSON.parse(data);
          
            var html = `<h3>`+data+`</h3>
                      <p>Unique batch(s) imported</p>`;
            $('#totalBatchImported').html(html);

            loadTotalUsers();
    
          
        },
        error : function(data,textStatus,errorMessage){
            alert( textStatus + " " + errorMessage);
        }
    });
  }

  var loadTotalUsers = function(){
    $.ajax({
        url: '<?php base_url(); ?>dashboard/loadTotalUsers',
        type: 'GET',
        contentType: 'application/json',
        cache: false,
        success : function(data){ 
          var data = JSON.parse(data);
          
            var html = `<h3>`+data+`</h3>
                      <p>Unique user(s)</p>`;
            $('#totalUsers').html(html);

            loadTatalLeadsProcessed();
    
          
        },
        error : function(data,textStatus,errorMessage){
            alert( textStatus + " " + errorMessage);
        }
    });
  }

  var loadTatalLeadsProcessed =function(){
    $.ajax({
        url: '<?php base_url(); ?>dashboard/loadTotalRecords',
        type: 'GET',
        contentType: 'application/json',
        cache: false,
        success : function(data){ 
          var data = JSON.parse(data);
          
          var html = `<h3 class="info-box-text text-center p-4"><strong>`+data+`</strong></h3>`;
                    $('#totalRecordCount').html(html);
          
          totalEmailAPiError();
    
          
        },
        error : function(data,textStatus,errorMessage){
            alert( textStatus + " " + errorMessage);
        }
    });
  }

  var totalEmailAPiError = function(){
    $.ajax({
        url: '<?php base_url(); ?>dashboard/gettAllEmailApiError',
        type: 'GET',
        contentType: 'application/json',
        cache: false,
        success : function(data){ 
          var data = JSON.parse(data);
          var html = '';
          if(data.mail_error != null){
            count = data.mail_error;
          }else{
            count = 0;
          }

          var html = html+`<span class="info-box-text">Total clearout email api error count</span>
                      <span class="info-box-number">`+count+`</span>`;
          $('#totalMailErrorContent').html(html);
          $('#totalMailError').addClass('fa fa-envelope');
          
          totalPhoneAPiError();
          
        },
        error : function(data,textStatus,errorMessage){
            alert( textStatus + " " + errorMessage);
        }
    });
  }


  var totalPhoneAPiError = function(){
    $.ajax({
        url: '<?php base_url(); ?>dashboard/gettAllPhoneApiError',
        type: 'GET',
        contentType: 'application/json',
        cache: false,
        success : function(data){ 
          var data = JSON.parse(data);
          var html = '';
          if(data.mail_error != null){
            count = data.mail_error;
          }else{
            count = 0;
          }

          var html = html+`<span class="info-box-text">Total clearphone email api error count</span>
                      <span class="info-box-number">`+count+`</span>`;
          $('#totalPhoneErrorContent').html(html);
          $('#totalPhoneError').addClass('fa fa-phone-square');
          
          
          
        },
        error : function(data,textStatus,errorMessage){
            alert( textStatus + " " + errorMessage);
        }
    });
  }
    
  $(function () {
    loadChartData();
     
  });
</script>