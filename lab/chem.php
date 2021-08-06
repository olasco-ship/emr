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

    

        $comment = $_POST['comment'];
        $sodium = $_POST['sodium'];
        $potassium = $_POST['potassium'];
        $bicarbonate = $_POST['bicarbonate'];
        $chloride = $_POST['chloride'];
        $lithium  = $_POST['lithium'];
        $calcium = $_POST['calcium'];
        $ionized_calcium = $_POST['ionized_calcium'];
        $inorganic_phos = $_POST['inorganic_phos'];
        $magnessium = $_POST['magnessium'];
        $phosphorus = $_POST['phosphorus'];
        $urea = $_POST['urea'];
        $creatinine = $_POST['creatinine'];
        $creatinine_clearance = $_POST['creatinine_clearance'];
        $uric_acid = $_POST['uric_acid'];
        $fasting_glucose = $_POST['fasting_glucose'];
        $hpp = $_POST['hpp'];
        $random_glucose = $_POST['random_glucose'];
        $ogtt = $_POST['ogtt'];
        $fasting = $_POST['fasting'];
        $thirty_min = $_POST['thirty_min'];
        $ninety_min = $_POST['ninety_min'];
        $one_hour = $_POST['one_hour'];
        $two_hours = $_POST['two_hours'];

        $ogtt_urine       = $_POST['ogtt_urine'];
        $fasting_urine    = $_POST['fasting_urine'];
        $thirty_min_urine = $_POST['thirty_min_urine'];
        $ninety_min_urine = $_POST['ninety_min_urine'];
        $one_hour_urine   = $_POST['one_hour_urine'];
        $two_hours_urine  = $_POST['two_hours_urine'];

        $hbA = $_POST['hba'];
        $total_protein = $_POST['total_protein'];
        $albumin = $_POST['albumin'];
        $globulin = $_POST['globulin'];
        $total_bilirubin = $_POST['total_bilirubin'];
        $conj_bilirubin = $_POST['conj_bilirubin'];
        $ast = $_POST['ast'];
        $alt = $_POST['alt'];
        $alk_phosphate = $_POST['alk_phosphate'];
        $urinary_protein = $_POST['urinary_protein'];
        $urinary_creatinine = $_POST['urinary_creatinine'];
        $albumin_ratio = $_POST['albumin_ratio'];
        $gamma_gt = $_POST['gamma_gt'];
        $acid_phosphate = $_POST['acid_phosphate'];
        $total = $_POST['total'];
        $prostatic = $_POST['prostatic'];
        $ck_mb = $_POST['ck_mb'];
        $cpk = $_POST['cpk'];
        $ldh = $_POST['ldh'];
        $amylase = $_POST['amylase'];
        $cholinesterase = $_POST['cholinesterase'];
        $total_cholesterol = $_POST['total_cholesterol'];
        $hdl_cholesterol = $_POST['hdl_cholesterol'];
        $ldl_cholesterol = $_POST['ldl_cholesterol'];
        $vldl_cholesterol = $_POST['vldl_cholesterol'];
        $triglycerides = $_POST['triglycerides'];
        $csf = $_POST['csf'];
        $csf_glucose = $_POST['csf_glucose'];
        $csf_protein = $_POST['csf_protein'];
        $csf_chloride = $_POST['csf_chloride'];
        $urine = $_POST['urine'];
        $electrolytes = $_POST['electrolytes'];
        $protein = $_POST['protein'];
        $others = $_POST['others'];
        $glycated_haem = $_POST['glycated_haem'];
        $tibc = $_POST['tibc'];
        $g6pd = $_POST['g6pd'];
        $lipase = $_POST['lipase'];

        $psa = $_POST['psa'];
        $t3 = $_POST['t3'];
        $t4 = $_POST['t4'];
        $tsh = $_POST['tsh'];
        $e2 = $_POST['e2'];
        $lh = $_POST['lh'];
        $fsh = $_POST['fsh'];
        $prolactin = $_POST['prolactin'];
        $progesterone = $_POST['progesterone'];
        $testosterone = $_POST['testosterone'];
        $afp = $_POST['afp'];
        $beta_hcg = $_POST['beta_hcg'];
        $urine_protein = $_POST['urine_protein'];
        $urine_glucose = $_POST['urine_glucose'];
        $urine_blood = $_POST['urine_blood'];
        $urine_bilirubin = $_POST['urine_bilirubin'];
        $urine_urobilinogen = $_POST['urine_urobilinogen'];
        $urine_ketones = $_POST['urine_ketones'];
        $urine_ascorbic_acid = $_POST['urine_ascorbic_acid'];
        $urine_nitrite = $_POST['urine_nitrite'];
        $urine_ph = $_POST['urine_ph'];
        $urine_sp_gravity = $_POST['urine_sp_gravity'];
        $faecal = $_POST['faecal'];
        $mantoux_test = $_POST['mantoux_test'];
        $mantoux_ref = $_POST['mantoux_ref'];
        $pt_urine = $_POST['pt_urine'];
        $pt_blood = $_POST['pt_blood'];
        $notes = $_POST['notes'];


        $chem_path                       = new StdClass();
        $chem_path->Comment              = $comment;
        $chem_path->Sodium               = $sodium;
        $chem_path->Potassium            = $potassium;
        $chem_path->Bicarbonate          = $bicarbonate;
        $chem_path->Chloride             = $chloride;
        $chem_path->lithium              = $lithium;
        $chem_path->Calcium              = $calcium;
        $chem_path->IonizedCalcium       = $ionized_calcium;
        $chem_path->InorganicPhos        = $inorganic_phos;
        $chem_path->Magnessium           = $magnessium;
        $chem_path->Phosphorus           = $phosphorus;
        $chem_path->Urea                 = $urea;
        $chem_path->creatinine           = $creatinine;
        $chem_path->creatinine_clearance = $creatinine_clearance;
        $chem_path->uric_acid            = $uric_acid;
        $chem_path->fasting_glucose      = $fasting_glucose;
        $chem_path->hpp                  = $hpp;
        $chem_path->random_glucose       = $random_glucose;
        $chem_path->hbA                  = $hbA;
        $chem_path->ogtt                 = $ogtt;
        $chem_path->fasting              = $fasting;
        $chem_path->thirty_min           = $thirty_min;
        $chem_path->ninety_min           = $ninety_min;
        $chem_path->one_hour             = $one_hour;
        $chem_path->two_hours            = $two_hours;

        $chem_path->ogtt_urine           = $ogtt_urine;
        $chem_path->fasting_urine        = $fasting_urine;
        $chem_path->thirty_min_urine     = $thirty_min_urine;
        $chem_path->ninety_min_urine     = $ninety_min_urine;
        $chem_path->one_hour_urine       = $one_hour_urine;
        $chem_path->two_hours_urine      = $two_hours_urine;

        $chem_path->total_protein        = $total_protein;
        $chem_path->albumin              = $albumin;
        $chem_path->globulin             = $globulin;
        $chem_path->total_bilirubin      = $total_bilirubin;
        $chem_path->conj_bilirubin       = $conj_bilirubin;
        $chem_path->ast                  = $ast;
        $chem_path->alt                  = $alt;
        $chem_path->alk_phosphate        = $alk_phosphate;
        $chem_path->urinary_protein      = $urinary_protein;
        $chem_path->urinary_creatinine    = $urinary_creatinine;
        $chem_path->albumin_ratio = $albumin_ratio;
        $chem_path->gamma_gt = $gamma_gt;
        $chem_path->acid_phosphate = $acid_phosphate;
        $chem_path->total = $total;
        $chem_path->prostatic = $prostatic;
        $chem_path->ck_mb = $ck_mb;
        $chem_path->cpk = $cpk;
        $chem_path->tibc = $tibc;
        $chem_path->g6pd = $g6pd;
        $chem_path->lipase = $lipase;
        $chem_path->ldh = $ldh;
        $chem_path->amylase = $amylase;
        $chem_path->cholinesterase = $cholinesterase;
        $chem_path->total_cholesterol = $total_cholesterol;
        $chem_path->hdl_cholesterol = $hdl_cholesterol;
        $chem_path->ldl_cholesterol = $ldl_cholesterol;
        $chem_path->vldl_cholesterol = $vldl_cholesterol;
        $chem_path->triglycerides = $triglycerides;
        $chem_path->csf = $csf;
        $chem_path->urine = $urine;
        $chem_path->csf_glucose = $csf_glucose;
        $chem_path->csf_protein = $csf_protein;
        $chem_path->csf_chloride = $csf_chloride;
        $chem_path->electrolytes = $electrolytes;
        $chem_path->protein = $protein;
        $chem_path->others = $others;
        $chem_path->psa = $psa;
        $chem_path->t3 = $t3;
        $chem_path->t4 = $t4;
        $chem_path->tsh = $tsh;
        $chem_path->e2 = $e2;
        $chem_path->lh = $lh;
        $chem_path->fsh = $fsh;
        $chem_path->prolactin = $prolactin;
        $chem_path->progesterone = $progesterone;
        $chem_path->testosterone = $testosterone;
        $chem_path->afp = $afp;
        $chem_path->beta_hcg = $beta_hcg;
        $chem_path->urine_protein = $urine_protein;
        $chem_path->urine_glucose = $urine_glucose;
        $chem_path->urine_blood = $urine_blood;
        $chem_path->urine_bilirubin = $urine_bilirubin;
        $chem_path->urine_urobilinogen = $urine_urobilinogen;
        $chem_path->urine_ketones = $urine_ketones;
        $chem_path->urine_ascorbic_acid = $urine_ascorbic_acid;
        $chem_path->urine_nitrite = $urine_nitrite;
        $chem_path->urine_ph = $urine_ph;
        $chem_path->urine_sp_gravity = $urine_sp_gravity;
        $chem_path->faecal = $faecal;
        $chem_path->mantoux_test = $mantoux_test;
        $chem_path->mantoux_ref = $mantoux_ref;
        $chem_path->pt_urine = $pt_urine;
        $chem_path->pt_blood = $pt_blood;
        $chem_path->notes = $notes;
        $chem_path->date = strftime("%Y-%m-%d %H:%M:%S", time());

        $json = json_encode($chem_path);
      //  echo $json; exit;


        $result->lab_no         = $_POST['lab_no'];
        $result->scientist_note = $notes;
        $result->resultData     = $json;
        $result->scientist      = $user->full_name();
        $result->date           = strftime("%Y-%m-%d %H:%M:%S", time());
        if (isset($_POST['save_and_send'])) {
        $result->status         = 'DONE';
         $result->save();
         $session->message("Result has been sent to Doctor.");
         redirect_to('results.php');
         }
         $result->save();
         $session->message("Result has been saved.");
        // print_r($result); exit;




    


}








