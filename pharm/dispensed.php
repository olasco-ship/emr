<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/15/2019
 * Time: 12:51 PM
 */


require_once("../includes/initialize.php");

if (($user->role == 'Super Admin') OR ($user->department == 'Pharmacy')){
    redirect_to(emr_lucid );
}


//$drug = 'drug';

//$bills = Bill::find_dispensed_drugs($drug);

$drugService = DrugServices::find_dispensed();




require('../layout/header.php');
?>





    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                            Dispensed Drugs </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="storage.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Pharmacy</li>
                            <li class="breadcrumb-item active"> Dispensed </li>
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
                            <!-- <h2>Basic Example 8</h2>-->
                        </div>
                        <div class="body">
                        <a style="font-size: larger" href="dispensary.php">&laquo;Back</a>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-content">

                                        <div class="table-responsive">
                                            <table class="table table-striped no-margin">
                                                <thead class="thead-success">
                                                <tr>
                                                    <th>Folder No.</th>
                                                    <th>Patient Name</th>
                                                    <th>Clinic/Ward</th>
                                                    <th>Consultant</th>
                                                    <th>Date</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                $drugService = DrugServices::find_dispensed();
                                                 foreach($drugService as $service) {
                                                     $request = DrugRequest::find_by_id($service->drug_request_id);                  
                                                     $patient = Patient::find_by_id($request->patient_id);

                                                    ?>
                                                    <tr>         
                                                        <td><a href="view_dispensed.php?id=<?php echo $bill->id ?>"> <?php echo $patient->folder_number ?> </a></td>
                                                        <td><?php echo $patient->full_name()  ?></td>
                                                        <td><?php echo $service->ward_clinic ?></td>   
                                                        <td><?php echo $request->consultant ?></td>
                                                        <td><?php $d_date = date('d/m/Y h:i a', strtotime($request->date)); echo $d_date ?></td>


                                                    </tr>
                                                <?php } ?>
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
    </div>











<?php

require('../layout/footer.php');


