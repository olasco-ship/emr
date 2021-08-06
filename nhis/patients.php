<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 3/31/2019
 * Time: 11:33 PM
 */

require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


$user = User::find_by_id($session->user_id);



$enrollees = Enrollee::find_all();



$num = 'NHIS1236';
$enr = Enrollee::find_by_nhis_number($num);
// echo $enr->exp_date . "<br/>";


// echo checkValidity($enr->exp_date);

// exit;



require('../layout/header.php');
?>







<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> NHIS </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active"> Enrollee Management</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">

            <div class="col-lg-12 col-md-12">
                <div class="card">

                    <div class="body">


                        <a style="font-size: larger" href="../nhis/home.php">&laquo;Back</a>


                        <ul class="nav nav-tabs-new2">
                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#All">All NHIS Enrollees</a></li>
                        </ul>
                        <div class="tab-content m-t-10 padding-0">
                            <div class="tab-pane table-responsive active show" id="All">
                                <table class="table m-b-0 table-hover">
                                    <thead class="thead-purple">
                                        <tr>

                                            <th>NHIS No.</th>
                                            <th>Enrollee Name</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Start Date </th>
                                            <th>End Date</th>
                                            <th>Validity</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if (is_post()) {
                                            $query = trim($_POST['search']);
                                            $patients = Patient::find_patient_by_num_or_name($query);
                                            foreach ($patients as $patient) {   ?>
                                                <tr>
                                                    <td><?php echo $patient->folder_number ?></td>
                                                    <td><?php echo $patient->full_name() ?></td>
                                                    <td><?php echo $bill->consultant ?></td>
                                                    <td><?php echo $patient->gender ?></td>
                                                    <td><?php $d_date = date('d/m/Y h:i:a', strtotime($bill->date));
                                                        echo $d_date ?></td>
                                                    <td><a href='index.php?id=<?php echo $bill->id ?>'>Cost</a></td>

                                                </tr>
                                            <?php }
                                        } else {
                                            $enrollees = Enrollee::find_all();
                                            foreach ($enrollees as $enrollee) {

                                            ?>
                                                <tr>

                                                    <td><a href='view.php?id=<?php echo $enrollee->id ?>'><?php echo $enrollee->nhis_number ?></a></td>
                                                    <td><?php echo $enrollee->full_name() ?></td>
                                                    <td><?php echo getAge($enrollee->dob) . "years" ?></td>
                                                    <td><?php echo $enrollee->gender ?></td>
                                                    <td><?php $d_date = date('d/m/Y', strtotime($enrollee->reg_date));
                                                        echo $d_date ?></td>
                                                    <td><?php $d_date = date('d/m/Y', strtotime($enrollee->exp_date));
                                                        echo $d_date ?></td>
                                            
                                                         <td>  
                                                         <?php
                                                            $eligibility = checkValidity($enrollee->exp_date);
                                                            if ($eligibility == 'Valid'){
                                                                echo "<span class='badge badge-success'>$eligibility</span>";
                                                            } else if ($eligibility == 'Expired'){
                                                                echo "<span class='badge badge-danger'>$eligibility</span>";
                                                            }

                                                         ?>
                                                         
                                                        </td>
                                                    <!--
                                                    <td><span class="label label-success"><?php // $eligibility = checkValidity($enrollee->exp_date) ?></span></td>-->
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

















    <?php

    require('../layout/footer.php');
