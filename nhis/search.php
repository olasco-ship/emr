<?php

require_once("../includes/initialize.php");


if (is_post()) {

    $nhis_number = $_POST['nhis_number'];

    $enrolleeSearch = Enrollee::find_by_nhis_number($nhis_number);



    if (!empty($enrolleeSearch)) {

        //  echo $enrolleeSearch->exp_date;

        $validity = checkValidity($enrolleeSearch->exp_date);
?>


        <table class="table table-responsive">
            <tr class="table-active">
                <th>First Name</th>
                <td id="account_number"><?php echo $enrolleeSearch->first_name ?></td>
            </tr>
            <tr class="table-success">
                <th>Last Name</th>
                <td id="account_name"><?php echo $enrolleeSearch->last_name ?></td>
            </tr>
            <tr class="table-info">
                <th> NHIS Number</th>
                <td id="account_balance">
                    <?php echo $enrolleeSearch->nhis_number ?>
                </td>
            </tr>
            <tr class="table-active">
                <th> Subsciption (Start Date) </th>
                <td id="account_balance">
                    <?php $d_date = date('d/m/Y', strtotime($enrolleeSearch->reg_date));
                    echo $d_date ?>
                </td>
            </tr>
            <tr class="table-active">
                <th> Subsciption (End Date) </th>
                <td id="account_balance">
                    <?php $d_date = date('d/m/Y', strtotime($enrolleeSearch->exp_date));
                    echo $d_date ?>
                </td>
            </tr>
            <tr class="table-warning">
                <th> Subsciption Status</th>
                <td id="created">
                    <?php
                    if ($validity == 'Valid') {
                        echo "<span class='badge badge-success'>$validity</span>";
                    } else if ($validity == 'Expired') {
                        echo "<span class='badge badge-danger'>$validity</span>";
                    }
                    //   echo "<span class='badge badge-success'>$validity</span>";

                    ?>
                </td>
            </tr>
        </table>




        <?php
        if ($validity == 'Valid') {    ?>


            <div class="">

                    <?php
                        $enrolledPatient = EnrolleePatient::find_by_nhis_number($enrolleeSearch->nhis_number);
                        if (isset($enrolledPatient) and (!empty($enrolledPatient))){  ?>
                   <a href="add_waiting.php?id=<?php echo $enrolleeSearch->id ?>" class="btn btn-danger">Add Patient To Waiting List</a>

                        <?php } else {  ?>
                  
                     <a href="register.php?id=<?php echo $enrolleeSearch->id ?>" class="btn btn-success">Register Patient</a>

                        <?php }  ?>
                

            </div>





        <?php  }
    } else { ?>
        <div class="col-md-7">
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                NHIS Number not found in database
            </div>
        </div>
<?php }
} ?>