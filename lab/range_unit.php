<?php

/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/25/2019
 * Time: 1:55 PM
 */

require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);


                                        $status  = 'REQUEST';

                                        $dept   = $user->unit;
                                        $results         = ReferenceRange::find_by_dept($dept);;

                                        foreach ($results as $result) {
                                                switch ($dept) {
                                                    case "Microbiology":
                                                        echo "No reference range set for MicroBiology";
                                                        break;
                                                    case "Haematology":
                                                        echo "No reference range set for Haematology";
                                                        break;
                                                    case "Chemical Pathology":
                                                        include("reference_range.php");
                                                        break;
                                                    case "Parasitology":
                                                        echo "No reference";
                                                        break;
                                                    case "Histology":
                                                        echo "No";
                                                        break;
                                                    default:
                                                        echo "";
                                                }
                                        }





require('../layout/footer.php');
