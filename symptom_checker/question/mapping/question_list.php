<?php
/**
 * Created by Mohit.
 * User: FEMI
 * Date: 4/16/2020
 * Time: 12:14 PM
 */
//require_once("../../includes/initialize.php");
//require_once("../../TCPDF/tcpdf.php");

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
require_once("../../table/QuestionMappingTable.php");
require_once("../../table/QuestionTable.php");

$id = $_GET['question_id'];
$coum = $_GET['counter'];
$findSingleData = QuestionTable::find_question_by_id($id);
$allListQuestion = QuestionTable::find_all();


if (!empty($_POST['ids'])) {
    $findById = QuestionTable::find_by_id($_POST['ids']);
    $f = "";
    $decodeValue = json_decode($findById->answer_value);
    $f = "<center></div><div class='col-md-12'> Question:- ".$findById->question." <br>
    ";
    foreach (json_decode($findById->answer_label) as $k => $d) {
        $f .= "
        <label>".$d."  (". $decodeValue[$k] .")</label></br>
        ";
    }
    $f .= "</div> </center>";
    echo $f;
    exit();

}

//pre_d($findSingleData);die;
if(isset($findSingleData)){
?>
 <tr  class="currdentDelete<?= $coum ?>">
<link href="../../css/select2.min.css" rel="stylesheet" />
   
        
        <td>
            <div class="row"> 
                <div class="col-md-12">
                    <?= $findSingleData->question ?>
                </div>
            </div>
        </td>
        
        <td>
            <div class="row">
                <div class="col-md-4">
                <input type="hidden" name="question_id[]" value="<?= $id ?>"/>
                <?php  
                    $answervalue = json_decode($findSingleData->answer_value);
                    foreach( json_decode($findSingleData->answer_label) as $ke => $labelData){
                        $clicFun = "'{$labelData}'";
                        echo '<input type="'.$findSingleData->type.'" value="'.$labelData.'" name="another_question'.$coum.'[]" onclick="changeQuestion('.$id.')"/>'.$labelData. " &nbsp;&nbsp;&nbsp;($answervalue[$ke])"."<br>";
                    }
                ?>
                </div>
                <div class="col-md-5 dropDQuestions dropDQuestion<?= $id ?>" style="display: none;">
                <style>
                    .dropDQuestions .select2-container{
                        width: 80% !important;
                    }
                </style>
                <select placeholder="Name" name="question_map_id[]" class="question_id_list<?= $id ?> form-control" onChange="showRelatedAnswer('question_id_list<?= $id ?>', '<?= $id ?>')" style="display: none;">
                    <option value=""> -- Select Question -- </option>
                    <?php 
                        if(!empty($allListQuestion)){
                            foreach ($allListQuestion as $PartData) {
                                ?>
                                    <option value="<?php echo $PartData->id; ?>"><?php echo $PartData->question; ?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
                </div>
                <div class="col-md-3">
                        <a href="javascript:void(0)" style="cursor:pointer;" onclick="removeQuestion('<?= $coum ?>')"><i class="fa fa-trash"></i></a>
                </div>
                <div class="col-md-12 dropDQuestionss<?= $id ?>">
                </div>
            </div>
            
        </td>
<?php
}else{
?>


<?php
}
?>
<script src="../../js/select2.min.js"></script>
<script>
    $('select[name="question_map_id[]"]').select2({
        tags: true,
        placeholder: "Select Question",
    });

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

</tr>