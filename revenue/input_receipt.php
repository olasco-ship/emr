<?php

require_once("../includes/initialize.php");

$bill = Bill::find_by_id($_GET['id']);

$encounter = Encounter::find_by_id($bill->encounter_id);

//$prescribed = new Prescribed();

if (is_post()){

    $receipt = test_input($_POST['receipt']);

    $bill->receipt = $receipt;
    $bill->status  = "PAID";
    if ($bill->save()){

        if (!empty(Prescribed::find_by_billed($bill->id))) {
            $prescribed          =  Prescribed::find_by_billed($bill->id);
            foreach ($prescribed as $p){
                $p->receipt = $receipt;
                $p->status  = "PAID";
                $p->save();

            }
            redirect_to('billed.php');
        }
        if (!empty(TestRequest::find_by_billed( $bill->id))) {
            $test                =  TestRequest::find_by_billed($bill->id);
            foreach ($test as $t){
                $t->receipt = $receipt;
                $t->status  = "PAID";
                $t->save();
            }
            redirect_to('billed.php');
        }

        if (!empty(ScanRequest::find_by_billed( $bill->id))) {
            $scan                =  ScanRequest::find_by_billed($bill->id);
            foreach ($scan as $s){
                $s->receipt = $receipt;
                $s->status  = "PAID";
                $s->save();
            }
            redirect_to('billed.php');
        }


    }


}






?>


<input type="hidden" value="<?php echo $bill->id; ?>" id="billId"/>
<div>


    <form id="userForm" method="post" action="input_receipt.php?id=<?php echo $bill->id; ?>">
        <?php if ($done == TRUE) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                Your information was successfully updated
            </div>
        <?php } else if (empty($errorMessage) == FALSE and isset($errorMessage)) {
            ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <?php echo $errorMessage; ?>
            </div>
            <?php
        } ?>

        <dl class="dl-horizontal">

            <dt>
                Service(s)
            </dt>
            <dd>
                <?php
                if (!empty($testRequest = TestRequest::find_by_billed($bill->id))){
                    $testRequest = TestRequest::find_by_billed($bill->id);
                    foreach ($testRequest as $r)   {
                        echo $r->test_name . "<br/>";
                    }
                } else if(!empty($prescribed = Prescribed::find_by_billed($bill->id))){
                    $prescribed = Prescribed::find_by_billed($bill->id);
                    foreach ($prescribed as $pres){
                        echo $pres->product_name . "<br/>";
                    }
                } else if(!empty($scanRequest = ScanRequest::find_by_billed($bill->id))){
                    $scanRequest = ScanRequest::find_by_billed($bill->id);
                    foreach ($scanRequest as $r){
                        echo $r->test_name . "<br/>";
                    }
                }


                ?>
            </dd>
            <br/>

            <dt>
                Receipt Number
            </dt>
            <dd>
                <input class="form-control"  style="width: 250px;" name="receipt" value="<?php echo $receipt; ?>"/>
            </dd>
            <br/>


            <dt>

            </dt>
            <dd>
                <input type="submit" value="Update" class="btn btn-info"/>
            </dd>

        </dl>
    </form>
</div>




