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
                <div class="card">

                    <div class="body">
                        <div class="row">
                            <div class="col-lg-6 col-md-8 col-sm-6">

                                <div id="body">


                                    <a style="font-size: larger" href="../lab/client_bills.php">&laquo;Back</a>
                                    <div id="body">
                                        <h1 style="padding-left: 120px;"><b>BILL</b></h1>
                                        <h2>THIS IS NOT A RECEIPT</h2>

                                        <table>
                                            <tr>
                                                <td><b>Patient </b></td>
                                                <td style='padding-left: 100px'><?php
                                                  echo   $bill->first_name ." ". $bill->last_name;
                                                   
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b> Folder Number </b></td>
                                                <td style='padding-left: 100px'><?php $patient = Patient::find_by_id($bill->patient_id);
                                                    echo "Walk In Client"; ?>
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

                                                $lab  = LabWalkIn::find_by_bill_id($bill->id);
                                                $decode = json_decode($lab->services);

                                              //  print_r($decode);
                                                foreach ($decode as $d) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $d->name; ?></td>
                                                    <td><?php echo "₦$d->price";    ?></td>
                                                    <td> <?php echo $d->quantity; ?></td>
                                                    <td><?php $y = $d->price * $d->quantity;
                                                        echo "₦$y";      ?></td>
                                                </tr>
                                               <?php }               
                                                
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

