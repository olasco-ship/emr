<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 5/24/2019
 * Time: 9:19 AM
 */

require_once "../includes/initialize.php";



$ref          = ReferAdmission::find_by_id($_GET['id']);
$patient      = Patient::find_by_id($ref->patient_id);
$user         = User::find_by_id($session->user_id);


/*
$waiting_list = WaitingList::find_by_id($_GET['id']);
$patient      = Patient::find_by_id($waiting_list->patient_id);
$user         = User::find_by_id($session->user_id);
*/


 $items = PatientBill::get_bill();
 $item = $items[0];


if (is_post()) {

    $ref          = ReferAdmission::find_by_id($_GET['id']);
    $patient      = Patient::find_by_id($ref->patient_id);

    
    $drug        = $_POST['drug'];
    $dosage      = $_POST['dosage'];
    $duration    = $_POST['duration'];

    $new_array = array();
    for ($x = 0; $x < count($drug); $x++) {
        $new_array[$x] = array(
            "name" => $drug[$x], 'dosage' => $dosage[$x], 'duration' => $duration[$x] 
        );
    }

     //   $items = PatientBill::get_bill();
     //   $item = $items[0];

        $drugRequest                  = new DrugRequest();
        $drugRequest->waiting_list_id = 0;
        $drugRequest->ward_id         = $ref->ward_no;
        $drugRequest->ref_adm_id      = $ref->id;
        $drugRequest->patient_id      = $patient->id;
        $drugRequest->bill_id         = 0;
        $drugRequest->consultant      = $user->full_name();
        $drugRequest->drugs_no        = count($new_array);
        $drugRequest->not_available   = count($new_array);
        $drugRequest->doc_com         = $_POST['doc_com'];
        $drugRequest->pharm_com       = "";
        $drugRequest->status          = "awaiting_costing";
        $drugRequest->receipt         = "";
        $drugRequest->date            = strftime("%Y-%m-%d %H:%M:%S", time());

        if ($drugRequest->save()) {
            //   foreach ($items as $item) {
             foreach ($new_array as $item) {
                $product = Product::find_by_name($item['name']);

                $eachDrug                  = new EachDrug();
                $eachDrug->sync            = "";
                $eachDrug->drug_request_id = $drugRequest->id;
                $eachDrug->product_id      = $product->id;
                $eachDrug->product_name    = $product->name;
                $eachDrug->quantity        = "0";
                $eachDrug->dosage          = $item['dosage'];
                $eachDrug->duration        = $item['duration'];
                $eachDrug->consultant      = $user->full_name();
                $eachDrug->pharmacy        = "";
                $eachDrug->status          = "OPEN";
                $eachDrug->date            = strftime("%Y-%m-%d %H:%M:%S", time());
                $eachDrug->save();
            }
            PatientBill::clear_all_bill();
            $session->message("Prescription has been done for this patient");
            redirect_to("patient_detail.php?id=$ref->id");
        }

   }




require '../layout/header.php';

?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                    <?php echo "Medical Dashboard - " . $patient->title . " " . $patient->full_name(); ?>
                    </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Treatment</li>
                        <li class="breadcrumb-item active"> History</li>
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

                    <div class="body">


                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12">

                                <a href="dashboard.php?id=<?php echo $waiting_list->id ?>">Back</a>
                                <h3>Prescription Sheet</h3>

                                <div>

                                    <table class="table table-bordered table-condensed table-hover">


                                        <thead>
                                            <tr>
                                                <th>Drug(s)</th>
                                                <th>Dosage</th>
                                                <th> Duration</th>
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
                                                        <td>
                                                        <select style='width: 100px' class='form-control' required id='dosage' name='dosage[]'>
                                                                <option class='form-control' value=''></option>
                                                                <option class='form-control' value='daily'>daily</option>
                                                                <option class='form-control' value='b.i.d'>b.i.d</option>
                                                                <option class='form-control' value='t.i.d'>t.i.d</option>
                                                                <option class='form-control' value='QHS'>QHS</option>
                                                                <option class='form-control' value='Q4h'>Q4h</option>
                                                                <option class='form-control' value='Q4-6h'>Q4-6h</option>
                                                            </select>   
                                                        </td>
                                                        <td>
                                                            <input type='text' class='form-control' name='duration[]' value='' style='width:100px;'>
                                                        
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td colspan="4"><textarea class='form-control' rows='2' cols='70' placeholder='Prescription Note' name='doc_com'></textarea></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4"><button type="submit" class="btn btn-success"> Save Prescription </button></td>
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
require '../layout/footer.php';
?>