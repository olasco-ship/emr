<?php


?>


<!doctype html>
<html lang="en">

<head>
    <title>:: Obafemi Awolowo University Teaching Hospital Complex :: Home</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Lucid Bootstrap 4.1.1 Admin Template">
    <meta name="author" content="WrapTheme, design by: ThemeMakker.com">

    <link rel="icon" href="<?php echo emr_lucid ?>/light/favicon.ico" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="<?php echo emr_lucid ?>/assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo emr_lucid ?>/assets/vendor/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo emr_lucid ?>/assets/vendor/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="<?php echo emr_lucid ?>/assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
    <link rel="stylesheet" href="<?php echo emr_lucid ?>/assets/vendor/toastr/toastr.min.css">
    <link rel="stylesheet" href="<?php echo emr_lucid ?>/assets/vendor/summernote/dist/summernote.css" />

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="<?php echo emr_lucid ?>/light/assets/css/main.css">
    <link rel="stylesheet" href="<?php echo emr_lucid ?>/light/assets/css/color_skins.css">

    <link rel="stylesheet" href="<?php echo emr_lucid ?>/assets/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo emr_lucid ?>/assets/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?php echo emr_lucid ?>/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="https://www.malot.fr/bootstrap-datetimepicker/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css">

    <link rel="stylesheet" href="<?php echo emr_lucid ?>/assets/vendor/sweetalert/sweetalert.css" />
    <link rel="stylesheet" href="<?php echo emr_lucid ?>/assets/vendor/parsleyjs/css/parsley.css">

    <link rel="stylesheet" href="<?php echo emr_lucid ?>/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="<?php echo emr_lucid ?>/assets/multiselect/css/select2.min.css">
<!--    <link rel="stylesheet" href="--><?php //echo emr_lucid ?><!--/assets/multiselect/css/calendar.css">-->

    <style>
        .typeahead {
            border: 2px solid;
            border-radius: 4px;
            padding: 8px 12px;
            max-width: 300px;
            min-width: 290px;
        }

        .tt-menu {
            width: 300px;
        }

        ul.typeahead {
            margin: 0px;
            padding: 10px 0px;
        }

        ul.typeahead.dropdown-menu li a {
            padding: 10px !important;
            border-bottom: #CCC 1px solid;
        }

        ul.typeahead.dropdown-menu li:last-child a {
            border-bottom: 0px !important;
        }

        .bgcolor {
            max-width: 550px;
            min-width: 290px;
            max-height: 340px;
            padding: 100px 10px 130px;
            border-radius: 4px;
            text-align: center;
            margin: 10px;
        }

        .demo-label {
            font-size: 1.5em;
            font-weight: 500;
        }

        .dropdown-menu>.active>a,
        .dropdown-menu>.active>a:focus,
        .dropdown-menu>.active>a:hover {
            text-decoration: none;
            outline: 0;
        }
    </style>

</head>

