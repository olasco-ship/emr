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

    $items = TestBill::get_bill();
    $item = $items[0];
    //  print_r($items);
    //  echo "<br/>";
    //  echo count($);
    // exit;

    $testRequest = TestRequest::find_requests($waiting_list->id, $patient->id);
    $testRequest->sync = "off";
    $testRequest->waiting_list_id = $waiting_list->id;
    $testRequest->ref_adm_id = 0;
    $testRequest->patient_id = $patient->id;
    $testRequest->bill_id = 0;
    $testRequest->sub_clinic_id = $waiting_list->sub_clinic_id;
    $testRequest->consultant = $user->full_name();
    $testRequest->test_no = count($items);
    $testRequest->not_done = count($items);
    $testRequest->doc_com = $_POST['doc_com'];
    $testRequest->lab_com = "";
    $testRequest->status = "OPEN";
    $testRequest->receipt = "";
    $testRequest->date = strftime("%Y-%m-%d %H:%M:%S", time());
    if ($testRequest->save()) {
        foreach ($items as $item) {
            $test = Test::find_by_id($item->id);

            $eachTest = EachTest::find_all_requests($testRequest->id);
            $eachTest->test_id = $test->id;
            $eachTest->test_request_id = $testRequest->id;
            $eachTest->quantity = 1;
            $eachTest->sync = "off";
            $eachTest->test_name = $test->name;
            $eachTest->test_price = $item->price;
            $eachTest->consultant = $user->full_name();
            $eachTest->testResult = "";
            $eachTest->scientist = "";
            $eachTest->pathologist = "";
            $eachTest->status = "REQUEST";
            $eachTest->date = strftime("%Y-%m-%d %H:%M:%S", time());
            $eachTest->save();
        }
        $session->message("Lab Investigations has been updated for this patient");

    }

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
                                <h5>REVIEW LABORATORY TEST</h5>
                                <?php
                                $t_Request = TestRequest::find_requests($waiting_list->id, $patient->id);
                                if (!empty($t_Request)) {
                                    //  if (!empty(TestRequest::find_requests($waiting_list->id, $patient->id))) {
                                    ?>

                                    <h5><u>Selected Laboratory Test/Investigation</u></h5>
                                    <ul style="font-size: large">
                                        <?php
                                        //   $t_Request = TestRequest::find_requests($waiting_list->id);
                                        //  $e_Test = EachTest::find_all_requests($t_Request->id);

                                        $t_Request = TestRequest::find_requests($waiting_list->id, $patient->id);
                                        if (empty($t_Request)) {
                                            echo "<h5>No Lab Investigation selected</h5>";
                                        } else {
                                            $e_Test = EachTest::find_all_requests($t_Request->id);
                                            foreach ($e_Test as $e) {
                                                echo "<li> $e->test_name</li>";
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <?php
                                    //  $t_Request = TestRequest::find_requests($waiting_list->id,$patient->id);
                                    if (!empty($t_Request))
                                        echo "<b>Note: </b>" . $t_Request->doc_com . "<br/>";
                                    ?>

                                    <hr/>

                                <?php } ?>

                                <div class="row">
                                    <div class="col-md-7">

                                        <ul class="nav nav-tabs-new2">
                                            <li class="nav-item"><a class="nav-link active show"
                                                                    data-toggle="tab"
                                                                    href="#Haematology">Haematology</a>
                                            </li>
                                            <li class="nav-item"><a class="nav-link"
                                                                    data-toggle="tab"
                                                                    href="#Chemical">Chemical
                                                    Pathology</a></li>
                                            <li class="nav-item"><a class="nav-link"
                                                                    data-toggle="tab"
                                                                    href="#Microbiology">Microbiology</a>
                                            </li>
                                            <li class="nav-item"><a class="nav-link"
                                                                    data-toggle="tab"
                                                                    href="#Histology">Histology</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="Haematology">

                                                <h5>Haematology</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>Name Of Investigation</th>
                                                            <!--  <th>Reference</th>-->
                                                        </tr>
                                                        </thead>
                                                        <tbody id="testItems">
                                                        <?php // $revs = Test::find_all();
                                                        $revs = Test::find_all_by_unit_id(1);
                                                        foreach ($revs as $rev) { ?>
                                                            <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                                <td>
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox"
                                                                                   class="add_to_bill"
                                                                                   value=""
                                                                                   data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                        </label>
                                                                    </div>

                                                                </td>
                                                                <!-- <td><?php /*echo $rev->reference */ ?></td>-->
                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                            <div class="tab-pane" id="Chemical">

                                                <h5>Chemical Pathology</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>Name Of Investigation</th>
                                                            <!-- <th>Reference</th>-->
                                                        </tr>
                                                        </thead>
                                                        <tbody id="chemItems">
                                                        <?php // $revs = Test::find_all();
                                                        $revs = Test::find_all_by_unit_id(2);
                                                        foreach ($revs as $rev) { ?>
                                                            <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                                <td>
                                                                    <div class="checkbox">
                                                                        <label><input
                                                                                    type="checkbox"
                                                                                    class="add_to_bill"
                                                                                    value=""
                                                                                    data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                        </label>
                                                                    </div>

                                                                </td>
                                                                <!--  <td><?php /*echo $rev->reference */ ?></td>-->
                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                            <div class="tab-pane" id="Microbiology">

                                                <h5> Microbiology </h5>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>Name Of Investigation</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody id="microItems">
                                                        <?php // $revs = Test::find_all();
                                                        $revs = Test::find_all_by_unit_id(3);
                                                        foreach ($revs as $rev) { ?>
                                                            <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                                <td>
                                                                    <div class="checkbox">
                                                                        <label><input
                                                                                    type="checkbox"
                                                                                    class="add_to_bill"
                                                                                    value=""
                                                                                    data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                        </label>
                                                                    </div>

                                                                </td>

                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                            <div class="tab-pane" id="Histology">

                                                <h5> Histology </h5>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>Name Of Investigation</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody id="histoItems">
                                                        <?php // $revs = Test::find_all();
                                                        $revs = Test::find_all_by_unit_id(10);
                                                        foreach ($revs as $rev) { ?>
                                                            <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                                <td>
                                                                    <div class="checkbox">
                                                                        <label><input
                                                                                    type="checkbox"
                                                                                    class="add_to_bill"
                                                                                    value=""
                                                                                    data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                        </label>
                                                                    </div>

                                                                </td>

                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>


                                            </div>

                                        </div>


                                    </div>
                                    <div class="col-md-5 bill" id="testCheck">

                                    </div>
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
require '../layout/footer.php';
