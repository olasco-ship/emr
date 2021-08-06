<?php
require_once("../includes/initialize.php");




if (is_post()) {

    $value = $_POST['value'];

    $subClinic = SubClinic::find_by_clinic_id($value); ?>
    <select class="form-control" id="sub_clinic_id" name="sub_clinic_id" required>
        <option value="">--Select Sub-Clinic--</option>
        <?php
        foreach ($subClinic as $clinic) { ?>
            <option
                    value="<?php echo $clinic->id; ?>"><?php echo $clinic->name; ?>
            </option>
        <?php } ?>
    </select>


<?php } ?>




