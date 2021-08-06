<?php
require_once("../includes/config.php");
require_once("../includes/functions.php");
require_once("../includes/session.php");
require_once("../includes/database.php");
require_once("../includes/database_object.php");
require_once("../includes/waiting_list.php");
require_once("../includes/patient.php");
require_once("../includes/refer_admission.php");
require_once("../includes/user.php");


require_once("../includes/revenueHead.php");

require_once("table/Symptom.php");
require_once("table/BodyPart.php");


require_once("table/QuestionTable.php");
require_once("table/SymptomAnswerTable.php");
require_once("table/SymptomResultTable.php");
require('../layout/header.php');

$allBodyPart = BodyPart::find_all();
$sql  = "SELECT * FROM patients ORDER BY last_name  ";
$patients = Patient::find_by_sql($sql);

?>
<link href="css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">


<div id="main-content">
<div class="container-fluid">
    <?php include "../layout/header_chart.php"; ?>

    <div class="stepper-form">
        <div class="container">
        
            <form id="regForm" action="">
                <!-- <div class="mb-30 text-center">
                    <span class="step">1</span>
                    <span class="step">2</span>
                    <span class="step">3</span>
                    <span class="step">4</span>
                    <span class="step">5</span>
                    <span class="step">6</span>
                    <span class="step">7</span>
                    <span class="step">8</span>
                    <span class="step">9</span>
                    <span class="step">10</span>
                    <span class="step">11</span>
                </div> -->
                
                <div class="tab min-hight" id="serviceTerm">
                    <div class="stepper-containt">
                        <h3>Hello!</h3>
                        <p>You’re about to use a short (3 min), safe and anonymous health checkup. Your answers will be carefully analyzed and you’ll learn about possible causes of your symptoms.</p>
                    </div>
                    <div class="stepper-img">
                        <img src="images/cust-service.png" class="img-responsive">
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
                        <img src="images/terms-services.png" class="img-responsive">
                    </div>

                </div>
                <div class="tab min-hight" >
                    <div class="stepper-gander">
                        <h3 class="text-center">Please Select Your Sex</h3>
                        <!-- <div class="female-icons"><i class="fa fa-female"></i>
                                 <input type='radio' id='male' checked='checked' name='radio'>
                            <label for='male'>Male</label>
                            </div>
                        <div class="female-icons"><i class="fa fa-male"></i>
                            <input type="radio" class="control-input" name="gender" value="male"><span>Male</span></div> -->
                             <div class="cc-selector">
                                <div class="selector-half">
                                    <input id="male" name="gender" type="radio" value="male" class="gender"/>
                                    <label class="drinkcard-cc visa" for="male"><i class="fa fa-male"></i><span>Male</span></label>
                                </div>
                                <div class="selector-half">
                                <input id="female" name="gender" type="radio" value="female" class="gender"/>
                                <label class="drinkcard-cc mastercard" for="female"><i class="fa fa-female"></i><span>Female</span></label>
                            </div>
                            </div>

                    </div>

                </div>
                <div class="tab min-hight" >
                    <div class="stepper-gander">
                        <h3 class="text-center">Please Select Your Age</h3>
                        <input class="slider" value="20" min="0" max="100" name="rangeslider" type="range" />
                    </div>
                </div>
                <!-- <div class="tab min-hight" id="normalQuestion">
                    <div class="stepper-gander">
                        <h3 class="text-center">Please check all the statements below that apply to you</h3>
                        <p class="text-center">Select one answer in each row.</p>

                        <table>

                            <tr>
                                <td>I'm overweight or obese</td>
                                <td>
                                    <input type="radio" name="overweight" class="overweight" value="yes"  onclick="normalQuestionSubmitDisable('overweight')" /> Yes</td>
                                <td>
                                    <input type="radio" name="overweight" class="overweight" value="no"  onclick="normalQuestionSubmitDisable('overweight')" /> No</td>
                                <td>
                                    <input type="radio" name="overweight" class="overweight" value="dont_know"  onclick="normalQuestionSubmitDisable('overweight')" /> Don't Know</td>
                            </tr>
                            <tr>

                                <td>SI smoke cigarettes</td>
                                <td>
                                    <input type="radio" name="cigrattes" class="cigrattes" value="yes" data-col="2"  onclick="normalQuestionSubmitDisable('cigrattes')"/> Yes</td>
                                <td>
                                    <input type="radio" name="cigrattes" class="cigrattes" value="no" data-col="2"  onclick="normalQuestionSubmitDisable('cigrattes')"/> No</td>
                                <td>
                                    <input type="radio" name="cigrattes" class="cigrattes" value="dont_know" data-col="2"  onclick="normalQuestionSubmitDisable('cigrattes')"/> Don't Know</td>
                            </tr>

                            <tr>
                                <td>I’ve been recently injured</td>
                                <td>
                                    <input type="radio" name="injured" class="injured" value="yes" data-col="3"  onclick="normalQuestionSubmitDisable('injured')"/> Yes</td>
                                <td>
                                    <input type="radio" name="injured" class="injured" value="no" data-col="3"  onclick="normalQuestionSubmitDisable('injured')"/> No</td>
                                <td>
                                    <input type="radio" name="injured" class="injured" value="dont_know" data-col="3"  onclick="normalQuestionSubmitDisable('injured')"/> Don't Know</td>
                            </tr>

                            <tr>
                                <td>I have high cholesterol</td>
                                <td>
                                    <input type="radio" name="cholestrol" class="cholestrol" value="yes" data-col="4"  onclick="normalQuestionSubmitDisable('cholestrol')"/> Yes</td>
                                <td>
                                    <input type="radio" name="cholestrol" class="cholestrol" value="no" data-col="4"  onclick="normalQuestionSubmitDisable('cholestrol')"/> No</td>
                                <td>
                                    <input type="radio" name="cholestrol" class="cholestrol" value="dont_know" data-col="4"  onclick="normalQuestionSubmitDisable('cholestrol')"/> Don't Know</td>
                            </tr>

                            <tr>
                                <td>II have hypertension</td>
                                <td>
                                    <input type="radio" name="hypertension" class="hypertension" value="yes" data-col="5"  onclick="normalQuestionSubmitDisable('hypertension')"/> Yes</td>
                                <td>
                                    <input type="radio" name="hypertension" class="hypertension" value="no" data-col="5"  onclick="normalQuestionSubmitDisable('hypertension')"/> No</td>
                                <td>
                                    <input type="radio" name="hypertension" class="hypertension" value="dont_know" data-col="5"  onclick="normalQuestionSubmitDisable('hypertension')"/> Don't Know</td>
                            </tr>

                            <tr>
                                <td>I have diabetes</td>
                                <td>
                                    <input type="radio" name="diabetes" class="diabetes" value="yes" data-col="6"  onclick="normalQuestionSubmitDisable('diabetes')"/> Yes</td>
                                <td>
                                    <input type="radio" name="diabetes" class="diabetes" value="no" data-col="6"  onclick="normalQuestionSubmitDisable('diabetes')"/> No</td>
                                <td>
                                    <input type="radio" name="diabetes" class="diabetes" value="dont_know" data-col="6"  onclick="normalQuestionSubmitDisable('diabetes')"/> Don't Know</td>
                            </tr>

                        </table>

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
                        <!-- <p>Please select patient.</p>
                        <p>
                            <select class="form-control user_id" name="user_id" placeholder="Search, e.g.headache" >
                                <option value=""> -- Select Patient -- </option>
                                <?php 
                                    // if(!empty($patients)){
                                    //     foreach ($patients as $patientsData) {
                                            ?>
                                                    <option value="<?php //echo $patientsData->id; ?>"><?php //echo $patientsData->first_name. " " .$patientsData->last_name; ?></option>
                                <?php
                                    //     }
                                    // }
                                ?>
                            </select>
                        </p>-->
                    </div>
                    
                    
                    <!-- <div class="stepper-img">
                        <img src="images/human-body.jpg" class="img-responsive">
                    </div> -->
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
                        <!-- <ul class="stepper-ul" style="margin-top:15px">
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i> Checkup is for informational purposes and is not a qualified medical opinion.</li>
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i> In case of health emergency, call your local emergency number immediately.</li>
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i> Information that you provide is anonymous and not shared with anyone.</li>
                             <li><i class="fa fa-caret-right" aria-hidden="true"></i> In case of health emergency, call your local emergency number immediately.</li>
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i> Information that you provide is anonymous and not shared with anyone.</li>
                        </ul> -->
                        <div class="result-view" style="margin-top: 3px !important;">
                        <div class="result-more">
                            <h3>Result Description</h3>
                            <p class="symptomDecription"></p>
                            <!-- <ul class="result-ui">
                                <li>Your answers</li>
                                <li>Considered diagnoses</li>
                                <li>Duration of the interview</li>
                            </ul>
                            <button style="margin-top:20px" type="button">Start Over</button> -->
                        </div>
                    </div>
                    </div>
        
                    <div class="result-view">
                        <div class="result-more">
                            <h3>Results Precaution</h3>
                            <p class="symptomPrecaution"></p>
                            <!-- <p>Click any row to see details.</p>
                            <ul class="result-ui">
                                <li><a href="#">Salicylate toxicity <span>Strong evidence</span></a></li>
                                <li><a href="#">Salicylate toxicity <span>Strong evidence</span></a></li>
                                <li><a href="#">Salicylate toxicity <span>Strong evidence</span></a></li>
                                <li><a href="#">Salicylate toxicity <span>Strong evidence</span></a></li>
                            </ul> -->
                        </div>
                    </div>

                    <div class="result-view">
                        <div class="result-more">
                            <h3>Result Remedies</h3>
                            <p class="symptomRemedies"></p>
                            <!-- <ul class="result-ui">
                                <li><a href="#"><i class="fa fa-plus"></i> Morphology and urinalysis</a></li>
                                <li><a href="#"><i class="fa fa-plus"></i> Hepatic panel</a></li>
                                <li><a href="#"><i class="fa fa-plus"></i> Metabolic panel</a></li>
                            </ul>

                            <h5 style="margin-top:30px">Preventive</h5>
                            <p>Lab tests recommended in further diagnostic process.</p>
                            <ul class="result-ui">
                                <li><a href="#"><i class="fa fa-plus"></i> Morphology and urinalysis</a></li>
                                <li><a href="#"><i class="fa fa-plus"></i> Glucose</a></li>
                                <li><a href="#"><i class="fa fa-plus"></i> Fecal occult blood</a></li>
                                <li><a href="#"><i class="fa fa-plus"></i> Lipid profile</a></li>
                            </ul> -->
                        </div>
                    </div>

                  

                   <!-- <div class="result-view">
                        <div class="result-more">
                            <h3>Feedback</h3>
                            <p>Is the information on this site helpful?</p>
                            <ul class="result-star">
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                            </ul>
                            <p>Your comment (optional)</p>
                            <textarea class="placeholder-form"></textarea>
                            <button style="margin-top:20px" type="button">Send Feedback</button>
                        </div>
                    </div> -->
                    <div class="result-view">
                        <div class="result-more">
                        
                            <p>Please note that the information provided by this tool is provided solely for educational purposes and is not a qualified medical opinion. This information should not be considered advice or an opinion of a doctor or other health professional about your actual medical state, and you should see a doctor for any symptoms you may have. If you are experiencing a health emergency, you should call your local emergency number immediately to request emergency medical assistance.</p>
                            
                        </div>
                    </div>


                </div>

                                </div>
