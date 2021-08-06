<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/2/2019
 * Time: 9:54 AM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

if (($user->role == 'Super Admin') or ($user->department == 'Pharmacy')) {
    redirect_to(emr_lucid);
}

$user = User::find_by_id($session->user_id);


$message = "";
$done = FALSE;


if (is_post()) {

    if (empty($_POST['name'])) {
        $errorName = "Product Name  is Required";
        $errorMessage .= $errorName . "<br/>";
    } else {
        $name = test_input($_POST['name']);
        $pro  = Product::find_by_name($name);
        if (isset($pro) && !empty($pro)) {
            $errorName = "Product Name already exists";
            $errorMessage .= $errorName . "<br/>";
        }
    }


    if ($_POST['barcode']) {
        if (empty($_POST['barcode'])) {
            $errorTitle = "Barcode is Required";
            $errorMessage .= $errorTitle . "<br/>";
        } else {
            $barcode = test_input($_POST['barcode']);
        }
    }

    /*
    if (empty($_POST['category_id'])) {
        $errorCategory = "Brand is Required";
        $errorMessage .= $errorCategory . "<br/>";
    } else {
        $category_id = test_input($_POST['category_id']);
    }
    */

    if (empty($_POST['productType_id'])) {
        $errorProductType = "Product Type is Required";
        $errorMessage .= $errorProductType . "<br/>";
    } else {
        $productType_id = test_input($_POST['productType_id']);
    }


    /*
    if ($_POST['cost_price']) {
        if (empty($_POST['cost_price'])) {
            $errorCostPrice = "Cost Price of Product is Required";
            $errorMessage .= $errorCostPrice . "<br/>";
        } else {
            $cost_price = test_input($_POST['cost_price']);
            if (!is_numeric($cost_price)) {
                $errorCostPrice = "Only Numbers are allowed for Cost Price";
                $errorMessage .= $errorCostPrice . "<br/>";
            }
        }
    }
    */

    if ($_POST['price']) {
        if (empty($_POST['price'])) {
            $errorPrice = "Selling Price of Product is Required";
            $errorMessage .= $errorPrice . "<br/>";
        } else {
            $selling_price = test_input($_POST['price']);
            if (!is_numeric($selling_price)) {
                $errorPrice = "Only Numbers are allowed for Selling Price";
                $errorMessage .= $errorPrice . "<br/>";
            }
        }
    }

    /*
    if ($_POST['total_quantity']) {
        if (empty($_POST['total_quantity'])) {
            $errorQuantity = "Quantity is Required";
            $errorMessage .= $errorQuantity . "<br/>";
        } else {
            $total_quantity = test_input($_POST['total_quantity']);
            if (!is_numeric($total_quantity)) {
                $errorQuantity = "Only Numbers are allowed for Quantity";
                $errorMessage .= $errorQuantity . "<br/>";
            }
        }
    }
    */


    $unit_quantity = test_input($_POST['unit_quantity']);
    $carton        = test_input($_POST['carton']);
    $no_carton     = test_input($_POST['no_carton']);

    $total_quantity = $carton * $no_carton + $unit_quantity;

    if (empty($_POST['batch_no'])) {
        $errorBatchNumber = "Batch Number is Required";
        $errorMessage .= $errorBatchNumber . "<br/>";
    } else {
        $batch_no      = test_input($_POST['batch_no']);
    }


    $man_date = trim($_POST['man_date']);
    $exp_date = trim($_POST['exp_date']);

    $man_date = date("Y-m-d", strtotime($man_date));
    $exp_date = date("Y-m-d", strtotime($exp_date));

    $carton         = $_POST['carton'];
    $no_carton      = $_POST['no_carton'];
    $unit_quantity  = $_POST['unit_quantity'];

    $new_array = array('name' => $name, 'Carton' => $carton, 'No In Carton' => $no_carton,
                    'quantity'=> $unit_quantity );

 //   print_r($new_array);   echo count($new_array);  exit;


    if (!$errorMessage) {
        $product                 = new Product();
        $product->name           = $name;
        $product->barcode        = $barcode;
        $product->category_id    = "";
        $product->productType_id = $productType_id;
        $product->cost_price     = 0;
        $product->price          = $selling_price;
        $product->quantity       = "";
        $product->total_quantity = $total_quantity;
        $product->description    = "";
        $product->batch_no       = $batch_no;
        $product->man_date       = $man_date;
        $product->exp_date       = $exp_date;
        $product->created        = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($product->save()) {
            $pharmacyStation = PharmacyStation::find_all();
            foreach ($pharmacyStation as $station) {
                $productPharmacyStation                      = new ProductPharmacyStation();
                $productPharmacyStation->product_id          = $product->id;
                $productPharmacyStation->pharmacy_station_id = $station->id;
                $productPharmacyStation->quantity            = 0;
                $productPharmacyStation->date                = strftime("%Y-%m-%d %H:%M:%S", time());
                $productPharmacyStation->save();
            }

            $newStock                   = new StockIn();
            $newStock->code             = "123456";
            $newStock->items            = json_encode($new_array);
            $newStock->item_count       = 1;   // count($new_array);
            $newStock->supplier         = $_POST['supplier'];
            $newStock->pharmacy_station = $_POST['station'];
            $newStock->receiver         = $user->full_name();
            $newStock->date             = strftime("%Y-%m-%d %H:%M:%S", time());
            $newStock->save();
            $done = TRUE;
            $session->message("Drug has been successfully uploaded");
            redirect_to('index.php');
        } else {
        }
    }


    if ($errorMessage) {
        $panelClass = 'panel-danger';
        $panelHeader = '<div class="panel-heading"><h3 class="panel-title">Please correct the errors in the form<br></h3> class=
                          "panel-title alert alert-danger">' . $errorMessage . '</h3> </div>';
    }
}


