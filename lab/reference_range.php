<?php

require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

$done = FALSE;

$dept = "Chemical Pathology";

$haematologies         = ReferenceRange::find_by_dept($dept);

foreach ($haematologies as $haematology){
    $refs = json_decode($haematology->rangeValue);
}


if (is_Post()){

    if ($_SERVER["REQUEST_METHOD"] == 'POST') {

        $sodium                 = $_POST['sodium'];
        $potassium              = $_POST['potassium'];
        $chloride               = $_POST['chloride'];
        $bicarbonate            = $_POST['bicarbonate'];
        $urea            = $_POST['urea'];
        $creatinine            = $_POST['creatinine'];
        $uric_acid           = $_POST['uric_acid'];
        $calcium            = $_POST['calcium'];
        $ionized_calcium      = $_POST['ionized_calcium'];
        $inorganic_phos         = $_POST['inorganic_phos'];
        $total_bilirubin            = $_POST['total_bilirubin'];
        $conj_bilirubin     = $_POST['conj_bilirubin'];
        $alk_phosphate    = $_POST['alk_phosphate'];
        $ast_sgot      = $_POST['ast_sgot'];
        $alt_sgpt    = $_POST['alt_sgpt'];
        $alt_sgpt      = $_POST['alt_sgpt'];
        $gamma_gt       = $_POST['gamma_gt'];
        $total_protein = $_POST['total_protein'];
        $albumin = $_POST['albumin'];
        $total_acid_phosphate = $_POST['total_acid_phosphate'];
        $prostatic_acid_phosphate = $_POST['prostatic_acid_phosphate'];
        $cpk = $_POST['cpk'];
        $ckmb = $_POST['ckmb'];
        $ldh = $_POST['ldh'];
        $amylase = $_POST['amylase'];
        $total_cholesterol = $_POST['total_cholesterol'];
        $triglycerides = $_POST['triglycerides'];
        $hdl_cholesterol = $_POST['hdl_cholesterol'];
        $ldl_cholesterol = $_POST['hdl_cholesterol'];
        $fasting_glucose = $_POST['fasting_glucose'];
        $glucose_2hpp = $_POST['glucose_2hpp'];
        $random_glucose = $_POST['random_glucose'];
        $glycated_haemoglobin = $_POST['glycated_haemoglobin'];
        $phosphorus = $_POST['phosphorus'];
        $tibc = $_POST['tibc'];
        $g6pd = $_POST['g6pd'];
        $lipase = $_POST['lipase'];
        $lithium = $_POST['lithium'];
        $globulin = $_POST['globulin'];
        $protein = $_POST['protein'];
        $glucose = $_POST['glucose'];
        $others = $_POST['others'];
//        $ = $_POST[''];

        //$haem                = new ReferenceRange();

        if(empty($haematology)){

            $haema =                    new StdClass();
            $haema->sodium              = $sodium;
            $haema->potassium           = $potassium;
            $haema->chloride            = $chloride;
            $haema->bicarbonate         = $bicarbonate;
            $haema->urea                = $urea;
            $haema->creatinine          = $creatinine;
            $haema->uric_acid           = $uric_acid;
            $haema->calcium     = $calcium;
            $haema->ionized_calcium           = $ionized_calcium;
            $haema->inorganic_phos      =$inorganic_phos;
            $haema->total_bilirubin   = $total_bilirubin;
            $haema->conj_bilirubin          = $conj_bilirubin;
            $haema->alk_phosphate        = $alk_phosphate;
            $haema->ast_sgot         = $ast_sgot;
            $haema->alt_sgpt       = $alt_sgpt;
            $haema->gamma_gt     = $gamma_gt;
            $haema->total_protein      = $total_protein;
            $haema->albumin          = $albumin;
            $haema->total_acid_phosphate  = $total_acid_phosphate;
            $haema->prostatic_acid_phosphate  = $prostatic_acid_phosphate;
            $haema->cpk          = $cpk;
            $haema->ckmb         = $ckmb;
            $haema->ldh          = $ldh;
            $haema->amylase      = $amylase;
            $haema->total_cholesterol        = $total_cholesterol;
            $haema->triglycerides        = $triglycerides;
            $haema->hdl_cholesterol       = $hdl_cholesterol;
            $haema->ldl_cholesterol       = $ldl_cholesterol;
            $haema->fasting_glucose      = $fasting_glucose;
            $haema->glucose_2hpp         = $glucose_2hpp;
            $haema->random_glucose       = $random_glucose;
            $haema->glycated_haemoglobin       = $glycated_haemoglobin;
            $haema->phosphorus                = $phosphorus;
            $haema->tibc     = $tibc;
            $haema->g6pd     = $g6pd;
            $haema->lipase       = $lipase;
            $haema->lithium                  = $lithium;
            $haema->globulin                 = $globulin;
            $haema->protein                  = $protein;
            $haema->glucose                  = $glucose;
            $haema->others       = $others;
            $haema->modified_by = $user->full_name();
            $haema->date_modify = strftime("%Y-%m-%d %H:%M:%S", time());
            $haema->date          = strftime("%Y-%m-%d %H:%M:%S", time());

            $json = json_encode($haema);

            $refRange = new ReferenceRange();
            $refRange->sync = "Off";
            $refRange->dept = $dept;
            $refRange->rangeValue = $json;
            $refRange->save();

        }else{
            $haem                    = json_decode($haematology->rangeValue);
            $haem->sodium            = $sodium;
            $haem->potassium          = $potassium;
            $haem->chloride           = $chloride;
            $haem->bicarbonate           = $bicarbonate;
            $haem->urea           = $urea;
            $haem->creatinine          = $creatinine;
            $haem->uric_acid           = $uric_acid;
            $haem->calcium     = $calcium;
            $haem->ionized_calcium           = $ionized_calcium;
            $haem->inorganic_phos      =$inorganic_phos;
            $haem->total_bilirubin   = $total_bilirubin;
            $haem->conj_bilirubin          = $conj_bilirubin;
            $haem->alk_phosphate        = $alk_phosphate;
            $haem->ast_sgot         = $ast_sgot;
            $haem->alt_sgpt       = $alt_sgpt;
            $haem->gamma_gt     = $gamma_gt;
            $haem->total_protein      = $total_protein;
            $haem->albumin          = $albumin;
            $haem->total_acid_phosphate  = $total_acid_phosphate;
            $haem->prostatic_acid_phosphate  = $prostatic_acid_phosphate;
            $haem->cpk          = $cpk;
            $haem->ckmb         = $ckmb;
            $haem->ldh          = $ldh;
            $haem->amylase      = $amylase;
            $haem->total_cholesterol        = $total_cholesterol;
            $haem->triglycerides        = $triglycerides;
            $haem->hdl_cholesterol       = $hdl_cholesterol;
            $haem->ldl_cholesterol       = $ldl_cholesterol;
            $haem->fasting_glucose      = $fasting_glucose;
            $haem->glucose_2hpp         = $glucose_2hpp;
            $haem->random_glucose       = $random_glucose;
            $haem->glycated_haemoglobin       = $glycated_haemoglobin;
            $haem->phosphorus                = $phosphorus;
            $haem->lithium                  = $lithium;
            $haem->globulin                 = $globulin;
            $haem->protein                  = $protein;
            $haem->glucose                  = $glucose;
            $haem->tibc                     = $tibc;
            $haem->g6pd                     = $g6pd;
            $haem->lipase                   = $lipase;
            $haem->others       = $others;
            $haem->modified_by = $user->full_name();
            $haem->date_modify = strftime("%Y-%m-%d %H:%M:%S", time());
            $haem->date          = strftime("%Y-%m-%d %H:%M:%S", time());

            $json2 = json_encode($haem);

            $haematology->rangeValue = $json2;
            $haematology->save();
        }

//        return print_r($refs->sodium);
        //redirect_to(e_result . "/results/haem_res.php?id=$result->id");
        $done = true;
        redirect_to("home.php");



    }
}




