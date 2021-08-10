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

    $reports                = new StdClass();
    $reports->xray          = $xray;
    $reports->pcv           = $pcv;
    $reports->wbc           = $wbc;
    $reports->bg            = $bg;
    $reports->genotype      = $genotype;
    $reports->micro         = $micro;
    $reports->urinary_protein = $urinary_protein;
    $reports->urinary_glucose = $urinary_glucose;
    $reports->preg_test     = $preg_test;
    $reports->hiv           = $hiv;
    $reports->hepatitis     = $hepatitis;
    $reports->code          = $code;

    $medical                = new MedicalReports();
    $medical->sync          = "off";
    $medical->patient_id    = $name;
    $medical->result        = json_encode($reports);
    $medical->doctor        = $user->full_name();
    $medical->date          = strftime("%Y-%m-%d %H:%M:%S", time());
    $medical->save();

//    redirect_to("print_medReport.php?id=$medical->id");


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
        <div class="row d-flex">
    <a href="../consultant/index.php" style="font-size: large">&laquo; Back</a>
    <form action="nysc_search.php" method="POST">
        <input type="hidden" name="id" value="">
        <input type="text" name="search_id" placeholder="Search" value="">
        <button type="submit" name="search_btn" class="btn btn-primary">Search</button>
    </form>
</div>
     <div class="row clearfix">
        <form method="post" action="">
 
            <center><h4>TO WHOM IT MAY CONCERN</h4></center>
             <div class="row">
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label>Mr./Mrs./Miss</label>
                    <input type="text" name="patient_name" class="form-control" value="">
                </div>
            </div>
            <center><h3><u>MEDICAL CERTIFICATE OF FITNESS FOR ADMISSION</u></h3></center>
            <div class="row">
                <div class="col-lg-12">
                    <p>This is to certify that I have examined the above candidate and found him/her to be physically and mentally for the admission.</p>
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
                    <input type="text" name="xray" class="form-control" value="">
                </div>
                <div class="col-md-3">
                    <p>shows no abnormality.</p>
                </div>
            </div>

            <!--<div class="row">
                <div class="offset-1 col-md-8">
                    <label>Electrocardiogram Test:</label>
                </div>
                <div class="col-md-2">
                </div>
            </div>

            <div class="row">
                <div class="offset-1 col-md-8">
                    <input type="text" name="electrocardiogram" class="form-control" value="">
                </div>

            </div> -->


            <div class="row">
                <div class="offset-1 col-md-11">
                    <label>Haematological Investigation:</label>
                </div>
            </div>
            <div class="row form-group">
                <div class="offset-1 col-sm-1">
                    <label>PCV</label>
                </div>

                <div class="col-md-4">
                    <input type="text" name="pcv" class="form-control" id="pcv" value="">
                </div>

                <div class="offset-1 col-sm-1">
                    <label>WBC</label>
                </div>

                <div class="col-md-3">
                    <input type="text" name="wbc" class="form-control" id="wbc" value="">
                </div>
            </div>

                <div class="row form-group">
                <div class="offset-1 col-sm-1">
                    <label>Blood Group</label>
                </div>

                <div class="col-md-4">
                    <input type="text" name="bg" class="form-control" id="bg" value="">
                </div>

                <div class="offset-1 col-sm-1">
                    <label>Genotype</label>
                </div>

                <div class="col-md-3">
                    <input type="text" name="genotype" class="form-control" id="genotype" value="">
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

                <div class="col-md-3 mb-4">
                    <input type="text" name="urinary_protein" class="form-control" id="urinary_protein" value="">
                </div>

                <div class="offset-1 col-md-1">
                    <label>Urinary Glucose</label>
                </div>

                <div class="col-md-4">
                    <input type="text" name="urinary_glucose" class="form-control" id="urinary_glucose" value="">
                </div>
            </div>
            <div class="row">
                <div class="offset-1 col-md-4">
                    <label>Pregnancy Test:</label>
                </div>
                <div class="col-md-7 mb-4">
                    <input type="text" name="preg_test" class="form-control" value="" required/>
                </div>
            </div>


            <div class="row">
                <div class="offset-1 col-md-4">
                    <label>HIV Test:</label>
                </div>
                <div class="col-md-7 mb-4">
                    <input type="text" name="hiv" class="form-control" value="" required/>
                </div>
            </div>

            <div class="row">
                <div class="offset-1 col-md-4">
                    <label>Hepatitis B Surface Antigen:</label>
                </div>
                <div class="col-md-7 mb-4">
                    <input type="text" name="hepatitis_bsa" class="form-control" value="" required/>
                </div>
            </div>


             <div class="row">
                <div class="offset-1 col-md-4">
                    <label>Pregnancy Test:</label>
                </div>
                <div class="col-md-7 mb-4">
                    <input type="text" name="preg_test" class="form-control" value="" required/>
                </div>
            </div>
            <!--    <div class="row">
             <div class="offset-1 col-md-2">
           <label>Pregnancy Test</label>
             </div>
             <div class="col-md-4">
             <select name="pregnancy" class="form-control">
             <option value="Positive">Positive</option>
              <option value="Negative">Negative</option>
             </select>
            </div>
        </div>  -->


               <!--  <div class="row">
                <div class="offset-1 col-md-4">
                    <label>Sputum AFB:</label>
                </div>
                <div class="col-md-7 mb-4">
                    <input type="text" name="sputum" class="form-control" value="" required/>
                </div>
            </div>  -->



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
                    <button type="submit" class="btn btn-info">Save</button>
                </div>
                <div class="col-md-4">
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

