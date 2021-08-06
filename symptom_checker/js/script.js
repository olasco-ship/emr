$(document).ready(function(){
    $(".body_part_id").change(function(){
        $("#body_part_name").val($(".body_part_id option:selected").html());
    });

    //Show listing for symptom accroding to body part
    $(".body_part").change(function(){
        $.ajax({
            url : "../model/BodyPartModel.php",
            data : {'body_part_id' : $(this).val()},
            type : "GET",
            success : function(data){
                $(".symptom_id").empty();
                $(".symptom_id").html(data);
            },
            error : function(err){
                alert("Network Issue");
            }
        });
    });


    $('.answer_label').select2({
        tags: true,
        placeholder: "Select Answer Label",
    });
    $('.answer_value').select2({
        tags: true,
        placeholder: "Select Answer Label value",
    });
    
    $('#result_status').select2({
        tags: true,
        placeholder: "Select Result Status Label",
    });
    $('#result_status_value').select2({
        tags: true,
        placeholder: "Select Result Status Value",
    });

    $('#question_id').select2({
        templateResult: hideSelected,
        placeholder: "Select Question",
        ajax: {
            url: '../../model/QuestionModel.php',
            dataType: 'json',
            data: function (params) {
                  return { q: $(".body_part_id_symptom").val()}
            },
            processResults: function (data) {
                return {
                    results: $.map(data.data, function (item) {
                        return {
                            text: item.question,
                            id: item.id
                        }
                    })
                };
            }
          }
    });
    var counAddQuest = 0;
    $("#question_id").change(function(){
        $.ajax({
            url : "question_list.php",
            //url : "../../model/QuestionModel.php",
            data : {question_id : $(this).val(), counter : counAddQuest},
            type : "GET",
            success : function(data){
                $(".contentMapping").append(data);
                counAddQuest = parseInt(counAddQuest) + 1;
            },
            error : function(err){
                alert("Network Issue");
            }
        });
    });



    $(".body_part_id_symptom").change(function(){
        $.ajax({
            url : "../../model/SymptomModel.php",
            data : {body_part_id : $(".body_part_id_symptom").val()},
            type : "GET",
            success : function(data){
                //$(".body_part_id_symptom_id").empty();
                $(".body_part_id_symptom_id").html(data);
            },
            error : function(err){
                alert("Network Issue");
            }
        });
    });


    $(".body_part_id_question").change(function(){
        $.ajax({
            url : "../model/SymptomModel.php",
            data : {body_part_id : $(".body_part_id_question").val()},
            type : "GET",
            success : function(data){
                $(".body_part_id_symptom_id").empty();
                $(".body_part_id_symptom_id").html(data);
            },
            error : function(err){
                alert("Network Issue");
            }
        });
    });
});

function hideSelected(value) {
    if (value && !value.selected) {
      return $('<span>' + value.text + '</span>');
    }
  }

function editDataBodyPart(id, name){
    window.scrollTo(0, 0);
    $(".name").val(name);
    $("#body_id").val(id);
}

function deleteBodyPart(id){
    var con =- confirm("Are you sure to delete body part");
    if(con){
        $.ajax({
            url : "../model/BodyPartModel.php",
            data : {id : id},
            type : "GET",
            success : function(data){
                
                if(data.status == 0){
                    alert("Error in delete data");
                }else{
                    window.location = "../body_part/index.php"
                }
            },
            error : function(err){
                alert("Network Issue");
            }
        });
    }
}



// Symptom operation
function editDataSymptom(id, name, body_part_id, body_part_name){
    window.scrollTo(0, 0);
    $(".name").val(name);
    $(".body_part_id").val(body_part_id);
    $("#body_part_name").val(body_part_name);
    $("#body_id").val(id);
}

function deleteBodySymptom(id){
    var con =- confirm("Are you sure to delete symptom");
    if(con){
        $.ajax({
            url : "../model/SymptomModel.php",
            data : {id : id},
            type : "GET",
            success : function(data){
                
                if(data.status == 0){
                    alert("Error in delete data");
                }else{
                    window.location = "../symptom/index.php"
                }
            },
            error : function(err){
                alert("Network Issue");
            }
        });
    }
}

function deleteBodyQuestion(id){
    var con =- confirm("Are you sure to delete question");
    if(con){
        $.ajax({
            url : "../model/QuestionModel.php",
            data : {id : id},
            type : "GET",
            success : function(data){
                
                if(data.status == 0){
                    alert("Error in delete data");
                }else{
                    window.location = "../question/index.php"
                }
            },
            error : function(err){
                alert("Network Issue");
            }
        });
    }
}

function deleteBodyQuestionMapping(id){
    var con =- confirm("Are you sure to delete question mapping");
    if(con){
        $.ajax({
            url : "../model/QuestionMappingModel.php",
            data : {id : id},
            type : "GET",
            success : function(data){
                
                if(data.status == 0){
                    alert("Error in delete data");
                }else{
                    window.location = "../question/symptom/index.php"
                }
            },
            error : function(err){
                alert("Network Issue");
            }
        });
    }
}

function deleteQuestionMapping(id){
    var con =- confirm("Are you sure to delete question mapping");
    if(con){
        $.ajax({
            url : "../../model/QuestionMappingModel.php",
            data : {id : id},
            type : "GET",
            success : function(data){
                
                if(data.status == 0){
                    alert("Error in delete data");
                }else{
                    //window.location = "../../question/symptom/index.php"
                }
            },
            error : function(err){
                alert("Network Issue");
            }
        });
    }
}