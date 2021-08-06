<?php 
require_once "../includes/initialize.php";
    //Casse Note data Save
    if (isset($_POST['subject_case_note'])) {
        $caseNoteNurse = new CaseNotesNurse();
        $caseNoteNurse->subject = $_POST['subject_case_note'];
        $caseNoteNurse->patient_id = $_POST['case_note_patient_id'];
        $caseNoteNurse->comment = $_POST['comment'];
        $caseNoteNurse->date = date("Y-m-d H:i:s");
        $caseNoteNurse->save();
        
        
        $session->message("Investigation Saved");
        redirect_to("patient_detail.php?id=".$_POST['waiting_list_case_note']);
    }
?>