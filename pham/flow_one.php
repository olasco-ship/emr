<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 5/18/2019
 * Time: 1:41 PM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);



if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $array = PatientBill::get_bill();
    // file_put_contents("dispense_array.json", json_encode($array));
    // PatientBill::clear_all_bill();
    redirect_to("flow_two.php");
}


PatientBill::clear_all_bill();


require('../layout/header.php');
?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                            Storage </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Assign Drugs</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">

                <div class="col-lg-12 col-md-12">
                    <div class="card">

                        <div class="body">
                            <div class="row clearfix">

                                <div class="col-sm-12">
                                    <a style="font-size: large" href="storage.php">Back</a>
                                    <h5> Name Of Drugs </h5>

                                    <div class="form-group">
                                        <form class="form-inline" id="flowSearch">
                                            <input type="text" placeholder="Name Of Drug" name="txtProduct" id="txtProduct" autocomplete="off" class="typeahead" />
                                            <br /><br />
                                            <button type="submit" id="submit" class="btn btn-lg btn-info" data-loading-text="Searching...">Search
                                            </button>
                                        </form>
                                    </div>

                                </div>

                            </div>

                            <div class="row clearfix">


                                <div class="col-sm-12" id="flow_one">

                                    <?php //   echo PatientBill::storage_page();
                                    ?>


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
