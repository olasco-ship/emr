<?php

require_once("../includes/initialize.php");

$user = User::find_by_id($session->user_id);


if (is_post()) {

    $bill_number = $_POST['bill_number'];
  //  $pre_reg = PreRegistration::find_by_bill_number($bill_number);

    $bill = Bill::find_bill_number($bill_number);

    if (isset($_POST['paymentReceipt'])) {

        $id = $_POST['bill_id'];

        $payment_ref = $_POST['auth_code'];

        $payment_bill                  = Bill::find_by_id($id);
        $payment_bill->status          = "PAID";
        $payment_bill->receipt         = $payment_ref;
        $payment_bill->payment_officer = $user->full_name();

      //  echo $payment_bill->id . "<br/>";

     //  $t = TestRequest::find_billed(38); // print_r($t);  exit;


        if ($payment_bill->save()){

            if (!empty(Referrals::find_by_billed($payment_bill->id))){
                $ref = Referrals::find_by_billed($payment_bill->id);
                foreach ($ref as $r){
                    $r->receipt = $payment_ref;
                    $r->status  = "PAID";
                    $r->save();

                }
                $session->message("Payment Reference has been added");
                redirect_to("new.php");
            }

            if (!empty(TestRequest::find_billed($payment_bill->id))) {
                $test         =  TestRequest::find_billed($payment_bill->id);
                $labService = LabServices::find_by_bill_id($payment_bill->id);
                $labService->status = "CLEARED";
                $labService->save();
                foreach ($test as $t){
                    $t->receipt = $payment_ref;
                  //  $t->status  = "PAID";
                    $t->save();
                }
                $session->message("Payment Reference has been added");
                redirect_to("new.php");
            }

            if (!empty(ScanRequest::find_billed($payment_bill->id))) {
                $scan         =  ScanRequest::find_billed($payment_bill->id);
                $radioService =  RadioServices::find_by_bill_id($payment_bill->id);
                $radioService->status = "CLEARED";
                $radioService->save();
                foreach ($scan as $s){
                    $s->receipt = $payment_ref;
                 //   $s->status  = "PAID";
                    $s->save();
                }
                $session->message("Payment Reference has been added");
                redirect_to("new.php");
            }

            if (!empty(DrugRequest::find_by_billed($payment_bill->id))) {
                $drugs         =  DrugRequest::find_by_billed($payment_bill->id);
                $drugService   =   DrugServices::find_by_bill_id($payment_bill->id);
                $drugService->status = "CLEARED";
                $drugService->save();
                foreach ($drugs as $d){
                    $d->receipt = $payment_ref;
                 //   $d->status  = "PAID";
                    $d->save();
                }
                $session->message("Payment Reference has been added");
                redirect_to("new.php");
            }



            /*          if (!empty(Prescribed::find_by_billed($payment_bill->id))) {
                             $prescribed          =  Prescribed::find_by_billed($payment_bill->id);
                           foreach ($prescribed as $p){
                               $p->receipt = $payment_ref;
                               $p->status  = "PAID";
                               $p->save();

                           }
                           $session->message("Payment Reference has been added");
                           redirect_to("new.php");
                       }
                       if (!empty(TestRequest::find_by_billed($payment_bill->id))) {
                           $test                =  TestRequest::find_by_billed($payment_bill->id);
                           foreach ($test as $t){
                               $t->receipt = $payment_ref;
                               $t->status  = "PAID";
                               $t->save();
                           }
                           $session->message("Payment Reference has been added");
                           redirect_to("new.php");
                       }

                       if (!empty(ScanRequest::find_by_billed($payment_bill->id))) {
                           $scan                =  ScanRequest::find_by_billed($payment_bill->id);
                           foreach ($scan as $s){
                               $s->receipt = $payment_ref;
                               $s->status  = "PAID";
                               $s->save();
                           }
                           $session->message("Payment Reference has been added");
                           redirect_to("new.php");
                       }
            */

            $session->message("Payment Reference has been added");
            redirect_to("new.php");


        }










    }


    if (!empty($bill)) {
       // echo $bill->receipt;
        if(!empty($bill->receipt)){ ?>
            <div class="col-md-7">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            Bill Number has been used
            </div>
        </div>
    <?php    } else {   ?>

            <table class="table table-responsive">
                <tr class="table-active">
                    <th>First Name</th>
                    <td id="account_number"><?php echo $bill->first_name ?></td>
                </tr>
                <tr class="table-success">
                    <th>Last Name</th>
                    <td id="account_name"><?php echo $bill->last_name ?></td>
                </tr>
                <tr class="table-info">
                    <th> Revenue</th>
                    <td id="account_balance">
                        <?php
                            $decode = json_decode($bill->revenues);
                            if (empty($decode)){
                                echo $bill->revenues;
                            } else {
                                foreach ($decode as $item) {
                                    echo $item. "<br/>";
                                }
                            }



                        if ($bill->dept == 'Records') {
                          //  echo "Folder/Consultation";
/*                            if ($bill->total_price == 1000){
                                echo "Folder";
                            } else if ($bill->total_price = 800){
                                echo "Consultation";
                            }*/
                        }

/*                        if (!empty(Prescribed::find_costed_bill_by_dept($bill->id))) {
                            $presc = Prescribed::find_costed_bill_by_dept($bill->id);
                            foreach ($presc as $revenue) {
                                echo $revenue->product_name . "<br/>";
                            }
                        }

                        if (!empty(TestRequest::find_costed_bill_by_dept($bill->id))) {
                            $tests = TestRequest::find_costed_bill_by_dept($bill->id);
                            foreach ($tests as $test) {
                                echo $test->test_name . "<br/>";
                            }
                        }

                        if (!empty(ScanRequest::find_costed_bill_by_dept($bill->id))) {
                            $scan = ScanRequest::find_costed_bill_by_dept($bill->id);
                            foreach ($scan as $test) {
                                echo $test->test_name . "<br/>";
                            }
                        }*/

                        ?>
                    </td>
                </tr>
                <tr class="table-active">
                    <th> Amount</th>
                    <td id="account_balance"><?php echo "₦$bill->total_price" ?></td>
                </tr>
                <tr class="table-warning">
                    <th> Date</th>
                    <td id="created"><?php $d_date = date('d/m/Y h:i a', strtotime($bill->date));
                        echo $d_date ?></td>
                </tr>
            </table>
            <div class="">
                <button type="button" class="btn btn-success" data-toggle="modal"
                        data-pre_reg-id="<?php echo $bill->id ?>"
                        data-target="#authenticate">Authenticate
                </button>
            </div>



<!-- Remove Class fade in first div -->
        <div class="modal" id="authenticate" tabindex="-1" role="dialog" aria-labelledby="deposit to account">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
<!--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>-->
                       <!-- <h4 class="title" id="defaultModalLabel">Modal title</h4>-->
                        <h4 class="title" id="myModalLabel">Authenticate Receipt</h4>
                    </div>
                    <form action="search.php?id=<?php echo $bill->id; ?>" method="post">
                        <div class="modal-body">
                            <div id="modalMessages"></div>

                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-md-8"> Payment Reference </label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="auth_code"
                                               placeholder="Enter Payment Reference" required>

                                        <input type="hidden" name="bill_id" value="<?php echo $bill->id; ?>"/>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="paymentReceipt"> Proceed</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php } } else { ?>
        <div class="col-md-7">
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                Bill Number not found in database
            </div>
        </div>
    <?php }
} ?>












