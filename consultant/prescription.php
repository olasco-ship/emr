<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/30/2019
 * Time: 11:54 AM
 */

require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$drugRequest = DrugRequest::find_by_id($_GET['id']);

$clinic      = Clinic::find_by_id($drugRequest->clinic_id);

if (empty($drugRequest)) {
    redirect_to('ret_presc.php');
}

$user = User::find_by_id($session->user_id);

if (is_post()) {

    if (isset($_POST['generate_bill'])) {


        $drugRequest = DrugRequest::find_by_id($_GET['id']);

        $items = PatientBill::get_bill();

        foreach ($items as $item) {
            echo $item->quantity; echo "<br/>"."<br/>";
        }

        $count_prescription = count($items);

        //   print_r($items);  echo "<br/>"."<br/>";
        //   print_r($drugRequest);
        //       exit;

        $today = date_only(strftime("%Y-%m-%d %H:%M:%S", time()));

        $last_bills = Bill::find_last_id();
        $last_bill = 0;
        foreach ($last_bills as $last_bill) {
            $last_bill->bill_number;
        }
        $last_date = substr($last_bill->bill_number, 0, 6);

        $system_num = "01";
        $bill_numb = 0;
        $date = date("ymd");
        if (empty($last_bill->bill_number)) {
            $n = 1;
            $n = sprintf('%04u', $n);
            $bill_numb = $date . $system_num . $n;
        } else {
            if ($last_date != $date) {
                $n = 1;
                $n = sprintf('%04u', $n);
                $bill_numb = $date . $system_num . $n;
            } else {
                $last_bill->bill_number++;
                $bill_numb = $last_bill->bill_number;
            }
        }

        $pat = Patient::find_by_id($drugRequest->patient_id);

        $revenues = array();
        foreach ($items as $item) {
            $test                   = EachDrug::find_by_id($item->id);
            $revenues[]             = $test->product_name;
        }
        $json = json_encode($revenues);

        if ($drugRequest->waiting_list_id != 0) {
            $waitingList = WaitingList::find_by_id($drugRequest->waiting_list_id);
            $subClin = SubClinic::find_by_id($waitingList->sub_clinic_id);
        }

        $bill                  = new Bill();
        $bill->sync            = "unsync";
        $bill->bill_number     = $bill_numb;
        $bill->exempted_by     = "";
        $bill->payment_type    = "";
        $bill->patient_id      = $drugRequest->patient_id;
        $bill->first_name      = $pat->first_name;
        $bill->last_name       = $pat->last_name;
        $bill->revenues        = $json;
        $bill->total_price     = PatientBill::total_price();
        $bill->quantity        = PatientBill::total_unit();
        $bill->cost_by         = $user->full_name();
        $bill->revenue_officer = $user->full_name();
        $bill->status          = "billed";
        $bill->receipt         = "";
        $bill->dept            = "drug";
        $bill->date_only       = $today;
        $bill->date = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($bill->save()) {
            $drugRequest->not_available -= $count_prescription;
            //   $drugRequest->not_available -= PatientBill::total_unit();
            if ($drugRequest->not_available == 0) {
                $drugRequest->status   = "billed";
            }
            $drugRequest->bill_id      = $bill->id;
            if ($drugRequest->save()) {
                /*   $revenues = array();*/
                foreach ($items as $item) {
                    $drug                   = EachDrug::find_by_id($item->id);
                    $drug->quantity         = $item->quantity;
                    $drug->status           = "COSTED";
                    $drug->save();
                }
                /* $json = json_encode($revenues);*/
            }

            $drugService                  = new DrugServices();
            $drugService->sync            = "off";
            $drugService->bill_id         = $bill->id;
            $drugService->drug_request_id = $drugRequest->id;
            if ($drugRequest->ward_id == 0) {
                $drugService->ward_clinic     = $subClin->name;
            } else {
                $ward = Wards::find_by_id($drugRequest->ward_id);
                $drugService->ward_clinic     = $ward->ward_number;
            }
            //  $drugService->ward_clinic     = $subClin->name;
            $drugService->services        = $json;
            $drugService->unit            = PatientBill::total_unit();
            $drugService->status          = 'billed';
            $drugService->date            =  strftime("%Y-%m-%d %H:%M:%S", time());
            $drugService->save();
            redirect_to("print_bill.php?id=$bill->id");
        }
    }

    if (isset($_POST['send_back'])) {
//        echo "we getting back to doc";  exit;
        $doc_com = $_POST['pharm_com'];
        $drugRequest->doc_com = $doc_com;
        $drugRequest->status = "awaiting_costing";
        $drugRequest->save();

        $each = EachDrug::find_by_id($drugRequest->id);
        $each->status = "OPEN";

        redirect_to('index.php');
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
                            Pharmacy
                        </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Prescription Costing</li>
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

                    <div class="col-lg-6 col-md-6 col-sm-12">

                        <a style="font-size: larger" href="ret_presc.php">&laquo;Back</a>

                        <form action="" method="post">


                            <table>

                                <tr>
                                    <td><b>Patient</b></td>
                                    <td style='padding-left: 200px'><?php
                                        $patient = Patient::find_by_id($drugRequest->patient_id);
                                        echo $patient->full_name();

                                        ?> </td>
                                </tr>


                                <tr>
                                    <td><b>Consultant</b></td>
                                    <td style='padding-left: 200px'><?php echo $drugRequest->consultant; ?> </td>
                                </tr>


                                <tr>
                                    <td><b>Prescription Date</b></td>
                                    <td style='padding-left: 200px'>
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
                                    <!--   <th>Price</th>  -->
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="drugItems">
                                <?php
                                $avail = "yes";
                                //    $test_request = $testRequest->find_by_encounter_id($encounter->id);
                                $sub_total = 0;

                                $eachDrug = EachDrug::find_all_awaiting_requests($drugRequest->id);
                                foreach ($eachDrug as $request) {
                                    $drug = Product::find_by_id($request->product_id);
                                    ?>
                                    <tr>
                                        <td><?php echo $drug->name; ?></td>
                                        <td><?php echo $request->dosage; ?></td>
                                        <td><?php echo $request->duration; ?></td>
                                        <td><a href="edit_returned_prescription.php?id=<?php echo $drugRequest->id ?>">Edit</a></td>
                                        <td><a href="add_new_drug.php?id=<?php echo $drugRequest->id ?>">Add New Drug</a> </td>
                                    </tr>
                                <?php } ?>

                                <tr>
                                    <th>Doctor's Note</th>
                                    <td colspan="3"><?php echo $drugRequest->doc_com ?></td>
                                </tr>
                                <tr>
                                    <th>Pharmacist's Note</th>
                                    <td colspan="3"><?php echo $drugRequest->pharm_com ?></textarea></td>
                                </tr>

                                <tr>
                                    <th>Doctor's Comment</th>
                                    <td colspan="3"><textarea class='form-control' rows='2' cols='70' placeholder='Note' name='pharm_com' required></textarea></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><button type="submit" name="send_back" class="btn btn-danger"> Send Prescription Back To Pharmacist </button></td>
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




    <div class="modal fade" tabindex="-1" role="dialog" id="product_return_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <!-- <h4 class="modal-title">Modal title</h4> -->
                    <h4 class="modal-title" id="returnProductItem"></h4>
                </div>
                <div class="modal-body">
                    <div id="editContent"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <!--          <button type="button" class="btn btn-primary" id="editAction">Edit</button>     -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


<?php

require('../layout/footer.php');
