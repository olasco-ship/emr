<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 1:52 PM
 */



require_once("../includes/initialize.php");

$index = 1;

$finds = Examination::find_all();


if(is_post()){
    if ($_POST['name']) {
        if (empty($_POST['name'])) {
            $errorName= "Examination is Required";
            $errorMessage .= $errorName . "<br/>";
        } else {
            $name = test_input($_POST['name']);
        }
    }

    $exam_cat_id = test_input($_POST['exam_cat_id']);

    if ((!$errorMessage) and empty($errorMessage)){
        $exam                           = new Examination();
        $exam->sync                     = "off";
        $exam->examination_category_id  = $exam_cat_id;
        $exam->name                     = $name;
        $exam->date                     = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($exam->create()){
            $done = TRUE;
            $session->message("A new Examination has been created.");
            redirect_to('examination.php');
        } else {
            $done = FALSE;
            $session->message("Could not create a new examination .");

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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Nursing Department</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item"> Examination </li>

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
                                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new"> Examinations </a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new">Add Examination </a></li>
                                        </ul>

                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="Home-new">
                                                <h6>Examinations</h6>
                                                <div class="table-responsive">
                                                    <table class="table no-margin">
                                                        <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Examination Category</th>
                                                            <th>Examination</th>
                                                            <th>Date Added</th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach($finds as $find) {
                                                            $examination = ExaminationCategory::find_by_id($find->examination_category_id);
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $index++; ?></td>
                                                                <td><?php echo $examination->name ?></td>
                                                                <td><?php echo $find->name; ?></td>
                                                                <td><?php $d_date = date('d/m/Y h:i a', strtotime($find->date)); echo $d_date; ?></td>
                                                                <td><a href="edit_exam.php?id=<?php echo $find->id; ?>">Edit</a> </td>
                                                                <td><a href="delete_exam.php?id=<?php echo $find->id; ?>">Delete</a> </td>
                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="Profile-new">
                                                <h6>Add Examination </h6>
                                                <form action="" method="post">
                                                    <div class="input-group">
                                                        <select class="form-control" style="width: 350px" id="exam_cat_id" name="exam_cat_id">
                                                            <option value="">--Select Exam-Category--</option>
                                                            <?php
                                                            $finds = ExaminationCategory::find_all();
                                                            foreach ($finds as $find) {
                                                                ?>
                                                                <option
                                                                    value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <input class="form-control" name="name" id="name" placeholder="Examination" style="width: 300px" type="text" required >
                                                        <button type="submit" class="btn btn-primary">Save Examination</button>
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
