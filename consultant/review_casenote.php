<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 5/24/2019
 * Time: 9:19 AM
 */

require_once "../includes/initialize.php";






$waiting_list = WaitingList::find_by_id($_GET['id']);
$patient      = Patient::find_by_id($waiting_list->patient_id);
$user         = User::find_by_id($session->user_id);


if (is_post()) {

    $waiting_list = WaitingList::find_by_id($_GET['id']);
    $patient = Patient::find_by_id($waiting_list->patient_id);

    $category = $_POST['examination_cat_id'];
    $symptoms = $_POST['examination_id'];
    $gen_exam = $_POST['general'];
    $exam_state = $_POST['exam_state'];


    $new_array = array();
    for ($x = 0; $x < count($category); $x++) {
        $new_array[$x] = array(
            "examination" => $category[$x],
            'symptoms' => $symptoms[$x]
        );
    }

    $new_array2 = array();
    for ($x = 0; $x < count($gen_exam); $x++) {
        $new_array2[$x] = array(
            "general" => $gen_exam[$x],
            'condition' => $exam_state[$x]
        );
    }

    $pre_hb         = $_POST['pre_hb'];
    $ope_date       = $_POST['ope_date'];
    $ope_gn         = $_POST['ope_gn'];
    $ope_bg         = $_POST['ope_bg'];
    $lab_refNo      = $_POST['lab_refNo'];
    $ope_bc         = $_POST['ope_bc'];
    $xray_refNo     = $_POST['xray_refNo'];
    $allergy        = $_POST['allergy'];
    $prev_drugHistory = $_POST['prev_drugHistory'];
    $operationPro   = $_POST['operationPro'];
    $ope_indication = $_POST['ope_indication'];
    $emergencyElective = $_POST['emergencyElective'];
    $pdoo           = $_POST['pdoo'];
    $consentGiven   = $_POST['consentGiven'];
    $hos            = $_POST['hos'];
    $opePerformed   = $_POST['opePeformed'];
    $opd            = $_POST['opd'];
    $surgeon        = $_POST['surgeon'];
    $scrubNurse     = $_POST['scrubNurse'];
    $assistants     = $_POST['assistants'];
    $cNurse         = $_POST['cNurse'];
    $anaesthetist   = $_POST['anaesthetist'];
    $anaestheticType = $_POST['anaestheticType'];
    $incision       = $_POST['incision'];
    $findings       = $_POST['findings'];
    $procedure      = $_POST['procedure'];
    $closure        = $_POST['closure'];
    $tornTime       = $_POST['torniquetTime'];
    $smu            = $_POST['smu'];
    $drains         = $_POST['drains'];
    $packs          = $_POST['packs'];
    $specimens      = $_POST['specimens'];
    $swabCount      = $_POST['swabCount'];
    $bloodLoss      = $_POST['bloodLoss'];
    $poi            = $_POST['poi'];

    $surgery                            = new StdClass();
    $surgery->preoperative_hb           = $pre_hb;
    $surgery->preoperative_date         = $ope_date;
    $surgery->Genotype                  = $ope_gn;
    $surgery->BloodGroup                = $ope_bg;
    $surgery->LabRefNo                  = $lab_refNo;
    $surgery->XrayRefNo                 = $xray_refNo;
    $surgery->bloodCrossmatched         = $ope_bc;
    $surgery->Allergy                   = $allergy;
    $surgery->previousDrugHistory       = $prev_drugHistory;
    $surgery->operationProposed         = $operationPro;
    $surgery->IndicationForOperation    = $ope_indication;
    $surgery->EmergencyElective         = $emergencyElective;
    $surgery->ProposedDateOfOperation   = $pdoo;
    $surgery->consentGiven              = $consentGiven;
    $surgery->houseOfficer              = $hos;
    $surgery->operationPerformed        = $opePerformed;
    $surgery->operationPerformedDate    = $opd;
    $surgery->surgeon                   = $surgeon;
    $surgery->scrubNurse                = $scrubNurse;
    $surgery->assistants                = $assistants;
    $surgery->circulatingNurse          = $cNurse;
    $surgery->anaesthetist              = $anaesthetist;
    $surgery->anaestheticType           = $anaestheticType;
    $surgery->incision                  = $incision;
    $surgery->findings                  = $findings;
    $surgery->procedure                 = $procedure;
    $surgery->closure                   = $closure;
    $surgery->torniquetTime             = $tornTime;
    $surgery->sutureMaterialUsed        = $smu;
    $surgery->drains                    = $drains;
    $surgery->packs                     = $packs;
    $surgery->specimens                 = $specimens;
    $surgery->swabCount                 = $swabCount;
    $surgery->bloodLoss                 = $bloodLoss;
    $surgery->postOperativeInstruction  = $poi;

    $pcv                                = $_POST['pcv'];
    $hb                                 = $_POST['hb'];
    $anaesthesiaUrine                   = $_POST['anaesthesiaUrine'];
    $asaStatus                          = $_POST['asaStatus'];
    $hxInx                              = $_POST['hxInx'];
    $hbgn                               = $_POST['hbgn'];
    $premedications                     = $_POST['premedications'];
    $timeGiven                          = $_POST['timeGiven'];
    $dentition                          = $_POST['dentition'];
    $oral                               = $_POST['oral'];
    $prev_anaestheticsYes               = $_POST['Yes'];
    $prev_anaestheticsNo                = $_POST['No'];
    $complications                      = $_POST['complications'];
    $intubationYes                      = $_POST['intubationYes'];
    $intubationNo                       = $_POST['intubationNo'];
    $mallampati                         = $_POST['mallampati'];
    $ana_comment                        = $_POST['ana_comment'];
    $smokerYes                          = $_POST['smokerYes'];
    $smokerNo                           = $_POST['smokerNo'];
    $lmp                                = $_POST['lmp'];
    $parity                             = $_POST['parity'];
    $gest                               = $_POST['gest'];
    $rxn                                = $_POST['rxn'];
    $eucr                               = $_POST['eucr'];
    $hrbpm                              = $_POST['hrbpm'];
    $bpmmhg                             = $_POST['bpmmhg'];
    $temp                               = $_POST['temp'];
    $seenBy                             = $_POST['seenBy'];
    $d_time                             = $_POST['d_time'];
    $intra_hrbpm                        = $_POST['intra_hrbpm'];
    $nibpmmhg                           = $_POST['nibpmmhg'];
    $sao                                = $_POST['sao'];
    $intra_temp                         = $_POST['intra_temp'];
    $facemaskYes                        = $_POST['facemaskYes'];
    $facemaskNo                         = $_POST['facemaskNo'];
    $facemaskSize                       = $_POST['facemaskSize'];
    $oralYes                            = $_POST['oralYes'];
    $oralNo                             = $_POST['oralNo'];
    $oralSize                           = $_POST['oralSize'];
    $nasalYes                           = $_POST['nasalYes'];
    $nasalNo                            = $_POST['nasalNo'];
    $nasalSize                          = $_POST['nasalSize'];
    $lmaYes                             = $_POST['lmaYes'];
    $lmaNo                              = $_POST['lmaNo'];
    $lmaSize                            = $_POST['lmaSize'];
    $easy                               = $_POST['easy'];
    $difficult                          = $_POST['difficult'];
    $inductionTime                      = $_POST['inductionTime'];
    $halo                               = $_POST['halo'];
    $sevo                               = $_POST['sevo'];
    $isofiu                             = $_POST['isofiu'];
    $conc                               = $_POST['conc'];
    $suxamethoniun                      = $_POST['suxamethoniun'];
    $others                             = $_POST['others'];
    $intubatYes                         = $_POST['intubatYes'];
    $intubatNo                          = $_POST['intubatNo'];
    $intubationOral                     = $_POST['intubationOral'];
    $intubationNasal                    = $_POST['intubationNasal'];
    $intubationTracheostomy             = $_POST['intubationTracheostomy'];
    $singleLumen                        = $_POST['singleLumen'];
    $doubleLumen                        = $_POST['doubleLumen'];
    $intubationSize                     = $_POST['intubationSize'];
    $intubationType                     = $_POST['intubationType'];
    $cuff                               = $_POST['cuff'];
    $unCuff                             = $_POST['unCuff'];
    $pre02                              = $_POST['pre02'];
    $humidification                     = $_POST['humidification'];
    $rapidSequence                      = $_POST['rapidSequence'];
    $ngTube                             = $_POST['ngTube'];
    $fibreoptic                         = $_POST['fibreoptic'];
    $bougie                             = $_POST['bougie'];
    $laryngoscopy                       = $_POST['laryngoscopy'];
    $successful                         = $_POST['successful'];
    $failed                             = $_POST['failed'];
    $laryngoscopist                     = $_POST['laryngoscopist'];
    $halothane                          = $_POST['halothene'];
    $isoflurance                        = $_POST['isoflurance'];
    $sevoflurance                       = $_POST['sevoflurance'];
    $desflurance                        = $_POST['desflurance'];
    $n2O                                = $_POST['n2O'];
    $air                                = $_POST['Air'];
    $analgesiaDrug                      = $_POST['analgesiaDrug'];
    $analgesiaDose                      = $_POST['analgesiaDose'];
    $tivaDrug                           = $_POST['tivaDrug'];
    $infusionRate                       = $_POST['infusionRate'];
    $spontaneous                        = $_POST['spontaneous'];
    $manual                             = $_POST['manual'];
    $ventilator                         = $_POST['ventilator'];
    $circle                             = $_POST['circle'];
    $semiClosed                         = $_POST['semiClosed'];
    $bains                              = $_POST['bains'];
    $lack                               = $_POST['lack'];
    $magills                            = $_POST['magills'];
    $infantsTPiece                      = $_POST['infantsTPiece'];
    $water                              = $_POST['water'];
    $monitoringECG                      = $_POST['monitoringECG'];
    $monitoringNIBP                     = $_POST['monitoringNIBP'];
    $monitoringSa02                     = $_POST['monitoringSa02'];
    $monitoringErc02                    = $_POST['monitoringErc02'];
    $monitoringTemp                     = $_POST['monitoringTemp'];
    $precordialStethoscope              = $_POST['precordialStethoscope'];
    $inhAgent                           = $_POST['inhAgent'];
    $muscleRelexantAgent                = $_POST['muscleRelaxantAgent'];
    $muscleRelexantDose                 = $_POST['muscleRelaxantDose'];
    $reversal                           = $_POST['reversal'];
    $reversalDose                       = $_POST['reversalDose'];
    $directArterialBP                   = $_POST['directArterialBP'];
    $cvp                                = $_POST['cvp'];
    $pappcwp                            = $_POST['pappcwp'];
    $invasiveOthers                     = $_POST['invasiveOthers'];
    $line1                              = $_POST['line1'];
    $site1                              = $_POST['site1'];
    $size1                              = $_POST['size1'];
    $line2                              = $_POST['line2'];
    $site2                              = $_POST['site2'];
    $size2                              = $_POST['size2'];
    $spinal                             = $_POST['spinal'];
    $epidural                           = $_POST['epidural'];
    $cse                                = $_POST['cse'];
    $infiltration                       = $_POST['infiltration'];
    $position                           = $_POST['position'];
    $regionalSite                       = $_POST['regionalSite'];
    $needleSize                         = $_POST['needleSize'];
    $regionalDrug                       = $_POST['regionalDrug'];
    $regionalDose                       = $_POST['regionalDose'];
    $complete                           = $_POST['complete'];
    $patchy                             = $_POST['patchy'];
    $qualityFailed                      = $_POST['qualityFailed'];
    $blockHeight                        = $_POST['qualityHeight'];
    $performedBy                        = $_POST['performedBy'];
    $operationPer                       = $_POST['operationPer'];
    $criticalIncidences                 = $_POST['criticalIncidences'];
    $colloid                            = $_POST['colloid'];
    $crystalloid                        = $_POST['crystalloid'];
    $bloodTransfused                    = $_POST['bloodTransfused'];
    $suctionBottle                      = $_POST['suctionBottle'];
    $spogesDrape                        = $_POST['spogesDrape'];
    $floor                              = $_POST['floor'];
    $bloodLossTotal                     = $_POST['bloodLossTotal'];
    $satisfactory                       = $_POST['satisfactory'];
    $unsatisfactory                     = $_POST['unsatisfactory'];
    $transferIcu                        = $_POST['transferIcu'];
    $posthr                             = $_POST['posthr'];
    $post_bp                            = $_POST['post_bp'];
    $post_sao2                          = $_POST['post_sao2'];
    $post_temp                          = $_POST['post_temp'];
    $etco2                              = $_POST['etco2'];
    $timeDelivered                      = $_POST['timeDelivered'];
    $post_remark                        = $_POST['post_remark'];
    $emergencySatisfactory              = $_POST['emergencySatisfactory'];
    $emergencyUnsatisfactory            = $_POST['emergencyUnsatisfactory'];
    $ett                                = $_POST['ett'];
    $why                                = $_POST['why'];
    $reintubationTheatre                = $_POST['reintubationTheatre'];
    $vocalCords                         = $_POST['vocalCords'];

    $anaesthesia                        = new StdClass();
    $anaesthesia->pcv                   = $pcv;
    $anaesthesia->hb                    = $hb;
    $anaesthesia->urinalysis            = $anaesthesiaUrine;
    $anaesthesia->hxExamInx             = $hxInx;
    $anaesthesia->hbgenotype            = $hbgn;
    $anaesthesia->premedication         = $premedications;
    $anaesthesia->timeGiven             = $timeGiven;
    $anaesthesia->dentition             = $dentition;
    $anaesthesia->lastPerOral           = $oral;
    $anaesthesia->prevAnaestheticYes    = $prev_anaestheticsYes;
    $anaesthesia->prevAnaestheticNo     = $prev_anaestheticsNo;
    $anaesthesia->complications         = $complications;
    $anaesthesia->intubationYes         = $intubationYes;
    $anaesthesia->intubationNo          = $intubationNo;
    $anaesthesia->mallampati            = $mallampati;
    $anaesthesia->intubationComment     = $ana_comment;
    $anaesthesia->smokerYes             = $smokerYes;
    $anaesthesia->smokerNo              = $smokerNo;
    $anaesthesia->lmp                   = $lmp;
    $anaesthesia->parity                = $parity;
    $anaesthesia->gestAge               = $gest;
    $anaesthesia->rxn                   = $rxn;
    $anaesthesia->eucr                  = $eucr;
    $anaesthesia->hrbmp                 = $hrbpm;
    $anaesthesia->bpmmhg                = $bpmmhg;
    $anaesthesia->temp                  = $temp;
    $anaesthesia->seenBy                = $seenBy;
    $anaesthesia->dTime                 = $d_time;
    $anaesthesia->intra_hr              = $intra_hrbpm;
    $anaesthesia->nibp                  = $nibpmmhg;
    $anaesthesia->sao                   = $sao;
    $anaesthesia->intra_temp            = $intra_temp;
    $anaesthesia->facemaskYes           = $facemaskYes;
    $anaesthesia->facemaskNo            = $facemaskNo;
    $anaesthesia->facemaskSize          = $facemaskSize;
    $anaesthesia->oralYes               = $oralYes;
    $anaesthesia->oralNo                = $oralNo;
    $anaesthesia->oralSize              = $oralSize;
    $anaesthesia->nasalYes              = $nasalYes;
    $anaesthesia->nasalNo               = $nasalNo;
    $anaesthesia->nasalSize             = $nasalSize;
    $anaesthesia->lmaYes                = $lmaYes;
    $anaesthesia->lmaNo                 = $lmaNo;
    $anaesthesia->lmaSize               = $lmaSize;
    $anaesthesia->easy                  = $easy;
    $anaesthesia->difficult             = $difficult;
    $anaesthesia->inductionTime         = $inductionTime;
    $anaesthesia->halo                  = $halo;
    $anaesthesia->sevo                  = $sevo;
    $anaesthesia->isofiu                = $isofiu;
    $anaesthesia->conc                  = $conc;
    $anaesthesia->suxamethonuin         = $suxamethoniun;
    $anaesthesia->inductionOthers       = $others;
    $anaesthesia->intubatYes            = $intubatYes;
    $anaesthesia->intubatNo             = $intubatNo;
    $anaesthesia->intubationOral        = $intubationOral;
    $anaesthesia->intubationNasal       = $intubationNasal;
    $anaesthesia->intubationTracheostomy= $intubationTracheostomy;
    $anaesthesia->singleLumen           = $singleLumen;
    $anaesthesia->doubleLumen           = $doubleLumen;
    $anaesthesia->intubationSize        = $intubationSize;
    $anaesthesia->intubationType        = $intubationType;
    $anaesthesia->cuff                  = $cuff;
    $anaesthesia->uncuff                = $unCuff;
    $anaesthesia->pre02                 = $pre02;
    $anaesthesia->humidification        = $humidification;
    $anaesthesia->rapidSequence         = $rapidSequence;
    $anaesthesia->ngTube                = $ngTube;
    $anaesthesia->fibreOptic            = $fibreoptic;
    $anaesthesia->bougie                = $bougie;
    $anaesthesia->laryngoscopy          = $laryngoscopy;
    $anaesthesia->successful            = $successful;
    $anaesthesia->failed                = $failed;
    $anaesthesia->laryngoscopist        = $laryngoscopist;
    $anaesthesia->halothane             = $halothane;
    $anaesthesia->isoflurane            = $isoflurance;
    $anaesthesia->sevoflurane           = $sevoflurance;
    $anaesthesia->desflurane            = $desflurance;
    $anaesthesia->n20                   = $n20;
    $anaesthesia->air                   = $air;
    $anaesthesia->analgesiaDrug         = $analgesiaDrug;
    $anaesthesia->analgesiaDose         = $analgesiaDose;
    $anaesthesia->tivaDrug              = $tivaDrug;
    $anaesthesia->infusionRate          = $infusionRate;
    $anaesthesia->spontaneous           = $spontaneous;
    $anaesthesia->manual                = $manual;
    $anaesthesia->ventilator            = $ventilator;
    $anaesthesia->circle                = $circle;
    $anaesthesia->semiClosed            = $semiClosed;
    $anaesthesia->Bains                 = $bains;
    $anaesthesia->lack                  = $lack;
    $anaesthesia->magills               = $magills;
    $anaesthesia->infants               = $infantsTPiece;
    $anaesthesia->waters                = $water;
    $anaesthesia->ecg                   = $monitoringECG;
    $anaesthesia->monNIBP               = $monitoringNIBP;
    $anaesthesia->sa02                  = $monitoringSa02;
    $anaesthesia->erc02                 = $monitoringErc02;
    $anaesthesia->monTemp               = $monitoringTemp;
    $anaesthesia->precordialStethoscope = $precordialStethoscope;
    $anaesthesia->inhagent              = $inhAgent;
    $anaesthesia->muscleRelaxantAgent   = $muscleRelexantDose;
    $anaesthesia->muscleRelaxantDose    = $muscleRelexantDose;
    $anaesthesia->reversal              = $reversal;
    $anaesthesia->reversalDose          = $reversalDose;
    $anaesthesia->directArterial        = $directArterialBP;
    $anaesthesia->cvp                   = $cvp;
    $anaesthesia->pappcwp               = $pappcwp;
    $anaesthesia->line1                 = $line1;
    $anaesthesia->site1                 = $site1;
    $anaesthesia->size1                 = $size1;
    $anaesthesia->line2                 = $line2;
    $anaesthesia->site2                 = $site2;
    $anaesthesia->size2                 = $size2;
    $anaesthesia->spinal                = $spinal;
    $anaesthesia->epidural              = $epidural;
    $anaesthesia->cse                   = $cse;
    $anaesthesia->infiltration          = $infiltration;
    $anaesthesia->others                = $others;
    $anaesthesia->position              = $position;
    $anaesthesia->regionalSite          = $regionalSite;
    $anaesthesia->needleSize            = $needleSize;
    $anaesthesia->regionalDrug          = $regionalDrug;
    $anaesthesia->regionalDose          = $regionalDose;
    $anaesthesia->complete              = $complete;
    $anaesthesia->patchy                = $patchy;
    $anaesthesia->blockHeight           = $blockHeight;
    $anaesthesia->performedBy           = $performedBy;
    $anaesthesia->criticalIncidences    = $criticalIncidences;
    $anaesthesia->colloid               = $colloid;
    $anaesthesia->crystalloid           = $crystalloid;
    $anaesthesia->bloodTranfused        = $bloodTransfused;
    $anaesthesia->suctionBottle         = $suctionBottle;
    $anaesthesia->spogesDrapes          = $spogesDrape;
    $anaesthesia->floor                 = $floor;
    $anaesthesia->bloodTotal            = $bloodLossTotal;
    $anaesthesia->satisfactory          = $satisfactory;
    $anaesthesia->unsatisfactory        = $unsatisfactory;
    $anaesthesia->icu                   = $transferIcu;
    $anaesthesia->posthr                = $posthr;
    $anaesthesia->post_bp               = $post_bp;
    $anaesthesia->post_sa02             = $post_sao2;
    $anaesthesia->post_temp             = $post_temp;
    $anaesthesia->etc02                 = $etco2;
    $anaesthesia->timeDelivered         = $timeDelivered;
    $anaesthesia->remarks               = $post_remark;
    $anaesthesia->emergencySatisfactory = $emergencySatisfactory;
    $anaesthesia->emergencyUnSatisfactory = $emergencyUnsatisfactory;
    $anaesthesia->ett                   = $ett;
    $anaesthesia->why                   = $why;
    $anaesthesia->reIntubationTheatre   = $reintubationTheatre;
    $anaesthesia->comments              = $vocalCords;


    $caseNote                           = CaseNote::find_open_case_note($waiting_list->id, $patient->id);
    $caseNote->sync                     = "off";
    $caseNote->patient_id               = $patient->id;
    $caseNote->waiting_list_id          = $waiting_list->id;
    $caseNote->ref_adm_id               = 0;
    $caseNote->sub_clinic_id            = $waiting_list->sub_clinic_id;
    $caseNote->complains                = json_encode($_POST['complain']);
    $caseNote->hpc                      = $_POST['hpc'];
    $caseNote->family_history           = $_POST['family_history'];
    $caseNote->personal_history         = $_POST['personal_history'];
    $caseNote->mental_state             = $_POST['mental_state'];
    $caseNote->duration                 = json_encode($_POST['complain_duration']);
    $caseNote->past_history             = $_POST['past_med_history'];
    $caseNote->immune_history           = $_POST['immune_history'];
    $caseNote->nutri_history            = $_POST['nutri_history'];
    $caseNote->dev_history              = $_POST['dev_history'];
    $caseNote->soc_history              = $_POST['soc_history'];
    $caseNote->sys_review               = $_POST['system_review'];
    $caseNote->examination              = json_encode($new_array2);
    $caseNote->systemic_examination     = json_encode($new_array);
    $caseNote->diagnosis                = json_encode($_POST['diagnosis']);
    $caseNote->differentials            = json_encode($_POST['differentials']);
    $caseNote->note                     = $_POST['examNote'];
    $dept = "SOPD";
    $userDept = Clinic::find_by_name($dept);
    foreach ($userDept as $depts){
        $userSubClinic = UserSubClinic::find_by_user_clinic_id($user->id, $depts->id);
    }
    if (!empty($userSubClinic)) {
        $caseNote->surgery = json_encode($surgery);
    }

    $clin = "ANAESTHESIA";
    $userDept = Clinic::find_by_name($dept);
    $userSub  = SubClinic::find_by_name($clin);
    foreach ($userSub as $sub){
    }
    foreach ($userDept as $depts){
        $userSubClin = UserSubClinic::find_by_user_clinic_and_subClinic_id($user->id, $depts->id, $sub->id);
    }
    if (!empty($userSubClin)) {
        $caseNote->anaesthesia = json_encode($anaesthesia);
    }

    $caseNote->consultant               = $user->full_name();
    $caseNote->status                   = "OPEN";
    $caseNote->date                     = strftime("%Y-%m-%d %H:%M:%S", time());
    $caseNote->save();
    $session->message("Patient's note has been updated!");

    redirect_to("dashboard.php?id=$waiting_list->id");

}




