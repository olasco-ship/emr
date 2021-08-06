<?php 
    $caseNoteData = CaseNotesNurse::find_all_by_nurse_patient_id($waiting_list->patient_id);
?>
<div class="col-lg-12 col-md-12">
<form class=" pb-4" action="case_note_data_save.php" method="post">
    <input type="hidden" value="<?php echo $waiting_list->id; ?> " name="waiting_list_case_note"/>
    <input type="hidden" value="<?php echo $waiting_list->patient_id; ?> " name="case_note_patient_id"/>
    <div class="form-group row">
        <div class="offset-sm-2 col-sm-2 col-3">  <label> Subject <span class="text-danger">*</span></label></div>
        <div class="col-sm-6 col-9"> 
            <input type="text" class="form-control subject" placeholder="Subject" name="subject_case_note" required="">
        </div>
        
     
      
    </div>
 
    <div class="form-group row">
            
        <div class=" offset-sm-2 col-sm-2 col-3">  <label> Comments <span class="text-danger">*</span></label></div>
        <div class="col-sm-6 col-9"> 
            <textarea class="form-control comments" placeholder="Comments" name="comment" required="" rows="5" ></textarea>           
        </div>
      
    </div>
  
         
    <div class="col-sm-12 col-12 text-center"> <button type="submit" class="btn btn-primary">Save</button></div>
      

</form>
        <div class="table-responsive mt-4">
            <table class="table no-margin table-dark table-striped table-hover">
               <?php 
                if(isset($caseNoteData)){
                    foreach($caseNoteData as $caseData){
               ?>
                <tr>
                    <th>Date</th>
                    <th><?= date("m/d/Y",  strtotime($caseData->date)) ?></th>
                </tr>
                <tr>
                    <th>Subject</th>
                    <th><?= $caseData->subject ?></th>
                </tr>
                <tr>
                    <th>Comment</th>
                    <th><?= $caseData->comment ?></th>
                </tr>
                <?php }
                } ?>
                
            </table>
        </div>

</div>                 
