<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

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
    $bill->sync            = "off";
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
    $bill->dept            = "scan";
    $bill->date_only       = $today;
    $bill->date = strftime("%Y-%m-%d %H:%M:%S", time());

    $bill->save();





    $new_array = array();
    foreach ($items as $item) {
        $new_array[] = array("name" => $item->name, "price" => $item->price, "quantity" => $item->quantity);
    }

    $json = json_encode($new_array);

    $newRadWalkIn                 = new RadWalkIn();
    $newRadWalkIn->sync            = "off";
    $newRadWalkIn->first_name     = $first_name;
    $newRadWalkIn->last_name      = $last_name;
    $newRadWalkIn->gender         = $gender;
    $newRadWalkIn->age            = $age;
    $newRadWalkIn->phone_number   = $phone_number;
    $newRadWalkIn->ward_clinic    = "";
    $newRadWalkIn->services       = $json;  // $json_name;
    $newRadWalkIn->prices         = $json_price;
    $newRadWalkIn->unit           = count($items);
    $newRadWalkIn->status         = "REQUEST";
    $newRadWalkIn->date           = strftime("%Y-%m-%d %H:%M:%S", time());
    $newRadWalkIn->save();

    $scanRequest                  = new ScanRequest();
    $scanRequest->sync            = "off";
    $scanRequest->radWalkIn_id    = $newRadWalkIn->id;
    $scanRequest->waiting_list_id = 0;
    $scanRequest->ref_adm_id      = 0;
    $scanRequest->patient_id      = 0;
    $scanRequest->bill_id         = $bill->id;
    $scanRequest->consultant      = 'Walk In Patient';
    $scanRequest->scan_no         = count($items);
    $scanRequest->not_done        = count($items);
    $scanRequest->doc_com         = $_POST['doc_com'];
    $scanRequest->scan_com         = "";
    $scanRequest->status          = "billed";
    $scanRequest->receipt         = "";
    $scanRequest->date            = strftime("%Y-%m-%d %H:%M:%S", time());
    if ($scanRequest->save()) {
        foreach ($items as $item) {
            $test = Test::find_by_id($item->id);

            $eachScan                  = new EachScan();
            $eachScan->scan_id         = $test->id;
            $eachScan->scan_request_id = $scanRequest->id;
            $eachScan->quantity        = 1;
            $eachScan->sync            = "off";
            $eachScan->scan_name       = $test->name;
            $eachScan->scan_price      = $item->price;
            $eachScan->consultant      = 'Walk In Patient';
            $eachScan->scanResult      = "";
            $eachScan->scientist       = "";
            $eachScan->radiologist     = "";
            $eachScan->status          = "COSTED";
            $eachScan->date            = strftime("%Y-%m-%d %H:%M:%S", time());
            $eachScan->save();
        }
    }
    $radioService                  = new RadioServices();
    $radioService->sync            = "off";
    $radioService->bill_id         = $bill->id;
    $radioService->scan_request_id = $scanRequest->id;
    $radioService->ward_clinic     = 0;
    $radioService->services        = $json_name;
    $radioService->unit            = TestBill::total_unit();
    $radioService->status          = 'billed';
    $radioService->date            =  strftime("%Y-%m-%d %H:%M:%S", time());
    $radioService->save();
    redirect_to("print_bill.php?id=$bill->id");
}





TestBill::clear_all_bill();

require('../layout/header.php');
?>



<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Radiology/Ultrasound </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active"> Walk In Patient </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="card">
                    <div class="body">

                        <a style="font-size: larger" href="home.php">&laquo;Back</a>


                        <div class="tab-pane" id="RadiologySecond">


                            <div class="row">
                                <div class="col-md-6">

                                    <ul class="nav nav-tabs-new2">
                                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new2Second">Radiology</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new2Second"> Ultrasound Scan </a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="Home-new2Second">

                                            <h5>Radiology</h5>
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Name Of Investigation</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody id="radioItems">
                                                        <?php // $revs = Test::find_all();
                                                        $revs = Test::find_all_by_unit_id(4);
                                                        foreach ($revs as $rev) { ?>
                                                            <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                                <td>
                                                                    <div class="checkbox"><label><input type="checkbox" class="add_to_walk_bill" value="" data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                        </label>
                                                                    </div>

                                                                </td>

                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="Profile-new2Second">

                                            <h5> Ultrasound Scan </h5>
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Name Of Investigation</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody id="scanItems">
                                                        <?php // $revs = Test::find_all();
                                                        $revs = Test::find_all_by_unit_id(5);
                                                        foreach ($revs as $rev) { ?>
                                                            <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                                <td>
                                                                    <div class="checkbox"><label><input type="checkbox" class="add_to_walk_bill" value="" data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                        </label>
                                                                    </div>

                                                                </td>

                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6 bill" id="scanWalkCheck">

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

        $('#radioItems').on('click', '.add_to_walk_bill', function() {
            var id = $(this).data('id');
            $.post('walk_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {
                    id: id
                })
                .done(function(data) {
                    $("#scanWalkCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });


        $('#scanItems').on('click', '.add_to_walk_bill', function() {
            var id = $(this).data('id');
            $.post('walk_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {
                    id: id
                })
                .done(function(data) {
                    $("#scanWalkCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

        $('#scanWalkCheck').on("click", '.increase_cart', function() {
            var id = $(this).data('id');
            modify_walk_in(id);
        });

        $('#scanWalkCheck').on("click", '.decrease_cart', function() {
            var id = $(this).data('id');
            modify_walk_in(id, 'action=put&');
        });

        $('#scanWalkCheck').on("click", '.dec_cart', function() {
            var id = $(this).data('id');
            modify_walk_in(id, 'action=delete&');
        });


        function modify_walk_in(id, param, element) {
            $.post('walk_bill.php?' + (param || '') + 'id=' + id, {
                    id: id
                })
                .done(function(data) {
                    $("#scanWalkCheck").html(data.bill);

                })
        }










    })
</script>