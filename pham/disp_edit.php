<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/2/2019
 * Time: 11:40 AM
 */

require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


$station = PharmacyStation::find_by_id($_GET['id']);



if(is_post()){
    if ($_POST['name']) {
        if (empty($_POST['name'])) {
            $errorName= "Brand Name is Required";
            $errorMessage .= $errorName . "<br/>";
        } else {
            $name = test_input($_POST['name']);
        }
    }

    $station->sync = "off";
    $station->name = $_POST['name'];  // echo $station->name; exit;
    $station->save();   
    $session->message(" Dispensary has been updated.");
    redirect_to('station.php');

}




require('../layout/header.php');
?>






    <div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        Dispensary Pharmacy</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo emr_lucid ?>/pham/storage.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Pharmacy</li>
                        <li class="breadcrumb-item active">Dispensary</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                    </div>
                    <div class="body">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">                         
                                <div class="body">
                                <a href="station.php">Back</a>                  
                                
                                      
                                        <div class="tab-pane" id="Profile-new">
                                            <h4 class="heading"> Update <?php echo $station->name ?></h4>
                                            <form action="" method="post">

                                               
                                                    <div class="input-group">
                                                        <input class="form-control" name="name" style="width: 300px" value="<?php echo $station->name ?>" placeholder="Dispensary Name" 
                                                               type="text" required >
                                                        <button type="submit" class="btn btn-primary"> Update </button>
                                                    </div>
                                                
                                            </form>
                                        </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>























<?php

require('../layout/footer.php');