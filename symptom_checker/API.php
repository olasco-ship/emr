<?php 

require_once("../includes/config.php");
require_once("../includes/functions.php");
require_once("../includes/session.php");
require_once("../includes/database.php");
require_once("../includes/database_object.php");

require_once("table/Symptom.php");
require_once("table/BodyPart.php");


class API {
    
    public function delete($data, $type)
    {
        require_once("model/BodyPartModel.php");
        require_once("model/SymptomModel.php");
        if($type == "body"){
            BodyPartModel::deletBodypart($data);
        }else{
            SymptomModel::deletSymptom($data);
        }
    }

    public function save($data, $type)
    {
        require_once("model/BodyPartModel.php");
        require_once("model/SymptomModel.php");
        if($type == "body"){
            BodyPartModel::postDataSave($data);
        }else{
            SymptomModel::postDataSave($data);
        }
    }

    //First Question attemptd
    public function checkQuestion($postData)
    {
        require_once("table/QuestionMappingTable.php");     
        $body_part_id = json_encode($postData['body_part_id']);   
        $symptom_id = json_encode($postData['symptom_id']);   
        $age = json_encode($postData['age']);   
        $gender = json_encode($postData['gender']);   
        $firstQuestion = QuestionMappingTable::find_question_first($body_part_id, $symptom_id, $age, $gender);
        
        if(!empty($firstQuestion)){
            $res = [
                "status" => true,
                "message" => "Successfull found data",
                "data" => $firstQuestion
            ];
            return json_encode($res); exit();
        }else{
            $res = [
                "status" => false,
                "message" => "No data found",
                "data" => []
            ];
            return json_encode($res);
        }
    }


    //Initiate Question
    public function initiateQiestion($getQuestion)
    {
        require_once("table/QuestionTable.php");       
        $decodeQuestionId = $getQuestion['question'];
        $body_part_id = json_encode($postData['body_part_id']);   
        $symptom_id = json_encode($postData['symptom_id']);   
        $firstQuestionInitate = QuestionTable::find_by_id_question($body_part_id[0], $symptom_id[0], $decodeQuestionId);
        if($firstQuestionInitate){
            $res = [
                "status" => true,
                "message" => "Successfull found data",
                "data" => $firstQuestionInitate
            ];
            return json_encode($res);
        }else{
            $res = [
                "status" => false,
                "message" => "No data found",
                "data" => []
            ];
            return json_encode($res);
        }
    }
    
    //questionListing Question
    public function questionListing($getQuestion)
    {
        require_once("table/QuestionTable.php");       
        $decodeQuestionId = $getQuestion['question'];
        $firstQuestionInitate = QuestionTable::find_by_id($decodeQuestionId);
        if($firstQuestionInitate){
            $res = [
                "status" => true,
                "message" => "Successfull found data",
                "data" => $firstQuestionInitate
            ];
            return json_encode($res);
        }else{
            $res = [
                "status" => false,
                "message" => "No data found",
                "data" => []
            ];
            return json_encode($res);
        }
    }


    //Save symptom question
    public function saveQuestion($postSave)
    {
        require_once("table/SymptomAnswerTable.php");
        
        $saveQuestion = new SymptomAnswerTable();
        $saveQuestion->question_id = $postSave['question_id'];
        $saveQuestion->answer = json_encode($postSave['optionValue']);
        $saveQuestion->status = 1;
        $saveQuestion->symptom_check_status = 1;
        $saveQuestion->user_id = $postSave['user_id'];
        $saveQuestion->gender = $postSave['gender'];
        $saveQuestion->created = date("Y-m-d H:i:s");
        if($saveQuestion->save()){
            $res = [
                "status" => true,
                "message" => "Successfull save data",
                "data" => $saveQuestion
            ];
            return json_encode($res);
        }else{
            $res = [
                "status" => true,
                "message" => "Not Successfull save data",
                "data" => []
            ];
            return json_encode($res);
        }
    }


