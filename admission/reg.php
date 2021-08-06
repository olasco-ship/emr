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






require('../layout/header.php');



?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Patient Registration </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Patient</li>
                        <li class="breadcrumb-item active">Register</li>
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




                    <div class="body">
                        <a href="../patient/home.php" style="font-size: large">&laquo; Back</a>
                        <?php echo output_message($message); ?>

                        <div href="#" class="right">
                            <form class="form-inline" id="registration_search">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Folder Number" id="folder_number" name="folder_number" required>
                                    <button type="submit" class="btn btn-outline-primary">Search</button>
                                    <button type="button" name="search" onClick="location.href=location.href" class="btn btn-outline-warning">Refresh</button>
                                </div>
                            </form>

                        </div>


                        <div id="registration">

                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
</div>





<?php

require('../layout/footer.php');
?>


<script>
    $(function() {


        $('#registration_search')
            .on('submit', function($ev) {
                $ev.preventDefault();
                let patient = $('#registration_search input#folder_number').val();
                //  var $btn = $('#registration_search button[type="submit"]').button('loading');
                $.post('search.php', {
                    folder_number: patient
                }, function(data) {
                    $('#registration').html(data.trim());
                });

            });



    });
</script>