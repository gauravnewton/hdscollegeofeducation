<?php
    $currentContext = $this->session->userdata('menuSelected');
    $subMenu = $this->session->userdata('subMenu');
   
    /**
     * top level menus
     */
    $dashBoard = false;
    $api = false;
    $users = false;
    $brand = false;
    $document = false;
    $report = false;
    $keywords = false;
    $reports = false;
    $api = false;
    $records = false;
    $logs = false;
    $gallery = false;
    $notifications = false;

    

    /**
     * first level sub menus
     */
    $userSignUp = false;
    $userList = false;
    $addBrand = false;
    $brandList = false;
    $documentUpload = false;
    $documentList = false;
    $keywordAio = false;
    $viewReport = false;
    $apiManagement = false;
    $listRecords = false;
    $recordLogs = false;
    $galleryViewUpload = false;
    $notificationManagement = false;

    switch ($currentContext) {
        case GALLERY:
            $gallery = true;
            break;
        case DASHBOARD:
            $dashBoard = true;
            break;
        case USERS:
            $users = true;
            break;
        case BRAND:
            $brand = true;
            break;
        case DOCUMENT:
            $document = true;
            break;
        case KEYWORDS:
            $keywords = true;
            break;
        case REPORTS:
            $reports = true;
            break;
        case API:
            $api = true;
            break;
        case RECORDS:
            $records = true;
            break;
        case LOGS:
            $logs = true;
            break;
        case NOTIFICATIONS:
            $notifications = true;
            break;
        default:

    }


    switch ($subMenu) {
        case NOTIFICATION_MANAGEMENT:
            $notificationManagement = true;
            break;
        case GALLERYVIEUPLOAD:
            $galleryViewUpload = true;
            break;
        case USER_SIGNUP:
            $userSignUp = true;
            break;
        case USER_LIST:   
            $userList = true;
            break;
        case CREATE_BRAND:
            $addBrand =  true;
            break;
        case BRAND_LIST:
            $brandList = true;
            break;
        case DOCUMENT_UPLOAD:
            $documentUpload = true;
            break;
        case DOCUMENT_LIST:
            $documentList = true;
            break;
        case KEYWORDS_AIO:
            $keywordAio = true;
            break;
        case REPORT_VIEW:
            $viewReport = true;
            break;
        case API_MANAGEMENT:
            $apiManagement = true;
            break;
        case LIST_RECORDS:
            $listRecords = true;
            break;
        case LIST_LOGS:
            $recordLogs = true;
        default:
    } 
?>


