<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 12:14 PM
 */
//require_once("../../includes/initialize.php");
//require_once("../../TCPDF/tcpdf.php");

require_once("../../includes/config.php");
require_once("../../includes/functions.php");
require_once("../../includes/session.php");
require_once("../../includes/database.php");
require_once("../../includes/database_object.php");
require_once("../../includes/waiting_list.php");
require_once("../../includes/patient.php");
require_once("../../includes/refer_admission.php");
require_once("../../includes/user.php");


require_once("../../includes/revenueHead.php");

require_once("../table/BodyPart.php");


$index = 1;

$finds = BodyPart::find_all();
$index = 1;

require('html.php');
?>
