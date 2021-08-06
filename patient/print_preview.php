<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$bill = Bill::find_by_id($_GET['id']);

//require('../layout/header.php');
?>



<div class="container-fluid">


    <div class="body">
        <div class="row">

            <div class="col-md-3">
            </div>

            <div class="col-md-6">

                <div id="body">
                    <h2>THIS IS NOT A RECEIPT</h2>

                    <table>



                        <tr>
                            <td><b>Patient </b></td>
                            <td style='padding-left: 100px'>
                                <?php
                                echo $bill->first_name . " " . $bill->last_name;
                                ?>
                            </td>
                        </tr>


                        <tr>
                            <td><b>Bill Number</b></td>
                            <td style='padding-left: 100px;'> <?php echo $bill->bill_number; ?></td>
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


                            <tr>
                                <td><?php echo $bill->revenues // "Folder/Consultation" 
                                    ?></td>
                                <td>
                                    <!--₦800--> <?php echo  "₦" . $bill->total_price ?></td>
                                <td> 1</td>
                                <td>
                                    <!--₦800--> <?php echo  "₦" . $bill->total_price ?> </td>
                            </tr>




                            <tr>
                                <td colspan='3' class='text-left'><strong>Total Standard Price </strong></td>
                                <td colspan='2' class='text-left'><strong>
                                        <!--₦800--> <?php echo  "₦" . $bill->total_price ?></strong>
                                </td>
                            </tr>

                    </table>
                    <table>


                        <tr>
                            <td><b>Officer</b></td>
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

                <form class="form-inline">
                    <input type="hidden" value="<?php echo $bill->id; ?>" id="billId" />
                    <button type="button" id="printBill" class="btn btn-lg btn-success" data-loading-text="Searching...">Print Bill
                    </button>
                    <a href="print_preview.php" target="_blank" class="btn btn-outline-warning" role="button">
                        Print Bill
                    </a>
                </form>



            </div>

            <div class="col-md-3">
            </div>


        </div>
    </div>

</div>







<?php
//require('../layout/footer.php');