require('../layout/header.php');
?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                            Lab Request Forms </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Laboratory</li>
                            <li class="breadcrumb-item active">Forms</li>
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
                    <div class="card patients-list">
                        <div class="header">





                            <ul class="header-dropdown">
                                <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Weekly">W</a></li>
                                <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Monthly">M</a></li>
                                <li><a class="tab_btn active" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Yearly">Y</a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="container">

                                <a href="../lab/sample_analysis.php">Back</a>

                                <h4 style="text-align: center">OBAFEMI AWOLOWO UNIVERSITY TEACHING HOSPITALS  COMPLEX</h4>
                                <h6 style="text-align: center">CHEMICAL PATHOLOGY  FORM</h6>


                                <form action="" method="post">

                                    <div class="row">
                                        <div class="col-md-6">


                                            <div class="table-responsive">
                                                <!--<h4><?php /*echo $patient->full_name() */?></h4>-->
                                                <table class="table table">
                                                    <tbody>
                                                    <tr class="active">
                                                        <th>Patient</th>
                                                        <td> <?php echo $patient->full_name()  ?></td>
                                                    </tr>
                                                    <tr class="active">
                                                        <th>Clinical Details</th>
                                                        <td> <?php echo $result->doctor_note  ?></td>
                                                    </tr>

                                                    <tr class="active">
                                                        <th>Birthdate</th>
                                                        <td> <?php $d_date = date('d-M-Y', strtotime($patient->dob));
                                                            echo $d_date ?></td>
                                                    </tr>

                                                    <tr class="active">
                                                        <th>Age</th>
                                                        <td> <?php echo getAge($patient->dob ) . 'years'  ?></td>
                                                    </tr>
                                                    <tr class="active">
                                                        <th>Sex</th>
                                                        <td> <?php echo $patient->gender   ?> </td>
                                                    </tr>

                                                    <tr class="active">
                                                        <th>Specimen</th>
                                                        <td> <?php $decode = json_decode($result->specimen );
                                                            foreach ($decode as $item) { echo $item . ', '; }
                                                            ?>
                                                        </td>
                                                    </tr>

                                                    <tr class="active">
                                                        <th>Test</th>
                                                        <td> <?php $decode = json_decode($result->test );
                                                            foreach ($decode as $item) { echo $item . ', '; }
                                                            ?>
                                                        </td>
                                                    </tr>



                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <table class="table table">
                                                <tbody>
                                                <tr class="active">
                                                    <th>Lab No.</th>
                                                    <td> <input class="form-control"  style="width: 300px;" value="" name="lab_no"/> </td>
                                                </tr>

                                                <tr class="active">
                                                    <th>Hospital No.</th>
                                                    <td> <?php echo $patient->folder_number   ?> </td>
                                                </tr>
                                                <tr class="active">
                                                    <th> Ward/Clinic </th>
                                                    <td> <?php echo $result->clinic  ?> </td>
                                                </tr>
                                                <tr class="active">
                                                    <th> Doctor </th>
                                                    <td> <?php echo $result->doctor  ?> </td>
                                                </tr>
                                                <tr class="active">
                                                    <th>Date Sample Col.</th>
                                                    <td> <?php $d_date = date('d/M/Y', strtotime($result->date_col));
                                                        $time = date('h:i a', strtotime($result->time_col));
                                                        echo $d_date ." ". $time ?>  </td>
                                                </tr>


                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">

                                            Chemical Pathology

                                        </div>

                                        <div class="card-body">

                                            <div class="row">

                                                <div class="col-md-7">

                                                    <div class="table-responsive" >

                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <td><b>Blood Investigation</b></td>
                                                                <td><b>Result</b></td>
                                                                <td><b>Unit</b></td>
                                                                <td><b>Reference</b></td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>Electrolyte</b></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Sodium</td>
                                                                <td><input class="form-control" style="width: 80px;" name="sodium" value="<?php echo $sodium; ?>" type="text">
                                                                </td>
                                                                <td>mmol/l</td>
                                                                <td>136 - 145</td>

                                                            </tr>

                                                            <tr>
                                                                <td>Potassium</td>
                                                                <td><input class="form-control" name="potassium" value="<?php echo $potassium; ?>"
                                                                           type="text"></td>
                                                                <td>mmol/l</td>
                                                                <td>3.0 - 5.0</td>
                                                            </tr>


                                                            <tr>
                                                                <td>Chloride</td>
                                                                <td><input class="form-control" name="chloride" value="<?php echo $chloride; ?>"
                                                                           type="text"></td>
                                                                <td>mmol/l</td>
                                                                <td>95 - 110</td>
                                                            </tr>

                                                            <tr>
                                                                <td>Lithium</td>
                                                                <td><input class="form-control" name="lithium" value="<?php echo $lithium; ?>"
                                                                           type="text"></td>
                                                                <td>mmol/l</td>
                                                                <td>1</td>
                                                            </tr>

                                                            <tr>
                                                                <td>Bicarbonate</td>
                                                                <td><input class="form-control" name="bicarbonate" value="<?php echo $bicarbonate; ?>"
                                                                           type="text"></td>
                                                                <td>mmol/l</td>
                                                                <td>20 - 30</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Ionized Calcium</td>
                                                                <td><input class="form-control" name="ionized_calcium"
                                                                           value="<?php echo $ionized_calcium; ?>" type="text"></td>
                                                                <td>mmol/l</td>
                                                                <td>0.11 - 1.23</td>
                                                            </tr>

                                                            <tr>
                                                                <td>Inorganic Phos</td>
                                                                <td><input class="form-control" name="inorganic_phos" value="<?php echo $inorganic_phos; ?>"
                                                                           type="text"></td>
                                                                <td>mmol/l</td>
                                                                <td>0.80 - 1.60</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Renal Function Test</b></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Urea</td>
                                                                <td><input class="form-control" name="urea" type="text"></td>
                                                                <td>mmol/l</td>
                                                                <td>2.5 - 5.8</td>
                                                            </tr>

                                                            <tr>
                                                                <td>Creatinine</td>
                                                                <td><input class="form-control" name="creatinine" value="<?php echo $creatinine; ?>"
                                                                           type="text"></td>
                                                                <td>mmol/l</td>
                                                                <td>44 - 132</td>
                                                            </tr>

                                                            <tr>
                                                                <td>Uric Acid</td>
                                                                <td><input class="form-control" name="uric_acid" value="<?php echo $uric_acid; ?>"
                                                                           type="text"></td>
                                                                <td>mmol/l</td>
                                                                <td>M(202-416) F(142-330)</td>
                                                            </tr>

                                                            <tr>
                                                                <td>Calcium</td>
                                                                <td><input class="form-control" name="calcium" value="<?php echo $calcium; ?>" type="text">
                                                                </td>
                                                                <td>mmol/l</td>
                                                                <td>2.2 - 2.7</td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>Liver Function Test</b></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Total Bilirubin</td>
                                                                <td><input class="form-control" name="total_bilirubin"
                                                                           value="<?php echo $total_bilirubin; ?>" type="text"></td>
                                                                <td>µmol/L</td>
                                                                <td>1.71 - 17.1</td>
                                                            </tr>

                                                            <tr>
                                                                <td>Conj. Bilirubin</td>
                                                                <td><input class="form-control" name="conj_bilirubin" value="<?php echo $conj_bilirubin; ?>"
                                                                           type="text"></td>
                                                                <td>µmol/L</td>
                                                                <td>1.7 - 8.5</td>
                                                            </tr>

                                                            <tr>
                                                                <td>ALK. Phosphatase</td>
                                                                <td><input class="form-control" name="alk_phosphate" value="<?php echo $alk_phosphate; ?>"
                                                                           type="text"></td>
                                                                <td>U/L</td>
                                                                <td>98 - 279</td>
                                                            </tr>

                                                            <tr>
                                                                <td>AST. (SGOT)</td>
                                                                <td><input class="form-control" name="ast" value="<?php echo $ast; ?>" type="text"></td>
                                                                <td>U/L</td>
                                                                <td>0 - 40</td>
                                                            </tr>

                                                            <tr>
                                                                <td>ALT. (SGPT)</td>
                                                                <td><input class="form-control" name="alt" value="<?php echo $alt; ?>" type="text"></td>
                                                                <td>U/L</td>
                                                                <td>0 - 40</td>
                                                            </tr>

                                                            <tr>
                                                                <td>Gamma-GT</td>
                                                                <td><input class="form-control" name="gamma_gt" value="<?php echo $gamma_gt; ?>"
                                                                           type="text"></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Total Protein</td>
                                                                <td><input class="form-control" name="total_protein" value="<?php echo $total_protein; ?>"
                                                                           type="text"></td>
                                                                <td>g/dl</td>
                                                                <td>58 - 80</td>
                                                            </tr>

                                                            <tr>
                                                                <td>Albumin</td>
                                                                <td><input class="form-control" name="albumin" value="<?php echo $albumin; ?>" type="text">
                                                                </td>
                                                                <td>mg/dll</td>
                                                                <td>35 - 50</td>
                                                            </tr>

                                                            <tr>
                                                                <td>Globulin</td>
                                                                <td><input class="form-control" name="globulin" value="<?php echo $globulin; ?>" type="text">
                                                                </td>
                                                                <td>g/l</td>
                                                                <td>20 - 45</td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>  Enzymes Markers </b></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Total Acid Phosphatase</td>
                                                                <td><input class="form-control" name="acid_phosphate" value="<?php echo $acid_phosphate; ?>"
                                                                           type="text"></td>
                                                                <td>U/L</td>
                                                                <td>0 - 11</td>
                                                            </tr>

                                                            <tr>
                                                                <td>Prostatic Acid Phosphatase</td>
                                                                <td><input class="form-control" name="prostatic" value="<?php echo $prostatic; ?>"
                                                                           type="text"></td>
                                                                <td>U/L</td>
                                                                <td>0 - 0.4</td>
                                                            </tr>

                                                            <tr>
                                                                <td>Amylase</td>
                                                                <td><input class="form-control" name="amylase" value="<?php echo $amylase; ?>" type="text">
                                                                </td>
                                                                <td>U/L</td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>Cardiac Function Test</b></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td>CPK</td>
                                                                <td><input class="form-control" name="cpk" value="<?php echo $cpk; ?>" type="text"></td>
                                                                <td>U/L</td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td>CKMB</td>
                                                                <td><input class="form-control" name="ck_mb" value="<?php echo $ck_mb; ?>" type="text"></td>
                                                                <td>U/L</td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td>LDH</td>
                                                                <td><input class="form-control" name="ldh" value="<?php echo $ldh; ?>" type="text"></td>
                                                                <td>U/L</td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>Lipid Profile</b></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Total Cholesterol</td>
                                                                <td><input class="form-control" name="total_cholesterol"
                                                                           value="<?php echo $total_cholesterol; ?>" type="text"></td>
                                                                <td>mmol/l</td>
                                                                <td>2.5 - 5.0</td>
                                                            </tr>

                                                            <tr>
                                                                <td>Triglycerides</td>
                                                                <td><input class="form-control" name="triglycerides" value="<?php echo $triglycerides; ?>"
                                                                           type="text"></td>
                                                                <td>mmol/L</td>
                                                                <td><1.71</td>
                                                            </tr>

                                                            <tr>
                                                                <td>HDL-Cholesterol</td>
                                                                <td><input class="form-control" name="hdl_cholesterol"
                                                                           value="<?php echo $hdl_cholesterol; ?>" type="text"></td>
                                                                <td>mmol/L</td>
                                                                <td>1.06 - 1.52</td>
                                                            </tr>

                                                            <tr>
                                                                <td>LDL-CHOLESTEROL</td>
                                                                <td><input class="form-control" name="ldl_cholesterol"
                                                                           value="<?php echo $ldl_cholesterol; ?>" type="text"></td>
                                                                <td>mmol/L</td>
                                                                <td><3.9</td>
                                                            </tr>

                                                            <tr>
                                                                <td><b>Glucose</b></td>
                                                                <td> </td>

                                                                <td></td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Fasting Glucose</td>
                                                                <td><input class="form-control" name="fasting_glucose"
                                                                           value="<?php echo $fasting_glucose; ?>" type="text"></td>
                                                                <td>mmol/L</td>
                                                                <td>2.5 - 5.6</td>
                                                            </tr>

                                                            <tr>
                                                                <td>Glucose (2HPP)</td>
                                                                <td><input class="form-control" name="hpp" value="<?php echo $hpp; ?>" type="text"></td>
                                                                <td>mmol/L</td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Random Glucose</td>
                                                                <td><input class="form-control" name="random_glucose" value="<?php echo $random_glucose; ?>"
                                                                           type="text"></td>
                                                                <td>mmol/L</td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td>GLYCATED HAEMOGLOBIN(hbA)</td>
                                                                <td><input class="form-control" name="hba" value="<?php echo $hbA; ?>" type="text"></td>
                                                                <td>6-8.3%</td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Phosphorus</td>
                                                                <td><input class="form-control" name="phosphorus" value="<?php echo $phosphorus; ?>"
                                                                           type="text"></td>
                                                                <td>mg/dll</td>
                                                                <td>0.3 - 1.5</td>
                                                            </tr>

                                                            <tr>
                                                                <td>TIBC</td>
                                                                <td><input class="form-control" name="tibc" value="<?php echo $tibc; ?>" type="text"></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td>G6PD</td>
                                                                <td><input class="form-control" name="g6pd" value="<?php echo $g6pd; ?>" type="text"></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Lipase</td>
                                                                <td><input class="form-control" name="lipase" value="<?php echo $lipase; ?>" type="text">
                                                                </td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>

                                                            <tr>
                                                                <td>OTHERS (indicate)</td>
                                                                <td><input class="form-control" name="others" value="<?php echo $others; ?>" type="text">
                                                                </td>
                                                                <td></td>
                                                            </tr>

                                                            <!--
                        <tr>
                            <td>CREATININE CLEARANCE</td>
                            <td><input class="form-control" name="creatinine_clearance" value="<?php echo $creatinine_clearance; ?>" type="text"></td>
                            <td>70 - 120 ml/min</td>
                        </tr>

                        <tr>
                            <td>OGTT. </td>
                            <td><input class="form-control" name="ogtt" value="<?php echo $ogtt; ?>" type="text"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 50px;">Fasting </td>
                            <td><input class="form-control" name="fasting" value="<?php echo $fasting; ?>" type="text"></td>
                            <td>2.75-5.78mmol/L</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 50px;">30 min</td>
                            <td><input class="form-control" name="thirty_min" value="<?php echo $thirty_min; ?>" type="text"></td>
                            <td>mmol/dl</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 50px;">60 min</td>
                            <td><input class="form-control" name="one_hour" value="<?php echo $one_hour; ?>" type="text"></td>
                            <td>mmol/dl</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 50px;">90 min</td>
                            <td><input class="form-control" name="ninety_min" value="<?php echo $ninety_min; ?>" type="text"></td>
                            <td>mmol/dl</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 50px;">120 min </td>
                            <td><input class="form-control" name="two_hours" value="<?php echo $two_hours; ?>" type="text"></td>
                            <td>mmol/dl</td>
                        </tr>


                        <tr>
                            <td>PROTEIN</td>
                            <td><input class="form-control" name="protein" value="<?php echo $protein; ?>" type="text"></td>
                            <td>mmol/l</td>
                        </tr>


                        <tr>
                            <td> 24HR URINARY PROTEIN</td>
                            <td><input class="form-control" name="urinary_protein" value="<?php echo $urinary_protein; ?>" type="text"></td>
                            <td>0.05-0.1g/24hrs</td>
                        </tr>

                        <tr>
                            <td> 24HR URINARY CREATININE</td>
                            <td><input class="form-control" name="urinary_creatinine" value="<?php echo $urinary_creatinine; ?>" type="text"></td>
                            <td>1.0-1.5g/24hrs</td>
                        </tr>

                        <tr>
                            <td> ALBUMIN/CREATININE RATIO</td>
                            <td><input class="form-control" name="albumin_ratio" value="<?php echo $albumin_ratio; ?>" type="text"></td>
                            <td>30-300mg/g</td>
                        </tr>
                            -->


                                                        </table>

                                                    </div>


                                                </div>

                                                <div class="col-md-5">

                                                    <div class="table-responsive" >

                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <td colspan="3" style="text-align: center"><b>HORMONAL ASSAY</b></td>

                                                            </tr>

                                                            <tr>
                                                                <td>PSA</td>
                                                                <td colspan="2"><input class="form-control" name="psa" value="<?php echo $psa; ?>"
                                                                                       type="text"></td>
                                                            </tr>


                                                            <tr>
                                                                <td>T3</td>
                                                                <td colspan="2"><input class="form-control" name="t3" value="<?php echo $t3; ?>"
                                                                                       type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td>T4</td>
                                                                <td colspan="2"><input class="form-control" name="t4" value="<?php echo $t4; ?>"
                                                                                       type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td>TSH</td>
                                                                <td colspan="2"><input class="form-control" name="tsh" value="<?php echo $tsh; ?>"
                                                                                       type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td>E2</td>
                                                                <td colspan="2"><input class="form-control" name="e2" value="<?php echo $e2; ?>"
                                                                                       type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td>LH</td>
                                                                <td colspan="2"><input class="form-control" name="lh" value="<?php echo $lh; ?>"
                                                                                       type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td>FSH</td>
                                                                <td colspan="2"><input class="form-control" name="fsh" value="<?php echo $fsh; ?>"
                                                                                       type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Prolactin</td>
                                                                <td colspan="2"><input class="form-control" name="prolactin"
                                                                                       value="<?php echo $prolactin; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Progesterone</td>
                                                                <td colspan="2"><input class="form-control" name="progesterone"
                                                                                       value="<?php echo $progesterone; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Testosterone</td>
                                                                <td colspan="2"><input class="form-control" name="testosterone"
                                                                                       value="<?php echo $testosterone; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td>AFP</td>
                                                                <td colspan="2"><input class="form-control" name="afp" value="<?php echo $afp; ?>"
                                                                                       type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Beta HCG</td>
                                                                <td colspan="2"><input class="form-control" name="beta_hcg" value="<?php echo $beta_hcg; ?>"
                                                                                       type="text"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" style="text-align: center"><b>URINALYSIS</b></td>

                                                            </tr>

                                                            <tr>
                                                                <td>Protein</td>
                                                                <td colspan="2"><input class="form-control" name="urine_protein"
                                                                                       value="<?php echo $urine_protein; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Glucose</td>
                                                                <td colspan="2"><input class="form-control" name="urine_glucose"
                                                                                       value="<?php echo $urine_glucose; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Blood</td>
                                                                <td colspan="2"><input class="form-control" name="urine_blood"
                                                                                       value="<?php echo $urine_blood; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Bilirubin</td>
                                                                <td colspan="2"><input class="form-control" name="urine_bilirubin"
                                                                                       value="<?php echo $urine_bilirubin; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Urobilinogen</td>
                                                                <td colspan="2"><input class="form-control" name="urine_urobilinogen"
                                                                                       value="<?php echo $urine_urobilinogen; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Ketones</td>
                                                                <td colspan="2"><input class="form-control" name="urine_ketones"
                                                                                       value="<?php echo $urine_ketones; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Ascorbic Acid</td>
                                                                <td colspan="2"><input class="form-control" name="urine_ascorbic_acid"
                                                                                       value="<?php echo $urine_ascorbic_acid; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Nitrite</td>
                                                                <td colspan="2"><input class="form-control" name="urine_nitrite"
                                                                                       value="<?php echo $urine_nitrite; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td>pH</td>
                                                                <td colspan="2"><input class="form-control" name="urine_ph" value="<?php echo $urine_ph; ?>"
                                                                                       type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Sp Gravity</td>
                                                                <td colspan="2"><input class="form-control" name="urine_sp_gravity"
                                                                                       value="<?php echo $urine_sp_gravity; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td style="text-align: center"><b>CSF/ECF/ASPIRATES</b></td>
                                                                <td colspan="2" style="text-align: center"><b>REF. RANGE</b></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Protein</td>
                                                                <td><input class="form-control" name="csf_protein" value="<?php echo $csf_protein; ?>"
                                                                           type="text"></td>
                                                                <td>(15-45)mg/dl</td>
                                                            </tr>

                                                            <tr>
                                                                <td>Chloride</td>
                                                                <td><input class="form-control" name="csf_chloride" value="<?php echo $csf_chloride; ?>"
                                                                           type="text"></td>
                                                                <td>120 - 130mmol/L</td>
                                                            </tr>

                                                            <tr>
                                                                <td>Glucose</td>
                                                                <td><input class="form-control" name="csf_glucose" value="<?php echo $csf_glucose; ?>"
                                                                           type="text"></td>
                                                                <td>(2.8-3.9)mmol/L</td>
                                                            </tr>

                                                            <tr>
                                                                <td>mg/dl</td>
                                                                <td colspan="2">Up to 130</td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="3" style="text-align: center"><b>Faecal Occult Blood Test:</b></td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="3"><input class="form-control" name="faecal" value="<?php echo $faecal; ?>"
                                                                                       type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2"><b>Mantoux Test</b></td>
                                                                <td colspan="2"><b>Ref. Range</b></td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2"><input class="form-control" name="mantoux_test"
                                                                                       value="<?php echo $mantoux_test; ?>" type="text"></td>
                                                                <td colspan="2"><input class="form-control" name="mantoux_ref"
                                                                                       value="<?php echo $mantoux_ref; ?>" type="text"></td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="3" style="text-align: center"><b>Pregnancy Test</b></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Urine</td>
                                                                <td colspan="2"><input class="form-control" name="pt_urine" value="<?php echo $pt_urine; ?>"
                                                                                       type="text"></td>

                                                            </tr>

                                                            <tr>
                                                                <td>Blood</td>
                                                                <td colspan="2"><input class="form-control" name="pt_blood" value="<?php echo $pt_blood; ?>"
                                                                                       type="text"></td>

                                                            </tr>

                                                            <tr>
                                                                <td colspan="3"><b>Notes</b></td>

                                                            </tr>

                                                            <tr>
                                                                <td colspan="3"><textarea class="form-control" cols="2" rows="6"
                                                                                          name="notes"><?php echo $notes; ?></textarea></td>

                                                            </tr>

                                                        </table>

                                                    </div>



                                                </div>
                                            </div>

                                            <h4 style="text-align: center"> <b>ORAL GLUCOSE TOLERANCE TEST REPORT SHEET</b> </h4>

                                            <div class="table-responsive" >
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th> </th>
                                                        <th> Fasting</th>
                                                        <th>30 Minutes </th>
                                                        <th>60 Minutes </h4></th>
                                                        <th>90 Minutes </th>
                                                        <th>120 Minutes</th>
                                                        <th>150 Minutes</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>Blood Glucose Level (mmol/L)</td>
                                                        <td><input class="form-control" value="<?php echo $fasting; ?>"  name="fasting"/></td>
                                                        <td> <input class="form-control"  value="<?php echo $thirty_min; ?>"  name="thirty_min"/>  </td>
                                                        <td> <input class="form-control" value="<?php echo $one_hour; ?>"  name="one_hour"/> </td>
                                                        <td><input class="form-control" value="<?php echo $ninety_min; ?>"  name="ninety_min"/></td>
                                                        <td> <input class="form-control"  value="<?php echo $two_hours; ?>"  name="two_hours"/>  </td>
                                                        <td> <input class="form-control" value="<?php echo $ogtt; ?>"  name="ogtt"/> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Urine Glucose </td>
                                                        <td><input class="form-control" value="<?php echo $fasting_urine; ?>"  name="fasting_urine"/></td>
                                                        <td> <input class="form-control"  value="<?php echo $thirty_min_urine; ?>"  name="thirty_min_urine"/>  </td>
                                                        <td> <input class="form-control" value="<?php echo $one_hour_urine; ?>"  name="one_hour_urine"/> </td>
                                                        <td><input class="form-control" value="<?php echo $ninety_min_urine; ?>"  name="ninety_min_urine"/></td>
                                                        <td> <input class="form-control"  value="<?php echo $two_hours_urine; ?>"  name="two_hours_urine"/>  </td>
                                                        <td> <input class="form-control" value="<?php echo $ogtt_urine; ?>"  name="ogtt_urine"/> </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <p class="margin-top-30">
                                                <button type="submit" name="save_only" class="btn btn-lg btn-primary">Save Only</button> &nbsp;&nbsp;
                                                <button type="submit" name="save_and_send" class="btn btn-lg btn-success">Save And Send</button>
                                            </p>
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