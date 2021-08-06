<?php
require_once("../../../includes/config.php");
require_once("../../../includes/functions.php");
require_once("../../../includes/session.php");
require_once("../../../includes/database.php");
require_once("../../../includes/database_object.php");
require_once("../../../includes/waiting_list.php");
require_once("../../../includes/patient.php");
require_once("../../../includes/refer_admission.php");
require_once("../../../includes/user.php");


require_once("../../../includes/revenueHead.php");

require_once("../../table/Symptom.php");
require_once("../../table/BodyPart.php");


require_once("../../table/QuestionTable.php");
require_once("../../table/QuestionMappingTable.php");
require('../../../layout/header.php');

$allBodyPart = BodyPart::find_all();

if(empty($_GET['id'])){
    $session->message("Invalid Question");
    redirect_to('../question/index.php');
}

$questDetail = QuestionMappingTable::find_by_id($_GET['id']);

$allListQuestion = QuestionTable::find_all();

?>
<link href="../../css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="../../css/bootstrap-slider.css"/>

<div id="main-content">
<div class="container-fluid">
    <?php include "../../../layout/header_chart.php"; ?>

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
            <form class=" pb-4" action="../../model/QuestionMappingModel.php" method="post">
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>"/>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-2 col-3">  
                    <label> Gender <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-4 col-9"> 
                    <input type="radio" value="male" name="gender" <?= (isset($questDetail->gender) && $questDetail->gender == "male") ? "checked='checked'" : '' ?>/> Male
                    <input type="radio" value="female" name="gender"/ <?= (isset($questDetail->gender) && $questDetail->gender == "female") ? "checked='checked'" : '' ?>> Female
                </div>
            </div>

            <div class="form-group row">
                <div class="offset-sm-2 col-sm-2 col-3">  
                    <label> Age Group (Year) <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-2 col-9"> 
                    <input type="number" class="form-control age_range_to" name="age_group_to" placeholder="Age Range To" required <?= (isset($questDetail->age_group_to)) ? "value='{$questDetail->age_group_to}'" : '' ?>/>
                </div>
                <div class="col-sm-2 col-9"> 
                    <input type="number" class="form-control age_range_from" name="age_group_from" placeholder="Age Range From" required <?= (isset($questDetail->age_group_from)) ? "value='{$questDetail->age_group_from}'" : '' ?>/>
                </div>
            </div>

            <div class="form-group row">
                <div class="offset-sm-2 col-sm-2 col-3">  
                    <label> Section Name <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-4 col-9"> 
                    <textarea class="form-control section_name" name="section_name" placeholder="Section Name" required=""><?= (isset($questDetail->section_name)) ? $questDetail->section_name : '' ?></textarea>
                </div>
            </div>


            <div class="form-group row">
                <div class="offset-sm-2 col-sm-2 col-3">  
                    <label> Select Body Part <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-4 col-9"> 
                    <select class="form-control body_part_id_symptom" placeholder="Name" name="body_part_id[]" required="" multiple>
                        <option value=""> -- Select Body Part -- </option>
                        <?php 
                            if(!empty($allBodyPart)){
                                foreach ($allBodyPart as $PartData) {
                                    $cou = 0;
                                    foreach (json_decode($questDetail->body_part_id) as $dat) {
                                        if ($dat == $PartData->id) {
                                            $cou = 1;
                                            ?>
                                        <option value="<?php echo $PartData->id; ?>" selected='selected'><?php echo $PartData->name; ?></option>
                        <?php
                                        }
                                    }
                                        if ($cou == 0) {
                                            ?>
                                        <option value="<?php echo $PartData->id; ?>" ><?php echo $PartData->name; ?></option>
                                    <?php
                                        }
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="offset-sm-2 col-sm-2 col-3">  
                    <label> Select Symptom <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-4 col-9"> 
                    <select class="form-control body_part_id_symptom_id" placeholder="Name" name="body_part_id_symptom_id[]" required="" multiple>
                        <option value=""> -- Select Symptom -- </option>
                                <?php
                                $ides = json_decode($questDetail->body_part_id);
                                $ids = implode(",", $ides);
                                $symptom = Symptom::find_by_body_part_id_multiple($ids);
                                    if(!empty($questDetail->body_part_id_symptom_id)){
                                        foreach($symptom as $symData){
                                            $cous = 0;
                                            foreach (json_decode($questDetail->body_part_id_symptom_id) as $dat) {
                                                if ($dat == $symData->id) {
                                                    $cous = 1;
                                                    ?>
                                                        <option value="<?= $symData->id ?>" selected='selected'> <?= $symData->name ?> </option>
                                        <?php
                                                }
                                            }
                                            if ($cous == 0) {
                                                ?>
                                                <option value="<?= $symData->id ?>" > <?= $symData->name ?> </option>
                                            <?php
                                            }
                                        }
                                    }
                                ?>
                    </select>
                </div>
            </div>
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


            <div class="form-group row">
                <div class="offset-sm-2 col-sm-2 col-3">  
                    <label> Select Question <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-4 col-9"> 
                    <select class="form-control" placeholder="Name"  id="question_id" >
                        <option value=""> -- Select Question -- </option>
                        <?php 
                            if(!empty($allQuestion)){
                                foreach ($allQuestion as $PartData) {
                                    ?>
                                            <option value="<?php echo $PartData->id; ?>"><?php echo $PartData->question; ?></option>
                        <?php
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="questionContent"></div>
            <div class="container">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 20%;">Question</th>                                
                        <th style="width: 80%;">Operations</th>
                    </tr>
                    </thead>
                    <tbody class="contentMapping">
                        <?php 
                            
                            if(isset($questDetail->question_id)){
                                $selectedAnswerForQuestion = json_decode($questDetail->another_question);
                                $selectedQuestionMap = json_decode($questDetail->question_map_id);
                                
                                $selc = "";
                                $dropDownSel = "";
                                
                                foreach(json_decode($questDetail->question_id) as $key => $decodeQuestionId){
                                    $findQuestionById = QuestionTable::find_by_id($decodeQuestionId);
                                    
                                    $decodeQuestionAnswerLabel = json_decode($findQuestionById->answer_label);
                                    echo "<tr class='currdentDelete".$key."'>";
                                        echo "<td><div class='row'><div class='col-md-12'>".$findQuestionById->question."</div></div></td>";
                                        echo "<td>
                                        <div class='row'><div class='col-md-4'>
                                        ";
                                        echo '<input type="hidden" name="question_id[]" value="'.$decodeQuestionId.'"/>';
                                        foreach ($decodeQuestionAnswerLabel as $decodeQADatas) {
                                            foreach ($selectedAnswerForQuestion as $questionAnswerData) {
                                                if ($questionAnswerData == $decodeQADatas) {
                                                    $selcs = "checked='checked'";
                                                    
                                                    break;
                                                } else {
                                                    $selcs = "";
                                                    $dropDownSel = "";
                                                }
                                            }

                                            echo "<input type='".$findQuestionById->type."' name='another_question".$key."[]' value='{$decodeQADatas}' {$selcs} onclick='changeQuestion({$decodeQuestionId})'/>".$decodeQADatas."<br/>";
                                        }
                                            echo "</div>";
                                            // foreach($selectedQuestionMap as $decodeQAData){
                                            // foreach($selectedAnswerForQuestion as $questionAnswerData){
                                            //     if($questionAnswerData == $decodeQAData){
                                            //         $selc = "checked='checked'";
                                                    
                                            //     break;
                                            //     }else{
                                            //         $selc = "";
                                            //         $dropDownSel = "";
                                            //     }
                                            // }
                                            
                                            // if($selc == "checked='checked'"){
                                            ?>
                                                <div class="col-md-5 dropDQuestions dropDQuestion<?= $decodeQuestionId ?>" style="width:50%;" >
                                                    <style>
                                                        .dropDQuestions .select2-container{
                                                            width: 80% !important;
                                                        }
                                                    </style>
                                                    <select placeholder="Name" name="question_map_id[]" class="question_id_list<?= $decodeQuestionId ?> form-control" onChange="showRelatedAnswer('question_id_list<?= $decodeQuestionId ?>', '<?= $decodeQuestionId ?>')" style="display: none;" required="">
                                                        <option value=""> -- Select Question -- </option>
                                                        <?php 
                                                            if(!empty($allListQuestion)){
                                                                foreach ($allListQuestion as $PartData) {
                                                                    ?>
                                                                        <option value="<?php echo $PartData->id; ?>" <?= ($selectedQuestionMap[$key] == $PartData->id) ? "selected='selected'" : "" ?>><?php echo $PartData->question; ?></option>
                                                        <?php
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-md-3">
                                                        <a href="javascript:void(0)" style="cursor:pointer;" onclick="removeQuestion('<?= $decodeQuestionId ?>')"><i class="fa fa-trash"></i></a>
                                                </div>
                                                <div class="col-md-12 dropDQuestionss<?= $decodeQuestionId ?>" style="text-align: center;">
                                             
                                                            <?php
                                                            
                                                                if ($selectedQuestionMap[$key]) {
                                                                    $findById = QuestionTable::find_by_id($selectedQuestionMap[$key]);
                                                                    $f = "";
                                                                    $decodeValue = json_decode($findById->answer_value);
                                                                    $f = "<div class='col-md-12'> Question:- ".$findById->question." <br>
                                                                ";
                                                                    foreach (json_decode($findById->answer_label) as $k => $d) {
                                                                        $f .= "
                                                                    <label>".$d."  (". $decodeValue[$k] .")</label></br>
                                                                    ";
                                                                    }
                                                                    $f .= "</div> ";
                                                                    echo $f;
                                                                }
                                                            ?>

                                                </div>
                                            <?php
                                            // }
                                        // }
                                        echo "</div></td>";
                                    echo "</tr>";
                                }
                                
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="form-group row">
                <div class="offset-sm-2 col-sm-2 col-3">  
                    <label> Result Status Label <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-4 col-9"> 
                    <select class="form-control" name="result_status[]" id="result_status" required="" multiple>
                        <?php 
                            if(isset($questDetail->result_status)){
                                foreach(json_decode($questDetail->result_status) as $decodeData){
                                ?>
                                    <option value="<?= $decodeData ?>" selected="seelcted"><?= $decodeData ?></option>
                                <?php
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-2 col-3">  
                    <label> Result Status Value <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-4 col-9"> 
                    <select class="form-control" name="result_status_value[]" id="result_status_value" required="" multiple>
                        <?php 
                            if(isset($questDetail->result_status_value)){
                                foreach(json_decode($questDetail->result_status_value) as $decodeData){
                                ?>
                                    <option value="<?= $decodeData ?>" selected="seelcted"><?= $decodeData ?></option>
                                <?php
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>

            <?php
                if(isset($questDetail->result_description)){
                    foreach(json_decode($questDetail->result_description) as $k => $dd){
                        if($k == 0){
                        ?>
                            <div class="descData">
                        <?php
                        }else if($k == 1){
                            echo '<div class="moreDesc">';
                        }
            ?>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-2 col-3">  
                        <label> Result Description <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-sm-4 col-9"> 
                        <textarea class="form-control result_description" name="result_description[]" placeholder="Result Description" required=""><?= $dd ?></textarea>
                    </div>
                </div>
                        <?php if($k == 0){  ?>
                            </div>
            <?php
                        }else{
                            if(sizeof(json_decode($questDetail->result_description)) - 1 == $k){
                                echo "</div>";
                            }
                        }
                    }
                
            ?>
                <div class="form-group row addDescriptionData">
                    <div class="offset-sm-2 col-sm-2 col-3" onclick="addMoreData('moreDesc', 'descData')">  
                        <a href="javascript:void()">Add More Description </a>
                    </div>
                    <div class="offset-sm-2 col-sm-4 col-3" onclick="removeMoreData('moreDesc', 'descData')">  
                    <a href="javascript:void()">Remove More Description</a>
                    </div>
                </div>
            <?php } ?>



            <?php
                if (isset($questDetail->result_precaution)) {
                    foreach (json_decode($questDetail->result_precaution) as $k => $ddP) {
                        if($k == 0){
                            ?>
                                <div class="precautionData">
                            <?php
                            }else if($k == 1){
                                echo '<div class="morePrecaution">';
                            }
                   ?>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-2 col-3">  
                    <label> Result Precautions <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-4 col-9"> 
                    <textarea class="form-control result_precautions" name="result_precaution[]" placeholder="Result Precautions" required=""><?= $ddP ?></textarea>
                </div>
            </div>
            <?php if($k == 0){  ?>
                            </div>
            <?php
                        }else{
                            if(sizeof(json_decode($questDetail->result_precaution)) - 1 == $k){
                                echo "</div>";
                            }
                        }
                    }
                
            ?>
            <div class="form-group row addPrecautionsData">
                <div class="offset-sm-2 col-sm-2 col-3" onclick="addMoreData('morePrecaution', 'precautionData')">  
                    <a href="javascript:void()">Add More Precautions</a>
                </div>
                <div class="offset-sm-2 col-sm-4 col-3" onclick="removeMoreData('morePrecaution', 'precautionData')">  
                    <a href="javascript:void()">Remove More Precautions</a>
                </div>
            </div>
            <?php } ?>

            <?php 
                if(isset($questDetail->result_remedies)){
                    foreach (json_decode($questDetail->result_remedies) as $k => $ddR) {
                        if($k == 0){
                            ?>
                                <div class="ResultData">
                            <?php
                            }else if($k == 1){
                                echo '<div class="moreResult">';
                            }
            ?>

            <div class="form-group row">
                <div class="offset-sm-2 col-sm-2 col-3">  
                    <label> Result Remedies <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-4 col-9"> 
                    <textarea class="form-control result_remedies" name="result_remedies[]" placeholder="Result Remedies" required=""><?= $ddR ?></textarea>
                </div>
            </div>
            <?php if($k == 0){  ?>
                            </div>
            <?php
                        }else{
                            if(sizeof(json_decode($questDetail->result_precaution)) - 1 == $k){
                                echo "</div>";
                            }
                        }
                    }
               
            ?>
            <div class="form-group row addResultData">
                <div class="offset-sm-2 col-sm-2 col-3" onclick="addMoreData('moreResult', 'ResultData')">  
                    <a href="javascript:void()">Add More Remedies</a>
                </div>
                <div class="offset-sm-2 col-sm-4 col-3" onclick="removeMoreData('moreResult', 'ResultData')">  
                    <a href="javascript:void()"> Remove More Remedies</a>
                </div>
            </div>
                <?php } ?>

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
require('../../../layout/footer.php');
?>
<script src="../../js/select2.min.js"></script>
<script src="../../js/script.js" ></script>

<script src="../../js/bootstrap-slider.js" ></script>
<script>

    $('.body_part_id_symptom').select2({
        tags: true,
        templateResult: hideSelected,
        placeholder: "Select Body Part",
    });
    $('.body_part_id_symptom_id').select2({
        tags: true,
        templateResult: hideSelected,
        placeholder: "Select Symptom",
    });
    
        $("#ex18b").slider({
            min: 0,
            max: 10,
            value: [3, 6],
            labelledby: ['ex18-label-2a', 'ex18-label-2b']
        });
    function changeQuestion(id){
        $(".dropDQuestion"+id).show();
    }
</script>
<script>
    $('select[name="question_map_id[]"]').select2({
        tags: true,
        placeholder: "Select Question",
    });

    function addMoreData(appendDataClas, cloneClass){
        $("."+appendDataClas).append($("."+cloneClass).children().clone());
        //alert($("."+cloneClass).children().clone().html());
    }

    function removeMoreData(appendDataClas, cloneClass){
        $("."+appendDataClas).children().last().remove()
    }

    function removeQuestion(coun){        
        $(".currdentDelete"+coun).fadeOut();
        $(".currdentDelete"+coun).empty();
    }

    function showRelatedAnswer(id, anot){
        
        $.ajax({
            url : "question_list.php",
            data : { "ids" : $("."+id+" option:selected").val() },
            type: "POST",            
            success: function(data){
                $(".dropDQuestionss"+anot).empty();;
                $(".dropDQuestionss"+anot).html(data);
            },
            error: function(err){
                console.log(err);
            }
        })
    }
    
</script> 