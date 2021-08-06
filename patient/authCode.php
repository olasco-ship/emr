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



$dept = 'Records';
//$bills = Bill::find_all_by_dept($dept);


$index = 1;

//FOR PAGINATION
//1. the current page number ($current_page)
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

//2. records per page ($per_page)
$per_page = 100;

//3. total record count ($total_count)
//$count = Patient::count_all();
$count = Bill::count_all_by_dept($dept);


// Find all Bills
// $bills = Bill::find_all_order_by_date();  Use pagination instead

$pagination = new Pagination($page, $per_page, $count);

//$sql  = "SELECT * FROM bills WHERE dept = '$dept' ORDER BY date DESC ";
$sql  = "SELECT * FROM bills WHERE dept = '$dept' AND revenues = 'Folder' AND status = 'PAID' ORDER BY date DESC ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$bills = Bill::find_by_sql($sql);
//$patients = Patient::find_by_sql($sql);














require('../layout/header.php');
?>



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Register New Patient</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Paid Bills</li>
                           <!-- <li class="breadcrumb-item active">Payments List</li>-->
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Bills For Folder</h2>
                            <ul class="header-dropdown">
                                <li><a class="tab_btn" href="javascript:void(0);" title="Weekly">W</a></li>
                                <li><a class="tab_btn" href="javascript:void(0);" title="Monthly">M</a></li>
                                <li><a class="tab_btn active" href="javascript:void(0);" title="Yearly">Y</a></li>
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





                           <!-- <div id="pagination" style="clear: both; text-align: right">
                                <?php
/*                                if($pagination->total_pages() > 1){
                                    if($pagination->has_previous_page()){
                                        echo "<a href=\"folder.php?page=";
                                        echo $pagination->previous_page();
                                        echo "\">&laquo; Previous</a> ";
                                    }

                                    for($i=1; $i <= $pagination->total_pages(); $i++){
                                        if($i == $page){
                                            echo " <span class=\"selected\">{$i}</span> ";
                                        } else {
                                            echo " <a href=\"folder.php?page={$i}\">{$i}</a> ";
                                        }
                                    }


                                    if($pagination->has_next_page()){
                                        echo "<a href=\"folder.php?page=";
                                        echo $pagination->next_page();
                                        echo "\">Next &raquo;</a> ";
                                    }

                                }
                                */?>
                            </div>-->

                            <a href="home.php" style="font-size: large">&laquo; Back</a>
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>S/N</th>
                                        <th>Bill No.</th>
                                        <th>Patient Name</th>
                                        <th>Amount</th>
                                        <th>Officer</th>
                                        <th>Date </th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php  foreach($bills as $bill) {   ?>
                                        <tr>
                                            <td><?php echo $index++ ?></td>
                                            <td><a href='create.php?id=<?php echo $bill->id ?>'><?php echo $bill->bill_number ?></a></td>
                                            <td><?php echo $bill->first_name ." ". $bill->last_name ?></td>
                                            <td><?php echo "₦$bill->total_price" ?></td>
                                            <td><?php echo $bill->revenue_officer ?></td>
                                            <td><?php $d_date = date('d/m/Y h:i a', strtotime($bill->date)); echo $d_date ?></td>
                                            <td><span class="badge badge-warning">BILLED</span></td>
                                        </tr>
                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div>

                            <ul class="pagination">
                                <?php
                                if($pagination->total_pages() > 1){
                                    if($pagination->has_previous_page()){
                                        echo " <li class='page-item'><a class='page-link' href='folder.php?page=";
                                        echo $pagination->previous_page();
                                        echo "'>Previous</a></li>";
                                    }

                                    for($i=1; $i <= $pagination->total_pages(); $i++){
                                        if($i == $page){
                                            echo "<li class='page-item active'><span class='page-link' >{$i}</span></li>";
                                            //   echo " <span class=\"selected\">{$i}</span> ";
                                        } else {
                                            echo "<li class='page-item'><a class='page-link' href='folder.php?page={$i}'>{$i}</a></li>";
                                            //   echo " <a href=\"folder.php?page={$i}\">{$i}</a> ";
                                        }
                                    }

                                    if($pagination->has_next_page()){
                                        echo " <li class='page-item'><a class='page-link' href='folder.php?page=";
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




<?php

require('../layout/footer.php');




