<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$medical = MedicalReports::find_by_id($_GET['id']);


$result = Patient::find_by_patient_id($_GET['$medical->patient_id']);


require('../layout/header.php');
?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Medical Report</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Medical Report</li>
                            <li class="breadcrumb-item active"> Medical Certificate </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="clearfix">
                <div class="card">

                    <div class="body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">

                                <div id="body">

                                

                                    <center><h4>TO WHOM IT MAY CONCERN</h4></center>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Mr./Mrs./Miss</label>
                                            <input type="text" name="patient_name" class="form-control" value="<?php echo $result->first_name ?>">
                                        </div>
                                    </div>
                                    <center><h3><u>MEDICAL CERTIFICATE OF FITNESS FOR ADMISSION</u></h3></center>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p>This is to certify that I have examined the above candidate and found him/her to be physically and mentally
                                                fit for further studies.</p>
                                        </div>
                                    </div>

                                    <?php
                                    $decoded = json_decode($medical->result);
                                    ?>
                                    <div class="row">
                                        <div class="offset-1 col-md-8">
                                            <label>His/Her Chest X-Ray No:</label>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="offset-1 col-md-8">
                                            <input type="text" name="xray" class="form-control" value="<?php echo $decoded->xray ?>">
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
                                            <input type="text" name="pcv" class="form-control" id="pcv" value="<?php echo $decoded->pcv ?>">
                                        </div>

                                        <div class="offset-1 col-md-1">
                                            <label>WBC</label>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="text" name="wbc" class="form-control" id="wbc" value="<?php echo $decoded->wbc ?>">
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="offset-1  col-md-2">
                                            <label>Blood Group</label>
                                        </div>

                                        <div class="col-md-3">
                                            <input type="text" name="bg" class="form-control" id="bg" value="<?php echo $decoded->bg ?>">
                                        </div>

                                        <div class="offset-1 col-md-1">
                                            <label>Genotype</label>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="text" name="genotype" class="form-control" id="genotype" value="<?php echo $decoded->genotype ?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="offset-1 col-md-5">
                                            <label>Microbiology & Parasitology Organisms:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <textarea name="micro_para" class="form-control"><?php echo $decoded->micro ?></textarea>
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
                                            <input type="text" name="urinary_protein" class="form-control" id="urinary_protein" value="<?php echo $decoded->urinary_protein ?>">
                                        </div>

                                        <div class="offset-1 col-md-1">
                                            <label>Urinary Glucose</label>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="text" name="urinary_glucose" class="form-control" id="urinary_glucose" value="<?php echo $decoded->urinary_glucose ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="offset-1 col-md-4">
                                            <label>HIV Test:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <textarea name="hiv" class="form-control"><?php echo $decoded->hiv ?></textarea>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="row">
                                        <div class="offset-1 col-md-5">
                                            <label>Hepatitis B Surface Antigen:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <textarea name="hepatitis_b" class="form-control"><?php echo $decoded->hepatitis ?></textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="offset-1 col-md-1">
                                            <label>Code No:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="code_no" class="form-control" value="<?php echo $decoded->code ?>">
                                        </div>

                                        <div class="offset-1 col-md-2">
                                            <label>Pregnancy Test</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="pregnancy" class="form-control">
                                                <option value="<?php echo $decoded->preg_test ?>"><?php echo $decoded->preg_test ?></option>
                                                <option value="Positive">Positive</option>
                                                <option value="Negative">Negative</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form-inline">
                                            <input type="hidden" value="<?php echo $medical->id; ?>" id="billId" />
                                            <button type="button" id="printBill" class="btn btn-lg btn-success" data-loading-text="Searching...">Print Bill
                                            </button>
                                            <!--<a href="print_preview.php?id=<?php /*echo $bill->id */?>" target="_blank" class="btn btn-outline-warning" role="button">
                                        Print Bill
                                    </a>-->
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

