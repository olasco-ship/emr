<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/17/2019
 * Time: 4:43 PM
 */


require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$bill = Bill::find_by_id($_GET['id']);
$patient = Patient::find_by_id($bill->patient_id);

$user = User::find_by_id($session->user_id);



require('../layout/header.php');
?>






    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                            Lab Request Forms </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Laboratory</li>
                            <li class="breadcrumb-item active">Forms</li>
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



            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">
                        <div class="header">





                            <ul class="header-dropdown">
                                <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Weekly">W</a></li>
                                <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Monthly">M</a></li>
                                <li><a class="tab_btn active" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Yearly">Y</a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="container">


                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="../lab2/sample_analysis.php">Back</a>

                                        <div class="table-responsive">
                                            <!--<h4><?php /*echo $patient->full_name() */?></h4>-->
                                            <table class="table table">
                                                <tbody>
                                                <tr class="active">
                                                    <th>Patient</th>
                                                    <td> <?php echo $patient->full_name()  ?></td>
                                                </tr>
                                                <tr class="active">
                                                    <th>Clinical Details</th>
                                                    <td> <?php echo $result->full_name()  ?></td>
                                                </tr>
                                                <tr class="active">
                                                    <th>Birthdate</th>
                                                    <td> <?php /*$d_date = date('d-M-Y', strtotime($patient->dob));
                                                        echo $d_date */?></td>
                                                </tr>
                                                <tr class="active">
                                                    <th>Gender</th>
                                                    <td><?php /*echo $patient->gender */?></td>
                                                </tr>
                                                <tr class="active">
                                                    <th> Age </th>
                                                    <td> <?php /*echo getAge($patient->dob) . 'years' */?></td>
                                                </tr>
                                                <tr class="active">
                                                    <th> Investigation Required </th>
                                                    <td>

                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Patient</span>
                                            </div>
                                            <input type="text" class="form-control" value="" placeholder="First Name">
                                        </div>

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Patient</span>
                                            </div>
                                            <input type="text" class="form-control" value="" placeholder="First Name">
                                        </div>



                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6">

                                        <dl class="dl-horizontal">

                                            <dt>
                                                <b> Patient</b>

                                            </dt>
                                            <dd>
                                                <input class="form-control" style="width: 300px;" name="patient_name"
                                                       value="<?php echo $patient_name; ?>"
                                                       placeholder="Surname, Other Names"/>
                                            </dd>


                                            <dt>

                                            </dt>
                                            <dd>
                                                <b>Clinical Details</b>
                                                <textarea class="form-control" cols="2" rows="2" name="clinical"
                                                ><?php echo $clinical; ?></textarea>

                                            </dd>

                                            <dt>
                                                Specimen
                                            </dt>
                                            <dd>
                                                <input class="form-control"  style="width: 300px;" value="<?php echo $specimen; ?>" name="specimen"/>
                                            </dd>

                                            <!--
                    <dt>
                        CONSULTANT
                    </dt>
                    <dd>
                        <input class="form-control"  style="width: 300px;" value="<?php echo $consultant; ?>" name="consultant"/ >

                    </dd>





                    <dt>
                        DATE COLLECTED
                    </dt>
                    <dd>
                        <input class="form-control"  style="width: 300px;" id="col_date" value="<?php echo $date_col; ?>" name="date_col"/>

                    </dd>


                    <dt>
                        TIME COLLECTED
                    </dt>
                    <dd>
                        <input class="form-control"  style="width: 300px;" id="col_time" value="<?php echo $time_col; ?>"  name="time_col"/>
                    </dd>


                    <dt>
                        DATE RECEIVED
                    </dt>
                    <dd>
                        <input class="form-control"  style="width: 300px;" id="rec_dated" value="<?php echo $date_rec; ?>"  name="date_rec"/>
                    </dd>


                    <dt>
                        TIME RECEIVED
                    </dt>
                    <dd>
                        <input class="form-control"  style="width: 300px;" id="rec_time" value="<?php echo $time_rec; ?>"  name="time_rec"/>
                    </dd>


                    <dt>

                    </dt>
                    <dd>
                        <b>INVESTIGATION (TEST) REQUIRED</b>
                        <textarea class="form-control"  cols="4" rows="2"
                                  name="test"><?php echo $test; ?></textarea>
                    </dd>

                    -->

                                            <dt>
                                                Test
                                            </dt>
                                            <dd>
                                                <input class="form-control" required style="width: 300px;" value="<?php echo $test; ?>" name="test"/ >

                                            </dd>



                                        </dl>

                                    </div>
                                    <div class="col-md-6">

                                        <dl class="dl-horizontal">

                                            <dt>
                                                Lab. No
                                            </dt>
                                            <dd>
                                                <input class="form-control"  style="width: 300px;" value="<?php echo $lab_no; ?>" name="lab_no"/>

                                            </dd>

                                            <dt>
                                                RRN
                                            </dt>
                                            <dd>
                                                <input class="form-control" required placeholder="RRN/AuthCode" value="<?php echo $auth_code; ?>"  style="width: 300px;" name="auth_code"/>
                                            </dd>

                                            <dt>
                                                Age
                                            </dt>
                                            <dd>
                                                <input class="form-control"  style="width: 300px;" value="<?php echo $age; ?>" name="age"/>
                                            </dd>


                                            <dt>
                                                Sex
                                            </dt>
                                            <dd>
                                                <!--   <input class="form-control" style="width: 350px;" name="sex"/> -->
                                                <select class="form-control" style="width: 300px;" name="sex">
                                                    <option value=""></option>
                                                    <option value="Female">Female</option>
                                                    <option value="Male">Male</option>
                                                </select>
                                            </dd>

                                            <dt>
                                                No. of Test
                                            </dt>
                                            <dd>
                                                <input class="form-control" type="number"  style="width: 300px;" id="test_no" value="<?php echo $test_no; ?>"  name="test_no"/>
                                            </dd>

                                            <dt>
                                                Hosp. No.
                                            </dt>
                                            <dd>
                                                <input class="form-control"  style="width: 300px;" value="<?php echo $hosp_no; ?>"
                                                       name="hosp_no"/>
                                            </dd>

                                            <dt>
                                                Ward/Clinic
                                            </dt>
                                            <dd>
                                                <input class="form-control"  style="width: 300px;" value="<?php echo $ward; ?>"
                                                       name="ward"/>
                                            </dd>


                                            <dt>
                                                Doctor
                                            </dt>
                                            <dd>
                                                <input class="form-control"  style="width: 300px;" value="<?php echo $doctor; ?>"
                                                       name="doctor"/>
                                            </dd>

                                            <!--
                    <dt>
                        Override Code
                    </dt>
                    <dd>
                        <input class="form-control" type="password"  value="<?php // echo $override_code; ?>"  style="width: 300px;" name="override_code"/>
                    </dd>

                    <dt>
                        Date Examined
                    </dt>
                    <dd>
                        <input class="form-control"  style="width: 300px;" id="rec_date" value="<?php echo $date_rec; ?>"  name="date_rec"/>
                    </dd>

                    -->










                                        </dl>

                                    </div>
                                </div>





                                <form action="" method="post">
                                    <div id="accordion">

                                        <div class="card">
                                            <div class="card-header">
                                                <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                                    Haematology
                                                </a>
                                            </div>
                                            <div id="collapseOne" class="collapse" data-parent="#accordion">
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <td></td>
                                                                        <td align="center"><b>RESULT</b></td>
                                                                        <td><b>UNIT</b></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>PCV</td>
                                                                        <td>

                                                                                <input class="form-control" readonly
                                                                                       type="text">

                                                                        </td>
                                                                        <td>
                                                                            %
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>MCH</td>
                                                                        <td>
                                                                            <input class="form-control" name="mch"
                                                                                   value="<?php echo $mch; ?>"
                                                                                   type="text">
                                                                        </td>
                                                                        <td> pg</td>
                                                                    </tr>

                                                                    <!--
                                                        <tr>
                                                            <td>MCH</td>
                                                            <td>
                                                                <?php /*
                                                                if (in_array('MCH', $selectedTest)) { ?>
                                                                    <input class="form-control" name="mch"
                                                                           value="<?php echo $mch; ?>"
                                                                           type="text">
                                                                <?php } else { ?>
                                                                    <input class="form-control" readonly
                                                                           type="text">
                                                                <?php } */ ?>
                                                            </td>
                                                            <td> pg</td>
                                                        </tr>
                                                        -->



                                                                    <tr>
                                                                        <td>MCHC</td>
                                                                        <td><input class="form-control" name="mchc"
                                                                                   value="<?php echo $mchc; ?>"
                                                                                   type="text">
                                                                        </td>
                                                                        <td>g/dl</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>MCV</td>
                                                                        <td><input class="form-control" name="mcv"
                                                                                   value="<?php echo $mcv; ?>"
                                                                                   type="text"></td>
                                                                        <td>fL</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Retics</td>
                                                                        <td><input class="form-control" name="retics"
                                                                                   value="<?php echo $retics; ?>"
                                                                                   type="text"></td>
                                                                        <td>%</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Retics Index</td>
                                                                        <td><input class="form-control" name="retics_index"
                                                                                   value="<?php echo $retics_index; ?>"
                                                                                   type="text"></td>
                                                                        <td>%</td>
                                                                    </tr>


                                                                    <tr>
                                                                        <td>Hb</td>
                                                                        <td><input class="form-control" name="hb"
                                                                                   value="<?php echo $hb; ?>"
                                                                                   type="text"></td>
                                                                        <td>
                                                                            g/dl
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>WBC</td>
                                                                        <td><input class="form-control" name="wbc"
                                                                                   value="<?php echo $wbc; ?>"
                                                                                   type="text"></td>
                                                                        <td>x 10^9/L</td>
                                                                    <tr>
                                                                        <td>Platelet</td>
                                                                        <td><input class="form-control" name="platelet"
                                                                                   value="<?php echo $platelet; ?>"
                                                                                   type="text"></td>
                                                                        <td>x 10^9/L</td>

                                                                    </tr>


                                                                    <tr>
                                                                        <td>Hb genotype</td>
                                                                        <td><input class="form-control" name="hb_genotype"
                                                                                   value="<?php echo $hb_genotype; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>


                                                                    <tr>
                                                                        <td>ESR</td>
                                                                        <td><input class="form-control" name="esr"
                                                                                   value="<?php echo $esr; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="3"><b>FILM APPEARANCE</b></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Anisocytosis</td>
                                                                        <td><input class="form-control" name="ani"
                                                                                   value="<?php echo $ani; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Poikilocytosis</td>
                                                                        <td><input class="form-control" name="poikil"
                                                                                   value="<?php echo $poikil; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Polychromasia</td>
                                                                        <td><input class="form-control" name="poly"
                                                                                   value="<?php echo $poly; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Macrosytosis</td>
                                                                        <td><input class="form-control" name="macro"
                                                                                   value="<?php echo $macro; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Microcytosis</td>
                                                                        <td><input class="form-control" name="micro"
                                                                                   value="<?php echo $micro; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Hypochromla</td>
                                                                        <td><input class="form-control" name="hypo"
                                                                                   value="<?php echo $hypo; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Sickle Cells</td>
                                                                        <td><input class="form-control" name="sickle_cells"
                                                                                   value="<?php echo $sickle_cells; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Target Cells</td>
                                                                        <td><input class="form-control" name="target_cells"
                                                                                   value="<?php echo $target_cells; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Spherocytes</td>
                                                                        <td><input class="form-control" name="spherocytes"
                                                                                   value="<?php echo $spherocytes; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Nucleated RBC</td>
                                                                        <td><input class="form-control" name="nucleated"
                                                                                   value="<?php echo $nucleated; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Inclusion bodies</td>
                                                                        <td><input class="form-control" name="inclusion"
                                                                                   value="<?php echo $inclusion; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Others</td>
                                                                        <td><input class="form-control" name="film_others"
                                                                                   value="<?php echo $film_others; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="3"><b>DIFFERENTIAL COUNT</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Blast</td>
                                                                        <td><input class="form-control" name="blast"
                                                                                   value="<?php echo $blast; ?>"
                                                                                   type="text">
                                                                        </td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Promyelocyre</td>
                                                                        <td><input class="form-control" name="promyelocyre"
                                                                                   value="<?php echo $promyelocyre; ?>"
                                                                                   type="text">
                                                                        </td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Myel+metamyelocyte</td>
                                                                        <td><input class="form-control" name="myel"
                                                                                   value="<?php echo $myel; ?>"
                                                                                   type="text">
                                                                        </td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Neutophil</td>
                                                                        <td><input class="form-control" name="neutrophil"
                                                                                   value="<?php echo $neutrophil; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td> Eosinophil</td>
                                                                        <td><input class="form-control" name="eosinophil"
                                                                                   value="<?php echo $eosinophil; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td> Basophil</td>
                                                                        <td><input class="form-control" name="basophil"
                                                                                   value="<?php echo $basophil; ?>" type="text">
                                                                        </td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td> Lymphocyte</td>
                                                                        <td><input class="form-control" name="lymphocyte"
                                                                                   value="<?php echo $lymphocyte; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td> Monocyte</td>
                                                                        <td><input class="form-control" name="monocyte"
                                                                                   value="<?php echo $monocyte; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td> Others</td>
                                                                        <td><input class="form-control" name="diff_others"
                                                                                   value="<?php echo $diff_others; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td> PT Test</td>
                                                                        <td><input class="form-control" name="pt"
                                                                                   value="<?php echo $pt; ?>"
                                                                                   type="text"></td>
                                                                        <td>
                                                                            <table>
                                                                                <tr>
                                                                                    <td>Control</td>
                                                                                    <td><input class="form-control"
                                                                                               style="width: 100px"
                                                                                               name="pt_control"
                                                                                               value="<?php echo $pt_control; ?>"
                                                                                               type="text"></td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td> INR</td>
                                                                        <td><input class="form-control" name="inr"
                                                                                   value="<?php echo $inr; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td> PTT Test</td>
                                                                        <td><input class="form-control" name="ptt"
                                                                                   value="<?php echo $ptt; ?>"
                                                                                   type="text"></td>
                                                                        <td>
                                                                            <table>
                                                                                <tr>
                                                                                    <td>Control</td>
                                                                                    <td><input class="form-control"
                                                                                               style="width: 100px"
                                                                                               name="ptt_control"
                                                                                               value="<?php echo $ptt_control; ?>"
                                                                                               type="text"></td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>


                                                                </table>

                                                            </div>

                                                        </div>


                                                        <div class="col-md-5">

                                                            <h4>Notes</h4><textarea rows="10" cols="50" class="form-control"
                                                                                    name="notes"><?php echo $notes; ?></textarea>
                                                            <!--
                <b>Haematologist's Comment</b><textarea rows="10" cols="50" class="form-control"
                                                readonly name="haem_com" ><?php echo $haem_com; ?></textarea>
                                                -->

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                                                    Chemical Pathology
                                                </a>
                                            </div>
                                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                <div class="card-body">

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="table-responsive">

                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <td></td>
                                                                        <td><b>RESULT</b></td>
                                                                        <td><b>REFERENCE</b></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>RENAL FUNCTION TEST</b></td>
                                                                        <td><input class="form-control" name="rft"
                                                                                   value="<?php echo $rft; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding-left: 30px">SODIUM</td>
                                                                        <td><input class="form-control" name="sodium"
                                                                                   value="<?php echo $sodium; ?>"
                                                                                   type="text"></td>
                                                                        <td>133-150mmol/L</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding-left: 30px">POTASSIUM</td>
                                                                        <td><input class="form-control" name="potassium"
                                                                                   value="<?php echo $potassium; ?>"
                                                                                   type="text"></td>
                                                                        <td>3.5-5.0mmol/L</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px">BICARBONATE</td>
                                                                        <td><input class="form-control" name="bicarbonate"
                                                                                   value="<?php echo $bicarbonate; ?>"
                                                                                   type="text"></td>
                                                                        <td>18-32mmol/L</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px">CHLORIDE</td>
                                                                        <td><input class="form-control" name="chloride"
                                                                                   value="<?php echo $chloride; ?>"
                                                                                   type="text"></td>
                                                                        <td>96-110mmol/L</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px">CALCIUM</td>
                                                                        <td><input class="form-control" name="calcium"
                                                                                   value="<?php echo $calcium; ?>"
                                                                                   type="text"></td>
                                                                        <td>8.0 - 10.8mg/dL</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px">MAGNESSIUM</td>
                                                                        <td><input class="form-control" name="magnessium"
                                                                                   value="<?php echo $magnessium; ?>"
                                                                                   type="text"></td>
                                                                        <td>0.7 - 1.0mmol/L</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px">PHOSPHATE</td>
                                                                        <td><input class="form-control" name="phosphorus"
                                                                                   value="<?php echo $phosphorus; ?>"
                                                                                   type="text"></td>
                                                                        <td>2.7-4.5mg/dL</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px">UREA</td>
                                                                        <td><input class="form-control" name="urea" type="text">
                                                                        </td>
                                                                        <td>10-50mg/dl</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px">CREATININE</td>
                                                                        <td><input class="form-control" name="creatinine"
                                                                                   value="<?php echo $creatinine; ?>"
                                                                                   type="text"></td>
                                                                        <td>0.5-1.10mg/dl</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px">CREATININE CLEARANCE</td>
                                                                        <td><input class="form-control"
                                                                                   name="creatinine_clearance"
                                                                                   value="<?php echo $creatinine_clearance; ?>"
                                                                                   type="text"></td>
                                                                        <td>90 - 130 ml/min</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>URIC ACID</td>
                                                                        <td><input class="form-control" name="uric_acid"
                                                                                   value="<?php echo $uric_acid; ?>"
                                                                                   type="text"></td>
                                                                        <td>2.4-7mg/dl</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>FASTING GLUCOSE</td>
                                                                        <td><input class="form-control" name="fasting_glucose"
                                                                                   value="<?php echo $fasting_glucose; ?>"
                                                                                   type="text"></td>
                                                                        <td>76-110mg/dl</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>2HRS POST-PRANDIAL (2HPP)</td>
                                                                        <td><input class="form-control" name="hpp"
                                                                                   value="<?php echo $hpp; ?>"
                                                                                   type="text"></td>
                                                                        <td><180mg/dl</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>RANDOM GLUCOSE</td>
                                                                        <td><input class="form-control" name="random_glucose"
                                                                                   value="<?php echo $random_glucose; ?>"
                                                                                   type="text"></td>
                                                                        <td>76-150mg/dl</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b> OGTT. </b>(FBS)</td>
                                                                        <td><input class="form-control" name="ogtt"
                                                                                   value="<?php echo $ogtt; ?>"
                                                                                   type="text"></td>
                                                                        <td>76-110mg/dl</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding-left: 50px;">30 min</td>
                                                                        <td><input class="form-control" name="thirty_min"
                                                                                   value="<?php echo $thirty_min; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 50px;">1 HOUR</td>
                                                                        <td><input class="form-control" name="one_hour"
                                                                                   value="<?php echo $one_hour; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 50px;">1.5 HOUR</td>
                                                                        <td><input class="form-control" name="ninety_min"
                                                                                   value="<?php echo $ninety_min; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 50px;">2 HOURS</td>
                                                                        <td><input class="form-control" name="two_hours"
                                                                                   value="<?php echo $two_hours; ?>"
                                                                                   type="text"></td>
                                                                        <td>Up to 200mg/dl</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 50px;">3 HOURS</td>
                                                                        <td><input class="form-control" name="fasting"
                                                                                   value="<?php echo $fasting; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>GLYCATED HAEMOGLOBIN(hbA)</td>
                                                                        <td><input class="form-control" name="hba"
                                                                                   value="<?php echo $hbA; ?>"
                                                                                   type="text"></td>
                                                                        <td>5.7-6.4%</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>TOTAL PROTEIN</td>
                                                                        <td><input class="form-control" name="total_protein"
                                                                                   value="<?php echo $total_protein; ?>"
                                                                                   type="text"></td>
                                                                        <td>6.6-8.7g/dl</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>ALBUMIN</td>
                                                                        <td><input class="form-control" name="albumin"
                                                                                   value="<?php echo $albumin; ?>"
                                                                                   type="text"></td>
                                                                        <td>3.5-5.0g/dl</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>TOTAL BILIRUBIN</td>
                                                                        <td><input class="form-control" name="total_bilirubin"
                                                                                   value="<?php echo $total_bilirubin; ?>"
                                                                                   type="text"></td>
                                                                        <td>0-1.0mg/dl</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>CONJ. BILIRUBIN</td>
                                                                        <td><input class="form-control" name="conj_bilirubin"
                                                                                   value="<?php echo $conj_bilirubin; ?>"
                                                                                   type="text"></td>
                                                                        <td>0-0.25mg/dl</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>AST (SGOT)</td>
                                                                        <td><input class="form-control" name="ast"
                                                                                   value="<?php echo $ast; ?>"
                                                                                   type="text"></td>
                                                                        <td>0-37i.u/l</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>ALT (SGPT)</td>
                                                                        <td><input class="form-control" name="alt"
                                                                                   value="<?php echo $alt; ?>"
                                                                                   type="text"></td>
                                                                        <td>0-40U/L</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>ALK PHOSPHATASE</td>
                                                                        <td><input class="form-control" name="alk_phosphate"
                                                                                   value="<?php echo $alk_phosphate; ?>"
                                                                                   type="text"></td>
                                                                        <td>98-279iu/l</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td> ALBUMIN/CREATININE RATIO</td>
                                                                        <td><input class="form-control" name="albumin_ratio"
                                                                                   value="<?php echo $albumin_ratio; ?>"
                                                                                   type="text"></td>
                                                                        <td>30-300mg/g</td>
                                                                    </tr>


                                                                </table>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <div class="table-responsive">

                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <td></td>
                                                                        <td><b>RESULT</b></td>
                                                                        <td><b>REFERENCE</b></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>GAMMA G.T.</td>
                                                                        <td><input class="form-control" name="gamma_gt"
                                                                                   value="<?php echo $gamma_gt; ?>"
                                                                                   type="text"></td>
                                                                        <td>11 - 52</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>ACID PHOSPHATE</b></td>
                                                                        <td><input class="form-control" name="acid_phosphate"
                                                                                   value="<?php echo $acid_phosphate; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px">TOTAL</td>
                                                                        <td><input class="form-control" name="total"
                                                                                   value="<?php echo $total; ?>"
                                                                                   type="text"></td>
                                                                        <td>01-11U/L</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px">PROSTATIC</td>
                                                                        <td><input class="form-control" name="prostatic"
                                                                                   value="<?php echo $prostatic; ?>"
                                                                                   type="text"></td>
                                                                        <td>0.4U/L</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>CREATINE KINASE(CK-MB)</td>
                                                                        <td><input class="form-control" name="ck_mb"
                                                                                   value="<?php echo $ck_mb; ?>"
                                                                                   type="text"></td>
                                                                        <td>U/L</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>LACTATE DEHYDROGENASE(LDH)</td>
                                                                        <td><input class="form-control" name="ldh"
                                                                                   value="<?php echo $ldh; ?>"
                                                                                   type="text"></td>
                                                                        <td>U/L</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>AMYLASE</td>
                                                                        <td><input class="form-control" name="amylase"
                                                                                   value="<?php echo $amylase; ?>"
                                                                                   type="text"></td>
                                                                        <td>U/L</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>CHOLINESTERASE</td>
                                                                        <td><input class="form-control" name="cholinesterase"
                                                                                   value="<?php echo $cholinesterase; ?>"
                                                                                   type="text"></td>
                                                                        <td>U/L</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>LIPID PROFILE</b></td>
                                                                        <td><input class="form-control" type="text"></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px">TOTAL CHOLESTEROL</td>
                                                                        <td><input class="form-control" name="total_cholesterol"
                                                                                   value="<?php echo $total_cholesterol; ?>"
                                                                                   type="text"></td>
                                                                        <td>50-200mg/dL</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px">HDL-CHOLESTEROL</td>
                                                                        <td><input class="form-control" name="hdl_cholesterol"
                                                                                   value="<?php echo $hdl_cholesterol; ?>"
                                                                                   type="text"></td>
                                                                        <td>25-67mg/dl</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px">LDL-CHOLESTEROL</td>
                                                                        <td><input class="form-control" name="ldl_cholesterol"
                                                                                   value="<?php echo $ldl_cholesterol; ?>"
                                                                                   type="text"></td>
                                                                        <td>Up to 130mg/dl</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px">VLDL-CHOLESTEROL</td>
                                                                        <td><input class="form-control" name="vldl_cholesterol"
                                                                                   value="<?php echo $vldl_cholesterol; ?>"
                                                                                   type="text"></td>
                                                                        <td>10-40mg/dl</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px">TRIGLYCERIDES</td>
                                                                        <td><input class="form-control" name="triglycerides"
                                                                                   value="<?php echo $triglycerides; ?>"
                                                                                   type="text"></td>
                                                                        <td>50 - 200mg/dl</td>
                                                                    </tr>
                                                                    <!--       <tr>
                            <td>CSF</td>
                            <td><input class="form-control" name="csf" value="<?php // echo $csf; ?>"  type="text"></td>
                            <td></td>
                        </tr>   -->
                                                                    <tr>
                                                                        <td><b>CSF</b> <!-- GLUCOSE --></td>
                                                                        <td><input class="form-control" name="csf_glucose"
                                                                                   value="<?php echo $csf_glucose; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px"> GLUCOSE
                                                                            <!-- SUGAR --></td>
                                                                        <td><input class="form-control" name="csf_glucose"
                                                                                   value="<?php echo $csf_glucose; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px"> PROTEIN
                                                                            <!-- SUGAR --></td>
                                                                        <td><input class="form-control" name="csf_protein"
                                                                                   value="<?php echo $csf_protein; ?>"
                                                                                   type="text"></td>
                                                                        <td>55-110mg/dL</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px">CHLORIDE</td>
                                                                        <td><input class="form-control" name="csf_chloride"
                                                                                   value="<?php echo $csf_chloride; ?>"
                                                                                   type="text"></td>
                                                                        <td>96-110mg/L</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>URINE</b></td>
                                                                        <td><input class="form-control" name="urine"
                                                                                   value="<?php echo $urine; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px">ELECTROLYTES</td>
                                                                        <td><input class="form-control" name="electrolytes"
                                                                                   value="<?php echo $electrolytes; ?>"
                                                                                   type="text"></td>
                                                                        <td>mmol/l</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px">PROTEIN</td>
                                                                        <td><input class="form-control" name="protein"
                                                                                   value="<?php echo $protein; ?>"
                                                                                   type="text"></td>
                                                                        <td>mmol/l</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px"> 24HR URINE VOLUME</td>
                                                                        <td><input class="form-control" name="urine_volume"
                                                                                   value="<?php echo $urine_volume; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding-left: 30px"> 24HR URINE PROTEIN</td>
                                                                        <td><input class="form-control" name="urinary_protein"
                                                                                   value="<?php echo $urinary_protein; ?>"
                                                                                   type="text"></td>
                                                                        <td>0.05-0.1g/24hrs</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="padding-left: 30px"> 24HR URINE CREATININE
                                                                        </td>
                                                                        <td><input class="form-control"
                                                                                   name="urinary_creatinine"
                                                                                   value="<?php echo $urinary_creatinine; ?>"
                                                                                   type="text"></td>
                                                                        <td>1.0-1.5g/24hrs</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>OTHERS (indicate)</td>
                                                                        <td><input class="form-control" name="others"
                                                                                   value="<?php echo $others; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                    </tr>


                                                                </table>

                                                            </div>

                                                            <h4>Notes</h4>
                                                            <textarea rows="10" cols="50" class="form-control"
                                                                      name="notes"><?php echo $notes; ?></textarea>

                                                            <!--
                <h4>COMMENT</h4>
                <textarea rows="10" cols="50" class="form-control"
                                                        readonly name="comment" ><?php echo $comment; ?></textarea>
                                                        -->
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                                                    Microbiology
                                                </a>
                                            </div>
                                            <div id="collapseThree" class="collapse" data-parent="#accordion">
                                                <div class="card-body">

                                                    <div class="panel-body">

                                                        <dl class="dl-horizontal">
                                                            <dt>
                                                                Direct Gram
                                                            </dt>
                                                            <dd>
                <textarea class="form-control" cols="2" rows="2"
                          name="direct_gram"> <?php echo $direct_gram; ?></textarea>
                                                            </dd>
                                                        </dl>


                                                        <div class="row">
                                                            <h4 style="padding-left: 200px;">MACROSCOPY: </h4>
                                                            <br/>
                                                            <div class="col-md-6">
                                                                <dl class="dl-horizontal">

                                                                    <dt>
                                                                        Appearance
                                                                    </dt>
                                                                    <dd>
                                                                        <select class="form-control" style="width: 200px;"
                                                                                name="macroscopy">
                                                                            <option value=""></option>
                                                                            <option value="Clear">Clear</option>
                                                                            <option value="Colourless">Colourless</option>
                                                                            <option value="Turbid">Turbid</option>
                                                                            <option value="Slightly Turbid">Slightly Turbid</option>
                                                                            <option value="Colourless">Colourless</option>
                                                                            <option value="Blood Stained">Blood Stained</option>
                                                                            <option value="Soft formed">Soft Formed</option>
                                                                            <option value="Hard formed">Hard Formed</option>
                                                                            <option value="Watery">Watery</option>
                                                                            <option value="Salivary">Salivary</option>
                                                                            <option value="Mucosalivary">Mucosalivary</option>
                                                                            <option value="Purulent">Purulent</option>
                                                                            <option value="Mucoid">Mucoid</option>
                                                                        </select>

                                                                    </dd>
                                                            </div>

                                                            <div class="col-md-6">

                                                                <dl class="dl-horizontal">

                                                                    <dt>
                                                                        Colour
                                                                    </dt>
                                                                    <dd>
                                                                        <select class="form-control" style="width: 200px;"
                                                                                name="colour">
                                                                            <option value=""></option>
                                                                            <option value="Straw">Straw</option>
                                                                            <option value="Yellow">Yellow</option>
                                                                            <option value="Amber">Amber</option>
                                                                            <option value="Deep Amber">Deep Amber</option>
                                                                            <option value="Brownish">Brownish</option>
                                                                            <option value="Dark Brownish">Dark Brownish</option>
                                                                            <option value="Grayish">Grayish</option>
                                                                            <option value="Blood Stained">Blood Stained</option>
                                                                        </select>

                                                                    </dd>

                                                            </div>
                                                        </div>


                                                        <br/>

                                                        <dl class="dl-horizontal" style="padding-left: 600px;">

                                                            <dt>
                                                                Albumin
                                                            </dt>
                                                            <dd>
                                                                <!--    <input class="form-control" value="<?php // echo $albumin; ?>" style="width: 200px;" name="albumin"/>  -->
                                                                <select class="form-control" style="width: 200px;" name="albumin">
                                                                    <option value=""></option>
                                                                    <option value="Positive +">Positive +</option>
                                                                    <option value="Positive ++">Positive ++</option>
                                                                    <option value="Positive +++">Positive +++</option>
                                                                    <option value="Negative">Negative</option>

                                                                </select>

                                                            </dd>
                                                        </dl>


                                                        <h4 style="padding-left: 180px;">MICROSCOPY</h4><br/>


                                                        <div class="row">


                                                            <div class="col-md-4">

                                                                <dl class="dl-horizontal">

                                                                    <dt>
                                                                        Pus Cell/ Hpf
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" value="<?php echo $pus_cell; ?>"
                                                                               style="width: 200px;"
                                                                               name="pus_cell"/>


                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        Yeast Cells
                                                                    </dt>
                                                                    <dd>
                                                                        <!--    <input class="form-control" style="width: 200px;" value="<?php // echo $yeast_cell; ?>" name="yeast_cell"/>  -->
                                                                        <select class="form-control" style="width: 200px;"
                                                                                name="yeast_cell">
                                                                            <option value=""></option>
                                                                            <option value="NIL">NIL</option>
                                                                            <option value="+">+</option>
                                                                            <option value="++">++</option>
                                                                            <option value="+++">+++</option>
                                                                        </select>

                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        Cast: Hyaline
                                                                    </dt>
                                                                    <dd>
                                                                        <!--     <input class="form-control" style="width: 200px;" value="<?php // echo $hyaline; ?>" name="hyaline"/>   -->
                                                                        <select class="form-control" style="width: 200px;"
                                                                                name="hyaline">
                                                                            <option value=""></option>
                                                                            <option value="NIL">NIL</option>
                                                                            <option value="+">+</option>
                                                                            <option value="++">++</option>
                                                                            <option value="+++">+++</option>
                                                                        </select>

                                                                    </dd>
                                                                    <br/>

                                                                </dl>

                                                            </div>


                                                            <div class="col-md-4">

                                                                <dl class="dl-horizontal">

                                                                    <dt>
                                                                        Rbc/ Hpf
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" value="<?php echo $rbes; ?>"
                                                                               style="width: 200px;" name="rbes"/>


                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        Bacteria
                                                                    </dt>
                                                                    <dd>
                                                                        <!--  <input class="form-control" style="width: 200px;" value="<?php // echo $bacteria; ?>" name="bacteria"/>  -->
                                                                        <select class="form-control" style="width: 200px;"
                                                                                name="bacteria">
                                                                            <option value=""></option>
                                                                            <option value="NIL">NIL</option>
                                                                            <option value="+">+</option>
                                                                            <option value="++">++</option>
                                                                            <option value="+++">+++</option>
                                                                        </select>

                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        Granular
                                                                    </dt>
                                                                    <dd>
                                                                        <!--       <input class="form-control" style="width: 200px;" value="<?php // echo $granular; ?>" name="granular"/>  -->
                                                                        <select class="form-control" style="width: 200px;"
                                                                                name="granular">
                                                                            <option value=""></option>
                                                                            <option value="NIL">NIL</option>
                                                                            <option value="+">+</option>
                                                                            <option value="++">++</option>
                                                                            <option value="+++">+++</option>
                                                                        </select>

                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        Wbc / Cmm
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 200px;"
                                                                               value="<?php echo $wbc; ?>" name="wbc"/>

                                                                    </dd>
                                                                    <br/>


                                                                </dl>


                                                            </div>

                                                            <div class="col-md-4">

                                                                <dl class="dl-horizontal">

                                                                    <dt>
                                                                        Epith Cells/ Hpf
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control"
                                                                               value="<?php echo $epith_cell; ?>"
                                                                               style="width: 200px;"
                                                                               name="epith_cell"/>

                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        Xtals
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 200px;"
                                                                               value="<?php echo $xtals; ?>" name="xtals"/>

                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        Cellular
                                                                    </dt>
                                                                    <dd>
                                                                        <!--      <input class="form-control" style="width: 200px;" value="<?php echo $cellular; ?>" name="cellular"/>   -->
                                                                        <select class="form-control" style="width: 200px;"
                                                                                name="cellular">
                                                                            <option value=""></option>
                                                                            <option value="NIL">NIL</option>
                                                                            <option value="+">+</option>
                                                                            <option value="++">++</option>
                                                                            <option value="+++">+++</option>
                                                                        </select>

                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        %Polymorphs
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 200px;"
                                                                               value="<?php echo $polymorphs; ?>"
                                                                               name="polymorphs"/>

                                                                    </dd>
                                                                    <br/>
                                                                    <dt>
                                                                        %Lymphocyte
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 200px;"
                                                                               value="<?php echo $lymphoetes; ?>"
                                                                               name="lymphoetes"/>

                                                                    </dd>
                                                                    <br/>


                                                                </dl>


                                                            </div>

                                                        </div>

                                                        <dl class="dl-horizontal">
                                                            <dt>
                                                                Parasites
                                                            </dt>
                                                            <dd>
                                                                <input class="form-control" value="<?php echo $parasites; ?>"
                                                                       name="parasites"/>
                                                            </dd>
                                                        </dl>
                                                        <br/>

                                                        <div style="padding-left: 150px;">
                                                            <h4>CULTURE </h4>
                                                            <h4>ISOLATES</h4>
                                                        </div>

                                                        <dl class="dl-horizontal">

                                                            <dt>
                                                                1.
                                                            </dt>
                                                            <dd>
                                                                <input class="form-control" style="width: 1000px;"
                                                                       value="<?php echo $culture_isolates_1; ?>"
                                                                       name="culture_isolates_1"/>

                                                            </dd>
                                                            <dt>
                                                                2.
                                                            </dt>
                                                            <dd>
                                                                <input class="form-control" style="width: 1000px;"
                                                                       value="<?php echo $culture_isolates_2; ?>"
                                                                       name="culture_isolates_2"/>

                                                            </dd>
                                                            <dt>
                                                                3.
                                                            </dt>
                                                            <dd>
                                                                <input class="form-control" style="width: 1000px;"
                                                                       value="<?php echo $culture_isolates_3; ?>"
                                                                       name="culture_isolates_3"/>

                                                            </dd>

                                                            <dt>
                                                                4.
                                                            </dt>
                                                            <dd>
                                                                <input class="form-control" style="width: 1000px;"
                                                                       value="<?php echo $culture_isolates_4; ?>"
                                                                       name="culture_isolates_4"/>

                                                            </dd>
                                                            <dt>
                                                                5.
                                                            </dt>
                                                            <dd>
                                                                <input class="form-control" style="width: 1000px;"
                                                                       value="<?php echo $culture_isolates_5; ?>"
                                                                       name="culture_isolates_5"/>

                                                            </dd>
                                                        </dl>
                                                        <br/>

                                                        <table class="table table-bordered table-responsive">
                                                            <thead>
                                                            <tr>
                                                                <th></th>
                                                                <!--      <th>LYN</th>  -->
                                                                <th>PEN</th>
                                                                <!--       <th>OFL</th>  -->
                                                                <th>STR</th>
                                                                <!--       <th>CRX</th>  -->
                                                                <th>TET</th>
                                                                <!--       <th>GEN</th>  -->
                                                                <th>CHL</th>
                                                                <!--       <th>ERY</th>  -->
                                                                <th>ERY</th>
                                                                <!--       <th>AMC/AUG</th>  -->
                                                                <th>CXC</th>
                                                                <!--       <th>CAZ</th>  -->
                                                                <th>PEMB</th>
                                                                <!--       <th>CTR</th>  -->
                                                                <th>NAL</th>
                                                                <!--       <th>CXC</th>  -->
                                                                <th>GEN</th>
                                                                <!--       <th>CPR</th>  -->
                                                                <th>COL</th>
                                                                <!--       <th>PEF</th>   -->
                                                                <th>SEXT</th>
                                                                <!--        <th>AMP</th>  -->
                                                                <th>NITRO</th>
                                                                <!--       <th>NIT</th>  -->
                                                                <th>PY</th>
                                                                <th><input class="form-control"
                                                                           value="<?php echo $org_first_param; ?>"
                                                                           name="org_first_param"/></th>
                                                                <th><input class="form-control"
                                                                           value="<?php echo $org_second_param; ?>"
                                                                           name="org_second_param"/></th>
                                                                <th><input class="form-control"
                                                                           value="<?php echo $org_third_param; ?>"
                                                                           name="org_third_param"/></th>

                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>1.</td>
                                                                <td>
                                                                    <!--   <input class="form-control" style="width: 50px;" name="amc"/>   -->
                                                                    <select class="form-control" style="width: 60px;" name="amc">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!--     <input class="form-control" style="width: 50px;" name="cro"/>   -->
                                                                    <select class="form-control" style="width: 60px;" name="cro">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>

                                                                </td>
                                                                <td>
                                                                    <!--   <input class="form-control" style="width: 50px;" name="caz"/>   -->
                                                                    <select class="form-control" style="width: 60px;" name="caz">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>

                                                                </td>
                                                                <td>
                                                                    <!--      <input class="form-control" style="width: 50px;" name="d"/>    -->
                                                                    <select class="form-control" style="width: 60px;" name="d">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!--      <input class="form-control" style="width: 50px;" name="cpd"/>   -->
                                                                    <select class="form-control" style="width: 60px;" name="cpd">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!--    <input class="form-control" style="width: 50px;" name="fep"/>   -->
                                                                    <select class="form-control" style="width: 60px;" name="fep">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!--    <input class="form-control" style="width: 50px;" name="mem"/>   -->
                                                                    <select class="form-control" style="width: 60px;" name="mem">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;" name="e">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;" name="tzp">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;" name="amp">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;" name="le">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;" name="cn">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;" name="cxm">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="org_first">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>

                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="org_second">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="org_third">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>

                                                            </tr>


                                                            </tbody>
                                                            <tbody>
                                                            <tr>
                                                                <td>2.</td>
                                                                <td>
                                                                    <!--   <input class="form-control" style="width: 50px;" name="amc"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="amc_two">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!--     <input class="form-control" style="width: 50px;" name="cro"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="cro_two">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>

                                                                </td>
                                                                <td>
                                                                    <!--   <input class="form-control" style="width: 50px;" name="caz"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="caz_two">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>

                                                                </td>
                                                                <td>
                                                                    <!--      <input class="form-control" style="width: 50px;" name="d"/>    -->
                                                                    <select class="form-control" style="width: 60px;" name="d_two">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!--      <input class="form-control" style="width: 50px;" name="cpd"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="cpd_two">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!--    <input class="form-control" style="width: 50px;" name="fep"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="fep_two">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!--    <input class="form-control" style="width: 50px;" name="mem"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="mem_two">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;" name="e_two">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="tzp_two">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="amp_two">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;" name="le_two">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;" name="cn_two">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="cxm_two">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="org_first2">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>

                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="org_second2">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="org_third2">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>

                                                            </tr>


                                                            </tbody>

                                                            <tbody>
                                                            <tr>
                                                                <td>3.</td>
                                                                <td>
                                                                    <!--   <input class="form-control" style="width: 50px;" name="amc"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="amc_three">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!--     <input class="form-control" style="width: 50px;" name="cro"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="cro_three">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>

                                                                </td>
                                                                <td>
                                                                    <!--   <input class="form-control" style="width: 50px;" name="caz"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="caz_three">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>

                                                                </td>
                                                                <td>
                                                                    <!--      <input class="form-control" style="width: 50px;" name="d"/>    -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="d_three">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!--      <input class="form-control" style="width: 50px;" name="cpd"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="cpd_three">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!--    <input class="form-control" style="width: 50px;" name="fep"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="fep_three">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!--    <input class="form-control" style="width: 50px;" name="mem"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="mem_three">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="e_three">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="tzp_three">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="amp_three">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="le_three">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="cn_three">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="cxm_three">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="org_first3">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>

                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="org_second3">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="org_third3">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>


                                                            </tr>


                                                            </tbody>
                                                            <tbody>
                                                            <tr>
                                                                <td>4.</td>
                                                                <td>
                                                                    <!--   <input class="form-control" style="width: 50px;" name="amc"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="amc_four">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!--     <input class="form-control" style="width: 50px;" name="cro"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="cro_four">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>

                                                                </td>
                                                                <td>
                                                                    <!--   <input class="form-control" style="width: 50px;" name="caz"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="caz_four">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>

                                                                </td>
                                                                <td>
                                                                    <!--      <input class="form-control" style="width: 50px;" name="d"/>    -->
                                                                    <select class="form-control" style="width: 60px;" name="d_four">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!--      <input class="form-control" style="width: 50px;" name="cpd"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="cpd_four">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!--    <input class="form-control" style="width: 50px;" name="fep"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="fep_four">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!--    <input class="form-control" style="width: 50px;" name="mem"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="mem_four">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;" name="e_four">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="tzp_four">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="amp_four">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="le_four">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="cn_four">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="cxm_four">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="org_first4">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>

                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="org_second4">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="org_third4">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>

                                                            </tr>


                                                            </tbody>
                                                            <tbody>
                                                            <tr>
                                                                <td>5.</td>
                                                                <td>
                                                                    <!--   <input class="form-control" style="width: 50px;" name="amc"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="amc_five">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!--     <input class="form-control" style="width: 50px;" name="cro"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="cro_five">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>

                                                                </td>
                                                                <td>
                                                                    <!--   <input class="form-control" style="width: 50px;" name="caz"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="caz_five">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>

                                                                </td>
                                                                <td>
                                                                    <!--      <input class="form-control" style="width: 50px;" name="d"/>    -->
                                                                    <select class="form-control" style="width: 60px;" name="d_five">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!--      <input class="form-control" style="width: 50px;" name="cpd"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="cpd_five">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!--    <input class="form-control" style="width: 50px;" name="fep"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="fep_five">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <!--    <input class="form-control" style="width: 50px;" name="mem"/>   -->
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="mem_five">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;" name="e_five">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="tzp_five">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="amp_five">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="le_five">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="cn_five">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="cxm_five">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>

                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="org_first5">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>

                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="org_second5">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control" style="width: 60px;"
                                                                            name="org_third5">
                                                                        <option value=""></option>
                                                                        <option value="S+">S+</option>
                                                                        <option value="S++">S++</option>
                                                                        <option value="S+++">S+++</option>
                                                                        <option value="I">I</option>
                                                                        <option value="R">R</option>
                                                                    </select>
                                                                </td>

                                                            </tr>


                                                            </tbody>

                                                        </table>

                                                        <br/><br/>

                                                        <h3 style="padding-left: 380px;"> SEMEN ANALYSIS REPORT </h3>

                                                        <br/><br/>


                                                        <div class="row">

                                                            <div class="col-md-2">

                                                            </div>


                                                            <div class="col-md-6">

                                                                <dl class="dl-horizontal">

                                                                    <dt>
                                                                        Days of Abstinence
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               name="days_of_ab"
                                                                               value="<?php echo $days_of_ab; ?>"/>

                                                                    </dd>


                                                                    <dt>
                                                                        Mode Of Production
                                                                    </dt>
                                                                    <dd>

                                                                        <input class="form-control" style="width: 300px;"
                                                                               name="mode_of_prod"
                                                                               value="<?php echo $mode_of_prod; ?>"/>
                                                                    </dd>

                                                                    <!--         <dt>
                        Date Collected
                    </dt>
                    <dd>
                        <input class="form-control"  style="width: 300px;" id="col_date" value="<?php // echo $date_col; ?>"  name="date_col"/>
                    </dd>  -->


                                                                    <dt>
                                                                        Time Produced
                                                                    </dt>
                                                                    <dd>

                                                                        <input class="form-control" style="width: 300px;"
                                                                               id="pro_time" name="time_prod"
                                                                               value="<?php echo $time_prod; ?>"/>
                                                                    </dd>


                                                                    <!--             <dt>
                        Time Received
                    </dt>
                    <dd>
                        <input class="form-control"  style="width: 300px;" id="reci_time" name="time_rec" value="<?php // echo $time_rec; ?>" />
                    </dd>   -->

                                                                    <dt>
                                                                        Time Examined
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               id="time_ex" name="time_ex"
                                                                               value="<?php echo $time_ex; ?>"/>
                                                                    </dd>


                                                                    <dt>
                                                                        Volume
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               name="volume" value="<?php echo $volume; ?>"/>
                                                                    </dd>


                                                                    <dt>
                                                                        Colour
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               name="semen_colour"
                                                                               value="<?php echo $semen_colour; ?>"/>
                                                                    </dd>

                                                                    <dt>
                                                                        Viscosity
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               name="visc" value="<?php echo $visc; ?>"/>
                                                                    </dd>


                                                                    <dt>
                                                                        Liquefaction
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;" name="liq"
                                                                               value="<?php echo $liq; ?>"/>
                                                                    </dd>


                                                                    <dt>
                                                                        PH
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $ph; ?>" name="ph"/>
                                                                    </dd>

                                                                    <dt>
                                                                        Motility
                                                                    </dt>
                                                                    <dd>
                                                                        <dl class="dl-horizontal">

                                                                            <dt>
                                                                                %PROGRESSIVE
                                                                            </dt>
                                                                            <dd>
                                                                                <input class="form-control" style="width: 120px;"
                                                                                       name="prog"
                                                                                       value="<?php echo $prog; ?>"/>
                                                                            </dd>

                                                                            <dt>
                                                                                %NON-PROGRESSIVE
                                                                            </dt>
                                                                            <dd>
                                                                                <input class="form-control" style="width: 120px;"
                                                                                       name="non_prog"
                                                                                       value="<?php echo $non_prog; ?>"/>
                                                                            </dd>

                                                                            <dt>
                                                                                %IMMOBILE
                                                                            </dt>
                                                                            <dd>
                                                                                <input class="form-control" style="width: 120px;"
                                                                                       name="imm"
                                                                                       value="<?php echo $imm; ?>"/>
                                                                            </dd>


                                                                        </dl>
                                                                        <!--

                        <input class="form-control" style="width: 100px;" value="<?php echo $percent_motility; ?>"
                               name="percent_motility"/>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="%progressive" name="motility"> %PROGRESSIVE
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="%non progressive" name="motility"> %NON-PROGRESSIVE
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="%immobile" name="motility"> %IMMOBILE
                            </label>
                        </div>    -->

                                                                    </dd>

                                                                    <dt>
                                                                        Morphology
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $morphology; ?>"
                                                                               name="morphology"/>
                                                                    </dd>

                                                                    <dt>
                                                                        Microscopy Pus Gel
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $pus_gel; ?>"
                                                                               name="pus_gel"/>
                                                                    </dd>

                                                                    <dt>
                                                                        Epith Cell
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $semen_epith_cell; ?>"
                                                                               name="semen_epith_cell"/>
                                                                    </dd>

                                                                    <dt>
                                                                        RBC
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $rbc; ?>" name="rbc"/>
                                                                    </dd>

                                                                    <dt>
                                                                        Others
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $others; ?>" name="others"/>
                                                                    </dd>

                                                                    <dt>
                                                                        Sperm Conc.
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $sperm_conc; ?>"
                                                                               name="sperm_conc"/>
                                                                    </dd>

                                                                    <dt>
                                                                        Total Sperm Conc.
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $total_conc; ?>"
                                                                               name="total_conc"/>
                                                                    </dd>


                                                                </dl>

                                                            </div>

                                                            <div class="col-md-4">

                                                            </div>


                                                        </div>

                                                    </div>.

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <a class="card-link" data-toggle="collapse" href="#collapseFour">
                                                    Parasitology
                                                </a>
                                            </div>
                                            <div id="collapseFour" class="collapse" data-parent="#accordion">
                                                <div class="card-body">

                                                    <div class="panel-body">


                                                        <div class="row">


                                                            <div class="col-md-6">

                                                                <h4 style="padding-left: 180px;">MACROSCOPY: </h4>

                                                                <div style="padding-left: 320px;">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" value="hard formed"
                                                                                   name="macroscopy"> HARD FORMED
                                                                        </label>
                                                                    </div>
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" value="soft formed"
                                                                                   name="macroscopy"> SOFT FORMED
                                                                        </label>
                                                                    </div>
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" value="uniformed"
                                                                                   name="macroscopy"> UNIFORMED
                                                                        </label>
                                                                    </div>
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" value="watery" name="macroscopy">
                                                                            WATERY
                                                                        </label>
                                                                    </div>
                                                                </div>


                                                            </div>


                                                            <div class="col-md-6" style="padding-top: 30px; ">
                                                                <dl class="dl-horizontal">

                                                                    <dt>
                                                                        BLOOD
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" placeholder=""
                                                                               value="<?php echo $blood; ?>"
                                                                               style="width: 300px;" name="blood"/>
                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        MUCUS
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" placeholder=""
                                                                               value="<?php echo $mucus; ?>"
                                                                               style="width: 300px;" name="mucus"/>
                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        WORMS
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" placeholder=""
                                                                               value="<?php echo $worms; ?>"
                                                                               style="width: 300px;" name="worms"/>
                                                                    </dd>
                                                                    <br/>


                                                                </dl>

                                                            </div>

                                                        </div>
                                                        <br/>

                                                        <div class="row">


                                                            <div class="col-md-6">
                                                                <h4 style="padding-left: 180px;">MICROSCOPY - STOOL</h4><br/>
                                                                <dl class="dl-horizontal">


                                                                    <dt>
                                                                        PUS CELLS
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" placeholder=""
                                                                               value="<?php //echo $pus_cells; ?>"
                                                                               style="width: 300px;" name="pus_cells"/>

                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        RED BLOOD CELLS
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php //echo $red_blood_cells; ?>"
                                                                               name="red_blood_cells"/>

                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        STARCH GRANULES
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php // $starch_granules; ?>"
                                                                               name="starch_granules"/>

                                                                    </dd>
                                                                    <br/>


                                                                    <dt>
                                                                        OVA
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $ova; ?>"
                                                                               name="ova"/>

                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        CYSTS
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $cysts; ?>"
                                                                               name="cysts"/>

                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        OTHERS
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $others; ?>"
                                                                               name="others"/>

                                                                    </dd>
                                                                    <br/><br/>


                                                                </dl>

                                                                <h4 style="padding-left: 180px;">OCCULT BLOOD</h4><br/>
                                                                <dl class="dl-horizontal">

                                                                    <dt>
                                                                        COMMENT
                                                                    </dt>
                                                                    <dd>

                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $occult_blood_comment; ?>"
                                                                               name="occult_blood_comment"/>

                                                                    </dd>
                                                                    <br/>


                                                                </dl>

                                                            </div>


                                                            <div class="col-md-6">
                                                                <h4 style="padding-left: 180px;">BLOOD PARASITES</h4><br/>
                                                                <dl class="dl-horizontal">

                                                                    <dt>
                                                                        PLASMODIUM
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" placeholder=""
                                                                               value="<?php echo $plasmodium; ?>"
                                                                               style="width: 300px;" name="plasmodium"/>

                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        TRYPANOSOMES
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $trypanosomes; ?>"
                                                                               name="trypanosomes"/>

                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        SKIN SNIP
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $skin_snip; ?>"
                                                                               name="skin_snip"/>

                                                                    </dd>
                                                                    <br/>


                                                                    <dt>
                                                                        MICROFILARIA
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $microfilaria; ?>"
                                                                               name="microfilaria"/>

                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        PARASITES DENSITY
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $para_density; ?>"
                                                                               name="para_density"/>

                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        SPECIES
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $species; ?>"
                                                                               name="species"/>

                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        STAGES
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $stages; ?>"
                                                                               name="stages"/>

                                                                    </dd>
                                                                    <br/>


                                                                </dl>

                                                            </div>

                                                        </div>

                                                        <h4 style="padding-left: 180px;"><b>LABORATORY REPORT - URINE</b></h4>
                                                        <br/>


                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <dl class="dl-horizontal">

                                                                    <dt>
                                                                        Colour
                                                                    </dt>
                                                                    <dd>
                                                                        <!--        <input class="form-control" style="width: 300px;" value="<?php // echo $colour; ?> " name="colour"/>  -->
                                                                        <select class="form-control" style="width: 300px;"
                                                                                name="colour">
                                                                            <option value=""></option>
                                                                            <option value="Straw">Straw</option>
                                                                            <option value="Pale Amber">Pale Amber</option>
                                                                            <option value="Amber">Amber</option>
                                                                        </select>

                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        PH
                                                                    </dt>
                                                                    <dd>
                                                                        <!--   <input class="form-control" style="width: 300px;" value="<?php // echo $ph; ?>"  name="ph"/>  -->
                                                                        <select class="form-control" style="width: 300px;"
                                                                                name="ph">
                                                                            <option value=""></option>
                                                                            <option value="5.0">5.0</option>
                                                                            <option value="5.5">5.5</option>
                                                                            <option value="6.0">6.0</option>
                                                                            <option value="6.5">6.5</option>
                                                                            <option value="7.0">7.0</option>
                                                                            <option value="7.5">7.5</option>
                                                                            <option value="8.0">8.0</option>
                                                                            <option value="8.5">8.5</option>
                                                                            <option value="9.0">9.0</option>
                                                                        </select>

                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        Glucose
                                                                    </dt>
                                                                    <dd>
                                                                        <!--     <input class="form-control" style="width: 300px;" value="<?php // echo $glucose; ?>"    name="glucose"/> -->
                                                                        <select class="form-control" style="width: 300px;"
                                                                                name="glucose">
                                                                            <option value=""></option>
                                                                            <option value="Negative">Negative</option>
                                                                            <option value="+">+</option>
                                                                            <option value="++">++</option>
                                                                            <option value="+++">+++</option>
                                                                            <option value="++++">++++</option>
                                                                        </select>
                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        Ketones
                                                                    </dt>
                                                                    <dd>
                                                                        <!--   <input class="form-control" style="width: 300px;" value="<?php echo $ketones; ?>"   name="ketones"/>  -->
                                                                        <select class="form-control" style="width: 300px;"
                                                                                name="ketones">
                                                                            <option value=""></option>
                                                                            <option value="Negative">Negative</option>
                                                                            <option value="+">+</option>
                                                                            <option value="++">++</option>
                                                                            <option value="+++">+++</option>
                                                                            <option value="++++">++++</option>
                                                                        </select>
                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        Bilirubin
                                                                    </dt>
                                                                    <dd>
                                                                        <!--       <input class="form-control" style="width: 300px;" value="<?php echo $bilirubin; ?>"   name="bilirubin"/>  -->
                                                                        <select class="form-control" style="width: 300px;"
                                                                                name="bilirubin">
                                                                            <option value=""></option>
                                                                            <option value="Negative">Negative</option>
                                                                            <option value="+">+</option>
                                                                            <option value="++">++</option>
                                                                            <option value="+++">+++</option>
                                                                            <option value="++++">++++</option>
                                                                        </select>
                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        RBC / HPF
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $rbc; ?>" name="rbc"/>
                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        Crystals
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $crystals; ?>" name="crystals"/>
                                                                    </dd>
                                                                    <br/>


                                                                    <b>Ova of Schistosoma haematobium</b>

                                                                    <dd style="padding-left: 100px;">
                                                                        <!--       <input class="form-control" style="width: 200px;" value="<?php echo $haematobium; ?> "  name="haematobium"/>  -->
                                                                        <select class="form-control" style="width: 300px;"
                                                                                name="haematobium">
                                                                            <option value=""></option>
                                                                            <option value="NIL">NIL</option>
                                                                            <option value="+">+</option>
                                                                            <option value="++">++</option>
                                                                            <option value="+++">+++</option>
                                                                            <option value="++++">++++</option>
                                                                        </select>
                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        Yeast Cells
                                                                    </dt>
                                                                    <dd>
                                                                        <!--      <input class="form-control" style="width: 300px;" value="<?php // echo $yeast; ?>"   name="yeast"/>  -->
                                                                        <select class="form-control" style="width: 300px;"
                                                                                name="yeast">
                                                                            <option value=""></option>
                                                                            <option value="NIL">NIL</option>
                                                                            <option value="Numerous">Numerous</option>
                                                                            <option value="Profuse">Profuse</option>
                                                                            <option value="+">+</option>
                                                                            <option value="++">++</option>
                                                                            <option value="+++">+++</option>

                                                                        </select>
                                                                    </dd>
                                                                    <br/>


                                                                </dl>

                                                            </div>


                                                            <div class="col-md-6">

                                                                <dl class="dl-horizontal">

                                                                    <dt>
                                                                        Appearance
                                                                    </dt>
                                                                    <dd>
                                                                        <!--    <input class="form-control" style="width: 300px;" value=" <?php // echo $appearance; ?>"  name="appearance"/>  -->
                                                                        <select class="form-control" style="width: 300px;"
                                                                                name="appearance">
                                                                            <option value=""></option>
                                                                            <option value="Clear">Clear</option>
                                                                            <option value="Slightly Turbid">Slightly Turbid</option>
                                                                            <option value="Turbid">Turbid</option>
                                                                        </select>

                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        S. G
                                                                    </dt>
                                                                    <dd>
                                                                        <!--      <input class="form-control" style="width: 300px;" value="<?php // echo $sg; ?>"   name="sg"/>  -->
                                                                        <select class="form-control" style="width: 300px;"
                                                                                name="sg">
                                                                            <option value=""></option>
                                                                            <option value="1.000">1.000</option>
                                                                            <option value="1.005">1.005</option>
                                                                            <option value=" 1.010"> 1.010</option>
                                                                            <option value="1.015">1.015</option>
                                                                            <option value="1.020">1.020</option>
                                                                            <option value=" 1.025"> 1.025</option>
                                                                            <option value="1.030">1.030</option>
                                                                        </select>

                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        Albumin
                                                                    </dt>
                                                                    <dd>
                                                                        <!--         <input class="form-control" style="width: 300px;" value="<?php // echo $protein; ?>"   name="protein"/>  -->
                                                                        <select class="form-control" style="width: 300px;"
                                                                                name="protein">
                                                                            <option value=""></option>
                                                                            <option value="Negative">Negative</option>
                                                                            <option value="+">+</option>
                                                                            <option value="++">++</option>
                                                                            <option value="+++">+++</option>

                                                                        </select>
                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        Urobilinogen
                                                                    </dt>
                                                                    <dd>
                                                                        <!--       <input class="form-control" style="width: 300px;" value="<?php // echo $urobilinogen; ?>"   name="urobilinogen"/> -->
                                                                        <select class="form-control" style="width: 300px;"
                                                                                name="urobilinogen">
                                                                            <option value=""></option>
                                                                            <option value="Normal">Normal</option>
                                                                            <option value="+">+</option>
                                                                            <option value="++">++</option>
                                                                            <option value="+++">+++</option>
                                                                            <option value="++++">++++</option>
                                                                        </select>
                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        WBC/ HPF
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $wbc; ?>" name="wbc"/>
                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        Epith. Cells
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $epith_cells; ?>"
                                                                               name="epith_cells"/>
                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        Casts
                                                                    </dt>
                                                                    <dd>
                                                                        <input class="form-control" style="width: 300px;"
                                                                               value="<?php echo $casts; ?>" name="casts"/>
                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        Bacteria
                                                                    </dt>
                                                                    <dd>
                                                                        <!--       <input class="form-control" style="width: 300px;" value="<?php // echo $bacteria; ?>"   name="bacteria"/>  -->
                                                                        <select class="form-control" style="width: 300px;"
                                                                                name="bacteria">
                                                                            <option value=""></option>
                                                                            <option value="NIL">NIL</option>
                                                                            <option value="Numerous">Numerous</option>
                                                                            <option value="Profuse">Profuse</option>
                                                                            <option value="+">+</option>
                                                                            <option value="++">++</option>
                                                                            <option value="+++">+++</option>

                                                                        </select>
                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        T.Vaginals
                                                                    </dt>
                                                                    <dd>
                                                                        <!--     <input class="form-control" style="width: 300px;" value="<?php echo $t_vaginals; ?>"   name="t_vaginals"/>  -->
                                                                        <select class="form-control" style="width: 300px;"
                                                                                name="t_vaginals">
                                                                            <option value=""></option>
                                                                            <option value="NIL">NIL</option>
                                                                            <option value="+">+</option>
                                                                            <option value="++">++</option>
                                                                            <option value="+++">+++</option>
                                                                            <option value="++++">++++</option>
                                                                        </select>
                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        Blood
                                                                    </dt>
                                                                    <dd>

                                                                        <select class="form-control" style="width: 300px;"
                                                                                name="blood_urine">
                                                                            <option value=""></option>
                                                                            <option value="NIL">NIL</option>
                                                                            <option value="Negative">Negative</option>
                                                                            <option value="+">+</option>
                                                                            <option value="++">++</option>
                                                                            <option value="+++">+++</option>
                                                                        </select>
                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        Nitrite
                                                                    </dt>
                                                                    <dd>

                                                                        <select class="form-control" style="width: 300px;"
                                                                                name="nitrite">
                                                                            <option value=""></option>
                                                                            <option value="NIL">NIL</option>
                                                                            <option value="Positive">Positive</option>
                                                                            <option value="Negative">Negative</option>
                                                                            <option value="+">+</option>
                                                                            <option value="++">++</option>
                                                                            <option value="+++">+++</option>
                                                                        </select>
                                                                    </dd>
                                                                    <br/>

                                                                    <dt>
                                                                        Leucocyte
                                                                    </dt>
                                                                    <dd>

                                                                        <select class="form-control" style="width: 300px;"
                                                                                name="leucocyte">
                                                                            <option value=""></option>
                                                                            <option value="NIL">NIL</option>
                                                                            <option value="Negative">Negative</option>
                                                                            <option value="+">+</option>
                                                                            <option value="++">++</option>
                                                                            <option value="+++">+++</option>
                                                                        </select>
                                                                    </dd>
                                                                    <br/>


                                                                </dl>

                                                            </div>

                                                        </div>


                                                    </div>

                                                </div>
                                            </div>
                                        </div>




                                    </div>
                                    <p class="margin-top-30">
                                        <button type="submit" class="btn btn-lg btn-primary">Save Result</button> &nbsp;&nbsp;
                                        <button class="btn btn-lg btn-default">Cancel</button>
                                    </p>
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