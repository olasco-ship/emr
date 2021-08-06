<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 1:52 PM
 */



require_once("../includes/initialize.php");

$diagnosis = NursingDiagnosis::find_by_id($_GET['id']); //  print_r($finds);  exit;
$finds = NursingClassification::find_all();


if(is_post()){
    if ($_POST['name']) {
        if (empty($_POST['name'])) {
            $errorName= "Diagnosis is Required";
            $errorMessage .= $errorName . "<br/>";
        } else {
            $name = test_input($_POST['name']);
        }
    }

    if (empty($_POST['nursingClassification_id'])) {
        $errorRevenue  = "Classification is Required";
        $errorMessage .= $errorRevenue . "<br/>";
    } else {
        $nursingClassification_id = test_input($_POST['nursingClassification_id']);
    }

    //$nursingClassification_id = test_input($_POST['nursingClassification_id']);

    $diagnosis->sync             = "off";
    $diagnosis->name             = $name;
    $diagnosis->nursingClassification_id = $nursingClassification_id;
    $diagnosis->date        = strftime("%Y-%m-%d %H:%M:%S", time());
    if ($diagnosis->delete()){
        $session->message("A  Nursing Diagnosis  has been updated.");
        redirect_to('diagnosis.php');
    } else {
        $session->message("Could not update the Nursing Diagnosis .");

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
                            <li class="breadcrumb-item"> Nursing Process </li>

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
                                                <a href="../nursingProcess/diagnosis.php" style="font-size: large">&laquo; Back</a>
                                                <h6>Delete Diagnosis</h6>
                                                <div class="form-group">
                                                    <form id="basic-form" action="" method="post">
                                                        <div class="form-group">
                                                            <input class="form-control" name="name"
                                                                   placeholder="Classification" style="width: 300px"
                                                                   type="text" value="<?php echo $diagnosis->name; ?>" required >

                                                        </div>

                                                        <div class="form-group">
                                                            <?php
                                                            $finds = NursingClassification::find_all();
                                                            foreach ($finds as $find)
                                                            ?>
                                                            <input type="text" class="form-control" style="width: 350px"
                                                                   name="name" placeholder="Domain Name"
                                                                   value="<?php echo $find->name ?>" required>

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

