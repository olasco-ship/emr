<?php
require_once("includes/initialize.php");

if ($session->is_logged_in()) {
    redirect_to(emr_lucid . "/home.php");
}


$n    = 1;
$name = "ABCDEFGHIJKL";
$n    = sprintf('%04u', $n);
$pos  = substr($name, 0, 1);
//echo $pos; exit;


$done = FALSE;
$department = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo "yes";  exit;

    $username   = trim($_POST['username']);
    $password   = trim($_POST['password']);

    //  echo $department; exit;

    $found_user = User::authenticate($username, $password);
    // pre_d($found_user);   exit;

    if ($found_user) {
        $done = TRUE;
        $session->login($found_user);
        $returnUrl = isset($_GET['returnurl']) ? $_GET['returnurl'] : $_GET['returnUrl'];
        $returnUrl = isset($returnUrl) ? $returnUrl : "/";
        redirect_to(emr_lucid . "/home.php");
    } else {
        $errMessage = "Username/Password Incorrect";
    }
} else {
    $username = "";
    $password = "";
}


?>


<!doctype html>
<html lang="en">

<head>
    <title>:: Obafemi Awolowo University Teaching Hospital Complex :: Login</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Lucid Bootstrap 4.1.1 Admin Template">
    <meta name="author" content="WrapTheme, design by: ThemeMakker.com">

    <link rel="icon" href="<?php echo emr_lucid ?>/light/favicon.ico" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="<?php echo emr_lucid ?>/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo emr_lucid ?>/assets/vendor/font-awesome/css/font-awesome.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="<?php echo emr_lucid ?>/light/assets/css/main.css">
    <link rel="stylesheet" href="<?php echo emr_lucid ?>/light/assets/css/color_skins.css">





</head>




<body class="theme-cyan">
    <!-- WRAPPER -->
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle auth-main">
                <div class="auth-box">
                    <div class="top">
                        <img src="<?php echo emr_lucid ?>/assets/images/oau.gif" alt="EMR">
                        <!--<img src="<?php /*echo emr_lucid */?>/assets/images/oauthc-bg.png" alt="EMR">-->
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="lead">Login to your account</p>
                            <?php
                            echo "<br/>";
                            if (is_post()) {
                                if (!empty($errMessage)) {  ?>
                                    <div id="success" class="alert alert-warning alert-dismissible" role="alert" style="width: auto">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <span> <?php echo $errMessage ?> <br /></span>
                                    </div>
                            <?php     }
                            } ?>


                        </div>

                        <div class="body">
                            <form class="form-auth-small" method="post" action="">
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Username</label>
                                    <input type="text" name="username" class="form-control" id="signin-email" value="" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" name="password" class="form-control" id="signin-password" value="" placeholder="Password">
                                </div>
                                <div class="form-group clearfix">
                                    <label class="fancy-checkbox element-left">
                                        <input type="checkbox">
                                        <span>Remember me</span>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                                <!--                                <div class="bottom">
                                    <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="page-forgot-password.html">Forgot password?</a></span>
                                    <span>Don't have an account? <a href="page-register.html">Register</a></span>
                                </div>-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END WRAPPER -->




    </script>
</body>

</html>






<?php

//require('layout/footer.php');
