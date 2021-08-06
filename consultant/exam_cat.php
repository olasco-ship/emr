<?php
require_once("../includes/initialize.php");




if (is_post()) {

    $value = json_encode($_POST['value']);

    $exploded = explode(",", $_POST['value']);
?>
    <table class="table table-bordered">
        <?php
        foreach ($exploded as $v){
//        $exam_cat = ExaminationCategory::find_by_id($v);
        $examinations = Examination::find_by_exam_cat_id($v);

//        echo $v;
    ?>
                <tr>
<!--                    <td>--><?php //echo $exam_cat->name ?><!--</td>-->
                    <td>
                        <select class="form-control examination" id="examination_id" name="examination_id[]" multiple="multiple" required>
                            <?php
                            $decode = json_decode($case_note->systemic_examination);
                            foreach ($decode as $dec) {
                            $name = Examination::find_by_id($dec->symptoms);
                            ?>
                            <option <?php echo ($dec->symptoms) ? 'selected ="TRUE"' : ''; ?>value="<?php echo $dec->symptoms ?>"><?php echo $name->name ?></option>
                            <?php
                            }
                            foreach ($examinations as $examination) { ?>
                                <option
                                        value="<?php echo $examination->id; ?>"><?php echo $examination->name; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>

    <?php

    }
    ?>
    </table>
<?php
} ?>


<script>
    $(".examination").select2({
        tags: true,
        placeholder: "Select Symptoms",
    });
</script>




