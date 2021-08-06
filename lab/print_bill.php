<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/14/2019
 * Time: 6:10 PM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


$bill = Bill::find_by_id($_GET['id']);



require('../layout/header.php')
?>




    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Patient Bill</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Bill</li>
                            <li class="breadcrumb-item active"> Patient Bill </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="clearfix">
                <div class="card">

                    <div class="body">
                        <div class="row">
                            <div class="col-lg-6 col-md-8 col-sm-6">

                                <div id="body">


                                    <a style="font-size: larger" href="../lab/cost.php">&laquo;Back</a>
                                    <div id="body">
                                        <h1 style="padding-left: 120px;"><b>BILL</b></h1>
                                        <h2>THIS IS NOT A RECEIPT</h2>

                                        <table>
                                            <tr>
                                                <td><b>Patient </b></td>
                                                <td style='padding-left: 100px'><?php
                                                    if ($bill->patient_id == 0){
                                                        echo $bill->first_name . " ". $bill->last_name;
                                                      } else {
                                                        $patient = Patient::find_by_id($bill->patient_id);
                                                        echo $patient->full_name();  
                                                      }
                                                                                                           
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php   if ($bill->patient_id != 0){  ?>  
                                            <tr>
                                                <td><b> Folder Number </b></td>
                                                <td style='padding-left: 100px'><?php $patient = Patient::find_by_id($bill->patient_id);
                                                    echo $patient->folder_number; ?>
                                                </td>
                                            </tr>
                                            <?php }  ?>

                                            <tr>
                                                <?php
                                                if (isset($patient->nhis_tracking) and (!empty($patient->nhis_tracking))) {
                                                    echo "<td><b>NHIS Tracking No.</b></td>";
                                                    echo "<td style='padding-left: 100px'> $patient->nhis_tracking</td>";
                                                }
                                                ?>
                                            </tr>

                                            <tr>
                                                <td><b>Bill Number</b></td>
                                                <td style='padding-left: 100px;'> <?php echo $bill->bill_number; ?></td>
                                            </tr>

                                            <tr>
                                                <?php
                                                if (isset($bill->folder_number) and (!empty($bill->folder_number))) {
                                                    echo "<td><b>Account Number</b></td>";
                                                    echo "<td style='padding-left: 100px'> $bill->folder_number</td>";

                                                } else {

                                                }
                                                ?>
                                            </tr>

                                            <tr>
                                                <?php
                                                if (isset($bill->hospital_number) and (!empty($bill->hospital_number))) {
                                                    echo "<td><b>Hospital Number</b></td>";
                                                    echo "<td style='padding-left: 100px'> $bill->hospital_number</td>";

                                                } else {

                                                }
                                                ?>
                                            </tr>

                                        </table>

                                        <table class="table table-bordered table-condensed table-hover">
                                            <thead>
                                            <tr>
                                                <th>Revenue(s)</th>
                                                <th>Price</th>
                                                <th>Unit</th>
                                                <th>Sub-Total</th>


                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            if (!empty(TestRequest::find_costed_bill_dept($bill->id))) {
                                                $tests = TestRequest::find_costed_bill_dept($bill->id);

                                                $lab_Service = LabServices::find_by_bill_id($bill->id);

                                                $decode = json_decode($lab_Service->services);

                                              //  $eachTest = EachTest::find_all_costed($tests->id);
                                             
                                             //   foreach ($eachTest as $each) {
                                                foreach ($decode as $each) {
                                                    $eachTest = EachTest::find_by_name_and_request_id($each, $tests->id);
                                                        $test = Test::find_by_id($eachTest->test_id);
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $each;  // $each->test_name; ?></td>
                                                        <td><?php echo "₦$eachTest->test_price"; //  echo "₦$test->price";  ?></td>
                                                        <td> <?php echo $eachTest->quantity; ?></td>
                                                        <td><?php $y = $eachTest->test_price * $eachTest->quantity; // $y = $test->price * $each->quantity;
                                                            echo "₦$y";     ?></td>
                                                    </tr>
                                                <?php }     }  ?>



                                            <tr>
                                                <?php
                                                if (isset($patient->nhis_tracking) and (!empty($patient->nhis_tracking))) {
                                                    $ten_percent = $bill->total_price * 0.1;
                                                    echo "<td colspan='3'><b>Amount To Pay</b></td>";
                                                    echo "<td colspan='2'> ₦$ten_percent </td>";
                                                }
                                                ?>
                                            </tr>

                                            <tr>
                                                <td colspan='3' class='text-left'><strong>Total Standard Price </strong></td>
                                                <td colspan='2' class='text-left'><strong><?php echo "₦$bill->total_price"; ?></strong>
                                                </td>
                                            </tr>

                                        </table>
                                        <table>

                                            <tr>
                                                <?php
                                                if (isset($bill->payment_type) and (!empty($bill->payment_type))) {
                                                    echo "<td><b>Payment Type</b></td>";
                                                    echo "<td style='padding-left: 90px'> $bill->payment_type</td>";

                                                } else {

                                                }
                                                ?>
                                            </tr>
                                            <tr>
                                                <?php
                                                if (isset($bill->exempted_by) and (!empty($bill->exempted_by))) {
                                                    echo "<td><b> Exempted By</b></td>";
                                                    echo "<td style='padding-left: 90px'> $bill->exempted_by</td>";

                                                } else {

                                                }
                                                ?>
                                            </tr>

                                            <tr>
                                                <td><b>Biller</b></td>
                                                <td style='padding-left: 90px;'><?php echo $bill->revenue_officer; ?></td>
                                            </tr>


                                            <tr>
                                                <td><b>Bill Date</b></td>
                                                <td style='padding-left: 90px'>
                                                    <?php
                                                    $d_date = date('d/m/Y h:i a', strtotime($bill->date));
                                                    echo $d_date; ?>
                                                </td>
                                            </tr>

                                        </table>
                                        <p style="color: red">This Print-Out is not a Receipt!</p>

                                    </div>

                                    <form class="form-inline" id="formPrint">
                                          <input type="hidden" value="<?php echo $bill->id; ?>"  id="billId"/>
                                        <button type="submit" id="submit" class="btn btn-lg btn-success"
                                                data-loading-text="Searching...">Print Bill
                                        </button>
                                    </form>



                            </div>


                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

























<?php
require('../layout/footer.php');

