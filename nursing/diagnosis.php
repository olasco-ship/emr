<?php
require_once("../includes/initialize.php");

if (is_post()) {

    $value = $_POST['value'];

 //   $classifications = NursingClassification::find_by_domain_id($value);
    $diagnosis = NursingDiagnosis::find_by_class_id($value); ?>

    <select class="form-control" id="classification_id" name="diagnosis_id" required>
        <option value="">--Select Nursing Diagnosis--</option>
        <?php
        foreach ($diagnosis as $d) { ?>
            <option
                value="<?php echo $d->id; ?>"><?php echo $d->name; ?>
            </option>
        <?php } ?>
    </select>


<?php } ?>




