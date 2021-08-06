<?php

require_once("../includes/initialize.php");


if (is_post()) {

    $entityBody = file_get_contents('php://input');
    header('Content-Type:application/json');
    $data = json_decode($entityBody);

   //   print_r($data);
    $fields = $_POST;
//Content-Type →text/html



    foreach ($data as $single) {
        //  $product = Product::find_by_barcode($single->barcode);
        $patient = Patient::find_by_number((int)$single->folder_number);
       // $product = Product::find_barcode($single->barcode);
        if (!empty($patient)){

           // $patient->id               = $single->id;
            $patient->sync             = "on";
            $patient->folder_number    = $single->folder_number;
            $patient->system_number    = $single->system_number;
            $patient->tracking_no      = $single->tracking_no;
            $patient->nhis_no          = $single->nhis_no;
            $patient->nhis_reg_date    = $single->nhis_reg_date;
            $patient->nhis_eligibility = $single->nhis_eligibility;
            $patient->title            = $single->title;
            $patient->first_name       = $single->first_name;
            $patient->last_name        = $single->last_name;
            $patient->dob              = $single->dob;
            $patient->gender           = $single->gender;
            $patient->blood_group      = $single->blood_group;
            $patient->genotype         = $single->genotype;
            $patient->phone_number     = $single->phone_number;
            $patient->email            = $single->email;
            $patient->address          = $single->address;
            $patient->occupation       = $single->occupation;
            $patient->marital_status   = $single->marital_status;
            $patient->nationality      = $single->nationality;
            $patient->other_nation     = $single->other_nation;
            $patient->place_origin     = $single->place_origin;
            $patient->state            = $single->state;
            $patient->lga              = $single->lga;
            $patient->religion         = $single->religion;
            $patient->language         = $single->language;
            $patient->english          = $single->english;
            $patient->pidgin           = $single->pidgin;
            $patient->hausa            = $single->hausa;
            $patient->yoruba           = $single->yoruba;
            $patient->igbo             = $single->igbo;
            $patient->other_lang       = $single->other_lang;
            $patient->next_kin_surname = $single->next_kin_surname;
            $patient->next_kin_other_names = $single->next_kin_other_names;
            $patient->next_kin_relationship = $single->next_kin_relationship;
            $patient->next_kin_phone   = $single->next_kin_phone;
            $patient->next_kin_address = $single->next_kin_address;
            $patient->status           = $single->status;
            $patient->registered_by    = $single->registered_by;
            $patient->date_registered  = $single->date_registered;
            $patient->save();
        } else {
            $pat                       = new Patient();
         //   $pat->id               = $single->id;
            $pat->sync             = "on";
            $pat->folder_number    = $single->folder_number;
            $pat->system_number    = $single->system_number;
            $pat->tracking_no      = $single->tracking_no;
            $pat->nhis_no          = $single->nhis_no;
            $pat->nhis_reg_date    = $single->nhis_reg_date;
            $pat->nhis_eligibility = $single->nhis_eligibility;
            $pat->title            = $single->title;
            $pat->first_name       = $single->first_name;
            $pat->last_name        = $single->last_name;
            $pat->dob              = $single->dob;
            $pat->gender           = $single->gender;
            $pat->blood_group      = $single->blood_group;
            $pat->genotype         = $single->genotype;
            $pat->phone_number     = $single->phone_number;
            $pat->email            = $single->email;
            $pat->address          = $single->address;
            $pat->occupation       = $single->occupation;
            $pat->marital_status   = $single->marital_status;
            $pat->nationality      = $single->nationality;
            $pat->other_nation     = $single->other_nation;
            $pat->place_origin     = $single->place_origin;
            $pat->state            = $single->state;
            $pat->lga              = $single->lga;
            $pat->religion         = $single->religion;
            $pat->language         = $single->language;
            $pat->english          = $single->english;
            $pat->pidgin           = $single->pidgin;
            $pat->hausa            = $single->hausa;
            $pat->yoruba           = $single->yoruba;
            $pat->igbo             = $single->igbo;
            $pat->other_lang       = $single->other_lang;
            $pat->next_kin_surname = $single->next_kin_surname;
            $pat->next_kin_other_names = $single->next_kin_other_names;
            $pat->next_kin_relationship = $single->next_kin_relationship;
            $pat->next_kin_phone   = $single->next_kin_phone;
            $pat->next_kin_address = $single->next_kin_address;
            $pat->status           = $single->status;
            $pat->registered_by    = $single->registered_by;
            $pat->date_registered  = $single->date_registered;
            $pat->save();
        }
    }
    $j = json_encode($data);
    echo $j;


}





