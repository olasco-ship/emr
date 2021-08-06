<?php 

require_once("../../includes/config.php");
require_once("../../includes/functions.php");
require_once("../../includes/session.php");
require_once("../../includes/database.php");
require_once("../../includes/database_object.php");

require_once("../table/Symptom.php");

class SymptomModel{
    
    //Save and update Symptom
    public function postDataSave($postdata)
    {
        $body_part = new Symptom();
        $body_part->name = $postdata['name'];
        $body_part->body_part_id = $postdata['body_part_id'];
        $body_part->body_part_name = $postdata['body_part_name'];
        //pre_d($body_part);die;
        if(!empty($postdata['id'])){
            $body_part->id = $postdata['id'];
            return $body_part->save();
        }else{
            $body_part->status = 1;
            $body_part->created = date("Y-m-d H:i:s");
            return $body_part->create();    
        }       
    }

    //Delete Symptom
    public function deletSymptom($id)
    {
        $body_part = new Symptom();
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


    public function findByBodyType($id)
    {
        $ids = "";
        if(sizeof($id) == 0){
            $ids = $id[0];
        }else{
            $ids = implode(",", $id);
        }
        
        $body_part = Symptom::find_by_body_part_id_multiple($ids);
        if(!empty($body_part)){
            $dat = [
                "status" => "true",
                "message" => "Successfull found symptom detail",
                'data' => $body_part
            ];
            return $dat;
        }else{
            $dat = [
                "status" => "false",
                "message" => "Not found symptom detail",
                'data' => 0
            ];
            return $dat;
        }
    }
}

$symptom = new SymptomModel();

//Delete Symptom
if(isset($_GET['id'])){
    $res = $symptom->deletSymptom($_GET['id']);
    
    if($res['status'] == 1){
        $session->message("Symptom has been delete.");
        echo json_decode($res);   
        exit();
    }else{
        $session->message("Symptom already used.");
        echo json_decode($res);
        exit();
    }
}

//Find Symptom by body type
if(isset($_GET['body_part_id'])){
    
    $res = $symptom->findByBodyType($_GET['body_part_id']);    
    if($res['status'] == true){
        //echo json_decode($res);   
        $opt = "";
        foreach($res['data'] as $da){
            $opt .= "<option value='".$da->id."'> ".$da->name." </option>";
        }
        echo $opt;
        exit();
    }else{
        //echo json_decode($res);
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
    $session->message("Symptom has been created.");
    redirect_to('../symptom/index.php');
}



?>