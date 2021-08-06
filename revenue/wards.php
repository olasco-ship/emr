<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 12:14 PM
 */
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$index = 1;

$finds = Wards::find_all_with_join('ward.id, ward.location_id, ward.ward_number, ward.gender, 
                            location.id as locId, location.location_name',
                            'left', 
                            'location', 
                            'location.id=ward.location_id', 
                            "ward.id");
$index = 1;
$location = Locations::find_all();

if(!empty($_GET['ward_name'])){
    $wardUnique = new Wards();
    $nameUnique = $wardUnique->uniqueName($_GET['ward_name']);
    if(!empty($nameUnique) ){
        if($_GET['update'] == true && count($nameUnique) > 1){
            echo json_encode("success");
        }else{
            echo json_encode("error");
        }        
        exit();
    }else{
        echo json_encode("success");
        exit();
    }
}

if(!empty($_GET['id'])){
    $ward = new Wards();
    $ward->id = $_GET['id'];
    if($ward->delete()){        
        $session->message("Ward has been deleted.");
        redirect_to('wards.php');
    }else{
        $session->message("Ward not delete.");
        redirect_to('wards.php');
    }
    
}


if(is_post()){

    if(!empty($_POST['location_id']) && !empty($_POST['ward_number'])){
        $ward              = new Wards();
        $ward->sync        = "off";
        $ward->location_id = $_POST['location_id'];
        $ward->ward_number = $_POST['ward_number'];
        $ward->gender = $_POST['gender'];
        //$ward->save();
        if(!empty($_POST['id'])){
            $ward->id = $_POST['id'];
            $ward->save();
            $session->message("New ward updated.");
        }else{
            $session->message("New ward created.");
            $ward->create();    
        }
        
        redirect_to('wards.php');
    }


    if ($_POST['revenue_name']) {
        if (empty($_POST['revenue_name'])) {
            $errorName= " Name Of RevenueHead is Required";
            $errorMessage .= $errorName . "<br/>";
        } else {
            $revenue_name = test_input($_POST['revenue_name']);
            //  if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            //      $errorName = "Only letters and white space are allowed for Category Name";
            //      $errorMessage .= $errorName . "<br/>";
            //  }
        }
    }


 //   echo $revenue_name; exit;

    if ((!$errorMessage) and empty($errorMessage)){
        $revenue_head                = new RevenueHead();
        $revenue_head->revenue_code  = "";
        $revenue_head->revenue_name  = $revenue_name;
        $revenue_head->date_created  = strftime("%Y-%m-%d %H:%M:%S", time());
        $revenue_head->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($revenue_head->create()){
            $done = TRUE;
            $session->message("A new RevenueHead has been created.");
            redirect_to('index.php');
        } else {
            $done = FALSE;
            $session->message("Could not create a new RevenueHead.");

        }
    }
}
require('../layout/header.php');
?>

    <div id="main-content">
        <div class="container-fluid">
        <?php include "../layout/header_chart.php"; ?>
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">

                        <div class="body">

                            <div class="col-lg-12 col-md-12">
                           <form class="wardForm pb-4" action="wards.php" method="POST" data-parsley-validate novalidate>

                            <div class="form-group row">
                                 <div class="offset-sm-2 col-sm-2 col-3"> 
                                  <label> Location <span class="text-danger">*</span></label>
                                </div>
                             <div class="col-sm-4 col-9"> 
                                    
                              
                                <select class="custom-select location_id" id="inputGroupSelect01" name="location_id" required
                                data-parsley-required-message="Please select Location">
                                    <option value="">-- Select Location --</option>
                                    <?php 
                                        if(!empty($location)){
                                            foreach($location as $locData){
                                    ?>
                                                <option value="<?= $locData->id ?>"><?= ucfirst($locData->location_name) ?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                                   
                            </div>
                                  
                                </div>
                                 <div class="form-group row">
                                  <div class="offset-sm-2 col-sm-2 col-3">  <label> Ward Name <span class="text-danger">*</span></label></div>
                                    <div class="col-sm-4 col-9"> 
                                      <input type="text" class="form-control" placeholder="Ward Name" required="" name="ward_number" id="ward_number" data-parsley-required-message="Please enter ward name"  data-parsley-ward_number>
                                      <ul style="display:none;" class="parsley-errors-list filled wardError" id="parsley-id-7"><li class="parsley-ward_number">The ward number already exists.</li></ul>
                                    </div>                      
                                </div>

                                <div class="form-group row">
                                  <div class="offset-sm-2 col-sm-2 col-3">  <label> Type <span class="text-danger">*</span></label></div>
                                  <div class="col-sm-4 col-9">    

                                  <label class="fancy-radio">
                                        <input type="radio" name="gender" class="m" value="male" required data-parsley-required-message="Please select gender"/>
                                        <span><i></i>Male</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="gender" class="f" value="female" required data-parsley-required-message="Please select gender"/>
                                        <span><i></i>Female</span>
                                    </label>
                                         <label class="fancy-radio">
                                        <input type="radio" name="gender" class="o" value="both" required data-parsley-required-message="Please select gender"/>
                                        <span><i></i>Both</span>
                                    </label>
                                      
                               
                             </div>                      
                                </div>
                                    <input type="hidden" name="id" id="ward_id"/>
                                    <input type="hidden" name="update_id" id="update_id" value="false"/>
                                 <div class="col-sm-12 col-12 text-center"> <button type="submit" class="btnSubmit btn btn-primary">Save</button>
                                    <!-- <button type="" class="btn btn-primary">New</button></div> -->


                            
                            </form>
                                    <div class="table-responsive mt-4">
                                                    <table class="table no-margin table-dark table-striped table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Ward Name</th>
                                                            <th>Gender</th>
                                                             <th>Location</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                        if(!empty($finds)){
                                                        foreach($finds as $find) {   ?>
                                                            <tr>
                                                                <td><?php echo $index++; ?></td>
                                                                 <td><a href="#"> <?= $find->ward_number ?> </a></td>
                                                                <td><a href="#"> <?= ucfirst($find->gender) ?> </a></td>
                                                                <td><a href="#"> <?= ucfirst($find->location_name) ?> </a></td>
                                                                <td> 
                                                                    <a href="javascript:void(0)" id="editWard" onclick="editWard('<?= $find->id ?>', '<?= $find->locId ?>', '<?= $find->ward_number ?>', '<?= $find->gender ?>')">  <i class="fa fa-edit" title="Edit"></i> </a> 
                                                                    <a href="javascript:void(0)" id="deleteWard" onclick="deleteWard('<?= $find->id ?>')" >  <i class="icon-trash" title="Delete"></i> </a> 
                                                                </td>
                                                            </tr>
                                                        <?php } } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







<?php

require('../layout/footer.php');