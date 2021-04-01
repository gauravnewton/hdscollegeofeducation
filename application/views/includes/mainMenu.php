<?php
    $currentContext = $this->session->userdata('menuSelected');
    $subMenu = $this->session->userdata('subMenu');
   
    /**
     * top level menus
     */
    $home = false;
    $courses = false;
    $weeklyReport = false;
    /**
     * first level sub menus
     */
    

    switch ($currentContext) {
        case HOME:
            $home = true;
            break;
        case COURSES:
            $courses = true;
            break;
        case WEEKLY_REPORT:
            $weeklyReport = true;
        default:

    }


    switch ($subMenu) {
        
        
        default:
    } 
?>

<nav class="navbar navbar-default">
    <div class="navbar-header navbar-left">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div><a class="navbar-brand" href="index.html"><span>H</span>ARAKHDEO SINGH COLLEGE OF EDUCATION<br/>
        <small>Ramanuja Bagh, Khudaganj (Nalanda)</small></a></div>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
        <nav class="link-effect-2" id="link-effect-2">
            <ul class="nav navbar-nav">
                <li class=" <?php $home ? print_r('active') : '' ?> "><a href="home"><span data-hover="Home">Home</span></a></li>
                <li class="<?php $courses ? print_r('active') : '' ?> "><a href="courses"><span data-hover="Courses">Courses</span></a></li>
                <!--<li><a href="services.html"><span data-hover="Services">Services</span></a></li>-->
                <li class="<?php $weeklyReport ? print_r('active') : '' ?> "><a href="weeklyReport"><span data-hover="Weekly Attendance Report">Weekly Attendance Report</span></a></li>
                <!-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span data-hover="Short Codes">Short Codes</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu agile_short_dropdown">
                        <li><a href="icons.html">Web Icons</a></li>
                        <li><a href="typography.html">Typography</a></li>
                    </ul>
                </li> -->
                <li><a href="<?php echo $this->config->base_url() ?>/admin"><span data-hover="Admin Login">Admin Login</span></a></li>
            </ul>
        </nav>
    </div>
    <div class="w3_agile_phone">
        <!-- <p><i class="fa fa-phone" aria-hidden="true"></i> +123 234 233</p> -->
    </div>
</nav>