require('../layout/header.php');
?>

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> User Management</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo emr_lucid ?>/home.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Reference Range</li>
                        <li class="breadcrumb-item active">Reference Range</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">

                    <div class="body">
<!--                        <a href="records_users.php" style="font-size: large">&laquo; Back</a>-->

                        <form action="" method="post">
                            <div class="row">
                                <?php
                                $dept = "Chemical Pathology";

                                $haematologies         = ReferenceRange::find_by_dept($dept);

                                foreach ($haematologies as $haematology){
                                    $ref = json_decode($haematology->rangeValue);
                                }
                                ?>
                                <div class="col-sm-3">
                                    <label>Sodium</label>
                                    <input type="text" class="form-control" name="sodium" id="sodium" value="<?php echo $ref->sodium ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>Potassium</label>
                                    <input type="text" class="form-control" name="potassium" id="potassium" value="<?php echo $ref->potassium ?>">
                                </div>


                                <div class="col-sm-3">
                                    <label>Chloride</label>
                                    <input type="text" class="form-control" name="chloride" id="chloride" value="<?php echo $ref->chloride ?>">
                                </div>


                                <div class="col-sm-3">
                                    <label>Bicarbonate</label>
                                    <input type="text" class="form-control" name="bicarbonate" id="bicarbonate" value="<?php echo $ref->bicarbonate ?>">
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-sm-3">
                                    <label>Urea</label>
                                    <input type="text" class="form-control" name="urea" id="urea" value="<?php echo $ref->urea ?>">
                                </div>


                                <div class="col-sm-3">
                                    <label>Creatinine</label>
                                    <input type="text" class="form-control" name="creatinine" id="creatinine" value="<?php echo $ref->creatinine ?>">
                                </div>


                                <div class="col-sm-3">
                                    <label>Uric Acid</label>
                                    <input type="text" class="form-control" name="uric_acid" id="uric_acid" value="<?php echo $ref->uric_acid ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>Calcium</label>
                                    <input type="text" class="form-control" name="calcium" id="calcium" value="<?php echo $ref->calcium ?>">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Ionized Calcium</label>
                                    <input type="text" class="form-control" name="ionized_calcium" id="ionized_calcium" value="<?php echo $ref->ionized_calcium ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>Inorganic Phos</label>
                                    <input type="text" class="form-control" name="inorganic_phos" id="inorganic_phos" value="<?php echo $ref->inorganic_phos ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>Total Bilirubin</label>
                                    <input type="text" class="form-control" name="total_bilirubin" id="total_bilirubin" value="<?php echo $ref->total_bilirubin ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>Conj Bilirubin</label>
                                    <input type="text" class="form-control" name="conj_bilirubin" id="conj_bilirubin" value="<?php echo $ref->conj_bilirubin ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <label>ALK Phosphate</label>
                                    <input type="text" class="form-control" name="alk_phosphate" id="alk_phosphate" value="<?php echo $ref->alk_phosphate ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>AST. (SGOT)</label>
                                    <input type="text" class="form-control" name="ast_sgot" id="ast_sgot" value="<?php echo $ref->ast_sgot ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>ALT. (SGPT)</label>
                                    <input type="text" class="form-control" name="alt_sgpt" id="alt_sgpt" value="<?php echo $ref->alt_sgpt ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>Gamma-GT</label>
                                    <input type="text" class="form-control" name="gamma_gt" id="gamma_gt" value="<?php echo $ref->gamma_gt ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Total Protein</label>
                                    <input type="text" class="form-control" name="total_protein" id="total_protein" value="<?php echo $ref->total_protein ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>Albumin</label>
                                    <input type="text" class="form-control" name="albumin" id="albumin" value="<?php echo $ref->albumin ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>Total Acid Phosphate</label>
                                    <input type="text" class="form-control" name="total_acid_phosphate" id="total_acid_phosphate" value="<?php echo $ref->total_acid_phosphate ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>Prostatic Acid Phosphate</label>
                                    <input type="text" class="form-control" name="prostatic_acid_phosphate" id="prostatic_acid_phosphate" value="<?php echo $ref->prostatic_acid_phosphate ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <label>CPK</label>
                                    <input type="text" class="form-control" name="cpk" id="cpk" value="<?php echo $ref->cpk ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>CKMB</label>
                                    <input type="text" class="form-control" name="ckmb" id="ckmb" value="<?php echo $ref->ckmb ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>LDH</label>
                                    <input type="text" class="form-control" name="ldh" id="ldh" value="<?php echo $ref->ldh ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>Amylase</label>
                                    <input type="text" class="form-control" name="amylase" id="amylase" value="<?php echo $ref->amylase ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Total Cholesterol</label>
                                    <input type="text" class="form-control" name="total_cholesterol" id="total_cholesterol" value="<?php echo $ref->total_cholesterol ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>Triglycerides</label>
                                    <input type="text" class="form-control" name="triglycerides" id="triglycerides" value="<?php echo $ref->triglycerides ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>HDL Cholesterol</label>
                                    <input type="text" class="form-control" name="hdl_cholesterol" id="hdl_cholesterol" value="<?php echo $ref->hdl_cholesterol ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>LDL Cholesterol</label>
                                    <input type="text" class="form-control" name="ldl_cholesterol" id="ldl_cholesterol" value="<?php echo $ref->ldl_cholesterol ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Fasting Glucose</label>
                                    <input type="text" class="form-control" name="fasting_glucose" id="fasting_glucose" value="<?php echo $ref->fasting_glucose ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>Glucose (2HPP)</label>
                                    <input type="text" class="form-control" name="glucose_2hpp" id="glucose_2hpp" value="<?php echo $ref->glucose_2hpp ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>Random Glucose</label>
                                    <input type="text" class="form-control" name="random_glucose" id="random_glucose" value="<?php echo $ref->random_glucose ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>Glycated Haemoglobin(hbA)</label>
                                    <input type="text" class="form-control" name="glycated_haemoglobin" id="glycated_haemoglobin" value="<?php echo $ref->glycated_haemoglobin ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Lithium</label>
                                    <input type="text" class="form-control" name="lithium" id="lithium" value="<?php echo $ref->lithium ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>Globulin</label>
                                    <input type="text" class="form-control" name="globulin" id="globulin" value="<?php echo $ref->globulin ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>Protein</label>
                                    <input type="text" class="form-control" name="protein" id="protein" value="<?php echo $ref->protein ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>Glucose</label>
                                    <input type="text" class="form-control" name="glucose" id="glucose" value="<?php echo $ref->glucose ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Phosphorus</label>
                                    <input type="text" class="form-control" name="phosphorus" id="phosphorus" value="<?php echo $ref->phosphorus ?>">
                                </div>

                                <div class="col-sm-3">
                                    <label>TIBC</label>
                                    <input type="text" class="form-control" name="tibc" id="tibc" value="<?php echo $ref->tibc ?>">
                                </div>

                                <div class="col-sm-2">
                                    <label>G6PD</label>
                                    <input type="text" class="form-control" name="g6pd" id="g6pd" value="<?php echo $ref->g6pd ?>">
                                </div>

                                <div class="col-sm-2">
                                    <label>Lipase</label>
                                    <input type="text" class="form-control" name="lipase" id="lipase" value="<?php echo $ref->lipase ?>">
                                </div>

                                <div class="col-sm-2">
                                    <label>Others</label>
                                    <input type="text" class="form-control" name="others" id="others" value="<?php echo $ref->others ?>">
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-dark">Update</button>
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
?>










