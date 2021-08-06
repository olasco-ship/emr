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


if (is_post()) {



    $pus_cells       = $_POST['pus_cells'];
    $red_blood_cells = $_POST['red_blood_cells'];
    $starch_granules = $_POST['starch_granules'];
    $ova             = $_POST['ova'];
    $cysts           = $_POST['cysts'];
    $plasmodium      = $_POST['plasmodium'];
    $microfilaria    = $_POST['microfilaria'];
    $trypanosomes    = $_POST['trypanosomes'];
    $macroscopy_clear = $_POST['macroscopy_clear'];
    $colourless      = $_POST['colourless'];
    $turbid          = $_POST['turbid'];
    $ph              = $_POST['ph'];
    $reducing_sub    = $_POST['reducing_sub'];
    $albumin         = $_POST['albumin'];
    $pus_cell_hpf    = $_POST['pus_cell_hpf'];
    $rbes_hpf        = $_POST['rbes_hpf'];
    $epith_cells_hpf = $_POST['epith_cells_hpf'];
    $yeast_cells     = $_POST['yeast_cells'];
    $bacteria        = $_POST['bacteria'];
    $xtals           = $_POST['xtals'];
    $hyaline         = $_POST['hyaline'];
    $granular        = $_POST['granular'];
    $cellular        = $_POST['cellular'];
    $parasites       = $_POST['parasites'];
    $wbes            = $_POST['wbes'];
    $polymorphs      = $_POST['polymorphs'];
    $lymphocytes     = $_POST['lymphocytes'];
    $notes           = $_POST['notes'];

    $macroscopy      = $_POST['macroscopy'];
    $microscopy      = $_POST['microscopy'];
    $others          = $_POST['others'];
    $mp              = $_POST['mp'];
    $skin_snip       = $_POST['skin_snip'];
    $sputum_macro    = $_POST['sputum_macro'];
    $sputum_micro    = $_POST['sputum_micro'];


    $para                       = new stdClass();
    $para->PusCells             = $pus_cells;
    $para->RedBloodCells        = $red_blood_cells;
    $para->StarchGranules       = $starch_granules;
    $para->Ova                  = $ova;
    $para->Cysts                = $cysts;
    $para->Plasmodium           = $plasmodium;
    $para->microfilaria         = $microfilaria;
    $para->Trypanosomes         = $trypanosomes;
    $para->MacroscopyClear      = $macroscopy_clear;
    $para->Colourless           = $colourless;
    $para->Turbid               = $turbid;
    $para->PH                   = $ph;
    $para->ReducingSubstance    = $reducing_sub;
    $para->Albumin              = $albumin;
    $para->PusCellHpf           = $pus_cell_hpf;
    $para->RbesHpf              = $rbes_hpf;
    $para->EpithCellsHpf        = $epith_cells_hpf;
    $para->YeastCells           = $yeast_cells;
    $para->Bacteria             = $bacteria;
    $para->xtals                = $xtals;
    $para->Hyaline              = $hyaline;
    $para->Granular             = $granular;
    $para->Cellular             = $cellular;
    $para->Parasites            = $parasites;
    $para->Wbes                 = $wbes;
    $para->Polymorphs           = $polymorphs;
    $para->lymphocytes          = $lymphocytes;
    $para->notes                = $notes;
    

    $para->macroscopy           = $macroscopy;
    $para->microscopy           = $microscopy;
    $para->others               = $others;
    $para->mp                   = $mp;
    $para->skin_snip            = $skin_snip;
    $para->sputum_macro         = $sputum_macro;
    $para->sputum_micro         = $sputum_micro;

    $json = json_encode($para);
    //   echo $json; exit;

    $result->lab_no         = $_POST['lab_no'];
    $result->scientist_note = $note;
    $result->resultData     = $json;
    $result->scientist      = $user->full_name();
    $result->qc_officer     = "";
    $result->date           = strftime("%Y-%m-%d %H:%M:%S", time());
    if (isset($_POST['prelim_save'])) {
        $result->status         = 'PRELIM';
        $result->save();
        $session->message("Result has been saved.");
        redirect_to('qc_check.php');
    }
    if (isset($_POST['final_save'])) {
        $result->status         = 'FINAL';
        $result->save();
        $session->message("Result has been sent to Doctor.");
        redirect_to('qc_check.php');
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

                                <div class="row">
                                    <div class="col-md-6">


                                        <div class="table-responsive">
                                            <!--<h4><?php /*echo $patient->full_name() */ ?></h4>-->
                                            <table class="table table">
                                                <tbody>
                                                    <tr class="active">
                                                        <th>Patient</th>
                                                        <td> <?php
                                                                if (!empty($patient)) {
                                                                    echo $patient->full_name();
                                                                } else {
                                                                    $labWalkIn = LabWalkIn::find_by_id($result->labWalkIn_id);
                                                                    echo $labWalkIn->first_name . " " . $labWalkIn->last_name;
                                                                }
                                                                ?>
                                                        </td>
                                                    </tr>
                                                    <tr class="active">
                                                        <th>Clinical Details</th>
                                                        <td> <?php echo $result->doctor_note  ?></td>
                                                    </tr>

                                                    <tr class="active">
                                                        <th>Birthdate</th>
                                                        <td> <?php
                                                                if (!empty($patient)) {
                                                                    $d_date = date('d-M-Y', strtotime($patient->dob));
                                                                    echo $d_date;
                                                                } else {
                                                                    echo 'NA';
                                                                }
                                                                ?>
                                                        </td>
                                                    </tr>

                                                    <tr class="active">
                                                        <th>Age</th>
                                                        <td> <?php
                                                                if (!empty($patient)) {
                                                                    echo getAge($patient->dob) . 'years';
                                                                } else {
                                                                    $labWalkIn = LabWalkIn::find_by_id($result->labWalkIn_id);
                                                                    echo $labWalkIn->age . 'years';
                                                                }
                                                                ?>
                                                        </td>
                                                    </tr>
                                                    <tr class="active">
                                                        <th>Sex</th>
                                                        <td> <?php
                                                                if (!empty($patient)) {
                                                                    echo $patient->gender;
                                                                } else {
                                                                    $labWalkIn = LabWalkIn::find_by_id($result->labWalkIn_id);
                                                                    echo $labWalkIn->gender;
                                                                }
                                                                ?>
                                                        </td>
                                                    </tr>

                                                    <tr class="active">
                                                        <th>Specimen</th>
                                                        <td> <?php $decode = json_decode($result->specimen);
                                                                foreach ($decode as $item) {
                                                                    echo $item . ', ';
                                                                }
                                                                ?>
                                                        </td>
                                                    </tr>

                                                    <tr class="active">
                                                        <th>Test</th>
                                                        <td> <?php $decode = json_decode($result->test);
                                                                foreach ($decode as $item) {
                                                                    echo $item . ', ';
                                                                }
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
                                                    <!--   <td> <input class="form-control"  style="width: 300px;" value="<?php isset($result->lab_no) ? $result->lab_no : $lab_no ?>" name="lab_no"/> </td>   -->
                                                    <td> <input class="form-control" style="width: 300px;" value="<?php echo $result->lab_no ?>" name="lab_no" /> </td>
                                                </tr>

                                                <tr class="active">
                                                    <th>Hospital No.</th>
                                                    <td> <?php
                                                            // echo $patient->folder_number;
                                                            if (!empty($patient)) {
                                                                echo $patient->folder_number;
                                                            } else {
                                                                echo 'NA';
                                                            }
                                                            ?>
                                                    </td>
                                                </tr>
                                                <tr class="active">
                                                    <th>Clinic </th>
                                                    <td> <?php
                                                            if (!empty($patient)) {
                                                                echo $result->clinic;
                                                            } else {
                                                                echo 'NA';
                                                            }
                                                            ?>
                                                    </td>
                                                </tr>
                                                <tr class="active">
                                                    <th> Doctor </th>
                                                    <td> <?php echo $result->doctor  ?> </td>
                                                </tr>
                                                <tr class="active">
                                                    <th>Date Sample Col.</th>
                                                    <td> <?php $d_date = date('d/M/Y', strtotime($result->date_col));
                                                            $time = date('h:i a', strtotime($result->time_col));
                                                            echo $d_date . " " . $time ?> </td>
                                                </tr>


                                            </tbody>
                                        </table>

                                    </div>
                                </div>


                                <div class="card">
                                    <div class="card-header">
                                        Parasitology
                                    </div>

                                    <?php
                                    $result->resultData;
                                    $decode = json_decode($result->resultData);

                                    if (isset($result->resultData) and !empty($result->resultData)) {
                                    ?>
                                        <div class="card-body">

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <table class="table ">
                                                        <thead>
                                                            <tr>
                                                                <th>Stool Analysis </th>
                                                                <th></th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            foreach ($decode as $key => $value) {

                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'macroscopy') {   ?>
                                                                        <tr>
                                                                            <td>Macroscopy</td>
                                                                            <td> <input class="form-control" value="<?php echo $value; ?>" name="macroscopy" /> </td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }



                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'microscopy') {   ?>
                                                                        <tr>
                                                                            <td> Microscopy </td>
                                                                            <td> <input class="form-control" value="<?php echo $value; ?>" name="microscopy" /> </td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }
             
                                                            } 

                                                            foreach ($decode as $key => $value) {
                                                            if (isset($key) and !empty($key)) {
                                                                if ($key == 'others') {   ?>
                                                                    <tr>
                                                                        <td> Others </td>
                                                                        <td> <input class="form-control" value="<?php echo $value; ?>" name="others" /> </td>
                                                                    </tr>
                                                          <?php
                                                                }
                                                            } }
                                                            
                                                            
                                                            ?>

                                                        </tbody>
                                                    </table>

                                                </div>

                                                <div class="col-md-6">

                                                    <table class="table ">
                                                        <thead>
                                                            <tr>

                                                                <th>Blood Parasites </th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            foreach ($decode as $key => $value) {



                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'mp') {   ?>
                                                                        <tr>
                                                                            <td>Malaria Parasite</td>
                                                                            <td> <input class="form-control" value="<?php echo $value; ?>" name="mp" /> </td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }



                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'microfilaria') {   ?>
                                                                        <tr>
                                                                            <td> Microfilaria </td>
                                                                            <td> <input class="form-control" value="<?php echo $value; ?>" name="microfilaria" /> </td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }



                                                                if (isset($key) and !empty($key)) {
                                                                    if ($key == 'Trypanosomes') {   ?>
                                                                        <tr>
                                                                            <td> Trypanosomes </td>
                                                                            <td> <input class="form-control" value="<?php echo $value; ?>" name="trypanosomes" /> </td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                }

                                                            
                                                            }


                                                         
                                                            
                                                            
                                                            ?>

                                                        </tbody>
                                                    </table>

                                                </div>

                                            </div>





                                            <div class="row">

                                                <div class="col-md-12">

                                                    <table class="table ">
                                                       
                                                        <tbody>

                                                            <?php
                                                            foreach ($decode as $key => $value) {
                  
                                                                    if (isset($value) and !empty($value)) {
                                                                        if ($key == 'skin_snip') {
                                                                            echo "<tr>";
                                                                            echo "<td colspan='2'><b> Skin Snip </b></td>";
                                                                            echo "</tr>";
                                                                        }
                                                                    }                                                
    
                                                            
                                                                    if (isset($value) and !empty($value)) {
                                                                        if ($key == 'skin_snip') {
                                                                            echo "<tr>";
                                                                            echo "<td colspan='2'>$value</td>";
                                                                            echo "</tr>";
                                                                        }
                                                                    }
                                                         

                                                              }  ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <table class="table">

                                                <thead>
                                                    <tr>
                                                        <td colspan="6" style="text-align: center"> <b>SPUTUM ANALYSIS</b> </td>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    foreach ($decode as $key => $value) {

                                                        if (isset($key) and !empty($key)) {
                                                            if ($key == 'sputum_macro') {   ?>
                                                                <tr>
                                                                    <td>Macroscopy</td>
                                                                    <td colspan="4"> <input class="form-control" value="<?php echo $value; ?>" name="sputum_macro" /> </td>
                                                                </tr>
                                                            <?php
                                                            }
                                                        }


                                                        if (isset($key) and !empty($key)) {
                                                            if ($key == 'sputum_micro') {   ?>
                                                                <tr>
                                                                    <td>Microscopy</td>
                                                                    <td colspan="4"> <input class="form-control" value="<?php echo $value; ?>" name="sputum_micro" /> </td>
                                                                </tr>
                                                            <?php
                                                            }
                                                        }


                                                                                  

                                                    }
                                                    
                                                    foreach ($decode as $key => $value) {

                                                        if (isset($key) and !empty($key)) {
                                                            if ($key == 'notes') {   ?>
                                                                <tr>
                                                                    <td colspan="6"><textarea class="form-control" cols="150" rows="6" name="notes" placeholder="Remarks"><?php echo $value ?></textarea></td>
                                                                   <!-- <td colspan="6"><textarea class="form-control" cols="50" rows="6" name="notes" placeholder="Note"><?php echo $value ?></textarea></td>-->
                                                                </tr>
                                                    <?php
                                                            }
                                                        }   

                                                    }
                                                    
                                                    
                                                    
                                                    ?>


                                                </tbody>

                                            </table>
                                            <p class="margin-top-30">
                                            
                                                <button type="submit" name="prelim_save" class="btn btn-lg btn-primary"> Preliminary Save</button> &nbsp;&nbsp;
                                                <button type="submit" name="final_save" class="btn btn-lg btn-success">Final Save</button>
                                            </p>

                                        </div>
                                    <?php
                                    } else {
                                    ?>
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

                                    <?php }  ?>

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
