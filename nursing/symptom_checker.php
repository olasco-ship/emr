<div class="row clearfix">
<?php
require_once("../symptom_checker/table/Symptom.php");
require_once("../symptom_checker/table/BodyPart.php");


require_once("../symptom_checker/table/QuestionTable.php");
require_once("../symptom_checker/table/SymptomAnswerTable.php");


$allBodyPart = BodyPart::find_all();
$sql  = "SELECT * FROM patients ORDER BY last_name  ";
$patients = Patient::find_by_sql($sql);

?>
<link href="../symptom_checker/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../symptom_checker/style.css">

 

<div class="container-fluid">
    
    <div class="stepper-form">
        <div class="container">
        
            <form id="regForm" action="">
               
                <!-- <div class="tab min-hight" id="serviceTerm">
                    <div class="stepper-containt">
                        <h3>Hello!</h3>
                        <p>You’re about to use a short (3 min), safe and anonymous health checkup. Your answers will be carefully analyzed and you’ll learn about possible causes of your symptoms.</p>
                    </div>
                    <div class="stepper-img">
                        <img src="../symptom_checker/images/cust-service.png" class="img-responsive">
                    </div>
                </div>

                <div class="tab min-hight" id="genderSlectedNext">
                    <div class="stepper-containt">
                        <h3>Terms of Service</h3>
                        <p>Before using the checkup, please read Terms of Service. Remember that:</p>
                        <ul class="stepper-ul">
                            <li><b><i class="fa fa-caret-right" aria-hidden="true"></i> Checkup is not a diagnosis.</b> Checkup is for informational purposes and is not a qualified medical opinion.</li>
                            <li><b><i class="fa fa-caret-right" aria-hidden="true"></i> Do not use in emergencies.</b> In case of health emergency, call your local emergency number immediately.</li>
                            <li><b><i class="fa fa-caret-right" aria-hidden="true"></i> Your data is safe.</b> Information that you provide is anonymous and not shared with anyone.</li>
                        </ul>
                        <p>
                            <input type="checkbox" id="terms" name="terms" required> I read and accept <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</p>
                    </div>
                    <div class="stepper-img">
                        <img src="../symptom_checker/images/terms-services.png" class="img-responsive">
                    </div>

                </div> -->
               
                 <div class="tab min-hight" id="symptomStart">
                    <div class="stepper-containt">
                        <h3>Add your symptoms!</h3>
                        <p>Please use the search or click on the body model.</p>

                        
                        <div class="col-sm-4 col-9"> 
                            <select class="form-control body_part_id_question" multiple>
                                <option value=""> -- select body part -- </option>
                                <?php 
                                    if(!empty($allBodyPart)){
                                        foreach ($allBodyPart as $partdata) {
                                            ?>
                                                    <option value="<?php echo $partdata->id; ?>"><?php echo $partdata->name; ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-4 col-9">
                            <select class="form-control body_part_id_symptom_id" multiple>
                                <option value=""> -- Select Body Part -- </option>
                            </select>
                        </div>
                        <input type="hidden" name="user_id" class="user_id" value="<?php echo $patient->id; ?>"/>
                        <input type="hidden" name="gender" class="gender" value="<?php echo strtolower($patient->gender); ?>"/>
                        <input type="hidden" name="age" class="age" value="<?php echo $diff; ?>"/>
                    </div>
                </div>
                <!--  -->

                <div class="next-btn" style="overflow:auto;">
                    <div style="float:right;">
                        <button type="button" id="prevBtn" onclick="nextPrev(-1, 0)">Previous</button>
                        <button type="button" id="nextBtn" onclick="nextPrev(1, 0)">Next</button>
                    </div>
                </div>
                <input type="hidden" name="questionId" id="questionId"/>
                <input type="hidden" name="totalQuestion" id="totalQuestion"/>
                <input type="hidden" name="currentQuestion" id="currentQuestion"/>
            </form>
        </div>
    </div>
</div>
</div>


<!--
        Result Start
-->
<div class="blockResult">
            <div class="tabs min-hight resultDataShow" style="display:none;">
                    
                    <div class="result-img">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="result-containt">
                        <h3>Result Status</h3>
                        <p class="symptomStatus"></p>
                        
                    </div>
        
                    <div class="result-view">
                        <div class="result-more">
                            <h3>Results Precaution</h3>
                            <p class="symptomPrecaution"></p>
                        </div>
                    </div>

                    <div class="result-view">
                        <div class="result-more">
                            <h3>Result Remedies</h3>
                            <p class="symptomRemedies"></p>
                        </div>
                    </div>

                   <div class="result-view">
                        <div class="result-more">
                            <h3>Result Description</h3>
                            <p class="symptomDecription"></p>
                            
                        </div>
                    </div>

                    <div class="result-view">
                        <div class="result-more">
                        
                            <p>Please note that the information provided by this tool is provided solely for educational purposes and is not a qualified medical opinion. This information should not be considered advice or an opinion of a doctor or other health professional about your actual medical state, and you should see a doctor for any symptoms you may have. If you are experiencing a health emergency, you should call your local emergency number immediately to request emergency medical assistance.</p>
                            
                        </div>
                    </div>


                </div>

                                
<!--
        Result End
-->
 
</div>