<?php
require_once("../symptom_checker/table/SymptomAnswerTable.php");
require_once("../symptom_checker/table/QuestionTable.php");
require_once("../symptom_checker/table/SymptomResultTable.php");

    
        $username = $user->full_name();
    $eachReq = new TestRequest();
    $testReq = $eachReq->find_requests_by_patientIdForBilled($_GET['id']);
    

    $eachScanReq = new ScanRequest();
    $scanReq = $eachScanReq->find_requests_by_patientIdForBilledScan($_GET['id']);
    // $scanReq = $scanReq['0'];
    

    $eachDrugReq = new DrugRequest();
    $drugReq = $eachDrugReq->find_requests_by_patientIdForBilledDrug($_GET['id']);
    //pre_d($drugReq);die;
    
    

    // $username = $user->full_name();
    // $eachTest = new EachTest();
    // $eachDataDetail = $eachTest->find_all_requests_by_consultant($username);

    // $eachScan = new EachScan();
    // $eachScanDetail = $eachScan->find_all_requests_by_consultant_for_scan($username);

    // $eachDrug = new EachDrug();
    // $eachDrugDetail = $eachDrug->find_all_requests_by_consultant_for_scan_for_drug($username);

     //pre_d($eachDrugDetail);die;
    // pre_d($eachScanDetail);die;
?>
<div class="row clearfix">
    <div class="col-lg-12" >        

    <ul class="nav nav-tabs-new2">
        <li class="nav-item nav-link-goto active show"><a class="nav-link nav-link-goto active show" data-toggle="tab" href="#CaseNote">Case Notes</a></li>
        <li class="nav-item "><a class="nav-link" data-toggle="tab" href="#VitaThird">Vitals</a></li>
        <li class="nav-item "><a class="nav-link" data-toggle="tab" href="#LaboratoryThird">Laboratory</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#RadiologyThird">Radiology/Ultrasound</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#DrugThird">Drug Prescription</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#SymptomAnswer">Symptom Result</a></li>
    </ul>

    </div>
    <div class="col-lg-12">
    <div class="tab-content">
        
<!-- Case notes -->
<div class="tab-pane show active" id="CaseNote">
        <?php include("case_notes.php") ?>
</div>
<div class="tab-pane" id="VitaThird">
        <?php include("vital.php") ?>
</div>  
    <div class="tab-pane" id="LaboratoryThird">
        <div class="tab-pane " >

        <h5> Laboratory Test Investigation</h5>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name Of Investigation</th>
                    <th>Date</th>
                    <th>Detail</th>
                    <!--  <th>Reference</th>-->
                </tr>
                </thead>
                <tbody id="testItemsSecond">
                <?php       
        foreach ($testReq as $k => $rev) {
            //$testReq = $testReq['0'];
            $eachTest = new EachTest();
            $eachDataDetail = $eachTest->find_all_requests_by_request_test_id($rev->id);
            foreach ($eachDataDetail as $eachD) {
                $clinicHistory = new TestRequest();
                $clinicData = $clinicHistory->find_all_requests_by_id($eachD->test_request_id);
                $testData = new Test();
                $testIddata = $testData->find_all_by_test_id($eachD->test_id); ?>
                    <tr data-id="">
                        <td>
                            <div class="checkbox">
                                <label>
                                    <?php echo $eachD->test_name; ?>
                                </label>
                            </div>

                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <?php echo date("d-m-Y", strtotime($eachD->date)); ?>
                                </label>
                            </div>

                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <?php echo $clinicData[0]->doc_com; ?>
                                </label>
                            </div>

                        </td>
                    </tr>
                <?php
            }
        } ?>
                </tbody>
            </table>
        </div>

        </div>
        

        </div>


    <!-- Radiologist Data show -->
    <div class="tab-pane" id="RadiologyThird">
