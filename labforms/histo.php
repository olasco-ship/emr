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
                                <h6 style="text-align: center">HISTOLOGY FORM</h6>


                                <form action="" method="post">

                                    <div class="card">
                                        <div class="card-header">
                                            Histology
                                        </div>

                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label>HISTOPATHOLOGY</label>
                                                        <br />
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="Processing" value="Processing">
                                                            <span>Processing</span>
                                                        </label> <br />
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="Microtomy" value="Microtomy">
                                                            <span>Microtomy</span>
                                                        </label> <br />
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="H&E" value="H&E">
                                                            <span>H & E</span>
                                                        </label> <br />
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="SpecialStain" value="SpecialStain">
                                                            <span>Special Stain</span>
                                                            <input type="text" name="" value="" >
                                                        </label> <br />
                                                        <p id="error-checkbox"></p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>CYTOPATHOLOGY</label>
                                                        <br />
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="CytoProcessing" value="CytoProcessing">
                                                            <span>Macroscopy</span>
                                                        </label> <br />

                                                        <label class="fancy-checkbox">
                                                            <textarea class="form-control"></textarea>
                                                        </label> <br />


                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="CytoProcessing" value="CytoProcessing">
                                                            <span>Processing</span>
                                                        </label> <br />
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="CytoStaining" value="CytoStaining">
                                                            <span>Staining</span>
                                                        </label> <br />

                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="CytoProcessing" value="CytoProcessing">
                                                            <span>H/E</span>
                                                        </label> <br />
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="CytoStaining" value="CytoStaining">
                                                            <span>PAP</span>
                                                        </label> <br />
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="CytoStaining" value="CytoStaining">
                                                            <span>Gimsa</span>
                                                        </label> <br />
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="breast_others" value="breast_others">
                                                            <span>Others</span>
                                                            <input type="text" name="" value="" >
                                                        </label>
                                                        <p id="error-checkbox"></p>
                                                    </div>

                                            <!--        <div class="form-group">
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="FrozenSection" value="FrozenSection">
                                                            <span>FROZEN SECTION</span>
                                                        </label> <br />
                                                        <p id="error-checkbox"></p>
                                                    </div>-->

                                                    <label>FROZEN SECTION</label>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="fancy-checkbox">
                                                                <input type="checkbox" name="ER" value="ER">
                                                                <span>Processing</span>
                                                            </label> <br />
                                                            <label class="fancy-checkbox">
                                                                <input type="checkbox" name="HER-2" value="HER-2">
                                                                <span>H/E</span>
                                                            </label> <br />
                                                            <label class="fancy-checkbox">
                                                                <input type="checkbox" name="breast_others" value="breast_others">
                                                                <span>Others</span>
                                                                <input type="text" name="" value="" >
                                                            </label>
                                                            <p id="error-checkbox"></p>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>IMMUNOHISTOCHEMISTRY</label>
                                                                <br /> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Breast Panel" value="Breast Panel">
                                                                    <!--  <span>Breast Panel</span> -->
                                                                    <label><b> Breast Panel </b></label>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="ER" value="ER">
                                                                    <span>ER</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="PR" value="PR">
                                                                    <span>PR</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="HER-2" value="HER-2">
                                                                    <span>HER-2</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="breast_others" value="breast_others">
                                                                    <span>Others</span>
                                                                    <input type="text" name="" value="" >
                                                                </label>
                                                                <p id="error-checkbox"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">

                                                                <br /><br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Lymphoma" value="Lymphoma">
                                                                    <!-- <span>Lymphoma</span> -->
                                                                    <label><b> Lymphoma </b></label>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="CD3" value="CD3">
                                                                    <span>CD3</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="CD20" value="CD20">
                                                                    <span>CD20</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="CD15" value="CD15">
                                                                    <span>CD15</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="CD10" value="CD10">
                                                                    <span>CD10</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="CD45" value="CD45">
                                                                    <span>CD45</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="CD117" value="CD117">
                                                                    <span>CD117</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Ki67" value="Ki67">
                                                                    <span>Ki67</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="lymph_others" value="lymph_others">
                                                                    <span>Others</span>
                                                                    <input type="text" name="" value="" >
                                                                </label>
                                                                <p id="error-checkbox"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">

                                                                <br /><br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="Soft Tissue" value="Soft Tissue">
                                                                    <!--  <span>Soft Tissue</span> -->
                                                                    <label><b> Soft Tissue </b></label>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="WTI" value="WTI">
                                                                    <span>WTI</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="EMA" value="EMA">
                                                                    <span>EMA</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="CEA" value="CEA">
                                                                    <span>CEA</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="soft_others" value="soft_others">
                                                                    <span>Others</span>
                                                                    <input type="text" name="" value="" >
                                                                </label>
                                                                <p id="error-checkbox"></p>
                                                            </div>
                                                        </div>
                                                    </div>




                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>IMMUNOFLOURESCENCE</label>
                                                                <br /> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="C3C" value="C3C">
                                                                    <span>C3C</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="IgA" value="IgA">
                                                                    <span>IgA</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="IgG" value="IgG">
                                                                    <span>IgG</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="IgM" value="IgM">
                                                                    <span>IgM</span>
                                                                </label> <br />
                                                                <label class="fancy-checkbox">
                                                                    <input type="checkbox" name="fluo_others" value="fluo_others">
                                                                    <span>Others</span>
                                                                    <input type="text" >
                                                                </label>
                                                                <p id="error-checkbox"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">

                                                        </div>
                                                        <div class="col-md-4">

                                                        </div>
                                                    </div>



                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label> CUT-UP </label>
                                                        <br />
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="Decalafication" value="Decalafication">
                                                            <span>For Decalafication</span>
                                                        </label> <br />
                                                        <label class="fancy-checkbox">
                                                            <input type="checkbox" name="Cassettes" value="Cassettes">
                                                            <span>No Of Cassettes</span>
                                                            <input type="text" name="cassettes_no" value="" >
                                                        </label>
                                                    </div>

                                                    <div class="form-group">
                                                        <b>MACROSCOPY </b>
                                                        <textarea rows="35" cols="50" class="form-control" name="macroscopy_note">
                                                                    <?php echo $macroscopy_note; ?>
                                                                </textarea>
                                                    </div>


                                                    <p class="margin-top-30">&nbsp;&nbsp;
                                                        <button type="submit" name="prelim_save" class="btn btn-lg btn-primary"> Preliminary Save</button> &nbsp;&nbsp;
                                                        <button type="submit" name="final_save" class="btn btn-lg btn-success">Final Save</button>
                                                    </p>
                                                </div>
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
    </div>











<?php

require('../layout/footer.php');
