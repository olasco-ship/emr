<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 1:52 PM
 */



require_once("../includes/initialize.php");

$examination = Examination::find_by_id($_GET['id']); //  print_r($finds);  exit;


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

    $examination->sync                      = "off";
    $examination->examination_category_id   = $exam_cat_id;
    $examination->name                      = $name;
    $examination->date                      = strftime("%Y-%m-%d %H:%M:%S", time());
    if ($examination->delete()){
        $session->message("An examination  has been deleted.");
        redirect_to('examination.php');
    } else {
        $session->message("Could not delete the examination .");

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

                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="Home-new">
                                                <a href="examination.php" style="font-size: large">&laquo; Back</a>
                                                <h6>Edit Examination</h6>
                                                <div class="form-group">
                                                    <form id="basic-form" action="" method="post">
                                                        <div class="form-group">
                                                            <select class="form-control" style="width: 350px" id="exam_cat_id" name="exam_cat_id">
                                                                <option value="">--Select Examination--</option>
                                                                <?php
                                                                $finds = ExaminationCategory::find_all();
                                                                foreach ($finds as $find) {
                                                                    ?>
                                                                    <option <?php echo $find->id == $examination->examination_category_id ? 'selected' : ' '; ?>
                                                                        value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            &nbsp;
                                                            <input class="form-control" name="name"
                                                                   placeholder="Classification" style="width: 300px"
                                                                   type="text" value="<?php echo $examination->name; ?>" required >

                                                        </div>


                                                        <br>
                                                        <button type="submit" class="btn btn-primary">Delete Examination</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="Profile-new">
                                                <h6>Add Nursing Classification </h6>
                                                <form action="" method="post">
                                                    <div class="input-group">
                                                        <select class="form-control" style="width: 350px" id="nursingDomain_id" name="nursingDomain_id">
                                                            <option value="">--Select Domain--</option>
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
                                                        <input class="form-control" name="name" placeholder="Examination" style="width: 300px" type="text" required >
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

