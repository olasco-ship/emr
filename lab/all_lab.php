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


$result = Result::find_by_id($_GET['id']);

$patient = Patient::find_by_id($result->patient_id);

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

                                <a href="../lab/sample_analysis.php">Back</a>
                                <div class="row">
                                    <div class="col-md-6">


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
                                                    <td> <?php echo $result->doctor_note  ?></td>
                                                </tr>

                                                <tr class="active">
                                                    <th>Birthdate</th>
                                                    <td> <?php $d_date = date('d-M-Y', strtotime($patient->dob));
                                                        echo $d_date ?></td>
                                                </tr>

                                                <tr class="active">
                                                    <th>Age</th>
                                                    <td> <?php echo getAge($patient->dob ) . 'years'  ?></td>
                                                </tr>
                                                <tr class="active">
                                                    <th>Sex</th>
                                                    <td> <?php echo $patient->gender   ?> </td>
                                                </tr>

                                                <tr class="active">
                                                    <th>Specimen</th>
                                                    <td> <?php $decode = json_decode($result->specimen );
                                                        foreach ($decode as $item) { echo $item . ', '; }
                                                        ?>
                                                    </td>
                                                </tr>

                                                <tr class="active">
                                                    <th>Test</th>
                                                    <td> <?php $decode = json_decode($result->test );
                                                        foreach ($decode as $item) { echo $item . ', '; }
                                                        ?>
                                                    </td>
                                                </tr>



                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <table class="table table">
                                            <tbody>
                                            <tr class="active">
                                                <th>Lab No.</th>
                                                <td> <input class="form-control"  style="width: 300px;" value="" name="lab_no"/> </td>
                                            </tr>

                                            <tr class="active">
                                                <th>Hospital No.</th>
                                                <td> <?php echo $patient->folder_number   ?> </td>
                                            </tr>
                                            <tr class="active">
                                                <th>Clinic </th>
                                                <td> <?php echo $result->clinic  ?> </td>
                                            </tr>
                                            <tr class="active">
                                                <th> Doctor </th>
                                                <td> <?php echo $result->doctor  ?> </td>
                                            </tr>
                                            <tr class="active">
                                                <th>Date Sample Col.</th>
                                                <td> <?php $d_date = date('d/M/Y', strtotime($result->date_col));
                                                    $time = date('h:i a', strtotime($result->time_col));
                                                    echo $d_date ." ". $time ?>  </td>
                                            </tr>


                                            </tbody>
                                        </table>

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
                                                            <div class="table-responsive" >


                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <td></td>
                                                                        <td style="text-align: center"><b>UNIT</b></td>
                                                                        <td style="text-align: center"><b>RESULT</b></td>
                                                                        <td style="text-align: center"><b>NORMAL</b></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Hb</td>
                                                                        <td>g/dl</td>
                                                                        <td><input class="form-control" name="hb" value="<?php echo $hb; ?>" type="text"></td>
                                                                        <td>13 - 18</td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td>PCV/HCT</td>
                                                                        <td>%</td>
                                                                        <td><input class="form-control" name="pcv" value="<?php echo $pcv; ?>" type="text"></td>
                                                                        <td>40 - 54</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>RBC</td>
                                                                        <td>x10^12/L</td>
                                                                        <td><input class="form-control" name="rbc" value="<?php echo $rbc; ?>" type="text"></td>
                                                                        <td>4.5 - 5.5</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>MCV</td>
                                                                        <td>fl</td>
                                                                        <td><input class="form-control" name="mcv" value="<?php echo $mcv; ?>" type="text"></td>
                                                                        <td>76 - 93</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>MCH</td>
                                                                        <td>pg</td>
                                                                        <td><input class="form-control" name="mch" value="<?php echo $mch; ?>" type="text"></td>
                                                                        <td>27 - 31</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>MCHC</td>
                                                                        <td>g/dl</td>
                                                                        <td><input class="form-control" name="mchc" value="<?php echo $mchc; ?>" type="text"></td>
                                                                        <td>31 - 35</td>
                                                                    </tr>

                                                                    <tr>

                                                                    <tr>
                                                                        <td>WBC</td>
                                                                        <td>x10^9/L</td>
                                                                        <td><input class="form-control" name="wbc" value="<?php echo $wbc; ?>" type="text"></td>
                                                                        <td>4.8 - 10.8</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>PLATELETS</td>
                                                                        <td>x10^9/L</td>
                                                                        <td><input class="form-control" name="platelets" value="<?php echo $platelets; ?>" type="text"></td>
                                                                        <td>140 - 400</td>
                                                                    </tr>


                                                                    <tr>
                                                                        <td>RETICS</td>
                                                                        <td>%</td>
                                                                        <td><input class="form-control" name="retics" value="<?php echo $retics; ?>" type="text"></td>
                                                                        <td>0.2 - 2.0</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>WESTERGREN ESR</td>
                                                                        <td>mm/Hr</td>
                                                                        <td><input class="form-control" name="esr" value="<?php echo $esr; ?>" type="text"></td>
                                                                        <td>5 - 7</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td >NEUT</td>
                                                                        <td>%</td>
                                                                        <td><input class="form-control" name="neutophils" value="<?php echo $neutophils; ?>" type="text"></td>
                                                                        <td>40 - 75</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td >LYMPH</td>
                                                                        <td>%</td>
                                                                        <td><input class="form-control" name="lymphocytes" value="<?php echo $lymphocytes; ?>" type="text"></td>
                                                                        <td>20 - 45</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>MONO</td>
                                                                        <td>%</td>
                                                                        <td><input class="form-control" name="monocytes" value="<?php echo $monocytes; ?>" type="text"></td>
                                                                        <td>2 - 10</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Eosino  </td>
                                                                        <td>%</td>
                                                                        <td><input class="form-control" name="eosinophlis" value="<?php echo $eosinophlis; ?>" type="text"></td>
                                                                        <td>1 - 6</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td >BASO  </td>
                                                                        <td>%</td>
                                                                        <td><input class="form-control" name="basophils" value="<?php echo $basophils; ?>" type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2">Normo  </td>
                                                                        <td><input class="form-control" name="normo" value="<?php echo $normo; ?>" type="text"></td>
                                                                        <td>NIL</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2">Bleeding Time  </td>
                                                                        <td><input class="form-control" name="bleeding_time" value="<?php echo $bleeding_time; ?>" type="text"></td>
                                                                        <td>(1-5)min</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2">Clotting Time  </td>
                                                                        <td><input class="form-control" name="clotting_time" value="<?php echo $clotting_time; ?>" type="text"></td>
                                                                        <td>(1-5)min</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2">P.T.  </td>
                                                                        <td colspan="2"><input class="form-control" name="pt" value="<?php echo $pt; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2">P.T.T.  </td>
                                                                        <td colspan="2"><input class="form-control" name="ptt" value="<?php echo $ptt; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2">APTT </td>
                                                                        <td colspan="2"><input class="form-control" name="aptt" value="<?php echo $aptt; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2">HBsAg   </td>
                                                                        <td><input class="form-control" name="hbsagb" value="<?php echo $hbsagb; ?>" type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2">HCV   </td>
                                                                        <td><input class="form-control" name="hcv" value="<?php echo $hcv; ?>" type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2">RVS Screening   </td>
                                                                        <td><input class="form-control" name="rvs_screening" value="<?php echo $rvs_screening; ?>" type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2">VDRL    </td>
                                                                        <td><input class="form-control" name="vdrl" value="<?php echo $vdrl; ?>" type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2">Malaria Parasite    </td>
                                                                        <td><input class="form-control" name="malaria_parasite" value="<?php echo $malaria_parasite; ?>" type="text"></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2">OTHERS </td>
                                                                        <td><input class="form-control" name="others" value="<?php echo $others; ?>" type="text"></td>
                                                                        <td></td>
                                                                    </tr>



                                                                    <tr>
                                                                        <td colspan="2">Coombs' Test  </td>
                                                                        <td colspan="2"><input class="form-control" name="coombs_test" value="<?php echo $coombs_test; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2">CD 4 Lymphocyte Count   </td>
                                                                        <td colspan="2"><input class="form-control" name="cd4" value="<?php echo $cd4; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2">Blood Group    </td>
                                                                        <td colspan="2"><input class="form-control" name="blood_group" value="<?php echo $blood_group; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2">Hb Genotype     </td>
                                                                        <td colspan="2"><input class="form-control" name="hb_genotype" value="<?php echo $hb_genotype; ?>" type="text"></td>
                                                                    </tr>


                                                                </table>

                                                            </div>

                                                        </div>


                                                        <div class="col-md-5">
                                                            <b>BONE MARROW/DIFFERENTIAL FILM REPORT/COMMENT </b><textarea rows="60" cols="50" class="form-control"
                                                                                                                          name="bone_marrow"><?php echo $bone_marrow; ?></textarea>

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <a class="card-link" data-toggle="collapse" href="#collapseBlood">
                                                    Blood Transfusion
                                                </a>
                                            </div>
                                            <div id="collapseBlood" class="collapse" data-parent="#accordion">

                                                <div class="card-body">

                                                    <div class="row">

                                                        <div class="col-md-12 col-sm-12 col-lg-12">

                                                            <table>


                                                                <table class="table table-bordered">

                                                                    <tr>
                                                                        <td><b>Number of Unit of Whole Blood Required</b></td>
                                                                        <td><input class="form-control" name="no_whole_blood" value="<?php echo $no_whole_blood; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Number of Units of Red Cell Concentrate(packed red cells)</b></td>
                                                                        <td><input class="form-control" name="no_red_cell" value="<?php echo $no_red_cell; ?>" type="text"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>Other Blood Components(please state)</b></td>
                                                                        <td><input class="form-control" name="other_blood" value="<?php echo $other_blood; ?>"
                                                                                   type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Exchange Blood Transfusion</b></td>
                                                                        <td><input class="form-control" name="exchange" value="<?php echo $exchange; ?>"
                                                                                   type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>ABO and RH Grouping Only</b></td>
                                                                        <td><input class="form-control" name="abo_rh" value="<?php echo $abo_rh; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Hepatitis 'C' Surface Ag Screening</b></td>
                                                                        <td><input class="form-control" name="hep_c" value="<?php echo $hep_c; ?>" type="text">
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Coombs' Test</b></td>
                                                                        <td><input class="form-control" name="coombs_test" value="<?php echo $coombs_test; ?>"
                                                                                   type="text"></td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Other Antibody Screening</b></td>
                                                                        <td><input class="form-control" name="anti_screening" value="<?php echo $anti_screening; ?>" type="text"></td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>HBsAg Screening</b></td>
                                                                        <td><input class="form-control" name="hep_b" value="<?php echo $hep_b; ?>" type="text"></td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>HIV Screening (I x II)</b></td>
                                                                        <td><input class="form-control" name="hiv" value="<?php echo $hiv; ?>" type="text"></td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Syphilis Screening</b></td>
                                                                        <td><input class="form-control" name="syplius" value="<?php echo $syplius; ?>" type="text"></td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Type of Cross Match Required</b></td>
                                                                        <td><input class="form-control" name="type_crossmatch" value="<?php echo $type_crossmatch; ?>" type="text"></td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Normal</b></td>
                                                                        <td><input class="form-control" name="normal" value="<?php echo $normal; ?>" type="text"></td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Emergency(15mins)</b></td>
                                                                        <td><input class="form-control" name="emergency" value="<?php echo $emergency; ?>" type="text">
                                                                        </td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Others</b></td>
                                                                        <td><input class="form-control" name="other" value="<?php echo $other; ?>" type="text"></td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Record Of Previous Transfusion(Date and Time)</b></td>
                                                                        <td><input class="form-control" name="rec_prev_tran" value="<?php echo $rec_prev_tran; ?>" type="text"></td>

                                                                    </tr>

                                                                </table>

                                                            </table>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <h5 >ABO/Rh</h5>
                                                            <dl class="dl-horizontal">

                                                                <dt>
                                                                    Grp.
                                                                </dt>
                                                                <dd>
                                                                    <input class="form-control" style="width: 70px;" value="<?php echo $group_one; ?>"
                                                                           name="group_one"/>

                                                                </dd>
                                                                <dt>
                                                                    Grp.
                                                                </dt>
                                                                <dd>
                                                                    <input class="form-control" style="width: 70px;" value="<?php echo $group_two; ?>"
                                                                           name="group_two"/>

                                                                </dd>
                                                                <dt>
                                                                    Grp.
                                                                </dt>
                                                                <dd>
                                                                    <input class="form-control" style="width: 70px;" value="<?php echo $group_three; ?>"
                                                                           name="group_three"/>

                                                                </dd>

                                                                <dt>
                                                                    Grp.
                                                                </dt>
                                                                <dd>
                                                                    <input class="form-control" style="width: 70px;" value="<?php echo $group_four; ?>"
                                                                           name="group_four"/>

                                                                </dd>

                                                            </dl>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h5 >Date/Time</h5>
                                                            <dl class="dl-horizontal">

                                                                <dt>

                                                                </dt>
                                                                <dd>
                                                                    <input class="form-control" style="width: 150px;" id="rh1" value="<?php echo $rh_one; ?>"  name="rh_one"/>


                                                                </dd>
                                                                <dt>

                                                                </dt>
                                                                <dd>
                                                                    <input class="form-control" style="width: 150px;" id="rh2" value="<?php echo $rh_two; ?>"  name="rh_two"/>


                                                                </dd>
                                                                <dt>

                                                                </dt>
                                                                <dd>
                                                                    <input class="form-control" style="width: 150px;" id="rh3" value="<?php echo $rh_three; ?>" name="rh_three"/>


                                                                </dd>

                                                                <dt>

                                                                </dt>
                                                                <dd>
                                                                    <input class="form-control" style="width: 150px;" id="rh4" value="<?php echo $rh_four; ?>"  name="rh_four"/>


                                                                </dd>

                                                            </dl>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-10">


                                                            <div class="form-group">
                                                                <label for="quantity" class="control-label col-md-4"> REPORT OF SEROLOGICAL INVESTIGATION:</label>
                                                                <div class="col-md-8" style="width: 500px">
                                                                    <input class="form-control"  name="rep_ser_inv" value="<?php echo $rep_ser_inv; ?>">

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-2"></div>

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

                                                        <div class="col-md-7">

                                                            <div class="table-responsive" >

                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <td><b>Blood Investigation</b></td>
                                                                        <td><b>Result</b></td>
                                                                        <td><b>Unit</b></td>
                                                                        <td><b>Reference</b></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Electrolyte</b></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Sodium</td>
                                                                        <td><input class="form-control" style="width: 80px;" name="sodium" value="<?php echo $sodium; ?>" type="text">
                                                                        </td>
                                                                        <td>mmol/l</td>
                                                                        <td>136 - 145</td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td>Potassium</td>
                                                                        <td><input class="form-control" name="potassium" value="<?php echo $potassium; ?>"
                                                                                   type="text"></td>
                                                                        <td>mmol/l</td>
                                                                        <td>3.0 - 5.0</td>
                                                                    </tr>


                                                                    <tr>
                                                                        <td>Chloride</td>
                                                                        <td><input class="form-control" name="chloride" value="<?php echo $chloride; ?>"
                                                                                   type="text"></td>
                                                                        <td>mmol/l</td>
                                                                        <td>95 - 110</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Lithium</td>
                                                                        <td><input class="form-control" name="lithium" value="<?php echo $lithium; ?>"
                                                                                   type="text"></td>
                                                                        <td>mmol/l</td>
                                                                        <td>1</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Bicarbonate</td>
                                                                        <td><input class="form-control" name="bicarbonate" value="<?php echo $bicarbonate; ?>"
                                                                                   type="text"></td>
                                                                        <td>mmol/l</td>
                                                                        <td>20 - 30</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Ionized Calcium</td>
                                                                        <td><input class="form-control" name="ionized_calcium"
                                                                                   value="<?php echo $ionized_calcium; ?>" type="text"></td>
                                                                        <td>mmol/l</td>
                                                                        <td>0.11 - 1.23</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Inorganic Phos</td>
                                                                        <td><input class="form-control" name="inorganic_phos" value="<?php echo $inorganic_phos; ?>"
                                                                                   type="text"></td>
                                                                        <td>mmol/l</td>
                                                                        <td>0.80 - 1.60</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>Renal Function Test</b></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Urea</td>
                                                                        <td><input class="form-control" name="urea" type="text"></td>
                                                                        <td>mmol/l</td>
                                                                        <td>2.5 - 5.8</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Creatinine</td>
                                                                        <td><input class="form-control" name="creatinine" value="<?php echo $creatinine; ?>"
                                                                                   type="text"></td>
                                                                        <td>mmol/l</td>
                                                                        <td>44 - 132</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Uric Acid</td>
                                                                        <td><input class="form-control" name="uric_acid" value="<?php echo $uric_acid; ?>"
                                                                                   type="text"></td>
                                                                        <td>mmol/l</td>
                                                                        <td>M(202-416) F(142-330)</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Calcium</td>
                                                                        <td><input class="form-control" name="calcium" value="<?php echo $calcium; ?>" type="text">
                                                                        </td>
                                                                        <td>mmol/l</td>
                                                                        <td>2.2 - 2.7</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Liver Function Test</b></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Total Bilirubin</td>
                                                                        <td><input class="form-control" name="total_bilirubin"
                                                                                   value="<?php echo $total_bilirubin; ?>" type="text"></td>
                                                                        <td>µmol/L</td>
                                                                        <td>1.71 - 17.1</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Conj. Bilirubin</td>
                                                                        <td><input class="form-control" name="conj_bilirubin" value="<?php echo $conj_bilirubin; ?>"
                                                                                   type="text"></td>
                                                                        <td>µmol/L</td>
                                                                        <td>1.7 - 8.5</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>ALK. Phosphatase</td>
                                                                        <td><input class="form-control" name="alk_phosphate" value="<?php echo $alk_phosphate; ?>"
                                                                                   type="text"></td>
                                                                        <td>U/L</td>
                                                                        <td>98 - 279</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>AST. (SGOT)</td>
                                                                        <td><input class="form-control" name="ast" value="<?php echo $ast; ?>" type="text"></td>
                                                                        <td>U/L</td>
                                                                        <td>0 - 40</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>ALT. (SGPT)</td>
                                                                        <td><input class="form-control" name="alt" value="<?php echo $alt; ?>" type="text"></td>
                                                                        <td>U/L</td>
                                                                        <td>0 - 40</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Gamma-GT</td>
                                                                        <td><input class="form-control" name="gamma_gt" value="<?php echo $gamma_gt; ?>"
                                                                                   type="text"></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Total Protein</td>
                                                                        <td><input class="form-control" name="total_protein" value="<?php echo $total_protein; ?>"
                                                                                   type="text"></td>
                                                                        <td>g/dl</td>
                                                                        <td>58 - 80</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Albumin</td>
                                                                        <td><input class="form-control" name="albumin" value="<?php echo $albumin; ?>" type="text">
                                                                        </td>
                                                                        <td>mg/dll</td>
                                                                        <td>35 - 50</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Globulin</td>
                                                                        <td><input class="form-control" name="globulin" value="<?php echo $globulin; ?>" type="text">
                                                                        </td>
                                                                        <td>g/l</td>
                                                                        <td>20 - 45</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>  Enzymes Markers </b></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Total Acid Phosphatase</td>
                                                                        <td><input class="form-control" name="acid_phosphate" value="<?php echo $acid_phosphate; ?>"
                                                                                   type="text"></td>
                                                                        <td>U/L</td>
                                                                        <td>0 - 11</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Prostatic Acid Phosphatase</td>
                                                                        <td><input class="form-control" name="prostatic" value="<?php echo $prostatic; ?>"
                                                                                   type="text"></td>
                                                                        <td>U/L</td>
                                                                        <td>0 - 0.4</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Amylase</td>
                                                                        <td><input class="form-control" name="amylase" value="<?php echo $amylase; ?>" type="text">
                                                                        </td>
                                                                        <td>U/L</td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Cardiac Function Test</b></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>CPK</td>
                                                                        <td><input class="form-control" name="cpk" value="<?php echo $cpk; ?>" type="text"></td>
                                                                        <td>U/L</td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>CKMB</td>
                                                                        <td><input class="form-control" name="ck_mb" value="<?php echo $ck_mb; ?>" type="text"></td>
                                                                        <td>U/L</td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>LDH</td>
                                                                        <td><input class="form-control" name="ldh" value="<?php echo $ldh; ?>" type="text"></td>
                                                                        <td>U/L</td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Lipid Profile</b></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Total Cholesterol</td>
                                                                        <td><input class="form-control" name="total_cholesterol"
                                                                                   value="<?php echo $total_cholesterol; ?>" type="text"></td>
                                                                        <td>mmol/l</td>
                                                                        <td>2.5 - 5.0</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Triglycerides</td>
                                                                        <td><input class="form-control" name="triglycerides" value="<?php echo $triglycerides; ?>"
                                                                                   type="text"></td>
                                                                        <td>mmol/L</td>
                                                                        <td><1.71</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>HDL-Cholesterol</td>
                                                                        <td><input class="form-control" name="hdl_cholesterol"
                                                                                   value="<?php echo $hdl_cholesterol; ?>" type="text"></td>
                                                                        <td>mmol/L</td>
                                                                        <td>1.06 - 1.52</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>LDL-CHOLESTEROL</td>
                                                                        <td><input class="form-control" name="ldl_cholesterol"
                                                                                   value="<?php echo $ldl_cholesterol; ?>" type="text"></td>
                                                                        <td>mmol/L</td>
                                                                        <td><3.9</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Glucose</b></td>
                                                                        <td> </td>

                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Fasting Glucose</td>
                                                                        <td><input class="form-control" name="fasting_glucose"
                                                                                   value="<?php echo $fasting_glucose; ?>" type="text"></td>
                                                                        <td>mmol/L</td>
                                                                        <td>2.5 - 5.6</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Glucose (2HPP)</td>
                                                                        <td><input class="form-control" name="hpp" value="<?php echo $hpp; ?>" type="text"></td>
                                                                        <td>mmol/L</td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Random Glucose</td>
                                                                        <td><input class="form-control" name="random_glucose" value="<?php echo $random_glucose; ?>"
                                                                                   type="text"></td>
                                                                        <td>mmol/L</td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>GLYCATED HAEMOGLOBIN(hbA)</td>
                                                                        <td><input class="form-control" name="hba" value="<?php echo $hbA; ?>" type="text"></td>
                                                                        <td>6-8.3%</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Phosphorus</td>
                                                                        <td><input class="form-control" name="phosphorus" value="<?php echo $phosphorus; ?>"
                                                                                   type="text"></td>
                                                                        <td>mg/dll</td>
                                                                        <td>0.3 - 1.5</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>TIBC</td>
                                                                        <td><input class="form-control" name="tibc" value="<?php echo $tibc; ?>" type="text"></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>G6PD</td>
                                                                        <td><input class="form-control" name="g6pd" value="<?php echo $g6pd; ?>" type="text"></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Lipase</td>
                                                                        <td><input class="form-control" name="lipase" value="<?php echo $lipase; ?>" type="text">
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>OTHERS (indicate)</td>
                                                                        <td><input class="form-control" name="others" value="<?php echo $others; ?>" type="text">
                                                                        </td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <!--
                        <tr>
                            <td>CREATININE CLEARANCE</td>
                            <td><input class="form-control" name="creatinine_clearance" value="<?php echo $creatinine_clearance; ?>" type="text"></td>
                            <td>70 - 120 ml/min</td>
                        </tr>

                        <tr>
                            <td>OGTT. </td>
                            <td><input class="form-control" name="ogtt" value="<?php echo $ogtt; ?>" type="text"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 50px;">Fasting </td>
                            <td><input class="form-control" name="fasting" value="<?php echo $fasting; ?>" type="text"></td>
                            <td>2.75-5.78mmol/L</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 50px;">30 min</td>
                            <td><input class="form-control" name="thirty_min" value="<?php echo $thirty_min; ?>" type="text"></td>
                            <td>mmol/dl</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 50px;">60 min</td>
                            <td><input class="form-control" name="one_hour" value="<?php echo $one_hour; ?>" type="text"></td>
                            <td>mmol/dl</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 50px;">90 min</td>
                            <td><input class="form-control" name="ninety_min" value="<?php echo $ninety_min; ?>" type="text"></td>
                            <td>mmol/dl</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 50px;">120 min </td>
                            <td><input class="form-control" name="two_hours" value="<?php echo $two_hours; ?>" type="text"></td>
                            <td>mmol/dl</td>
                        </tr>


                        <tr>
                            <td>PROTEIN</td>
                            <td><input class="form-control" name="protein" value="<?php echo $protein; ?>" type="text"></td>
                            <td>mmol/l</td>
                        </tr>


                        <tr>
                            <td> 24HR URINARY PROTEIN</td>
                            <td><input class="form-control" name="urinary_protein" value="<?php echo $urinary_protein; ?>" type="text"></td>
                            <td>0.05-0.1g/24hrs</td>
                        </tr>

                        <tr>
                            <td> 24HR URINARY CREATININE</td>
                            <td><input class="form-control" name="urinary_creatinine" value="<?php echo $urinary_creatinine; ?>" type="text"></td>
                            <td>1.0-1.5g/24hrs</td>
                        </tr>

                        <tr>
                            <td> ALBUMIN/CREATININE RATIO</td>
                            <td><input class="form-control" name="albumin_ratio" value="<?php echo $albumin_ratio; ?>" type="text"></td>
                            <td>30-300mg/g</td>
                        </tr>
                            -->


                                                                </table>

                                                            </div>


                                                        </div>

                                                        <div class="col-md-5">

                                                            <div class="table-responsive" >

                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <td colspan="3" style="text-align: center"><b>HORMONAL ASSAY</b></td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td>PSA</td>
                                                                        <td colspan="2"><input class="form-control" name="psa" value="<?php echo $psa; ?>"
                                                                                               type="text"></td>
                                                                    </tr>


                                                                    <tr>
                                                                        <td>T3</td>
                                                                        <td colspan="2"><input class="form-control" name="t3" value="<?php echo $t3; ?>"
                                                                                               type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>T4</td>
                                                                        <td colspan="2"><input class="form-control" name="t4" value="<?php echo $t4; ?>"
                                                                                               type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>TSH</td>
                                                                        <td colspan="2"><input class="form-control" name="tsh" value="<?php echo $tsh; ?>"
                                                                                               type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>E2</td>
                                                                        <td colspan="2"><input class="form-control" name="e2" value="<?php echo $e2; ?>"
                                                                                               type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>LH</td>
                                                                        <td colspan="2"><input class="form-control" name="lh" value="<?php echo $lh; ?>"
                                                                                               type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>FSH</td>
                                                                        <td colspan="2"><input class="form-control" name="fsh" value="<?php echo $fsh; ?>"
                                                                                               type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Prolactin</td>
                                                                        <td colspan="2"><input class="form-control" name="prolactin"
                                                                                               value="<?php echo $prolactin; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Progesterone</td>
                                                                        <td colspan="2"><input class="form-control" name="progesterone"
                                                                                               value="<?php echo $progesterone; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Testosterone</td>
                                                                        <td colspan="2"><input class="form-control" name="testosterone"
                                                                                               value="<?php echo $testosterone; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>AFP</td>
                                                                        <td colspan="2"><input class="form-control" name="afp" value="<?php echo $afp; ?>"
                                                                                               type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Beta HCG</td>
                                                                        <td colspan="2"><input class="form-control" name="beta_hcg" value="<?php echo $beta_hcg; ?>"
                                                                                               type="text"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="3" style="text-align: center"><b>URINALYSIS</b></td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td>Protein</td>
                                                                        <td colspan="2"><input class="form-control" name="urine_protein"
                                                                                               value="<?php echo $urine_protein; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Glucose</td>
                                                                        <td colspan="2"><input class="form-control" name="urine_glucose"
                                                                                               value="<?php echo $urine_glucose; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Blood</td>
                                                                        <td colspan="2"><input class="form-control" name="urine_blood"
                                                                                               value="<?php echo $urine_blood; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Bilirubin</td>
                                                                        <td colspan="2"><input class="form-control" name="urine_bilirubin"
                                                                                               value="<?php echo $urine_bilirubin; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Urobilinogen</td>
                                                                        <td colspan="2"><input class="form-control" name="urine_urobilinogen"
                                                                                               value="<?php echo $urine_urobilinogen; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Ketones</td>
                                                                        <td colspan="2"><input class="form-control" name="urine_ketones"
                                                                                               value="<?php echo $urine_ketones; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Ascorbic Acid</td>
                                                                        <td colspan="2"><input class="form-control" name="urine_ascorbic_acid"
                                                                                               value="<?php echo $urine_ascorbic_acid; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Nitrite</td>
                                                                        <td colspan="2"><input class="form-control" name="urine_nitrite"
                                                                                               value="<?php echo $urine_nitrite; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>pH</td>
                                                                        <td colspan="2"><input class="form-control" name="urine_ph" value="<?php echo $urine_ph; ?>"
                                                                                               type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Sp Gravity</td>
                                                                        <td colspan="2"><input class="form-control" name="urine_sp_gravity"
                                                                                               value="<?php echo $urine_sp_gravity; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="text-align: center"><b>CSF/ECF/ASPIRATES</b></td>
                                                                        <td colspan="2" style="text-align: center"><b>REF. RANGE</b></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Protein</td>
                                                                        <td><input class="form-control" name="csf_protein" value="<?php echo $csf_protein; ?>"
                                                                                   type="text"></td>
                                                                        <td>(15-45)mg/dl</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Chloride</td>
                                                                        <td><input class="form-control" name="csf_chloride" value="<?php echo $csf_chloride; ?>"
                                                                                   type="text"></td>
                                                                        <td>120 - 130mmol/L</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Glucose</td>
                                                                        <td><input class="form-control" name="csf_glucose" value="<?php echo $csf_glucose; ?>"
                                                                                   type="text"></td>
                                                                        <td>(2.8-3.9)mmol/L</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>mg/dl</td>
                                                                        <td colspan="2">Up to 130</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="3" style="text-align: center"><b>Faecal Occult Blood Test:</b></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="3"><input class="form-control" name="faecal" value="<?php echo $faecal; ?>"
                                                                                               type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2"><b>Mantoux Test</b></td>
                                                                        <td colspan="2"><b>Ref. Range</b></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2"><input class="form-control" name="mantoux_test"
                                                                                               value="<?php echo $mantoux_test; ?>" type="text"></td>
                                                                        <td colspan="2"><input class="form-control" name="mantoux_ref"
                                                                                               value="<?php echo $mantoux_ref; ?>" type="text"></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="3" style="text-align: center"><b>Pregnancy Test</b></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Urine</td>
                                                                        <td colspan="2"><input class="form-control" name="pt_urine" value="<?php echo $pt_urine; ?>"
                                                                                               type="text"></td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td>Blood</td>
                                                                        <td colspan="2"><input class="form-control" name="pt_blood" value="<?php echo $pt_blood; ?>"
                                                                                               type="text"></td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="3"><b>Notes</b></td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="3"><textarea class="form-control" cols="2" rows="6"
                                                                                                  name="notes"><?php echo $notes; ?></textarea></td>

                                                                    </tr>

                                                                </table>

                                                            </div>



                                                        </div>
                                                    </div>

                                                    <h4 style="text-align: center"> <b>ORAL GLUCOSE TOLERANCE TEST REPORT SHEET</b> </h4>

                                                    <div class="table-responsive" >
                                                        <table class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th> </th>
                                                                <th> Fasting</th>
                                                                <th>30 Minutes </th>
                                                                <th>60 Minutes </h4></th>
                                                                <th>90 Minutes </th>
                                                                <th>120 Minutes</th>
                                                                <th>150 Minutes</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>Blood Glucose Level (mmol/L)</td>
                                                                <td><input class="form-control" value="<?php echo $fasting; ?>"  name="fasting"/></td>
                                                                <td> <input class="form-control"  value="<?php echo $thirty_min; ?>"  name="thirty_min"/>  </td>
                                                                <td> <input class="form-control" value="<?php echo $one_hour; ?>"  name="one_hour"/> </td>
                                                                <td><input class="form-control" value="<?php echo $ninety_min; ?>"  name="ninety_min"/></td>
                                                                <td> <input class="form-control"  value="<?php echo $two_hours; ?>"  name="two_hours"/>  </td>
                                                                <td> <input class="form-control" value="<?php echo $ogtt; ?>"  name="ogtt"/> </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Urine Glucose </td>
                                                                <td><input class="form-control" value="<?php echo $fasting_urine; ?>"  name="fasting_urine"/></td>
                                                                <td> <input class="form-control"  value="<?php echo $thirty_min_urine; ?>"  name="thirty_min_urine"/>  </td>
                                                                <td> <input class="form-control" value="<?php echo $one_hour_urine; ?>"  name="one_hour_urine"/> </td>
                                                                <td><input class="form-control" value="<?php echo $ninety_min_urine; ?>"  name="ninety_min_urine"/></td>
                                                                <td> <input class="form-control"  value="<?php echo $two_hours_urine; ?>"  name="two_hours_urine"/>  </td>
                                                                <td> <input class="form-control" value="<?php echo $ogtt_urine; ?>"  name="ogtt_urine"/> </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
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

                                                    <div class="row">
                                                        <div class="col-md-5">

                                                            <table>


                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <td><b>WIDAL REACTION</b></td>
                                                                        <td colspan="2" style="text-align: center"><b>TITRE</b></td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td><b></b></td>
                                                                        <td style="text-align: center"><b>O</b></td>
                                                                        <td style="text-align: center"><b>H</b></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Salmonella Typhi D</b></td>
                                                                        <td style="text-align: center"><b><input class="form-control" name="salmo_d_o" value="<?php echo $salmo_d_o; ?>" type="text"></b></td>
                                                                        <td style="text-align: center"><b><input class="form-control" name="salmo_d_h" value="<?php echo $salmo_d_h; ?>" type="text"></b></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Salmonella Paratyphi A</b></td>
                                                                        <td style="text-align: center"><b><input class="form-control" name="salmo_a_o" value="<?php echo $salmo_a_o; ?>" type="text"></b></td>
                                                                        <td style="text-align: center"><b><input class="form-control" name="salmo_a_h" value="<?php echo $salmo_a_h; ?>" type="text"></b></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Salmonella Paratyphi B</b></td>
                                                                        <td style="text-align: center"><b><input class="form-control" name="salmo_b_o" value="<?php echo $salmo_b_o; ?>" type="text"></b></td>
                                                                        <td style="text-align: center"><b><input class="form-control" name="salmo_b_h" value="<?php echo $salmo_b_h; ?>" type="text"></b></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Salmonella Paratyphi C</b></td>
                                                                        <td style="text-align: center"><b><input class="form-control" name="salmo_c_o" value="<?php echo $salmo_c_o; ?>" type="text"></b></td>
                                                                        <td style="text-align: center"><b><input class="form-control" name="salmo_c_h" value="<?php echo $salmo_c_h; ?>" type="text"></b></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Comment</b></td>
                                                                        <td colspan="2" style="text-align: center"><b><textarea class="form-control" cols="4" rows="3" name="widal_comment" <?php echo $widal_comment; ?>></textarea></b></td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>VDRL</b></td>
                                                                        <td colspan="2" style="text-align: center"><b><input class="form-control" name="vdrl" value="<?php echo $vdrl; ?>" type="text"></b></td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>H . Pylori</b></td>
                                                                        <td colspan="2" style="text-align: center"><b><input class="form-control" name="h_pylori" value="<?php echo $h_pylori; ?>" type="text"></b></td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Others</b></td>
                                                                        <td colspan="2" style="text-align: center"><b><input class="form-control" name="widal_others" value="<?php echo $widal_others; ?>" type="text"></b></td>

                                                                    </tr>




                                                                </table>

                                                            </table>


                                                        </div>
                                                        <div class="col-md-7">

                                                            <table>


                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <td style="text-align: center"><b>SEMEN ANALYSIS M/C/S</b></td>
                                                                        <td style="text-align: center"><b>MICROSCOPY</b></td>
                                                                        <td style="text-align: center"><b>MOTILITY</b></td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Collection Date</b><input class="form-control"  id="col_date" value="<?php echo $date_col; ?>" name="date_col"/> </td>
                                                                        <td><b>Pus Cell</b><input class="form-control"  value="<?php echo $micro_pus_cell; ?>" name="micro_pus_cell"/></td>
                                                                        <td style="text-align: center"><b>% Fully Active</b><input class="form-control"  value="<?php echo $mot_fully_active; ?>" name="mot_fully_active"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Time Collected</b><input class="form-control"  id="col_time" value="<?php echo $time_col; ?>"  name="time_col"/> </td>
                                                                        <td> </td>
                                                                        <td style="text-align: center"><b>% Slightly Active</b><input class="form-control"  value="<?php echo $mot_sli_active; ?>" name="mot_sli_active"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Time Received</b><input class="form-control"  id="rec_time" value="<?php echo $time_rec; ?>"  name="time_rec"/> </td>
                                                                        <td></td>
                                                                        <td style="text-align: center"><b>Non-motile</b><input class="form-control"  value="<?php echo $mot_dead; ?>" name="mot_dead"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Time Examined</b><input class="form-control"  id="ex_time" value="<?php echo $time_ex; ?>"  name="time_ex"/> </td>
                                                                        <td></td>
                                                                        <td style="text-align: center"><b>Morphology</b><input class="form-control"  value="<?php echo $mot_morphology; ?>" name="mot_morphology"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>Abstinence Period</b><input class="form-control"  value="<?php echo $ab_period; ?>"  name="ab_period"/> </td>
                                                                        <td></td>
                                                                        <td style="text-align: center"><b>Abnormal</b><input class="form-control"  value="<?php echo $abnormal; ?>" name="abnormal"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Mode of Collection</b><input class="form-control"  value="<?php echo $mode_of_col; ?>"  name="mode_of_col"/> </td>
                                                                        <td></td>
                                                                        <td style="text-align: center"><b>Normal</b><input class="form-control"  value="<?php echo $normal; ?>" name="normal"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Volume</b><input class="form-control"  value="<?php echo $volume; ?>"  name="volume"/> </td>
                                                                        <td><!--<b>Sperm Count/ml</b><input class="form-control"  value="<?php echo $mot_sperm_count; ?>" name="mot_sperm_count"/> --></td>
                                                                        <td style="text-align: center"><b>Sperm Count/ml</b><input class="form-control"  value="<?php echo $mot_sperm_count; ?>" name="mot_sperm_count"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Viscosity</b><input class="form-control"  value="<?php echo $viscosity; ?>"  name="viscosity"/> </td>
                                                                        <td></td>
                                                                        <td style="text-align: center"><b> Culture</b><textarea class="form-control" cols="4" rows="3" name="sperm_culture" <?php echo $sperm_culture; ?>></textarea> </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Appearance</b><input class="form-control"  value="<?php echo $appearance; ?>"  name="appearance"/> </td>
                                                                        <td></td>
                                                                        <td style="text-align: center"><b> Comment</b> <textarea class="form-control" cols="4" rows="3" name="sperm_comment" <?php echo $sperm_comment; ?>></textarea> </td>
                                                                    </tr>

                                                                    <!--
                        <tr>
                            <td><b> Culture</b><textarea class="form-control" cols="4" rows="3" name="sperm_culture" <?php echo $sperm_culture; ?>></textarea> </td>

                            <td></td>
                            <td style="text-align: center"></td>
                        </tr>

                        <tr>
                            <td><b> Comment</b> <textarea class="form-control" cols="4" rows="3" name="sperm_comment" <?php echo $sperm_comment; ?>></textarea> </td>
                            <td></td>
                            <td style="text-align: center"></td>
                        </tr>
                        -->


                                                                </table>

                                                            </table>

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">

                                                            <table>


                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <td colspan="2" style="text-align: center"><b> HVS MICROSCOPY  </b></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Pus Cell </b> </td>
                                                                        <td><input class="form-control" value="<?php echo $pus_cell; ?>" name="pus_cell"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> RBC </b> </td>
                                                                        <td><input class="form-control" value="<?php echo $rbc; ?>" name="rbc"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> S.Haematobium </b> </td>
                                                                        <td><input class="form-control" value="<?php echo $s_haem; ?>" name="s_haem"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Casts </b> </td>
                                                                        <td><input class="form-control" value="<?php echo $casts; ?>" name="casts"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Crystals </b> </td>
                                                                        <td><input class="form-control" value="<?php echo $crystals; ?>" name="crystals"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Yeast </b> </td>
                                                                        <td><input class="form-control" value="<?php echo $yeast; ?>" name="yeast"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Bacteria </b> </td>
                                                                        <td><input class="form-control" value="<?php echo $bacteria; ?>" name="bacteria"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> T.Vaginalis </b> </td>
                                                                        <td><input class="form-control" value="<?php echo $t_vaginalis; ?>" name="t_vaginalis"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Epithelia Cell </b> </td>
                                                                        <td><input class="form-control" value="<?php echo $epith_cell; ?>" name="epith_cell"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Clue Cell </b> </td>
                                                                        <td><input class="form-control" value="<?php echo $clue_cell; ?>" name="clue_cell"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Others </b> </td>
                                                                        <td><input class="form-control" value="<?php echo $others; ?>" name="others"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2" style="text-align: center"><b> URINE MICROSCOPY  </b></td>
                                                                    </tr>

                                                                    <tr>

                                                                        <td colspan="3"><b> Rbc </b><input class="form-control"  value="<?php echo $micro_rbc; ?>" name="micro_rbc"/></td>

                                                                    </tr>

                                                                    <tr>

                                                                        <td colspan="3"><b> Epith Cell </b><input class="form-control"  value="<?php echo $micro_epith; ?>" name="micro_epith"/></td>

                                                                    </tr>

                                                                    <tr>

                                                                        <td colspan="3"><b> Bacteria </b><input class="form-control"  value="<?php echo $micro_bacteria; ?>" name="micro_bacteria"/></td>

                                                                    </tr>

                                                                    <tr>

                                                                        <td colspan="3"><b> S.Haematolobium </b><input class="form-control"  value="<?php echo $micro_s_haem; ?>" name="micro_s_haem"/></td>

                                                                    </tr>

                                                                    <tr>

                                                                        <td colspan="3"><b> T.Vaginalis </b><input class="form-control"  value="<?php echo $micro_t_v; ?>" name="micro_t_v"/></td>

                                                                    </tr>

                                                                    <tr>

                                                                        <td colspan="3"><b> Yeast </b><input class="form-control"  value="<?php echo $micro_yeast; ?>" name="micro_yeast"/></td>

                                                                    </tr>



                                                                    <tr>
                                                                        <td colspan="3"><b> Pus Cell  </b><input class="form-control" value="<?php echo $urine_pus_cell; ?>" name="urine_pus_cell"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="3"><b> Cast  </b><input class="form-control" value="<?php echo $urine_cast; ?>" name="urine_cast"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="3"><b> Crystals  </b><input class="form-control" value="<?php echo $urine_crystals; ?>" name="urine_crystals"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="3"><b> Organisms  </b><input class="form-control" value="<?php echo $urine_organism; ?>" name="urine_organism"/></td>
                                                                    </tr>




                                                                    <tr>
                                                                        <td colspan="3"><b> Culture </b> <textarea class="form-control" cols="4" rows="3" name="urine_micro_culture" <?php echo $urine_micro_culture; ?>></textarea></td>

                                                                    </tr>

                                                                    <!--



                    <tr>
                        <td><b> Glucose </b> </td>
                        <td><input class="form-control" value="<?php echo $glucose; ?>" name="glucose"/></td>
                    </tr>

                    <tr>
                        <td><b> Ketone </b> </td>
                        <td><input class="form-control" value="<?php echo $ketone; ?>" name="ketone"/></td>
                    </tr>

                    <tr>
                        <td><b> Ascorbic Acid </b> </td>
                        <td><input class="form-control" value="<?php echo $ascorbic_acid; ?>" name="ascorbic_acid"/></td>
                    </tr>

                    <tr>
                        <td><b> Nitrite </b> </td>
                        <td><input class="form-control" value="<?php echo $nitrite; ?>" name="nitrite"/></td>
                    </tr>

                    <tr>
                        <td><b> Protein </b> </td>
                        <td><input class="form-control" value="<?php echo $protein; ?>" name="protein"/></td>
                    </tr>

                    <tr>
                        <td><b> Bilirubin </b> </td>
                        <td><input class="form-control" value="<?php echo $bilirubin; ?>" name="bilirubin"/></td>
                    </tr>

                    <tr>
                        <td><b> Urobilnogen </b> </td>
                        <td><input class="form-control" value="<?php echo $urobilnogen; ?>" name="urobilnogen"/></td>
                    </tr>

                    <tr>
                        <td><b> Blood </b> </td>
                        <td><input class="form-control" value="<?php echo $blood; ?>" name="blood"/></td>
                    </tr>

                    <tr>
                        <td><b> Leucocytes </b> </td>
                        <td><input class="form-control" value="<?php echo $leucocytes; ?>" name="leucocytes"/></td>
                    </tr>

                    -->



                                                                </table>

                                                            </table>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <table>


                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <td style="text-align: center"><b> SENSITIVITY </b></td>
                                                                        <td style="text-align: center"><b> RESULTS </b> </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> CEFIXIME </b> </td>
                                                                        <td> <!-- <input class="form-control" value="<?php echo $mip; ?>" name="mip"/> -->
                                                                            <select class="form-control" style="width: 250px;" name="mip">
                                                                                <option value=""></option>
                                                                                <option value="Sensitive">Sensitive</option>
                                                                                <option value="Moderately Sensitive">Moderately Sensitive</option>
                                                                                <option  value="Resistant">Resistant</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> CEFTRIAXONE </b> </td>
                                                                        <td>  <!-- <input class="form-control" value="<?php echo $cefri; ?>" name="cefri"/>  -->

                                                                            <select class="form-control" style="width: 250px;" name="cefri">
                                                                                <option value=""></option>
                                                                                <option value="Sensitive">Sensitive</option>
                                                                                <option value="Moderately Sensitive">Moderately Sensitive</option>
                                                                                <option  value="Resistant">Resistant</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> GENTAMICIN </b> </td>
                                                                        <td>   <!-- <input class="form-control" value="<?php echo $gent; ?>" name="gent"/> -->

                                                                            <select class="form-control" style="width: 250px;" name="gent">
                                                                                <option value=""></option>
                                                                                <option value="Sensitive">Sensitive</option>
                                                                                <option value="Moderately Sensitive">Moderately Sensitive</option>
                                                                                <option  value="Resistant">Resistant</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> CO-TRIMOXAZOLE </b> </td>
                                                                        <td> <!-- <input class="form-control" value="<?php echo $cot; ?>" name="cot"/>  -->

                                                                            <select class="form-control" style="width: 250px;" name="cot">
                                                                                <option value=""></option>
                                                                                <option value="Sensitive">Sensitive</option>
                                                                                <option value="Moderately Sensitive">Moderately Sensitive</option>
                                                                                <option  value="Resistant">Resistant</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> LEVOFLOXACIN </b> </td>
                                                                        <td> <!-- <input class="form-control" value="<?php echo $lev; ?>" name="lev"/>  -->

                                                                            <select class="form-control" style="width: 250px;" name="lev">
                                                                                <option value=""></option>
                                                                                <option value="Sensitive">Sensitive</option>
                                                                                <option value="Moderately Sensitive">Moderately Sensitive</option>
                                                                                <option  value="Resistant">Resistant</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> NETILLIN </b> </td>
                                                                        <td> <!-- <input class="form-control" value="<?php echo $net; ?>" name="net"/>  -->

                                                                            <select class="form-control" style="width: 250px;" name="net">
                                                                                <option value=""></option>
                                                                                <option value="Sensitive">Sensitive</option>
                                                                                <option value="Moderately Sensitive">Moderately Sensitive</option>
                                                                                <option  value="Resistant">Resistant</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> TETRACYCLINE </b> </td>
                                                                        <td> <!-- <input class="form-control" value="<?php echo $tet; ?>" name="tet"/>  -->

                                                                            <select class="form-control" style="width: 250px;" name="tet">
                                                                                <option value=""></option>
                                                                                <option value="Sensitive">Sensitive</option>
                                                                                <option value="Moderately Sensitive">Moderately Sensitive</option>
                                                                                <option  value="Resistant">Resistant</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> AMOXYCLAV </b> </td>
                                                                        <td> <!-- <input class="form-control" value="<?php echo $amo; ?>" name="amo"/>  -->

                                                                            <select class="form-control" style="width: 250px;" name="amo">
                                                                                <option value=""></option>
                                                                                <option value="Sensitive">Sensitive</option>
                                                                                <option value="Moderately Sensitive">Moderately Sensitive</option>
                                                                                <option  value="Resistant">Resistant</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> OFLOXACIN </b> </td>
                                                                        <td> <!-- <input class="form-control" value="<?php echo $ofl; ?>" name="ofl"/>  -->

                                                                            <select class="form-control" style="width: 250px;" name="ofl">
                                                                                <option value=""></option>
                                                                                <option value="Sensitive">Sensitive</option>
                                                                                <option value="Moderately Sensitive">Moderately Sensitive</option>
                                                                                <option  value="Resistant">Resistant</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> CIPROFLOXACIN </b> </td>
                                                                        <td> <!-- <input class="form-control" value="<?php echo $cip; ?>" name="cip"/>  -->

                                                                            <select class="form-control" style="width: 250px;" name="cip">
                                                                                <option value=""></option>
                                                                                <option value="Sensitive">Sensitive</option>
                                                                                <option value="Moderately Sensitive">Moderately Sensitive</option>
                                                                                <option  value="Resistant">Resistant</option>
                                                                            </select>


                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> CEFTAZIDIME </b> </td>
                                                                        <td> <!-- <input class="form-control" value="<?php echo $cefta; ?>" name="cefta"/> -->

                                                                            <select class="form-control" style="width: 250px;" name="cefta">
                                                                                <option value=""></option>
                                                                                <option value="Sensitive">Sensitive</option>
                                                                                <option value="Moderately Sensitive">Moderately Sensitive</option>
                                                                                <option  value="Resistant">Resistant</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> CEFUROXIME </b> </td>
                                                                        <td> <!-- <input class="form-control" value="<?php echo $cefu; ?>" name="cefu"/>  -->

                                                                            <select class="form-control" style="width: 250px;" name="cefu">
                                                                                <option value=""></option>
                                                                                <option value="Sensitive">Sensitive</option>
                                                                                <option value="Moderately Sensitive">Moderately Sensitive</option>
                                                                                <option  value="Resistant">Resistant</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> NITROFURANTOIN </b> </td>
                                                                        <td> <!-- <input class="form-control" value="<?php echo $nitro; ?>" name="nitro"/>  -->

                                                                            <select class="form-control" style="width: 250px;" name="nitro">
                                                                                <option value=""></option>
                                                                                <option value="Sensitive">Sensitive</option>
                                                                                <option value="Moderately Sensitive">Moderately Sensitive</option>
                                                                                <option  value="Resistant">Resistant</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> AMPICILLIN </b> </td>
                                                                        <td> <!-- <input class="form-control" value="<?php echo $amp; ?>" name="amp"/> -->

                                                                            <select class="form-control" style="width: 250px;" name="amp">
                                                                                <option value=""></option>
                                                                                <option value="Sensitive">Sensitive</option>
                                                                                <option value="Moderately Sensitive">Moderately Sensitive</option>
                                                                                <option  value="Resistant">Resistant</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> ERYTHROMYCIN </b> </td>
                                                                        <td> <!-- <input class="form-control" value="<?php echo $ery; ?>" name="ery"/> -->

                                                                            <select class="form-control" style="width: 250px;" name="ery">
                                                                                <option value=""></option>
                                                                                <option value="Sensitive">Sensitive</option>
                                                                                <option value="Moderately Sensitive">Moderately Sensitive</option>
                                                                                <option  value="Resistant">Resistant</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> CLOXICILLIN </b> </td>
                                                                        <td> <!-- <input class="form-control" value="<?php echo $clo; ?>" name="clo"/>  -->

                                                                            <select class="form-control" style="width: 250px;" name="clo">
                                                                                <option value=""></option>
                                                                                <option value="Sensitive">Sensitive</option>
                                                                                <option value="Moderately Sensitive">Moderately Sensitive</option>
                                                                                <option  value="Resistant">Resistant</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> AUGUMENTIN </b> </td>
                                                                        <td> <!-- <input class="form-control" value="<?php echo $aug; ?>" name="aug"/>  -->

                                                                            <select class="form-control" style="width: 250px;" name="aug">
                                                                                <option value=""></option>
                                                                                <option value="Sensitive">Sensitive</option>
                                                                                <option value="Moderately Sensitive">Moderately Sensitive</option>
                                                                                <option  value="Resistant">Resistant</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2" style="text-align: center"><b> EXTRA ANTIBIOTICS </b> </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>  <input class="form-control" value="<?php echo $anti_one; ?>" name="anti_one"/>  </b> </td>
                                                                        <td>
                                                                            <select class="form-control" style="width: 250px;" name="anti_one_res">
                                                                                <option value=""></option>
                                                                                <option value="Sensitive">Sensitive</option>
                                                                                <option value="Moderately Sensitive">Moderately Sensitive</option>
                                                                                <option  value="Resistant">Resistant</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>  <input class="form-control" value="<?php echo $anti_two; ?>" name="anti_two"/>  </b> </td>
                                                                        <td>
                                                                            <select class="form-control" style="width: 250px;" name="anti_two_res">
                                                                                <option value=""></option>
                                                                                <option value="Sensitive">Sensitive</option>
                                                                                <option value="Moderately Sensitive">Moderately Sensitive</option>
                                                                                <option  value="Resistant">Resistant</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b>  <input class="form-control" value="<?php echo $anti_three; ?>" name="anti_three"/>  </b> </td>
                                                                        <td>
                                                                            <select class="form-control" style="width: 250px;" name="anti_three_res">
                                                                                <option value=""></option>
                                                                                <option value="Sensitive">Sensitive</option>
                                                                                <option value="Moderately Sensitive">Moderately Sensitive</option>
                                                                                <option  value="Resistant">Resistant</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>



                                                                </table>

                                                            </table>




                                                        </div>

                                                    </div>

                                                    <b>Comment </b>
                                                    <textarea class="form-control" cols="4" rows="2" name="comment" <?php echo $comment; ?>></textarea>
                                                    <br/>
                                                    <b>STOOL ANALYSIS (MACROSCOPY) </b>
                                                    <textarea class="form-control" cols="4" rows="2" name="stool_analysis" <?php echo $stool_analysis; ?>></textarea>
                                                    <br/>

                                                    <b>Skin Snip for Oncho   </b>
                                                    <textarea class="form-control" cols="4" rows="2" name="skin_snip" <?php echo $skin_snip; ?>></textarea>
                                                    <br/>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <table>


                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <td><b> SPUTUM M/C/S <!-- WOUND, EYE, EAR  --> </b></td>
                                                                        <td>

                                                                            <select class="form-control"  name="sputum">
                                                                                <option value=""></option>
                                                                                <option value="ECS m/c/s">ECS m/c/s</option>
                                                                                <option value="Urethral Swab m/c/s">Urethral Swab m/c/s</option>
                                                                                <option  value="Wound Swab m/c/s">Wound Swab m/c/s</option>
                                                                                <option value="Sputum Swab m/c/s">Sputum Swab m/c/s</option>
                                                                                <option value="Ear Swab m/c/s">Ear Swab m/c/s</option>
                                                                                <option  value="Eye Swab m/c/s">Eye Swab m/c/s</option>
                                                                                <option value="Aspirate m/c/s">Aspirate m/c/s</option>
                                                                                <option value="Thoracic Swab m/c/s">Thoracic Swab m/c/s</option>
                                                                                <option  value="Nasal Swab m/c/s">Nasal Swab m/c/s</option>
                                                                                <option  value="Skin Swab m/c/s">Skin Swab m/c/s</option>
                                                                                <option value="Pus m/c/s">Pus m/c/s</option>
                                                                                <option value="Mouth Swab m/c/s">Mouth Swab m/c/s</option>
                                                                                <option  value="Catheter tip m/c/s">Catheter tip m/c/s</option>
                                                                                <option value="IUD m/c/s">IUD m/c/s</option>
                                                                                <option  value="Ulcer material m/c/s">Ulcer material m/c/s</option>
                                                                            </select>

                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><!--<input class="form-control" value="<?php echo $sputum; ?>" name="sputum"/> --> <b>Others</b></td>
                                                                        <td><input class="form-control" value="<?php echo $spu_others; ?>" name="spu_others"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2" style="text-align: center"><b> GRAM REACTION </b></td>
                                                                    </tr>

                                                                    <!--
                                                                    <tr>
                                                                        <td><b> INVESTIGATION</b> </td>
                                                                        <td>
                                                                            <select class="form-control"  name="sputum">
                                                                                <option value=""></option>
                                                                                <option value="ECS m/c/s">ECS m/c/s</option>
                                                                                <option value="Urethral Swab m/c/s">Urethral Swab m/c/s</option>
                                                                                <option  value="Wound Swab m/c/s">Wound Swab m/c/s</option>
                                                                                <option value="Sputum Swab m/c/s">Sputum Swab m/c/s</option>
                                                                                <option value="Ear Swab m/c/s">Ear Swab m/c/s</option>
                                                                                <option  value="Eye Swab m/c/s">Eye Swab m/c/s</option>
                                                                                <option value="Aspirate m/c/s">Aspirate m/c/s</option>
                                                                                <option value="Thoracic Swab m/c/s">Thoracic Swab m/c/s</option>
                                                                                <option  value="Nasal Swab m/c/s">Nasal Swab m/c/s</option>
                                                                                <option  value="Skin Swab m/c/s">Skin Swab m/c/s</option>
                                                                                <option value="Pus m/c/s">Pus m/c/s</option>
                                                                                <option value="Mouth Swab m/c/s">Mouth Swab m/c/s</option>
                                                                                <option  value="Catheter tip m/c/s">Catheter tip m/c/s</option>
                                                                                <option value="IUD m/c/s">IUD m/c/s</option>
                                                                                <option  value="Ulcer material m/c/s">Ulcer material m/c/s</option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>  -->

                                                                    <tr>
                                                                        <td><b> Pus Cell </b> </td>
                                                                        <td><input class="form-control" value="<?php echo $spu_pus_cells; ?>" name="spu_pus_cells"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Yeast Cell </b> </td>
                                                                        <td><input class="form-control" value="<?php echo $spu_yeast_cells; ?>" name="spu_yeast_cells"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Epithelia Cell </b> </td>
                                                                        <td><input class="form-control" value="<?php echo $spu_epith; ?>" name="spu_epith"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Gram Positive Cocci </b> </td>
                                                                        <td><input class="form-control" value="<?php echo $spu_pos; ?>" name="spu_pos"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Gram Negative Baccili  </b> </td>
                                                                        <td><input class="form-control" value="<?php echo $spu_neg; ?>" name="spu_neg"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Gram Positive Rod  </b> </td>
                                                                        <td><input class="form-control" value="<?php echo $spu_pos_rod; ?>" name="spu_pos_rod"/></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Gram Negative Cocci  </b> </td>
                                                                        <td><input class="form-control" value="<?php echo $spu_neg_cocci; ?>" name="spu_neg_cocci"/></td>
                                                                    </tr>


                                                                    <tr>
                                                                        <td><b> Culture</b> </td>
                                                                        <td> <!-- <input class="form-control" value="<?php // echo $spu_culture; ?>" name="spu_culture"/>  -->
                                                                            <textarea class="form-control" cols="4" rows="3" name="spu_culture" <?php echo $spu_culture; ?>></textarea>
                                                                        </td>
                                                                    </tr>



                                                                </table>
                                                            </table>

                                                        </div>
                                                        <div class="col-md-6">




                                                            <table>


                                                                <table class="table table-bordered">


                                                                    <tr>
                                                                        <td colspan="2" style="text-align: center"><b> BLOOD CULTURE  </b></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Preliminary Result </b> </td>
                                                                        <td> <!--  <input class="form-control" value="<?php // echo $prelim; ?>" name="prelim"/>  -->
                                                                            <textarea class="form-control" cols="4" rows="3" name="prelim" <?php echo $prelim; ?>></textarea>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Final Result </b> </td>
                                                                        <td> <!-- <input class="form-control" value="<?php // echo $final; ?>" name="final"/>  -->
                                                                            <textarea class="form-control" cols="4" rows="3" name="final" <?php echo $final; ?>></textarea>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2" style="text-align: center"><b> MYCOLOGY  </b> </td>

                                                                    </tr>

                                                                    <tr>
                                                                        <td><b> Microscopy </b> </td>
                                                                        <td><input class="form-control" value="<?php echo $mycology; ?>" name="mycology"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b> Culture </b> </td>
                                                                        <td><textarea class="form-control" cols="4" rows="3" name="mycology_culture" <?php echo $mycology_culture; ?>></textarea></td>
                                                                    </tr>



                                                                </table>
                                                            </table>


                                                        </div>
                                                    </div>

                                                    <b>NOTES </b>
                                                    <textarea class="form-control" cols="4" rows="6" name="notes" <?php echo $notes; ?>></textarea>
                                                    <br/>




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

                                                    <table class="table ">
                                                        <thead>
                                                        <tr>
                                                            <th>Stool Analysis </th>
                                                            <th></th>
                                                            <th>Blood Parasites </th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>Macroscopy</td>
                                                            <td> <input class="form-control" value="<?php echo $macroscopy; ?>"  name="macroscopy"/> </td>
                                                            <td>Malaria Parasite</td>
                                                            <td> <input class="form-control"  value="<?php echo $mp; ?>"  name="mp"/>  </td>
                                                        </tr>


                                                        <tr>
                                                            <td>Microscopy</td>
                                                            <td> <input class="form-control" value="<?php echo $microscopy; ?>"  name="microscopy"/> </td>
                                                            <td>Microfilaria</td>
                                                            <td> <input class="form-control"  value="<?php echo $microfilaria; ?>"  name="microfilaria"/>  </td>
                                                        </tr>

                                                        <tr>
                                                            <td> Others  </td>
                                                            <td> <input class="form-control" value="<?php echo $others; ?>"  name="others"/> </td>
                                                            <td>Trypanosomes</td>
                                                            <td> <input class="form-control"  value="<?php echo $trypanosomes; ?>"  name="trypanosomes"/>  </td>
                                                        </tr>

                                                        <tr>
                                                            <td> <!--<h4> Ova  </h4> --></td>
                                                            <td> <!-- <input class="form-control" value="<?php echo $ova; ?>"  name="ova"/>  --> </td>
                                                            <td>Skin snip</td>
                                                            <td> <input class="form-control" value="<?php echo $skin_snip; ?>"  name="skin_snip"/> </td>
                                                        </tr>

                                                        <tr>
                                                            <td> <!-- <h4> Cysts  </h4> --></td>
                                                            <td> <!-- <input class="form-control" value="<?php echo $cysts; ?>"  name="cysts"/> --> </td>
                                                            <td><b></b></td>
                                                            <td></td>
                                                        </tr>



                                                        </tbody>
                                                    </table>


                                                    <table class="table">

                                                        <thead>
                                                        <tr>
                                                            <td colspan="6" style="text-align: center">  SPUTUM ANALYSIS  </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        <tr>
                                                            <td> Macroscopy </td>
                                                            <td> <input class="form-control" value="<?php echo $sputum_macro; ?>"  name="sputum_macro"/> </td>
                                                            <td>Microscopy</td>
                                                            <td> <td> <input class="form-control" value="<?php echo $sputum_micro; ?>"  name="sputum_micro"/> </td></td>

                                                        </tr>
                                                        <!--
            <tr>
                <td><h4> PH  </h4></td>
                <td> <input class="form-control" value="<?php echo $ph; ?>"  name="ph"/> </td>
                <td><h4>Reducing Substance</h4></td>
                <td> <td> <input class="form-control" value="<?php echo $reducing_sub; ?>"  name="reducing_sub"/> </td></td>
                <td><h4>Albumin</h4></td>
                <td><input class="form-control" value="<?php echo $albumin; ?>"  name="albumin"/> </td>
            </tr>

            <tr>
                <td><h4> Macroscopy: Clear </h4></td>
                <td>  </td>
                <td></td>
                <td> <td>  </td></td>
                <td</td>
                <td></td>
            </tr>


            <tr>
                <td><h4> Pus Cell/Hpf  </h4></td>
                <td> <input class="form-control" value="<?php echo $pus_cell_hpf; ?>"  name="pus_cell_hpf"/> </td>
                <td><h4>Rbes/Hpf </h4></td>
                <td> <td> <input class="form-control" value="<?php echo $rbes_hpf; ?>"  name="rbes_hpf"/> </td></td>
                <td><h4>Epith Cells/Hpf</h4></td>
                <td><input class="form-control" value="<?php echo $epith_cells_hpf; ?>"  name="epith_cells_hpf"/> </td>
            </tr>


            <tr>
                <td><h4> Yeast Cells  </h4></td>
                <td> <input class="form-control" value="<?php echo $yeast_cells; ?>"  name="yeast_cells"/> </td>
                <td><h4> Bacteria </h4></td>
                <td> <td> <input class="form-control" value="<?php echo $bacteria; ?>"  name="bacteria"/> </td></td>
                <td><h4>Xtals</h4></td>
                <td><input class="form-control" value="<?php echo $xtals; ?>"  name="xtals"/> </td>
            </tr>

            <tr>
                <td><h4> Cast: Hyaline  </h4></td>
                <td> <input class="form-control" value="<?php echo $hyaline; ?>"  name="hyaline"/> </td>
                <td><h4> Granular </h4></td>
                <td> <td> <input class="form-control" value="<?php echo $granular; ?>"  name="granular"/> </td></td>
                <td><h4>Cellular</h4></td>
                <td><input class="form-control" value="<?php echo $cellular; ?>"  name="cellular"/> </td>
            </tr>

            <tr>
                <td><h4> Parasites </h4></td>
                <td colspan="6"> <input class="form-control" value="<?php echo $parasites; ?>"  name="parasites"/> </td>
            </tr>

            <tr>
                <td> <input class="form-control" value="<?php echo $wbes; ?>"  name="wbes"/> </td>
                <td><h4> Wbes/cmm   </h4></td>
                <td> <td> <input class="form-control" value="<?php echo $polymorphs; ?>"  name="polymorphs"/> </td></td>
                <td><h4> % Polymorphs </h4></td>
                <td><input class="form-control" value="<?php echo $lymphocytes; ?>"  name="lymphocytes"/> </td>
                <td><h4>% Lymphocytes</h4></td>

            </tr>

 -->

                                                        </tbody>

                                                    </table>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <a class="card-link" data-toggle="collapse" href="#collapseHisto">
                                                    Histology
                                                </a>
                                            </div>
                                            <div id="collapseHisto" class="collapse" data-parent="#accordion">
                                                <div class="card-body">


                                                    <div class="row">
                                                        <div class="col-md-6">

                                                            <div class="form-group">
                                                                <label>HISTOPATHOLOGY</label>
                                                                <br/>
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Processing" value="Processing" >
                                                                    <span>Processing</span>
                                                                </label> <br/>
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Microtomy" value="Microtomy">
                                                                    <span>Microtomy</span>
                                                                </label> <br/>
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="H & E" value="H & E">
                                                                    <span>H & E</span>
                                                                </label> <br/>
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Special Stain" value="Special Stain">
                                                                    <span>Special Stain</span>
                                                                </label> <br/>
                                                                <p id="error-checkbox"></p>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>CYTOPATHOLOGY</label>
                                                                <br/>
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Processing" value="Processing" >
                                                                    <span>Processing</span>
                                                                </label> <br/>
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Staining" value="Staining">
                                                                    <span>Staining</span>
                                                                </label> <br/>
                                                                <p id="error-checkbox"></p>
                                                            </div>

                                                            <div class="form-group">

                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Frozen Section" value="Frozen Section" >
                                                                    <!--   <span>Processing</span>--> <span>FROZEN SECTION</span>
                                                                </label> <br/>

                                                                <p id="error-checkbox"></p>
                                                            </div>


                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>IMMUNOHISTOCHEMISTRY</label>
                                                                        <br/>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="Breast Panel" value="Breast Panel" >
                                                                            <span>Breast Panel</span>
                                                                        </label> <br/>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="ER" value="ER">
                                                                            <span>ER</span>
                                                                        </label> <br/>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="PR" value="PR">
                                                                            <span>PR</span>
                                                                        </label> <br/>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="HER-2" value="HER-2">
                                                                            <span>HER-2</span>
                                                                        </label> <br/>
                                                                        <p id="error-checkbox"></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">

                                                                        <br/>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="Lymphoma" value="Lymphoma" >
                                                                            <span>Lymphoma</span>
                                                                        </label> <br/>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="CD3" value="CD3">
                                                                            <span>CD3</span>
                                                                        </label> <br/>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="CD20" value="CD20">
                                                                            <span>CD20</span>
                                                                        </label> <br/>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="CD15" value="CD15">
                                                                            <span>CD15</span>
                                                                        </label> <br/>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="CD10" value="CD10">
                                                                            <span>CD10</span>
                                                                        </label> <br/>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="CD45" value="CD45">
                                                                            <span>CD45</span>
                                                                        </label> <br/>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="CD117" value="CD117">
                                                                            <span>CD117</span>
                                                                        </label> <br/>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="Ki67" value="Ki67">
                                                                            <span>Ki67</span>
                                                                        </label> <br/>
                                                                        <p id="error-checkbox"></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">

                                                                        <br/>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="Soft Tissue" value="Soft Tissue" >
                                                                            <span>Soft Tissue</span>
                                                                        </label> <br/>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="WTI" value="WTI">
                                                                            <span>WTI</span>
                                                                        </label> <br/>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="EMA" value="EMA">
                                                                            <span>EMA</span>
                                                                        </label> <br/>
                                                                        <label class="fancy-checkbox">
                                                                            <input type="checkbox" name="CEA" value="CEA">
                                                                            <span>CEA</span>
                                                                        </label> <br/>
                                                                        <p id="error-checkbox"></p>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label> CUT-UP </label>
                                                                <br/>
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="For Decalafication" value="For Decalafication" >
                                                                    <span>For Decalafication</span>
                                                                </label> <br/>
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="No Of Cassettes" value="No Of Cassettes">
                                                                    <span>No Of Cassettes</span>
                                                                </label>
                                                            </div>

                                                            <div class="form-group">
                                                                <b>MACROSCOPY </b>
                                                                <textarea rows="15" cols="50" class="form-control" name="macroscopy_note">
                                                                    <?php echo $macroscopy_note; ?>
                                                                </textarea>
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