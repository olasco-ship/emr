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

                </div>
            </div>



            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">

                        <div class="body">
                            <div class="container">

                                <a href="../lab/sample_analysis.php">Back</a>

                                <h4 style="text-align: center">OBAFEMI AWOLOWO UNIVERSITY TEACHING HOSPITALS COMPLEX</h4>
                                <h6 style="text-align: center">BLOOD TRANSFUSION FORM</h6>


                                <form action="" method="post">




                                    <div class="card">
                                        <div class="card-header">

                                            Blood Transfusion

                                        </div>

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
                                                                    <td><input class="form-control" name="other_blood" value="<?php echo $other_blood; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b>Exchange Blood Transfusion</b></td>
                                                                    <td><input class="form-control" name="exchange" value="<?php echo $exchange; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b>ABO and Rh Grouping Only</b></td>
                                                                    <td><input class="form-control" name="abo_rh" value="<?php echo $abo_rh; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b>Hepatitis 'C' Surface Ag Screening</b></td>
                                                                    <td><input class="form-control" name="hep_c" value="<?php echo $hep_c; ?>" type="text">
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b>Direct Coombs' Test</b></td>
                                                                    <td><input class="form-control" name="coombs_test" value="<?php echo $coombs_test; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b>Indirect Coombs' Test</b></td>
                                                                    <td><input class="form-control" name="ind_coombs_test" value="<?php echo $ind_coombs_test; ?>" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b>Other Antibody Screening</b></td>
                                                                    <td><input class="form-control" name="anti_screening" value="<?php echo $anti_screening; ?>" type="text"></td>

                                                                </tr>

                                                                <tr>
                                                                    <td><b>HBsAg <!--Screening--></b></td>
                                                                    <td><select class="form-control" name="hep_b">
                                                                            <option value=""></option>
                                                                            <option value="Positive">Positive</option>
                                                                            <option value="Negative">Negative</option>
                                                                        </select>
                                                                        <!--<input class="form-control" name="hep_b" value="<?php /*echo $hep_b; */?>" type="text">-->
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b>HBsAb</b></td>
                                                                    <td><select class="form-control" name="hbs_ab">
                                                                            <option value=""></option>
                                                                            <option value="Positive">Positive</option>
                                                                            <option value="Negative">Negative</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b>HBeAg</b></td>
                                                                    <td><select class="form-control" name="hbe_ag">
                                                                            <option value=""></option>
                                                                            <option value="Positive">Positive</option>
                                                                            <option value="Negative">Negative</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b>HBeAb</b></td>
                                                                    <td><select class="form-control" name="hbe_ab">
                                                                            <option value=""></option>
                                                                            <option value="Positive">Positive</option>
                                                                            <option value="Negative">Negative</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b>HBcAb(Total)</b></td>
                                                                    <td><select class="form-control" name="hbc_ab">
                                                                            <option value=""></option>
                                                                            <option value="Positive">Positive</option>
                                                                            <option value="Negative">Negative</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td><b>HBcAb(IgM)</b></td>
                                                                    <td><select class="form-control" name="hbc_ab_igm">
                                                                            <option value=""></option>
                                                                            <option value="Positive">Positive</option>
                                                                            <option value="Negative">Negative</option>
                                                                        </select>
                                                                    </td>
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
                                                        <h5>ABO/Rh</h5>
                                                        <dl class="dl-horizontal">

                                                            <dt>
                                                                Grp.
                                                            </dt>
                                                            <dd>
                                                                <input class="form-control" style="width: 70px;" value="<?php echo $group_one; ?>" name="group_one" />

                                                            </dd>
                                                            <dt>
                                                                Grp.
                                                            </dt>
                                                            <dd>
                                                                <input class="form-control" style="width: 70px;" value="<?php echo $group_two; ?>" name="group_two" />

                                                            </dd>
                                                            <dt>
                                                                Grp.
                                                            </dt>
                                                            <dd>
                                                                <input class="form-control" style="width: 70px;" value="<?php echo $group_three; ?>" name="group_three" />

                                                            </dd>

                                                            <dt>
                                                                Grp.
                                                            </dt>
                                                            <dd>
                                                                <input class="form-control" style="width: 70px;" value="<?php echo $group_four; ?>" name="group_four" />

                                                            </dd>

                                                        </dl>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5>Date/Time</h5>
                                                        <dl class="dl-horizontal">

                                                            <dt>

                                                            </dt>
                                                            <dd>
                                                                <input class="form-control" style="width: 150px;" id="rh1" value="<?php echo $rh_one; ?>" name="rh_one" />


                                                            </dd>
                                                            <dt>

                                                            </dt>
                                                            <dd>
                                                                <input class="form-control" style="width: 150px;" id="rh2" value="<?php echo $rh_two; ?>" name="rh_two" />


                                                            </dd>
                                                            <dt>

                                                            </dt>
                                                            <dd>
                                                                <input class="form-control" style="width: 150px;" id="rh3" value="<?php echo $rh_three; ?>" name="rh_three" />


                                                            </dd>

                                                            <dt>

                                                            </dt>
                                                            <dd>
                                                                <input class="form-control" style="width: 150px;" id="rh4" value="<?php echo $rh_four; ?>" name="rh_four" />


                                                            </dd>

                                                        </dl>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-md-10">


                                                        <div class="form-group">
                                                            <label for="quantity" class="control-label col-md-4"> REPORT OF SEROLOGICAL INVESTIGATION:</label>
                                                            <div class="col-md-8" style="width: 500px">
                                                                <textarea class="form-control" name="rep_ser_inv">  </textarea>


                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-2"></div>

                                                </div>

                                                <p class="margin-top-30">
                                                    <button type="submit" name="prelim_save" class="btn btn-lg btn-primary"> Preliminary Save</button> &nbsp;&nbsp;
                                                    <button type="submit" name="final_save" class="btn btn-lg btn-success">Final Save</button>
                                                </p>

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
