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

//$prescribed = new Prescribed();

//$test  = new TestRequest();


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
                            <div class="col-lg-7 col-md-8 col-sm-7">

                                <div id="body">


                                    <a style="font-size: larger" href="billed.php">&laquo;Back</a>
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
                                                <th>Quantity</th>
                                                <th>Sub-Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            if (!empty(DrugRequest::find_costed_bill_dept($bill->id))) {
                                                $drugs    = DrugRequest::find_costed_bill_dept($bill->id);

                                              //  print_r($drugs); exit;

                                                $drug_Service = DrugServices::find_by_bill_id($bill->id);

                                                $decode = json_decode($drug_Service->services);

                                                $eachDrug = EachDrug::find_all_costed($drugs->id);

                                                foreach ($decode as $each) {
                                             //   foreach ($eachDrug as $each) {
                                                       $parts = explode(',', $each);
                                                       $name = $parts[0];  $price = $parts[1];

                                                        $eachDrug = EachDrug::find_by_name_and_request_id($name, $drugs->id);
                                                      //  $product = Product::find_by_id($each->product_id);
                                                          $product = Product::find_by_name($name);
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $name;  // echo $each->product_name; ?></td>
                                                        <td><?php echo "₦$price";    ?></td>
                                                        <td> <?php  echo $eachDrug->quantity; // echo $each->quantity; ?></td>
                                                        <td><?php $y = $price * $eachDrug->quantity; // $y = $product->price * $each->quantity;
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

