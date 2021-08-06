<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$count_prescribed = Encounter::count_prescribed();

$count = Product::count_all();


require('../layout/header.php');
?>




    <div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a> Medical Records </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">NHIS</li>
                        <li class="breadcrumb-item active"> Eligibility Check</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 ">
                <div class="card">
                    <div class="header">
                        <h2> Enter NHIS Number to view eligibility </h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">

                            <div class="col-sm-4">
                                <?php echo output_message($message); ?>
                                <form id="nhis_search">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nhis_number" name="nhis_number"
                                               required>
                                        <br/>
                                        <button type="submit" class="btn btn-primary" data-loading-text="Searching...">
                                            Search Record
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-sm-8">

                            </div>
                        </div>

                        <div id="revItems">

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>






<?php

require('../layout/footer.php');
