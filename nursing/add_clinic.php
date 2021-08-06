<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}
//$find = User::find_by_id($_GET['id']);  print_r($find);  exit;


$message = "";
$done = FALSE;
$errMessage = "";
$first_name = $last_name = $username = $password = $created = $role = "";
$errFirstName = $errLastName = $errUserName = $errPassword = $errCreated = $errRole = "";


if (is_post()) {


    if (isset($_POST['add_clinic'])){

        $user_id = test_input($_POST['user_id']);
        $user = UserMultiWards::find_by_usr_id($user_id);
        if(!empty($user)){
            $user->delete();
            $user->save();
        }
        $clinic_id = test_input($_POST['clinic_id']);
        $sub_clinic_id = test_input($_POST['sub_clinic_id']);
        $nurse                = User::find_by_id($user_id);
        $nurse->sub_clinic_id = $sub_clinic_id;
        $nurse->ward_id       = 0;
        $nurse->save();
        redirect_to("officers.php");
      //  echo "clinic";  exit;
    }

    if (isset($_POST['add_ward'])){
        $user_id = test_input($_POST['user_id']);
        $ward_id = test_input($_POST['ward_id']);
        $ward_status = 0;
        if (!empty($ward_id)) {
            $ward_status = 1;
        } else {
            $ward_status = 0;
        }
        $ward_name = test_input($_POST['ward_name']);
        $user = UserMultiWards::find_by_usr_id($user_id);
        $nurse                = User::find_by_id($user_id);
        if(empty($user)){
            $userMultiWard            = new UserMultiWards();
            $userMultiWard->user_id   = $user_id;
            $userMultiWard->ward_id   = $ward_id;
            $userMultiWard->ward_name = $ward_name;
            $userMultiWard->date      = date("Y-m-d H:i:S");
            $userMultiWard->create();

            $nurse->sub_clinic_id = $sub_clinic_id;
            $nurse->ward_id       = 1;
            $nurse->save();
            redirect_to("officers.php");
        }else {
          //  print_r($user);  exit;
            /*$uS = UserMultiWards::find_by_user_id($user->user_id);
         //   echo $ward_name . "<br/>";
         //   echo $ward_id . "<br/>";
            $uS->ward_id     = $ward_id;
            $uS->ward_name   = $ward_name;
            $uS->ward_status = $ward_status;
            $uS->save();*/

            $user->ward_id  = $ward_id;
            $user->ward_name  = $ward_name;
//            $user->ward_status  = $ward_status;
            $user->save();

            $nurse->sub_clinic_id = $sub_clinic_id;
            $nurse->ward_id       = 1;
            $nurse->save();
            redirect_to("officers.php");
        }
    }

/*    $user_id = test_input($_POST['user_id']);

    $clinic_id = test_input($_POST['clinic_id']);
    $ward_id = test_input($_POST['ward_id']);
    $ward_status = 0;
    if (!empty($ward_id)) {
        $ward_status = 1;
    } else {
        $ward_status = 0;
    }
    $ward_name = test_input($_POST['ward_name']);

    $sub_clinic_id = test_input($_POST['sub_clinic_id']);

    $nurse                = User::find_by_id($user_id);
    $nurse->sub_clinic_id = $sub_clinic_id;
    $nurse->ward_id       = $ward_status;
    $nurse->save();


    $userMultiWard = new UserMultiWards();
    $userMultiWard->user_id = $user_id;
    $userMultiWard->ward_id = $ward_id;
    $userMultiWard->ward_name = $ward_name;
    $userMultiWard->date = date("Y-m-d H:i:S");
    $userMultiWard->create();
    redirect_to("officers.php");
*/

}





require('../layout/header.php');

?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Nursing Administration </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo emr_lucid ?>/home.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Nurses</li>
                    </ul>
                </div>

            </div>
        </div>

        <a href="officers.php" style="font-size: large">&laquo; Back</a>
        <div class="row clearfix">

            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h2> Add Nurse To Clinic </h2>
                    </div>

                    <div class="body">
                        <form id="basic-form" action="" method="post" novalidate>


                            <div class="form-group">
                                <label>Nursing Staff</label>
                                <select class="form-control" id="user_id" name="user_id" required>
                                    <?php
                                    $find = User::find_by_id($_GET['id']);
                                    ?>
                                    <option value="<?php echo $find->id; ?>"><?php echo $find->full_name(); ?></option>

                                </select>
                            </div>

                            <!--
                            <div class="form-group">
                                <label>Ward</label>
                                <select class="form-control" id="ward_id" name="ward_id">
                                    <option value="">--Select Ward--</option>
                                    <?php
                                    /*   $wards = Wards::find_all();
                                    foreach ($wards as $ward) {
                                    ?>
                                        <option value="<?php echo $ward->id; ?>"><?php echo $ward->ward_number; ?></option>
                                    <?php
                                    }  */
                                    ?>
                                </select>
                                <input type="hidden" name="ward_name" id="ward_name" />
                            </div>
                            -->
                            <div class="form-group">
                                <label>Hospital Clinic</label>
                                <select class="form-control" id="clinic_id" name="clinic_id" required>
                                    <option value="">--Select Clinic--</option>
                                    <?php
                                    $finds = Clinic::find_all();
                                    foreach ($finds as $find) {
                                    ?>
                                        <option value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Sub-Clinic</label>
                                <div id="sub_clinic_id">

                                </div>
                            </div>



                            <br />
                            <button type="submit" name="add_clinic" class="btn btn-primary"> Add To Clinic </button>

                        </form>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h2> Add Nurse to Ward </h2>
                    </div>

                    <div class="body">
                        <form id="basic-form" action="" method="post" novalidate>


                            <div class="form-group">
                                <label>Nursing Staff</label>
                                <select class="form-control" id="user_id" name="user_id" required>
                                    <?php
                                    $find = User::find_by_id($_GET['id']);
                                    ?>
                                    <option value="<?php echo $find->id; ?>"><?php echo $find->full_name(); ?></option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Ward</label>
                                <select class="form-control" id="ward_id" name="ward_id">
                                    <option value="">--Select Ward--</option>
                                    <?php
                                    $wards = Wards::find_all();
                                    foreach ($wards as $ward) {
                                    ?>
                                        <option value="<?php echo $ward->id; ?>"><?php echo $ward->ward_number; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="ward_name" id="ward_name" />
                            </div>

                            <!--
                            <div class="form-group">
                                <label>Hospital Clinic</label>
                                <select class="form-control" id="clinic_id" name="clinic_id" required>
                                    <option value="">--Select Clinic--</option>
                                    <?php
                                    /*  $finds = Clinic::find_all();
                                    foreach ($finds as $find) {
                                    ?>
                                        <option value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                    <?php
                                    } */
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Sub-Clinic</label>
                                <div id="sub_clinic_id">

                                </div>
                            </div>
                            -->



                            <br />
                            <button type="submit" name="add_ward"  class="btn btn-primary"> Add To Ward </button>

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
<script>
    $(document).ready(function() {

        $("#ward_id").change(function() {
            $("#ward_name").val($(this).children("option:selected").html());
            if ($(this).val() != "") {
                $("#clinic_id").attr("disabled", true);
            } else {
                $("#clinic_id").removeAttr("disabled");
            }
        });



    });
</script>