<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/3/2019
 * Time: 4:12 PM
 */


require_once("../includes/initialize.php");


$clinic = Clinic::find_by_id($_GET['id']);

//$patients = Patient::find_all();

//$waiting_list = Patient::waiting_list();


//FOR PAGINATION
//1. the current page number ($current_page)
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

//2. records per page ($per_page)
$per_page = 200;

//3. total record count ($total_count)
$count = Patient::count_all();


// Find all Bills
// $bills = Bill::find_all_order_by_date();  Use pagination instead

$pagination = new Pagination($page, $per_page, $count);

$sql  = "SELECT * FROM patients WHERE status = 'open' ORDER BY date_registered DESC ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$waiting_list = Patient::find_by_sql($sql);


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
                            Patients In Clinic</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Patients</li>
                            <li class="breadcrumb-item active"> Clinic Patients </li>
                        </ul>
                    </div>

                </div>
            </div>



            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">

                        <div class="body">
                            <h4><a href="clinic.php?id=<?php echo $clinic->id; ?>"> << Back</a></h4>
                            <div href="#" class="right">
                                <form class="form-inline" id="basic-form" action="" method="post">
                                    <div class="form-group">
                                        <input type="text"  class="form-control" placeholder="Folder Number"
                                               name="search" required>
                                        <button type="submit" class="btn btn-outline-success">Search</button>
                                        <button type="button" name="search" onClick="location.href=location.href"  class="btn btn-outline-danger">Refresh</button>
                                    </div>
                                </form>

                                <div id="pagination" style="clear: both; text-align: right">
                                    <?php
                                    if($pagination->total_pages() > 1){
                                        if($pagination->has_previous_page()){
                                            echo "<a href=\"waiting.php?page=";
                                            echo $pagination->previous_page();
                                            echo "\">&laquo; Previous</a> ";
                                        }

                                        for($i=1; $i <= $pagination->total_pages(); $i++){
                                            if($i == $page){
                                                echo " <span class=\"selected\">{$i}</span> ";
                                            } else {
                                                echo " <a href=\"waiting.php?page={$i}\">{$i}</a> ";
                                            }
                                        }


                                        if($pagination->has_next_page()){
                                            echo "<a href=\"waiting.php?page=";
                                            echo $pagination->next_page();
                                            echo "\">Next &raquo;</a> ";
                                        }

                                    }
                                    ?>
                                </div>

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
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#All"> Patients Records </a></li>
                            </ul>
                            <div class="tab-content m-t-10 padding-0">
                                <div class="tab-pane table-responsive active show" id="All">
                                    <table class="table m-b-0 table-hover">
                                        <thead class="thead-success">
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

                                                    <td><a href='stage.php?id=<?php echo $patient->id ?>'><?php echo $patient->folder_number ?></a></td>
                                                    <td><?php echo $patient->full_name() ?></td>
                                                    <td><?php echo getAge($patient->dob) ?></td>
                                                    <td><?php echo $patient->gender ?></td>
                                                    <td><?php $d_date = date('d/m/Y h:i a', strtotime($patient->date_registered)); echo $d_date ?></td>
                                                    <td><span class="badge badge-success">COMPLETED</span></td>
                                                    <!--        <td><a href='history.php?id=<?php echo $patient->id ?>' History</a></td>
                                            <td><a href='vitals.php?id=<?php echo $patient->id ?>'> Vitals</a></td>   -->
                                                </tr>
                                            <?php } }  else {
                                            /*                                            $sql  = "SELECT * FROM patients WHERE status = 'open' ORDER BY first_name  ";
                                                                                        $sql .= "LIMIT {$per_page} ";
                                                                                        $sql .= "OFFSET {$pagination->offset()}";
                                                                                        $patients = Patient::find_by_sql($sql);*/

                                            $patSubClinics = PatientSubClinic::find_by_clinic($clinic->id);
                                            foreach($patSubClinics as $patSubClinic) {
                                                $patient = Patient::find_by_id($patSubClinic->patient_id);
                                                ?>
                                                <tr>
                                                    <td><a href='stage.php?id=<?php echo $patient->id ?>'><?php echo $patient->folder_number ?></a></td>
                                                    <td><?php echo $patient->full_name() ?></td>
                                                    <td><?php echo getAge($patient->dob) . "years" ?></td>
                                                    <td><?php echo $patient->gender ?></td>
                                                    <td><?php $d_date = date('d/m/Y h:i a', strtotime($patient->date_registered)); echo $d_date ?></td>
                                                    <td><span class="badge badge-success">COMPLETED</span></td>
                                                </tr>
                                                

                                            <?php  }
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