    //Resuolt Show API
    public function resultShow($postData)
    {
        require_once("table/SymptomAnswerTable.php");   
        require_once("table/SymptomResultTable.php");   
        require_once("table/QuestionTable.php");   
        require_once("table/QuestionMappingTable.php");   

        $decodeQuestionId = $postData['user_id'];
        $questionResultDataFound = SymptomAnswerTable::find_by_user_id($decodeQuestionId);
        $minMarks = 0;
        $maxMarks = 0;
        $resultStatus = "";
        $resultStatusValue = "";
        $resultDescription = "";
        $resultPrecaution = "";
        $resultRemedies = "";
        $mapQustinCount = "";
        $QustinCount = "";

        $obtainmarks = 0;
        $userId = 0;
        
        foreach($questionResultDataFound as $answerData){
            $userId = $answerData->user_id;
            $calculateAnswer = QuestionTable::find_by_id($answerData->question_id);
            $minMarks += $calculateAnswer->minimum_marks;
            $maxMarks += $calculateAnswer->total_marks;
            $answerDetail = json_decode($answerData->answer);
            foreach($answerDetail as $obt){
                $obtainmarks += $obt;
            }
            $body_part_id = json_encode($postData['body_part_id']);   
            $symptom_id = json_encode($postData['symptom_id']);   
            $mapQuestTableData = QuestionMappingTable::find_by_conditions($postData['gender'], $body_part_id, $symptom_id);
            $resultStatusValue = json_decode($mapQuestTableData->result_status_value);
            $resultStatus = json_decode($mapQuestTableData->result_status);
            $resultDescription = json_decode($mapQuestTableData->result_description);
            $resultPrecaution = json_decode($mapQuestTableData->result_precaution);
            $resultRemedies = json_decode($mapQuestTableData->result_remedies);
            
        }

        
        
        foreach ($questionResultDataFound as $answerData) {
            $answerData->symptom_check_status =  0;
            $answerData->save();
        }

        

        foreach($resultStatusValue as $ke => $statusdata){
            //echo $obtainmarks;
            //pre_d($statusdata);

            
            // $symptomResult = new SymptomResultTable();
            // $symptomResult->user_id = $userId;
            // $symptomResult->result_status = $resultStatus[$ke];
            // $symptomResult->result_des;c = $resultDescription[$ke];
            // $symptomResult->result_precau = $resultPrecaution[$ke];
            // $symptomResult->result_remedies = $resultRemedies[$ke];
            // $symptomResult->status = 1;
            // $symptomResult->created = date("Y-m-d");
            // $symptomResult->create();

            if ($ke == 0) {
                
                if ($obtainmarks <= $statusdata) {
                    $dataResultSend = [
                            "status" => true,
                            "message" => "Success Get result",
                            "data" => [
                                'status' => $resultStatus[$ke],
                                "dscription" => $resultDescription[$ke],
                                "precaution" => $resultPrecaution[$ke],
                                "remedies" => $resultRemedies[$ke],
                                
                            ]
                        ];
                        $this->symptomResultSave($userId,$resultStatus[$ke],$resultDescription[$ke],$resultPrecaution[$ke],$resultRemedies[$ke]);
                    return json_encode($dataResultSend);
                    break;  
                }
            }else  if($obtainmarks <= $statusdata && $obtainmarks > $resultStatusValue[$ke - 1]){
                
                $dataResultSend = [
                    "status" => true,
                    "message" => "Success Get result",
                    "data" => [
                        'status' => $resultStatus[$ke],
                        "dscription" => $resultDescription[$ke],
                        "precaution" => $resultPrecaution[$ke],
                        "remedies" => $resultRemedies[$ke],
                        
                    ]
                ];
                $this->symptomResultSave($userId,$resultStatus[$ke],$resultDescription[$ke],$resultPrecaution[$ke],$resultRemedies[$ke]);
                return json_encode($dataResultSend);
                break;  
            } else if(end(array_keys($resultStatusValue)) == $ke){
                
                if ($obtainmarks >= $statusdata) {
                    $dataResultSend = [
                        "status" => true,
                        "message" => "Success Get result",
                        "data" => [
                            'status' => $resultStatus[$ke],
                            "dscription" => $resultDescription[$ke],
                            "precaution" => $resultPrecaution[$ke],
                            "remedies" => $resultRemedies[$ke],
                           
                        ]
                    ];
                    $this->symptomResultSave($userId,$resultStatus[$ke],$resultDescription[$ke],$resultPrecaution[$ke],$resultRemedies[$ke]);
                    return json_encode($dataResultSend);
                    break;  
                }
            }
        }
        //die;
    }

    public function symptomResultSave($userId,$resultStatus,$resultDescription,$resultPrecaution,$resultRemedies)
    {
        $symptomResult = new SymptomResultTable();
            $symptomResult->user_id = $userId;
            $symptomResult->result_status = $resultStatus;
            $symptomResult->result_desc = $resultDescription;
            $symptomResult->result_precau = $resultPrecaution;
            $symptomResult->result_remedies = $resultRemedies;
            $symptomResult->status = 1;
            $symptomResult->created = date("Y-m-d");
            $symptomResult->create();
    }
}


$api = new API();

// Delete Api
if(isset($_GET['body_part'])){
    $api->delete($_GET, "body");
}else if(isset($_GET['symptom'])){
    $api->delete($_GET, "symptom");
}

//Question initiate
if(isset($_GET['initiate']) && $_GET['initiate'] == "questionStart"){
    echo $api->initiateQiestion($_GET);
    exit();
}

//Question questionListing
if(isset($_GET['initiate']) && $_GET['initiate'] == "questionListing"){
    echo $api->questionListing($_GET);
    exit();
}


//Save API
if(isset($_POST['body_part'])){
    $api->save($_POST, "body");
}else if(isset($_POST['symptom'])){
    $api->save($_POST, "symptom");
}


if(isset($_POST['method']) && $_POST['method'] == "checkQuestion"){
    echo $api->checkQuestion($_POST);
    exit();
}

if(isset($_POST['method']) && $_POST['method'] == "save"){
    echo $api->saveQuestion($_POST);
    exit();
}

//Show Result API

if(isset($_POST['method']) && $_POST['method'] == "Result"){
    echo $api->resultShow($_POST);
    exit();
}

?>