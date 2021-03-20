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
            <h3 class="card-title">User List</h3>

            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
                
          <table class="table table-striped table-hover table-condensed table-loader" id="userList">
                <thead>
                    <tr class="text-center">
                        <th>
                            Sr. No.
                        <th>
                            User Full Name
                        </th>
                        <th>
                            User Name
                        </th>
                        <th>
                            Role
                        </th>
                        <th>
                            API Key
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
          <form action="<?php echo base_url() ?>user/updateUser"  method="post" id="user-edit-form" enctype="multipart/form-data">
          
            <div class="modal-header">
              <h3><i class="fa fa-user"> </i> User Details (Edit Mode)</h3>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <input type="hidden" name="userId_edit" id="userId_edit"/>

            <div class="modal-body user-edit">
              <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label for="fullName_edit">Full Name</label>
                        <input type="text" name="fullName_edit" id="fullName_edit" placeholder="Full name" class="form-control">
                      </div>
                  </div>
          
          
                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="email_edit">Email Address</label>
                      <input type="text" name="email_edit" id="email_edit" placeholder="Email Address" class="form-control">
                    </div>
                </div>
              </div>

              

              <div class="row">
                <div class="form-group col-sm-6">
                    <label for="role_edit">Role</label>
                    <select name="role_edit"  id="role_edit" class="form-control">
                        <option value="" disabled selected>Choose Role</option>
                        <option value="<?php echo ROLE_ADMIN ?>">Admin</option>
                        <option value="<?php echo ROLE_UPLOAD ?>">Upload only</option>
                        <option value="<?php echo ROLE_DOWNLOAD ?>">Download Only</option>
                        <option value="<?php echo ROLE_DOWNLOAD_UPLOAD ?>">Upload and Download</option>
                    </select>
                </div>

                <div class="form-group col-sm-6">
                    <label for="apiKey_edit">API Key</label>
                    <input type="text" name="apiKey_edit" id="apiKey_edit" placeholder="API Key" class="form-control">
                </div>
              </div>

              <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                <input type="checkbox" class="custom-control-input" onclick="toggleStatus(this);" id="status_edit" name="status_edit" checked="checked">
                <label class="custom-control-label" for="status_edit" id="status_edit_label" title="User Status">Active user</label>
              </div>
            </div>


            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancle <span class="fa fa-close"></sapn></button>
              <button type="submit" class="btn btn-primary">Save <span class="fa fa-check"></span></button>
            </div>
    
          </form>
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

$(function () {
    viwAllUsers();
});



var viwAllUsers = function(){
    $.ajax({
        url: 'getAllUserList',
        dataType: 'json',
        type: 'GET',
        contentType: 'application/json',
        cache: false,
        success : function(data){
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
    var count = 0;
    $("#userList").dataTable({
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
                mData : null,
                sClass: 'text-center vertically-align'
                //sWidth : '20px'
            },
            {
                mData : 'name',
                sClass: 'text-center vertically-align'
                //sWidth : '100px'

            },
            {
                mData: 'username',
                sClass: 'text-center vertically-align'
                //sWidth : '150px'
            },
            {
                mData: null,
                sClass: 'text-center vertically-align'
                //sWidth : '100px'
            },
            {
                mData: 'apikey',
                sClass: 'text-center vertically-align'
                //sWidth : '500px'
            },
            {
                mData : null,
                sClass: 'text-center vertically-align'
                //sWidth : '100px'
            }
        ],
        "aoColumnDefs" : [
            {
                "aTargets" : [ 0 ],
                "mRender" : function ( data, type, bomModel ) {
                    return ++count;
                }
            },
            {
                "aTargets" : [ 3 ],
                "mRender" : function ( data, type, bomModel ) {
                  var role;
                  switch(bomModel.roleId) {
                    case '<?php echo ROLE_ADMIN ?>':
                      role = 'Admin';
                      break;
                    case '<?php echo ROLE_DOWNLOAD ?>':
                      role = 'Download Only';
                      break;
                    case '<?php echo ROLE_UPLOAD ?>':
                      role = 'Upload only';
                      break;
                    case '<?php echo ROLE_DOWNLOAD_UPLOAD ?>':
                      role = 'Upload and Download';
                      break;
                  }
                  return role;
                }
            },
            {
                "aTargets" : [ 5 ],
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
                    }
                    html +='<a onClick="fireViewCall('+bomModel.id+')" href="" class="btn btn-sm btn-success" title="View this entry" data-toggle="modal" data-target="#view-xl"><i class="fas fa-eye"></i></a>'+
                        '</div>';
                    return html;
                }
            }]
    });
};

var fireEditCall = function(id){
    $.ajax({
        url: 'getUserById?id='+id,
        type: 'GET',
        contentType: 'application/json',
        cache: false,
        success : function(data){ 
            var data = JSON.parse(data);
            $("#userId_edit").val(data[0].id);
            $("#fullName_edit").val(data[0].name);
            $('#email_edit').val(data[0].username);            
            $("#role_edit").val(data[0].roleId);
            $("#apiKey_edit").val(data[0].apikey);
            if(data[0].status == "1"){
              $("#status_edit_label").html('Active user');              
              $("#status_edit").prop('checked',true);
            }else{
              $("#status_edit_label").html('In-Active user');
              $("#status_edit").prop('checked',false);
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

function toggleStatus($this){
  if($this.checked)
    {
      $("#status_edit_label").html('Active user');              
    }
  else
  {
    $("#status_edit_label").html('In-Active user');              
  }
}
</script>