<body class="theme-cyan">
    <?php //  echo "Hello";   exit;  
    ?>
    <!-- Page Loader -->

    <div class="page-loader-wrapper">

        <div class="loader">
            <div class="m-t-30"><img src="<?php echo emr_lucid ?>/assets/images/dashboard.png" width="48" height="48" alt="emr"></div>
            <p>Please wait...</p>
        </div>

    </div>


    <!-- Overlay For Sidebars -->

    <div id="wrapper">

        <nav class="navbar navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-btn">
                    <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
                </div>

                <div class="navbar-brand">
                    <a href="<?php echo emr_lucid ?>/home.php"><img src="<?php echo emr_lucid ?>/assets/images/dashboard.png" alt="emr Logo"></a>
                </div>

                <div class="navbar-right">
                    <form id="navbar-search" class="navbar-form search-form">
                        <input value="" class="form-control" placeholder="Search here..." type="text">
                        <button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>
                    </form>

                    <div id="navbar-menu">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="#" class="icon-menu d-none d-sm-block d-md-none d-lg-block"><i class="icon-calendar"></i></a>
                            </li>
                            <li>
                                <a href="#" class="icon-menu d-none d-sm-block"><i class="icon-bubbles"></i></a>
                            </li>
                            <li>
                                <a href="#" class="icon-menu d-none d-sm-block"><i class="icon-envelope"></i><span class="notification-dot"></span></a>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                    <i class="icon-bell"></i>
                                    <span class="notification-dot"></span>
                                </a>
                                <ul class="dropdown-menu notifications">
                                    <li class="header"><strong>You have 2 new Notifications</strong></li>
                                    <li>
                                        <a href="<?php echo emr_lucid ?>/pharmacy/expiry.php">
                                            <div class="media">
                                                <div class="media-left">
                                                    <i class="icon-info text-warning"></i>
                                                </div>
                                                <div class="media-body">
                                                    <p class="text"> <?php echo countExpiringDrugs() ?> <strong>Drugs</strong>
                                                        in the store will be expiring soon .

                                                    </p>
                                                    <span class="timestamp">24 minutes ago</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo emr_lucid ?>/pharmacy/level.php">
                                            <div class="media">
                                                <div class="media-left">
                                                    <i class="icon-like text-success"></i>
                                                </div>
                                                <div class="media-body">
                                                    <p class="text"><?php echo countReOrderLevel() ?> <strong>Drugs</strong>
                                                        are low in order in store.
                                                    </p>
                                                    <span class="timestamp">2 hours ago</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="footer"><a href="javascript:void(0);" class="more">See all notifications</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown"><i class="icon-equalizer"></i></a>
                                <ul class="dropdown-menu user-menu menu-icon">
                                    <li class="menu-heading">ACCOUNT SETTINGS</li>
                                    <li><a href="javascript:void(0);"><i class="icon-note"></i> <span>Basic</span></a></li>
                                    <li><a href="javascript:void(0);"><i class="icon-equalizer"></i> <span>Preferences</span></a></li>
                                    <li><a href="javascript:void(0);"><i class="icon-lock"></i> <span>Privacy</span></a></li>
                                    <li><a href="javascript:void(0);"><i class="icon-bell"></i> <span>Notifications</span></a></li>
                                    <li class="menu-heading">BILLING</li>
                                    <li><a href="javascript:void(0);"><i class="icon-credit-card"></i> <span>Payments</span></a></li>
                                    <li><a href="javascript:void(0);"><i class="icon-printer"></i> <span>Invoices</span></a></li>
                                    <li><a href="javascript:void(0);"><i class="icon-refresh"></i> <span>Renewals</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="icon-menu"><i class="icon-login"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div id="left-sidebar" class="sidebar">
            <div class="sidebar-scroll">
                <?php if ($session->is_logged_in()) {
                    $user = User::find_by_id($session->user_id);
                ?>
                    <div class="user-account">
                        <img src="<?php echo emr_lucid ?>/assets/images/user.png" class="rounded-circle user-photo" alt="User Profile Picture">
                        <div class="dropdown">
                            <span>Welcome,</span>
                            <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong><?php echo $user->full_name() ?></strong></a>
                            <ul class="dropdown-menu dropdown-menu-right account">
                                <li><a href="<?php echo emr_lucid ?>/UserAccount/profile.php"><i class="icon-user"></i>My Profile</a></li>
                                <li><a href="<?php echo emr_lucid ?>/UserAccount/message.php"><i class="icon-envelope-open"></i>Messages</a></li>
                                <li><a href="javascript:void(0);"><i class="icon-settings"></i>Settings</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo emr_lucid ?>/auth/signout.php"><i class="icon-power"></i>Logout</a></li>
                            </ul>
                        </div>
                    <?php } ?>


                    </div>
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#menu">Menu</a></li>
                        <!--
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sub_menu"><i class="icon-grid"></i></a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Chat"><i class="icon-book-open"></i></a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#setting"><i class="icon-settings"></i></a></li>
                        -->
                    </ul>

                    <div class="tab-content p-l-0 p-r-0">
                        <div class="tab-pane active" id="menu">
                            <nav class="sidebar-nav">
                                <ul class="main-menu metismenu">
                                    <li class="active"><a href="<?php echo emr_lucid ?>/home.php"><i class="icon-home"></i><span>Dashboard</span></a></li>

                                    <?php
                                    if (($user->department == 'Medical Records') || ($user->role == 'Super Admin')) {
                                        ?>
                                        <li><a href="<?php echo emr_lucid ?>/patient/home.php"><i class="icon-notebook"></i><font size="4">Medical Records</font></a></li>
                                    <?php } else {
                                        ?>
                                        <!--                                        <li> <a href="#"> <i class="icon-notebook"></i>Medical Records </a> </li>-->
                                    <?php } ?>


                                    <?php
                                    if (($user->department == 'Nursing') || ($user->role == 'Super Admin')) {
                                        ?>
                                        <li><a href="<?php echo emr_lucid ?>/nursing/home.php"><i class="icon-heart"></i><font size="4">Nursing Department</font> </a></li>
                                    <?php } else {
                                        ?>
                                        <!--                                        <li><a href="#"><i class="icon-heart"></i>Nursing Department </a></li>-->
                                    <?php }  ?>


                                    <?php
                                    if (($user->department == 'Consultancy') || ($user->role == 'Super Admin')) {
                                        ?>
                                        <li><a href="<?php echo emr_lucid ?>/consultant/index.php"><i class="icon-globe"></i><font size="4">GP Consultation</font></a></li>
                                    <?php } else {
                                        ?>
                                        <!--                                        <li><a href="#"><i class="icon-globe"></i>GP Consultation</a></li>-->
                                    <?php }  ?>


                                    <?php
                                    if (($user->department == 'Account') || ($user->role == 'Super Admin')) {
                                        ?>
                                        <li><a href="<?php echo emr_lucid ?>/revenue/home.php"><i class="icon-wallet"></i><font size="4">Account & Revenue</font></a></li>
                                    <?php } else {
                                        ?>
                                        <!--                                        <li><a href="#"><i class="icon-wallet"></i> Account & Revenue </a></li>-->
                                    <?php }   ?>

                                    <?php
                                    if (($user->department == 'Audit') || ($user->role == 'Super Admin')) {
                                        ?>
                                        <li><a href="<?php echo emr_lucid ?>/audit/home.php"><i class="icon-wallet"></i><font size="4"> Audit </font></a></li>
                                    <?php } else {
                                        ?>
                                        <!--                                        <li><a href="#"><i class="icon-wallet"></i>  Audit </a></li>-->
                                    <?php }   ?>


                                    <?php
                                    if (($user->department == 'NHIS') || ($user->role == 'Super Admin')) {
                                        ?>
                                        <li><a href="<?php echo emr_lucid ?>/nhis/home.php"><i class="icon-wallet"></i><font size="4"> NHIS </font></a></li>
                                    <?php } else {
                                        ?>
                                        <!--                                        <li><a href="#"><i class="icon-wallet"></i> NHIS </a></li>-->
                                    <?php }   ?>


                                    <?php
                                    if (($user->department == 'Pharmacy') || ($user->role == 'Super Admin')) {
                                        ?>
                                        <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-drawer"></i><span><font size="4"> Pharmacy </font></span> </a>
                                            <ul>
                                                <li><a href="<?php echo emr_lucid ?>/pham/storage.php"> Storage </a></li>
                                                <li><a href="<?php echo emr_lucid ?>/pham/dispensary.php"> Dispensary </a></li>

                                            </ul>
                                        </li>
                                    <?php } else {
                                        ?>
                                        <!--                                        <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-drawer"></i><span> Pharmacy </span> </a>-->
                                        <!--                                        </li>-->
                                    <?php } ?>


                                    <?php
                                    if (($user->department == 'Laboratory') || ($user->role == 'Super Admin')) {
                                        ?>
                                        <li><a href="<?php echo emr_lucid ?>/lab/home.php"><i class="icon-bulb"></i>Laboratory Department</a></li>
                                    <?php } else {
                                        ?>
                                        <!--                                        <li><a href="#"><i class="icon-bulb"></i>Laboratory Department</a></li>-->
                                    <?php } ?>



                                    <?php
                                    if (($user->department == 'Radiology/Scan') || ($user->role == 'Super Admin')) {
                                        ?>
                                        <li><a href="<?php echo emr_lucid ?>/rad/home.php"><i class="icon-camera"></i><font size="4">Radiology/Scan</font> </a></li>
                                    <?php } else {
                                        ?>
                                        <!--                                        <li><a href="#"><i class="icon-camera"></i>Radiology/Scan </a></li>-->
                                    <?php } ?>

                                    <?php
                                    if (($user->department == 'Payment') || ($user->role == 'Super Admin')) {
                                        ?>
                                        <li><a href="<?php echo emr_lucid ?>/payment/home.php"><i class="icon-wallet"></i>Payment Confirmation</a></li>
                                    <?php } else {
                                        ?>
                                        <!--                                        <li><a href="#"><i class="icon-wallet"></i>Payment Confirmation</a></li>-->
                                    <?php } ?>


                                    <?php
                                    if (($user->department == 'ICT') || ($user->role == 'Super Admin')) {
                                        ?>
                                        <li><a href="<?php echo emr_lucid ?>/ict/home.php"><i class="icon-wallet"></i><font size="4"> ICT </font></a></li>
                                    <?php } else {
                                        ?>
                                        <!--                                        <li><a href="#"><i class="icon-wallet"></i> ICT </a></li>-->
                                    <?php } ?>

                                  <!--  <?php
