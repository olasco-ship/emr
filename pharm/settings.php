<?php
require_once("../includes/initialize.php");

if (($user->role == 'Super Admin') OR ($user->department == 'Pharmacy')){
    redirect_to(emr_lucid );
}

$name1 = 'expiryPeriod';
$exp1 = Notification::find_by_name($name1);
//echo $exp1->name .  "=>" . $exp1->value . "months" ;

//echo "<br/>";

$name2 = 'reOrderLevel';
$exp = Notification::find_by_name($name2);
//echo $exp->name .  "=>" . $exp->value;


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
                          <!--  <li class="breadcrumb-item active">User Records</li>-->
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <!-- <h2>Basic Example 1</h2>-->
                        </div>
                        <div class="body">

                            <div class="row">

                                <div class="col-md-5">

                                    <h2 class="section-title"> Expiry Notice For Drugs  <span class="section-subtitle"></span></h2>


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

                                    <h2 class="section-title"> Re-Order Level For Drugs   <span class="section-subtitle"></span></h2>

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

                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>






























<?php

require('../layout/footer.php');

