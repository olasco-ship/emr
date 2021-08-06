<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/30/2019
 * Time: 11:28 AM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

$sub_clinic_id = SubClinic::find_by_id($user->sub_clinic_id);
//$clinic        = Clinic::find_by_id($sub_clinic_id->clinic_id);
$userSubClinic = UserSubClinic::find_by_users($user->id);

foreach ($userSubClinic as $u){

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
                            Returned Laboratory Investigation </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Consulting</li>
                        </ul>
                    </div>

                </div>
            </div>



            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">

                        <div class="body">
                            <a style="font-size: larger" href="../consultant/index.php">&laquo;Back</a>
                            <div href="#" class="right">
                                <form class="form-inline" id="basic-form" action="" method="post">
                                    <div class="form-group">
                                        <input type="text"  class="form-control" placeholder="Folder Number"
                                               name="search" required>
                                        <button type="submit" class="btn btn-outline-primary">Search</button>
                                        <button type="button" name="search" onClick="location.href=location.href"  class="btn btn-outline-warning">Refresh</button>
                                    </div>
                                </form>

                                <br/>

                                <?php if (is_post()){  ?>
                                    <div id="success" class="alert alert-success alert-dismissible" role="alert" style="width: 500px">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                        All records for <?php echo $query ?>
                                    </div>
                                <?php } ?>


                            </div>

                            <ul class="nav nav-tabs-new2">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#All">  Returned Laboratory Investigation </a></li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content m-t-10 padding-0">
                                <div class="tab-pane table-responsive active show" id="All">
                                    <table class="table m-b-0 table-hover">
                                        <thead class="thead-purple">

                                        <tr>

                                            <th>Folder No.</th>
                                            <th>Patient Name</th>
                                            <th>Ward/Clinic</th>
                                            <th> Investigations </th>
                                         <!--   <th>Investigation left</th>  -->
                                            <th> Date</th>
                                            <th></th>
                                          


                                        </tr>

                                        </thead>
                                        <tbody>

                                        <?php
                                        if (is_post()) {
                                            $query = trim($_POST['search']);
                                            $patients = Patient::find_patient_by_num_or_name($query);
                                            foreach($patients as $patient) {   ?>
                                                <tr>
                                                    <td><?php echo $patient->folder_number ?></td>
                                                    <td><?php echo $patient->full_name() ?></td>
                                                    <td><?php echo $bill->consultant ?></td>
                                                    <td><?php echo $patient->gender ?></td>
                                                    <td><?php $d_date = date('d/m/Y h:i:a', strtotime($bill->date)); echo $d_date ?></td>
                                                    <td><a href='index.php?id=<?php echo $bill->id ?>'>Cost</a></td>
                                                    <!--     <td><span class="label label-success">COMPLETED</span></td>  -->
                                                </tr>
                                            <?php } } else {
                                                $testRequests = TestRequest::find_returned_investigation_by_subClinic($u->sub_clinic_id);
                                            foreach($testRequests as $request) {
                                                $patient = Patient::find_by_id($request->patient_id);
                                                ?>
                                                <tr>
                                                    <td><a href='#'> <?php echo $patient->folder_number ?></a></td>
                                                    <td><?php echo $patient->full_name()  ?></td>
                                                    <td><?php if ($request->ward_id == 0) {
                                                            $waiting = WaitingList::find_by_id($request->waiting_list_id);
                                                            $subClinic = SubClinic::find_by_id($waiting->sub_clinic_id);
                                                            echo $subClinic->name;
                                                        } else {
                                                            $ward = Wards::find_by_id($request->ward_id);
                                                            echo $ward->ward_number;
                                                        }

                                                        ?></td>
                                                    <td><?php echo $request->test_no ?></td>
                                                <!--    <td><?php echo $request->not_available ?></td>  -->
                                                    <td><?php $d_date = date('d/m/Y h:i:a', strtotime($request->date)); echo $d_date ?></td>
                                                  <!--  <td><a href='cost_drug.php?id=<?php echo $request->id ?>'>Cost</a></td> -->
                                                 <td>
                                                    <a href='investigation.php?id=<?php echo $request->id ?>'> View Investigation </a>
                                                </td>
                                          

                                                </tr>

                                            <?php }
                                        }
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