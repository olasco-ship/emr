<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$message = "";
$done = FALSE;
$errMessage = "";
$first_name = $last_name = $username = $password = $created = $role = "";
$errFirstName = $errLastName = $errUserName = $errPassword = $errCreated = $errRole = $errNhisNumber = "";


/*$my_age = new DateTime('1986-02-01');
$my_age = date_format($my_age, 'Y-m-d');
echo $my_age . "<br/>";

$age = getAge($my_age);
echo $age . "<br/>";
if ($age < 70 ){
    $x = 70 - $age;
    echo $x . "<br/>";
  //  $end = date('Y-m-d', strtotime($x.' years'));
    $end = date('Y-m-d', strtotime($x.' years'));
    echo $end;
}
exit;*/





/*$from = new DateTime('1970-02-01');
$to   = new DateTime('today');
echo $from->diff($to)->y;  exit;*/

if (is_post()) {


    if (empty($_POST['first_name'])) {
        $errFirstName = "First Name is Required";
        $errMessage .= $errFirstName . "<br/>";
    } else {
        $first_name = test_input($_POST['first_name']);
        if (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
            $errFirstName = "Only letters and white space are allowed for First Name";
            $errMessage .= $errFirstName . "<br/>";
        }
    }

    if (empty($_POST['last_name'])) {
        $errLastName = "Last Name is Required";
        $errMessage .= $errLastName . "<br/>";
    } else {
        $last_name = test_input($_POST['last_name']);
        if (!preg_match("/^[a-zA-Z]*$/", $last_name)) {
            $errLastName = "Only letters and white space are allowed for Last Name";
            $errMessage .= $errLastName . "<br/>";
        }
    }

    if (empty($_POST['nhis_number'])) {
        $errNhisNumber = "NHIS Number  is Required";
        $errMessage   .= $errNhisNumber . "<br/>";
    } else {
        $nhis_number = test_input($_POST['nhis_number']);
        $stf = Enrollee::find_by_nhis_number($nhis_number);
        if (isset($stf) && !empty($stf)) {
            $errNhisNumber = "NHIS Number already already exists";
            $errMessage .= $errNhisNumber . "<br/>";
        } else {
            $nhis_number = test_input($_POST['nhis_number']);
        }
    }


    $hmo = test_input($_POST['hmo']);

    $dob = new DateTime($_POST['dob']);
    $dob = date_format($dob, 'Y-m-d');

    $reg_date = new DateTime($_POST['reg_date']);
    $reg_date = date_format($reg_date, 'Y-m-d');
    $image_name = $_POST['image_name'];


/*    $age = getAge($dob);
    echo $age . "<br/>";
    if ($age < 70 ){
        $end = date($dob, strtotime('+70 years'));
        echo $end .' dj';
    }
    exit;*/



    $plan_id = $_POST['plan_id'];

    $plan = NhisPlan::find_by_id($plan_id);


    $valid_days = "";
    switch ($plan->validity_months) {
        case "12":
             $valid_days = " + 365 day";
            break;
        case "6":
             $valid_days = " + 180 day";
            break;
        case "3":
             $valid_days = " + 90 day";
            break;
        case "1":
             $valid_days = " + 30 day";
            break;
        default:
                ;
    }

   // echo "tt"; exit;

    $exp_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($reg_date)) . $valid_days));

    if (empty($_POST['gender'])) {
        $errGender   = "Gender is Required";
        $errMessage .= $errGender . "<br/>";
    } else {
        $gender = test_input($_POST['gender']);
    }


    if (empty($_POST['address'])) {
        $errAddress = "Contact Address is Required";
        $errMessage .= $errAddress . "<br/>";
    } else {
        $address = test_input($_POST['address']);
    }

    if (empty($_POST['phone_number'])) {
        $errPhoneNumber = "Phone Number  is Required";
        $errMessage .= $errPhoneNumber . "<br/>";
    } else {
        $phone_number = test_input($_POST['phone_number']);
    }

    //  echo $reg_date . "<br/>";


    //$exp_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($reg_date)) . " + 365 day"));

    //  echo $newEndingDate . "<br/>";     exit;








    if ((!$errMessage) and (empty($errMessage))) {
        $date_registered   = strftime("%Y-%m-%d %H:%M:%S", time());

        $newEnrollee                  = new Enrollee();
        $newEnrollee->sync            = "off";
        $newEnrollee->first_name      = $first_name;
        $newEnrollee->last_name       = $last_name;
        $newEnrollee->nhis_number     = $nhis_number;
        $newEnrollee->gender          = $gender;
        $newEnrollee->dob             = $dob;
        $newEnrollee->phone_number    = $phone_number;
        $newEnrollee->contact_address = $address;
        $newEnrollee->hmo             = $hmo;
        $newEnrollee->plan_id         = $plan_id;
        $newEnrollee->reg_date        = $reg_date;
        $newEnrollee->exp_date        = $exp_date;
        $newEnrollee->status          = "off";
        $newEnrollee->date            = $date_registered;
        $newEnrollee->fileName        = $image_name;

        // echo   print_r($newEnrollee);  exit;

        if ($newEnrollee->save()) {
            $enrolleeSub              = new EnrolleeSubscription();
            $enrolleeSub->sync        = "off";
            $enrolleeSub->enrollee_id = $newEnrollee->id;
            $enrolleeSub->start_date  = $reg_date;
            $enrolleeSub->end_date    = $exp_date;
            $enrolleeSub->status      = "off";
            $enrolleeSub->date        = $date_registered;
            $enrolleeSub->save();

            $done = TRUE;
            $session->message("New Enrollee has been created.");
            redirect_to('patients.php');
        }


    }

    if ($errMessage) {
        $panelClass = 'panel-danger';
        $panelHeader = '<div class="panel-heading"><h3 class="panel-title">Please correct the errors in the form<br></h3> class=
                          "panel-title alert alert-danger">' . $errMessage . '</h3> </div>';
    }
}






