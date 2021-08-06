<?php

require_once ('../includes/initialize.php');

if (!$session->is_logged_in()){
    redirect_to('../index.php');
}

$user = User::find_by_id($session->user_id);

$drugRequest = DrugRequest::find_by_id($_GET['id']);

if (empty($drugRequest)){
    redirect_to('prescription.php');
}

$patient = Patient::find_by_id($drugRequest->patient_id);

if (is_post()){
    if (isset($_POST['save_drug'])) {
        //   $items = TestBill::get_bill();
        $items = PatientBill::get_bill();
        $item = $items[0];

        redirect_to("ret_drugboard.php?id=$drugRequest->id");

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

            <a href="prescription.php?id=<?php echo $drugRequest->id ?>"> << Back </a>
            <div class="tab-pane" id="Drug">

                <div class="row clearfix">

                    <div class="col-sm-5">
                        <h5> Prescribe Drugs For Patient </h5>
                        <form id="formSearch">
                            <div class=" form-group">
                                <input type="text" placeholder="Name Of Drug"
                                       name="txtProduct" id="txtProduct"
                                       autocomplete="off" class="typeahead"/>
                                <button type="submit" id="submit"
                                        class="btn btn-lg btn-info"
                                        data-loading-text="Searching...">Search
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="col-sm-7" id="save_page">
                        <?php
                        echo PatientBill::save_page();
                        ?>


                    </div>


                </div>


            </div>

        </div>


    </div>





<?php
require_once ('../layout/footer.php');