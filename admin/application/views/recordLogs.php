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
          <h3 class="card-title">All Logs</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content p-0" style="overflow: auto; white-space: nowrap;">
                <table class="table table-striped table-hover table-condensed table-loader" id="recordLogs">
                    <thead>
                        <tr class="text-center">
                            <th>
                                Log Id
                            <th>
                                Record Id
                            </th>
                            <th>
                                Event Type
                            </th>
                            <th>
                                Request Payload
                            </th>
                            <th>
                                Response Payload
                            </th>
                            <th>
                                Time Stamp
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



var renderDataTable = function(){
  

  $.ajax({  
      type: "GET",
      url: "<?php echo $this->config->base_url() ?>recordLogs/loadAllLogs",
      contentType: "application/json",
      success : function(data){
        var logs = JSON.parse(data);
        $(".table-loader:eq(0)").removeClass('table-loader').show(); //for header
        $(".table-loader:eq(0)").removeClass('table-loader').show(); // for body
        $("#recordLogs").dataTable({
            "aaData" : logs,
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
                    mData : 'record_id',
                    sClass: 'text-center vertically-align'
                    //sWidth : '100px'
                },
                {
                    mData: 'event_type',
                    sClass: 'text-center vertically-align'
                    //sWidth : '150px'
                },
                {
                    mData: null,
                    sClass: 'text-left vertically-align'
                    //sWidth : '150px'
                },
                {
                    mData: null,
                    sClass: 'text-left vertically-align'
                    //sWidth : '100px'
                },
                {
                    mData: 'timestamp',
                    sClass: 'text-center vertically-align'
                    //sWidth : '100px'
                }


            ],
            "aoColumnDefs" : [
                {
                  "aTargets" : [ 3 ],
                  "mRender" : function ( data, type, bomModel ) {
                    var html = "<div>";
                    
                    try {
                      data = JSON.parse(data.request_payload);
                      html += "<pre  class='pretty-json'>"+JSON.stringify(data, undefined, 2)+"</pre>"
                    }
                    catch(err) {
                      html += data.request_payload;
                    }
                    html += "</div></pre>";
                    return html;
                  }
                },
                {
                    "aTargets" : [ 4 ],
                    "mRender" : function ( data, type, bomModel ) {
                      var html = "<div>";
                    
                      try {
                        data = JSON.parse(data.response_payload);
                        html += "<pre  class='pretty-json'>"+JSON.stringify(data, undefined, 2)+"</pre>"
                      }
                      catch(err) {
                        html += data.response_payload;
                      }
                      html += "</div></pre>";
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

function pretty(ob, lvl = 0) {

let temp = [];

if(typeof ob === "object"){
  for(let x in ob) {
    if(ob.hasOwnProperty(x)) {
      temp.push( getTabs(lvl+1) + x + ":" + pretty(ob[x], lvl+1) );
    }
  }
  return "{\n"+ temp.join(",\n") +"\n" + getTabs(lvl) + "}";
}
else {
  return ob;
}

}

function getTabs(n) {
let c = 0, res = "";
while(c++ < n)
  res+="\t";
return res;
}

$(document).ready(function(){

  
    renderDataTable();

});
  
</script>