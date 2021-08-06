<?php

require_once("../includes/initialize.php");


if (is_post()){

 //   $value = $_POST['value'];
 //   $tests = Test::find_revenueHead_id($value);    ?>


    <div class="form-group">
        <select class="form-control" style="width: 350px" id="unit" name="unit" required>
            <option value="">--Select Unit--</option>
            <?php
            $value = $_POST['value'];
            //   $tests = Test::find_revenueHead_id($value);
            $finds = Unit::find_revenueHead_id($value);
            foreach ($finds as $find) {  ?>
                <option  value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
            <?php } ?>
        </select>
    </div>



<?php

}
?>