/*                                    if (($user->department == 'Store') || ($user->role == 'Super Admin')) {
                                        */?>
                                        <li><a href="<?php /*echo emr_lucid */?>/store/storage.php"><i class="icon-wallet"></i> Stores </a></li>
                                    <?php /*} else {
                                        */?>
                                                                              <li><a href="#"><i class="icon-wallet"></i> Stores </a></li>
                                    --><?php /*} */?>


                                    <?php
                                    if ($user->role == 'Super Admin') {
                                        ?>

                                        <li><a href="<?php echo emr_lucid ?>/symptom_checker/symptom.php"><i class="icon-bulb"></i>Symptom Checker</a></li>

                                        <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-drawer"></i><span> Symptom
                                                    <!-- Checker --> Builder </span> </a>
                                            <ul>
                                                <li><a href="<?php echo emr_lucid ?>/symptom_checker/body_part/index.php"> Body Part </a></li>
                                                <li><a href="<?php echo emr_lucid ?>/symptom_checker/symptom/index.php"> Symptom </a></li>
                                                <li><a href="<?php echo emr_lucid ?>/symptom_checker/question/index.php"> Question </a></li>
                                                <li><a href="<?php echo emr_lucid ?>/symptom_checker/question/mapping/index.php"> Question Mapping </a></li>
                                            </ul>
                                        </li>

                                        <li><a href="<?php echo emr_lucid ?>/servicom/home.php"><i class="icon-wallet"></i>Servicom</a></li>

                                        <li><a href="javascript:void(0);" class="has-arrow"><i class="icon-user-follow"></i><span>User Management</span> </a>
                                            <ul>
                                                <li><a href="<?php echo emr_lucid ?>/UserAccount/index.php">All Users</a></li>
                                                <li><a href="<?php echo emr_lucid ?>/UserAccount/create.php">Add Users</a></li>
                                                <li><a href="<?php echo emr_lucid ?>/UserAccount/profile.php">User Profile</a></li>
                                            </ul>
                                        </li>

                                    <?php }
                                    ?>

                                    <?php
                                    if ($user->role == 'Super Admin') {
                                        ?>
                                        <li><a href="<?php echo emr_lucid ?>/online/home.php"><i class="icon-wallet"></i> Online</a></li>
                                    <?php }
                                    ?>









                                </ul>
                            </nav>
                        </div>
                        <div class="tab-pane" id="sub_menu">
                            <nav class="sidebar-nav">
                                <ul class="main-menu metismenu">
                                    <li>
                                        <a href="#uiElements" class="has-arrow"><i class="icon-diamond"></i> <span>UI Elements</span></a>
                                        <ul>
                                            <li><a href="ui-typography.html">Typography</a></li>
                                            <li><a href="ui-tabs.html">Tabs</a></li>
                                            <li><a href="ui-buttons.html">Buttons</a></li>
                                            <li><a href="ui-bootstrap.html">Bootstrap UI</a></li>
                                            <li><a href="ui-icons.html">Icons</a></li>
                                            <li><a href="ui-notifications.html">Notifications</a></li>
                                            <li><a href="ui-colors.html">Colors</a></li>
                                            <li><a href="ui-dialogs.html">Dialogs</a></li>
                                            <li><a href="ui-list-group.html">List Group</a></li>
                                            <li><a href="ui-media-object.html">Media Object</a></li>
                                            <li><a href="ui-modals.html">Modals</a></li>
                                            <li><a href="ui-nestable.html">Nestable</a></li>
                                            <li><a href="ui-progressbars.html">Progress Bars</a></li>
                                            <li><a href="ui-range-sliders.html">Range Sliders</a></li>
                                            <li><a href="ui-treeview.html">Treeview</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#forms" class="has-arrow"><i class="icon-pencil"></i> <span>Forms</span></a>
                                        <ul>
                                            <li><a href="forms-validation.html">Form Validation</a></li>
                                            <li><a href="forms-advanced.html">Advanced Elements</a></li>
                                            <li><a href="forms-basic.html">Basic Elements</a></li>
                                            <li><a href="forms-wizard.html">Form Wizard</a></li>
                                            <li><a href="forms-dragdropupload.html">Drag &amp; Drop Upload</a></li>
                                            <li><a href="forms-cropping.html">Image Cropping</a></li>
                                            <li><a href="forms-summernote.html">Summernote</a></li>
                                            <li><a href="forms-editors.html">CKEditor</a></li>
                                            <li><a href="forms-markdown.html">Markdown</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#Tables" class="has-arrow"><i class="icon-tag"></i> <span>Tables</span></a>
                                        <ul>
                                            <li><a href="table-basic.html">Tables Example<span class="badge badge-info float-right">New</span></a> </li>
                                            <li><a href="table-normal.html">Normal Tables</a> </li>
                                            <li><a href="table-jquery-datatable.html">Jquery Datatables</a> </li>
                                            <li><a href="table-editable.html">Editable Tables</a> </li>
                                            <li><a href="table-color.html">Tables Color</a> </li>
                                            <li><a href="table-filter.html">Table Filter <span class="badge badge-info float-right">New</span></a> </li>
                                            <li><a href="table-dragger.html">Table dragger <span class="badge badge-info float-right">New</span></a> </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#charts" class="has-arrow"><i class="icon-bar-chart"></i> <span>Charts</span></a>
                                        <ul>
                                            <li><a href="chart-e.html">E Charts</a> </li>
                                            <li><a href="chart-morris.html">Morris</a> </li>
                                            <li><a href="chart-flot.html">Flot</a> </li>
                                            <li><a href="chart-chartjs.html">ChartJS</a> </li>
                                            <li><a href="chart-jquery-knob.html">Jquery Knob</a> </li>
                                            <li><a href="chart-sparkline.html">Sparkline Chart</a></li>
                                            <li><a href="chart-peity.html">Peity</a></li>
                                            <li><a href="chart-c3.html">C3 Charts</a></li>
                                            <li><a href="chart-gauges.html">Gauges</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#Maps" class="has-arrow"><i class="icon-map"></i> <span>Maps</span></a>
                                        <ul>
                                            <li><a href="map-google.html">Google Map</a></li>
                                            <li><a href="map-yandex.html">Yandex Map</a></li>
                                            <li><a href="map-jvectormap.html">jVector Map</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="tab-pane p-l-15 p-r-15" id="Chat">
                            <form>
                                <div class="input-group m-b-20">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-magnifier"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Search...">
                                </div>
                            </form>
                            <ul class="right_chat list-unstyled">
                                <li class="online">
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <img class="media-object " src="<?php echo emr_lucid ?>/assets/images/xs/avatar4.jpg" alt="">
                                            <div class="media-body">
                                                <span class="name">Dr. Chris Fox</span>
                                                <span class="message">Dentist</span>
                                                <span class="badge badge-outline status"></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="online">
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <img class="media-object " src="<?php echo emr_lucid ?>/assets/images/xs/avatar5.jpg" alt="">
                                            <div class="media-body">
                                                <span class="name">Dr. Joge Lucky</span>
                                                <span class="message">Gynecologist</span>
                                                <span class="badge badge-outline status"></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="offline">
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <img class="media-object " src="<?php echo emr_lucid ?>/assets/images/xs/avatar2.jpg" alt="">
                                            <div class="media-body">
                                                <span class="name">Dr. Isabella</span>
                                                <span class="message">CEO, WrapTheme</span>
                                                <span class="badge badge-outline status"></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="offline">
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <img class="media-object " src="<?php echo emr_lucid ?>/assets/images/xs/avatar1.jpg" alt="">
                                            <div class="media-body">
                                                <span class="name">Dr. Folisise Chosielie</span>
                                                <span class="message">Physical Therapy</span>
                                                <span class="badge badge-outline status"></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="online">
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <img class="media-object " src="<?php echo emr_lucid ?>/assets/images/xs/avatar3.jpg" alt="">
                                            <div class="media-body">
                                                <span class="name">Dr. Alexander</span>
                                                <span class="message">Audiology</span>
                                                <span class="badge badge-outline status"></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane p-l-15 p-r-15" id="setting">
                            <h6>Choose Skin</h6>
                            <ul class="choose-skin list-unstyled">
                                <li data-theme="purple">
                                    <div class="purple"></div>
                                    <span>Purple</span>
                                </li>
                                <li data-theme="blue">
                                    <div class="blue"></div>
                                    <span>Blue</span>
                                </li>
                                <li data-theme="cyan" class="active">
                                    <div class="cyan"></div>
                                    <span>Cyan</span>
                                </li>
                                <li data-theme="green">
                                    <div class="green"></div>
                                    <span>Green</span>
                                </li>
                                <li data-theme="orange">
                                    <div class="orange"></div>
                                    <span>Orange</span>
                                </li>
                                <li data-theme="blush">
                                    <div class="blush"></div>
                                    <span>Blush</span>
                                </li>
                            </ul>
                            <hr>
                            <h6>General Settings</h6>
                            <ul class="setting-list list-unstyled">
                                <li>
                                    <label class="fancy-checkbox">
                                        <input type="checkbox" name="checkbox">
                                        <span>Report Panel Usag</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="fancy-checkbox">
                                        <input type="checkbox" name="checkbox">
                                        <span>Email Redirect</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="fancy-checkbox">
                                        <input type="checkbox" name="checkbox" checked>
                                        <span>Notifications</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="fancy-checkbox">
                                        <input type="checkbox" name="checkbox" checked>
                                        <span>Auto Updates</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="fancy-checkbox">
                                        <input type="checkbox" name="checkbox">
                                        <span>Offline</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="fancy-checkbox">
                                        <input type="checkbox" name="checkbox" checked>
                                        <span>Location Permission</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
            </div>
        </div>