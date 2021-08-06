<?php
require_once ('../includes/initialize.php');


if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

$findPlan = Complain::find_by_id($_GET['id']);

$message = "";

if (is_post()){

    if ($_POST['complain']){

        if (empty($_POST['complain'])){

            $errorName = "Complain is required";
            $errorMessage .= $errorName . "</br>";
        } else {
            $complain = test_input($_POST['complain']);
        }
    }

    if ((!$errorMessage) and empty($errorMessage)){


        $delete_complain = Complain::find_by_id($_GET['id']);
        $delete_complain->name = $complain;

        if ($delete_complain->delete()){

            $done = TRUE;
            $session->message("A complain has been deleted");
            redirect_to('complain.php');
        } else {
            $done = FALSE;
            $session->message("Couldn't delete a complain");
            redirect_to('complain.php');
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
                            <li class="breadcrumb-item">Complain</li>

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

                                        <a href="complain.php" style="font-size: large">&laquo; Back</a>

                                        <h5> Update Complain </h5>
                                        <br/>
                                        <form action="" method="post">

                                            <div class="input-group">
                                                <input class="form-control" name="complain" required
                                                       placeholder="COMPLAIN"
                                                       value="<?php echo $findPlan->name ?>"
                                                       style="width: 100px" type="text">
                                            </div>

                                            <div>
                                                <button type="submit" class="btn btn-primary">Delete Complain
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
