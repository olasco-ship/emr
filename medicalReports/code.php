<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

if  (isset($_POST['submit_pilg_btn'])){//(is_post()){


    //require('../layout/header.php');


    $name                   = $_POST['patient_name'];
    $xray                   = $_POST['xray'];
    $electrocardiogram      = $_POST['electrocardiogram'];
    $pcv                     = $_POST['pcv'];
    $bg                      = $_POST['bg'];
    $genotype                = $_POST['genotype'];
    $micro                    =$_POST['micro_para'];
    $urinary_protein        = $_POST['urinary_protein'];
    $urinary_glucose        = $_POST['urinary_glucose'];
    $visual                 = $_POST['visual'];
    $allergy                = $_POST['allergy'];
    $code                   = $_POST['code_no'];


    $pilgrimage                = new StdClass();
    $pilgrimage->xray          = $xray;
    $pilgrimage->electrocardiogram  = $electrocardiogram;
    $pilgrimage->pcv            = $pcv;
    $pilgrimage->bg              = $bg;
    $pilgrimage->genotype        =$genotype;
    $pilgrimage->micro         = $micro;
    $pilgrimage->urinary_protein = $urinary_protein;
    $pilgrimage->urinary_glucose = $urinary_glucose;
    $pilgrimage->visual        = $visual;
    $pilgrimage->allergy           = $allergy;
    $pilgrimage->code          = $code;

    $medical                = new MedicalReports();
    $medical->sync          = "off";
    $medical->patient_id    = $name;
    $medical->result        = json_encode($pilgrimage);
    $medical->doctor        = $user->full_name();
    $medical->date          = strftime("%Y-%m-%d %H:%M:%S", time());
    $medical->save();

        redirect_to("printmedReports.php?id=$medical->id");

   // $session->message("Successfully Updated");

  // redirect_to("pilgrimage.php");


}


if (isset($_POST['submit_licence_btn'])){


    $name                   = $_POST['patient_name'];
    $xray                   = $_POST['xray'];
    $pcv                     = $_POST['pcv'];
    $bg                      = $_POST['bg'];
    $genotype                = $_POST['genotype'];
    $visual                 = $_POST['visual'];
    $code                   = $_POST['code_no'];

    $pilgrimage                = new StdClass();
    $pilgrimage->xray          = $xray;
    $pilgrimage->pcv            = $pcv;
    $pilgrimage->bg              = $bg;
    $pilgrimage->genotype        =$genotype;
    $pilgrimage->visual        = $visual;
    $pilgrimage->code          = $code;

    $medical                = new MedicalReports();
    $medical->sync          = "off";
    $medical->patient_id    = $name;
    $medical->result        = json_encode($pilgrimage);
    $medical->doctor        = $user->full_name();
    $medical->date          = strftime("%Y-%m-%d %H:%M:%S", time());
    $medical->save();


       redirect_to("printmedReports.php?id=$medical->id");

   // $session->message("Successfully Updated");

   redirect_to("licence.php");

}


if (isset($_POST['submit_admis_btn'])){


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

 redirect_to("printmedReports.php?id=$medical->id");
        //$session->message("Successfully Updated");

  // redirect_to("admission.php");
}


if (isset($_POST['employ_submit_btn'])){



$name                   = $_POST['patient_name'];
    $xray                   = $_POST['xray'];
    $pcv                     = $_POST['pcv'];
    $bg                      = $_POST['bg'];
    $genotype                = $_POST['genotype'];
    $micro                    =$_POST['micro_para'];
    $urinary_protein        = $_POST['urinary_protein'];
    $urinary_glucose        = $_POST['urinary_glucose'];
    $preg_test             = $_POST['preg_test'];
    $hiv                   = $_POST['hiv'];
    $hepatitis_bsa        = $_POST['hepatitis_bsa'];
    $hepatitis            = $_POST['hepatitis'];
    $sputum                = $_POST['sputum'];
    $code                   = $_POST['code_no'];

    $pilgrimage                = new StdClass();
    $emp->xray                  = $xray;
    $emp->pcv                  = $pcv;
    $emp->bg                    = $bg;
    $emp->genotype              = $genotype;
    $emp->micro                  = $micro;
    $emp->urinary_protein        = $urinary_protein;
    $emp->urinary_glucose        = $urinary_glucose;
    $emp->preg_test               = $preg_test;
    $emp->hiv                    = $hiv;
    $emp->hepatitis_bsa         = $hepatitis_bsa;
    $emp->hepatitis             = $hepatitis;
    $emp->sputum                = $sputum;
    $emp->code                  = $code;

    $medical                = new MedicalReports();
    $medical->sync          = "off";
    $medical->patient_id    = $name;
    $medical->result        = json_encode($emp);
    $medical->doctor        = $user->full_name();
    $medical->date          = strftime("%Y-%m-%d %H:%M:%S", time());
    $medical->save();

   redirect_to("printmedReports.php?id=$medical->id");
        // $session->message("Successfully Updated");

   //redirect_to("employment.php");
}

