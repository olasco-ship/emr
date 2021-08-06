<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 1:52 PM
 */



require_once("../includes/initialize.php");

$message = "";

//$finds = NursingDomain::find_all();

$finds = NursingDomain::find_by_id($_GET['id']);


if(is_post()){
    if ($_POST['name']) {
        if (empty($_POST['name'])) {
            $errorName= "Domain is Required";
            $errorMessage .= $errorName . "<br/>";
        } else {
            $name = test_input($_POST['name']);
        }
    }

        $finds->sync        = "off";
        $finds->name        = $name;
        $finds->date        = strftime("%Y-%m-%d %H:%M:%S", time());
        $finds->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($finds->save()){
            $session->message("The Nursing Domain has been updated.");
            redirect_to('index.php');
        } else {
            $done = FALSE;
            $session->message("Could not update the Nursing Domain .");

        }

}




require('../layout/header.php');
?>



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Hospitals</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Nursing Domain </li>
                            <!--<li class="breadcrumb-item active">All Patient</li>-->
                        </ul>
                    </div>

                </div>
            </div>



            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">

                        <div class="body">


                            <div class="col-lg-12 col-md-12">
                                <div class="card">

                                    <div class="body">
                                        <a href="../nursingProcess/index.php" style="font-size: large">&laquo; Back</a>
                                        <ul class="nav nav-tabs-new">
                                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new">Edit Domains </a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="Home-new">

                                                <h6>Edit Domain </h6>
                                                <form id="basic-form" action="" method="post">
                                                    <div class="form-group">
                                                        <!--    <label>Drug Name</label>  -->
                                                        <input type="text" class="form-control" style="width: 350px"
                                                               name="name" placeholder="Domain Name"
                                                               value="<?php echo $finds->name ?>" required>
                                                    </div>

                                                    <br>
                                                    <button type="submit" class="btn btn-primary">Save Domain</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
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
