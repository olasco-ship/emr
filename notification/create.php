<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 1:30 PM
 */



require_once("../includes/initialize.php");


$message = "";
$done = FALSE;

$index = 1;


$notifications = Notification::find_all();




if (is_post()) {

    if ($_POST['name']) {
        if (empty($_POST['name'])) {
            $errorName = " Name Of Notification is Required";
            $errorMessage .= $errorName . "<br/>";
        } else {
            $name = test_input($_POST['name']);
        }
    }

    if (empty($_POST['value'])) {
        $errorValue = "Value is Required";
        $errorMessage .= $errorValue . "<br/>";
    } else {
        $value = test_input($_POST['value']);
    }



//    if (!$errorMessage) {
    $notification           = new Notification();
    $notification->name     = $name;
    $notification->value    = $value;
    $notification->date     = strftime("%Y-%m-%d %H:%M:%S", time());
    if ($notification->save()) {
        $done = TRUE;
        $session->message("Notification has been successfully uploaded");
        redirect_to('create.php');
    }
    //  }


    if ($errorMessage) {
        $panelClass = 'panel-danger';
        $panelHeader = '<div class="panel-heading"><h3 class="panel-title">Please correct the errors in the form<br></h3> class=
                          "panel-title alert alert-danger">' . $errorMessage . '</h3> </div>';
    }
}


require('../layout/header.php');
?>




    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                            Notification Settings </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">

                <div class="col-lg-12 col-md-12">
                    <div class="card">

                        <div class="body">

                            <a href="home.php" style="font-size: large">&laquo; Back</a>
                            <ul class="nav nav-tabs-new">
                                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new">Notification</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new">Add New Notification</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="Home-new">
                                    <h6>Notifications</h6>
                                        <div class="table-responsive">
                                            <table class="table no-margin">
                                                <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Notification </th>
                                                    <th>Value</th>
                                                    <th>Date Added</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach($notifications as $notification) {   ?>
                                                    <tr>
                                                        <td><?php echo $index++; ?></td>
                                                        <td><?php echo $notification->name; ?></td>
                                                        <td><?php echo $notification->value; ?></td>
                                                        <td><?php $d_date = date('d/m/Y h:i a', strtotime($notification->date)); echo $d_date; ?></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                                <div class="tab-pane" id="Profile-new">
                                    <h6>Add New Notification</h6>
                                    <form id="basic-form" action="" method="post">
                                        <div class="form-group">
                                            <!--    <label>Drug Name</label>  -->
                                            <input type="text" class="form-control" style="width: 350px" name="name"
                                                   placeholder="Notification" value="<?php echo $name ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <!--    <label>Selling Price</label>  -->
                                            <input type="text" class="form-control" style="width: 350px" name="value"
                                                   placeholder="Value" value="<?php echo $value ?>" required>
                                        </div>

                                        <br>
                                        <button type="submit" class="btn btn-primary">Save Notification <!-- Test --></button>
                                    </form>
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


