<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 5/18/2019
 * Time: 1:41 PM
 */


require_once("../includes/initialize.php");

if (($user->role == 'Super Admin') OR ($user->department == 'Pharmacy')) {
    redirect_to(emr_lucid);
}


if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    
    $array = PatientBill::get_bill();
    file_put_contents("dispense_array.json", json_encode($array));
   // PatientBill::clear_all_bill();
    
    redirect_to("flow_two.php");


}


PatientBill::clear_all_bill();


require('../layout/header.php');
?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                        class="fa fa-arrow-left"></i></a>
                            Pharmacy </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Assign Drugs</li>
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

                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="header">
                            <!-- <h2>Total Revenue</h2>-->
                            <ul class="header-dropdown">
                                <li><a class="tab_btn" href="javascript:void(0);" title="Weekly">W</a></li>
                                <li><a class="tab_btn" href="javascript:void(0);" title="Monthly">M</a></li>
                                <li><a class="tab_btn active" href="javascript:void(0);" title="Yearly">Y</a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                       role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">

                                        <div class="col-sm-6" >
                                            <h5> Name Of Drugs </h5>

                                                <div class="form-group">
                                                    <!--      <input type="text" placeholder="Name Of Drug" class="form-control" name="txtCountry" id="txtCountry" class="typeahead"/> -->
                                                    <form class="form-inline" id="flowSearch">
                                                        <input type="text" placeholder="Name Of Drug" name="txtProduct"
                                                               id="txtProduct" autocomplete="off" class="typeahead"/>
                                                        <br/><br/>
                                                        <button type="submit" id="submit" class="btn btn-lg btn-info"
                                                                data-loading-text="Searching...">Search
                                                        </button>
                                                    </form>
                                                </div>

                                        </div>


                                        <div class="col-sm-6" id="flow_one">

                                            <?php //   echo PatientBill::storage_page(); ?>


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



