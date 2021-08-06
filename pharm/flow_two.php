<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 5/18/2019
 * Time: 1:41 PM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

$array = PatientBill::get_bill();
if (empty($array)){
    redirect_to("flow_one.php");
}



/*
if (($user->role == 'Super Admin') OR ($user->department == 'Pharmacy')){
    redirect_to(emr_lucid );
}
*/

$index =1;


$array = PatientBill::get_bill();



if (is_post()){

    $pharmacist = $_POST['pharmacy'];
    $station    = $_POST['station'];

    $json = json_encode($array);

  //  $user = User::find_by_id($pharmacy);

    $dispenseHistory                      = new DispenseHistory();
    $dispenseHistory->items               = $json;
    $dispenseHistory->item_count          = count($array);
    $dispenseHistory->dispenser           = $user->full_name();
    $dispenseHistory->dispense_to         = $pharmacist;
    $dispenseHistory->pharmacy_station_id = $station;
    $dispenseHistory->date                = strftime("%Y-%m-%d %H:%M:%S", time());  
    if ($dispenseHistory->save()){
        $array = PatientBill::get_bill(); 
        foreach ($array as $drug) { 
            $product      = Product::find_by_id($drug->id);
            $product->total_quantity -= $drug->quantity;
            $product->save();
            $station_prod = ProductPharmacyStation::find_by_product_and_station($drug->id, $station);
            if (empty($station_prod)){
                $productPharmacyStation                      = new ProductPharmacyStation(); 
                $productPharmacyStation->product_id          = $drug->id;
                $productPharmacyStation->pharmacy_station_id = $station;
                $productPharmacyStation->quantity            = $drug->quantity;
                $productPharmacyStation->date                = strftime("%Y-%m-%d %H:%M:%S", time());
                $productPharmacyStation->save();
            } else {
                    $station_prod->quantity += $drug->quantity;
                    $station_prod->save();
            }

        }
    }
    PatientBill::clear_all_bill();
    redirect_to("print_dispense.php?id=$dispenseHistory->id");



}






require('../layout/header.php');
?>










<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Pharmacy</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dispensary.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Dispensary</li>
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

                         
                                <div class="col-md-7">
                                    <form method="post" action="">
                                    <table class="table table-bordered table-condensed table-hover">
                                        <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Drug(s)</th>
                                            <th>Unit</th>
                                            <th></th>

                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php 
                                                                             
                                        $array = PatientBill::get_bill(); 
                                        foreach ($array as $drug) { ?>
                                        <tr>
                                            <td><?php echo $index++; ?></td>
                                            <td><?php echo $drug->name ?></td>
                                            <td><input data-id='$product->id' type='text' class='inp_numb' value="<?php echo $drug->quantity ?>"   style='width:40px;' readonly ></td>
                                            <td><span data-id='$product->id' class='dec_bill'><i class='glyphicon glyphicon-trash'></i> </span></td>

                                        </tr>
                                            <?php } ?>                                     
                                        <tr>                                      
                                            <th colspan="5">
                                                <select class="form-control"   name="station" required>
                                                    <option value=""><strong>--Select Dispensary Point--</strong></option>
                                                    <?php
                                                    $station = PharmacyStation::find_all();
                                                    foreach ($station as $s) {
                                                        ?>
                                                        <option
                                                            value="<?php echo $s->id; ?>"><?php echo $s->name; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </th>
                                        </tr>
                                        <tr>                                      
                                            <th colspan="5">
                                                <select class="form-control"   name="pharmacy" required>
                                                    <option value="">--Select Receiving Pharmacy--</option>
                                                    <?php
                                                    $department = "Pharmacy"; // $profession = "Dispensary";
                                                  //  $pharmacists = User::find_by_department_profession($department, $profession);
                                                    $pharmacists = User::find_by_department($department);
                                                    foreach ($pharmacists as $pharmacist) {
                                                        ?>
                                                        <option
                                                            value="<?php echo $pharmacist->full_name(); ?>"><?php echo $pharmacist->full_name(); ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </th>
                                        </tr>


                                        </tbody>


                                    </table>
                                        <button type="submit"  class="btn btn-success"> Save To Dispense </button>
                                    </form>

                                </div>

                            <div class="col-md-5">
                                <?php

                                  /*
                                  print_r($array);                          
                                  echo "<br/>"; echo "<br/>";                                 
                                  $json = json_encode($array);
                                  echo $json;
                                  echo "<br/>"; echo "<br/>";
                                  echo count($array);
                                  echo "<br/>"; echo "<br/>";
                                  echo $user->full_name();
                                  */
                                  


                                ?>
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



