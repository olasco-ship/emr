<?php

require_once ('../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

$done = FALSE;
$message = "";
$errorMessage = "";
$exam_cat = "";
$errorName = "";


$finds = ExaminationCategory::find_all();


$index = 1;

if (is_post()){
    if ($_POST['exam_cat']){

        if (empty($_POST['exam_cat'])) {

            $errorName = "Examination Category is required";
            $errorMessage .= $errorName . "</br>";

        }else {
            $exam_cat = test_input($_POST['exam_cat']);
            $existing = ExaminationCategory::find_by_name($exam_cat);
            if (isset($existing) && !empty($existing)){
                $errorName = "Examination category already exist";
                $errorMessage .= $errorName . "</br>";
            }else{
                $exam_cat = test_input($_POST['exam_cat']);
            }

        }
    }

    if ((!$errorMessage) and empty($errorMessage)){

        $new_exam_cat = new ExaminationCategory();
        $new_exam_cat->sync = "off";
        $new_exam_cat->name = $exam_cat;
        $new_exam_cat->date = strftime("%Y-%m-%d %H:%M:%S", time());

        if ($new_exam_cat->create()){
            $done = TRUE;
            $session->message("A new examination category has been created");
            //redirect_to('#');
        } else {
            $done = FALSE;
            $session->message("Couldn't create a new examination category");
        }
    }

    if ($errorMessage) {
        $panelClass = 'panel-danger';
        $panelHeader = '<div class="panel-heading"><h3 class="panel-title alert alert-danger">' . $errorMessage . '</h3> </div>';

        //echo $panelClass . $panelHeader;
    }
    // echo $errorMessage;

//    print_r($errorMessage);
//    exit;

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
                            <li class="breadcrumb-item"><a href="examination_category.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Examination Categories</li>
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
                                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new">List of Examination Categories</a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new">Add New Examination Category</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="Home-new">
                                                <h6>Examination Categories</h6>
                                                <div class="table-responsive">
                                                    <table class="table no-margin">
                                                        <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Examination Category</th>
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
                                                                <td><a href="edit_exam_cat.php?id=<?php echo $find->id; ?> ">Edit</a></td>
                                                                <td><a href="delete_exam_cat.php?id=<?php echo $find->id; ?> ">Delete</a></td>
                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="Profile-new">
                                                <h6>Add New Examination Category</h6>
                                                <form action="" method="post">

                                                    <div class="form-group">
                                                        <input class="form-control" name="exam_cat" id="exam_cat" placeholder="Add new Category" type="text" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Save New Category</button>
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

