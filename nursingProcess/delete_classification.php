<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 1:52 PM
 */



require_once("../includes/initialize.php");

$message = "";


$nursingClass = NursingClassification::find_by_id($_GET['id']);


if(is_post()){
    if ($_POST['name']) {
        if (empty($_POST['name'])) {
            $errorName= "Domain is Required";
            $errorMessage .= $errorName . "<br/>";
        } else {
            $name = test_input($_POST['name']);
        }
    }

    $nursingClass->sync        = "off";
    $nursingClass->name        = $name;
    $nursingClass->date        = strftime("%Y-%m-%d %H:%M:%S", time());
    $nursingClass->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
    if ($nursingClass->delete()){
        $session->message("The Nursing Classification has been deleted.");
        redirect_to('classification.php');
    } else {
        $session->message("Could not delete the Nursing Classification .");

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
                            <li class="breadcrumb-item">Nursing Classification </li>
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
                                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new">Delete Domain </a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="Home-new">

                                                <!--<h6>Edit Domain </h6>-->
                                                <form id="basic-form" action="" method="post">
                                                    <div class="form-group">
                                                        <?php
                                                        $finds = NursingDomain::find_all();
                                                        foreach ($finds as $find)
                                                        ?>
                                                        <input type="text" class="form-control" style="width: 350px"
                                                               name="name" placeholder="Domain Name"
                                                               value="<?php echo $find->name ?>" required>

                                                        &nbsp;
                                                        <input class="form-control" name="name"
                                                               placeholder="Classification" style="width: 300px"
                                                               type="text" value="<?php echo $nursingClass->name; ?>" required >

                                                    </div>

                                                    <br>
                                                    <button type="submit" class="btn btn-primary">Delete</button>
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

