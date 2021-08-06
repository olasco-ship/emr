<?php


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$request = ScanRequest::find_by_id($_GET['id']);
$booking = ServiceBooking::find_by_scanRequest_id($request->id);
$patient = Patient::find_by_id($request->patient_id);

$user = User::find_by_id($session->user_id);



if (is_post()) {

    $bookingDate = new DateTime($_POST['bookingDate']);
    $bookingDate = date_format($bookingDate, 'Y-m-d');

    $reasons = $_POST['reasons'];

    $booking->booked_date = $bookingDate;
    $booking->reasons     = $reasons;
    if ($booking->save()){
        redirect_to("bookings.php");
    }

    

}





require('../layout/header.php');
?>




<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                        Re-scheduling Radiology Request </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Radiology/Ultrasound</li>
                        <li class="breadcrumb-item active">Re-Scheduling</li>
                    </ul>
                </div>
            </div>
        </div>



        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-6 ">
                <div class="card">
                    <div class="header">
                        <h2> Patient Details</h2>
                    </div>
                    <div class="body">

                        <form method="post" action="">

                            <table class="table table">
                                <tr class="table">
                                    <th> Patient </th>
                                    <td id="account_number">
                                        <?php
                                        if (!empty($patient)) {
                                            echo $patient->first_name . " " . $patient->last_name;
                                        } else {
                                            $labWalkIn = LabWalkIn::find_by_id($testRequest->labWalkIn_id);
                                            echo $labWalkIn->first_name . " " . $labWalkIn->last_name;
                                        }

                                        ?>
                                    </td>
                                </tr>
                                <tr class="table">
                                    <th>Age</th>
                                    <td id="account_name"><?php
                                                            if (!empty($patient)) {
                                                                echo getAge($patient->dob) . "years";
                                                            } else {
                                                                $labWalkIn = LabWalkIn::find_by_id($testRequest->labWalkIn_id);
                                                                echo $labWalkIn->age . "years";
                                                            }
                                                            ?>
                                    </td>
                                </tr>
                                <tr class="table">
                                    <th> Gender</th>
                                    <td id="account_balance">
                                        <?php
                                        if (!empty($patient)) {
                                            echo $patient->gender;
                                        } else {
                                            $labWalkIn = LabWalkIn::find_by_id($testRequest->labWalkIn_id);
                                            echo $labWalkIn->gender;
                                        }

                                        ?>
                                    </td>
                                </tr>
                                <tr class="table">
                                    <th> Clinic / Ward </th>
                                    <td id="account_balance">
                                        <?php
                                        if ($request->ward_id == 0) {
                                            $waiting = WaitingList::find_by_id($request->waiting_list_id);
                                            $subClinic = SubClinic::find_by_id($waiting->sub_clinic_id);
                                            echo $subClinic->name;
                                        } else {
                                            $ward = Wards::find_by_id($request->ward_id);
                                            echo $ward->ward_number;
                                        }

                                        ?>

                                    </td>
                                </tr>

                                <tr class="table">
                                    <th> Doctor </th>
                                    <td id="account_balance"><?php echo $request->consultant ?></td>
                                </tr>
                                <tr class="table">
                                    <th> Investigation(s) </th>
                                    <td id="account_balance"><?php
                                                                $eachScan = EachScan::find_all_requests($request->id);
                                                                foreach ($eachScan as $item) {
                                                                    echo $item->scan_name . "<br/>";
                                                                }

                                                                ?></td>
                                </tr>
                                <tr class="table">
                                    <th> Date Of Request</th>
                                    <td id="created"><?php $d_date = date('d/m/Y h:i a', strtotime($request->date));
                                                        echo $d_date ?></td>
                                </tr>

                                <tr class="table">
                                    <th> Booked Date </th>
                                    <td id="created"><?php $d_date = date('d/m/Y', strtotime($booking->booked_date));
                                                        echo $d_date ?></td>
                                </tr>


                                <tr class="table">
                                    <th>
                                        <!-- Date Of --> Next Appointment</th>
                                    <td id="created">
                                        <?php

                                        if ($request->waiting_list_id != 0) {
                                            //  $waiting = WaitingList::find_by_id($request->waiting_list_id);
                                            $app = Appointment::find_by_waiting_list_id($request->waiting_list_id);
                                            if (!empty($app)) {
                                                echo $app->next_app;
                                            } else {
                                                echo "NA";
                                            }
                                        } else if ($request->ref_adm_id != 0) {
                                            $app = Appointment::find_by_ref_adm_id($request->ref_adm_id);
                                            if (!empty($app)) {
                                                echo $app->next_app;
                                            } else {
                                                echo "NA";
                                            }
                                        } else {
                                            echo "NA";
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <tr class="table">
                                    <th>  Re-schedule Date </th>
                                    <td> <input class="form-control" id="startDate" name="bookingDate" placeholder="" required /> </td>
                                </tr>

                                <tr class="table">
                                    <th> Reason For Re-scheduling </th>
                                    <td> <textarea class='form-control' rows='2' cols='70' placeholder='Reasons For Re-scheduling' name='reasons' required></textarea> </td>

                                </tr>


                            </table>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-primary"> Re-Schedule </button>
                                </div>
                            </div>

                        </form>


                    </div>
                </div>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 ">

            </div>

        </div>



    </div>
</div>










<?php

require('../layout/footer.php');
