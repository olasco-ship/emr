<?php

require_once("../includes/initialize.php");

$user = User::find_by_id($session->user_id);


if (is_post()) {

    $folder_number = $_POST['folder_number'];

    $patient = Patient::find_by_number($folder_number);


    if (isset($_POST['paymentReceipt'])) {

        $id = $_POST['bill_id'];

        $payment_ref = $_POST['auth_code'];

        $payment_bill                  = Bill::find_by_id($id);
        $payment_bill->status          = "PAID";
        $payment_bill->receipt         = $payment_ref;
        $payment_bill->payment_officer = $user->full_name();

        echo $payment_bill->id . "<br/>";


        if ($payment_bill->save()) {

            if (!empty(Referrals::find_by_billed($payment_bill->id))) {
                $ref = Referrals::find_by_billed($payment_bill->id);
                foreach ($ref as $r) {
                    $r->receipt = $payment_ref;
                    $r->status  = "PAID";
                    $r->save();
                }
                $session->message("Payment Reference has been added");
                redirect_to("new.php");
            }

            if (!empty(TestRequest::find_by_billed($payment_bill->id))) {
                $test         =  TestRequest::find_by_billed($payment_bill->id);
                $labService = LabServices::find_by_bill_id($payment_bill->id);
                $labService->status = "CLEARED";
                $labService->save();
                foreach ($test as $t) {
                    $t->receipt = $payment_ref;
                    $t->status  = "PAID";
                    $t->save();
                }
                $session->message("Payment Reference has been added");
                redirect_to("new.php");
            }

            if (!empty(ScanRequest::find_by_billed($payment_bill->id))) {
                $scan         =  ScanRequest::find_by_billed($payment_bill->id);
                $radioService =  RadioServices::find_by_bill_id($payment_bill->id);
                $radioService->status = "CLEARED";
                $radioService->save();
                foreach ($scan as $s) {
                    $s->receipt = $payment_ref;
                    $s->status  = "PAID";
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
                foreach ($drugs as $d) {
                    $d->receipt = $payment_ref;
                    $d->status  = "PAID";
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






    if (empty($patient)) {  ?>

        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Folder Number not found in database,
            Click <a href="../patient/create_temp.php" target="_blank">Here</a> to register patient
        </div>
    <?php    } else {   ?>

 

            <form id="basic-form" method="post" action="">
                <div class="card">
                    <div class="header">
                        <h2>Basic Information </h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">

                            <div class="col-sm-3">
                                <?php
                                $mr = "";
                                $mrs = "";
                                $master = "";
                                $miss = "";
                                $titl = "";
                                if ($patient->title == "Mr") {
                                    $mr = "checked='checked'";
                                    $mrs = "";
                                    $master = "";
                                    $miss = "";
                                    $titl = "";
                                } else if ($patient->title == "Mrs") {
                                    $mrs = "checked='checked'";
                                } else if ($patient->title == "Master") {
                                    $master = "checked='checked'";
                                } else if ($patient->title == "Miss") {
                                    $miss = "checked='checked'";
                                }
                                ?>
                                <div class="form-group">
                                    <label> Title </label>
                                    <br>
                                    <label class="fancy-radio">
                                        <input type="radio" name="title" value="Mr" required="" data-parsley-errors-container="#error-radio" <?= $mr ?>>
                                        <span><i></i>Mr</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="title" value="Mrs" <?= $mrs ?>>
                                        <span><i></i>Mrs</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="title" value="Master" <?= $master ?>>
                                        <span><i></i>Master</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="title" value="Miss" <?= $miss ?>>
                                        <span><i></i>Miss</span>
                                    </label>
                                    <p id="error-radio"></p>
                                </div>

                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="first_name" value="<?php echo $patient->first_name ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="last_name" value="<?php echo $patient->last_name ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Hospital Number (Old)</label>
                                    <input type="text" class="form-control" name="hosp_number" value="<?php echo $patient->folder_number ?>" required>
                                </div>
                            </div>

                        </div>


                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Date Of Birth</label>
                                    <input type="text" class="form-control" name="dob" id="dob" placeholder="dd-mm-yyyy" value="<?php echo $patient->dob ?>" required>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label> Gender </label>
                                    <br>
                                    <label class="fancy-radio">
                                        <input type="radio" name="gender" value="Male" required="" data-parsley-errors-container="#error-radio" <?= ($patient->gender == "Male") ? "checked='checked'" : '' ?> />
                                        <span><i></i>Male</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="gender" value="Female" <?= ($patient->gender == "Female") ? "checked='checked'" : '' ?> />
                                        <span><i></i>Female</span>
                                    </label>
                                    <p id="error-radio"></p>
                                </div>
                            </div>


                            <div class="col-sm-5">

                                <div class="form-group">
                                    <label> Marital Status </label>
                                    <br />
                                    <label class="fancy-radio">
                                        <input type="radio" name="marital_status" value="Single" required="" data-parsley-errors-container="#error-radio" <?= ($patient->marital_status == "Single") ? "checked='checked'" : '' ?> />
                                        <span><i></i>Single</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="marital_status" value="Married" <?= ($patient->marital_status == "Married") ? "checked='checked'" : '' ?> />
                                        <span><i></i>Married</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="marital_status" value="Separated" <?= ($patient->marital_status == "Separated") ? "checked='checked'" : '' ?> />
                                        <span><i></i>Separated</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="marital_status" value="Divorced" <?= ($patient->marital_status == "Divorced") ? "checked='checked'" : '' ?> />
                                        <span><i></i>Divorced</span>
                                    </label>
                                    <p id="error-radio"></p>
                                </div>
                            </div>

                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label> Nationality </label>
                                    <br />
                                    <label class="fancy-radio">
                                        <input type="radio" name="nationality" value="Nigerian" required data-parsley-errors-container="#error-radio" <?= ($patient->nationality == "Nigerian") ? "checked='checked'" : '' ?> />
                                        <span><i></i>Nigerian</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="nationality" value="Others" <?= ($patient->nationality == "Others") ? "checked='checked'" : '' ?> />
                                        <span><i></i>Others</span>
                                    </label>
                                    <p id="error-radio"></p>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Specify for Others</label>
                                    <input type="text" class="form-control" name="other_nation" value="<?php echo $patient->other_nation ?>">
                                </div>
                            </div>



                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label"> State Of Origin</label>
                                    <select class="form-control" name="state" required>
                                        <option value="" selected="selected">- Select State-</option>
                                        <option <?php echo ($patient->state == 'Abia') ? 'selected ="TRUE"' : ''; ?>value="Abia">Abia</option>
                                        <option <?php echo ($patient->state == 'Adamawa') ? 'selected ="TRUE"' : ''; ?>value="Adamawa">Adamawa</option>
                                        <option <?php echo ($patient->state == 'AkwaIbom') ? 'selected ="TRUE"' : ''; ?>value="AkwaIbom">AkwaIbom</option>
                                        <option <?php echo ($patient->state == 'Anambra') ? 'selected ="TRUE"' : ''; ?>value="Anambra">Anambra</option>
                                        <option <?php echo ($patient->state == 'Bauchi') ? 'selected ="TRUE"' : ''; ?>value="Bauchi">Bauchi</option>
                                        <option <?php echo ($patient->state == 'Bayelsa') ? 'selected ="TRUE"' : ''; ?>value="Bayelsa">Bayelsa</option>
                                        <option <?php echo ($patient->state == 'Benue') ? 'selected ="TRUE"' : ''; ?>value="Benue">Benue</option>
                                        <option <?php echo ($patient->state == 'Borno') ? 'selected ="TRUE"' : ''; ?>value="Borno">Borno</option>
                                        <option <?php echo ($patient->state == 'Cross River') ? 'selected ="TRUE"' : ''; ?>value="Cross River">Cross River</option>
                                        <option <?php echo ($patient->state == 'Delta') ? 'selected ="TRUE"' : ''; ?>value="Delta">Delta</option>
                                        <option <?php echo ($patient->state == 'Ebonyi') ? 'selected ="TRUE"' : ''; ?>value="Ebonyi">Ebonyi</option>
                                        <option <?php echo ($patient->state == 'Edo') ? 'selected ="TRUE"' : ''; ?>value="Edo">Edo</option>
                                        <option <?php echo ($patient->state == 'Ekiti') ? 'selected ="TRUE"' : ''; ?>value="Ekiti">Ekiti</option>
                                        <option <?php echo ($patient->state == 'Enugu') ? 'selected ="TRUE"' : ''; ?>value="Enugu">Enugu</option>
                                        <option <?php echo ($patient->state == 'FCT') ? 'selected ="TRUE"' : ''; ?>value="FCT">FCT</option>
                                        <option <?php echo ($patient->state == 'Gombe') ? 'selected ="TRUE"' : ''; ?>value="Gombe">Gombe</option>
                                        <option <?php echo ($patient->state == 'Imo') ? 'selected ="TRUE"' : ''; ?>value="Imo">Imo</option>
                                        <option <?php echo ($patient->state == 'Jigawa') ? 'selected ="TRUE"' : ''; ?>value="Jigawa">Jigawa</option>
                                        <option <?php echo ($patient->state == 'Kaduna') ? 'selected ="TRUE"' : ''; ?>value="Kaduna">Kaduna</option>
                                        <option <?php echo ($patient->state == 'Kano') ? 'selected ="TRUE"' : ''; ?>value="Kano">Kano</option>
                                        <option <?php echo ($patient->state == 'Katsina') ? 'selected ="TRUE"' : ''; ?>value="Katsina">Katsina</option>
                                        <option <?php echo ($patient->state == 'Kebbi') ? 'selected ="TRUE"' : ''; ?>value="Kebbi">Kebbi</option>
                                        <option <?php echo ($patient->state == 'Kogi') ? 'selected ="TRUE"' : ''; ?>value="Kogi">Kogi</option>
                                        <option <?php echo ($patient->state == 'Kwara') ? 'selected ="TRUE"' : ''; ?>value="Kwara">Kwara</option>
                                        <option <?php echo ($patient->state == 'Lagos') ? 'selected ="TRUE"' : ''; ?>value="Lagos">Lagos</option>
                                        <option <?php echo ($patient->state == 'Nasarawa') ? 'selected ="TRUE"' : ''; ?>value="Nasarawa">Nasarawa</option>
                                        <option <?php echo ($patient->state == 'Niger') ? 'selected ="TRUE"' : ''; ?>value="Niger">Niger</option>
                                        <option <?php echo ($patient->state == 'Ogun') ? 'selected ="TRUE"' : ''; ?>value="Ogun">Ogun</option>
                                        <option <?php echo ($patient->state == 'Ondo') ? 'selected ="TRUE"' : ''; ?>value="Ondo">Ondo</option>
                                        <option <?php echo ($patient->state == 'Osun') ? 'selected ="TRUE"' : ''; ?>value="Osun">Osun</option>
                                        <option <?php echo ($patient->state == 'Oyo') ? 'selected ="TRUE"' : ''; ?>value="Oyo">Oyo</option>
                                        <option <?php echo ($patient->state == 'Plateau') ? 'selected ="TRUE"' : ''; ?>value="Plateau">Plateau</option>
                                        <option <?php echo ($patient->state == 'Rivers') ? 'selected ="TRUE"' : ''; ?>value="Rivers">Rivers</option>
                                        <option <?php echo ($patient->state == 'Sokoto') ? 'selected ="TRUE"' : ''; ?>value="Sokoto">Sokoto</option>
                                        <option <?php echo ($patient->state == 'Taraba') ? 'selected ="TRUE"' : ''; ?>value="Taraba">Taraba</option>
                                        <option <?php echo ($patient->state == 'Yobe') ? 'selected ="TRUE"' : ''; ?>value="Yobe">Yobe</option>
                                        <option <?php echo ($patient->state == 'Zamfara') ? 'selected ="TRUE"' : ''; ?>value="Zamfara">Zamfara</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>LGA</label>
                                    <input type="text" class="form-control" name="lga" value="<?php echo $patient->lga ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Occupation</label>
                                    <input type="text" class="form-control" name="occupation" value="<?php echo $patient->occupation ?>">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Contact Address</label>
                                    <textarea class="form-control" name="address" rows="3" cols="10" required><?php echo $patient->address ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" name="phone_number" required value="<?php echo $patient->phone_number ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $patient->email ?>">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label> Religion </label>
                                    <br />
                                    <label class="fancy-radio">
                                        <input type="radio" name="religion" value="Muslim" required data-parsley-errors-container="#error-radio" <?= ($patient->religion == "Muslim") ? "checked='checked'" : '' ?>>
                                        <span><i></i>Muslim</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="religion" value="Christian" <?= ($patient->religion == "Christian") ? "checked='checked'" : '' ?>>
                                        <span><i></i>Christian</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="religion" value="Others" <?= ($patient->religion == "Others") ? "checked='checked'" : '' ?>>
                                        <span><i></i>Others</span>
                                    </label>
                                    <p id="error-radio"></p>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Language Spoken</label>
                                    <br />
                                    <label class="fancy-checkbox">
                                        <input type="checkbox" name="English" value="English" <?= ($patient->english == "English") ? "checked='checked'" : '' ?>>
                                        <span>English</span>
                                    </label>
                                    <label class="fancy-checkbox">
                                        <input type="checkbox" name="Pidgin" value="Pidgin" <?= ($patient->pidgin == "Pidgin") ? "checked='checked'" : '' ?>>
                                        <span>Pidgin</span>
                                    </label>
                                    <label class="fancy-checkbox">
                                        <input type="checkbox" name="Hausa" value="Hausa" <?= ($patient->hausa == "Hausa") ? "checked='checked'" : '' ?>>
                                        <span>Hausa</span>
                                    </label>
                                    <label class="fancy-checkbox">
                                        <input type="checkbox" name="Igbo" value="Igbo" <?= ($patient->igbo == "Igbo") ? "checked='checked'" : '' ?>>
                                        <span>Igbo</span>
                                    </label>
                                    <label class="fancy-checkbox">
                                        <input type="checkbox" name="Yoruba" value="Yoruba" <?= ($patient->yoruba == "Yoruba") ? "checked='checked'" : '' ?>>
                                        <span>Yoruba</span>
                                    </label>
                                    <p id="error-checkbox"></p>
                                </div>

                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Name Of Next Of Kin</label>
                                    <input type="text" class="form-control" name="next_kin" value="<?php echo $patient->next_kin_surname ?>">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Relationship To Next Of Kin</label>
                                    <input type="text" class="form-control" name="relation_next_kin" value="<?php echo $patient->next_kin_relationship ?>">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label> Address Of Next Of Kin</label>
                                    <textarea class="form-control" name="address_next_kin" rows="3" cols="10"><?php echo $patient->next_kin_address ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Phone No. Of Next Of Kin</label>
                                    <input type="text" class="form-control" name="phone_number_next_kin" value="<?php echo $patient->next_kin_phone ?>">
                                </div>
                            </div>
                            <div class="col-sm-4">



                            </div>
                            <div class="col-sm-4">

                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-4">



                            </div>
                            <div class="col-sm-4">

                            </div>
                            <div class="col-sm-4">

                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <a href="admit.php?id=<?php echo $patient->id ?>" class="btn btn-primary">Admit this patient</a>
                                    <a href="discharge.php?id=<?php echo $patient->id ?>" class="btn btn-danger"> Discharge this patient </a>   
                                    <a href="history.php?id=<?php echo $patient->id ?>" class="btn btn-success"> View Admission History </a>                  
                                </div>                         
                            </div>
                        

                        </div>

                    </div>
                </div>
            </form>



        <!--

        <div class="">
            <button type="button" class="btn btn-success" data-toggle="modal" data-pre_reg-id="<?php echo $bill->id ?>" data-target="#authenticate">Authenticate
            </button>
        </div>
        <div class="modal" id="authenticate" tabindex="-1" role="dialog" aria-labelledby="deposit to account">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="title" id="myModalLabel">Authenticate Receipt</h4>
                    </div>
                    <form action="search.php?id=<?php echo $bill->id; ?>" method="post">
                        <div class="modal-body">
                            <div id="modalMessages"></div>

                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-md-8"> Payment Reference </label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="auth_code" placeholder="Enter Payment Reference" required>

                                        <input type="hidden" name="bill_id" value="<?php echo $bill->id; ?>" />

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

        -->

<?php
    }
}
?>