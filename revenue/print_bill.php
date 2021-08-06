<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/14/2019
 * Time: 10:23 PM
 */



require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];

    $bill = Bill::find_by_id($id);

    $encounter = Encounter::find_by_id($bill->encounter_id);
   // echo $encounter->id;


    if (!empty($testRequest = TestRequest::find_bill_by_cost( $bill->id))){
        $tests = TestRequest::find_bill_by_cost($bill->id);
        foreach ($tests as $test){
            $test->status = 'billed';
            $test->save();
        }
        $bill->status = "billed";
        $bill->save();
    }


    if (!empty($prescribed = Prescribed::find_bill_by_cost( $bill->id))){
        $prescribed = Prescribed::find_bill_by_cost($bill->id);
        foreach ($prescribed as $presc){
            $presc->status = 'billed';
            $presc->save();
        }
        $bill->status = "billed";
        $bill->save();
    }

    if (!empty($scanRequest = ScanRequest::find_bill_by_cost( $bill->id))){
        $scanRequest = ScanRequest::find_bill_by_cost($bill->id);
        foreach ($scanRequest as $test){
            $test->status = 'billed';
            $test->save();
        }
        $bill->status = "billed";
        $bill->save();
    }





}






