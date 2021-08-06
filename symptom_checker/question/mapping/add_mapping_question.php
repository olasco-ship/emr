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
require('../../../layout/header.php');

$allBodyPart = BodyPart::find_all();

$allQuestion = QuestionTable::find_all();
?>
<link href="../../css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="../../css/bootstrap-slider.css"/>
<style>
#front-end-gurus-menu *{box-sizing: content-box;}
* { font-family: 'Lato', sans-serif; font-weight:300; }

h1 { color:#fff; }
#slider5a .slider-track-high, #slider5c .slider-track-high {
	background: green;
}

#slider5b .slider-track-low, #slider5c .slider-track-low {
	background: red;
}

#slider5c .slider-selection {
	background: yellow;
}
</style>
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

                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-2 col-3">  
                            <label> Gender <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-4 col-9"> 
                            <input type="radio" value="male" name="gender" required/> Male
                            <input type="radio" value="female" name="gender" required/> Female
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-2 col-3">  
                            <label> Age Group (Year) <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-2 col-9"> 
                            <input type="number" class="form-control age_range_to" name="age_group_to" placeholder="Age Range To" required/>
                        </div>
                        <div class="col-sm-2 col-9"> 
                            <input type="number" class="form-control age_range_from" name="age_group_from" placeholder="Age Range From" required/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-2 col-3">  
                            <label> Section Name <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-4 col-9"> 
                            <textarea class="form-control section_name" name="section_name" placeholder="Section Name" required=""></textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-2 col-3">  
                            <label> Select Body Part <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-4 col-9"> 
                            <select class="form-control body_part_id_symptom" placeholder="Name" name="body_part_id[]" required="" multiple  >
                                <?php 
                                    if(!empty($allBodyPart)){
                                        foreach ($allBodyPart as $PartData) {
                                            ?>
                                                    <option value="<?php echo $PartData->id; ?>"><?php echo $PartData->name; ?></option>
                                <?php
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
                            <select class="form-control" placeholder="Name"  id="question_id" required="">
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
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-2 col-3">  
                            <label> Result Status Label <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-4 col-9"> 
                            <select class="form-control" name="result_status[]" id="result_status" required="" multiple>
                                <option value=""> -- Select Status -- </option>
                                <option>

                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-2 col-3">  
                            <label> Result Status Value <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-4 col-9"> 
                            <select class="form-control" name="result_status_value[]" id="result_status_value" required="" multiple>
                                <option value=""> -- Select Status Value -- </option>
                                <option>

                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="descData">
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-2 col-3">  
                            <label> Result Description <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-4 col-9"> 
                            <textarea class="form-control result_description" name="result_description[]" placeholder="Result Description" required=""></textarea>
                        </div>
                    </div>
                    </div>
                    <div class="form-group row addDescriptionData">
                        <div class="offset-sm-2 col-sm-2 col-3" onclick="addMoreData('moreDesc', 'descData')">  
                            <a href="javascript:void()">Add More Description </a>
                        </div>
                        <div class="offset-sm-2 col-sm-4 col-3" onclick="removeMoreData('moreDesc', 'descData')">  
                        <a href="javascript:void()">Remove More Description</a>
                        </div>
                    </div>
                    <div class="moreDesc"></div>

                    <div class="precautionData">
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-2 col-3">  
                                <label> Result Precautions <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-4 col-9"> 
                                <textarea class="form-control result_precautions" name="result_precaution[]" placeholder="Result Precautions" required=""></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row addPrecautionsData">
                        <div class="offset-sm-2 col-sm-2 col-3" onclick="addMoreData('morePrecaution', 'precautionData')">  
                            <a href="javascript:void()">Add More Precautions</a>
                        </div>
                        <div class="offset-sm-2 col-sm-4 col-3" onclick="removeMoreData('morePrecaution', 'precautionData')">  
                            <a href="javascript:void()">Remove More Precautions</a>
                        </div>
                    </div>
                    <div class="morePrecaution"></div>

                    
                    <div class="ResultData">
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-2 col-3">  
                                <label> Result Remedies <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-4 col-9"> 
                                <textarea class="form-control result_remedies" name="result_remedies[]" placeholder="Result Remedies" required=""></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row addResultData">
                        <div class="offset-sm-2 col-sm-2 col-3" onclick="addMoreData('moreResult', 'ResultData')">  
                            <a href="javascript:void()">Add More Remedies</a>
                        </div>
                        <div class="offset-sm-2 col-sm-4 col-3" onclick="removeMoreData('moreResult', 'ResultData')">  
                            <a href="javascript:void()"> Remove More Remedies</a>
                        </div>
                    </div>
                    <div class="moreResult"></div>

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

    function addMoreData(appendDataClas, cloneClass){
        $("."+appendDataClas).append($("."+cloneClass).children().clone());
    }

    function removeMoreData(appendDataClas, cloneClass){
        $("."+appendDataClas).children().last().remove()
    }
    
</script>