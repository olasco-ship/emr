<?php
require_once("../includes/initialize.php");

if (is_post()) {

    $value = $_POST['value'];

    $classifications = NursingClassification::find_by_domain_id($value);
  //  $subClinic = SubClinic::find_by_clinic_id($value); ?>

    <select class="form-control" id="classification_id" name="classification_id" required>
        <option value="">--Select Nursing Classification--</option>
        <?php
        foreach ($classifications as $classification) { ?>
            <option
                value="<?php echo $classification->id; ?>"><?php echo $classification->name; ?>
            </option>
        <?php } ?>
    </select>


<?php } ?>




