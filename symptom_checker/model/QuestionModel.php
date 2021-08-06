<?php 

require_once("../../includes/config.php");
require_once("../../includes/functions.php");
require_once("../../includes/session.php");
require_once("../../includes/database.php");
require_once("../../includes/database_object.php");

require_once("../table/Symptom.php");
require_once("../table/QuestionTable.php");

class QuestionModel{
    
    //Save and update Symptom
    public function postDataSave($postdata)
    {
        $question_part = new QuestionTable();
        // $question_part->body_part_id = $postdata['body_part_id'];
        // $question_part->body_part_symptom_id = $postdata['body_part_symptom_id'];
        $answerLabel = [];
        $answerValue = [];
        foreach($postdata['answer_label'] as $d){
            if($d){
                $arr_parts = explode("-",$d);
                $answerLabel[] = $arr_parts[0];
                $answerValue[] = $arr_parts[1];
            }
        }
        
        $question_part->gender = $postdata['gender'];
        $question_part->question = $postdata['question'];
        $question_part->type = $postdata['type'];
        $question_part->total_marks = $postdata['total_marks'];
        $question_part->minimum_marks = $postdata['minimum_marks'];
        $question_part->answer_label = json_encode($answerLabel);
        $question_part->answer_value = json_encode($answerValue);
        $question_part->options = json_encode($postdata['answer_label']);
        // $question_part->answer_label = json_encode($postdata['answer_label']);
        // $question_part->answer_value = json_encode($postdata['answer_value']);
        //pre_d($question_part);die;
        if(!empty($postdata['id'])){
            $question_part->status = 1;
            $question_part->created = date("Y-m-d H:i:s");
            $question_part->id = $postdata['id'];
            return $question_part->save();
        }else{
            $question_part->status = 1;
            $question_part->created = date("Y-m-d H:i:s");
            return $question_part->create();    
        }       
    }

    //Delete Symptom
    public function deletSymptom($id)
    {
        $body_part = new QuestionTable();
        $body_part->id = $id;
       
        if($body_part->deleteBody()){
            $dat = [
                "status" => true,
                "message" => "Successfull Delete",
                'data' => 1
            ];
            return $dat;
            
            
        }else{
            $dat = [
                "status" => false,
                "message" => "Not Delete or already used symptom",
                'data' => 0
            ];
            return $dat;
            
        }
    }


    //For get single question detail for mapping
    public function QuestionDetail($id)
    {
        $ids = "";
        if(sizeof($id) == 0){
            $ids = $id[0];
        }else{
            $ids = implode(",", $id);
        }
        $findSingleData = QuestionTable::find_by_body_part_id_multiple_map($ids);
        
        if(!empty($findSingleData)){
            $dat = [
                "status" => "true",
                "message" => "Successfull found question detail",
                'data' => $findSingleData
            ];
            return $dat;
        }else{
            $dat = [
                "status" => "false",
                "message" => "Not found question detail",
                'data' => 0
            ];
            return $dat;
        }
    }
}

$symptom = new QuestionModel();

//Delete Symptom
if(isset($_GET['id'])){
    $res = $symptom->deletSymptom($_GET['id']);
    
    if($res['status'] == 1){
        $session->message("Question has been delete.");
        echo json_decode($res);   
        exit();
    }else{
        $session->message("Question already used.");
        echo json_decode($res);
        exit();
    }
}

//Get single question detail by ajax
if(isset($_GET['q'])){
    $res = $symptom->QuestionDetail($_GET['q']);    
    if($res['status'] == 1){
        echo json_encode($res);   
        exit();
    }else{        
        echo json_encode($res);
        exit();
    }
}

//Save Symptom
if (isset($_POST)) {
    $symptom->postDataSave($_POST);
    /*
        $res = [
            'status' => true,
            'message' => "Successfull Save Bopdy Part",
            'data' => 1
        ];
        return json_decode($res);
         exit();
    */
    $session->message("Question has been created.");
    redirect_to('../question/index.php');
}



?>