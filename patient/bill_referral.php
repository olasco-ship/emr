<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

$referral = Referrals::find_by_id($_GET['id']);

$patient = Patient::find_by_id($referral->patient_id);


if(is_post()) {
    if (isset($_POST['generate'])) {

        if (empty($_POST['first_name'])) {
            $errFirstName = "First Name is Required";
            $errMessage .= $errFirstName . "<br/>";
        } else {
            $first_name = test_input($_POST['first_name']);
            if (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
                $errFirstName = "Only letters and white space are allowed for First Name";
                $errMessage .= $errFirstName . "<br/>";
            }
        }

        if (empty($_POST['last_name'])) {
            $errLastName = "Last Name is Required";
            $errMessage .= $errLastName . "<br/>";
        } else {
            $last_name = test_input($_POST['last_name']);
            if (!preg_match("/^[a-zA-Z]*$/", $last_name)) {
                $errLastName = "Only letters and white space are allowed for Last Name";
                $errMessage .= $errLastName . "<br/>";
            }
        }



    //    $patient->id = test_input($_POST['pat_id']);

        $pat = Patient::find_by_id($patient->id);

        $patientAge = getAge($pat->dob);

        $revenue = $_POST['revenue'];

        $test = Test::find_by_id($revenue);




        $last_bills = Bill::find_last_id();
        $last_bill = 0;
        foreach ($last_bills as $last_bill) {
            $last_bill->bill_number;
        }


        $last_date = substr($last_bill->bill_number, 0, 6);

        $system_num = "01";
        $bill_numb = 0;
        $date = date("ymd");
        if (empty($last_bill->bill_number)) {
            $n = 1;
            $n = sprintf('%04u', $n);
            $bill_numb = $date . $system_num . $n;
        } else {
            if ($last_date != $date) {
                $n = 1;
                $n = sprintf('%04u', $n);
                $bill_numb = $date . $system_num . $n;
            } else {
                $last_bill->bill_number++;
                $bill_numb = $last_bill->bill_number;
            }
        }

        $today = date_only(strftime("%Y-%m-%d %H:%M:%S", time()));


        $bill                  = new Bill();
        $bill->sync            = "off";
        $bill->bill_number     = $bill_numb;
        $bill->exempted_by     = "";
        $bill->payment_type    = "";
        $bill->patient_id      = $patient->id;
        $bill->first_name      = $patient->first_name;
        $bill->last_name       = $patient->last_name;
        $bill->revenues        = $test->name;

        if ($patientAge <= 15) {
            $bill->total_price  = $test->price/2;
        } else {
            $bill->total_price  = $test->price;
        }
        //    $bill->total_price     = "800";
        $bill->quantity        = 1;
        $bill->cost_by         = $user->full_name();
        $bill->revenue_officer = $user->full_name();
        $bill->status          = "COSTED";
        $bill->receipt         = "";
        $bill->dept            = "Records";
        $bill->date_only       = $today;
        $bill->date            = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($bill->save()){
            $ref          = Referrals::find_patient_open($patient->id);
            $ref->status  = "BILLED";
            $ref->bill_id = $bill->id;
            $ref->save();
            $done         = TRUE;
            redirect_to("print.php?id=$bill->id");
            //  redirect_to("print_visit.php?id=$bill->id");
            /*
            $pre_reg                 = new PreRegistration();
            $pre_reg->bill_id        = $bill->id;
            $pre_reg->bill_number    = $bill_numb;
            $pre_reg->first_name     = $first_name;
            $pre_reg->last_name      = $last_name;
            $pre_reg->patient_id     = "";
            $pre_reg->revenue        = "Folder";
            $pre_reg->amount         = "1000";
            $pre_reg->auth_code      = "";
            $pre_reg->officer        = "Revenue Officer";
            $pre_reg->status         = "OPEN";
            $pre_reg->date           = strftime("%Y-%m-%d %H:%M:%S", time());
            if ($pre_reg->save()){
                $done = TRUE;
                //   $session->message("Patient Folder has been created.");
                redirect_to("print.php?id=$bill->id");
            }
            */
        }
    }



}



require('../layout/header.php');
?>



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> BILLING </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Bill Patient</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        <div class="bh_chart hidden-xs">
                            <div class="float-left m-r-15">
                                <small>Visitors</small>
                                <h6 class="mb-0 mt-1"><i class="icon-user"></i> 1,784</h6>
                            </div>
                            <span class="bh_visitors float-right">2,5,1,8,3,6,7,5</span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Visits</small>
                                <h6 class="mb-0 mt-1"><i class="icon-globe"></i> 325</h6>
                            </div>
                            <span class="bh_visits float-right">10,8,9,3,5,8,5</span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Chats</small>
                                <h6 class="mb-0 mt-1"><i class="icon-bubbles"></i> 13</h6>
                            </div>
                            <span class="bh_chats float-right">1,8,5,6,2,4,3,2</span>
                        </div>
                    </div>
                </div>
            </div>

            <a href="referrals.php" style="font-size: large">&laquo; Back</a>

            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 ">
                    <div class="card">
                        <div class="header">
                            <h2>Bill Referred Patient</h2>
                        </div>
                        <div class="body">
                            <form action="" method="post">
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="First Name"  name="first_name"
                                                   value="<?php echo $patient->first_name ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Surname" name="last_name"
                                                   value="<?php echo $patient->last_name ?>" readonly>
                                        </div>
                                    </div>

                                    <!--                                <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" name="revenue" value="Folder" placeholder="Folder" readonly>
                                                                        </div>
                                                                    </div>-->

                                    <!--                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Patient's Age" name="age" id="age"
                                               value="<?php /*echo $age */?>" required>
                                    </div>
                                </div>-->

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <select class="form-control"  id="revenue" name="revenue" required>
                                                <option value="">--Select Revenue--</option>
                                                <?php
                                                $revs = Test::find_by_revenueHead_id(5);
                                                foreach ($revs as $find) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" name="generate" class="btn btn-outline-primary">Generate Bill</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>



            </div>







        </div>
    </div>




<?php

require('../layout/footer.php');