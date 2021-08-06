<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 5/18/2019
 * Time: 1:41 PM
 */


require_once("../includes/initialize.php");

if (($user->role == 'Super Admin') or ($user->department == 'Pharmacy')) {
    redirect_to(emr_lucid);
}

$user = User::find_by_id($session->user_id);

$items = PatientBill::get_bill();


if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $drug        = $_POST['drug'];
    $carton      = $_POST['carton'];
    $no_carton   = $_POST['no_carton'];
    $quantity    = $_POST['quantity'];

    $new_array = array();
    for ($x = 0; $x < count($drug); $x++) {
        $new_array[$x] = array(
            "name" => $drug[$x], 'Carton' => $carton[$x], 'No In Carton' => $no_carton[$x],
            'quantity' => $quantity[$x]
        );
    }
 //   print_r($new_array);
 
    foreach ($new_array as $item) {
        $product = Product::find_by_name($item['name']);
        $totalQty = $item['Carton'] * $item['No In Carton'] + $item['quantity'];
        $product->total_quantity += $totalQty;
        $product->save();
    }

    $newStock                   = new StockIn();
    $newStock->code             = "123456";
    $newStock->items            = json_encode($new_array);
    $newStock->item_count       = count($new_array);
    $newStock->supplier         = $_POST['supplier'];
    $newStock->pharmacy_station = $_POST['station'];
    $newStock->receiver         = $user->full_name();
    $newStock->date             = strftime("%Y-%m-%d %H:%M:%S", time());
    $newStock->save();
    PatientBill::clear_all_bill();
    redirect_to("stocking.php");



}



//PatientBill::clear_all_bill();


require('../layout/header.php');
?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        Pharmacy </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Assign Drugs</li>
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

        <div class="row clearfix">

            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <!-- <h2>Total Revenue</h2>-->
                        <ul class="header-dropdown">
                            <li><a class="tab_btn" href="javascript:void(0);" title="Weekly">W</a></li>
                            <li><a class="tab_btn" href="javascript:void(0);" title="Monthly">M</a></li>
                            <li><a class="tab_btn active" href="javascript:void(0);" title="Yearly">Y</a></li>
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another Action</a></li>
                                    <li><a href="javascript:void(0);">Something else</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">

                        <div class="row clearfix">
                            <div class="col-sm-12">

                            <a href="stocking.php">Back</a>

                                <div>

                                    <table class="table table-bordered table-condensed table-hover">


                                        <thead>
                                            <tr>
                                                <th>Drug(s)</th>
                                                <th>Carton(s)</th>
                                                <th>No. In Carton</th>
                                                <th>Unit Quantity</th>


                                            </tr>
                                        </thead>

                                        <tbody>
                                            <form action="" method="post">
                                                <?php
                                                $items = PatientBill::get_bill();
                                                foreach ($items as $item) {   ?>
                                                    <tr>
                                                        <td><?php echo $item->name ?>
                                                            <input type='text' class='form-control' name='drug[]' value='<?php echo $item->name ?>' style='width:300px;' hidden>
                                                        </td>
                                                        <td><input type='text' class='form-control' name='carton[]' value='' style='width:100px;'></td>
                                                        <td>
                                                            <input type='text' class='form-control' name='no_carton[]' value='' style='width:100px;'>
                                                            <!--
                                                            <select style='width: 100px' class='form-control' required id='dosage' name='dosage[]'>
                                                                <option class='form-control' value=''></option>
                                                                <option class='form-control' value='daily'>daily</option>
                                                                <option class='form-control' value='b.i.d'>b.i.d</option>
                                                                <option class='form-control' value='t.i.d'>t.i.d</option>
                                                                <option class='form-control' value='QHS'>QHS</option>
                                                                <option class='form-control' value='Q4h'>Q4h</option>
                                                                <option class='form-control' value='Q4-6h'>Q4-6h</option>
                                                            </select>
                                                            -->
                                                        </td>
                                                        <td><input type='text' class='form-control' name='quantity[]' value='' style='width:100px;'> </td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <th> Supplier's Name </th>
                                                    <td colspan="3"><input type='text' class='form-control' name='supplier'> </td>
                                                </tr>

                                                <tr>
                                                    <th> Pharmacy Station </th>
                                                    <td colspan="3">
                                                         <select class="form-control" name="station" required>
                                                            <option value=""><strong>-- Pharmacy Station --</strong></option>
                                                            <?php
                                                            $station = PharmacyStation::find_all();
                                                            foreach ($station as $s) {
                                                            ?>
                                                                <option value="<?php echo $s->name; ?>"><?php echo $s->name; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                            </select>

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4"><button type="submit" class="btn btn-success"> Save To Dispense </button></td>
                                                </tr>
                                            </form>
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


</div>






<?php
require('../layout/footer.php');
?>