<!--
        Result End
-->

<?php
require('../layout/footer.php');
?>
<script src="js/bootstrap.min.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/symptom.js"></script>
<script type="text/javascript">
var anotherQuestionMap = "";
var QuestionMapId = "";
var questionCounting = 0;

var last = "no";
var totalQuestion = 0;
var currentQuestionCounter = 0;
var counterQues = 0;
var nextQuestionId = 0;
var mapQuestionCount = 0;
var mapQuestionSelected = "";
var currentQuestionId = {};
    $("document").ready(function() {
        $(".slider").rangeslider();
    });
    $.fn.rangeslider = function(options) {
        var obj = this;
        var defautValue = obj.attr("value");
        obj.wrap("<span class='range-slider'></span>");
        obj.after("<span class='slider-container'><span class='bar'><span></span></span><span class='bar-btn'><span>0</span></span></span>");
        obj.attr("oninput", "updateSlider(this)");
        updateSlider(this);
        return obj;
    };

    function updateSlider(passObj) {
        var obj = $(passObj);
        var value = obj.val();
        var min = obj.attr("min");
        var max = obj.attr("max");
        var range = Math.round(max - min);
        var percentage = Math.round((value - min) * 100 / range);
        var nextObj = obj.next();
        nextObj.find("span.bar-btn").css("left", percentage + "%");
        nextObj.find("span.bar > span").css("width", percentage + "%");
        nextObj.find("span.bar-btn > span").text(percentage);
    };
