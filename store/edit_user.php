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

$usr = User::find_by_id($_GET['id']);

$user = User::find_by_id($session->user_id);



define("nl", "<br>");
$errMessage = '';
$password = $confirmPassword = '';
$errPassword = $errConfirmPassword = '';
$done = FALSE;


if ($_SERVER["REQUEST_METHOD"] == "POST" && $usr) {
    if (empty($_POST['first_name'])) {
        $errFirstName = "First Name is Required";
        $errMessage .= $errFirstName . "<br/>";
    } else {
        $usr->first_name = test_input($_POST['first_name']);
        if (!preg_match("/^[a-zA-Z]*$/", $usr->first_name)) {
            $errFirstName = "Only letters and white space are allowed for First Name";
            $errMessage .= $errFirstName . "<br/>";
        }
    }


    if (empty($_POST['last_name'])) {
        $errLastName = "Last Name is Required";
        $errMessage .= $errLastName . "<br/>";
    } else {
        $usr->last_name = test_input($_POST['last_name']);
        if (!preg_match("/^[a-zA-Z]*$/", $usr->last_name)) {
            $errLastName = "Only letters and white space are allowed for Last Name";
            $errMessage .= $errLastName . "<br/>";
        }
    }

    if (empty($_POST['username'])) {
        $errUserName = "User Name  is Required";
        $errMessage .= $errUserName . "<br/>";
    } else {
        $usr->username = test_input($_POST['username']);
        $stf = User::find_by_username_except_current_id($usr->username, $usr->id);

        if (isset($stf) && !empty($stf)) {
            $errUserName = "User Name already exists";
            $errMessage .= $errUserName . "<br/>";
        } else {
            if (!preg_match("/^[a-zA-Z]*$/", $usr->username)) {
                $errUserName = "Only letters and white space are allowed for User Name";
                $errMessage .= $errUserName . "<br/>";
            }
        }
    }

  //  $usr->department = test_input($_POST['department']);

    $usr->role       = test_input($_POST['role']);

    $usr->unit       = test_input($_POST['unit']);

    // echo $staff->last_name; exit;

    if ((!$errMessage) and (empty($errMessage))) {
        if ($usr->save()){
            $done = TRUE;
            $session->message("User Information has been updated.");
            redirect_to('user.php');
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>User Account</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">My Profile</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="body">


                            <div class="tab-pane" id="modify">

                                <form id="basic-form" method="post" action="">
                                    <div class="card">

                                        <div class="body">
                                            <h5><a style="..." href="user.php"> << Back </a></h5>
                                            <div class="row clearfix">

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input type="text" class="form-control" name="first_name" value="<?php echo $usr->first_name ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="text" class="form-control" name="last_name" value="<?php echo $usr->last_name ?>" required>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row clearfix">

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>User Name</label>
                                                        <input type="text" class="form-control" name="username" value="<?php echo $usr->username ?>" required>
                                                    </div>
                                                </div>
<!--                                                <div class="col-sm-6">-->
<!--                                                    <div class="form-group">-->
<!--                                                        <label>Unit</label>-->
<!--                                                        <select class="form-control"  name="unit">-->
<!--                                                            <option value=""></option>-->
<!--                                                            <option --><?php //echo ($usr->unit == 'Storage') ? 'selected ="TRUE"' : ''; ?>
<!--                                                                    value="Storage">Storage-->
<!--                                                            </option>-->
<!--                                                            --><?php
//                                                            $finds = PharmacyStation::find_all();
//                                                            foreach ($finds as $find){
//                                                                ?>
<!--                                                                <option --><?php //echo ($usr->unit == $find->name) ? 'selected ="TRUE"' : ''; ?>
<!--                                                                        value="--><?php //echo $find->name ?><!--"> --><?php //echo $find->name ?>
<!--                                                                </option>-->
<!--                                                            --><?php //} ?>
<!--                                                        </select>-->
<!--                                                    </div>-->
<!--                                                </div>-->

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>User Role</label>
                                                        <select class="form-control"  name="role">
                                                            <option value=""></option>
                                                            <option <?php echo ($usr->role == 'User') ? 'selected ="TRUE"' : ''; ?>
                                                                    value="User">User
                                                            </option>
                                                            <option <?php echo ($usr->role == 'admin') ? 'selected ="TRUE"' : ''; ?>
                                                                    value="admin">admin
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row clearfix">


                                                <div class="col-sm-6">
                                                    <!--        <div class="form-group">
                                                        <label>Department </label>
                                                        <input type="text" class="form-control" name="department" value="<?php /*echo $usr->department */?>" required>
                                                    </div>-->
                                                </div>
                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <button type="submit" name="update_patient_record" class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">

                                                </div>
                                                <div class="col-sm-4">

                                                </div>

                                            </div>

                                        </div>




                                    </div>
                                </form>

                            </div>



                        </div>





                    </div>
                </div>
            </div>
        </div>
    </div>




<?php

require('../layout/footer.php');
