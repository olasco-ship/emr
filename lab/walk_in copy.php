<?php
require_once("../includes/initialize.php");

$user = User::find_by_id($session->user_id);




if (is_post()) {


    $first_name   = $_POST['first_name'];
    $last_name    = $_POST['last_name'];
    $gender       = $_POST['gender'];
    $age          = $_POST['age'];
    $phone_number = $_POST['phone_number'];

    $items = TestBill::get_bill();
    $item = $items[0];

    $names  = array();
    $prices = array();
    foreach ($items as $item) {
        $names[]             = $item->name;
        $price[]             = $item->price;
    }
    $json_name  = json_encode($names);
    $json_price = json_encode($price);
    echo $json_name . "<br/>";
    echo $json_price. "<br/>";
    echo count($items) . "<br/>";

    $new_array = array();
    foreach($items as $item){
        $new_array[] = array("name" => $item->name, "price" => $item->price, "quantity" => $item->quantity );
    }

    $json = json_encode($new_array);

  //  print_r($new_array);
  //  exit;







    $today = date_only(strftime("%Y-%m-%d %H:%M:%S", time()));

    $last_bills = Bill::find_last_id();
    $last_bill = 0;
    foreach ($last_bills as $last_bill) {
        $last_bill->bill_number;
    }
    $last_date = substr($last_bill->bill_number, 0, 6);

    $system_num = "01";
    $bill_numb = 0;
    $date = date("ymd");
    if (empty($last_bill->bill_number)) {
        $n = 1;
        $n = sprintf('%04u', $n);
        $bill_numb = $date . $system_num . $n;
    } else {
        if ($last_date != $date) {
            $n = 1;
            $n = sprintf('%04u', $n);
            $bill_numb = $date . $system_num . $n;
        } else {
            $last_bill->bill_number++;
            $bill_numb = $last_bill->bill_number;
        }
    }



    $bill                  = new Bill();
    $bill->sync            = "unsync";
    $bill->bill_number     = $bill_numb;
    $bill->exempted_by     = "";
    $bill->payment_type    = "";
    $bill->patient_id      = 0;
    $bill->first_name      = $first_name;
    $bill->last_name       = $last_name;
    $bill->revenues        = $json_name;
    $bill->total_price     = TestBill::total_price();
    $bill->quantity        = TestBill::total_unit();
    $bill->cost_by         = $user->full_name();
    $bill->revenue_officer = $user->full_name();
    $bill->status          = "billed";
    $bill->receipt         = "";
    $bill->dept            = "lab";
    $bill->date_only       = $today;
    $bill->date = strftime("%Y-%m-%d %H:%M:%S", time());

    if ($bill->save()){
    
     $newLabWalkIn                 = new LabWalkIn();
     $newLabWalkIn->first_name     = $first_name;
     $newLabWalkIn->last_name      = $last_name;
     $newLabWalkIn->gender         = $gender;
     $newLabWalkIn->age            = $age;
     $newLabWalkIn->phone_number   = $phone_number;
     $newLabWalkIn->bill_id        = $bill->id;
     $newLabWalkIn->test_request_id= $testRequest->id;
     $newLabWalkIn->ward_clinic    = "";
     $newLabWalkIn->services       = $json;  // $json_name;
     $newLabWalkIn->prices         = $json_price;
     $newLabWalkIn->unit           = count($items);
     $newLabWalkIn->status         = "REQUEST";
     $newLabWalkIn->date           = strftime("%Y-%m-%d %H:%M:%S", time());
     $newLabWalkIn->save();
     redirect_to("walk_in_bill.php?id=$bill->id");
   //  redirect_to("print_bill.php?id=$bill->id");



    }








    
}





TestBill::clear_all_bill();

require('../layout/header.php');
?>



