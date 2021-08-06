<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/30/2019
 * Time: 11:54 AM
 */

require_once("../includes/initialize.php");


$drugRequest = DrugRequest::find_by_id($_GET['id']);
$admission   = ReferAdmission::find_by_patient($drugRequest->patient_id);
$ward = Wards::find_by_id($drugRequest->ward_id);
if (empty($drugRequest)) {
    redirect_to('cost.php');
}

$user = User::find_by_id($session->user_id);


if (is_post()) {


    if (isset($_POST['generate_bill'])) {


    $drugRequest = DrugRequest::find_by_id($_GET['id']);
    $admission   = ReferAdmission::find_by_patient($drugRequest->patient_id);
    $ward = Wards::find_by_id($drugRequest->ward_id);



    $items = PatientBill::get_bill();
    $total = PatientBill::total_price();

    foreach ($items as $item) {
        echo $item->quantity; echo "<br/>"."<br/>";
      }

      $count_prescription = count($items);

    //    exit;

    //  echo PatientBill::total_unit();  exit;

    $services = array();
    foreach ($items as $item) {
        $drug                   = EachDrug::find_by_id($item->id);
        $services[]             = $drug->product_name;
    }
    $json = json_encode($services);

    $today = strftime("%Y-%m-%d %H:%M:%S", time());

    $newAccountHistory                   = new AccountHistory();
    $newAccountHistory->sync             =  "off";
    $newAccountHistory->ref_admission_id = $admission->id;
    $newAccountHistory->patient_id       = $drugRequest->patient_id;
    $newAccountHistory->wallet_balance   = $admission->wall_balance - $total;
    $newAccountHistory->credit           = "";
    $newAccountHistory->debit            = $total;
    $newAccountHistory->services         = $json;
    $newAccountHistory->date             = strftime("%Y-%m-%d %H:%M:%S", time());

    $admission->wall_balance = $admission->wall_balance - $total;

    if ($admission->save()) {
        $newAccountHistory->save();

        $drugService                  = new DrugServices();
        $drugService->sync            = "off";
        $drugService->bill_id         = 0;
        $drugService->drug_request_id = $drugRequest->id;
        $drugService->ward_clinic     = $ward->ward_number;
        $drugService->services        = $json;
        $drugService->unit            = PatientBill::total_unit();
        $drugService->status          = 'CLEARED';
        $drugService->date            = strftime("%Y-%m-%d %H:%M:%S", time());
        $drugService->save();

        $drugRequest->not_available -= $count_prescription;
        // $drugRequest->not_available -= PatientBill::total_unit();


        if ($drugRequest->not_available == 0) {
            $drugRequest->status   = "billed";
            //   $drugRequest->status   = "COSTED";
        }
        $drugRequest->bill_id      = 0;
        if ($drugRequest->save()) {
            foreach ($items as $item) {
                $drug                   = EachDrug::find_by_id($item->id);
                $drug->quantity         = $item->quantity;
                $drug->status           = "COSTED";
                $drug->save();
            }
        }
        redirect_to("dispense_service.php");
    }


    if (isset($_POST['send_back'])) {
        $drugRequest = DrugRequest::find_by_id($_GET['id']);

        $drugRequest->pharm_com = $_POST['pharm_com'];
        $drugRequest->status    = "RETURNED";
       if ($drugRequest->save()){
           $newReturnedService                    = new ReturnedServices();
           $newReturnedService->drug_request_id   = $drugRequest->id;
           $newReturnedService->test_request_id   = 0;
           $newReturnedService->scan_request_id   = 0;
           $newReturnedService->returning_officer = $user->full_name();
           $newReturnedService->return_note       = $_POST['pharm_com'];
           $newReturnedService->dept              = "drug";
           $newReturnedService->date              = strftime("%Y-%m-%d %H:%M:%S", time());
           $newReturnedService->save();
           redirect_to("cost.php");
       }
        
    }



}



}


PatientBill::clear_all_bill();


require('../layout/header.php');
?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        Pharmacy </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Cost From Wallet Balance</li>
                        <!--<li class="breadcrumb-item active"> Patient Bill </li>-->
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

        <div class="clearfix">
            <div class="row">
                <!--    <div class="card">

        <div class="body">-->

                <div class="col-lg-6 col-md-6 col-sm-12">

                    <a style="font-size: larger" href="../pharm/cost.php">&laquo;Back</a>
                    <br /> <br />

                    <form action="" method="post">

                        <table>

                            <tr>
                                <td><b>Patient</b></td>
                                <td style='padding-left: 120px'><?php
                                                                $patient = Patient::find_by_id($drugRequest->patient_id);
                                                                echo $patient->full_name();

                                                                ?> </td>
                            </tr>

                            <tr>
                                <td><b>Ward</b></td>
                                <td style='padding-left: 120px'><?php

                                                                echo $ward->ward_number;

                                                                ?> </td>
                            </tr>

                            <tr>
                                <td><b>Wallet Balance</b></td>
                                <td style='padding-left: 120px'><?php

                                                                echo '₦' . $admission->wall_balance

                                                                ?> </td>
                            </tr>


                            <tr>
                                <td><b>Consultant</b></td>
                                <td style='padding-left: 120px'><?php echo $drugRequest->consultant; ?> </td>
                            </tr>


                            <tr>
                                <td><b>Prescription Date</b></td>
                                <td style='padding-left: 120px'>
                                    <?php
                                    $date = date('d/m/Y h:i:a', strtotime($drugRequest->date));
                                    echo $date;
                                    ?>
                                </td>
                            </tr>

                        </table>

                        <table class="table table-bordered table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>Prescribed Drug(s)</th>
                                    <th>Dosage</th>
                                    <th>Duration</th>
                                    <th>Cost</th>
                                </tr>
                            </thead>
                            <tbody id="drugItems">
                                <?php
                                $avail = "yes";
                                //    $test_request = $testRequest->find_by_encounter_id($encounter->id);
                                $sub_total = 0;

                                $eachDrug = EachDrug::find_all_awaiting_requests($drugRequest->id);
                                foreach ($eachDrug as $request) {
                                    $product = Product::find_by_id($request->product_id);
                                ?>
                                    <tr>
                                        <td><?php echo $request->product_name; ?></td>
                                        <td><?php echo $request->dosage; ?></td>
                                        <td><?php echo $request->duration; ?></td>
                                        <td><input type="checkbox" class="add_to_bill" data-id="<?php echo $request->id ?>" value="<?php echo $request->id ?>"></td>

                                    </tr>
                                <?php
                                } ?>

                                <tr>
                                    <th>Doctor's Note</th>
                                    <td colspan="3"><?php echo $drugRequest->doc_com ?></td>
                                </tr>
                                <tr>
                                    <th>Pharmacist's Note</th>
                                    <td colspan="3"><textarea class='form-control' rows='2' cols='70' placeholder='Note' name='pharm_com' required></textarea></td>
                                </tr>

                                <tr>
                                    <td colspan="4"><button type="submit" name="send_back" class="btn btn-danger"> Send Prescription Back To Doctor </button></td>
                                </tr>


                        </table>


                    </form>



                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 bill" id="drugCheck">
                </div>


            </div>

        </div>
    </div>

</div>





<?php

require('../layout/footer.php');
