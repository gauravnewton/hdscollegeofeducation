

  <!-- jQuery -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/moment/moment.min.js"></script>
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo $this->config->base_url() ?>assets/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo $this->config->base_url() ?>assets/dist/js/demo.js"></script>
  <!-- Toastr -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/toastr/toastr.min.js"></script>
  <!-- Validate -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo $this->config->base_url() ?>assets/dist/js/pages/dashboard.js"></script>
  <!-- DataTables -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/image-upload/uploadPreview.min.js"></script>
  <!-- Select2 -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/select2/js/select2.full.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- Confirm plugin -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/jquery-confirm/jquery-confirm.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- Ion Slider -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>

  <!-- 3d piechart-->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/pieChart/core.js"></script>
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/pieChart/charts.js"></script>
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/pieChart/material.js"></script>
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/pieChart/de_DE.js"></script>
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/pieChart/germanyLow.js"></script>
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/pieChart/notosans.js"></script>
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/pieChart/animated.js"></script>

  <!-- DataTable Buttons -->
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/datatables-buttons/js/buttons.flash.min.js"></script>
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/jszip/jszip.min.js"></script>
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo $this->config->base_url() ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  


  <script type="text/javascript">
    $(function () {
      <?php
       if($successMessage = $this->session->flashdata('success'))
       {
         ?>
         toastr.success('<?php print_r( $successMessage )?>');
         <?php
       }else if($errorMessage =  $this->session->flashdata('error')){
        ?>
        toastr.error('<?php print_r( $errorMessage ) ?>');
        <?php
       }          
      ?>
    });
    
  </script>

  
</body>
</html>
