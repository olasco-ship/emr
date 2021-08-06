<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);



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

        $revenue = $_POST['revenue'];
        $age     = $_POST['age'];
        $test = Test::find_by_id($revenue);

        echo $test->price . "<br/>";


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


        $bill                 = new Bill();
        $bill->sync           = "off";
        $bill->bill_number    = $bill_numb;
        $bill->exempted_by    = "";
        $bill->payment_type   = "";
        $bill->patient_id     = 0;
        $bill->first_name     = $first_name;
        $bill->last_name      = $last_name;
        $bill->revenues       = $test->name;
        if ($age == 1) {
            $bill->total_price  = $test->price/2;
        } else {
            $bill->total_price  = $test->price;
        }
        $bill->quantity         = 1;
        $bill->cost_by          = $user->full_name();
        $bill->revenue_officer  = $user->full_name();
        $bill->status           = "billed";   //"COSTED";
        $bill->receipt          = "";
        $bill->dept             = "Records";
        $bill->date_only        = $today;
        $bill->date             = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($bill->save()) {
            $done = TRUE;
            redirect_to("print.php?id=$bill->id");

        }

    }

    if (isset($_POST['generate_existing_bill'])) {

        if (empty($_POST['first_name'])) {
            $errFirstName = "First Name is Required";
            $errMessage .= $errFirstName . "<br/>";
        } else {
            $patient->first_name = test_input($_POST['first_name']);
            if (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
                $errFirstName = "Only letters and white space are allowed for First Name";
                $errMessage .= $errFirstName . "<br/>";
            }
        }

        if (empty($_POST['last_name'])) {
            $errLastName = "Last Name is Required";
            $errMessage .= $errLastName . "<br/>";
        } else {
            $patient->last_name = test_input($_POST['last_name']);
            if (!preg_match("/^[a-zA-Z]*$/", $last_name)) {
                $errLastName = "Only letters and white space are allowed for Last Name";
                $errMessage .= $errLastName . "<br/>";
            }
        }

        $patient->id = test_input($_POST['pat_id']);
        $pat         = Patient::find_by_id($patient->id);
        $patientAge  = getAge($pat->dob);
        $revenue     = $_POST['revenue'];

        $test       = Test::find_by_id($revenue);




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
        $bill->quantity          = 1;
        $bill->cost_by           = $user->full_name();
        $bill->revenue_officer   = $user->full_name();
        $bill->status            = "billed";  //"COSTED";
        $bill->receipt           = "";
        $bill->dept              = "Records";
        $bill->date_only         = $today;
        $bill->date              = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($bill->save()){
            $done = TRUE;
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

                </div>
            </div>

           <a href="home.php" style="font-size: large">&laquo; Back</a>

            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 ">
                    <div class="card">
                        <div class="header">
                            <h2>Bill New Patient</h2>
                        </div>
                        <div class="body">
                            <form action="" method="post">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="First Name"  name="first_name"
                                               value="<?php echo $first_name ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Surname" name="last_name"
                                               value="<?php echo $last_name ?>" required>
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
                                        <select class="form-control"  id="age" name="age" required>
                                            <option value="">--Select Age Range--</option>
                                            <option value="1">0-14years</option>
                                            <option value="2">15years above</option>

                                        </select>
                                    </div>
                                </div>




<!--                                <div class="col-sm-12" id="revenueItems">
                                    <div class="form-group" id="revenueItems">

                                    </div>
                                </div>-->


<!--                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="revenue" value="₦800" readonly>
                                    </div>
                                </div>-->

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

                <div class="col-lg-6 col-md-6 col-sm-6 ">
                    <div class="card">
                        <div class="header">
                            <h2>Bill Existing Patient</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <form  method="post" action="">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="folder_number" name="folder_number"
                                               placeholder="Folder Number"  required >
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" name="search" class="btn btn-outline-primary">Search Record</button>
                                    </div>
                                </div>
                                </form>






                            </div>


                            <?php

                            if(is_post()) {
                                if (isset($_POST['search'])) {
                                    $folder_number = $_POST['folder_number'];
                                    $patient = Patient::find_by_number($folder_number);

                                    if (!empty($patient)){ ?>

                                        <form action="" method="post">

                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control"  name="first_name" value="<?php echo $patient->first_name ?>"
                                                       required readonly>
                                            </div>

                                            <div class="form-group">
                                                <label>Surname </label>
                                                <input type="text" class="form-control" name="last_name" value="<?php echo $patient->last_name ?>"

                                                       required readonly>
                                            </div>


                                            <div class="form-group">
                                                <label> Select Revenue </label>
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

                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="pat_id" value="<?php echo $patient->id ?>"  >
                                            </div>


<!--                                            <div class="form-group">
                                                <label> Revenue </label>
                                                <input type="text" class="form-control" name="revenue" value="Consultation" readonly>
                                                <input type="hidden" class="form-control" name="pat_id" value="<?php /*echo $patient->id */?>"  >
                                            </div>-->

<!--                                            <div class="form-group">
                                                <label> Amount </label>
                                                <input type="text" class="form-control" name="revenue" value="₦800" readonly>
                                            </div>-->

                                            <button type="submit" name="generate_existing_bill" class="btn btn-lg btn-primary">Generate Bill</button>
                                        </form>

                                    <?php } else {  ?>

                                        <div class="alert alert-warning alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                        aria-hidden="true">&times;</span></button>
                                            Folder Number <?php echo $folder_number ?>  does not exist!
                                        </div>


                                    <?php } }
                            }
                            ?>



                        </div>
                    </div>




                </div>

            </div>







        </div>
    </div>




<?php

require('../layout/footer.php');