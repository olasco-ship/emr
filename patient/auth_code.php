<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/1/2019
 * Time: 9:25 AM
 */
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$done = FALSE;

if (is_post()) {

    if (empty($_POST['auth_code'])) {
        $errAuthCode = "Authorization Code is Required";
        $errorMessage .= $errAuthCode . "<br/>";
    } else {
        $auth_code = test_input($_POST['auth_code']);
    }

    $confirm = Bill::find_by_auth_code($auth_code);

    if ($confirm->status == "CLEARED")
        $errorMessage = "Payment Reference has been previously used!";


    if ((!$errorMessage) and (empty($errorMessage)))
    {
        if (!empty($confirm)) {
            $done = TRUE;
            redirect_to("create.php?id=$confirm->id");
        } else {
            $errorMessage = "Authorization code not found in database";
        }
    }

/*    if (!empty($confirm)) {
        $done = TRUE;
        redirect_to("create.php?id=$confirm->id");
    } else {
        $errorMessage = "Authorization code not found in database";
    }*/


}


require('../layout/header.php');
?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Medical Records</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Records</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        <div class="bh_chart hidden-xs">
                            <div class="float-left m-r-15">
                                <small>Visitors</small>
                                <h6 class="mb-0 mt-1"><i class="icon-user"></i> 1,784</h6>
                            </div>
                            <span class="bh_visitors float-right">2,5,1,8,3,6,7,5</span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Visits</small>
                                <h6 class="mb-0 mt-1"><i class="icon-globe"></i> 325</h6>
                            </div>
                            <span class="bh_visits float-right">10,8,9,3,5,8,5</span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Chats</small>
                                <h6 class="mb-0 mt-1"><i class="icon-bubbles"></i> 13</h6>
                            </div>
                            <span class="bh_chats float-right">1,8,5,6,2,4,3,2</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
              <!-- 
                   <div class="col-lg-3 col-md-12">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-6">
                            <div class="card top_counter">
                                <div class="body">
                                    <div id="top_counter1" class="carousel vert slide" data-ride="carousel" data-interval="2500">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div class="icon"><i class="fa fa-user"></i> </div>
                                                <div class="content">
                                                    <div class="text">Total Patient</div>
                                                    <h5 class="number">215</h5>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div class="icon"><i class="fa fa-user"></i> </div>
                                                <div class="content">
                                                    <div class="text">New Patient</div>
                                                    <h5 class="number">21</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div id="top_counter2" class="carousel vert slide" data-ride="carousel" data-interval="2100">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div class="icon"><i class="fa fa-user-md"></i> </div>
                                                <div class="content">
                                                    <div class="text">Operations</div>
                                                    <h5 class="number">06</h5>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div class="icon"><i class="fa fa-user-md"></i> </div>
                                                <div class="content">
                                                    <div class="text">Surgery</div>
                                                    <h5 class="number">04</h5>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div class="icon"><i class="fa fa-user-md"></i> </div>
                                                <div class="content">
                                                    <div class="text">Treatment</div>
                                                    <h5 class="number">23</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <div class="card top_counter">
                                <div class="body">
                                    <div id="top_counter3" class="carousel vert slide" data-ride="carousel" data-interval="2300">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div class="icon"><i class="fa fa-eye"></i> </div>
                                                <div class="content">
                                                    <div class="text">Total Visitors</div>
                                                    <h5 class="number">10K</h5>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div class="icon"><i class="fa fa-eye"></i> </div>
                                                <div class="content">
                                                    <div class="text">Today Visitors</div>
                                                    <h5 class="number">142</h5>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div class="icon"><i class="fa fa-eye"></i> </div>
                                                <div class="content">
                                                    <div class="text">Month Visitors</div>
                                                    <h5 class="number">2,087</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="icon"><i class="fa fa-university"></i> </div>
                                    <div class="content">
                                        <div class="text">Revenue</div>
                                        <h5 class="number">$18,925</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="card top_counter">
                                <div class="body">
                                    <div class="icon"><i class="fa fa-thumbs-o-up"></i> </div>
                                    <div class="content">
                                        <div class="text">Happy Clients</div>
                                        <h5 class="number">528</h5>
                                    </div>
                                    <hr>
                                    <div class="icon"><i class="fa fa-smile-o"></i> </div>
                                    <div class="content">
                                        <div class="text">Smiley Faces</div>
                                        <h5 class="number">2,528</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                -->
                <div class="col-lg-9 col-md-12">
                    <div class="card">
                        <div class="header">
                            <!-- <h2>Total Revenue</h2>-->
                            <ul class="header-dropdown">
                                <li><a class="tab_btn" href="javascript:void(0);" title="Weekly">W</a></li>
                                <li><a class="tab_btn" href="javascript:void(0);" title="Monthly">M</a></li>
                                <li><a class="tab_btn active" href="javascript:void(0);" title="Yearly">Y</a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <a href="home.php" style="font-size: large">&laquo; Back</a>

                            <h2 class="page-title">Enter Patient's Payment Reference To Proceed</h2>

                            <div class="row">
                                <div class="col-md-6">
                                    <?php
                                    if (is_post()) {
                                        if ($done == TRUE) { ?>
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                        aria-hidden="true">&times;</span></button>
                                                Patient Folder has been created.
                                            </div>
                                        <?php } else  {
                                            ?>
                                            <div class="alert alert-warning alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                        aria-hidden="true">&times;</span></button>
                                                <?php echo $errorMessage; ?>
                                            </div>
                                            <?php
                                        }
                                    } ?>
                                </div>

                                <div class="col-md-6">

                                </div>
                            </div>

                            <form class="form-inline" method="post" action="" >
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="tel" class="form-control" name="auth_code" placeholder="Authorization Code"
                                               required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" data-loading-text="Searching..."> Submit
                                </button>
                            </form>

                            <br/> <br/> <br/> <br/>

                        </div>




                    </div>
                </div>
            </div>





        </div>
    </div>





<?php

require('../layout/footer.php');























