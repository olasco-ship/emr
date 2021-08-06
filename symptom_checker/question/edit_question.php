<?php
require_once("../../includes/config.php");
require_once("../../includes/functions.php");
require_once("../../includes/session.php");
require_once("../../includes/database.php");
require_once("../../includes/database_object.php");
require_once("../../includes/waiting_list.php");
require_once("../../includes/patient.php");
require_once("../../includes/refer_admission.php");
require_once("../../includes/user.php");


require_once("../../includes/revenueHead.php");

require_once("../table/Symptom.php");
require_once("../table/BodyPart.php");


require_once("../table/QuestionTable.php");
require('../../layout/header.php');

$allBodyPart = BodyPart::find_all();

if(empty($_GET['id'])){
    $session->message("Invalid Question");
    redirect_to('../question/index.php');
}

$questDetail = QuestionTable::find_by_id($_GET['id']);

$symptom = Symptom::find_by_body_part_id($questDetail->body_part_id);

//pre_d($questDetail);die;
?>
<link href="../css/select2.min.css" rel="stylesheet" />


<div id="main-content">
<div class="container-fluid">
    <?php include "../../layout/header_chart.php"; ?>

<div class="row clearfix">
    <div class="col-md-12">
        <div class="card patients-list">
            <div class="header">
                <ul class="header-dropdown">
                    <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Weekly">W</a></li>
                    <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Monthly">M</a></li>
                    <li><a class="tab_btn active" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Yearly">Y</a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another Action</a></li>
                            <li><a href="javascript:void(0);">Something else</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-lg-12 col-md-12">
                <form class=" pb-4" action="../model/QuestionModel.php" method="post">
                    <input type="hidden" value="<?php echo $questDetail->id ?>" name="id"/>
                    <!-- <div class="form-group row">
                        <div class="offset-sm-2 col-sm-2 col-3">  
                            <label> Select Body Part <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-4 col-9"> 
                            <select class="form-control body_part_id_question" placeholder="Name" name="body_part_id" required="">
                                <option value=""> -- Select Body Part -- </option>
                                <?php 
                                    // if(!empty($allBodyPart)){
                                    //     $selBodyPart = "";
                                    //     foreach ($allBodyPart as $PartData) {
                                            ?>
                                                <option value="<?php //echo $PartData->id; ?>" <?php //echo (isset($questDetail->body_part_id) && $questDetail->body_part_id == $PartData->id)? "selected='selected'" : ""  ?>><?php //echo $PartData->name; ?></option>
                                <?php
                                    //     }
                                    // }
                                ?>
                            </select>
                        </div>
                    </div> -->
                    <!-- <div class="form-group row">
                        <div class="offset-sm-2 col-sm-2 col-3">  
                            <label> Select Symptom <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-4 col-9"> 
                            <select class="form-control body_part_id_symptom_id" placeholder="Name" name="body_part_symptom_id" required="">
                                <option value=""> -- Select Symptom -- </option>
                                <?php
                                    // if(!empty($questDetail->body_part_symptom_id)){
                                    //     foreach($symptom as $symData){
                                        ?>
                                            <option value="<?//= $symData->id ?>" <?php //echo (isset($questDetail->body_part_symptom_id) && $questDetail->body_part_symptom_id == $symData->id)? "selected='selected'" : ""  ?>> <?//= $symData->name ?> </option>
                                        <?php
                                    //     }
                                    // }
                                ?>
                                
                            </select>
                        </div>
                    </div> -->
                    <!-- <div class="form-group row">
                        <div class="offset-sm-2 col-sm-2 col-3">  
                            <label> Select Symptom <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-4 col-9"> 
                            <select class="form-control symptom_id" name="symptom_id" required="">
                                <option value=""> --Select Symptom-- </option>
                            </select>
                        </div>
                    </div> -->
                    <!-- <div class="form-group row">
                        <div class="offset-sm-2 col-sm-2 col-3">  
                            <label> Select Gender <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-4 col-9"> 
                            <input type="radio" value="male" name="gender" <?php //echo (isset($questDetail->body_part_id) && $questDetail->gender == "male")? "checked='checked'" : ""  ?>/> Male
                            <input type="radio" value="female" name="gender" <?php //echo (isset($questDetail->body_part_id) && $questDetail->gender == "female")? "checked='checked'" : ""  ?>/> Female
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-2 col-3">  
                            <label> Input Question <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-4 col-9"> 
                            <textarea class="form-control question" name="question" placeholder="Question" required=""><?php echo (isset($questDetail->question))? $questDetail->question : ""  ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-2 col-3">  
                            <label> Select Question Type <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-4 col-9"> 
                            <input type="radio" value="radio" name="type" <?php echo (isset($questDetail->body_part_id) && $questDetail->type == "radio")? "checked='checked'" : ""  ?>/> Single Choice
                            <input type="radio" value="checkbox" name="type" <?php echo (isset($questDetail->body_part_id) && $questDetail->type == "checkbox")? "checked='checked'" : ""  ?>/> Multiple Choice
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-2 col-3">  
                            <label> Answer Label <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-4 col-9"> 
                            <?php 
                                if(isset($questDetail->options)){
                                ?>
                                     <select class="form-control answer_label" name="answer_label[]" multiple="multiple">
                                
                                <?php
                                    $decoLabel = json_decode($questDetail->options);
                                    if (!empty($decoLabel)) {
                                        foreach ($decoLabel as $key => $labelData) {
                                            ?>
                                                <option selected="selected"><?php echo $labelData ?></option>
                            <?php
                                        }
                                    }
                            ?>
                                    </select>
                            <?php
                                }else{
                            ?>
                                <select class="form-control answer_label" name="answer_label[]" multiple="multiple">
                                </select>
                            <?php
                                }
                            ?>                            
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <div class="offset-sm-2 col-sm-2 col-3">  
                            <label> Answer Value <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-4 col-9"> 
                        <?php 
                                //if(isset($questDetail->answer_value)){
                                ?>
                                     <select class="form-control answer_value" name="answer_value[]" multiple="multiple">
                                
                                <?php
                                    // $decoValue = json_decode($questDetail->answer_value);
                                    // if (!empty($decoValue)) {
                                    //     foreach ($decoValue as $key => $valueData) {
                                            ?>
                                                <option selected="selected"><?php //echo $valueData ?></option>
                            <?php
                                    //     }
                                    // }
                            ?>
                                    </select>
                            <?php
                                // /}else{
                            ?>
                                <select class="form-control answer_value" name="answer_value[]" multiple="multiple">
                                </select>
                            <?php
                                // /}
                            ?>
                            
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-2 col-3">  
                            <label> Total Marks <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-4 col-9"> 
                            <input type="text" class="form-control total_marks" name="total_marks" placeholder="Total marks" value="<?php echo (isset($questDetail->total_marks))? $questDetail->total_marks : ''  ?>"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-2 col-3">  
                            <label> Minimum Marks <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-4 col-9"> 
                            <input type="text" class="form-control minimum_marks" name="minimum_marks" placeholder="Minimum marks" value="<?php echo (isset($questDetail->minimum_marks))? $questDetail->minimum_marks : ''  ?>"/>
                        </div>
                    </div>

                    <div class="col-sm-4 col-12 text-center"> 
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<?php
require('../../layout/footer.php');
?>
<script src="../js/select2.min.js"></script>
<script src="../js/script.js" ></script>