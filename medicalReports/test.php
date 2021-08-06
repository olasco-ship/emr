<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

if (is_post()){

    $name                   = $_POST['patient_name'];
    $xray                   = $_POST['xray'];
    $pcv                    = $_POST['pcv'];
    $wbc                    = $_POST['wbc'];
    $bg                     = $_POST['bg'];
    $genotype               = $_POST['genotype'];
    $micro                  = $_POST['micro_para'];
    $urinary_protein        = $_POST['urinary_protein'];
    $urinary_glucose        = $_POST['urinary_glucose'];
    $preg_test              = $_POST['pregnancy'];
    $hiv                    = $_POST['hiv'];
    $hepatitis              = $_POST['hepatitis_b'];
    $code                   = $_POST['code_no'];

    $furStu                = new StdClass();
    $furStu->xray          = $xray;
    $furStu->pcv           = $pcv;
    $furStu->wbc           = $wbc;
    $furStu->bg            = $bg;
    $furStu->genotype      = $genotype;
    $furStu->micro         = $micro;
    $furStu->urinary_protein = $urinary_protein;
    $furStu->urinary_glucose = $urinary_glucose;
    $furStu->preg_test     = $preg_test;
    $furStu->hiv           = $hiv;
    $furStu->hepatitis     = $hepatitis;
    $furStu->code          = $code;

    $medical                = new MedicalReports();
    $medical->sync          = "off";
    $medical->patient_id    = $name;
    $medical->result        = json_encode($furStus);
    $medical->doctor        = $user->full_name();
    $medical->date          = strftime("%Y-%m-%d %H:%M:%S", time());
    $medical->save();

   redirect_to("print_medReport.php?id=$medical->id");


}


require('../layout/header.php');
?>



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> GP Consultation </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Reports</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">

                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="body">

                            <a href="../consultant/index.php" style="font-size: large">&laquo; Back</a>
                            <div href="#" class="right">
                                <form class="form-inline" id="basic-form" action="" method="post">
                                    <div class="form-group">
                                        <input type="text"  class="form-control" placeholder="Folder Number"
                                               name="search" required>
                                        <button type="submit" class="btn btn-outline-primary">Search</button>
                                        <button type="button" name="search" onClick="location.href=location.href"  class="btn btn-outline-warning">Refresh</button>
                                    </div>
                                </form>
                            </div>

                            <?php if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                                $search = trim($_POST['search_id']);
                                $patient = Patient::find_by_number($query);
                                if (empty($patient)){
                                    ?>
                                    <div id="success" class="alert alert-warning alert-dismissible" role="alert" style="width: 500px">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                        No record found for <?php echo $query ?>
                                    </div>
                                <?php } else {
                                    $dept = "Haematology";
                                    $result = Result::find_patient_test($patient->id, $dept);
                                    $decoded = json_decode($result->resultData);

                                    $chempath = "Chemical Pathology";
                                    $chemResult = Result::find_patient_test($patient->id, $chempath);
                                    $data = json_decode($chemResult->resultData);
                                     $scan = scanResult::find_by_patient_id($patient->id);
                                    $gen = json_decode($can->resultData);

                                    ?>

                                    <div class="row clearfix">
                                        <form method="post" action="">
                                            <center><h4>TO WHOM IT MAY CONCERN</h4></center>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Mr./Mrs./Miss</label>
                                                    <input type="text" name="patient_name" class="form-control" value="<?php echo $patient->title. " ".  $patient->first_name . " " . "$patient->last_name" ?>">
                                                </div>
                                            </div>
                                            <center><h3><u>MEDICAL CERTIFICATE OF FITNESS FOR FURTHER STUDIES</u></h3></center>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p>This is to certify that I have examined the above candidate and found him/her to be physically and mentally
                                                        fit for further studies.</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="offset-1 col-md-8">
                                                    <label>His/Her Chest X-Ray No:</label>
                                                </div>
                                                <div class="col-md-2">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="offset-1 col-md-8">
                                                    <input type="text" name="xray" class="form-control" value="<?php echo $gen->xray_no ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <p>shows no abnormality.</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="offset-1 col-md-11">
                                                    <label>Haematological Investigation:</label>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="offset-1 col-md-1">
                                                    <label>PCV</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input type="text" name="pcv" class="form-control" id="pcv" value="<?php echo $decoded->PCV ?>">
                                                </div>

                                                <div class="offset-1 col-md-1">
                                                    <label>WBC</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input type="text" name="wbc" class="form-control" id="wbc" value="<?php echo $decoded->WBC ?>">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="offset-1  col-md-2">
                                                    <label>Blood Group</label>
                                                </div>

                                                <div class="col-md-3">
                                                    <input type="text" name="bg" class="form-control" id="bg" value="<?php echo $decoded->BloodGroup ?>">
                                                </div>

                                                <div class="offset-1 col-md-1">
                                                    <label>Genotype</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input type="text" name="genotype" class="form-control" id="genotype" value="<?php echo $decoded->HbGenotype ?>">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="offset-1 col-md-5">
                                                    <label>Microbiology & Parasitology Organisms:</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <textarea name="micro_para" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="offset-1 col-md-11">
                                                    <label>Chemical Pathological Investigation:</label>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="offset-1 col-md-2">
                                                    <label>Urinary Protein</label>
                                                </div>

                                                <div class="col-md-3">
                                                    <input type="text" name="urinary_protein" class="form-control" id="urinary_protein" value="<?php echo $data->urine_protein ?>">
                                                </div>

                                                <div class="offset-1 col-md-1">
                                                    <label>Urinary Glucose</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input type="text" name="urinary_glucose" class="form-control" id="urinary_glucose" value="<?php echo $data->urine_glucose ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="offset-1 col-md-4">
                                                    <label>HIV Test:</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <textarea name="hiv" class="form-control" value="<?php echo $decoded->hiv ?>"></textarea>
                                                </div>
                                            </div>

                                            <br>

                                            <div class="row">
                                                <div class="offset-1 col-md-5">
                                                    <label>Hepatitis B Surface Antigen:</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <textarea name="hepatitis_b" class="form-control" value="<?php echo $decoded->HBsAg ?>"></textarea>
                                                </div>
                                            </div>

                                                <div class="row">
                                                <div class="offset-1 col-md-2">
                                                    <label>Pregnancy Test</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="pregnancy" class="form-control">
                                                        <option value="Positive">Positive</option>
                                                        <option value="Negative">Negative</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="row">
                <div class="offset-1 col-md-9">
                    <label><h4 style="text-align: center;">Medical Officer:</h4></label>
                </div>
            </div>

            <div class="row">
                <div class="offset-1 col-md-4">
                    <label>Name:</label>
                </div>
                <?php if ($session->is_logged_in()){ 
                    $user = User::find_by_id($session->user_id);?>
                <div class="col-md-7 mb-4">
                    <input type="text" name="name" readonly="name" class="form-control" value="<?php echo $user->full_name() ?>">
                </div>
            <?php } ?>
            </div>

                                            <div class="row">
                                                <div class="offset-1 col-md-1">
                                                    <label>Code No:</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="code_no" class="form-control" value="<?php echo $patient->folder_number ?>">
                                                </div>
                                            </div>



                                            <br>

                                            <div class="row">
                                                <div class="offset-1 col-md-7">
                                                    <button type="submit" name="submit_admis_btn" class="btn btn-info">Save</button>
                                                </div>
                                                <div class="col-md-4">
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                <?php } } ?>


                        </div>
                    </div>

                </div>






            </div>
        </div>
    </div>




<?php
require('../layout/footer.php');


?>