<div class="row">
    <div class="col-md-12">            

                <h5>Radiology/Ultrasound Test Investigation</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name Of Investigation</th>
                            <th>Date</th>
                            <th>Detail</th>
                        </tr>
                        </thead>
                        <?php       
        foreach ($scanReq as $k => $rev) {
            $eachScan = new EachScan();
            $eachScanDetail = $eachScan->find_all_requests_by_request_test_id_scan($rev->id);
            foreach ($eachScanDetail as $eachScData) {
                $clinicHistory = new ScanRequest();
                $clinicData = $clinicHistory->find_all_requests_by_id_scan($eachScData->scan_request_id); ?>
                    <tr data-id="">
                        <td>
                            <div class="checkbox">
                                <label>
                                    <?php echo $eachScData->scan_name; ?>
                                </label>
                            </div>

                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <?php echo date("d-m-Y", strtotime($eachScData->date)); ?>
                                </label>
                            </div>

                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <?php echo $clinicData[0]->doc_com; ?>
                                </label>
                            </div>

                        </td>
                    </tr>
                <?php
            }
        } ?>
                    </table>
                </div>

            
      


    </div>
</div>

</div>
  
<div class="tab-pane" id="DrugThird">
<div class="row">
    <div class="col-md-12">
    <h5>Drug Prescription</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name Of Investigation</th>
                            <th>Qty</th>
                            <th>Dosage</th>
                            <th>Date</th>
                            <th>Detail</th>
                        </tr>
                        </thead>
                        <?php       
        foreach ($drugReq as $k => $rev) {
            //$drugReq = $drugReq['0'];
            $eachDrug = new EachDrug();
            $eachDrugDetail = $eachDrug->find_all_requests_by_consultant_for_scan_for_drug($rev->id);
            foreach ($eachDrugDetail as $eacDruData) {
                $clinicHistory = new DrugRequest();
                $clinicData = $clinicHistory->find_all_requests_by_id_scan_for_drug($eacDruData->drug_request_id); ?>
                    <tr data-id="">
                        <td>
                            <div class="checkbox">
                                <label>
                                    <?php echo $eacDruData->product_name; ?>
                                </label>
                            </div>

                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <?php echo $eacDruData->quantity; ?>
                                </label>
                            </div>

                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <?php echo $rev->dosage; ?>
                                </label>
                            </div>

                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <?php echo date("d-m-Y", strtotime($rev->date)); ?>
                                </label>
                            </div>

                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <?php echo $clinicData[0]->doc_com; ?>
                                </label>
                            </div>

                        </td>
                    </tr>
                <?php
            }
        } ?>
                    </table>
                </div>
    </div>
</div>
</div>

<div class="tab-pane" id="SymptomAnswer">
<div class="row">
    <div class="col-md-12">
    <h5>Symptom Result</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <!-- <th>Question</th> -->
                            <th>Result Description</th>
                            <th>Result Precaution</th>
                            <th>Result Remedies</th>
                            <th>Result Status</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <?php    
						$symptomResultData = SymptomResultTable::find_by_user_id($patient->id);
						
                        //$symptomAnswer = SymptomAnswerTable::find_by_user_id_all($patient->id)  ;
						if(!empty($symptomResultData)){
        foreach ($symptomResultData as $k => $rev) {
            //$questionName = QuestionTable::find_by_id($rev->question_id);
            
            // $answervalue = json_decode(($questionName->answer_value));
            // $answerLabel = json_decode(($questionName->answer_label));
            // $optAnswerValue = json_decode(($rev->answer));
            // $optKety = "";
            
            //pre_d($optKety);
           ?>
                    <tr>
                        
                        <td><?= $rev->result_desc ?></td>
                        <td><?= $rev->result_precau ?></td>
                        <td><?= $rev->result_remedies ?></td>
                        <td><?= $rev->result_status ?></td>
                        <td><?= date("m-d-Y", strtotime($rev->created)) ?></td>
                    </tr>
           <?php
						} } ?>
                    </table>
                </div>
    </div>
</div>
</div>
    </div>







</div>
</div>
