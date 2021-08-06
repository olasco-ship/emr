<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/18/2019
 * Time: 11:52 AM
 */


require_once("../includes/initialize.php");


if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}







if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $query = trim($_POST['search']);
    $min_length = 3;
}


require('../layout/header.php');
?>








    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                            Pending Radiology Request </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Radiology</li>
                            <li class="breadcrumb-item active">Requests</li>
                        </ul>
                    </div>

                </div>
            </div>



            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">

                        <div class="body">

                            <?php echo output_message($message); ?>

                            <a style="font-size: larger" href="../rad/home.php">&laquo;Back</a>

                            <ul class="nav nav-tabs-new2">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#All">Pending Requests</a></li>
                            </ul>


                            <div class="tab-content m-t-10 padding-0">
                                <div class="tab-pane table-responsive active show" id="All">
                                    <table class="table m-b-0 table-hover">
                                        <thead class="thead-primary">

                                        <tr>

                                            <th>Folder No.</th>
                                            <th>Patient Name</th>
                                        <!--    <th>Clinic</th>  -->
                                            <th>Consultant</th>
                                           
                                            <th>Investigation(s)  </th>
                                            <th>Status</th>

                                        </tr>

                                        </thead>
                                        <tbody>

                                        <?php
                                        if (is_post()) {
                                            $query = trim($_POST['search']);
                                            $patients = Patient::find_patient_by_num_or_name($query);
                                            foreach($patients as $patient) {   ?>
                                                <tr>
                                                    <td><a href='index.php?id=<?php echo $bill->id ?>'><?php echo $patient->folder_number ?></a></td>
                                                    <td><?php echo $patient->first_name ?></td>
                                                    <td><?php  ?></td>
                                                    <td><?php echo $patient->gender ?></td>
                                                    <td><?php $d_date = date('d/m/Y h:i a', strtotime($patient->date_registered)); echo $d_date ?></td>
                                                    <td><span class="badge badge-warning">COMPLETED</span></td>
                                                
                                                </tr>
                                            <?php } } else {
                                   
                                            $services = RadioServices::find_cleared();

                                            foreach($services as $service) {  
                                                $scanRequest = ScanRequest::find_by_id($service->scan_request_id);                                                                                     
                                                $patient     = Patient::find_by_id($scanRequest->patient_id);
                                                ?>
                                                <tr>
                                                    <td><a href='form_service.php?id=<?php echo $service->id  ?>'>
                                                            <?php
                                                            if (!empty($patient)) {
                                                                echo $patient->folder_number;
                                                            } else {
                                                                echo "Walk In Patient";
                                                            }
                                                            ?>
                                                        </a></td>
                                                    <td><?php
                                                        if (!empty($patient)) {
                                                            echo $patient->full_name();
                                                        } else {

                                                            $bill = Bill::find_by_id($service->bill_id);
                                                            echo $bill->first_name ." ". $bill->last_name;
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $scanRequest->consultant ?></td>
                                                    <td><?php $decode = json_decode($service->services); 
                                                            foreach($decode as $item){
                                                                echo $item . ", ";
                                                            }
                                                                                        
                                                    ?>
                                                    </td>
                                                    <td><span class="badge badge-warning">PENDING RESULT</span></td>
                                                 
                                                </tr>

                                            <?php }  }
                                        ?>

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












<?php

require('../layout/footer.php');