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


$testRequest = TestRequest::find_by_id($_GET['id']);
if (empty($testRequest)) {
    redirect_to('cost.php');
}

$user = User::find_by_id($session->user_id);

if (is_post()) {

    if (isset($_POST['generate_bill'])) {


        $testRequest = TestRequest::find_by_id($_GET['id']);
        $items = TestBill::get_bill();

        $count_investigation = count($items);

        //   $item = $items[0];
        //  print($items);  echo $items; exit;

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

        $pat = Patient::find_by_id($testRequest->patient_id);


        $revenues = array();
        foreach ($items as $item) {
            $test                   = EachTest::find_by_id($item->id);
            $revenues[]             = $test->test_name;
        }
        $json = json_encode($revenues);

        if ($testRequest->waiting_list_id != 0) {
            $waitingList = WaitingList::find_by_id($testRequest->waiting_list_id);
            $subClin = SubClinic::find_by_id($waitingList->sub_clinic_id);
        }


        $bill                  = new Bill();
        $bill->sync            = "off";
        $bill->bill_number     = $bill_numb;
        $bill->exempted_by     = "";
        $bill->payment_type    = "";
        $bill->patient_id      = $testRequest->patient_id;
        $bill->first_name      = $pat->first_name;
        $bill->last_name       = $pat->last_name;
        $bill->revenues        = $json;
        $bill->total_price     = TestBill::total_price();
        $bill->quantity        = TestBill::total_unit();
        $bill->cost_by         = $user->full_name();
        $bill->revenue_officer = $user->full_name();
        $bill->status          = "billed";
        $bill->receipt         = "";
        $bill->dept            = "lab";
        $bill->date_only       = $today;
        $bill->date = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($bill->save()) {  
            $testRequest->not_done -= $count_investigation;
         //   $testRequest->not_done -= TestBill::total_unit();
            if ($testRequest->not_done == 0) {
                $testRequest->status   = "billed";
                //  $testRequest->status   = "COSTED";
            }
            $testRequest->bill_id      = $bill->id;
            if ($testRequest->save()) {
                /*   $revenues = array();*/
                foreach ($items as $item) {
                    $test                   = EachTest::find_by_id($item->id);
                    $test->quantity         = $item->quantity;
                    $test->status           = "COSTED";
                    $test->save();
                }
                /* $json = json_encode($revenues);*/
            }

            $labService                  = new LabServices();
            $labService->sync            = "off";
            $labService->bill_id         = $bill->id;
            $labService->test_request_id = $testRequest->id;
            if ($testRequest->ward_id == 0) {
                $labService->ward_clinic     = $subClin->name;
            } else {
                $ward = Wards::find_by_id($testRequest->ward_id);
                $labService->ward_clinic     = $ward->ward_number;
            }
            $labService->services        = $json;
            $labService->unit            = TestBill::total_unit();
            $labService->status          = 'billed';
            $labService->date            =  strftime("%Y-%m-%d %H:%M:%S", time());
            $labService->save();

            redirect_to("print_bill.php?id=$bill->id");
        }
    }


    if (isset($_POST['send_back'])) {
        $testRequest = TestRequest::find_by_id($_GET['id']);

        $testRequest->lab_com   = $_POST['lab_com'];
        $testRequest->status    = "RETURNED";
          if ($testRequest->save()){
           $newReturnedService                    = new ReturnedServices();
           $newReturnedService->sync              = "off";
           $newReturnedService->drug_request_id   = 0;
           $newReturnedService->test_request_id   = $testRequest->id;
           $newReturnedService->scan_request_id   = 0;
           $newReturnedService->returning_officer = $user->full_name();
           $newReturnedService->return_note       = $_POST['lab_com'];
           $newReturnedService->dept              = "lab";
           $newReturnedService->date              = strftime("%Y-%m-%d %H:%M:%S", time());
           $newReturnedService->save();
           redirect_to("cost.php");
       }
        
    }








}


TestBill::clear_all_bill();


require('../layout/header.php');
?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        Laboratory </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Costing</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="clearfix">
            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-12">

                    <a style="font-size: larger" href="../lab/cost.php">&laquo;Back</a>

                    <form action="" method="post">



                        <table>

                            <tr>
                                <td><b>Patient</b></td>
                                <td style='padding-left: 200px'><?php
                                                                $patient = Patient::find_by_id($testRequest->patient_id);
                                                                echo $patient->full_name();

                                                                ?> </td>
                            </tr>


                            <tr>
                                <td><b>Consultant</b></td>
                                <td style='padding-left: 200px'><?php echo $testRequest->consultant; ?> </td>
                            </tr>


                            <tr>
                                <td><b> Test Request Date</b></td>
                                <td style='padding-left: 200px'>
                                    <?php
                                    $date = date('d/m/Y h:i:a', strtotime($testRequest->date));
                                    echo $date;
                                    ?>
                                </td>
                            </tr>

                        </table>
                        <table class="table table-bordered table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>Requested Investigation(s)</th>
                                    <th>Price</th>
                                    <th>Cost</th>
                                </tr>
                            </thead>
                            <tbody id="labItems">
                                <?php
                                $avail = "yes";
                                //    $test_request = $testRequest->find_by_encounter_id($encounter->id);
                                $sub_total = 0;

                                $eachTest = EachTest::find_all_awaiting_requests($testRequest->id);
                                foreach ($eachTest as $request) {
                                    $test = Test::find_by_id($request->test_id);
                                ?>
                                    <tr>
                                        <td><?php echo $request->test_name; ?></td>
                                        <td><?php echo "₦$test->price"; ?></td>
                                        <td><input type="checkbox" class="add_to_bill" data-id="<?php echo $request->id ?>" value="<?php echo $request->id ?>"></td>
                                        <!--<td><input type="checkbox" name="request_id[]" value="<?php /*echo $request->id; */ ?>" > </td>-->
                                    </tr>
                                <?php
                                } ?>

                                <tr>
                                    <th>Doctor's Note</th>
                                    <td colspan="3"><?php echo $testRequest->doc_com ?></td>
                                </tr>
                                <tr>
                                    <th>Med Lab Sci. Note</th>
                                    <td colspan="3"><textarea class='form-control' rows='2' cols='70' placeholder='Note' name='lab_com' required></textarea></td>
                                </tr>

                                <tr>
                                    <td colspan="4"><button type="submit" name="send_back" class="btn btn-danger"> Send Test Request Back To Doctor </button></td>
                                </tr>


                        </table>

                    </form>



                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 bill" id="labCheck">
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
