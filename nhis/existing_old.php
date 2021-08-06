<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 3/31/2019
 * Time: 11:33 PM
 */

require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


$user = User::find_by_id($session->user_id);






if (is_post()) {


    if (isset($_POST['subscribe'])) {

        $enrollee_id  = test_input($_POST['enrollee_id']);


        $reg_date = new DateTime($_POST['reg_date']);
        $reg_date = date_format($reg_date, 'Y-m-d');
    
        $exp_date = new DateTime($_POST['exp_date']);
        $exp_date = date_format($exp_date, 'Y-m-d');

        $enrollee           = Enrollee::find_by_id($enrollee_id);
        $enrollee->reg_date = $reg_date;
        $enrollee->exp_date = $exp_date;

     //   print_r($enrollee);     //  exit;

        if ($enrollee->save()){
            $newSub              = new EnrolleeSubscription();
            $newSub->sync        = "off";
            $newSub->enrollee_id = $enrollee->id;
            $newSub->start_date  = $reg_date;
            $newSub->end_date    = $exp_date;
            $newSub->status      = "off";
            $newSub->date        = strftime("%Y-%m-%d %H:%M:%S", time());

        //    print_r($newSub);   exit;

            $newSub->save();

            $done = TRUE;
            $session->message("Subscription has been renewed.");
            redirect_to('patients.php');
        }
        


    }
}





require('../layout/header.php');
?>






<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
        
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> NHIS</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active"> New Subscription </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">

            <div class="col-lg-12 col-md-12">
                <div class="card">

                    <div class="body">


                        <div class="row">
                            <div class="col-md-5">


                                <form method="post" action="">
                                    <div class="form-group">
                                        <label>Enter NHIS Number to fetch enrollee's information</label>
                                        <input type="text" class="form-control" id="nhis_number" name="nhis_number" placeholder="NHIS Number" required>
                                        <br />
                                        <button type="submit" name="search_record" class="btn btn-primary" data-loading-text="Searching...">Search Record
                                        </button>
                                    </div>
                                </form>

                            </div>
                            <div class="col-md-7">




                                <?php
                                if (is_post() and (isset($_POST['search_record']))) {

                                    $nhis_number = $_POST['nhis_number'];

                                    $enrollee = Enrollee::find_by_nhis_number($nhis_number);



                                    if (empty($enrollee)) {  ?>
                                        <div class="col-md-7">
                                            <div class="alert alert-warning alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                NHIS Number Not Found In Database
                                            </div>
                                        </div>

                                    <?php } else {
                                        //  $patient = Patient::find_by_tracking_no($tracking_no);   
                                    ?>

                                        <form action="" method="post">

                                            <div class="form-group">
                                                <label>Enrollee Name</label>
                                                <input type="text" class="form-control" name="first_name" value="<?php echo $enrollee->full_name() ?>" required readonly>
                                                <input type="text" class="form-control" name="enrollee_id" value="<?php echo $enrollee->id ?>" hidden>
                                            </div>


                                            <div class="form-group">
                                                <label>NHIS Number </label>
                                                <input type="text" class="form-control" name="nhis_number" value="<?php echo $enrollee->nhis_number ?>" required readonly>
                                            </div>

                                            <div class="form-group">
                                                <label>Current Subcription Start Date </label>
                                                <input type="text" class="form-control" value="<?php echo date('d/m/Y', strtotime($enrollee->reg_date)) ?>" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label> Current Subcription End Date</label>
                                                <input type="text" class="form-control" value="<?php echo date('d/m/Y', strtotime($enrollee->exp_date)) ?>" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label>New Start Date </label>
                                                <input type="text" class="form-control" placeholder="Registration Date" name="reg_date" id="reg_date" value="<?php echo $reg_date ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label>New End Date</label>
                                                <input type="text" class="form-control" placeholder="Expiry Date" name="exp_date" id="exp_date" value="<?php echo $exp_date ?>" required>
                                            </div>


                                            <br />
                                            <button type="submit" name="subscribe" class="btn btn-success">Renew Subscription</button>
                                        </form>



                                <?php }
                                } ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>



        </div>
    </div>






























    <?php

    require('../layout/footer.php');
