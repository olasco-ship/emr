<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}
$user = User::find_by_id($session->user_id);

$index =1;







require('../layout/header.php');
?>



<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Nursing Department </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">
                            <?php
                            if (!empty($user->sub_clinic_id)) {
                                $subClinic = SubClinic::find_by_id($user->sub_clinic_id);
                                $clinic = Clinic::find_by_id($subClinic->clinic_id);
                                echo $clinic->name . " / " . $subClinic->name;
                            }
                            ?>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="body">
                        <div class="row clearfix">

                            <div class="col-md-12">
                                <div class="card patients-list">
                                    <div class="body">

                                        <a style="font-size: large" href="clinic.php">Back</a>
                                        <ul class="nav nav-tabs-new2">
                                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#All">Nurses In Clinic</a></li>
                                        </ul>
                                        <div class="tab-content m-t-10 padding-0">
                                            <div class="tab-pane table-responsive active show" id="All">
                                                <table class="table m-b-0 table-hover">
                                                    <thead class="thead-purple">

                                                        <tr>
                                                            <th>#</th>
                                                            <th>Username</th>
                                                            <th>Name</th>
                                                            <th>Clinics</th>
                                                            <!-- <th>Department</th>-->
                                                            <th>Date Registered</th>
                                                       
                                                        </tr>

                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $dept = 'Nursing';
                                                        $users = User::find_by_dept_clinic($subClinic->id, $dept);

                                                      //  $userCLinic = UserSubClinic::find_by_clinic_and_dept($clinic->id, $dept);

                                                        foreach ($users as $user) {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $index++ ?></td>
                                                                <td><span class="text-info"><a href="#"><?php echo $user->username ?></a> </span></td>
                                                                <td><span><?php echo $user->full_name() ?></span></td>
                                                                <td><?php // echo $user->clinic_id
                                                                    if ($user->ward_id == 1) {
                                                                        //echo $user->ward_id;
                                                                        $wardName = UserMultiWards::find_by_user_id($user->id);
                                                                        ///pre_d($wardName);die;
                                                                        foreach ($wardName as $wName) {
                                                                            echo $wName->ward_name;
                                                                            echo "<br>";
                                                                        }
                                                                    } else {
                                                                        if (empty($user->sub_clinic_id)) {
                                                                            echo "no clinic";
                                                                        } else {
                                                                            $sub_clinic = SubClinic::find_by_id($user->sub_clinic_id);
                                                                            $clinic = Clinic::find_by_id($sub_clinic->clinic_id);
                                                                            echo $clinic->name . "/" . $sub_clinic->name;
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><?php $d_date = date('d/m/Y h:i a', strtotime($user->date));
                                                                    echo $d_date ?></td>
                                                              
                                                            </tr>

                                                        <?php }
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>


                </div>
            </div>
        </div>


    </div>
</div>




<?php
require('../layout/footer.php');
