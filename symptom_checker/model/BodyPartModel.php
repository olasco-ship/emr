<?php
require_once("../../includes/config.php");
require_once("../../includes/functions.php");
require_once("../../includes/session.php");
require_once("../../includes/database.php");
require_once("../../includes/database_object.php");
require_once("../table/BodyPart.php");
require_once("../table/Symptom.php");
class BodyPartModel{
    
    //Save and update body part
    public function postDataSave($postdata)
    {
        $body_part = new BodyPart();
        $body_part->name = $postdata['name'];
        if(!empty($postdata['id'])){
            $body_part->id = $postdata['id'];
            return $body_part->save();
        }else{
            $body_part->status = 1;
            $body_part->created = date("Y-m-d H:i:s");
            return $body_part->create();    
        }       
    }

    //Delete Body Part
    public function deletBodypart($id)
    {
        $body_part = new BodyPart();
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
                "message" => "Not Delete or already used body part",
                'data' => 0
            ];
            return $dat;
            
        }
    }


    //Show listing
    public function symptomAccordingToBodyPart($body_id)
    {
        $listing = Symptom::find_by_body_part_id($body_id);
        if(!empty($listing)){
            // $re = [
            //     'status' => true,
            //     "message" => "Success",
            //     "data" => $listing
            // ];
            // return json_encode($re);
            $opt = "<option value=''>-- Select Symptom --</option>";
            foreach($listing as $da){
                $opt .= "<option value='".$da->id."'>".$da->name."</option>";
            }
            return $opt;
        }else{
            // $re = [
            //     'status' => false,
            //     "message" => "No data found",
            //     "data" => $listing
            // ];
            // return json_encode($re);
            $opt = "<option value=''>-- No Record Found --</option>";
            return $opt;
        }
    }
}

$bodyParty = new BodyPartModel();

//Delete Body Part
if(isset($_GET['id'])){
    $res = $bodyParty->deletBodypart($_GET['id']);
    
    if($res['status'] == 1){
        $session->message("Body Part has been delete.");
        echo json_decode($res);   
        exit();
    }else{
        $session->message("Body Part already used.");
        echo json_decode($res);
        exit();
    }
}

//Show Listing accroding to body part
if(isset($_GET['body_part_id'])){
    $res = $bodyParty->symptomAccordingToBodyPart($_GET['body_part_id']);
    echo ($res);
    exit();
}

//Save Body part
if (isset($_POST)) {
    $bodyParty->postDataSave($_POST);
    /*
        $res = [
            'status' => true,
            'message' => "Successfull Save Bopdy Part",
            'data' => 1
        ];
        return json_decode($res);
         exit();
    */
    $session->message("Body Part has been created.");
    redirect_to('../body_part/index.php');
}



?>