<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/1/2019
 * Time: 9:25 AM
 */
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


$index = 1;

$user = User::find_by_id($session->user_id);


require('../layout/header.php');



?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Pharmacy </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Stock History</li>
                         
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
                           <!-- <h2>Patients List</h2>-->

                            <div href="#" class="right">
                                <form class="form-inline" id="basic-form" action="" method="post">
                                    <div class="form-group">
                                        <input type="text"  class="form-control" placeholder=" Search "
                                               name="search" required>
                                        <button type="submit" class="btn btn-outline-primary">Search</button>
                                        <button type="button" name="search" onClick="location.href=location.href"  class="btn btn-outline-warning">Refresh</button>
                                    </div>
                                </form>
                                <?php if (is_post()){
                                    $query = trim($_POST['search']);
                                    ?>
                                    <div id="success" class="alert alert-info alert-dismissible" role="alert" style="width: 500px">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                        All records for <?php echo $query ?>
                                    </div>
                                <?php } ?>
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


                            <a href="storage.php" style="font-size: large">&laquo; Back</a>
                            <?php echo output_message($message); ?>
                            <ul class="nav nav-tabs-new2">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#All"> Stock History </a></li>
<!--                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#USA">USA</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#India">India</a></li>-->
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content m-t-10 padding-0">
                                <div class="tab-pane table-responsive active show" id="All">
                                    <table class="table m-b-0 table-hover">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th> S/N</th>
                                            <th> Supplier  </th>
                                            <th> Received By </th>
                                            <th> Dispensory Unit</th>
                                            <th> Total Drugs </th>
                                            <th> Date </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                    if (is_post()) {
                                        $query = trim($_POST['search']);
                                        $patients = Patient::find_by_patient($query);
                                        foreach ($patients as $patient) { ?>
                                            <tr>
                                                <!--     <td> <a href="#"><?php echo $patient->folder_number ?></a></td>  -->
                                                <td><a href='view.php?id=<?php echo $patient->id ?>'><?php echo $patient->folder_number ?></a></td>
                                                <td><?php echo $patient->full_name() ?></td>
                                                <td><?php echo getAge($patient->dob)."years" ?></td>
                                                <td><?php echo $patient->gender ?></td>
                                                <td><?php $d_date = date('d/m/Y h:i a', strtotime($patient->date_registered)); echo $d_date ?></td>
                                                <!-- <td><span class="label label-success">COMPLETED</span></td>-->
                                                <td>  <?php echo !empty($patient->nhis_tracking) ? "<span class='badge badge-warning'>NHIS</span>" : "<span class='badge badge-success'>COMPLETED</span>"; ?></td>
                                            </tr>

                                        <?php } }
                                     else {
                                         $history = StockIn::find_all();
                                          foreach($history as $h) {   ?>
                                            <tr>
                                                <td> <?php echo $index++ ?> </td>
                                                <td><a href='print_stock.php?id=<?php echo $h->id ?>'><?php echo $h->supplier ?></a></td>
                                                <td><?php echo $h->receiver ?></td>
                                                <td><?php  echo $h->pharmacy_station ?></td>
                                                <td><?php echo $h->item_count ?></td>
                                                <td><?php $d_date = date('d/m/Y h:i a', strtotime($h->date)); echo $d_date ?></td>
                                            </tr>
                                        <?php } } ?>

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























