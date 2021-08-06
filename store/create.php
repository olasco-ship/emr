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


$user = User::find_by_id($session->user_id);


$done = FALSE;
$message = "";
$errMessage = "";
$errDrug    = "";



if (is_post()) {

    $name_array               = $_POST['field_name'];
    foreach ($name_array as $item) {
        $product   = StockItems::find_by_name($item);
        if (!empty($product)) {
            $errDrug  .= " $item already in Main Store" . "<br/>";
        }
    }
    $errMessage .= $errDrug;

    //  print_r($name_array);
    //  exit;

    if (empty($errMessage)) {
        if (!empty($name_array)) {
            $_SESSION["product_name"] = $name_array;
            redirect_to("create_two.php");
        }

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
                        <li class="breadcrumb-item">Store</li>
                        <li class="breadcrumb-item active">Items</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="body">
                        <a style="font-size: large;" href="add_stock.php">Back</a>

                        <?php
                        if (is_post()) {
                            if (!empty($errMessage)) {
                                ?>
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php echo $errMessage; ?>
                                </div>
                            <?php   }
                        }   ?>


                        <h3>Add New Stock</h3>
                        <div class="row">
                            <div class="col-md-6">


                                <form action="" method="post">

                                    <div class="field_wrapper">
                                        <div>
                                            <input type="text" name="field_name[]" value="" class="form-control" style="width: 350px" required />
                                            <span style="font-size: large;" class="add_button" title="Add field"><i class="icon-plus"></i> </span>
                                            <!--  <a href="javascript:void(0);" class="add_button" title="Add field"><img src="add-icon.png" /></a> -->
                                        </div>


                                    </div>
                                    <button type="submit" class="btn btn-success">Save To Continue</button>
                                </form>


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

?>
<script type="text/javascript">
    $(document).ready(function() {
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><input type="text" name="field_name[]" value="" class="form-control" style="width: 350px" required /><span style="font-size: large;" class="remove_button" title="Add field"><i class="icon-close"></i> </span></div>'; //New input field html
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function() {
            //Check maximum number of input fields
            if (x < maxField) {
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
</script>