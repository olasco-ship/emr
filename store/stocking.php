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


if ($_SERVER["REQUEST_METHOD"] == 'POST') {


   // $dos = $_POST['dosage'];

//    print_r($dos);  echo "<br/>";  echo "<br/>";
//
//    $array = StockBill::get_bill();
//    print_r($array); echo "<br/>"; echo "<br/>";
//
//
//
//    foreach($dos as $d){
//        $array['dos'] = $d;
//     //   foreach ($items as $keys => $item) {
//      //  array_push($array, $d[$value]);
//    }
//
//
//    print_r($array); echo "<br/>";
//
//    echo count($array);
//
//  //  $new_array =  array_merge($dos, $array);
//
//  //  print_r($new_array);
//
//
//
//    exit;

}


//StockBill::clear_all_bill();


require('../layout/header.php');
?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        Store </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Add Items</li>
                    </ul>
                </div>
                
            </div>
        </div>

        <div class="row clearfix">

            <div class="col-lg-12 col-md-12">
                <div class="card">
                  
                    <div class="body">

                        <div class="row clearfix">
                            <div class="col-sm-12">

                            <a style="font-size: large;" href="add_stock.php">Back</a>

                                <h5> Name Of Items </h5>

                                <div class="form-group">
                                    <form class="form-inline" id="itemSearch">
                                        <input type="text" placeholder="Name Of Item" name="txtProduct" id="txtProduct" autocomplete="off" class="typeahead" />
                                        <br /><br />
                                        <button type="submit" id="submit" class="btn btn-lg btn-info" data-loading-text="Searching...">Search
                                        </button>
                                    </form>
                                </div>

                            </div>


                        </div>



                        <div class="row clearfix">

                            <div class="col-sm-12" id="stockingItems">


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

<!--<script>-->
<!--    $(document).ready(function() {-->
<!---->
<!--        // $('#itemSearch')-->
<!--        //     .on('submit', function($ev) {-->
<!--        //         $ev.preventDefault();-->
<!--        //-->
<!--        //         var name = $('#itemSearch input#txtProduct').val();-->
<!--        //         $.post('dispense_cart.php', {-->
<!--        //                 name: name-->
<!--        //             })-->
<!--        //             .done(function(data) {-->
<!--        //                 $("#save_page").html(data.save_bill);-->
<!--        //                 $("#stockingItems").html(data.stock);-->
<!--        //                 //   $("#flow_one").html(data.flow);-->
<!--        //                 $('#txtProduct').val('');-->
<!--        //             });-->
<!--        //     });-->
<!---->
<!---->
<!--        // $('#stockingItems').on("click", '.dec_bill', function() {-->
<!--        //     var name = $(this).data('name');-->
<!--        //     modify_cart(name, 'action=put&');-->
<!--        // });-->
<!--        //-->
<!--        // $('#stockingItems').on("keyup", '.inp_num', function() {-->
<!--        //     var name = $(this).data('name');-->
<!--        //     var unit = $(this).val();-->
<!--        //     if (!unit) return;-->
<!--        //     modify_cart(name, 'unit=' + unit + '&overwrite=true&', ".inp_num[data-name=" + name + "]");-->
<!--        // });-->
<!--        //-->
<!--        //-->
<!--        //-->
<!--        // function modify_cart(name, param, element) {-->
<!--        //     $.post('dispense_cart.php?' + (param || '') + 'name=' + name, {name: name})-->
<!--        //  //   $.post('dispense_cart.php?' + (param || '') + 'name=' + name, {name: name})-->
<!--        //         .done(function (data) {-->
<!--        //             $("#stockingItems").html(data.stock);-->
<!--        //-->
<!--        //         })-->
<!--        // }-->
<!---->
<!--        -->
<!---->
<!--        /*-->
<!--        function modify_cart(id, param, element) {-->
<!--            $.post('my_bill.php?' + (param || '') + 'id=' + id, {id: id})-->
<!--                .done(function (data) {-->
<!--                    $("#stocking").html(data.flow);-->
<!---->
<!--                })-->
<!--        }-->
<!--        */-->
<!---->
<!---->
<!---->
<!---->
<!--    });-->
<!--</script>-->