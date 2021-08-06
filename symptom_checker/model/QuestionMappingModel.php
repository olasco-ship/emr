<?php 

require_once("../../includes/config.php");
require_once("../../includes/functions.php");
require_once("../../includes/session.php");
require_once("../../includes/database.php");
require_once("../../includes/database_object.php");


require_once("../table/QuestionMappingTable.php");

class QuestionMappingModel{
    
    //Save and update Symptom
    public function postDataSave($postdata)
    {
        $sortQuestion = asort($postdata['body_part_id']);
        foreach($postdata['body_part_id'] as $d){
            $sortQuestion[] = $d;
        }


        $existQuestion = [];
        for($i=0; $i<=100; $i++){
            if (array_key_exists("another_question".$i,$postdata))
            {
                $existQuestion[] = $i;
            }
        }
        $mergeData = [];
        for($b = 0; $b <= sizeof($existQuestion); $b++){
            if(array_key_exists('another_question'.$b, $postdata)){
                $mergeData[] = $postdata['another_question'.$b];
            }
            
            
        }

        $result=[];
        foreach($mergeData as $array){
            $result = array_merge($result, $array);
        }
        
        
        $question_part = new QuestionMappingTable();        
        $question_part->gender = $postdata['gender'];
        $question_part->age_group_to = $postdata['age_group_to'];
        $question_part->age_group_from = $postdata['age_group_from'];
        $question_part->body_part_id = json_encode($postdata['body_part_id']);
        $question_part->body_part_id_symptom_id = json_encode($postdata['body_part_id_symptom_id']);
        $question_part->section_name = $postdata['section_name'];
        $question_part->question_id = json_encode($postdata['question_id']);
        $question_part->another_question = json_encode($result);
        $question_part->question_map_id = json_encode($postdata['question_map_id']);
        $question_part->result_status = json_encode($postdata['result_status']);
        $question_part->result_status_value = json_encode($postdata['result_status_value']);
        $question_part->result_description = json_encode($postdata['result_description']);
        $question_part->result_precaution = json_encode($postdata['result_precaution']);
        $question_part->result_remedies = json_encode($postdata['result_remedies']);
        //pre_d($question_part);die;
        if(!empty($postdata['id'])){
            $question_part->status = 1;
            //$question_part->created = date("Y-m-d H:i:s");
            $question_part->id = $postdata['id'];
            return $question_part->save();
        }else{
            $question_part->status = 1;
            $question_part->created = date("Y-m-d H:i:s");
            //pre_d($question_part);die;
            return $question_part->create();    
        }       
    }

    //Delete Symptom
    public function deletSymptom($id)
    {
        $body_part = new QuestionMappingTable();
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
                "message" => "Not Delete or already used question",
                'data' => 0
            ];
            return $dat;
            
        }
    }
}

$symptom = new QuestionMappingModel();

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

//Save Symptom
if (isset($_POST)) {
    $a = $symptom->postDataSave($_POST);

   
    /*
        $res = [
            'status' => true,
            'message' => "Successfull Save Bopdy Part",
            'data' => 1
        ];
        return json_decode($res);
         exit();
    */
    $session->message("Question has been save.");
    redirect_to('../question/mapping/index.php');
}



?>