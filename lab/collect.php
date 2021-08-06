<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);

$bill = Bill::find_by_id($_GET['id']);
$testRequest = TestRequest::find_by_bill_id($bill->id);
$waiting     = WaitingList::find_by_id($testRequest->waiting_list_id);

$clinic = Clinic::find_by_id($waiting->clinic_id);
$sub_clinic = SubClinic::find_by_id($waiting->sub_clinic_id);

$user = User::find_by_id($session->user_id);



if(is_post()) {



    $date_col = strftime("%Y-%m-%d %H:%M:%S", time());

    $time_col = strftime("%H:%M:%S", time());

    $dept   = test_input($_POST['department']);

    $urine = test_input($_POST['Urine']);

    $blood = test_input($_POST['Blood']);

    $stool = test_input($_POST['Stool']);

    $swab  = test_input($_POST['Swab']);

    $body_aspirate = test_input($_POST['BodyAspirate']);

    $sputum = test_input($_POST['Sputum']);

    $semen = test_input($_POST['Semen']);

    $specimen = array();
    if (isset($urine) and !empty($urine)){
        $specimen[] = $urine;
    }
    if (isset($blood) and !empty($blood)){
        $specimen[] = $blood;
    }
    if (isset($stool) and !empty($stool)){
        $specimen[] = $stool;
    }
    if (isset($swab) and !empty($swab)){
        $specimen[] = $swab;
    }
    if (isset($body_aspirate) and !empty($body_aspirate)){
        $specimen[] = $body_aspirate;
    }
    if (isset($sputum) and !empty($sputum)){
        $specimen[] = $sputum;
    }
    if (isset($semen) and !empty($semen)){
        $specimen[] = $semen;
    }

    $json = json_encode($specimen);
 //   print_r($json); exit;

    $result                  = new Result();
    $result->exempted_by     = "";
    $result->sync            = "off";
    $result->lab_no          = 0;
    $result->bill_id         = $bill->id;
    $result->patient_id      = $bill->patient_id;
    $result->waiting_list_id = $waiting->id;
    $result->test_request_id = $testRequest->id;
    $result->ward            = "";
    $result->clinic          = $sub_clinic->name;
    $result->doctor          = $testRequest->consultant;
    $result->consultant      = "";
    $result->test            = $bill->revenues;
    $result->specimen        = $json;
    $result->date_col        = $date_col;
    $result->date_rec        = "";
    $result->time_col        = $time_col;
    $result->time_rec        = "";
    $result->sample_col_by   = $user->full_name();
    $result->sample_rec_by   = "";
    $result->doctor_note     = $testRequest->doc_note;
    $result->scientist_note  = "";
    $result->path_note       = "";
    $result->dept            = $dept;
    $result->resultData      = "";
    $result->scientist       = "";
    $result->pathologist     = "";
    $result->status          = "REQUEST";
    $result->date            =  "";
    if ($result->save()){
        $bill->status = 'CLEARED';
        $bill->save();
        $session->message("Patient's sample has been received.");
        redirect_to('sample_col.php');
    }





}



require('../layout/header.php');
?>



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> LABORATORY </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">Sample Collection</li>
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

            <a href="../lab/sample_col.php" style="font-size: large">&laquo; Back</a>

            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 ">
                    <div class="card">
                        <div class="header">
                            <h2>  Patient Details</h2>
                        </div>
                        <div class="body">


                            <table class="table table">
                                <tr class="table">
                                    <th> Patient </th>
                                    <td id="account_number"><?php echo $bill->first_name ." ". $bill->last_name  ?></td>
                                </tr>
                                <tr class="table">
                                    <th>Age</th>
                                    <td id="account_name"><?php
                                        $patient = Patient::find_by_id($bill->patient_id);
                                        echo getAge($patient->dob) ."years"  ?>
                                    </td>
                                </tr>
                                <tr class="table">
                                    <th> Gender</th>
                                    <td id="account_balance">
                                        <?php
                                          echo $patient->gender
                                        ?>
                                    </td>
                                </tr>
                                <tr class="table">
                                    <th> Clinic </th>
                                    <td id="account_balance"><?php echo $clinic->name ."<b> - </b>". $sub_clinic->name; ?></td>
                                </tr>

                                <tr class="table">
                                    <th> Doctor </th>
                                    <td id="account_balance"><?php echo $testRequest->consultant ?></td>
                                </tr>
                                <tr class="table">
                                    <th> Investigation(s) </th>
                                    <td id="account_balance"><?php
                                        $decode = json_decode($bill->revenues);
                                        if (empty($decode)){
                                            echo $bill->revenues;
                                        } else {
                                            foreach ($decode as $item) {
                                                echo $item. "<br/>";
                                            }
                                        }
                                        ?></td>
                                </tr>
                                <tr class="table">
                                    <th> Date Of Request</th>
                                    <td id="created"><?php $d_date = date('d/m/Y h:i a', strtotime($testRequest->date ));
                                        echo $d_date ?></td>
                                </tr>
                            </table>



                        </div>
                    </div>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 ">
                    <div class="card">
                        <div class="header">
                            <h2>Sample Collection</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <form  method="post" action="">
                                    <div class="col-sm-12">
                                        <b>Select Laboratory Unit</b>
                                        <select class="form-control" name="department" required >
                                            <option value="" selected="selected" >--Select Laboratory--</option>
                                            <option value='Haematology'>Haematology</option>
                                            <option value='Chemical Pathology'>Chemical Pathology</option>
                                            <option value='Microbiology'>Microbiology</option>
                                            <option value='Histology'>Histology</option>
                                        </select>
                                    </div>

                                   <!-- <div class="col-sm-12">
                                        <b>Time Sample Taken (12 hour)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon-clock"></i></span>
                                            </div>
                                            <input type="time" class="form-control" name="time_col" placeholder="Ex: 11:59 pm">
                                        </div>
                                     </div>-->

                                    <br/>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label> Nature Of Specimen </label>
                                            <br/>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="Urine" value="Urine" >
                                                <span>Urine</span>
                                            </label>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="Blood" value="Blood">
                                                <span>Blood</span>
                                            </label>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="Stool" value="Stool">
                                                <span>Stool</span>
                                            </label>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="Swab" value="Swab">
                                                <span>Swab</span>
                                            </label>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="BodyAspirate" value="Body Aspirate">
                                                <span>Body Aspirate</span>
                                            </label>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="Sputum" value="Sputum">
                                                <span>Sputum</span>
                                            </label>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="Semen" value="Semen">
                                                <span>Semen</span>
                                            </label>
                                            <!--<p id="error-checkbox"></p>-->
                                        </div>

                                    </div>


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit"  class="btn btn-outline-primary">Send Sample For Analysis</button>
                                        </div>
                                    </div>
                                </form>






                            </div>



                        </div>
                    </div>




                </div>

            </div>







        </div>
    </div>




<?php

require('../layout/footer.php');