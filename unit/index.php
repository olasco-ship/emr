<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 1:52 PM
 */



require_once("../includes/initialize.php");

$index = 1;

$finds = Unit::find_all();
$index = 1;


if(is_post()){
    if ($_POST['name']) {
        if (empty($_POST['name'])) {
            $errorName= "Unit is Required";
            $errorMessage .= $errorName . "<br/>";
        } else {
            $name = test_input($_POST['name']);
        }
    }

    $revenueHead_id = test_input($_POST['revenueHead_id']);

    if ((!$errorMessage) and empty($errorMessage)){
        $unit                 = new Unit();
        $unit->sync           = "off";
        $unit->name           = $name;
        $unit->revenueHead_id = $revenueHead_id;
        $unit->date        = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($unit->create()){
            $done = TRUE;
            $session->message("A new Unit has been created.");
            redirect_to('index.php');
        } else {
            $done = FALSE;
            $session->message("Could not create a new Unit.");

        }
    }
}




require('../layout/header.php');
?>



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Account & Revenue </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Unit </li>
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
                                    <a href="../revenue/home.php" style="font-size: large">&laquo; Back</a>
                                        <ul class="nav nav-tabs-new">
                                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new">Unit </a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new">Add Unit </a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="Home-new">
                                                <h6>Unit</h6>
                                                <div class="table-responsive">
                                                    <table class="table no-margin">
                                                        <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Unit</th>
                                                            <th>Date Added</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach($finds as $find) {   ?>
                                                            <tr>
                                                                <td><?php echo $index++; ?></td>
                                                                <td><?php echo $find->name; ?></td>
                                                                <td><?php $d_date = date('d/m/Y h:i a', strtotime($find->date)); echo $d_date; ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="Profile-new">
                                                <h6>Add New Unit </h6>
                                                <form action="" method="post">

                                                    <div class="input-group">
                                                        <select class="form-control" style="width: 350px" id="revenueHead_id" name="revenueHead_id">
                                                            <option value="">--Select Revenue Head--</option>
                                                            <?php
                                                            $finds = RevenueHead::find_all();
                                                            foreach ($finds as $find) {
                                                                ?>
                                                                <option
                                                                        value="<?php echo $find->id; ?>"><?php echo $find->revenue_name; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <input class="form-control" name="name" placeholder="Unit" style="width: 300px" type="text">
                                                        <button type="submit" class="btn btn-primary">Save Unit</button>
                                                    </div>
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