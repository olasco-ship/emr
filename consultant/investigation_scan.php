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

$scanRequest = ScanRequest::find_by_id($_GET['id']);
if (empty($scanRequest)) {
    redirect_to('ret_test.php');
}

$user = User::find_by_id($session->user_id);

if (is_post()) {


    if (isset($_POST['send_back'])) {
//        echo "we getting back to doc";  exit;
        $doc_com = $_POST['pharm_com'];
        $scanRequest->doc_com = $doc_com;
        $scanRequest->status = "awaiting_costing";
        $scanRequest->save();

        $each = EachScan::find_by_id($scanRequest->id);
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

                        <a style="font-size: larger" href="ret_scan.php">&laquo;Back</a>

                        <form action="" method="post">


                            <table>

                                <tr>
                                    <td><b>Patient</b></td>
                                    <td style='padding-left: 200px'><?php
                                        $patient = Patient::find_by_id($scanRequest->patient_id);
                                        echo $patient->full_name();

                                        ?> </td>
                                </tr>


                                <tr>
                                    <td><b>Consultant</b></td>
                                    <td style='padding-left: 200px'><?php echo $scanRequest->consultant; ?> </td>
                                </tr>


                                <tr>
                                    <td><b>Prescription Date</b></td>
                                    <td style='padding-left: 200px'>
                                        <?php
                                        $date = date('d/m/Y h:i:a', strtotime($scanRequest->date));
                                        echo $date;
                                        ?>
                                    </td>
                                </tr>

                            </table>

                            <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th>Investigation(s)</th>
                                    <!--                                    <th>Dosage</th>-->
                                    <!--                                    <th>Duration</th>-->
                                    <!--   <th>Price</th>  -->
                                    <!--                                    <th></th>-->
                                    <!--                                    <th></th>-->
                                </tr>
                                </thead>
                                <tbody id="labItems">
                                <?php
                                $avail = "yes";
                                //    $test_request = $testRequest->find_by_encounter_id($encounter->id);
                                $sub_total = 0;

                                $eachTest = EachScan::find_all_awaiting_requests($scanRequest->id);
                                foreach ($eachTest as $request) {
                                    $test = Test::find_by_id($request->scan_id);
                                    ?>
                                    <tr>
                                        <td><?php echo $test->name; ?></td>
                                        <!--                                        <td>--><?php //echo $request->dosage; ?><!--</td>-->
                                        <!--                                        <td>--><?php //echo $request->duration; ?><!--</td>-->
                                        <!--                                        <td><a href="edit_returned_prescription.php?id=--><?php //echo $drugRequest->id ?><!--">Edit</a></td>-->
                                        <!--                                        <td><a href="add_new_drug.php?id=--><?php //echo $drugRequest->id ?><!--">Add New Drug</a> </td>-->
                                    </tr>
                                <?php } ?>

                                <tr>
                                    <th>Doctor's Note</th>
                                    <td colspan="3"><?php echo $scanRequest->doc_com ?></td>
                                </tr>
                                <tr>
                                    <th>Radiologist's Note</th>
                                    <td colspan="3"><?php echo $scanRequest->scan_com ?></textarea></td>
                                </tr>

                                <tr>
                                    <th>Doctor's Comment</th>
                                    <td colspan="3"><textarea class='form-control' rows='2' cols='70' placeholder='Note' name='pharm_com' required></textarea></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><button type="submit" name="send_back" class="btn btn-danger"> Send Investigation Back To Scientist </button></td>
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

