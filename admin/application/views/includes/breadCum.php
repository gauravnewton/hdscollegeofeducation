<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $this->session->userdata('menuSelected') ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo $this->config->base_url() ?>dashboard">Home</a></li>
                <li class="breadcrumb-item active"><?php echo $this->session->userdata('menuSelected') ?></li>
                <?php
                    if( $this->session->userdata('subMenu') != ''){
                        ?>
                            <li class="breadcrumb-item active"><?php echo $this->session->userdata('subMenu') ?></li>
                        <?php
                    }
                ?>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->