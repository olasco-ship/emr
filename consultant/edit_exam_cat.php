<?php
require_once ('../includes/initialize.php');


if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

$findPlan = ExaminationCategory::find_by_id($_GET['id']);

$message = "";

if (is_post()){

    if ($_POST['exam_cat']){

        if (empty($_POST['exam_cat'])){

            $errorName = "Examination Category is required";
            $errorMessage .= $errorName . "</br>";
        } else {
            $exam_cat = test_input($_POST['exam_cat']);
        }
    }

    if ((!$errorMessage) and empty($errorMessage)){


        $update_exam_cat = ExaminationCategory::find_by_id($_GET['id']);
        $update_exam_cat->name = $exam_cat;

        if ($update_exam_cat->save()){

            $done = TRUE;
            $session->message("An examination category has been updated");
            redirect_to('examination_category.php');
        } else {
            $done = FALSE;
            $session->message("Couldn't update an examination category");
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a> GP CONSULTATION </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Examination Category</li>

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

                                        <a href="examination_category.php" style="font-size: large">&laquo; Back</a>

                                        <h5> Update Examination Category </h5>
                                        <br/>
                                        <form action="" method="post">

                                            <div class="input-group">
                                                <input class="form-control" name="exam_cat" required
                                                       placeholder="CATEGORY"
                                                       value="<?php echo $findPlan->name ?>"
                                                       style="width: 100px" type="text">
                                            </div>

                                            <div>
                                                <button type="submit" class="btn btn-primary">Update Category
                                                </button>
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
