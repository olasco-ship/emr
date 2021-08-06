<?php

require_once("../includes/initialize.php");


if (is_post()){
    $value = $_POST['value'];
    $test = Test::find_by_id($value);
    ?>


    <!--<div class="col-sm-12">-->
    <div class="form-group" id="revenue">
        <input type="text" class="form-control" name="<?php echo $test->price ?>" value="<?php echo '₦'.$value ?>" readonly>
    </div>
    <!--</div>-->


    <!--<div class="col-sm-12">-->
<!--        <div class="form-group" id="revenue">
            <input type="text" class="form-control" name="<?php /*echo $test->price */?>" value="<?php /*echo '₦'.$test->price */?>" readonly>
        </div>-->
    <!--</div>-->



<?php } ?>




