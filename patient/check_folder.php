<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/17/2019
 * Time: 8:43 AM
 */


require_once("../includes/initialize.php");


/*if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $folder = $_POST['folder_number'];

    $patient = Patient::find_by_number($folder);

    if (!empty($patient)){
        echo "exist";
    } else {
        echo 'notexist';
    }
}*/


if (is_post()) {

    $folder = $_POST['folder_number'];
    $patient = Patient::find_by_number($folder);
    if (!empty($patient)) {
  ?>
    <span style="color: red" id="folderResult">Hospital Number already exist!</span>
        <?php } else { ?>
        <span id="folderResult"></span>
   <?php     }   ?>




<?php } ?>