</script>
<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab
    var questionList = "";
    function showTab(n) {
        
        
        
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
            //document.getElementById("nextBtn").disabled = false;
        } else {
            document.getElementById("prevBtn").style.display = "inline";
            //document.getElementById("nextBtn").disabled = false;
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Next";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //alert($("#serviceTerm").attr("style"));
        //alert($("#symptomStart").attr("style"));
       // if($("#symptomStart").attr("style") == ''){
        //if($("#symptomStart").attr("style") == "display: block;" || $("#symptomStart").attr("style") == "undefined"){
            if($("#serviceTerm").attr("style") == "display: none;" ){
                //document.getElementById("nextBtn").disabled = true;
                if($("input[name='terms']").prop("checked") == true 
                    && $("input[name='gender']").prop("checked") == true
                    ){
                        //document.getElementById("nextBtn").disabled = false;                
                }
                if($("#normalQuestion").attr("style") == "display: block;"){
                    //document.getElementById("nextBtn").disabled = true;
                    // if($("input[name='overweight']").is(":checked")
                    //     && $("input[name='cigrattes']").is(":checked")
                    //     && $("input[name='injured']").is(":checked")
                    //     && $("input[name='cholestrol']").is(":checked")
                    //     && $("input[name='cholestrol']").is(":checked")
                    //     && $("input[name='hypertension']").is(":checked")
                    //     && $("input[name='diabetes']").is(":checked")
                    // ){
                    //     document.getElementById("nextBtn").disabled = false;
                    // }
                }
            }else{
                
                // if($("#normalQuestion").attr("style") == "display: none;"){
                //     document.getElementById("nextBtn").disabled = true;
                // }else{
                    //document.getElementById("nextBtn").disabled = false;
                // }
                
            }
        //}
       // }
        if($("#symptomStart").attr("style") == "display: block;"){
            document.getElementById("nextBtn").disabled = true;
        }

        
        
        //if($("#genderSlectedNext").attr("style") == "display: none;")
        //... and run a function that will display the correct step indicator:
        //fixStepIndicator(n)
    }

    function nextPrev(n, nextQuestion) {
        if(typeof nextQuestion === "undefined"){
            var obtValues = {};
                    $("input[name='answer_response"+parseInt(counterQues - 1 ) +"']:checked").each(function(i, e){
                        obtValues[i] = $(this).val();
                    });
                    // console.log("Question Answer:---", obtValues);
                    // console.log("Question Id:---", currentQuestionId);
                    $(".page-loader-wrapper").fadeIn();
                   
                    var obtValue = {};
                    $("input[name='answer_response"+parseInt(counterQues - 1) +"']:checked").each(function(i, e){
                        obtValue[i] = $(this).val();
                    });
                    //For Save Question Response
                    $.ajax({
                       url : "API.php",
                       method : "POST",
                       data : { "method" : "save", question_id : currentQuestionId, optionValue : obtValue, user_id : $(".user_id").val() },
                       success : function(){
                            $(".page-loader-wrapper").fadeOut();
                            $("#nextQuestionCounter"+parseInt(counterQues - 1 )).attr("style", "display:none;");
                            $("#nextQuestionCounter"+parseInt(counterQues - 1 )).after($(".resultDataShow").clone());
                            ///alert($("#regForm").last("div:nth-child(2)").html());
                            $(".next-btn").empty();
                            $(".resultDataShow").attr("style", "display:block;");
                            $(".blockResult").empty();

                            //@Result data show API call
                            $.ajax({
                                url : "API.php",
                                method : "POST",
                                data : { "method" : "Result", user_id : $(".user_id").val(), gender : $("input[name='gender']:checked").val(), "body_part_id" : $(".body_part_id_question").val(), "symptom_id" : $(".body_part_id_symptom_id").val() },
                                success : function(data){
                                    console.log(data)  ;
                                    var parseResult = JSON.parse(data);
                                    if(parseResult.status == true){
                                        $(".symptomStatus").html(parseResult.data.status);
                                        $(".symptomDecription").html(parseResult.data.dscription);
                                        $(".symptomPrecaution").html(parseResult.data.precaution);
                                        $(".symptomRemedies").html(parseResult.data.remedies);
                                    }
                                },
                                error : function(error){
                                }
                            });
                       },
                       error : function(error){
                            alert("Network Issue");
                            return false;
                       }
                    });
            
            return false;
        }
        
        //alert($("#symptomStart").attr("style"));
            //if(currentTab <= 5){
            var x = document.getElementsByClassName("tab");
           // alert(currentTab);
            // console.log(x);
            // console.log(currentTab);
            // console.log(x[currentTab]);
            //alert($("#symptomStart").attr("style"));
            // Exit the function if any field in the current tab is invalid:
            //if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
           
            
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = parseInt(currentTab) + n;
            // if you have reached the end of the form...

            if(n < 0){
                //$("#nextBtn").attr("onclick", "nextPrev(1, )");
                if(questionCounting > 0){
                    questionCounting = parseInt(questionCounting) - 1;
                    
                }
                if(mapQuestionCount > 0){
                    mapQuestionCount = parseInt(mapQuestionCount) - 1;
                }
                //$("#regForm:last-child").remove();
                if(nextQuestion > 0){
                    counterQues = parseInt(counterQues) - 1;
                }
                $('#nextQuestionCounter'+nextQuestion).remove();
                //alert(mapQuestionCount);
               // alert(questionCounting);
                //counterQues = parseInt(counterQues) - 1;
            }
            //alert(currentTab);
            //alert(x.length);
            
            if (currentTab >= x.length) {
                // ... the form gets submitted:
                //document.getElementById("regForm").submit();
                    //alert(counterQues);
                    
                if(counterQues == 0){
                    $(".page-loader-wrapper").fadeIn();
                    //Call first Question 
                    $.ajax({
                        url : "API.php",
                        data : {"method" : "checkQuestion", "body_part_id" : $(".body_part_id_question").val(), "symptom_id" : $(".body_part_id_symptom_id").val(), age : $(".slider").val(), gender : $("input[class='gender']").val()},
                        method : "post",
                        success : function(data){
                            var parse = JSON.parse(data);
                            // console.log(parse.status);
                            
                            if(parse.status == true){
                                currentQuestionCounter = parseInt(currentQuestionCounter) + 1;
                                $("#currentQuestion").val(currentQuestionCounter);
                                questionList = JSON.parse(parse.data.question_id);
                                //console.log("Quesion lIst:--", questionList);
                                anotherQuestionMap = JSON.parse(parse.data.another_question);
                                QuestionMapId = JSON.parse(parse.data.question_map_id);
                                //console.log("Another Question Map:--", anotherQuestionMap);
                                totalQuestion = parseInt(questionList.length + QuestionMapId.length);
                                $("#totalQuestion").val(totalQuestion);
                                $.ajax({
                                    url : "API.php",
                                    method : "get",
                                    data : {"question" : questionList[0], "initiate" : "questionStart", "body_part_id" : $(".body_part_id_question").val(), "symptom_id" : $(".body_part_id_symptom_id").val(), age : $(".slider").val(), gender : $("input[class='gender']").val()},
                                    success : function(dataQuestion){
                                        $(".page-loader-wrapper").fadeOut();
                                        var parFirstQuestion = JSON.parse(dataQuestion);
                                        //parseInt(questionCounting) += 1;
                                        currentQuestionId = parFirstQuestion.data.id;
                                        $("#questionId").val(parFirstQuestion.data.id);
                                        if(parFirstQuestion.status){
                                            //console.log("ParseOption", parFirstQuestion.data.answer_label);
                                            //console.log("ParseOption----", JSON.parse(parFirstQuestion.data.answer_label));
                                            var div = document.createElement("div");
                                            div.setAttribute("class", "tab min-hight");
                                            div.setAttribute("id", "nextQuestionCounter"+counterQues);
                                            div.style.display = "block";
                                                var divChild = document.createElement("div");
                                                divChild.setAttribute("class", "stepper-gander");

                                                //Question Name
                                                var createh3 = document.createElement("h3");
                                                createh3.innerHTML = parFirstQuestion.data.question;
                                                createh3.setAttribute("class", "text-center");
                                                divChild.appendChild(createh3);
                                                
                                                //Option Listing
                                                var optionJsonLable = JSON.parse(parFirstQuestion.data.answer_label);
                                                var optionJsonLableValue = JSON.parse(parFirstQuestion.data.answer_value);
                                                
                                                
                                                    for(var i = 0; i < optionJsonLable.length; i++){
                                                        console.log("Lable", optionJsonLable[i]);
                                                        console.log("Value", optionJsonLableValue[i]);
                                                        var optionList = document.createElement("div");
                                                        optionList.setAttribute("class", "checkbox");
                                                            var checkBox = document.createElement("input");
                                                            checkBox.setAttribute("type", parFirstQuestion.data.type);
                                                            checkBox.setAttribute("name", "answer_response"+counterQues);
                                                            checkBox.setAttribute("onclick", "nextQuestion('"+optionJsonLable[i]+"', '"+counterQues+"', '"+parFirstQuestion.data.type+"')");
                                                            
                                                            
                                                            checkBox.value = optionJsonLableValue[i];
                                                            var labelCheckbox = document.createElement("label");
                                                            labelCheckbox.setAttribute("for" ,"optinosCheckbox1");
                                                            labelCheckbox.innerHTML = optionJsonLable[i];
                                                            console.log(checkBox);
                                                            console.log(labelCheckbox);
                                                        optionList.appendChild(checkBox);
                                                        optionList.appendChild(labelCheckbox);
                                                        divChild.appendChild(optionList);
                                                    }
                                                    
                                                
                                            counterQues = parseInt(counterQues) + 1;
                                            div.appendChild(divChild);
                                            //questionList.shift();
                                            //anotherQuestionMap.shift();
                                            console.log("Quesion lIst:--", questionList);
                                            //console.log("Another Question Map:--", anotherQuestionMap);
                                            //console.log(div);
                                            
                                            // if(anotherQuestionMap[0] == $("#"+anotherQuestionMap[0]).val()){
                                            //     $("#nextBtn").attr("onclick", "nextQuestion('"+questionList[0]+"')")
                                            // }else{
                                            //     $("#nextBtn").attr("onclick", "nextQuestion('"+questionList[0]+"')")
                                            // }
                                            
                                            $("#symptomStart").after(div);
                                            $("#nextBtn").attr("disabled", true);
                                            //questionCounting = parseInt(questionCounting) + 1;
                                            if(mapQuestionSelected == "notmap"){
                                                mapQuestionCount = parseInt(mapQuestionCount) + 1 ;
                                                
                                            }else{
                                                questionCounting = parseInt(questionCounting) + 1;
                                            }
                                        }else{  
                                            alert("No data found");
                                            location.reload(true);
                                            return false;
                                        }
                                    },
                                    error : function(error){
                                        alert("Error To found question");
                                        return false;
                                    }
                                });
                            }else{
                                alert("No data found");
                                location.reload(true);
                                return false;
                            }
                        },
                        error : function(error){
                            alert("Network issue");
                            return false;
                        }
                    });
                }else{

                    //@save Question answer to DB
                    
                    $(".page-loader-wrapper").fadeIn();
                    var obtValue = {};
                    $("input[name='answer_response"+parseInt(counterQues - 1) +"']:checked").each(function(i, e){
                        obtValue[i] = $(this).val();
                    });
                    console.log("Question Answer:---", obtValue);
                    console.log("Question Id:---", currentQuestionId);
                    //For Save Question Response
                    $.ajax({
                       url : "API.php",
                       method : "POST",
                       data : { "method" : "save", question_id : currentQuestionId, optionValue : obtValue, user_id : $(".user_id").val() },
                       success : function(){

                       },
                       error : function(error){
                            alert("Network Issue");
                            return false;
                       }
                    });
                                $.ajax({
                                    url : "API.php",
                                    method : "get",
                                    data : {"question" : nextQuestionId, "initiate" : "questionListing", "body_part_id" : $(".body_part_id_question").val(), "symptom_id" : $(".body_part_id_symptom_id").val(), age : $(".slider").val(), gender : $("input[class='gender']").val()},
                                    success : function(dataQuestion){
                                        $(".page-loader-wrapper").fadeOut();
                                       //alert(parseInt(counterQues) - 1);
                                        //alert($("#nextQuestionCounter"+parseInt(counterQues) - 1).children("input[name='answer_response']").val());
                                        var parFirstQuestion = JSON.parse(dataQuestion);
                                        currentQuestionId = parFirstQuestion.data.id;
                                        $("#questionId").val(parFirstQuestion.data.id);
                                        
                                        
                                        
                                       
                                        if(parFirstQuestion.status){
                                            //console.log("ParseOption", parFirstQuestion.data.answer_label);
                                            //console.log("ParseOption----", JSON.parse(parFirstQuestion.data.answer_label));
                                            var div = document.createElement("div");
                                            div.setAttribute("class", "tab min-hight");
                                            div.setAttribute("id", "nextQuestionCounter"+counterQues);
                                            div.style.display = "block";
                                                var divChild = document.createElement("div");
                                                divChild.setAttribute("class", "stepper-gander");

                                                //Question Name
                                                var createh3 = document.createElement("h3");
                                                createh3.innerHTML = parFirstQuestion.data.question;
                                                createh3.setAttribute("class", "text-center");
                                                divChild.appendChild(createh3);
                                                
                                                //Option Listing
                                                var optionJsonLable = JSON.parse(parFirstQuestion.data.answer_label);
                                                var optionJsonLableValue = JSON.parse(parFirstQuestion.data.answer_value);
                                                // alert(QuestionMapId[mapQuestionCount]);
                                                //                 alert(questionList[questionCounting]);
                                                if(typeof questionList[questionCounting] == "undefined"){
                                                    last = "last";
                                                }else{
                                                    last= "no";
                                                }
                                                
                                                    for(var i = 0; i < optionJsonLable.length; i++){
                                                        console.log("Lable", optionJsonLable[i]);
                                                        console.log("Value", optionJsonLableValue[i]);
                                                        var optionList = document.createElement("div");
                                                        optionList.setAttribute("class", "checkbox");
                                                            var checkBox = document.createElement("input");
                                                            checkBox.setAttribute("type", parFirstQuestion.data.type);
                                                            if(parFirstQuestion.data.type == "checkbox"){
                                                                
                                                                checkBox.setAttribute("data-value", optionJsonLable[i]);
                                                            }
                                                            checkBox.setAttribute("name", "answer_response"+counterQues);
                                                            
                                                            checkBox.setAttribute("onclick", "nextQuestion('"+optionJsonLable[i]+"','"+counterQues+"', '"+parFirstQuestion.data.type+"')");
                                                            
                                                            
                                                            checkBox.value = optionJsonLableValue[i];
                                                            var labelCheckbox = document.createElement("label");
                                                            labelCheckbox.setAttribute("for" ,"optinosCheckbox1");
                                                            labelCheckbox.innerHTML = optionJsonLable[i];
                                                            console.log(checkBox);
                                                            console.log(labelCheckbox);
                                                        optionList.appendChild(checkBox);
                                                        optionList.appendChild(labelCheckbox);
                                                        divChild.appendChild(optionList);
                                                    }
                                                    
                                                
                                                

                                            div.appendChild(divChild);
                                           // counterQues = parseInt(counterQues) + 1;
                                            //questionList.shift();
                                            //anotherQuestionMap.shift();
                                            console.log("Quesion lIst:--", questionList);
                                            //console.log("Another Question Map:--", anotherQuestionMap);
                                            //console.log(div);
                                            
                                            // if(anotherQuestionMap[0] == $("#"+anotherQuestionMap[0]).val()){
                                            //     $("#nextBtn").attr("onclick", "nextQuestion('"+questionList[0]+"')")
                                            // }else{
                                            //     $("#nextBtn").attr("onclick", "nextQuestion('"+questionList[0]+"')")
                                            // }
                                            
                                            $("#nextQuestionCounter"+ parseInt(counterQues - 1)).after(div);
                                            $("#prevBtn").attr("onclick", "nextPrev(-1, "+questionCounting+")");
                                            counterQues = parseInt(counterQues) + 1;
                                            $("#nextBtn").attr("disabled", true);
                                            if(mapQuestionSelected == "notmap"){
                                                questionCounting = parseInt(questionCounting) + 1;
                                            }else{
                                                mapQuestionCount = parseInt(mapQuestionCount) + 1 ;
                                            }
                                            currentQuestionCounter = parseInt(currentQuestionCounter) + 1;
                                            $("#currentQuestion").val(currentQuestionCounter);
                                        }else{  
                                            alert("No data found");
                                            location.reload(true);
                                            return false;
                                        }
                                    },
                                    error : function(error){
                                        alert("Error To found question");
                                        return false;
                                    }
                                });
                }
                return false;
                
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
            if(n == "-1"){
                //alert($("input[name='gender']").prop("checked"));
                if($("input[name='terms']").prop("checked") == true 
                    || $("input[name='gender']").prop("checked") == true
                    || $("input[name='overweight']").prop("checked") == true
                    ){
                    document.getElementById("nextBtn").disabled = false;
                }
            }
            //alert($("#serviceTerm").attr("style"));
            // if($("#serviceTerm").attr("style") == "display: none;" || $("input[name='terms']").prop("checked") == true){
            //     document.getElementById("nextBtn").disabled = false;
            // }else{
            //     document.getElementById("nextBtn").disabled = true;
            // }
        
        //alert($("input[name='overweight']:checked").val());
        // This function will figure out which tab to display
           // }else{
                
           // }
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        // if (valid) {
        //     document.getElementsByClassName("step")[currentTab].className += " finish";
        // }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
</script>


<script type="text/javascript">
    var col, el;

    $("input[type=radio]").click(function() {
        el = $(this);
        col = el.data("col");
        $("input[data-col=" + col + "]").prop("checked", false);
        el.prop("checked", true);
    });

    $("input[name='terms']").click(function(){
        if($(this).prop("checked")){
            $("#nextBtn").removeAttr("disabled");
        }
    });

    $("input[name='gender']").click(function(){
        if($(this).prop("checked")){
            $("#nextBtn").removeAttr("disabled");
        }else{
            $("#nextBtn").attr("disabled");
        }
    });

    

    function normalQuestionSubmitDisable(className){
        
        if($("input[name='overweight']").is(":checked")
            && $("input[name='cigrattes']").is(":checked")
            && $("input[name='injured']").is(":checked")
            && $("input[name='cholestrol']").is(":checked")
            && $("input[name='cholestrol']").is(":checked")
            && $("input[name='hypertension']").is(":checked")
            && $("input[name='diabetes']").is(":checked")
        ){
            //if($("input[name='cigrattes']").is(":checked")){
                $("#nextBtn").removeAttr("disabled");
            //}
        }
        // alert($("input[name='overweight']").prop("checked"));
        // alert($("input[name='cigrattes']").prop("checked"));
        // alert($("input[name='injured']").prop("checked"));
        // alert($("input[name='cholestrol']").prop("checked"));
        // alert($("input[name='hypertension']").prop("checked"));
        // alert($("input[name='diabetes']").prop("checked"));
        // if($("input[name='overweight']").prop("checked") == true 
        //     && $("input[name='cigrattes']").prop("checked") == true
        //     && $("input[name='injured']").prop("checked") == true
        //     && $("input[name='cholestrol']").prop("checked") == true
        //     && $("input[name='hypertension']").prop("checked") == true
        //     && $("input[name='diabetes']").prop("checked") == true
        // ){
        //     $("#nextBtn").removeAttr("disabled");
        // }else{
        //     $("#nextBtn").attr("disabled");
        // }
    }


    
    function nextQuestion(id, co, type){
        // alert(anotherQuestionMap[mapQuestionCount]);
        // alert(id);
        if(type == "checkbox"){
            var favorite = [];
            $.each($('input[name="answer_response'+co+'"]:checked'), function(){            
                    favorite.push($(this).val());
                });
            console.log(favorite);
        }
        // alert(questionCounting);
        // alert(mapQuestionCount);
        // alert(QuestionMapId[mapQuestionCount]);
        // alert(questionList[questionCounting]);
        // alert($('input[name="answer_response'+co+'"]').val());
        // alert($("input[name='answer_response"+co+"']").attr("type"));
        $("#nextBtn").removeAttr("disabled");
        //alert(last);
        //mapQuestionCount = parseInt(mapQuestionCount) + 1;
        if(anotherQuestionMap[mapQuestionCount] == id ){
            //@for mapping question
            if(type == "checkbox" && typeof QuestionMapId[mapQuestionCount] == "undefined") {
                nextQuestionId = questionList[questionCounting];
                $("#nextBtn").attr("onclick", "nextPrev(1, "+questionList[questionCounting]+")");
            }else{
                nextQuestionId = QuestionMapId[mapQuestionCount];
                $("#nextBtn").attr("onclick", "nextPrev(1, "+QuestionMapId[mapQuestionCount]+")");
            }

            if(last == "last"){
                nextQuestionId = "undefined";
                $("#nextBtn").attr("onclick", "nextPrev(1, undefined)");
            }
            
            mapQuestionSelected = "map";
        }else{
            //@for not mapping question
            if(typeof questionList[questionCounting] == "undefined") {
                nextQuestionId = QuestionMapId[mapQuestionCount];
                $("#nextBtn").attr("onclick", "nextPrev(1, "+QuestionMapId[mapQuestionCount]+")");
            }else{
                nextQuestionId = questionList[questionCounting];
                $("#nextBtn").attr("onclick", "nextPrev(1, "+questionList[questionCounting]+")");
            }
                
            if(last == "last"){
                nextQuestionId = "undefined";
                $("#nextBtn").attr("onclick", "nextPrev(1, undefined)");
            }
            
            mapQuestionSelected = "notmap";
            
        }
        
    }
</script>
