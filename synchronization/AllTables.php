<?php


require_once("../includes/initialize.php");


if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    if (isset($_POST['send_data'])) {

        $search = $_POST['sync_item'];

        if ($_POST['sync_item'] == 'AccountHistory') {
            $account  = AccountHistory::find_offline();
            $account  = json_encode($account);
            sendJson($account);
        }

        if ($_POST['sync_item'] == 'Admission') {
            $admission  = Admission::find_offline();
            $admission  = json_encode($admission);
            sendJson($admission);
        }

        if ($_POST['sync_item'] == 'Appointment') {
            $appointment  = Appointment::find_offline();
            $appointment  = json_encode($appointment);
            sendJson($appointment);
        }

        if ($_POST['sync_item'] == 'Beds') {
            $beds   = Beds::find_offline();
            $beds   = json_encode($beds);
            sendJson($beds);
        }

        if ($_POST['sync_item'] == 'BedsList') {
            $bedList    = BedsList::find_offline();
            $bedList    = json_encode($bedList);
            sendJson($bedList);
        }

        if ($_POST['sync_item'] == 'Bill') {
            $bills    = Bill::find_offline();
            $bills    = json_encode($bills);
            sendJson($bills);
        }

        if ($_POST['sync_item'] == 'CaseNote') {
            $caseNote    = CaseNote::find_offline();
            $caseNote    = json_encode($caseNote);
            sendJson($caseNote);
        }

        if ($_POST['sync_item'] == 'CaseNotesDoctor') {
            $caseNoteDr    = CaseNote::find_offline();
            $caseNoteDr    = json_encode($caseNoteDr);
            sendJson($caseNoteDr);
        }

        if ($_POST['sync_item'] == 'CaseNotesDoctor') {
            $caseNoteDr    = CaseNotesDoctor::find_offline();
            $caseNoteDr    = json_encode($caseNoteDr);
            sendJson($caseNoteDr);
        }

        if ($_POST['sync_item'] == 'CaseNotesNurse') {
            $caseNoteNr    = CaseNotesNurse::find_offline();
            $caseNoteNr    = json_encode($caseNoteNr);
            sendJson($caseNoteNr);
        }

        if ($_POST['sync_item'] == 'Category') {
            $category    = Category::find_offline();
            $category    = json_encode($category);
            sendJson($category);
        }

        if ($_POST['sync_item'] == 'Clinic') {
            $clinic    = Clinic::find_offline();
            $clinic    = json_encode($clinic);
            sendJson($clinic);
        }

        if ($_POST['sync_item'] == 'Discount') {
            $discount    = Discount::find_offline();
            $discount    = json_encode($discount);
            sendJson($discount);
        }

        if ($_POST['sync_item'] == 'Dispensed') {
            $dispensed    = Dispensed::find_offline();
            $dispensed    = json_encode($dispensed);
            sendJson($dispensed);
        }

        if ($_POST['sync_item'] == 'DispenseHistory') {
            $dispenseHistory    = DispenseHistory::find_offline();
            $dispenseHistory    = json_encode($dispenseHistory);
            sendJson($dispenseHistory);
        }

        if ($_POST['sync_item'] == 'DrugService') {
            $drugService     = DrugServices::find_offline();
            $drugService     = json_encode($drugService);
            sendJson($drugService);
        }

        if ($_POST['sync_item'] == 'DrugRequest') {
            $drugRequest    = DrugRequest::find_offline();
            $drugRequest    = json_encode($drugRequest);
            sendJson($drugRequest);
        }

        if ($_POST['sync_item'] == 'EachDrug') {
            $eachDrug    = EachDrug::find_offline();
            $eachDrug    = json_encode($eachDrug);
            sendJson($eachDrug);
        }

        if ($_POST['sync_item'] == 'EachScan') {
            $eachScan    = EachScan::find_offline();
            $eachScan    = json_encode($eachScan);
            sendJson($eachScan);
        }

        if ($_POST['sync_item'] == 'Emergency') {
            $emergency   = Emergency::find_offline();
            $emergency   = json_encode($emergency);
            sendJson($emergency);
        }

        if ($_POST['sync_item'] == 'EmTestRequest') {
            $emTestRequest  = EmergencyTestRequest::find_offline();
            $emTestRequest   = json_encode($emTestRequest);
            sendJson($emTestRequest);
        }

        if ($_POST['sync_item'] == 'Enrollee') {
            $enrollee   = Enrollee::find_offline();
            $enrollee   = json_encode($enrollee);
            sendJson($enrollee);
        }

        if ($_POST['sync_item'] == 'EnrolleePatient') {
            $enrolleePat   = EnrolleePatient::find_offline();
            $enrolleePat   = json_encode($enrolleePat);
            sendJson($enrolleePat);
        }

        if ($_POST['sync_item'] == 'EnrolleeSub') {
            $enrolleeSub   = EnrolleeSubscription::find_offline();
            $enrolleeSub   = json_encode($enrolleeSub);
            sendJson($enrolleeSub);
        }

        if ($_POST['sync_item'] == 'Investigation') {
            $investigation  = Investigation::find_offline();
            $investigation   = json_encode($investigation);
            sendJson($investigation);
        }

        if ($_POST['sync_item'] == 'IPDServiceLog') {
            $ipd  = IPDServiceLog::find_offline();
            $ipd   = json_encode($ipd);
            sendJson($ipd);
        }

        if ($_POST['sync_item'] == 'IPDServices') {
            $ipdService   = IPDServices::find_offline();
            $ipdService   = json_encode($ipdService);
            sendJson($ipdService);
        }

        if ($_POST['sync_item'] == 'LabService') {
            $labService   = LabServices::find_offline();
            $labService   = json_encode($labService);
            sendJson($labService);
        }

        if ($_POST['sync_item'] == 'LabWalkIn') {
            $labWalkIn   = LabWalkIn::find_offline();
            $labWalkIn   = json_encode($labWalkIn);
            sendJson($labWalkIn);
        }

        if ($_POST['sync_item'] == 'Locations') {
            $loc   = Locations::find_offline();
            $loc   = json_encode($loc);
            sendJson($loc);
        }

        if ($_POST['sync_item'] == 'Notification') {
            $not   = Notification::find_offline();
            $not   = json_encode($not);
            sendJson($not);
        }

        if ($_POST['sync_item'] == 'NurseHistory') {
            $nurseHist   = NurseHistory::find_offline();
            $nurseHist   = json_encode($nurseHist);
            sendJson($nurseHist);
        }

        if ($_POST['sync_item'] == 'OrderItems') {
            $orderItems   = OrderItems::find_offline();
            $orderItems   = json_encode($orderItems);
            sendJson($orderItems);
        }

        if ($_POST['sync_item'] == 'Orders') {
            $orders   = Order::find_offline();
            $orders   = json_encode($orders);
            sendJson($orders);
        }

        if ($_POST['sync_item'] == 'Patient') {
            $patient  = Patient::find_offline();
            $patient  = json_encode($patient);
            sendJson($patient);
        }

        if ($_POST['sync_item'] == 'PatientSubClinic') {
            $patientSubClinic  = PatientSubClinic::find_offline();
            $patient  = json_encode($patient);
            sendJson($patient);
        }

        if ($_POST['sync_item'] == 'ProductBatch') {
            $productBatch  = ProductBatch::find_offline();
            $productBatch  = json_encode($productBatch);
            sendJson($productBatch);
        }

        if ($_POST['sync_item'] == 'ProductType') {
            $productType   = ProductType::find_offline();
            $productType  = json_encode($productType);
            sendJson($productType);
        }

        if ($_POST['sync_item'] == 'RadioService') {
            $radioService   = RadioServices::find_offline();
            $radioService   = json_encode($radioService);
            sendJson($radioService);
        }

        if ($_POST['sync_item'] == 'RadWalkIn') {
            $radWalkIn   = RadWalkIn::find_offline();
            $radWalkIn   = json_encode($radWalkIn);
            sendJson($radWalkIn);
        }

        if ($_POST['sync_item'] == 'ReferAdmission') {
            $refAdm   = ReferAdmission::find_offline();
            $refAdm   = json_encode($refAdm);
            sendJson($refAdm);
        }

        if ($_POST['sync_item'] == 'Referrals') {
            $referrals   = Referrals::find_offline();
            $referrals   = json_encode($referrals);
            sendJson($referrals);
        }

        if ($_POST['sync_item'] == 'Result') {
            $result   = Result::find_offline();
            $result   = json_encode($result);
            sendJson($result);
        }

        if ($_POST['sync_item'] == 'ReturnedServices') {
            $returnedServices   = ReturnedServices::find_offline();
            $returnedServices   = json_encode($returnedServices);
            sendJson($returnedServices);
        }

        if ($_POST['sync_item'] == 'RevenueHead') {
            $revenueHead   = RevenueHead::find_offline();
            $revenueHead   = json_encode($revenueHead);
            sendJson($revenueHead);
        }

        if ($_POST['sync_item'] == 'Rooms') {
            $rooms   = ConsultingRooms::find_offline();
            $rooms   = json_encode($rooms);
            sendJson($rooms);
        }

        if ($_POST['sync_item'] == 'ScanRequest') {
            $scanRequest   = ScanRequest::find_offline();
            $scanRequest   = json_encode($scanRequest);
            sendJson($scanRequest);
        }

        if ($_POST['sync_item'] == 'ScanResult') {
            $scanResult   = ScanResult::find_offline();
            $scanResult   = json_encode($scanResult);
            sendJson($scanResult);
        }

        if ($_POST['sync_item'] == 'ServiceBooking') {
            $serviceBooking  = ServiceBooking::find_offline();
            $serviceBooking   = json_encode($serviceBooking);
            sendJson($serviceBooking);
        }

        if ($_POST['sync_item'] == 'Settlement') {
            $settlement  = Settlement::find_offline();
            $settlement   = json_encode($settlement);
            sendJson($settlement);
        }

        if ($_POST['sync_item'] == 'StockIn') {
            $stockIn  = StockIn::find_offline();
            $stockIn   = json_encode($stockIn);
            sendJson($stockIn);
        }

        if ($_POST['sync_item'] == 'Storage') {
            $storage   = Storage::find_offline();
            $storage   = json_encode($storage);
            sendJson($storage);
        }

        if ($_POST['sync_item'] == 'SubClinic') {
            $subClinic   = SubClinic::find_offline();
            $subClinic   = json_encode($subClinic);
            sendJson($subClinic);
        }

        if ($_POST['sync_item'] == 'Test') {
            $test   = Test::find_offline();
            $test   = json_encode($test);
            sendJson($test);
        }

        if ($_POST['sync_item'] == 'TestRequest') {
            $testRequest   = TestRequest::find_offline();
            $testRequest   = json_encode($testRequest);
            sendJson($testRequest);
        }

        if ($_POST['sync_item'] == 'TestResult') {
            $testResult  = TestResult::find_offline();
            $testResult   = json_encode($testResult);
            sendJson($testResult);
        }

        if ($_POST['sync_item'] == 'Unit') {
            $unit = Unit::find_offline();
            $unit   = json_encode($unit);
            sendJson($unit);
        }

        if ($_POST['sync_item'] == 'User') {
            $user   = User::find_offline();
            $user   = json_encode($user);
            sendJson($user);
        }

        if ($_POST['sync_item'] == 'UserSubClinic') {
            $userSubClinic   = UserSubClinic::find_offline();
            $userSubClinic   = json_encode($userSubClinic);
            sendJson($userSubClinic);
        }

        if ($_POST['sync_item'] == 'UserMultiWards') {
            $userMultiWards   = UserMultiWards::find_offline();
            $userMultiWards   = json_encode($userMultiWards);
            sendJson($userMultiWards);
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                        class="fa fa-arrow-left"></i></a> Medical Records</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Records</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">

                <div class="col-lg-12 col-md-12">
                    <div class="card">


                        <div class="body">


                            <h4>Synchronize</h4>
                            <hr/>

                            <a href="<?php echo emr_lucid ?>" style="font-size: x-large">&laquo; Back</a>

                            <?php

                            if (is_post()) {
                                if ($err) {
                                    echo "<h4 style='color: red'> 'cURL Error #: ' . $err </h4>";
                                    //  echo "<h2 style='color: red'>Failed to pull data!</h2>";
                                } else {
                                    echo "<h4 style='color: green'> Successful! </h4>";
                                }
                            }
                            ?>

                            <div class="row">

                                <div class="col-md-6">

                                    <h4>Send Data Online</h4>

                                    <form class="form-inline" action="" method="post">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <select class="form-control" name="sync_item" style="width: 300px;"
                                                        required>
                                                    <option value="">--Select Table--</option>
                                                    <option value="AccountHistory">AccountHistory</option>
                                                    <option value="Admission">Admission</option>
                                                    <option value="Appointment">Appointment</option>
                                                    <option value="Beds">Beds</option>
                                                    <option value="BedsList">BedsList</option>
                                                    <option value="Bill">Bill</option>
                                                    <option value="CaseNote">CaseNote</option>
                                                    <option value="CaseNotesDoctor">CaseNotesDoctor</option>
                                                    <option value="CaseNotesNurse">CaseNotesNurse</option>
                                                    <option value="Category">Category</option>
                                                    <option value="Clinic">Clinic</option>
                                                    <option value="Discount">Discount</option>
                                                    <option value="Dispensed">Dispensed</option>
                                                    <option value="DispenseHistory">DispenseHistory</option>
                                                    <option value="DrugService">DrugService</option>
                                                    <option value="DrugRequest">DrugRequest</option>
                                                    <option value="EachDrug">EachDrug</option>
                                                    <option value="EachScan">EachScan</option>
                                                    <option value="Emergency">Emergency</option>
                                                    <option value="EmTestRequest">EmTestRequest</option>
                                                    <option value="Enrollee">Enrollee</option>
                                                    <option value="EnrolleePatient">EnrolleePatient</option>
                                                    <option value="EnrolleeSub">EnrolleeSub</option>
                                                    <option value="Investigation">Investigation</option>
                                                    <option value="IPDServiceLog">IPDServiceLog</option>
                                                    <option value="IPDServices">IPDServices</option>
                                                    <option value="LabService">LabService</option>
                                                    <option value="LabWalkIn">LabWalkIn</option>
                                                    <option value="Locations">Locations</option>
                                                    <option value="Notification">Notification</option>
                                                    <option value="NurseHistory">NurseHistory</option>
                                                    <option value="OrderItems">OrderItems</option>
                                                    <option value="Orders">Orders</option>
                                                    <option value="Patient">Patient</option>
                                                    <option value="PatientSubClinic">PatientSubClinic</option>
                                                    <option value="ProductBatch">ProductBatch</option>
                                                    <option value="ProductType">ProductType</option>
                                                    <option value="RadioService">RadioService</option>
                                                    <option value="RadWalkIn">RadWalkIn</option>
                                                    <option value="ReferAdmission">ReferAdmission</option>
                                                    <option value="Referrals">Referrals</option>
                                                    <option value="Result">Result</option>
                                                    <option value="ReturnedServices">ReturnedServices</option>
                                                    <option value="RevenueHead">RevenueHead</option>
                                                    <option value="Rooms">Rooms</option>
                                                    <option value="ScanRequest">ScanRequest</option>
                                                    <option value="ScanResult">ScanResult</option>
                                                    <option value="ServiceBooking">ServiceBooking</option>
                                                    <option value="Settlement">Settlement</option>
                                                    <option value="StockIn">StockIn</option>
                                                    <option value="Storage">Storage</option>
                                                    <option value="SubClinic">SubClinic</option>
                                                    <option value="Test">Test</option>
                                                    <option value="TestRequest">TestRequest</option>
                                                    <option value="TestResult">TestResult</option>
                                                    <option value="Unit">Unit</option>
                                                    <option value="User">User</option>
                                                    <option value="UserSubClinic">UserSubClinic</option>
                                                    <option value="UserMultiWards">UserMultiWards</option>

                                                    <option value="User">User</option>
                                                    <option value="UserSubClinic">UserSubClinic</option>
                                                    <option value="UserMultiWards">UserMultiWards</option>

                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" name="send_data" class="btn btn-success"> Synchronize
                                        </button>
                                        <input type="button" class="btn btn-danger" value="Refresh"
                                               onClick="location.href=location.href">
                                    </form>

                                </div>


                                <div class="col-md-6">


                                </div>


                            </div>


                            <br/><br/>

                        </div>


                    </div>
                </div>
            </div>


        </div>
    </div>


<?php
require('../layout/footer.php');

