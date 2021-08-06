<?php
require_once("../includes/initialize.php");




if (is_post()) {

    $value = $_POST['value'];

    $clinic = Clinic::find_by_id($value);

    switch ($clinic->name) {
        case "GOPD":
            echo "";
            break;
        case "MOPD":
               echo " 
                     <tr>
                       <th>Head Circumference</th>
                       <td style='padding-left: 30px'><input type='text' name='head_cir'  class='form-control'></td>
                     </tr>
                      <tr>
                       <th>Arm Circumference</th>
                       <td style='padding-left: 30px'><input type='text' name='arm_cir'  class='form-control'></td>
                     </tr>
                     <tr>
                       <th>Abdominal Girth </th>
                       <td style='padding-left: 30px'><input type='text' name='abd_girth'  class='form-control'></td>
                     </tr>
                     <tr>
                       <th> Waist  </th>
                       <td style='padding-left: 30px'><input type='text' name='waist'  class='form-control'></td>
                     </tr>
                      <tr>
                       <th> Hip Measurement  </th>
                       <td style='padding-left: 30px'><input type='text' name='hip_measure'  class='form-control'></td>
                     </tr>
                      <tr>
                       <th> Chest Circumference  </th>
                       <td style='padding-left: 30px'><input type='text' name='chest_cir'  class='form-control'></td>
                     </tr>
                     <tr>
                       <th> HD (Hemodialysis) </th>
                       <td style='padding-left: 30px'><input type='text' name='hd'  class='form-control'></td>
                     </tr>
                      <tr>
                       <th> HDF (Hemodiafiltrion)  </th>
                       <td style='padding-left: 30px'><input type='text' name='hdf'  class='form-control'></td>
                     </tr>
                     
                      <tr>
                       <th> Seizure Chart  </th>
                       <td style='padding-left: 30px'><input type='text' name='seizure'  class='form-control'></td>
                     </tr>
                      <tr>
                       <th> Suicide Monitoring Chart  </th>
                       <td style='padding-left: 30px'><input type='text' name='suicide'  class='form-control'></td>
                     </tr>
               ";
            break;
        case "FAMILY PLANNING":
            echo "
                     <tr>
                       <th> Uterine Depth</th>
                       <td style='padding-left: 30px'><input type='text' name='uterine_depth'  class='form-control'></td>
                     </tr>
                      <tr>
                       <th> Cervical Appearance </th>
                       <td style='padding-left: 30px'><input type='text' name='cerv_app'  class='form-control'></td>
                     </tr>
                    
            ";
            break;
        case "OPHTHALMOLOGY":
            echo "
                     <tr>
                       <th> Visual Acuity </th>
                       <td style='padding-left: 30px'><input type='text' name='visual_acuity'  class='form-control'></td>
                     </tr>
                      <tr>
                       <th> Endoscopy  </th>
                       <td style='padding-left: 30px'><input type='text' name='endoscopy'  class='form-control'></td>
                     </tr>
                      <tr>
                       <th> Intraocular Pressure </th>
                       <td style='padding-left: 30px'><input type='text' name='intra_pressure'  class='form-control'></td>
                     </tr>
                      <tr>
                       <th> Instillation Chart  </th>
                       <td style='padding-left: 30px'><input type='text' name='instil'  class='form-control'></td>
                     </tr>
                    
            ";
            break;
        case "ENT":
            echo "
                     <tr>
                       <th> Audiometry  </th>
                       <td style='padding-left: 30px'><input type='text' name='audio'  class='form-control'></td>
                     </tr>
                      <tr>
                       <th> Tympanometry  </th>
                       <td style='padding-left: 30px'><input type='text' name='tympa'  class='form-control'></td>
                     </tr>
                    
            ";
            break;
        case "ANTENATAL &amp; POS-NATAL":
            echo "
                     <tr>
                       <th> Estimated Gestational Age  </th>
                       <td style='padding-left: 30px'><input type='text' name='estimated'  class='form-control'></td>
                     </tr>
                      <tr>
                       <th> Fundal Height  </th>
                       <td style='padding-left: 30px'><input type='text' name='fundal'  class='form-control'></td>
                     </tr>
                      <tr>
                       <th> Pelvic Palpation    </th>
                       <td style='padding-left: 30px'><input type='text' name='pelvic'  class='form-control'></td>
                     </tr>
                      <tr>
                       <th> Fetal Heart Rate  </th>
                       <td style='padding-left: 30px'><input type='text' name='fetal_heart'  class='form-control'></td>
                     </tr>
                     <tr>
                       <th> Fetal Lie & Position    </th>
                       <td style='padding-left: 30px'><input type='text' name='fetal_lie'  class='form-control'></td>
                     </tr>
                      <tr>
                       <th> Presentation    </th>
                       <td style='padding-left: 30px'><input type='text' name='presentation'  class='form-control'></td>
                     </tr>
                    
            ";
            break;
        case "PAEDIATRICS":
            echo "
                     <tr>
                       <th> Occipito Frontal Circumferences </th>
                       <td style='padding-left: 30px'><input type='text' name='ofc'  class='form-control'></td>
                     </tr>
                      <tr>
                       <th> Mid Arm Circumferences  </th>
                       <td style='padding-left: 30px'><input type='text' name='mid_arm'  class='form-control'></td>
                     </tr>
                    
            ";
            break;
        default:
            echo "";
    }





  ?>


<!--    <select class="form-control" id="sub_clinic_id" name="sub_clinic_id" required>
        <option value="">--Select Sub-Clinic--</option>
        <?php
/*        foreach ($subClinic as $clinic) { */?>
            <option
                value="<?php /*echo $clinic->id; */?>"><?php /*echo $clinic->name; */?>
            </option>
        <?php /*} */?>
    </select>-->


<?php } ?>




