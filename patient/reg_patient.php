<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/1/2019
 * Time: 9:25 AM
 */
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);




$bills = Bill::find_waiting_registration();



$index = 1;

require('../layout/header.php');
?>



<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Register Patient </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Paid Bills</li>
                        <!-- <li class="breadcrumb-item active">Payments List</li>-->
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                    <h4> Register Patient </h4>
                        <form class="form-inline" id="basic-form" action="" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Bill Number" name="search" required>
                                <button type="submit" class="btn btn-outline-primary">Search</button>
                                <button type="button" name="search" onClick="location.href=location.href" class="btn btn-outline-warning">Refresh</button>
                            </div>
                        </form>

                        <a href="home.php" style="font-size: large">&laquo; Back</a>

                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-custom">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>S/N</th>
                                        <th>Bill No.</th>
                                        <th>Patient Name</th>
                                        <th>Amount</th>
                                        <th>Billed By</th>
                                        <th>Date </th>
                                        <th>Receipt No.</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($bills as $bill) {   ?>
                                        <tr>
                                            <td><?php echo $index++ ?></td>
                                            <td><a href='print.php?id=<?php echo $bill->id ?>'><?php echo $bill->bill_number ?></a></td>
                                            <td><?php echo $bill->first_name . " " . $bill->last_name ?></td>
                                            <td><?php echo "₦$bill->total_price" ?></td>
                                            <td><?php echo $bill->revenue_officer ?></td>
                                            <td><?php $d_date = date('d/m/Y h:i a', strtotime($bill->date));
                                                echo $d_date ?></td>
                                            <td><a href="create.php?id=<?php echo $bill->id ?>"><?php echo $bill->receipt ?></a></td>
                                            <td><span class="badge badge-warning">BILLED</span></td>
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




<?php

require('../layout/footer.php');
