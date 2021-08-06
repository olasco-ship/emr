<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 1:52 PM
 */



require_once("../includes/initialize.php");

$errorMessage = "";

$subClinic = SubClinic::find_by_id($_GET['id']); //  print_r($finds);  exit;


if(is_post()){
    if ($_POST['name']) {
        if (empty($_POST['name'])) {
            $errorName= "Sub Clinic is Required";
            $errorMessage .= $errorName . "<br/>";
        } else {
            $name = test_input($_POST['name']);
        }
    }

    /*if ($_POST['clinic_id']) {
        if (empty($_POST['clinic_id'])) {
            $errorName= "Clinic id is Required";
            $errorMessage .= $errorName . "<br/>";
        } else {
            $clinic_id = test_input($_POST['clinic_id']);
        }
    }*/

    $clinic_id = test_input($_POST['clinic_id']);

    $subClinic->sync             = "off";
    $subClinic->name             = $name;
    $subClinic->clinic_id = $clinic_id;
    $subClinic->date        = strftime("%Y-%m-%d %H:%M:%S", time());
    if ($subClinic->delete()){
        $session->message("Clinic and Sub-Clinic  has been deleted.");
        redirect_to('sub.php');
    } else {
        $session->message("Could not delete the Sub-Clinic .");

    }

}




require('../layout/header.php');
?>



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Nursing Department</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item"> Clinics </li>

                        </ul>
                    </div>

                </div>
            </div>



            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">

                        <div class="body">


                            <div class="col-lg-12 col-md-12">
                                <div class="card">

                                    <div class="body">

                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="Home-new">
                                                <a href="sub.php" style="font-size: large">&laquo; Back</a>
                                                <h6>Delete Sub Clinic</h6>
                                                <div class="form-group">
                                                    <form id="basic-form" action="" method="post">
                                                        <div class="form-group">
                                                            <select class="form-control" style="width: 350px" id="clinic_id" name="clinic_id">
                                                                <option value="">--Select Clinic</option>
                                                                <?php
                                                                $finds = Clinic::find_all();
                                                                foreach ($finds as $find) {
                                                                    ?>
                                                                    <option <?php echo $find->id == $subClinic->clinic_id ? 'selected' : ' '; ?>
                                                                        value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            &nbsp;
                                                            <input class="form-control" name="name"
                                                                   placeholder="Classification" style="width: 300px"
                                                                   type="text" value="<?php echo $subClinic->name; ?>" required >

                                                        </div>


                                                        <br>
                                                        <button type="submit" class="btn btn-primary">Delete</button>
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
            </div>
        </div>
    </div>






<?php
require('../layout/footer.php');
