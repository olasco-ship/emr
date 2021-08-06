<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/3/2019
 * Time: 8:39 AM
 */

require_once("../includes/initialize.php");

$patients = Patient::find_all();




if ($_SERVER["REQUEST_METHOD"] == 'POST') {



    $start_date = trim($_POST['start_date']);
    $end_date = trim($_POST['end_date']);


    $start_date = date("Y-m-d", strtotime($start_date));
    $end_date = date("Y-m-d", strtotime($end_date));


    $start_sec = "00:00:00";
    $end_sec = "23:59:59";



    $start_date = $start_date . " " . $start_sec;
    $end_date   = $end_date . " " . $end_sec;


    $results = Encounter::find_btw_date($start_date, $end_date);




}


require('../layout/header.php');
?>






    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Servicom </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Servicom</li>
                            <!--<li class="breadcrumb-item active">All Patient</li>-->
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
                    <div class="card patients-list">
                        <div class="header">

                            <div href="#" class="right">
                                <form class="form-inline" id="basic-form" action="" method="post">
                                    <div class="form-group">
                                        <input type="text"  class="form-control" placeholder="Start Date" id="start_date"
                                               name="start_date" required>
                                        <input type="text"  class="form-control" placeholder="End Date" id="end_date"
                                               name="end_date" required>
                                        <button type="submit" class="btn btn-outline-primary">Search</button>
                                        <button type="button" name="search" onClick="location.href=location.href"  class="btn btn-outline-warning">Refresh</button>
                                    </div>
                                </form>

                                <br/>

                              <!--  <?php /*if (is_post()){  */?>
                                    <div id="success" class="alert alert-success alert-dismissible" role="alert" style="width: 500px">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                        All records for <?php /*echo $query */?>
                                    </div>
                                --><?php /*} */?>


                            </div>



                            <ul class="header-dropdown">
                                <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Weekly">W</a></li>
                                <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Monthly">M</a></li>
                                <li><a class="tab_btn active" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Yearly">Y</a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs-new2">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#All">Nursing Department</a></li>
                                <!--                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#USA">USA</a></li>
                                                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#India">India</a></li>-->
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content m-t-10 padding-0">
                                <div class="tab-pane table-responsive active show" id="All">
                                    <table class="table m-b-0 table-hover">
                                        <thead class="thead-purple">

                                        <tr>

                                            <th>Folder No.</th>
                                            <th>Patient Name</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Date Registered</th>
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
                                                    <!--     <td> <a href="#"><?php echo $patient->folder_number ?></a></td>  -->
                                                    <td><a href='view.php?id=<?php echo $patient->id ?>'><?php echo $patient->folder_number ?></a></td>
                                                    <td><?php echo $patient->full_name() ?></td>
                                                    <td>763648</td>
                                                    <td><?php echo $patient->gender ?></td>
                                                    <td><?php $d_date = date('d/m/Y h:i a', strtotime($patient->date_registered)); echo $d_date ?></td>
                                                    <td><span class="badge badge-success">COMPLETED</span></td>
                                                    <!--        <td><a href='history.php?id=<?php echo $patient->id ?>' History</a></td>
                                            <td><a href='vitals.php?id=<?php echo $patient->id ?>'> Vitals</a></td>   -->
                                                </tr>
                                            <?php } } else {
                                            $patients = Patient::find_all();
                                            foreach($patients as $patient) {   ?>
                                                <tr>
                                                    <!--     <td> <a href="#"><?php echo $patient->folder_number ?></a></td>  -->
                                                    <td><a href='view.php?id=<?php echo $patient->id ?>'><?php echo $patient->folder_number ?></a></td>
                                                    <td><?php echo $patient->full_name() ?></td>
                                                    <td><?php echo getAge($patient->dob) . "years"; ?></td>
                                                    <td><?php echo $patient->gender ?></td>
                                                    <td><?php $d_date = date('d/m/Y h:i a', strtotime($patient->date_registered)); echo $d_date ?></td>
                                                    <td><span class="badge badge-success">COMPLETED</span></td>
                                                    <!--          <td><a href='history.php?id=<?php echo $patient->id ?>'> History</a></td>
                                                <td><a href='vitals.php?id=<?php echo $patient->id ?>'> Vitals</a></td>   -->
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