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




$prescribed = new Prescribed();

$test  = new TestRequest();





require('../layout/header.php')


?>


    <div id="main-content">
        <div class="container-fluid">
            <h1 class="sr-only">Dashboard</h1>


      <!--      <a href="bills.php" style="font-size: x-large" id="bill">&laquo; Back</a>     -->
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">

                    <div id="body">
                        <h1 style="padding-left: 120px;"><b>BILL</b></h1>
                        <h2>THIS IS NOT A RECEIPT</h2>

                        <table>



                            <tr>
                                <td><b>Patient </b></td>
                                <td style='padding-left: 100px'><?php
                                $patient = Patient::find_by_id($bill->patient_id);
                                                                    echo $patient->full_name();
                                                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td><b> Folder Number </b></td>
                                <td style='padding-left: 100px'><?php $patient = Patient::find_by_id($bill->patient_id);
                                    echo $patient->folder_number; ?>
                                </td>
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

                            if (!empty(Prescribed::find_costed_bill_by_dept($bill->id))) {
                                $presc = Prescribed::find_costed_bill_by_dept($bill->id);
                            foreach ($presc as $revenue) { ?>
                                <tr>
                                    <td><?php echo $revenue->product_name; ?></td>
                                    <td><?php echo "₦$revenue->unit_price";   ?></td>
                                    <td> <?php echo $revenue->unit; ?></td>
                                    <td><?php $x = $revenue->unit_price * $revenue->unit;
                                          echo "₦$x";  //  echo !empty($x) ? "₦$x" : "₦$bill->total_price";    ?></td>

                                </tr>
                            <?php } }
                            if (!empty(TestRequest::find_costed_bill_by_dept($bill->id))) {
                                $tests = TestRequest::find_costed_bill_by_dept($bill->id);
                                foreach ($tests as $test) { ?>
                                    <tr>
                                        <td><?php echo $test->test_name; ?></td>
                                        <td><?php echo "₦$test->unit_price";    ?></td>
                                        <td> <?php echo $test->unit; ?></td>
                                        <td><?php $y = $test->unit_price * $test->unit;
                                              echo "₦$y";    //  echo !empty($y) ? "₦$y" : "₦$bill->total_price";    ?></td>
                                    </tr>
                               <?php }}

                            if (!empty(ScanRequest::find_costed_bill_by_dept($bill->id))) {
                                $scan = ScanRequest::find_costed_bill_by_dept($bill->id);
                                foreach ($scan as $test) { ?>
                            <tr>
                                <td><?php echo $test->test_name; ?></td>
                                <td><?php echo "₦$test->unit_price";    ?></td>
                                <td> <?php echo $test->unit; ?></td>
                                <td><?php $y = $test->unit_price * $test->unit;
                                    echo "₦$y";    //  echo !empty($y) ? "₦$y" : "₦$bill->total_price";    ?></td>

                            </tr>

                            <?php }}
                            ?>



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

                    <!--
                    <input type="submit" value="Print Bill" id="printBill" class="btn btn-success"/>
                    <button type="button" class="btn btn-warning" id="inputReceipt"
                            data-bill-id="<?php echo $bill->id ?>">Input Receipt
                    </button> -->


                </div>
                <div class="col-sm-3"></div>

            </div>


        </div>
    </div>


<?php
require('../layout/footer.php');