require('../layout/header.php');
?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        Drug Upload </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="storage.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Pharmacy</li>
                        <li class="breadcrumb-item active">Drugs</li>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <a href="storage.php">Back</a>
                        <h1>Add New Stock</h1>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-md-6">

                                <?php
                                if (is_post()) {
                                    if ($done == TRUE) { ?>
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            New Drug has been created.
                                        </div>
                                    <?php   } else if (empty($errorMessage) == FALSE and isset($errorMessage)) {
                                    ?>
                                        <div class="alert alert-warning alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <?php echo $errorMessage; ?>
                                        </div>
                                <?php
                                    }
                                }   ?>

                                <div class="panel-content">
                                    <form id="basic-form" method="post">
                                        <div class="form-group">
                                            <!--    <label>Drug Name</label>  -->
                                            <input type="text" class="form-control" style="width: 350px" name="name" placeholder="Drug Name" value="<?php echo $name ?>" required>
                                        </div>
                                        <!--
                                            <div class="form-group">
                                                   <label>Brand Name</label>  
                                                <select class="form-control" style="width: 350px" id="category_id" name="category_id">
                                                    <option value="">--Select Brand Of Drug--</option>
                                                    <?php
                                                    $finds = Category::find_all_order_by_name();
                                                    foreach ($finds as $find) {
                                                    ?>
                                                        <option
                                                                value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                                        <?php
                                                    }
                                                        ?>
                                                </select>
                                            </div>
                                            -->
                                        <div class="form-group">
                                            <!--     <label>Product Type</label>  -->
                                            <select class="form-control" style="width: 350px" id="productType_id" name="productType_id">
                                                <option value="">--Select Product Type--</option>
                                                <?php
                                                $finds = ProductType::find_all_order_by_name();
                                                foreach ($finds as $find) {
                                                ?>
                                                    <option value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <!-- 
                                            <div class="form-group">
                                                   <label>Cost Price</label>  
                                                <input type="text" class="form-control" style="width: 350px" name="cost_price"
                                                       placeholder="Cost Price" value="<?php // echo $cost_price 
                                                                                        ?>" required>
                                            </div>
                                            -->

                                        <div class="form-group">
                                            <!--    <label>Selling Price</label>  -->
                                            <input type="text" class="form-control" style="width: 350px" name="price" placeholder="Selling Price" value="<?php echo $selling_price ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <!--    <label> Batch No. </label>  -->
                                            <input type="text" class="form-control" style="width: 350px" name="batch_no" placeholder="Batch Number" value="<?php echo $batch_no ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <!--   <label> Manufacturing Date </label>  -->
                                            <input type="text" class="form-control" style="width: 350px" name="man_date" id="man_date" placeholder="Manufacturing Date" value="<?php echo $man_date ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <!--   <label> Expiry Date </label>   -->
                                            <input type="text" class="form-control" style="width: 350px" name="exp_date" id="exp_date" placeholder="Expiry Date" value="<?php echo $exp_date ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <!--  <label> Quantity(In Store) </label>   -->
                                            <input type="text" class="form-control" style="width: 350px" name="carton" placeholder="Carton/Pack" value="<?php echo $carton ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <!--  <label> Quantity(In Store) </label>   -->
                                            <input type="text" class="form-control" style="width: 350px" name="no_carton" placeholder="No. In Carton/Pack" value="<?php echo $no_carton ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <!--  <label> Quantity(In Store) </label>   -->
                                            <input type="text" class="form-control" style="width: 350px" name="unit_quantity" placeholder="Unit Quantity" value="<?php echo $unit_quantity ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <!--  <label> Quantity(In Store) </label>   -->
                                            <input type="text" class="form-control" style="width: 350px" name="supplier" placeholder="Supplier" value="<?php echo $supplier ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <select class="form-control" style="width: 350px" name="station" required>
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
                                        </div>

                                        <div class="form-group">
                                            <!--    <label> Barcode </label>   -->
                                            <input type="text" class="form-control" style="width: 350px" name="barcode" placeholder="Barcode" value="<?php echo $barcode ?>" required>
                                        </div>

                                        <br>
                                        <button type="submit" class="btn btn-primary">Upload Drug</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6">

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