if(isset($_POST['nysc_submit_btn'])){

 $name                   = $_POST['patient_name'];
   // $xray                   = $_POST['xray'];
    $pcv                     = $_POST['pcv'];
    $bg                      = $_POST['bg'];
    $genotype                = $_POST['genotype'];
    $micro                    =$_POST['micro_para'];
    $urinary_protein        = $_POST['urinary_protein'];
    $urinary_glucose        = $_POST['urinary_glucose'];
    $preg_test             = $_POST['preg_test'];
    $hiv                   = $_POST['hiv'];
    $hepatitis_bsa        = $_POST['hepatitis_bsa'];
     $hcv                 = $_POST['hcv'];
    $code                   = $_POST['code_no'];

    $nysc                = new StdClass();
    $nysc->xray                  = $xray;
    $nysc->pcv                  = $pcv;
    $nysc->bg                    = $bg;
    $nysc->genotype              = $genotype;
    $nysc->micro                  = $micro;
    $nysc->urinary_protein        = $urinary_protein;
    $nysc->urinary_glucose        = $urinary_glucose;
    $nysc->preg_test               = $preg_test;
    $nysc->hiv                    = $hiv;
    $nysc->hepatitis_bsa         = $hepatitis_bsa;
    $nysc->hcv                  = $hcv;
    $nysc->code                  = $code;

    $medical                = new MedicalReports();
    $medical->sync          = "off";
    $medical->patient_id    = $name;
    $medical->result        = json_encode($nysc);
    $medical->doctor        = $user->full_name();
    $medical->date          = strftime("%Y-%m-%d %H:%M:%S", time());
    $medical->save();

    // $session->message("Successfully Updated");

    redirect_to("printmedReports.php?id=$medical->id");

}

if(isset($_POST['travel_submit_btn'])){

 $name                   = $_POST['patient_name'];
    $xray                   = $_POST['xray'];
    $pcv                     = $_POST['pcv'];
    $wbc                   = $_POST['wbc'];
    $bg                      = $_POST['bg'];
    $genotype                = $_POST['genotype'];
    $micro                    =$_POST['micro_para'];
    $urinary_protein        = $_POST['urinary_protein'];
    $urinary_glucose        = $_POST['urinary_glucose'];
    $visual                 = $_POST['visual'];
    $vdrl                 = $_POST['vdrl'];
    $hiv                   = $_POST['hiv'];
    $hepatitis_bsa        = $_POST['hepatitis_bsa'];
    $hcv                   = $_POST['hcv'];
    $gene                  = $_POST['gene'];
    $code                   = $_POST['code_no'];

    $travreport                = new StdClass();
    $travreport->xray                  = $xray;
    $travreport->pcv                  = $pcv;
    $travreport->bg                    = $bg;
    $travreport->genotype              = $genotype;
    $travreport->micro                  = $micro;
    $travreport->urinary_protein        = $urinary_protein;
    $travreport->urinary_glucose        = $urinary_glucose;
    $travreport->preg_test               = $preg_test;
    $travreport->hiv                    = $hiv;
    $travreport->hepatitis_bsa         = $hepatitis_bsa;
    $travreport->hcv                   = $hcv;
    $travreport->gene                = $gene;
    $travreport->code                  = $code;

    $medical                = new MedicalReports();
    $medical->sync          = "off";
    $medical->patient_id    = $name;
    $medical->result        = json_encode($travreport);
    $medical->doctor        = $user->full_name();
    $medical->date          = strftime("%Y-%m-%d %H:%M:%S", time());
    $medical->save();

 redirect_to("print_medReport.php?id=$medical->id");
    // $session->message("Successfully Updated");

   //redirect_to("travelling.php");

}


if (isset($_POST['stu_submit_btn'])){

    $name                   = $_POST['patient_name'];
    $xray                   = $_POST['xray'];
    $pcv                     = $_POST['pcv'];
    $wbc                     = $_POST['wbc'];
    $bg                      = $_POST['bg'];
    $genotype                = $_POST['genotype'];
    $micro                    =$_POST['micro_para'];
    $urinary_protein        = $_POST['urinary_protein'];
    $urinary_glucose        = $_POST['urinary_glucose'];
    $preg_test             = $_POST['preg_test'];
    $hiv                   = $_POST['hiv'];
    $hepatitis_bsa        = $_POST['hepatitis_bsa'];
    $code                   = $_POST['code_no'];

    $nysc                = new StdClass();
    $nysc->xray                  = $xray;
    $nysc->pcv                  = $pcv;
    $nysc->bg                    = $bg;
    $nysc->genotype              = $genotype;
    $nysc->micro                  = $micro;
    $nysc->urinary_protein        = $urinary_protein;
    $nysc->urinary_glucose        = $urinary_glucose;
    $nysc->preg_test               = $preg_test;
    $nysc->hiv                    = $hiv;
    $nysc->hepatitis_bsa         = $hepatitis_bsa;
    $nysc->code                  = $code;

    $medical                = new MedicalReports();
    $medical->sync          = "off";
    $medical->patient_id    = $name;
    $medical->result        = json_encode($nysc);
    $medical->doctor        = $user->full_name();
    $medical->date          = strftime("%Y-%m-%d %H:%M:%S", time());
    $medical->save();

    redirect_to("print_medReport.php?id=$medical->id");

}


//if(isset($_POST['']))


?>






<?php
require('../layout/footer.php');
