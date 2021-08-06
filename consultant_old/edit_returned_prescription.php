<?php

require_once ('../includes/initialize.php');

if (!$session->is_logged_in()){
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

$drugRequest = DrugRequest::find_by_id($_GET['id']);
if (empty($drugRequest)) {
    redirect_to('prescription.php');
}

$patient = Patient::find_by_id($drugRequest->patient_id);


if (is_post()){

    $drug        = $_POST['drug'];
    $dosage      = $_POST['dosage'];
    $duration    = $_POST['duration'];

    $new_array = array();
    for ($x = 0; $x < count($drug); $x++) {
        $new_array[$x] = array(
            "name" => $drug[$x], 'dosage' => $dosage[$x], 'duration' => $duration[$x]
        );
    }


//    $drugRequest                  = new DrugRequest();
//    $drugRequest->sync              = "off";
//    $drugRequest->waiting_list_id = $waiting_list->id;
//    $drugRequest->ref_adm_id      = 0;
//    $drugRequest->patient_id      = $patient->id;
//    $drugRequest->bill_id         = 0;
    $drugRequest->modified_by       = $user->full_name();
    $drugRequest->drugs_no          = count($new_array);
    $drugRequest->not_available     = count($new_array);
    $drugRequest->doc_com           = $_POST['doc_com'];
//    $drugRequest->pharm_com       = "";
    $drugRequest->status            = "awaiting_costing";
//    $drugRequest->receipt           = "";
//    $drugRequest->date              = strftime("%Y-%m-%d %H:%M:%S", time());

    if ($drugRequest->save()) {
        //   foreach ($items as $item) {
        foreach ($new_array as $item) {
            $product = Product::find_by_name($item['name']);

            $edit                  = EachDrug::find_by_id($drugRequest->id);



            //Testing with drug request id and product name
            //It isn't too good, in case of when mistake occurs that doc write the same drug for patient it isn't editable
            $eachDrugs                  = EachDrug::find_all_awaiting_requests_for_edit($drugRequest->id, $product->name);
//            $eachDrugs                  = EachDrug::find_all_awaiting_requests_for_edit_by_id($drugRequest->id, $edit->id);
            foreach ($eachDrugs as $eachDrug){
                $eachDrug->product_id      = $product->id;
                $eachDrug->product_name    = $product->name;
                $eachDrug->quantity        = "0";
                $eachDrug->dosage          = $item['dosage'];
                $eachDrug->duration        = $item['duration'];
                $eachDrug->pharmacy        = "";
                $eachDrug->status          = "OPEN";
                $eachDrug->date            = strftime("%Y-%m-%d %H:%M:%S", time());
                $eachDrug->save();
            }

        }
        PatientBill::clear_all_bill();
        $session->message("Adjustment has been done for this patient");
        redirect_to("ret_presc.php");
    }

}
require_once ('../layout/header.php');
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

                </div>
            </div>


            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">

                        <div class="body">


                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">

                                    <a href="prescription.php?id=<?php echo $drugRequest->id ?>">Back</a>
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

                                            <tbody id="drugItems">
                                            <form action="" method="post">
                                                <?php
                                                $each = EachDrug::find_all_awaiting_requests($drugRequest->id);
                                                foreach ($each as $request) {
                                                    $drug = Product::find_by_id($request->product_id);   ?>
                                                    <tr>
                                                        <td><?php echo $drug->name ?>
                                                            <input type='text' class='form-control' name='drug[]' value='<?php echo $drug->name ?>' style='width:300px;' hidden>
                                                        </td>

                                                        <td>
                                                            <select style='width: 100px' class='form-control' required id='dosage' name='dosage[]'>
                                                                <option class='form-control' value='<?php echo $request->dosage ?>'><?php echo $request->dosage ?></option>
                                                                <option class='form-control' value='daily'>daily</option>
                                                                <option class='form-control' value='b.i.d'>b.i.d</option>
                                                                <option class='form-control' value='t.i.d'>t.i.d</option>
                                                                <option class='form-control' value='QHS'>QHS</option>
                                                                <option class='form-control' value='Q4h'>Q4h</option>
                                                                <option class='form-control' value='Q4-6h'>Q4-6h</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type='text' class='form-control' name='duration[]' value='<?php echo $request->duration ?>' style='width:100px;'>

                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td colspan="4"><textarea class='form-control' rows='2' cols='70' placeholder='Reason for Editing' name='doc_com'></textarea></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4"><button type="submit" class="btn btn-success"> Send Prescription Back to Pharmacist </button></td>
                                                </tr>
                                            </form>
                                            </tbody>
                                        </table>

                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 bill" id="drugCheck">
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
require_once ('../layout/footer.php');
