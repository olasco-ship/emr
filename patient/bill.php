<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}




require('../layout/header.php');
?>



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> BILLING </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Bill Patient</li>
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

            <a href="home.php" style="font-size: large">&laquo; Back</a>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2>Bill New Patient</h2>
                        </div>
                        <div class="body">

                            <div class="row">
                                <div class="col-md-7">

                                    <ul class="nav nav-tabs-new2">
                                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new2">Haematology</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new2">Chemical Pathology</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Contact-new2">Microbiology</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="Home-new2">

                                            <h5>Haematology</h5>
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Name Of Investigation</th>
                                                        <th>Reference</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="testItems">
                                                    <?php // $revs = Test::find_all();
                                                    $revs = Test::find_all_by_unit_id(1);
                                                    foreach ($revs as $rev) { ?>
                                                        <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                            <td>
                                                                <div class="checkbox"><label><input type="checkbox"
                                                                                                    class="add_to_bill" value=""
                                                                                                    data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                    </label>
                                                                </div>

                                                            </td>
                                                            <td><?php echo $rev->reference ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="Profile-new2">

                                            <h5>Chemical Pathology</h5>
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Name Of Investigation</th>
                                                        <th>Reference</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="chemItems">
                                                    <?php // $revs = Test::find_all();
                                                    $revs = Test::find_all_by_unit_id(2);
                                                    foreach ($revs as $rev) { ?>
                                                        <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                            <td>
                                                                <div class="checkbox"><label><input type="checkbox"
                                                                                                    class="add_to_bill" value=""
                                                                                                    data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                    </label>
                                                                </div>

                                                            </td>
                                                            <td><?php echo $rev->reference ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="Contact-new2">

                                            <h5> Microbiology </h5>
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Name Of Investigation</th>
                                                        <th>Reference</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="microItems">
                                                    <?php // $revs = Test::find_all();
                                                    $revs = Test::find_all_by_unit_id(3);
                                                    foreach ($revs as $rev) { ?>
                                                        <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                                            <td>
                                                                <div class="checkbox"><label><input type="checkbox"
                                                                                                    class="add_to_bill" value=""
                                                                                                    data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                                                    </label>
                                                                </div>

                                                            </td>
                                                            <td><?php echo $rev->reference ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-5 bill" id="testCheck">

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