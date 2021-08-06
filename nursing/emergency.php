<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/1/2019
 * Time: 12:18 PM
 */


require_once("../includes/initialize.php");
if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

$emergency = Emergency::find_by_id($_GET['id']);



$message = "";
$done = FALSE;
$errMessage = "";
$first_name = $last_name = $username = $password = $created = $role = "";
$errFirstName = $errLastName = $errUserName = $errPassword = $errCreated = $errRole = "";


if (is_post()) {

    if (isset($_POST['save_vitals'])) {
        $pressure    = test_input($_POST['pressure']);
        $temperature = test_input($_POST['temperature']);
        $weight      = test_input($_POST['weight']);
        $height      = test_input($_POST['height']);
        $respiration = test_input($_POST['respiration']);
        $heart_rate  = test_input($_POST['heart_rate']);
        $pain        = test_input($_POST['pain']);
        $urinalysis  = test_input($_POST['urinalysis']);
        $rbs         = test_input($_POST['rbs']);
        $comment     = test_input($_POST['comment']);


        $clinic_id = test_input($_POST['clinic_id']);
        $json = "";

        //   echo $clinic_id; exit;

        if (isset($clinic_id)) {
            $clinic = Clinic::find_by_id($clinic_id);
            $clinic->name;

            switch ($clinic->name) {
                case "MOPD":
                    $foo = new StdClass();
                    $foo->HeadCircumference = test_input($_POST['head_cir']);
                    $foo->ArmCircumference = test_input($_POST['arm_cir']);
                    $foo->AbdominalGirth = test_input($_POST['abd_girth']);
                    $foo->Waist = test_input($_POST['waist']);
                    $foo->HipMeasurement = test_input($_POST['hip_measure']);
                    $foo->ChestCircumference = test_input($_POST['chest_cir']);
                    $foo->Hemodialysis = test_input($_POST['hd']);
                    $foo->Hemodiafiltrion = test_input($_POST['hdf']);
                    $foo->SeizureChart = test_input($_POST['seizure']);
                    $foo->SuicideMonitoringChart = test_input($_POST['suicide']);

                    $json = json_encode($foo);
                    //  echo $json; exit;
                    break;
                case "FAMILY PLANNING":
                    $foo = new StdClass();
                    $foo->UterineDepth = test_input($_POST['uterine_depth']);
                    $foo->CervicalAppearance = test_input($_POST['cerv_app']);

                    $json = json_encode($foo);
                    //  echo $json; exit;
                    break;
                case "OPHTHALMOLOGY":
                    $foo = new StdClass();
                    $foo->VisualAcuity = test_input($_POST['visual_acuity']);
                    $foo->Endoscopy = test_input($_POST['endoscopy']);
                    $foo->IntraocularPressure = test_input($_POST['intra_pressure']);
                    $foo->InstillationChart = test_input($_POST['instil']);

                    $json = json_encode($foo);
                    // echo $json; exit;
                    break;
                case "ENT":
                    $foo = new StdClass();
                    $foo->Audiometry = test_input($_POST['audio']);
                    $foo->Tympanometry = test_input($_POST['tympa']);

                    $json = json_encode($foo);
                    //  echo $json; exit;
                    break;
                case "ANTENATAL &amp; POS-NATAL":
                    $foo = new StdClass();
                    $foo->EstimatedGestationalAge = test_input($_POST['estimated']);
                    $foo->FundalHeight = test_input($_POST['fundal']);
                    $foo->PelvicPalpation = test_input($_POST['pelvic']);
                    $foo->FetalHeartRate = test_input($_POST['fetal_heart']);
                    $foo->FetalAndLieAndPosition = test_input($_POST['fetal_lie']);
                    $foo->Presentation = test_input($_POST['presentation']);

                    $json = json_encode($foo);
                    // echo $json; exit;
                    break;
                default:
                    echo "";
            }
        }

        //   echo $json; exit;

        if ((!$errMessage) and (empty($errMessage))) {
            $vitals                  = new Vitals();
            $vitals->nurse           = $user->full_name();   // current user
            $vitals->patient_id      = $patient->id;
            $vitals->sub_clinic_id   = 0;
            $vitals->waiting_list_id = 0;
            $vitals->ref_adm_id      = 0;
            $vitals->emergency_id    = $emergency->id;
            $vitals->ward_id         = 0;
            $vitals->temperature     = $temperature;
            $vitals->pulse           = $heart_rate;
            $vitals->pressure        = $pressure;
            $vitals->weight          = $weight;
            $vitals->height          = $height;
            $vitals->pain            = $pain;
            $vitals->urinalysis      = $urinalysis;
            $vitals->resp_date       = $respiration;
            $vitals->rbs             = $rbs;
            $vitals->clinical_vitals = $json;
            $vitals->comment         = $comment;

            $vitals->status = "waiting";
            $vitals->date = strftime("%Y-%m-%d %H:%M:%S", time());
            if ($vitals->save()) {
                $emergency->status = "waiting";
                $emergency->save();
                $done = TRUE;
                $message = "Vitals have been saved for this Patient";
            }
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
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> All Patient</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Patient</li>
                        <li class="breadcrumb-item active">All Patient</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                    <div class="bh_chart hidden-xs">
                        <div class="float-left m-r-15">
                            <small>Visitors</small>
                            <h6 class="mb-0 mt-1"><i class="icon-user"></i> 1,784</h6>
                        </div>
                        <span class="bh_visitors float-right">2,5,1,8,3,6,7,5</span>
                    </div>
                    <div class="bh_chart hidden-sm">
                        <div class="float-left m-r-15">
                            <small>Visits</small>
                            <h6 class="mb-0 mt-1"><i class="icon-globe"></i> 325</h6>
                        </div>
                        <span class="bh_visits float-right">10,8,9,3,5,8,5</span>
                    </div>
                    <div class="bh_chart hidden-sm">
                        <div class="float-left m-r-15">
                            <small>Chats</small>
                            <h6 class="mb-0 mt-1"><i class="icon-bubbles"></i> 13</h6>
                        </div>
                        <span class="bh_chats float-right">1,8,5,6,2,4,3,2</span>
                    </div>
                </div>
            </div>
        </div>


        <div class="row clearfix">
            <div class="col-md-12">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">

                            <a style="font-size: larger" href="em.php">&laquo;Back</a>

                            <h2 class="page-title"><?php // echo $patient->title . " " . $patient->full_name(); ?></h2>
                        </div>
                        <div class="body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Contact-withicon"><i class="fa fa-user"></i> Previous Vitals
                                        </a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#new-withicon"><i class="fa fa-vcard"></i> New Vitals</a></li>
                                
                            </ul>
                            <div class="tab-content">
                    
                                <div class="tab-pane" id="Contact-withicon">


                                    <div class="container">
                                        <h5>Previous Vitals</h5>

                                        <div class="alert alert-info alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                                            </button>
                                            <i class="fa fa-info-circle"></i> Most recent Patient's vitals
                                        </div>


                                        <div id="accordion">
                                            <?php
                                            $vitals = Vitals::find_by_patient_vitals($patient->id);
                                            foreach ($vitals as $vital) {
                                            ?>

                                                <div class="card">
                                                    <div class="card-header">
                                                        <a class="card-link" data-toggle="collapse" href="#collapse<?php echo $vital->id; ?>">
                                                            <?php $d_date = date('d/m/Y h:i a', strtotime($vital->date));
                                                            echo $d_date ?>
                                                        </a>
                                                    </div>
                                                    <div id="collapse<?php echo $vital->id; ?>" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="table-responsive">
                                                                        <h5> Vital Signs as
                                                                            at <?php $d_date = date('d/m/Y h:i a', strtotime($vital->date));
                                                                                echo $d_date ?></h5>
                                                                        <table class="table table-bordered">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <?php
                                                                                    if (isset($vital->temperature) and (!empty($vital->temperature))) {
                                                                                        echo "<th>Temperature</th>";
                                                                                        echo "<td> $vital->temperature</td>";
                                                                                    }
                                                                                    ?>
                                                                                </tr>
                                                                                <tr>
                                                                                    <?php
                                                                                    if (isset($vital->pulse) and (!empty($vital->pulse))) {
                                                                                        echo "<th> Heart Rate(Pulse) </th>";
                                                                                        echo "<td> $vital->pulse</td>";
                                                                                    }
                                                                                    ?>
                                                                                </tr>
                                                                                <tr>
                                                                                    <?php
                                                                                    if (isset($vital->resp_rate) and (!empty($vital->resp_rate))) {
                                                                                        echo "<th> Respiratory Rate </th>";
                                                                                        echo "<td> $vital->resp_rate</td>";
                                                                                    }
                                                                                    ?>
                                                                                </tr>
                                                                                <tr>
                                                                                    <?php
                                                                                    if (isset($vital->pressure) and (!empty($vital->pressure))) {
                                                                                        echo "<th>Blood Pressure</th>";
                                                                                        echo "<td> $vital->pressure</td>";
                                                                                    }
                                                                                    ?>
                                                                                </tr>
                                                                                <tr>
                                                                                    <?php
                                                                                    if (isset($vital->weight) and (!empty($vital->weight))) {
                                                                                        echo "<th> Weight </th>";
                                                                                        echo "<td> $vital->weight</td>";
                                                                                    }
                                                                                    ?>
                                                                                </tr>
                                                                                <tr>
                                                                                    <?php
                                                                                    if (isset($vital->height) and (!empty($vital->height))) {
                                                                                        echo "<th> Height </th>";
                                                                                        echo "<td> $vital->height</td>";
                                                                                    }
                                                                                    ?>
                                                                                </tr>
                                                                                <tr>
                                                                                    <?php
                                                                                    if (isset($vital->pain) and (!empty($vital->pain))) {
                                                                                        echo "<th> Pain </th>";
                                                                                        echo "<td> $vital->pain</td>";
                                                                                    }
                                                                                    ?>
                                                                                </tr>
                                                                                <tr>
                                                                                    <?php
                                                                                    if (isset($vital->urinalysis) and (!empty($vital->urinalysis))) {
                                                                                        echo "<th> Urinalysis </th>";
                                                                                        echo "<td> $vital->urinalysis</td>";
                                                                                    }
                                                                                    ?>
                                                                                </tr>

                                                                                <tr>
                                                                                    <?php
                                                                                    if (isset($vital->rbs) and (!empty($vital->rbs))) {
                                                                                        echo "<th> RBS </th>";
                                                                                        echo "<td> $vital->rbs</td>";
                                                                                    }
                                                                                    ?>
                                                                                </tr>

                                                                            </tbody>
                                                                        </table>
                                                                        <?php
                                                                        if (isset($vital->comment) and (!empty($vital->comment)))
                                                                            echo $vital->comment;
                                                                        ?>
                                                                        <p class="text-info" style="font-size: larger"><code></code>
                                                                            Vitals Done
                                                                            By <?php echo $vital->nurse ?>
                                                                        </p>


                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                <!--
                                                                    <div class="table-responsive">
                                                                        <?php
                                                                       // $clinic = Clinic::find_by_id($subClinic->clinic_id);
                                                                        ?>
                                                                        <h5> Clinical Vital Signs </h5>
                                                                        <?php
                                                                      //  $decoded = $vital->clinical_vitals;
                                                                      //  $array = json_decode($decoded);
                                                                        ?>
                                                                        <table class="table table-bordered">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th>CLINIC</th>
                                                                                    <th><?php // echo $clinic->name ?></th>
                                                                                </tr>
                                                                                <?php
                                                                             //   foreach ($array as $key => $value) { ?>
                                                                                    <tr>
                                                                                        <th><?php // echo $key ?></th>
                                                                                        <td><?php // echo $value ?></td>
                                                                                    </tr>
                                                                                <?php // } ?>

                                                                        </table>
                                                                    </div>
                                                                    -->
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                        </div>


                                    </div>

                                </div>

                                <div class="tab-pane" id="new-withicon">
                                    <!--<h6>New Vitals</h6>-->
                                    <form action="" method="post">
                                        <div class="row">

                                            <div class="col-md-5">

                                                <h4><u> General Vitals</u></h4>


                                                <div class="table-responsive">
                                                    <table>
                                                        <tr>
                                                            <th>Temperature</th>
                                                            <td style='padding-left: 30px'><input type="text" name="temperature" required class="form-control">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Heart Rate(Pulse)</th>
                                                            <td style='padding-left: 30px'><input type="text" name="heart_rate" class="form-control">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Respiratory Rate</th>
                                                            <td style='padding-left: 30px'><input type="text" name="respiration" class="form-control">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Blood Pressure</th>
                                                            <td style='padding-left: 30px'><input type="text" name="pressure" required class="form-control">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Weight</th>
                                                            <td style='padding-left: 30px'><input type="text" name="weight" required class="form-control">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Height</th>
                                                            <td style='padding-left: 30px'><input type="text" name="height" class="form-control">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Pain</th>
                                                            <td style='padding-left: 30px'><input type="text" name="pain" class="form-control">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Urinalysis</th>
                                                            <td style='padding-left: 30px'><input type="text" name="urinalysis" class="form-control">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>RBS</th>
                                                            <td style='padding-left: 30px'><input type="text" name="rbs" class="form-control">
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="2">
                                                                <label> Comments </label>
                                                                <textarea class="form-control" name="comment" rows="5" cols="30"></textarea>
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <th>
                                                                <button type="submit" name="save_vitals" class="btn btn-primary">Save Vitals
                                                                </button>

                                                            </th>
                                                            <td style='padding-left: 30px'>

                                                            </td>
                                                        </tr>
                                                    </table>

                                                </div>


                                            </div>
                                            <div class="col-md-7">
                                                <h4><u> Clinic Vitals</u></h4>
                                                <!--    <form action="" method="post">-->

                                                <div class="table-responsive">
                                                    <table>
                                                        <tr>
                                                            <th> Select Clinic</th>
                                                            <td style='padding-left: 30px'>
                                                                <select class="form-control" id="clinic_vitals" name="clinic_id" required>
                                                                    <option value="">--Select Clinic--</option>
                                                                    <?php
                                                                    $finds = Clinic::find_all();
                                                                    foreach ($finds as $find) { ?>
                                                                        <option value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                        </tr>

                                                    </table>
                                                    <div id="clin_vitals">

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


    </div>
</div>


<?php

require('../layout/footer.php');
