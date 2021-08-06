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


$user = User::find_by_id($session->user_id);

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/auth/signin.php");
}


if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $query = trim($_POST['search']);
    $min_length = 3;

  // echo $query; exit;

}

//$patients = Patient::find_all();


//FOR PAGINATION
//1. the current page number ($current_page)
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

//2. records per page ($per_page)
$per_page = 100;


//3. total record count ($total_count)
//$count = Patient::count_all();
$count = Patient::count_all();


$pagination = new Pagination($page, $per_page, $count);

$sql  = "SELECT * FROM patients ORDER BY last_name  ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$patients = Patient::find_by_sql($sql);





require('../layout/header.php');



?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> All Patient</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Patient</li>
                            <li class="breadcrumb-item active">All Patient</li>
                        </ul>
                    </div>

                </div>
            </div>



            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">
               


                       
                        <div class="body">
                            <a href="home.php" style="font-size: large">&laquo; Back</a>
                            <?php echo output_message($message); ?>

                            <div href="#" class="right">
                                <form class="form-inline" id="basic-form" action="" method="post">
                                    <div class="form-group">
                                        <input type="text"  class="form-control" placeholder="Folder Number"
                                               name="search" required>
                                        <button type="submit" class="btn btn-outline-primary">Search</button>
                                        <button type="button" name="search" onClick="location.href=location.href"  class="btn btn-outline-warning">Refresh</button>
                                    </div>
                                </form>
                                <?php if (is_post()){
                                    $query = trim($_POST['search']);
                                    $patients = Patient::find_by_patient($query);
                                    if (empty($patients)){
                                    ?>
                                    <div id="success" class="alert alert-warning alert-dismissible" role="alert" style="width: 500px">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                        No record found for <?php echo $query ?>
                                    </div>
                                <?php } else { ?>
                                    <div id="success" class="alert alert-info alert-dismissible" role="alert" style="width: 500px">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                        All records for <?php echo $query ?>
                                    </div>
                                <?php } } ?>
                            </div>

                            <ul class="nav nav-tabs-new2">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#All">All Patients</a></li>
                            </ul>

                          
                            <div class="tab-content m-t-10 padding-0">
                                <div class="tab-pane table-responsive active show" id="All">
                                    <table class="table m-b-0 table-hover">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>Folder No.</th>
                                            <th>Patient Name</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Date Registered</th>
                                            <th>Registered By</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                    if (is_post()) {
                                        $query = trim($_POST['search']);
                                        $patients = Patient::find_by_patient($query);
                                        foreach ($patients as $patient) { ?>
                                            <tr>
                                                <td><a href='view.php?id=<?php echo $patient->id ?>'><?php echo $patient->folder_number ?></a></td>
                                                <td><?php echo $patient->full_name() ?></td>
                                                <td><?php echo getAge($patient->dob)."years" ?></td>
                                                <td><?php echo $patient->gender ?></td>
                                                <td><?php $d_date = date('d/m/Y h:i a', strtotime($patient->date_registered)); echo $d_date ?></td>
                                                <td><?php echo $patient->registered_by ?></td>
                                            </tr>

                                        <?php } }
                                     else {
                                         $pagination = new Pagination($page, $per_page, $count);

                                         $sql  = "SELECT * FROM patients ORDER BY last_name  ";
                                         $sql .= "LIMIT {$per_page} ";
                                         $sql .= "OFFSET {$pagination->offset()}";
                                         $patients = Patient::find_by_sql($sql);

                                          foreach($patients as $patient) {   ?>
                                            <tr>
                                                <td><a href='view.php?id=<?php echo $patient->id ?>'><?php echo $patient->folder_number ?></a></td>
                                                <td><?php echo $patient->full_name() ?></td>
                                                <td><?php echo getAge($patient->dob)."years" ?></td>
                                                <td><?php echo $patient->gender ?></td>
                                                <td><?php $d_date = date('d/m/Y h:i a', strtotime($patient->date_registered)); echo $d_date ?></td>
                                                <td><?php echo $patient->registered_by ?></td>
                                            </tr>
                                        <?php } } ?>

                                        </tbody>
                                    </table>
                                </div>

                                <ul class="pagination">
                                    <?php
                                    if($pagination->total_pages() > 1){
                                        if($pagination->has_previous_page()){
                                            echo " <li class='page-item'><a class='page-link' href='index.php?page=";
                                            echo $pagination->previous_page();
                                            echo "'>Previous</a></li>";
                                        }

                                        for($i=1; $i <= $pagination->total_pages(); $i++){
                                            if($i == $page){
                                                echo "<li class='page-item active'><span class='page-link' >{$i}</span></li>";
                                            } else {
                                                echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                                            }
                                        }

                                        if($pagination->has_next_page()){
                                            echo " <li class='page-item'><a class='page-link' href='index.php?page=";
                                            echo $pagination->next_page();
                                            echo "'>Next</a></li>";
                                        }

                                    }
                                    ?>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>





<?php

require('../layout/footer.php');