require('../layout/header.php');
?>



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Enrollee Management </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Enrollee Registration </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">

                    <div class="card">
                        <div class="body">

                            <a style="font-size: larger" href="../nhis/home.php">&laquo;Back</a>


                            <form id="basic-form" method="post" action="" enctype="multipart/form-data">

                                <div class="panel-heading">
                                    <?php
                                    if (is_post()) {
                                        if ($done == TRUE) { ?>
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                Patient Folder has been created.
                                            </div>
                                        <?php   } else if (empty($errMessage) == FALSE and isset($errMessage)) {
                                            ?>
                                            <div class="alert alert-warning alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <?php echo $errMessage; ?>
                                            </div>
                                            <?php
                                        }
                                    }  ?>


                                </div>




                                <div class="panel-content">
                                    <h2 class="heading" style="text-align: center"> Add New Enrollee </h2>

                                    <div class="form-group">
                                        <!-- <label>First Name</label>-->
                                        <input type="text" class="form-control" placeholder="First Name" name="first_name" value="<?php echo $first_name ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <!--<label>Last Name</label>-->
                                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="<?php echo $last_name ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <!-- <label>Folder Number</label>-->
                                        <input type="text" class="form-control" placeholder="NHIS Number" id="nhis_number" name="nhis_number" value="<?php echo $nhis_number ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <!-- <label>Folder Number</label>-->
                                        <input type="text" class="form-control" placeholder="HMO" name="hmo" value="<?php echo $hmo ?>" >
                                    </div>

                                    <div class="form-group">
                                        <!-- <label>Date Of Birth</label>-->
                                        <input type="text" class="form-control" placeholder="Registration Date" name="reg_date" id="reg_date" value="<?php echo $reg_date ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <select class="form-control"  id="plan_name" name="plan_id" required>
                                            <option value="">--Select Plan Name--</option>
                                            <?php
                                            $plans = NhisPlan::find_all();
                                            foreach ($plans as $plan){
                                                ?>
                                                <option value="<?php echo $plan->id; ?>"><?php echo $plan->plan_name?></option>
                                              <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!--
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Expiry Date" name="exp_date" id="exp_date" value="<?php echo $exp_date ?>" required>
                                            </div>
                                            -->

                                    <div class="form-group">
                                        <!--  <label class="control-label">Gender</label>-->
                                        <select class="form-control" name="gender" required>
                                            <option value="">--Gender--</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <!-- <label>Date Of Birth</label>-->
                                        <input type="text" class="form-control" placeholder="Date Of Birth" name="dob" id="dob" value="<?php echo $dob ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <!--<label>Contact Address</label>-->
                                        <textarea class="form-control" placeholder="Contact Address" name="address" rows="2" cols="10" required><?php echo $address ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <!--   <label>Phone Number</label>-->
                                        <input type="text" class="form-control" placeholder="Phone Number" name="phone_number" required value="<?php echo $phone_number ?>">
                                    </div>

                                    <br />

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="cell">
                                                <video id="player" autoplay></video>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="cell">
                                                <canvas id="canvas" width="320px" height="240px"></canvas>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="button" class="btn btn-primary" id="capture-btn">Capture</button>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="layout">
                                                <!--                                                <div id="newImages"></div>-->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="hidden" id="image_name" name="image_name">
                                        </div>
                                        <div class="col-sm-4">
                                            <div id="pick-image">
                                                <label>Video is not supported. Pick an Image instead</label>
                                                <input type="file" accept="image/*" id="image-picker">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-primary">Save Record</button>
                                        </div>
                                    </div>

                                    <br>

                                </div>





                            </form>


                        </div>


                    </div>


                </div>


            </div>


        </div>


    </div>
























<?php

require('../layout/footer.php');

?>

<style>
    #newImages {
        height: 300px;
        position: relative;
        width: 100%;
        text-align: center;
        margin-right: auto;
        margin-left: -150px;
    }
    img.masked {
        position: absolute;
        background-color: #fff;
        border: 1px solid #babbbd;
        padding: 10px;
        box-shadow: 1px 1px 1px #babbbd;
        margin: 10px auto 0;
    }
    #player {
        width: 320px;
        height: 240px;
        margin: 10px auto;
        border: 1px solid #babbbd;
    }
    canvas {
        width: 320px;
        height: 240px;
        margin: 10px auto;
        border: 1px solid #babbbd;
    }
    #capture-btn {
        width: 130px;
        margin: 0 auto;
    }
    #pick-image {
        display: none;
        text-align: center;
        padding-top: 30px;
    }
</style>