<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        <!-- Dashboard -->
        <li class="nav-item has-treeview <?php $dashBoard ? print_r('menu-open') : '' ?>">
            <a href="<?php echo base_url() ?>dashboard" class="nav-link <?php $dashBoard ? print_r('active') : '' ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p><?php echo DASHBOARD ?></p>
            </a>
        </li>


         <!-- GALLERY -->
         <li class="nav-item has-treeview <?php $gallery ? print_r('menu-open') : ''?>">
            <a href="#" class="nav-link <?php $gallery ? print_r('active') : '' ?>">
              <i class="nav-icon fa fa-picture-o"></i>
              <p>
                <?php echo GALLERY ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
              <li class="nav-item">
                <a href="<?php echo base_url() ?>gallery" class="nav-link <?php $galleryViewUpload ? print_r('active') : '' ?>">
                  <i class="fa fa-file-image-o  nav-icon"></i>
                  <p><?php echo GALLERYVIEUPLOAD ?></p>
                </a>
              </li>
              
            </ul>
        </li>



        <!-- NOTIFICATIONS -->
        <li class="nav-item has-treeview <?php $notifications ? print_r('menu-open') : ''?>">
            <a href="#" class="nav-link <?php $notifications ? print_r('active') : '' ?>">
              <i class="nav-icon fa fa-bell"></i>
              <p>
                <?php echo NOTIFICATIONS ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
              <li class="nav-item">
                <a href="<?php echo base_url() ?>notifications" class="nav-link <?php $notificationManagement ? print_r('active') : '' ?>">
                  <i class="fa fa-cogs nav-icon"></i>
                  <p><?php echo NOTIFICATION_MANAGEMENT ?></p>
                </a>
              </li>
              
            </ul>
        </li>


      <?php

      /**

        Brands
        <li class="nav-item has-treeview <?php $brand ? print_r('menu-open') : ''?>">
            <a href="#" class="nav-link <?php $brand ? print_r('active') : '' ?>">
              <i class="nav-icon fa fa-building"></i>
              <p>
                <?php echo BRAND ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url() ?>brand/listBrand" class="nav-link <?php $brandList ? print_r('active') : '' ?>">
                  <i class="fas fa-list  nav-icon"></i>
                  <p><?php echo BRAND_LIST ?></p>
                </a>
              </li>
              
              
              <?php
              if( $this->session->userdata('roleId') == SUPER_USER || $this->session->userdata('roleId') == ROLE_ADMIN){
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url() ?>brand/create " class="nav-link <?php $addBrand ? print_r('active') : '' ?>">
                      <i class="fas fa-folder-plus   nav-icon"></i>
                      <p><?php echo CREATE_BRAND?></p>
                    </a>
                </li>
                <?php
              }
              ?>
            </ul>
        </li>


        
        
        
        <!-- Users -->
        <li class="nav-item has-treeview <?php $users ? print_r('menu-open') : ''?>">
            <a href="#" class="nav-link <?php $users ? print_r('active') : '' ?>">
              <i class="nav-icon fa fa-users"></i>
              <p>
                <?php echo USERS ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url() ?>user/userlist" class="nav-link <?php $userList ? print_r('active') : '' ?>">
                  <i class="fas fa-list  nav-icon"></i>
                  <p><?php echo USER_LIST ?></p>
                </a>
              </li>
              
              
              <?php
              if( $this->session->userdata('roleId') == SUPER_USER || $this->session->userdata('roleId') == ROLE_ADMIN){
                ?>
                <li class="nav-item">
                  <a href="<?php echo base_url() ?>user/signUp " class="nav-link <?php $userSignUp ? print_r('active') : '' ?>">
                      <i class="fa fa-user-plus   nav-icon"></i>
                      <p><?php echo USER_SIGNUP?></p>
                    </a>
                </li>
                <?php
              }
              ?>
            </ul>
        </li>



        <!-- DOCUMENTS/Batch -->

        <li class="nav-item has-treeview <?php $document ? print_r('menu-open') : ''?>">
            <a href="#" class="nav-link <?php $document ? print_r('active') : '' ?>">
              <i class="nav-icon fa fa-file"></i>
              <p>
                <?php echo DOCUMENT ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php
            
            if( $this->session->userdata('roleId') != ROLE_DOWNLOAD){
            ?>
              <li class="nav-item">
                <a href="<?php echo base_url() ?>document/uploadDocument" class="nav-link <?php $documentUpload ? print_r('active') : '' ?>">
                  <i class="fa fa-download nav-icon"></i>
                  <p><?php echo DOCUMENT_UPLOAD ?></p>
                </a>
              </li>
            <?php
            }
            ?>
              
   
            <li class="nav-item">
              <a href="<?php echo base_url() ?>document/listDocument " class="nav-link <?php $documentList ? print_r('active') : '' ?>">
                  <i class="fas fa-list   nav-icon"></i>
                  <p><?php echo DOCUMENT_LIST?></p>
                </a>
            </li>
            </ul>
        </li>



        <!-- RECORDS -->
        <li class="nav-item has-treeview <?php $records ? print_r('menu-open') : ''?>">
            <a href="#" class="nav-link <?php $records ? print_r('active') : '' ?>">
              <i class="nav-icon fa fa-book"></i>
              <p>
                <?php echo RECORDS ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php
            
            if( $this->session->userdata('roleId') != ROLE_DOWNLOAD){
            ?>
              <li class="nav-item">
                <a href="<?php echo base_url() ?>records" class="nav-link <?php $listRecords ? print_r('active') : '' ?>">
                  <i class="fa fa-clone nav-icon"></i>
                  <p><?php echo LIST_RECORDS ?></p>
                </a>
              </li>
            <?php
            }
            ?>
              
   
            </ul>
        </li>


        <!-- KEYWORDS -->
        <li class="nav-item has-treeview <?php $keywords ? print_r('menu-open') : ''?>">
            <a href="#" class="nav-link <?php $keywords ? print_r('active') : '' ?>">
              <i class="nav-icon fas fa-key"></i>
              <p>
                <?php echo KEYWORDS ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
              <li class="nav-item">
                <a href="<?php echo base_url() ?>keywords" class="nav-link <?php $keywordAio ? print_r('active') : '' ?>">
                  <i class="fas fa-tasks  nav-icon"></i>
                  <p><?php echo KEYWORDS_AIO ?></p>
                </a>
              </li>
              
            </ul>
        </li>

        <!-- REPORTS -->
        <li class="nav-item has-treeview <?php $reports ? print_r('menu-open') : ''?>">
            <a href="#" class="nav-link <?php $reports ? print_r('active') : '' ?>">
              <i class="nav-icon fa fa-certificate"></i>
              <p>
                <?php echo REPORTS ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
              <li class="nav-item">
                <a href="<?php echo base_url() ?>reports" class="nav-link <?php $viewReport ? print_r('active') : '' ?>">
                  <i class="fa fa-eye  nav-icon"></i>
                  <p><?php echo REPORT_VIEW ?></p>
                </a>
              </li>
              
            </ul>
        </li>

        <!-- API -->
        <li class="nav-item has-treeview <?php $api ? print_r('menu-open') : ''?>">
            <a href="#" class="nav-link <?php $api ? print_r('active') : '' ?>">
              <i class="nav-icon fa fa-plug"></i>
              <p>
                <?php echo API ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
              <li class="nav-item">
                <a href="<?php echo base_url() ?>api" class="nav-link <?php $apiManagement ? print_r('active') : '' ?>">
                  <i class="fa fa-cogs  nav-icon"></i>
                  <p><?php echo API_MANAGEMENT ?></p>
                </a>
              </li>
              
            </ul>
        </li>


        
        <!-- LOGS -->
        <li class="nav-item has-treeview <?php $logs ? print_r('menu-open') : ''?>">
            <a href="#" class="nav-link <?php $logs ? print_r('active') : '' ?>">
              <i class="nav-icon fa fa-bars"></i>
              <p>
                <?php echo LOGS ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php
            
            if( $this->session->userdata('roleId') != ROLE_DOWNLOAD){
            ?>
              <li class="nav-item">
                <a href="<?php echo base_url() ?>recordLogs" class="nav-link <?php $recordLogs ? print_r('active') : '' ?>">
                  <i class="fa fa-server nav-icon"></i>
                  <p><?php echo LIST_LOGS ?></p>
                </a>
              </li>
            <?php
            }
            ?>
              
   
            </ul>
        </li>


         **/

         ?>


        <!-- Logout -->
        <li class="nav-item has-treeview">
            <a href="<?php echo base_url() ?>accounts/logout" class="nav-link ">
                <i class="fas fa-sign-out-alt  nav-icon"></i>
                <p>Logout</p>
            </a>
        </li>
        
          
    </ul>
</nav>




    