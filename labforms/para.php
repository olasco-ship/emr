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

                                <h4 style="text-align: center">OBAFEMI AWOLOWO UNIVERSITY TEACHING HOSPITALS COMPLEX, ILE-IFE</h4>
                                <h6 style="text-align: center">DEPARTMENT OF MEDICAL MICROBIOLOGY AND PARASITOLOGY</h6>
                                <h6 style="text-align: center">PARASITOLOGY FORM</h6>


                                <form action="" method="post">


                                    <div class="card">
                                        <div class="card-header">
                                            Parasitology
                                        </div>

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
                                                        <td> <input class="form-control" value="<?php echo $macroscopy; ?>" name="macroscopy" /> </td>
                                                        <td>Malaria Parasite</td>
                                                        <td> <input class="form-control" value="<?php echo $mp; ?>" name="mp" /> </td>
                                                    </tr>


                                                    <tr>
                                                        <td>Microscopy</td>
                                                        <td> <input class="form-control" value="<?php echo $microscopy; ?>" name="microscopy" /> </td>
                                                        <td>Microfilaria</td>
                                                        <td> <input class="form-control" value="<?php echo $microfilaria; ?>" name="microfilaria" /> </td>
                                                    </tr>

                                                    <tr>
                                                        <td> Others </td>
                                                        <td> <input class="form-control" value="<?php echo $others; ?>" name="others" /> </td>
                                                        <td>Trypanosomes</td>
                                                        <td> <input class="form-control" value="<?php echo $trypanosomes; ?>" name="trypanosomes" /> </td>
                                                    </tr>

                                                    <tr>
                                                        <td>  </td>
                                                        <td> </td>
                                                        <td> Others </td>
                                                        <td> <input class="form-control" value="<?php echo $others; ?>" name="others" /> </td>
                                                    </tr>

                                                    <thead>
                                                    <tr>
                                                        <td colspan="6" style="text-align: center"><b> SKIN SNIP </b> </td>
                                                    </tr>
                                                    </thead>

                                                    <tr>


                                                        <!-- <td>Skin snip</td>  -->
                                                        <td colspan="6"> <input class="form-control" value="<?php echo $skin_snip; ?>" name="skin_snip" /> </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <!-- <h4> Cysts  </h4> -->
                                                        </td>
                                                        <td>
                                                            <!-- <input class="form-control" value="<?php echo $cysts; ?>"  name="cysts"/> -->
                                                        </td>
                                                        <td><b></b></td>
                                                        <td></td>
                                                    </tr>

                                                    </tbody>
                                                </table>


                                                <table class="table">

                                                    <thead>
                                                    <tr>
                                                        <td colspan="6" style="text-align: center"> <b> SPUTUM ANALYSIS </b> </td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <tr>
                                                        <td> Macroscopy </td>
                                                        <td> <input class="form-control" value="<?php echo $sputum_macro; ?>" name="sputum_macro" /> </td>
                                                        <td>Microscopy</td>
                                                        <td>
                                                        <td> <input class="form-control" value="<?php echo $sputum_micro; ?>" name="sputum_micro" /> </td>
                                                        </td>

                                                    </tr>


                                                    <tr>
                                                        <td colspan="4"><textarea class="form-control" cols="150" rows="6" name="notes" placeholder="Remarks"></textarea></td>
                                                    </tr>


                                                    </tbody>

                                                </table>
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
