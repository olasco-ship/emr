<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 1:52 PM
 */



require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$message = "";

$diagnosis = NursingDiagnosis::find_by_id($_GET['id']); //  print_r($finds);  exit;



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

    if ($diagnosis->save()){
        $session->message("A  Nursing Diagnosis  has been updated.");
        redirect_to('diagnosis.php');
    } else {
        $session->message("Could not update the Nursing Diagnosis .");

    }

    if ($errorMessage) {
        $panelClass = 'panel-danger';
        $panelHeader = '<div class="panel-heading"><h3 class="panel-title">Please correct the errors in the form<br></h3> class=
                          "panel-title alert alert-danger">' . $errorMessage . '</h3> </div>';
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
                                                <h6>Edit Diagnosis</h6>
                                                <div class="form-group">
                                                    <form id="basic-form" action="" method="post">
                                                        <div class="form-group">
                                                            <select class="form-control" style="width: 350px" id="nursingClassification_id" name="nursingClassification_id">
                                                                <option value="">--Select Classification--</option>
                                                                <?php
                                                                $finds = NursingClassification::find_all();
                                                                foreach ($finds as $find) {
                                                                    ?>
                                                                    <option <?php echo $find->id == $diagnosis->nursingClassification_id ? 'selected' : ' '; ?>
                                                                        value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>

                                                        </div>

                                                        <div class="form-group">
                                                            <input class="form-control" name="name"
                                                                   placeholder="Classification" style="width: 300px"
                                                                   type="text" value="<?php echo $diagnosis->name; ?>" required >
                                                        </div>

                                                        <br>
                                                        <button type="submit" class="btn btn-primary">Save</button>
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