require '../layout/header.php';

?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        <?php echo "Medical Dashboard - " . $patient->title . " " . $patient->full_name(); ?>
                    </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Treatment</li>
                        <li class="breadcrumb-item active"> History</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">

                    <div class="body">


                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12">

                                <a href="dashboard.php?id=<?php echo $waiting_list->id ?>">Back</a>
                                <h5>REVIEW CASE NOTE</h5>
                                <?php
                                $case_note                           = CaseNote::find_open_case_note($waiting_list->id, $patient->id);
                                ?>

                                <form action="" method="post">


                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active" aria-current="page"><b><h4>PRESENTING
                                                        COMPLAIN</h4></b></li>
                                        </ol>
                                    </nav>

                                    <div class="form-group row">
                                        <div class="offset-sm-1 col-sm-3">
                                        </div>
                                        <div class="col-sm-5">
                                            <strong>COMPLAINS</strong>
                                            <input name="waitList_id" value="{{ $waitList->id }}" hidden>
                                        </div>
                                        <div class="col-sm-3">
                                            <strong>DURATION</strong>
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-1 col-sm-3">
                                            <label> Presenting Complain <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-5">
                                            <select class="form-control complain_label" id="complain"
                                                    name="complain[]" multiple="multiple">
                                                <?php
                                                $decode = json_decode($case_note->complains);
                                                foreach ($decode as $dec){
                                                ?>
                                                <option <?php echo ($dec) ? 'selected ="TRUE"' : ''; ?>value="<?php echo $dec ?>"><?php echo $dec ?></option>
                                                <?php
                                                }
                                                $complains = Complain::find_all();
                                                foreach($complains as $complain) {
                                                    ?>
                                                    <option value="<?php echo $complain->name ?>"><?php echo $complain->name ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <!--the method complain_label can be found in script.js-->
                                        <div class="col-sm-3">
                                            <select class="form-control complain_label" id="complain_duration"
                                                    name="complain_duration[]" multiple="multiple">
                                                <?php
                                                $decode = json_decode($case_note->duration);
                                                foreach ($decode as $dec){
                                                ?>
<!--                                                <option value="--><?php //echo $dec ?><!--">--><?php //echo $dec ?><!--</option>-->
                                                <option <?php echo ($dec == '2 Days') ? 'selected ="TRUE"' : ''; ?>value="2 Days">2 Days</option>
                                                <option <?php echo ($dec == '3 Days') ? 'selected ="TRUE"' : ''; ?>value="3 Days">3 Days</option>
                                                <option <?php echo ($dec == '1 Week') ? 'selected ="TRUE"' : ''; ?>value="1 Week">1 Week</option>
                                                <option <?php echo ($dec == '2 Weeks') ? 'selected ="TRUE"' : ''; ?>value="2 Weeks">2 Weeks</option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-1 col-sm-3">
                                            <label> History Of Complain <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-5">
                                            <textarea class="form-control" name="hpc"><?php echo $case_note->hpc ?></textarea>
                                        </div>
                                        <div class="col-sm-3">

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-1 col-sm-3">
                                            <label> Family History </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="family_history"><?php echo $case_note->family_history ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-1 col-sm-3">
                                            <label> Personal History </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="personal_history"><?php echo $case_note->personal_history ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-1 col-sm-3">
                                            <label> Mental State </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="mental_state"><?php echo $case_note->mental_state ?></textarea>
                                        </div>
                                    </div>

                                    <?php
                                    $dept = "PAEDIATRICS";
                                    $userDept = Clinic::find_by_name($dept);
                                    //                                                            print_r($userDept);
                                    foreach ($userDept as $depts){
                                        $userSubClinic = UserSubClinic::find_by_user_clinic_id($user->id, $depts->id);
                                    }
                                    if (!empty($userSubClinic)){
                                        ?>
                                        <div class="form-group row">
                                            <div class="offset-sm-1 col-sm-3">
                                                <label> Past Medical History </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="past_med_history"><?php echo $case_note->past_history ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-1 col-sm-3">
                                                <label> Immunization History </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="immune_history"><?php echo $case_note->immune_history ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-1 col-sm-3">
                                                <label> Nutritional History </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="nutri_history"><?php echo $case_note->nutri_history ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-1 col-sm-3">
                                                <label> Developmental History </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="dev_history"><?php echo $case_note->dev_history ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-1 col-sm-3">
                                                <label> Social History </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" name="soc_history"><?php echo $case_note->soc_history ?></textarea>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                    ?>

                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active" aria-current="page"><b><h4>SYSTEMIC
                                                        REVIEW</h4></b></li>
                                        </ol>
                                    </nav>
                                    <div class="form-group row">
                                        <div class="offset-sm-1 col-sm-3">
                                            <label> Systemic Review <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="system_review"><?php echo $case_note->sys_review ?></textarea>
                                        </div>
                                    </div>


                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active" aria-current="page"><b><h4>PHYSICAL
                                                        EXAMINATION</h4></b></li>

                                        </ol>
                                    </nav>

                                    <div class="form-group row" id="general">
                                        <div class="offset-sm-1 col-sm-3">
                                            <label> General Examination <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-4">
                                            <select class="form-control gen_exam" id="gen_exam"
                                                    name="general[]" multiple="multiple">
                                                <?php
                                                $exam_cat = "General Examination";
                                                $category = ExaminationCategory::find_by_name($exam_cat);
                                                $examinations = Examination::find_by_exam_cat_id($category->id);
                                                $decode = json_decode($case_note->examination);
                                                foreach ($decode as $dec){
                                                ?>
                                                <option <?php echo ($dec->general) ? 'selected ="TRUE"' : ''; ?>value="<?php echo $dec->general ?>"><?php echo $dec->general ?></option>
                                                <?php
                                                }
                                                    foreach($examinations as $examination) {
                                                    ?>
                                                    <option value="<?php echo $examination->name ?>"><?php echo $examination->name ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select name="exam_state[]" class="form-control exam_state" id="exam_state" multiple>
                                                <option <?php echo ($dec->condition == 'Normal') ? 'selected ="TRUE"' : ''; ?>value="Normal">Normal</option>
                                                <option <?php echo ($dec->condition == 'Mild') ? 'selected ="TRUE"' : ''; ?>value="Mild">Mild</option>
                                                <option <?php echo ($dec->condition == 'Severe') ? 'selected ="TRUE"' : ''; ?>value="Severe">Severe</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="systemic">
                                        <div class="offset-sm-1 col-sm-3">
                                            <label> Systemic Examination <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <select class="form-control gen_exam" id="examination_cat_id"
                                                    name="examination_cat_id[]" multiple="multiple">
                                                <?php
                                                $decode = json_decode($case_note->systemic_examination);
                                                foreach ($decode as $dec){
                                                    $name = ExaminationCategory::find_by_id($dec->examination);
                                                }
                                                ?>
                                                <option <?php echo ($dec->examination) ? 'selected ="TRUE"' : ''; ?>value="<?php echo $dec->examination ?>"><?php echo $name->name ?></option>
                                                <?php
                                                $examinations = ExaminationCategory::find_all();
                                                foreach($examinations as $examination) {
                                                    ?>
                                                    <option value="<?php echo $examination->id ?>"><?php echo $examination->name ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="examination">
                                        <div class="offset-sm-1 col-sm-3">
                                            <label>Symptoms</label>
                                        </div>

                                        <div class="col-sm-8" id="examination_id">

                                        </div>
                                    </div>


                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active" aria-current="page"><b><h4>DIAGNOSIS</h4></b>
                                            </li>
                                        </ol>
                                    </nav>

                                    <div class="form-group row">
                                        <div class="offset-sm-1 col-sm-3">
                                            <label> Diagnosis <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-3">
                                            <select class="form-control diagnosis" id="icd_sta"
                                                    name="diagnosis[]" multiple="multiple">
                                                <?php
                                                $decode = json_decode($case_note->diagnosis);
                                                foreach ($decode as $dec)
                                                ?>
                                                <option <?php echo ($dec) ? 'selected ="TRUE"' : ''; ?>value="<?php echo $dec ?>"><?php echo $dec ?></option>
                                                <?php
                                                $diagnosis = ICDCode::find_all();
                                                foreach($diagnosis as $diagnose) {
                                                    ?>
                                                    <option value="<?php echo $diagnose->name ?>"><?php echo $diagnose->name . " " . $diagnose->code ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-5">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-1 col-sm-3">
                                            <label> Differentials </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <select class="form-control diagnosis" id="differentials"
                                                    name="differentials[]" multiple="multiple">
                                                <?php
                                                $decode = json_decode($case_note->differentials);
                                                foreach ($decode as $dec){
                                                ?>
                                                <option <?php echo ($dec) ? 'selected ="TRUE"' : ''; ?>value="<?php echo $dec ?>"><?php echo $dec ?></option>
                                                <?php
                                                }
                                                $diagnosis = ICDCode::find_all();
                                                foreach($diagnosis as $diagnose) {
                                                    ?>
                                                    <option value="<?php echo $diagnose->name ?>"><?php echo $diagnose->name . " " . $diagnose->code ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row" >
                                        <div class="offset-sm-1 col-sm-3">
                                            <label> Add Note </label>
                                        </div>
                                        <div class="col-sm-8">

                                                                    <textarea name="examNote" class="form-control" >
                                                                        <?php echo $case_note->note ?>
                                                                     </textarea>

                                        </div>

                                    </div>
                                    <?php
                                    $dept = "SOPD";
                                    $userDept = Clinic::find_by_name($dept);
                                    //                                                            print_r($userDept);
                                    foreach ($userDept as $depts){
                                        $userSubClinic = UserSubClinic::find_by_user_clinic_id($user->id, $depts->id);
                                    }
                                    if (!empty($userSubClinic)){
                                        $decoded = json_decode($case_note->surgery);
                                        ?>

                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item active" aria-current="page"><b><h4>PREOPERATIVE NOTES</h4></b>
                                                </li>
                                            </ol>
                                        </nav>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <strong>PREOPERATIVE Hb.</strong>
                                                <input type="text" name="pre_hb" value="<?php echo $decoded->preoperative_hb ?>" id="pre_hb" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Date</strong>
                                                <input type="date" name="ope_date" value="<?php echo $decoded->preoperative_date ?>" id="ope_date" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Genotype</strong>
                                                <input type="text" name="ope_gn" value="<?php echo $decoded->Genotype ?>" id="pre_gn" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Blood Group</strong>
                                                <input type="text" name="ope_bg" value="<?php echo $decoded->BloodGroup ?>" id="pre_hb" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <strong>Lab. Ref. No</strong>
                                                <input type="text" name="lab_refNo" value="<?php echo $decoded->labRefNo ?>" id="pre_hb" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>X-RAY Ref. No</strong>
                                                <input type="text" name="xray_refNo" value="<?php echo $decoded->xrayRefNo ?>" id="ope_date" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Blood Crossmatched</strong>
                                                <input type="text" name="ope_bc" value="<?php echo $decoded->bloodCrossmatched ?>" id="pre_bc" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Known Allergies</strong>
                                                <input type="text" name="allergy" value="<?php echo $decoded->Allergy ?>" id="allergy" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <strong>Previous Drug History</strong>
                                                <input type="text" name="prev_drugHistory" value="<?php echo $decoded->previousDrugHistory ?>" id="prev_drugHistory" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Operation Proposed</strong>
                                                <input type="text" name="operationPro" value="<?php echo $decoded->operationProposed ?>" id="operationPro" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Indications for Operation</strong>
                                                <input type="text" name="ope_indication" value="<?php echo $decoded->IndicationForOperation ?>" id="ope_indication" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <strong>Emergency/Elective</strong>
                                                <input type="text" name="emergencyElective" value="<?php echo $decoded->EmergencyElective ?>" id="emergencyElective" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Proposed Date of Operation</strong>
                                                <input type="date" name="pdoo" value="<?php echo $decoded->proposedDateOfOperation ?>" id="pdoo" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Consent Given(Yes/No)</strong>
                                                <input type="text" name="consentGiven" value="<?php echo $decoded->consentGiven ?>" id="consentGiven" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>House Officers Signature</strong>
                                                <input type="text" name="hos" value="<?php echo $decoded->houseOfficer ?>" id="hos" class="form-control">
                                            </div>
                                        </div>

                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item active" aria-current="page"><b><h4>OPERATION NOTES</h4></b>
                                                </li>
                                            </ol>
                                        </nav>

                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <strong>Operation Performed</strong>
                                                <input type="text" name="opePerformed" value="<?php echo $decoded->operationPerformed ?>" id="opePerformed" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Date</strong>
                                                <input type="date" name="opd" value="<?php echo $decoded->operationPerformedDate ?>" id="opd" class="form-control">
                                            </div>
                                            <div class="col-sm-5">
                                                <strong>Surgeon's</strong>
                                                <input type="text" name="surgeon" value="<?php echo $decoded->surgeon ?>" id="surgeon" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <strong>Scrub Nurse</strong>
                                                <input type="text" name="scrubNurse" value="<?php echo $decoded->scrubNurse ?>" id="scrubNurse" class="form-control">
                                            </div>
                                            <div class="col-sm-8">
                                                <strong>Assistants</strong>
                                                <input type="text" name="assistants" value="<?php echo $decoded->assistants ?>" id="assistants" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-8">
                                                <strong>Circulating Nurse</strong>
                                                <input type="text" name="cNurse" value="<?php echo $decoded->circulatingNurse ?>" id="cNurse" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Anaesthetist</strong>
                                                <input type="text" name="anaesthetist" value="<?php echo $decoded->anaesthetist ?>" id="anaesthetist" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <strong>Type Of Anaesthetic</strong>
                                                <input type="text" name="anaestheticType" value="<?php echo $decoded->anaestheticType ?>" id="anaestheticType" class="form-control">
                                            </div>
                                            <div class="col-sm-6">
                                                <strong>Incision</strong>
                                                <input type="text" name="incision" value="<?php echo $decoded->incision ?>" id="incision" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <strong>Findings</strong>
                                                <textarea cols="12" name="findings" class="form-control"><?php echo $decoded->findings ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <strong>Procedure</strong>
                                                <textarea cols="12" rows="20" name="procedure" class="form-control"><?php echo $decoded->procedure ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <strong>Closure</strong>
                                                <textarea cols="12" name="closure" class="form-control"><?php echo $decoded->closure ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <strong>Torniquet Time</strong>
                                                <input name="torniquetTime" id="torniquetTime" class="form-control" value="<?php echo $decoded->torniquetTime ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <strong>Suture Material Used</strong>
                                                <textarea cols="12" name="smu" class="form-control"><?php echo $decoded->sutureMaterialUsed ?></textarea>
                                            </div>
                                            <div class="col-sm-6">
                                                <strong>Drains</strong>
                                                <textarea cols="12" name="drains" class="form-control"><?php echo $decoded->drains ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <strong>Packs</strong>
                                                <textarea cols="12" name="packs" class="form-control"><?php echo $decoded->packs ?></textarea>
                                            </div>
                                            <div class="col-sm-6">
                                                <strong>Specimens</strong>
                                                <textarea cols="12" name="specimens" class="form-control"><?php echo $decoded->specimens ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <strong>Swab Count Correct(Yes/No)</strong>
                                                <textarea cols="12" name="swabCount" class="form-control"><?php echo $decoded->swabCount ?></textarea>
                                            </div>
                                            <div class="col-sm-6">
                                                <strong>Measured/Estimated Blood Loss</strong>
                                                <textarea cols="12" name="bloodLoss" class="form-control"><?php echo $decoded->bloodLoss ?></textarea>
                                            </div>
                                        </div>

                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item active" aria-current="page"><b><h4>POST OPERATIVE INSTRUCTIONS</h4></b>
                                                </li>
                                            </ol>
                                        </nav>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <strong>Post Operative Instruction</strong>
                                                <textarea cols="12" rows="15" name="poi" class="form-control"><?php echo $decoded->postOperativeInstruction ?></textarea>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                    ?>

                                    <?php
                                    $dept = "SOPD";
                                    $clin = "ANAESTHESIA";
                                    $userDept = Clinic::find_by_name($dept);
                                    $userSub  = SubClinic::find_by_name($clin);
                                    //print_r($userDept);
                                    foreach ($userSub as $sub){
                                    }
                                    foreach ($userDept as $depts){
                                        $userSubClinic = UserSubClinic::find_by_user_clinic_and_subClinic_id($user->id, $depts->id, $sub->id);
                                    }
                                    if (!empty($userSubClinic)){
                                        ?>
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item active" aria-current="page"><b><h4>PREOPERATIVE NOTES</h4></b>
                                                </li>
                                            </ol>
                                        </nav>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <strong>PREOPERATIVE Hb.</strong>
                                                <input type="text" name="pre_hb" value="<?php echo $pre_hb ?>" id="pre_hb" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Date</strong>
                                                <input type="date" name="ope_date" value="<?php echo $ope_date ?>" id="ope_date" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Genotype</strong>
                                                <input type="text" name="ope_gn" value="<?php echo $ope_gn ?>" id="pre_gn" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Blood Group</strong>
                                                <input type="text" name="ope_bg" value="<?php echo $ope_bg ?>" id="ope_bg" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <strong>Lab. Ref. No</strong>
                                                <input type="text" name="lab_refNo" value="<?php echo $lab_refNo ?>" id="lab_refNo" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>X-RAY Ref. No</strong>
                                                <input type="text" name="xray_refNo" value="<?php echo $xray_refNo ?>" id="ope_date" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Blood Crossmatched</strong>
                                                <input type="text" name="ope_bc" value="<?php echo $ope_bc ?>" id="pre_bc" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Known Allergies</strong>
                                                <input type="text" name="allergy" value="<?php echo $allergy ?>" id="allergy" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <strong>Previous Drug History</strong>
                                                <input type="text" name="prev_drugHistory" value="<?php echo $prev_drugHistory ?>" id="prev_drugHistory" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Operation Proposed</strong>
                                                <input type="text" name="operationPro" value="<?php echo $operationPro ?>" id="operationPro" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Indications for Operation</strong>
                                                <input type="text" name="ope_indication" value="<?php echo $ope_indication ?>" id="ope_indication" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <strong>Emergency/Elective</strong>
                                                <input type="text" name="emergencyElective" value="<?php echo $emergencyElective ?>" id="emergencyElective" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Proposed Date of Operation</strong>
                                                <input type="date" name="pdoo" value="<?php echo $pdoo ?>" id="pdoo" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Consent Given(Yes/No)</strong>
                                                <input type="text" name="consentGiven" value="<?php echo $consentGiven ?>" id="consentGiven" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>House Officers Signature</strong>
                                                <input type="text" name="hos" value="<?php echo $hos ?>" id="hos" class="form-control">
                                            </div>
                                        </div>

                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item active" aria-current="page"><b><h4>OPERATION NOTES</h4></b>
                                                </li>
                                            </ol>
                                        </nav>

                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <strong>Operation Performed</strong>
                                                <input type="text" name="opePerformed" value="<?php echo $opePerformed ?>" id="opePerformed" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Date</strong>
                                                <input type="date" name="opd" value="<?php echo $opd ?>" id="opd" class="form-control">
                                            </div>
                                            <div class="col-sm-5">
                                                <strong>Surgeon's</strong>
                                                <input type="text" name="surgeon" value="<?php echo $surgeon ?>" id="surgeon" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <strong>Scrub Nurse</strong>
                                                <input type="text" name="scrubNurse" value="<?php echo $scrubNurse ?>" id="scrubNurse" class="form-control">
                                            </div>
                                            <div class="col-sm-8">
                                                <strong>Assistants</strong>
                                                <input type="text" name="assistants" value="<?php echo $assistants ?>" id="assistants" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-8">
                                                <strong>Circulating Nurse</strong>
                                                <input type="text" name="cNurse" value="<?php echo $cNurse ?>" id="cNurse" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Anaesthetist</strong>
                                                <input type="text" name="anaesthetist" value="<?php echo $anaesthetist ?>" id="anaesthetist" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <strong>Type Of Anaesthetic</strong>
                                                <input type="text" name="anaestheticType" value="<?php echo $anaestheticType ?>" id="anaestheticType" class="form-control">
                                            </div>
                                            <div class="col-sm-6">
                                                <strong>Incision</strong>
                                                <input type="text" name="incision" value="<?php echo $incision ?>" id="incision" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <strong>Findings</strong>
                                                <textarea cols="12" name="findings" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <strong>Procedure</strong>
                                                <textarea cols="12" rows="20" name="procedure" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <strong>Closure</strong>
                                                <textarea cols="12" name="closure" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <strong>Torniquet Time</strong>
                                                <input name="torniquetTime" id="torniquetTime" class="form-control" value="<?php echo $tornTime ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <strong>Suture Material Used</strong>
                                                <textarea cols="12" name="smu" class="form-control"></textarea>
                                            </div>
                                            <div class="col-sm-6">
                                                <strong>Drains</strong>
                                                <textarea cols="12" name="drains" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <strong>Packs</strong>
                                                <textarea cols="12" name="packs" class="form-control"></textarea>
                                            </div>
                                            <div class="col-sm-6">
                                                <strong>Specimens</strong>
                                                <textarea cols="12" name="specimens" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <strong>Swab Count Correct(Yes/No)</strong>
                                                <textarea cols="12" name="swabCount" class="form-control"></textarea>
                                            </div>
                                            <div class="col-sm-6">
                                                <strong>Measured/Estimated Blood Loss</strong>
                                                <textarea cols="12" name="bloodLoss" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item active" aria-current="page"><b><h4>POST OPERATIVE INSTRUCTIONS</h4></b>
                                                </li>
                                            </ol>
                                        </nav>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <strong>Post Operative Instruction</strong>
                                                <textarea cols="12" rows="15" name="poi" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                    $dept = "ANAESTHESIA";
                                    $userDept = SubClinic::find_by_name($dept);
                                    //                                                            print_r($userDept);
                                    foreach ($userDept as $depts){
                                        $userSubClinic = UserSubClinic::find_user_sub_clinic_id($user->id, $depts->id);
                                    }
                                    if (!empty($userSubClinic)){
                                        $decoded = json_decode($case_note->anaesthesia);
                                        ?>

                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item active" aria-current="page"><b><h4>PREOPERATIVE ASSESSMENT</h4></b>
                                                </li>
                                            </ol>
                                        </nav>

                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <strong>PCV(%)</strong>
                                                <input type="text" name="pcv" value="<?php echo $decoded->pcv ?>" id="pcv" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Hb (gm/dl)</strong>
                                                <input type="text" name="hb" value="<?php echo $decoded->hb ?>" id="hb" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Urinalysis</strong>
                                                <input type="text" name="anaesthesiaUrine" value="<?php echo $decoded->urinalysis ?>" id="anaesthesiaUrine" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <strong>ASA Physical Status</strong>
                                                <input type="text" name="asaStatus" value="<?php echo $decoded->asaStatus ?>" id="asaStatus" class="form-control">
                                            </div>
                                            <div class="col-sm-6">
                                                <strong>Relevant Hx, Exam, Inx and Significant drug Rx:</strong>
                                                <input type="text" name="hxInx" value="<?php echo $decoded->hxInx ?>" id="hxInx" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <strong>Hb Genotype</strong>
                                                <input type="text" name="hbgn" value="<?php echo $decoded->hbgenotype ?>" id="hbgn" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Dentition</strong>
                                                <input type="text" name="dentition" value="<?php echo $decoded->dentition ?>" id="dentition" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Last Per Oral</strong>
                                                <input type="text" name="oral" value="<?php echo $decoded->oral ?>" id="oral" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>Anaesthetic History</strong>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Previous Anaesthetic</label>
                                                <br />
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="Yes" value="Yes" <?= ($decoded->prevAnaestheticYes == "Yes") ? "checked='checked'" : '' ?>>
                                                    <span>Yes</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="No" value="No" <?= ($decoded->prevAnaestheticNo == "No") ? "checked='checked'" : '' ?>>
                                                    <span>No</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Complications</strong>
                                                <input type="text" name="complications" value="<?php echo $decoded->complications ?>" id="complications" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <strong>Premedications</strong>
                                                <input type="text" name="premedications" value="<?php echo $decoded->premedications ?>" id="premedications" class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Time Given:</strong>
                                                <input type="text" name="timeGiven" value="<?php echo $decoded->timeGiven ?>" id="timeGiven" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>Airway:</strong>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Likely Difficult Intubation:</label>
                                                <br />
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="intubationYes" value="Yes" <?= ($decoded->intubationYes == "Yes") ? "checked='checked'" : '' ?>>
                                                    <span>Yes</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="intubationNo" value="No" <?= ($decoded->intubationNo == "No") ? "checked='checked'" : '' ?>>
                                                    <span>No</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-2">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-5">
                                                <strong>Mallampati:</strong>
                                                <input type="text" name="mallampati" value="<?php echo $decoded->mallampati ?>" id="mallampati" class="form-control">
                                            </div>
                                            <div class="col-sm-5">
                                                <strong>Comment:</strong>
                                                <textarea name="ana_comment" id="ana_comment" class="form-control"><?php echo $decoded->intubationComment ?> </textarea>
                                            </div>
                                            <div class="col-sm-2">
                                                <label>Smoker:</label>
                                                <br />
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="smokerYes" value="Yes" <?= ($decoded->smokerYes == "Yes") ? "checked='checked'" : '' ?>>
                                                    <span>Yes</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="smokerNo" value="No" <?= ($decoded->smokerNo == "No") ? "checked='checked'" : '' ?>>
                                                    <span>No</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>Obst/Gynae:</strong>
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>LMP:</strong>
                                                <input type="text" name="lmp" value="<?php echo $decoded->lmp ?>" id="lmp" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Parity:</strong>
                                                <input type="text" name="parity" value="<?php echo $decoded->parity ?>" id="parity" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">

                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Gest:</strong>
                                                <input type="text" name="gest" value="<?php echo $decoded->gestAge ?>" id="gest" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Age:</strong>
                                                <input type="text" name="age" value="<?php echo $decoded->gestAge ?>" id="age" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>Allergies/Blood Txn:</strong>
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Rxn:</strong>
                                                <input type="text" name="rxn" value="<?php echo $decoded->rxn ?>" id="rxn" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>E/U/Cr:</strong>
                                                <input type="text" name="eucr" value="<?php echo $decoded->eucr ?>" id="eucr" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <strong>HR(bmp):</strong>
                                                <input type="text" name="hrbpm" value="<?php echo $decoded->hrbpm ?>" id="hrbpm" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>BP(mmHg)</strong>
                                                <input type="text" name="bpmmhg" value="<?php echo $decoded->bpmmhg ?>" id="bpmmhg" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Temp(<span>&#176;</span>C):</strong>
                                                <input type="text" name="temp" value="<?php echo $decoded->temp ?>" id="temp" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <strong>Seen By:</strong>
                                                <input type="text" name="seenBy" value="<?php echo $decoded->seenBy ?>" id="seenBy" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Date:</strong>
                                                <input type="datetime-local" name="d_time" value="<?php echo $decoded->d_time ?>" id="d_time" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                            </div>
                                        </div>

                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item active" aria-current="page"><b><h4>INTRAOPERATIVE ASSESSMENT</h4></b>
                                                </li>
                                            </ol>
                                        </nav>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>baseline vital Signs:</strong>
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>HR(bpm):</strong>
                                                <input type="text" name="intra_hrbpm" value="<?php echo $decoded->intra_hrbpm ?>" id="intra_hrbpm" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>NIBP(mmHg):</strong>
                                                <input type="text" name="nibpmmhg" value="<?php echo $decoded->nibpmmhg ?>" id="nibpmmhg" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>SaO(%):</strong>
                                                <input type="text" name="sao" value="<?php echo $decoded->sao ?>" id="sao" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Temp(<span>&#176;</span>C):</strong>
                                                <input type="text" name="intra_temp" value="<?php echo $decoded->intra_temp ?>" id="intra_temp" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>AIRWAY:</strong>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Facemask:</label>
                                                <br />
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="facemaskYes" value="Yes" <?= ($decoded->facemaskYes == "Yes") ? "checked='checked'" : '' ?>>
                                                    <span>Yes</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="facemaskNo" value="No" <?= ($decoded->facemaskNo == "Yes") ? "checked='checked'" : '' ?>>
                                                    <span>No</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Size:</strong>
                                                <input type="text" name="facemaskSize" value="<?php echo $decoded->facemaskSize ?>" id="facemaskSize" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">

                                            </div>
                                            <div class="col-sm-4">
                                                <label>Oral airway:</label>
                                                <br />
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="oralYes" value="Yes" <?= ($decoded->oralYes == "Yes") ? "checked='checked'" : '' ?>>
                                                    <span>Yes</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="oralNo" value="No" <?= ($decoded->oralNo == "No") ? "checked='checked'" : '' ?>>
                                                    <span>No</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Size:</strong>
                                                <input type="text" name="oralSize" value="<?php echo $decoded->oralSize ?>" id="oralSize" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">

                                            </div>
                                            <div class="col-sm-4">
                                                <label>Nasal airway:</label>
                                                <br />
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="nasalYes" value="Yes" <?= ($decoded->nasalYes == "Yes") ? "checked='checked'" : '' ?>>
                                                    <span>Yes</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="nasalNo" value="No" <?= ($decoded->nasalNo == "No") ? "checked='checked'" : '' ?>>
                                                    <span>No</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Size:</strong>
                                                <input type="text" name="nasalSize" value="<?php echo $decoded->nasalSize ?>" id="nasalSize" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">

                                            </div>
                                            <div class="col-sm-4">
                                                <label>LMA:</label>
                                                <br />
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="lmaYes" value="Yes" <?= ($decoded->lmaYes == "Yes") ? "checked='checked'" : '' ?>>
                                                    <span>Yes</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="lmaNo" value="No" <?= ($decoded->lmaNo == "No") ? "checked='checked'" : '' ?>>
                                                    <span>No</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Size:</strong>
                                                <input type="text" name="lmaSize" value="<?php echo $decoded->lmaSize ?>" id="lmaSize" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">

                                            </div>
                                            <div class="col-sm-4">
                                                <label>Maintenance:</label>
                                                <br />
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="easy" value="Easy" <?= ($decoded->easy == "Easy") ? "checked='checked'" : '' ?>>
                                                    <span>Easy</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="difficult" value="difficult" <?= ($decoded->difficult == "Difficult") ? "checked='checked'" : '' ?>>
                                                    <span>Difficult</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-4">

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>INDUCTION:</strong>
                                            </div>

                                            <div class="col-sm-4">
                                                <strong>Time:</strong>
                                                <input type="time" name="inductionTime" value="<?php echo $decoded->inductionTime ?>" id="inductionTime" class="form-control">
                                            </div>

                                            <div class="col-sm-4">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>IV agent:</strong>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Inhalation:</label>
                                                <br />
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="halo" value="Halo" <?= ($decoded->halo == "Halo") ? "checked='checked'" : '' ?>>
                                                    <span>Halo</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="sevo" value="Sevo" <?= ($decoded->sevo == "Sevo") ? "checked='checked'" : '' ?>>
                                                    <span>Sevo</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Dose(mg):</label>
                                                <br />
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="isofiu" value="Isofiu" <?= ($decoded->isofiu == "Isofiu") ? "checked='checked'" : '' ?>>
                                                    <span>Isofiu</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="conc" value="Conc" <?= ($decoded->conc == "Conc") ? "checked='checked'" : '' ?>>
                                                    <span>Conc:</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">

                                            </div>

                                            <div class="col-sm-4">
                                                <strong>Suxamethoniun(mg):</strong>
                                                <input type="text" name="suxamethoniun" value="<?php echo $decoded->suxamethoniun ?>" id="suxamethoniun" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Others:</strong>
                                                <input type="text" name="others" value="<?php echo $decoded->inductionOthers ?>" id="others" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label>INTUBATION:</label>
                                                <br />
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="intubatYes" value="Yes" <?= ($decoded->intubatYes == "Yes") ? "checked='checked'" : '' ?>>
                                                    <span>Yes</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="intubatNo" value="No" <?= ($decoded->intubatNo == "No") ? "checked='checked'" : '' ?>>
                                                    <span>No</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="intubationOral" value="Oral" <?= ($decoded->intubationOral == "Oral") ? "checked='checked'" : '' ?>>
                                                    <span>Oral</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="intubationNasal" value="Nasal" <?= ($decoded->intubationNasal == "Nasal") ? "checked='checked'" : '' ?>>
                                                    <span>Nasal</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="intubationTracheostomy" value="Tracheostomy" <?= ($decoded->tracheostomy == "Tracheostomy") ? "checked='checked'" : '' ?>>
                                                    <span>Tracheostomy</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="singleLumen" value="Single Lumen" <?= ($decoded->singleLumen == "Single Lumen") ? "checked='checked'" : '' ?>>
                                                    <span>Single Lumen</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="doubleLumen" value="Double Lumen" <?= ($decoded->doubleLumen == "Double Lumen") ? "checked='checked'" : '' ?>>
                                                    <span>Double Lumen</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <strong>Size:</strong>
                                                <input type="text" name="intubationSize" class="form-control" id="intubationSize" value="<?php echo  $decoded->intubationSize ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Type:</strong>
                                                <input type="text" name="intubationType" class="form-control" id="intubationType" value="<?php echo  $decoded->intubationType ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="cuff" value="Cuff" <?= ($decoded->cuff == "Cuff") ? "checked='checked'" : '' ?>>
                                                    <span>Cuff</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="unCuff" value="Uncuff" <?= ($decoded->uncuff == "Uncuff") ? "checked='checked'" : '' ?>>
                                                    <span>Uncuff</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="pre02" value="Pre02" <?= ($decoded->pre02 == "Pre02") ? "checked='checked'" : '' ?>>
                                                    <span>Pre02</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="humidification" value="humidification" <?= ($decoded->humidification == "humidification") ? "checked='checked'" : '' ?>>
                                                    <span>Humidification</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="rapidSequence" value="Rapid Sequence" <?= ($decoded->rapidSequence == "Rapid Sequence") ? "checked='checked'" : '' ?>>
                                                    <span>Rapid Sequence</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="ngtube" value="NG Tube" <?= ($decoded->ngTube == "NG Tube") ? "checked='checked'" : '' ?>>
                                                    <span>N/G Tube</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="fibreoptic" value="Fibreoptic" <?= ($decoded->fibreoptic == "Fibreoptic") ? "checked='checked'" : '' ?>>
                                                    <span>Fibreoptic</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="bougie" value="Bougie" <?= ($decoded->bougie == "Bougie") ? "checked='checked'" : '' ?>>
                                                    <span>Bougie</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <strong>Laryngoscopy Grade:</strong>
                                                <select name="laryngoscopy" class="form-control">
                                                    <?php for ($a = 1; $a <= 4; $a++){
                                                        ?>
                                                        <option value="<?php echo $a ?>"><?php echo $a ?></option>
                                                        <?php
                                                    }?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Outcome:</label>
                                                <br>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="successful" value="Successful" <?= ($decoded->successful == "Successful") ? "checked='checked'" : '' ?>>
                                                    <span>Successful</span>
                                                </label>

                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="failed" value="Failed" <?= ($decoded->failed == "Failed") ? "checked='checked'" : '' ?>>
                                                    <span>Failed</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Laryngoscopist(s):</strong>
                                                <input type="text" name="laryngoscopist" id="laryngoscopist" class="form-control" value="<?php echo $decoded->laryngoscopist ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label>MAINTENANCE:</label>
                                                <br />
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="halothane" value="Halothane" <?= ($decoded->halothane == "Halothane") ? "checked='checked'" : '' ?>>
                                                    <span>Halothane</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="isoflurance" value="Isoflurance" <?= ($decoded->isoflurance == "Isoflurance") ? "checked='checked'" : '' ?>>
                                                    <span>Isoflurance</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="sevoflurance" value="Sevoflurance" <?= ($decoded->sevoflurance == "Sevoflurance") ? "checked='checked'" : '' ?>>
                                                    <span>Sevoflurance</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="desflurance" value="Desflurance" <?= ($decoded->desflurance == "Desflurance") ? "checked='checked'" : '' ?>>
                                                    <span>Desflurance</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="n20" value="N20" <?= ($decoded->n20 == "N20") ? "checked='checked'" : '' ?>>
                                                    <span>N20</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="Air" value="Air" <?= ($decoded->air == "Air") ? "checked='checked'" : '' ?>>
                                                    <span>Air</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>ANALGESIA</strong>
                                            </div>

                                            <div class="col-sm-4">
                                                <strong>Drug(s):</strong>
                                                <input type="text" name="analgesiaDrug" value="<?php echo $decoded->analgesiaDrug ?>" id="analgesiaDrug" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Dose(s):</strong>
                                                <input type="text" name="analgesiaDose" value="<?php echo $decoded->analgesiaDose ?>" id="others" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>TIVA</strong>
                                            </div>

                                            <div class="col-sm-4">
                                                <strong>Drug:</strong>
                                                <input type="text" name="tivaDrug" value="<?php echo $decoded->tivaDrug ?>" id="tivaDrug" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Infusion Rate:</strong>
                                                <input type="text" name="infusionRate" value="<?php echo $decoded->infusionRate ?>" id="others" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>VENTILATION:</strong>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="spontaneous" value="Spontaneous" <?= ($decoded->spontaneous == "Spontaneous") ? "checked='checked'" : '' ?>>
                                                    <span>Spontaneous</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <lable>Controlled:</lable>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="manual" value="Manual" <?= ($decoded->manual == "Manual") ? "checked='checked'" : '' ?>>
                                                    <span>Manual</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="ventilator" value="Ventilator" <?= ($decoded->ventilator == "Ventilator") ? "checked='checked'" : '' ?>>
                                                    <span>Ventilator</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>BREATHING SYSTEMS:</strong>
                                            </div>

                                            <div class="col-sm-8">
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="circle" value="Circle" <?= ($decoded->circle == "Circle") ? "checked='checked'" : '' ?>>
                                                    <span>Circle</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="semiClosed" value="Semi Closed" <?= ($decoded->semiClosed == "Semi Closed") ? "checked='checked'" : '' ?>>
                                                    <span>Semi-Closed</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="bains" value="Bains" <?= ($decoded->bains == "Bains") ? "checked='checked'" : '' ?>>
                                                    <span>Bains</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="lack" value="Lack" <?= ($decoded->lack == "Lack") ? "checked='checked'" : '' ?>>
                                                    <span>Lack</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="magills" value="Magills" <?= ($decoded->magills == "Magills") ? "checked='checked'" : '' ?>>
                                                    <span>Magill's</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="infantsTPiece" value="Infants T Piece" <?= ($decoded->infants == "Infants T Piece") ? "checked='checked'" : '' ?>>
                                                    <span>Infant's T-Piece</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="waters" value="Waters" <?= ($decoded->water == "Waters") ? "checked='checked'" : '' ?>>
                                                    <span>Waters</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>MONITORING:</strong>
                                            </div>

                                            <div class="col-sm-8">
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="monitoringECG" value="ECG" <?= ($decoded->ecg == "ECG") ? "checked='checked'" : '' ?>>
                                                    <span>ECG</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="monitoringNIBP" value="NIBP" <?= ($decoded->nibp == "NIBP") ? "checked='checked'" : '' ?>>
                                                    <span>NIBP</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="monitoringSa02" value="Sa02" <?= ($decoded->sa02 == "Sa02") ? "checked='checked'" : '' ?>>
                                                    <span>Sa02</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="monitoringErc02" value="Erc02" <?= ($decoded->erc02 == "Erc02") ? "checked='checked'" : '' ?>>
                                                    <span>Erc02</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="monitoringTemp" value="Temp" <?= ($decoded->monitoringTemp == "Temp") ? "checked='checked'" : '' ?>>
                                                    <span>Temp</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="precordialStethoscope" value="Precordial Stethoscope" <?= ($decoded->precordialStethoscope == "Precordial Stethoscope") ? "checked='checked'" : '' ?>>
                                                    <span>Precordial Stethoscope</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="inhAgent" value="Inh. Agent" <?= ($decoded->inhAgent == "Inh. Agent") ? "checked='checked'" : '' ?>>
                                                    <span>Inh. Agent</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>MUSCLE RELAXANT</strong>
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Agent:</strong>
                                                <input type="text" name="muscleRelaxantAgent" id="muscleRelaxantAgent" class="form-control" value="<?php echo $decoded->muscleRelexantAgent ?>"> >
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Dose(mg):</strong>
                                                <input type="text" name="muscleRelaxantDose" id="muscleRelaxantDose" class="form-control" value="<?php echo $decoded->muscleRelexantDose ?>"> Throat Pack
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">

                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Reversal:</strong>
                                                <input type="text" name="reversal" id="reversal" class="form-control" value="<?php echo $decoded->reversal ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Dose(mg):</strong>
                                                <input type="text" name="reversalDose" id="reversalDose" class="form-control" value="<?php echo $decoded->reversalDose ?>"> IN/OUT
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>INVASIVE:</strong>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="directArterialBP" value="Direct Arterial BP" <?= ($decoded->directArterial == "Direct Arterial BP") ? "checked='checked'" : '' ?>>
                                                    <span>Direct Arterial BP</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="cvp" value="CVP" <?= ($decoded->cvp == "CVP") ? "checked='checked'" : '' ?>>
                                                    <span>CVP</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="pappcwp" value="PAPPCWP" <?= ($decoded->pappcwp == "PAPPCWP") ? "checked='checked'" : '' ?>>
                                                    <span>PAP/PCWP</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-2">
                                                <strong>Others:</strong>
                                                <input type="text" name="invasiveOthers" id="invasiveOthers" class="form-control" value="<?php echo $decoded->inversiveOthers ?>"> IN/OUT
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2 offset-1">
                                                <strong>VENOUS ACCESS</strong>
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Line 1:</strong>
                                                <input type="text" name="line1" id="line1" class="form-control" value="<?php echo $decoded->line1 ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Site:</strong>
                                                <input type="text" name="site1" id="site1" class="form-control" value="<?php echo $decoded->site1 ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Size:</strong>
                                                <input type="text" name="size1" id="size1" class="form-control" value="<?php echo $decoded->size1 ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2 offset-1">

                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Line 2:</strong>
                                                <input type="text" name="line2" id="line2" class="form-control" value="<?php echo $decoded->line2 ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Site:</strong>
                                                <input type="text" name="site2" id="site2" class="form-control" value="<?php echo $decoded->site2 ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Size:</strong>
                                                <input type="text" name="size2" id="size2" class="form-control" value="<?php echo $decoded->size2 ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>REGIONAL ANAESTHESIA:</strong>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>TYPE:</label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="spinal" value="Spinal" <?= ($decoded->spinal == "Spinal") ? "checked='checked'" : '' ?>>
                                                    <span>Spinal</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="epidural" value="Epidural" <?= ($decoded->epidural == "Epidural") ? "checked='checked'" : '' ?>>
                                                    <span>Epidural</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="cse" value="CSE" <?= ($decoded->cse == "CSE") ? "checked='checked'" : '' ?>>
                                                    <span>CSE</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="infiltration" value="Infiltration" <?= ($decoded->infiltration == "Infiltration") ? "checked='checked'" : '' ?>>
                                                    <span>Infiltration</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-2">
                                                <strong>Others(Specify):</strong>
                                                <input type="text" name="invasiveOthers" id="invasiveOthers" class="form-control" value="<?php echo $decoded->inversiveOthers ?>"> IN/OUT
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <strong>Position:</strong>
                                                <input type="text" name="position" class="form-control" value="<?php echo $decoded->position ?>">
                                            </div>
                                            <div class="col-sm-2">
                                                <strong>Site:</strong>
                                                <input type="text" name="regionalSite" id="regionalSite" class="form-control" value="<?php echo $decoded->regionalSite ?>">
                                            </div>
                                            <div class="col-sm-2">
                                                <strong>Needle Size:</strong>
                                                <input type="text" name="needleSize" id="needleSize" class="form-control" value="<?php echo $decoded->needleSize ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Drug:</strong>
                                                <input type="text" name="regionalDrug" id="regionalDrug" class="form-control" value="<?php echo $decoded->regionalDrug ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Dose(mg):</strong>
                                                <input type="text" name="regionalDose" id="regionalDose" class="form-control" value="<?php echo $decoded->regionalDose ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label>Block Quality:</label>
                                                <br>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="complete" value="Complete" <?= ($decoded->complete == "Complete") ? "checked='checked'" : '' ?>>
                                                    <span>Complete</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="patchy" value="Patchy" <?= ($decoded->patchy == "Patchy") ? "checked='checked'" : '' ?>>
                                                    <span>Patchy</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="qualityFailed" value="Failed" <?= ($decoded->failed == "Failed") ? "checked='checked'" : '' ?>>
                                                    <span>Failed</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Block Height:</strong>
                                                <input type="text" name="blockHeight" id="blockHeight" class="form-control" value="<?php echo $decoded->blockHeight ?>"> IN/OUT
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Performed By:</strong>
                                                <input type="text" name="performedBy" id="performedBy" class="form-control" value="<?php echo $decoded->performedBy ?>"> IN/OUT
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>Operation Performed:</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                <textarea class="col-sm-8" name="operationPer"><?php echo $decoded->operationPer ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>Critical Incidences:</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                <textarea class="col-sm-8" name="criticalIncidences"><?php echo $decoded->criticalIncidences ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>Total Fluid:</strong>
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Colloid:</strong>
                                                <textarea class="form-control" name="colloid"><?php echo $decoded->colloid ?></textarea>
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Crystalloid:</strong>
                                                <textarea class="form-control" name="crystalloid"><?php echo $decoded->crystalloid ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>Total Blood Transfused:</strong>
                                            </div>
                                            <div class="col-sm-4">
                                                <textarea class="form-control" name="bloodTransfused"><?php echo $decoded->bloodTransfused ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>Estimated Blood Loss:</strong>
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Suction Bottle:</strong>
                                                <input type="text" class="form-control" name="suctionBottle" value="<?php echo $decoded->suctionBottle ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Spoges/Drapes:</strong>
                                                <input type="text" class="form-control" name="spogesDrapes" value="<?php echo $decoded->spogesDrape ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">

                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Floor:</strong>
                                                <input type="text" class="form-control" name="floor" value="<?php echo $decoded->floor ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Total:</strong>
                                                <input type="text" class="form-control" name="bloodLossTotal" value="<?php echo $decoded->bloodLossTotal ?>">
                                            </div>
                                        </div>

                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item active" aria-current="page"><b><h4>POSTOPERATIVE STATUS</h4></b>
                                                </li>
                                            </ol>
                                        </nav>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label>POSTOPERATIVE STATUS:</label>
                                                <br>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="satisfactory" value="SATISFACTORY" <?= ($decoded->satisfactory == "SATISFACTORY") ? "checked='checked'" : '' ?>>
                                                    <span>SATISFACTORY</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="unsatisfactory" value="UNSATISFACTORY" <?= ($decoded->unsatisfactory == "UNSATISFACTORY") ? "checked='checked'" : '' ?>>
                                                    <span>UNSATISFACTORY</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="transferIcu" value="TRANSFER TO ICU" <?= ($decoded->icu == "TRANSFER TO ICU") ? "checked='checked'" : '' ?>>
                                                    <span>TRANSFER TO ICU</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Block Height:</strong>
                                                <input type="text" name="blockHeight" id="blockHeight" class="form-control" value="<?php echo $decoded->blockHeight ?>"> IN/OUT
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>Performed By:</strong>
                                                <input type="text" name="performedBy" id="performedBy" class="form-control" value="<?php echo $decoded->performedBy ?>"> IN/OUT
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                <strong>VITAL SIGNS:</strong>
                                            </div>
                                            <div class="col-sm-2">
                                                <strong>HR(bpm):</strong>
                                                <input type="text" class="form-control" name="post_hr" value="<?php echo $decoded->posthr ?>">
                                            </div>
                                            <div class="col-sm-2">
                                                <strong>BP(mmHg):</strong>
                                                <input type="text" class="form-control" name="post_bp" value="<?php echo $decoded->post_bp ?>">
                                            </div>
                                            <div class="col-sm-2">
                                                <strong>SaO2:</strong>
                                                <input type="text" class="form-control" name="post_sao2" value="<?php echo $decoded->post_sao2 ?>">
                                            </div>
                                            <div class="col-sm-2">
                                                <strong>Temp(<span>&#176;</span>C):</strong>
                                                <input type="text" class="form-control" name="post_temp" value="<?php echo $decoded->post_temp ?>">
                                            </div>
                                            <div class="col-sm-2">
                                                <strong>ETCO2:</strong>
                                                <input type="text" class="form-control" name="etco2" value="<?php echo $decoded->etc02 ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>BABY APGAR SCORE:</strong>
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Time Delivered:</strong>
                                                <input type="text" name="timeDelivered" class="form-control" value="<?php echo $decoded->timeDelivered ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Remarks</strong>
                                                <textarea name="post_remark" class="form-control"><?php echo $decoded->post_remark ?></textarea>
                                            </div>
                                        </div>
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item active" aria-current="page"><b><h4>EMERGENCY AIRWAY ASSESMENT</h4></b>
                                                </li>
                                            </ol>
                                        </nav>

                                        <div class="form-group row">
                                            <div class="col-sm-3 offset-1">
                                                <strong>Post-Extubation Status:</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="emergencySatisfactory" value="SATISFACTORY" <?= ($decoded->emergencySatisfactory == "SATISFACTORY") ? "checked='checked'" : '' ?>>
                                                    <span>SATISFACTORY</span>
                                                </label>
                                                <label class="fancy-checkbox">
                                                    <input type="checkbox" name="emergencyUnsatisfactory" value="UNSATISFACTORY" <?= ($decoded->emergencyUnSatisfactory == "UNSATISFACTORY") ? "checked='checked'" : '' ?>>
                                                    <span>UNSATISFACTORY</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <strong>ETT left in situ?</strong>
                                            <div class="col-sm-4">
                                                <input type="text" name="ett" class="form-control" id="ett" value="<?php echo $decoded->ett ?>">
                                            </div>
                                            <div class="col-sm-8">
                                                <strong>If yes, why?</strong>
                                                <textarea name="why" class="form-control"><?php echo $decoded->why ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <strong>Re-intubation in theatre</strong>
                                            <div class="col-sm-4">
                                                <input type="text" name="reintubationTheatre" class="form-control" id="reintubationTheatre" value="<?php echo $decoded->reintubationTheatre ?>">
                                            </div>
                                            <div class="col-sm-8">
                                                <strong>Comments on vocal cords and breathing pattern:</strong>
                                                <textarea name="vocalCords" class="form-control"><?php echo $decoded->vocalCords ?></textarea>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                    ?>


                                    <input type="submit" name="save_note" value="Save " class="btn-lg btn-success" />

                                </form>





                            </div>
                        </div>


                    </div>


                </div>



            </div>

        </div>



    </div>
</div>





<?php
require '../layout/footer.php';
?>

<!-- Complain JS Start -->
<script>
    function matchCustom(params, data) {
        // If there are no search terms, return all of the data
        if ($.trim(params.term) === '') {
            return data;
        }

        // Do not display the item if there is no 'text' property
        if (typeof data.text === 'undefined') {
            return null;
        }

        // `params.term` should be the term that is used for searching
        // `data.text` is the text that is displayed for the data object
        if (data.text.indexOf(params.term) > -1) {
            var modifiedData = $.extend({}, data, true);
            modifiedData.text += ' (matched)';

            // You can return modified objects from here
            // This includes matching the `children` how you want in nested data sets
            return modifiedData;
        }

        // Return `null` if the term should not be displayed
        return null;
    }

    $(".js-example-matcher").select2({
        matcher: matchCustom
    });

    $(".diagnosis").select2({
        tags: true,
        placeholder: "Select Diagnosis",
    });

    $(".examination").select2({
        tags: true,
        placeholder: "Select Symptoms",
    });

    $(".exam_state").select2({
        tags: true,
        placeholder: "Examination Condition",
    });

</script>