<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 6/6/2017
 * Time: 12:12 PM
 */

require_once("../includes/initialize.php");

$session->logout();

redirect_to(emr_lucid."/index.php");
