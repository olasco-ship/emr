<?php
require_once("../includes/initialize.php");





$message = "";
$done = FALSE;
$errMessage = "";
$first_name = $last_name = $username = $password = $created = $role = "";
$errFirstName = $errLastName = $errUserName = $errPassword = $errCreated = $errRole = "";


if(is_post()){


    if (empty($_POST['first_name'])) {
        $errFirstName = "First Name is Required";
        $errMessage .= $errFirstName . "<br/>";
    } else {
        $first_name = test_input($_POST['first_name']);
        if (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
            $errFirstName = "Only letters and white space are allowed for First Name";
            $errMessage .= $errFirstName . "<br/>";
        }
    }

    if (empty($_POST['last_name'])) {
        $errLastName = "Last Name is Required";
        $errMessage .= $errLastName . "<br/>";
    } else {
        $last_name = test_input($_POST['last_name']);
        if (!preg_match("/^[a-zA-Z]*$/", $last_name)) {
            $errLastName = "Only letters and white space are allowed for Last Name";
            $errMessage .= $errLastName . "<br/>";
        }
    }

    if (empty($_POST['username'])) {
        $errUserName = "User Name  is Required";
        $errMessage .= $errUserName . "<br/>";
    } else {
        $username = test_input($_POST['username']);
        $stf = User::find_by_username($username);

        if (isset($stf) && !empty($stf)) {
            $errUserName = "User Name already exists";
            $errMessage .= $errUserName . "<br/>";
        } else {
            if (!preg_match("/^[a-zA-Z]*$/", $username)) {
                $errUserName = "Only letters and white space are allowed for User Name";
                $errMessage .= $errUserName . "<br/>";
            }
        }
    }

    if (empty($_POST['department'])) {
        $errDepartment = "Department is Required";
        $errMessage .= $errDepartment . "<br/>";
    } else {
        $department = test_input($_POST['department']);
        /*        if (!preg_match("/^[a-zA-Z]*$/", $department)) {
                    $errDepartment = "Only letters and white space are allowed for Department ";
                    $errMessage .= $errDepartment . "<br/>";
                }*/
    }

    if (empty($_POST['role'])) {
        $errRole = "Role is Required";
        $errMessage .= $errRole . "<br/>";
    } else {
        $role = test_input($_POST['role']);
        if (!preg_match("/^[a-zA-Z]*$/", $role)) {
            $errRole = "Only letters and white space are allowed for Role ";
            $errMessage .= $errRole . "<br/>";
        }
    }

    $password = '123456';



    if ((!$errMessage) and (empty($errMessage))) {
        $date                  = strftime("%Y-%m-%d %H:%M:%S", time());
        $user                  = new User();
        $user->first_name      = $first_name;
        $user->last_name       = $last_name;
        $user->username        = $username;
        $user->password        = $password;
/*        $user->specialization  = "";
        $user->phone_no        = "";*/
        $user->department      = $department;
        $user->role            = $role;
        $user->date            = $date;
        //    $user->save();
        if ($user->save()){
            $done = TRUE;
            $session->message("User has been added.");
            redirect_to('index.php');
        }
    }

    if ($errMessage) {
        $panelClass = 'panel-danger';
        $panelHeader = '<div class="panel-heading"><h3 class="panel-title">Please correct the errors in the form<br></h3> class=
                          "panel-title alert alert-danger">' . $errMessage . '</h3> </div>';
    }
}



require('../layout/header.php');

?>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> User Management</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo emr_lucid ?>/home.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">User</li>
                            <li class="breadcrumb-item active">Add User</li>
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2> Create User </h2>
                        </div>

                        <div class="body">
                            <form id="basic-form" method="post" novalidate>

                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control"  name="first_name" value="<?php echo $first_name ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="last_name" value="<?php echo $last_name ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" value="<?php echo $username ?>" required>
                                </div>


                                <div class="form-group">
                                    <label class="control-label">Department</label>
                                    <select class="form-control" name="department" required>
                                        <option value=""></option>
                                        <option value="Consultancy">Consultancy</option>
                                        <option value="Nursing">Nursing</option>
                                        <option value="Pharmacy">Pharmacy</option>
                                        <option value="Laboratory">Laboratory</option>
                                        <option value="Radiology/Scan">Radiology/Scan</option>
                                        <option value="Medical Records">Medical Records</option>
                                        <option value="Account">Account</option>
                                        <option value="ICT">ICT</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label"> Role </label>
                                    <select class="form-control" name="role" required >
                                        <option value=""></option>
                                        <option value="User">User</option>
                                        <option value="admin">admin</option>
                                        <option value="Super admin">Super admin</option>
                                    </select>
                                </div>

                                <br/>
                                <button type="submit" class="btn btn-primary"> Add User </button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>





<?php

require('../layout/footer.php');