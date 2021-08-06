<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/17/2019
 * Time: 4:43 PM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$result = Result::find_by_id($_GET['id']);
$patient = Patient::find_by_id($result->patient_id);
$user = User::find_by_id($session->user_id);

if (is_post()) {

    if (isset($_POST['send_result'])) {

        $result->sync               = "off";
        $result->qc_officer         = $user->full_name();
        $result->qc                 = $_POST['qc_comment'];
        $result->qc_date            = strftime("%Y-%m-%d %H:%M:%S", time());
        $result->save();
        $session->message("Result has been sent to doctor.");
        redirect_to('results.php');
    }
}




require('../layout/header.php');
?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        Laboratory Results </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Laboratory</li>
                        <li class="breadcrumb-item active">Forms</li>
                    </ul>
                </div>

            </div>
        </div>



        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">

                    <div class="body">
                        <div class="container">

                            <a href="../lab/qc_check.php">Back</a>

                            <?php include("../labResults/histo.php");
                                  // include("../labResults/histo_res.php");
                            ?>

                            <form action="" method="post">
                                <table class="table table-bordered">
                                    <!--
                                    <tr>
                                        <td> Quality Control Comment </td>
                                        <td colspan='3'> <textarea class='form-control' name='qc_comment' col='80' row='100'> <?php echo $qc_comment ?> </textarea></td>
                                    </tr>
                                    -->
                                    <tr>
                                        <td> <b> MICROSCOPY </b> </td>
                                        <td colspan='3'> <textarea class='form-control' name='qc_comment' col='80' row='100'> <?php echo $qc_comment ?> </textarea></td>
                                    </tr>
                                    <tr>
                                    <td> <b> DIAGNOSIS </b> </td>
                                        <td colspan='3'> <textarea class='form-control' name='qc_comment' col='80' row='100'> <?php echo $qc_comment ?> </textarea></td>
                                    </tr>
                                </table>
                                <p class="margin-top-30">
                                    <button type="submit" name="send_result" class="btn btn-lg btn-primary"> Send Result To Doctor </button> &nbsp;&nbsp;

                                </p>
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
