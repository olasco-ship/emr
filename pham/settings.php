<?php
require_once("../includes/initialize.php");

if (($user->role == 'Super Admin') OR ($user->department == 'Pharmacy')){
    redirect_to(emr_lucid );
}

$name1 = 'expiryPeriod';
$exp1 = Notification::find_by_name($name1);

$name2 = 'reOrderLevel';
$exp = Notification::find_by_name($name2);

$name3 = 'MarkUp';
$exp3 = Notification::find_by_name($name3);



if(is_post()) {


    if (isset($_POST['exp_notice'])) {

        $name1 = 'expiryPeriod';
        $notification = Notification::find_by_name($name1);

        $notification->value = $_POST['exp1_value'];
        $notification->save();
        redirect_to('settings.php');
    }

    if (isset($_POST['re_order'])) {

        $name2 = 'reOrderLevel';
        $notification = Notification::find_by_name($name2);

        $notification->value = $_POST['level'];
        $notification->save();
        redirect_to('settings.php');
    }

    if (isset($_POST['mark_up'])) {

        $name3 = 'MarkUp';
        $notification = Notification::find_by_name($name3);

        $notification->value = $_POST['exp3_value'];
        $notification->save();
        redirect_to('settings.php');
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
                            Pharmacy Settings</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo emr_lucid ?>/home.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Settings</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="body">
                            <a style="font-size: large" href="storage.php">Back</a>
                            <div class="row">
                                <div class="col-md-5">

                                    <h5 class="section-title"> Expiry Notice For Drugs  <span class="section-subtitle"></span></h5>


                                    <form action="" method="post">

                                        <div class="form-group">
                                            <label>Expiry Notice</label>
                                            <!-- <input type="text" class="form-control"  name="exp1_value" value="<?php /*echo $exp1->value  */?>" required>-->
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="exp1_value" value="<?php echo $exp1->value  ?>" required>
                                                <div class="input-group-addon"><h4>month(s)</h4></div>
                                            </div>
                                        </div>

                                        <button type="submit" name="exp_notice" class="btn btn-lg btn-success">Update</button>
                                    </form>
                                </div>

                                <div class="col-md-1">

                                </div>

                                <div class="col-md-5">

                                    <h5 class="section-title"> Re-Order Level For Drugs   <span class="section-subtitle"></span></h5>

                                    <form  method="post" action="">
                                        <div class="form-group">
                                            <label>Re-order level</label>
                                            <input type="text" class="form-control" value="<?php echo $exp->value  ?>" name="level" required >

                                            <br/>
                                            <button type="submit" class="btn btn-success" name="re_order" data-loading-text="Searching...">Update
                                            </button>
                                        </div>
                                    </form>




                                </div>

                                <div class="col-md-1">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-5">

                                    <h5 class="section-title"> Drugs MarkUp Level <span class="section-subtitle"></span></h5>


                                    <form action="" method="post">

                                        <div class="form-group">
                                            <label>Mark Up</label>
                                            <!-- <input type="text" class="form-control"  name="exp1_value" value="<?php /*echo $exp1->value  */?>" required>-->
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="exp3_value" value="<?php echo $exp3->value  ?>" required>
                                                <!--<div class="input-group-addon"><h4>month(s)</h4></div>-->
                                            </div>
                                        </div>

                                        <button type="submit" name="mark_up" class="btn btn-lg btn-success">Update</button>
                                    </form>
                                </div>

                                <div class="col-md-1">

                                </div>

                                <div class="col-md-5">



                                </div>

                                <div class="col-md-1">
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

