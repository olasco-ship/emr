<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/3/2019
 * Time: 4:12 PM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

//$vitals = Vitals::find_all();

$patients = Patient::find_all();



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

$sql  = "SELECT * FROM patients ORDER BY date_registered DESC ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$patients = Patient::find_by_sql($sql);


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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> All Patient</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Patient</li>
                            <li class="breadcrumb-item active"> Patient Records</li>
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
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#All"> Patients Records </a></li>
                                <!--                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#USA">USA</a></li>
                                                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#India">India</a></li>-->
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content m-t-10 padding-0">
                                <div class="tab-pane table-responsive active show" id="All">
                                    <table class="table m-b-0 table-hover">
                                        <thead class="thead-light">

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

                                                    <td><a href='#'><?php echo $patient->folder_number ?></a></td>
                                                    <td><a href='stage.php?id=<?php echo $patient->id ?>'><?php echo $patient->full_name() ?></a></td>
                                                    <td><?php echo getAge($patient->dob) . "years" ?></td>
                                                    <td><?php echo $patient->gender ?></td>
                                                    <td><?php $d_date = date('d/m/Y h:i a', strtotime($patient->date_registered)); echo $d_date ?></td>
                                                    <td><span class="badge badge-success">COMPLETED</span></td>
                                                    <!--        <td><a href='history.php?id=<?php echo $patient->id ?>' History</a></td>
                                            <td><a href='vitals.php?id=<?php echo $patient->id ?>'> Vitals</a></td>   -->
                                                </tr>
                                            <?php } } else {
                                            // $patients = Patient::find_all();
                                            $sql  = "SELECT * FROM patients ORDER BY first_name  ";
                                            $sql .= "LIMIT {$per_page} ";
                                            $sql .= "OFFSET {$pagination->offset()}";
                                            $patients = Patient::find_by_sql($sql);
                                            foreach($patients as $patient) {   ?>
                                                <tr>

                                                    <td><a href='#'><?php echo $patient->folder_number ?></a></td>
                                                    <td><a href='stage.php?id=<?php echo $patient->id ?>'><?php echo $patient->full_name() ?></a></td>
                                                    <td><?php echo getAge($patient->dob) . "years" ?></td>
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
                                <div class="tab-pane table-responsive" id="USA">
                                    <table class="table m-b-0 table-hover">
                                        <thead class="thead-success">
                                        <tr>
                                            <th>Media</th>
                                            <th>Patients ID</th>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Address</th>
                                            <th>Number</th>
                                            <th>Last Visit</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><span class="list-icon"><img class="patients-img" src="../assets/images/xs/avatar1.jpg" alt=""></span></td>
                                            <td><span class="list-name">KU 00598</span></td>
                                            <td>Daniel</td>
                                            <td>32</td>
                                            <td>71 Pilgrim Avenue Chevy Chase, MD 20815</td>
                                            <td>404-447-6013</td>
                                            <td>11 Jan 2018</td>
                                            <td><span class="badge badge-success">Approved</span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="list-icon"><img class="patients-img" src="../assets/images/xs/avatar2.jpg" alt=""></span></td>
                                            <td><span class="list-name">KU 00258</span></td>
                                            <td>Alexander</td>
                                            <td>22</td>
                                            <td>123 6th St. Melbourne, FL 32904</td>
                                            <td>404-447-6013</td>
                                            <td>15 Jan 2018</td>
                                            <td><span class="badge badge-success">Approved</span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="list-icon"><img class="patients-img" src="../assets/images/xs/avatar1.jpg" alt=""></span></td>
                                            <td><span class="list-name">KU 00456</span></td>
                                            <td>Joseph</td>
                                            <td>27</td>
                                            <td>70 Bowman St. South Windsor, CT 06074</td>
                                            <td>404-447-6013</td>
                                            <td>19 Jan 2018</td>
                                            <td><span class="badge badge-success">Approved</span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="list-icon"><img class="patients-img" src="../assets/images/xs/avatar2.jpg" alt=""></span></td>
                                            <td><span class="list-name">KU 00789</span></td>
                                            <td>Cameron</td>
                                            <td>38</td>
                                            <td>123 6th St. Melbourne, FL 32904</td>
                                            <td>404-447-6013</td>
                                            <td>19 Jan 2018</td>
                                            <td><span class="badge badge-warning">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="list-icon"><img class="patients-img" src="../assets/images/xs/avatar3.jpg" alt=""></span></td>
                                            <td><span class="list-name">KU 00987</span></td>
                                            <td>Alex</td>
                                            <td>39</td>
                                            <td>123 6th St. Melbourne, FL 32904</td>
                                            <td>404-447-6013</td>
                                            <td>20 Jan 2018</td>
                                            <td><span class="badge badge-success">Approved</span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="list-icon"><img class="patients-img" src="../assets/images/xs/avatar4.jpg" alt=""></span></td>
                                            <td><span class="list-name">KU 00951</span></td>
                                            <td>James</td>
                                            <td>32</td>
                                            <td>44 Shirley Ave. West Chicago, IL 60185</td>
                                            <td>404-447-6013</td>
                                            <td>22 Jan 2018</td>
                                            <td><span class="badge badge-warning">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="list-icon"><img class="patients-img" src="../assets/images/xs/avatar1.jpg" alt=""></span></td>
                                            <td><span class="list-name">KU 00953</span></td>
                                            <td>charlie</td>
                                            <td>51</td>
                                            <td>123 6th St. Melbourne, FL 32904</td>
                                            <td>404-447-6013</td>
                                            <td>22 Jan 2018</td>
                                            <td><span class="badge badge-warning">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="list-icon"><img class="patients-img" src="../assets/images/xs/avatar2.jpg" alt=""></span></td>
                                            <td><span class="list-name">KU 00934</span></td>
                                            <td>Bing</td>
                                            <td>26</td>
                                            <td>123 6th St. Melbourne, FL 32904</td>
                                            <td>404-447-6013</td>
                                            <td>29 Jan 2018</td>
                                            <td><span class="badge badge-warning">Pending</span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane table-responsive" id="India">
                                    <table class="table m-b-0 table-hover">
                                        <thead class="thead-warning">
                                        <tr>
                                            <th>Media</th>
                                            <th>Patients ID</th>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Address</th>
                                            <th>Number</th>
                                            <th>Last Visit</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><span class="list-icon"><img class="patients-img" src="../assets/images/xs/avatar4.jpg" alt=""></span></td>
                                            <td><span class="list-name">KU 00951</span></td>
                                            <td>James</td>
                                            <td>32</td>
                                            <td>44 Shirley Ave. West Chicago, IL 60185</td>
                                            <td>404-447-6013</td>
                                            <td>22 Jan 2018</td>
                                            <td><span class="badge badge-warning">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="list-icon"><img class="patients-img" src="../assets/images/xs/avatar1.jpg" alt=""></span></td>
                                            <td><span class="list-name">KU 00953</span></td>
                                            <td>charlie</td>
                                            <td>51</td>
                                            <td>123 6th St. Melbourne, FL 32904</td>
                                            <td>404-447-6013</td>
                                            <td>22 Jan 2018</td>
                                            <td><span class="badge badge-warning">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="list-icon"><img class="patients-img" src="../assets/images/xs/avatar2.jpg" alt=""></span></td>
                                            <td><span class="list-name">KU 00934</span></td>
                                            <td>Bing</td>
                                            <td>26</td>
                                            <td>123 6th St. Melbourne, FL 32904</td>
                                            <td>404-447-6013</td>
                                            <td>29 Jan 2018</td>
                                            <td><span class="badge badge-warning">Pending</span></td>
                                        </tr>
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
