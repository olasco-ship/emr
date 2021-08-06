<?php

require_once ('../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

$message = "";

$finds = Complain::find_all();

$index = 1;

if (is_post()){
    if ($_POST['complain']){

        if (empty($_POST['complain'])){

            $errorName = "Complain is required";
            $errorMessage .= $errorName . "</br>";
        } else {
            $complain = test_input($_POST['complain']);
        }
    }

    if ((!$errorMessage) and empty($errorMessage)){

        $new_complain = new Complain();
        $new_complain->sync = "off";
        $new_complain->name = $complain;
        $new_complain->date = strftime("%Y-%m-%d %H:%M:%S", time());

        if ($new_complain->create()){
            $done = TRUE;
            $session->message("A new complain has been created");
            redirect_to('#');
        } else {
            $done = FALSE;
            $session->message("Couldn't create a new complain");
        }
    }

}


require_once ('../layout/header.php');
?>




    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a></h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="complain.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Plan Names</li>
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

                                        <a href="index.php" style="font-size: large">&laquo; Back</a>
                                        <ul class="nav nav-tabs-new">
                                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new">List of complains</a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new">Add New Complain</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="Home-new">
                                                <h6>Complains</h6>
                                                <div class="table-responsive">
                                                    <table class="table no-margin">
                                                        <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Complains</th>
                                                            <th>Date Added</th>
                                                            <th> </th>
                                                            <th> </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach($finds as $find) { ?>
                                                            <tr>
                                                                <td><?php echo $index++; ?></td>
                                                                <td><a href="#"><?php echo $find->name; ?></a></td>
                                                                <td><?php $d_date = date('d/m/Y h:i a', strtotime($find->date));echo $d_date; ?></td>
                                                                <td><a href="edit_complain.php?id=<?php echo $find->id; ?> ">Edit</a></td>
                                                                <td><a href="delete_complain.php?id=<?php echo $find->id; ?> ">Delete</a></td>
                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="Profile-new">
                                                <h6>Add New Complain</h6>
                                                <form action="" method="post">

                                                    <div class="form-group">
                                                        <input class="form-control" name="complain" id="complain" placeholder="Add new Complain" type="text" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Save New Complain</button>
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
require_once ('../layout/footer.php');