<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Laboratory Department </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active"> Walk In Patient </li>
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
            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="card">
                    <div class="body">

                        <a style="font-size: larger" href="home.php">&laquo;Back</a>


                        <!--
                                <form id="basic-form" method="post" action="">

                                    <div class="panel-heading">
                                        <?php
                                        if (is_post()) {
                                            if ($done == TRUE) { ?>
                                                <div class="alert alert-success alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    Patient Folder has been created.
                                                </div>
                                            <?php   } else if (empty($errMessage) == FALSE and isset($errMessage)) {
                                            ?>
                                                <div class="alert alert-warning alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <?php echo $errMessage; ?>
                                                </div>
                                            <?php
                                            }
                                        } else {  ?>
                                            <div class="alert alert-default alert-dismissible" role="alert">

                                            </div>
                                        <?php     } ?>
                                    </div>

                     
                                        <div class="panel-content">
                                            <h2 class="heading" style="text-align: center"> Add Patient/Client Details </h2>

                                            <div class="form-group">
                           
                                                <input type="text" class="form-control" placeholder="First Name" name="first_name" value="<?php echo $first_name ?>" required>
                                            </div>

                                            <div class="form-group">
                                           
                                                <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="<?php echo $last_name ?>" required>
                                            </div>


                                            <div class="form-group">
                                               
                                                <select class="form-control" name="gender" required>
                                                    <option value="">--Gender--</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                            
                                                <input type="text" class="form-control" placeholder="Date Of Birth" name="dob" id="dob" value="<?php echo $dob ?>" required>
                                            </div>

                                            <div class="form-group">
                                              
                                                <textarea class="form-control" placeholder="Contact Address" name="address" rows="2" cols="10" required><?php echo $address ?></textarea>
                                            </div>

                                            <div class="form-group">
                                    
                                                <input type="text" class="form-control" placeholder="Phone Number" name="phone_number" required value="<?php echo $phone_number ?>">
                                            </div>

                                            <br />

                                            <button type="submit" class="btn btn-primary">Save Record</button>

                                            <br>

                                        </div>
                                    
                                    </form>
                                -->



                        <div class="tab-pane show active" id="Laboratory">

                            <div class="row">
                                <div class="col-md-6">

                                    <ul class="nav nav-tabs-new2">
                                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Haematology">Haematology</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Chemical">Chemical Pathology</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Microbiology">Microbiology</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Histology">Histology</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="Haematology">

                                            <h5>Haematology</h5>
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Name Of Investigation</th>
                                                            <!--  <th>Reference</th>-->
                                                        </tr>
                                                    </thead>
                                                    <tbody id="HaemItems">
                                                        <?php // $revs = Test::find_all();
                                                        $revs = Test::find_all_by_unit_id(1);
                                                        foreach ($revs as $rev) { ?>
                                                            <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                                <td>
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" class="add_to_bill" value="" data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                        </label>
                                                                    </div>

                                                                </td>
                                                                <!-- <td><?php /*echo $rev->reference */ ?></td>-->
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="Chemical">

                                            <h5>Chemical Pathology</h5>
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Name Of Investigation</th>
                                                            <!-- <th>Reference</th>-->
                                                        </tr>
                                                    </thead>
                                                    <tbody id="ChemItems">
                                                        <?php // $revs = Test::find_all();
                                                        $revs = Test::find_all_by_unit_id(2);
                                                        foreach ($revs as $rev) { ?>
                                                            <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                                <td>
                                                                    <div class="checkbox"><label><input type="checkbox" class="add_to_bill" value="" data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                        </label>
                                                                    </div>

                                                                </td>
                                                                <!--  <td><?php /*echo $rev->reference */ ?></td>-->
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="Microbiology">

                                            <h5> Microbiology </h5>
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Name Of Investigation</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody id="MicroItems">
                                                        <?php // $revs = Test::find_all();
                                                        $revs = Test::find_all_by_unit_id(3);
                                                        foreach ($revs as $rev) { ?>
                                                            <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                                <td>
                                                                    <div class="checkbox"><label><input type="checkbox" class="add_to_bill" value="" data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                        </label>
                                                                    </div>

                                                                </td>

                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="Histology">

                                            <h5> Histology </h5>


                                        </div>

                                    </div>


                                </div>
                                <div class="col-md-6 bill" id="walkCheck">

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


<script>
    $(document).ready(function() {

        $('#HaemItems').on('click', '.add_to_bill', function() {
            var id = $(this).data('id');
            $.post('walk_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {
                    id: id
                })
                .done(function(data) {
                    $("#walkCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });


        $('#ChemItems').on('click', '.add_to_bill', function() {
            var id = $(this).data('id');
            $.post('walk_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {
                    id: id
                })
                .done(function(data) {
                    $("#walkCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

        $('#MicroItems').on('click', '.add_to_bill', function() {
            var id = $(this).data('id');
            $.post('walk_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {
                    id: id
                })
                .done(function(data) {
                    $("#walkCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });



        $('#walkCheck').on("click", '.increase_cart', function() {
            var id = $(this).data('id');
            modify_walk_in(id);
        });

        $('#walkCheck').on("click", '.decrease_cart', function() {
            var id = $(this).data('id');
            modify_walk_in(id, 'action=put&');
        });

        $('#walkCheck').on("click", '.dec_cart', function() {
            var id = $(this).data('id');
            modify_walk_in(id, 'action=delete&');
        });


        function modify_walk_in(id, param, element) {
            $.post('walk_bill.php?' + (param || '') + 'id=' + id, {
                    id: id
                })
                .done(function(data) {
                    $("#walkCheck").html(data.bill);

                })
        }










    })
</script>