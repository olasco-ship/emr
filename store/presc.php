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

$user = User::find_by_id($session->user_id);



require('../layout/header.php');
?>



<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                         Prescription History</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Pharmacy</li>
                        <li class="breadcrumb-item active">Patient History</li>
                    </ul>
                </div>
            </div>
        </div>



        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <div class="body">
                        <a style="font-size: larger" href="cost.php">&laquo;Back</a>

                        <ul class="nav nav-tabs-new2">
                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#All"> Prescription History </a></li>
                        </ul>

                    
                        <div class="tab-content m-t-10 padding-0">
                            <div class="tab-pane table-responsive active show" id="All">
                                <table class="table m-b-0 table-hover">
                                    <thead class="thead-warning">

                                        <tr>

                                            <th>Bill No.</th>
                                            <th>Patient Name</th>
                                            <th>Investigation(s) No.</th>
                                            <th>Amount</th>
                                            <th>Date &amp; Time</th>
                                            <th>Status</th>

                                        </tr>

                                    </thead>
                                    <tbody>

                                        <?php foreach ($billed as $bill) {   ?>
                                            <tr>
                                                <td><a href="print_bill.php?id=<?php echo $bill->id ?>"><?php echo $bill->bill_number ?></a></td>
                                                <td><?php $patient = Patient::find_by_id($bill->patient_id);
                                                    echo $patient->full_name()  ?></td>
                                                <td><?php echo $bill->quantity ?></td>
                                                <td><?php echo "₦$bill->total_price"  ?></td>
                                                <td><?php $d_date = date('d/m/Y h:i a', strtotime($bill->date));
                                                    echo $d_date ?></td>
                                                <td><span class="badge badge-info">BILLED</span></td>
                                                <!--  <td><a class='inputReceipt' href='#' data-product-id= <?php /*echo $bill->id */ ?> >Input Receipt</a></td>-->
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>






<?php

require('../layout/footer.php');
