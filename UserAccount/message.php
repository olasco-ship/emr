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

$user = User::find_by_id($session->user_id);









require('../layout/header.php');
?>



<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>User Account</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Messages</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        
                    </div>
                    <div class="body">





                    </div>





                </div>
            </div>
        </div>
    </div>
</div>




<?php

require('../layout/footer.php');
