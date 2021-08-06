$(document).ready(function(){
    $(".body_part_id_question").change(function(){
        $("#nextBtn").attr("disabled", false);
        $.ajax({
            url : "model/SymptomModel.php",
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


    $('.body_part_id_question').select2({
        tags: true,
        templateResult: hideSelected,
        placeholder: "Select Body Part",
    });
    $('.body_part_id_symptom_id').select2({
        tags: true,
        templateResult: hideSelected,
        placeholder: "Select Symptom",
    });
});

function hideSelected(value) {
    if (value && !value.selected) {
      return $('<span>' + value.text + '</span>');
    }
  }