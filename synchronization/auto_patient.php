<?php

/*$patient  = Patient::find_offline();
$patient  = json_encode($patient);
sendJson($patient);*/


/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 7/1/2017
 * Time: 7:38 PM
 */

require_once("../includes/initialize.php");


$online_url = 'http://oauthc-emr.megaleknigeria.com/receiveData/patientData.php';

$local_url = 'http://localhost/emr_online/receiveData/patientData.php';



    $patients = Patient::find_offline();

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_PORT => "80", // "49810" ,
        CURLOPT_URL =>  $online_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 120,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($patients),
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
         echo $response;
       //  echo gettype($response) ;

         $decode = json_decode($response);
       //  print_r($decode);
       foreach ($decode as $d) {
           $pat = Patient::find_by_number($d->folder_number);
           $pat->sync = "on";
           $pat->save();
        }
    }






