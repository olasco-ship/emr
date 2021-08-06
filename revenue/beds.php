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

//$finds = Beds::find_all();
$finds = Beds::find_all_with_join_multiple('ward.id as wardId, ward.location_id, ward.ward_number, 
                       location.id as locId, location.location_name,
                       bed.id, bed.bed_location_id, bed.ward_id, bed.room_number, bed.bed_no_to, 
                       bed.bed_no_from ',
                        ['left', 'left'], 
                        ['location', 'ward'], 
                        ['location.id=bed.bed_location_id', 'ward.id=bed.ward_id'],
                        'bed.id');

//pre_d($finds);die;
$index = 1;

$location = Locations::find_all();

//For search ward according to location
if(!empty($_GET['ward_id'])){

    $wardDetail = new Wards();
    $wDetail = $wardDetail->find_by_location_id($_GET['ward_id']);
    if(!empty($wDetail)){
        $data = "<option>-- Select Ward --</option>";
        foreach($wDetail as $wdata){
            $data .= "<option value='".$wdata->id."'>".$wdata->ward_number."</option>";
        }
        echo $data;
        exit();
    }else{
        $data = "<option>-- No Ward found --</option>";
        echo $data;
        exit();
    }
    
}


// For edit time show selected ward
if(!empty($_GET['ward_id_edit'])){

    $wardDetail = new Wards();
    //pre_d($_GET);die;
    $wDetail = $wardDetail->find_by_location_id_for_edit($_GET['ward_id_selected']);
    //pre_d($wDetail);die;
    if(!empty($wDetail)){
        $data = "<option>-- Select Ward --</option>";
        $sel = "";
        
            $data .= "<option value='".$wDetail->id."' selected='selected'>".$wDetail->ward_number."</option>";
       
        echo $data;
        exit();
    }else{
        $data = "<option>-- No Ward found --</option>";
        echo $data;
        exit();
    }
    
}


//Delete Room Number
if(!empty($_GET['id'])){
    $bed = new Beds();
    $bed->id = $_GET['id'];
    if($bed->delete()){        
        $session->message("Bed has been deleted.");
        redirect_to('beds.php');
    }else{
        $session->message("Bed not delete.");
        redirect_to('beds.php');
    }
    
}


if(is_post()){

    if(!empty($_POST['bed_location_id']) && !empty($_POST['ward_id'])&& !empty($_POST['room_number'])){
        
        $bed       = new Beds();
        $bed->sync = "off";
        $bed->bed_location_id = $_POST['bed_location_id'];
        $bed->ward_id = $_POST['ward_id'];
        $bed->room_number = $_POST['room_number'];
//        $bed->room_number = $_POST['room_number'];
        $bed->bed_no_to = $_POST['bed_no_to'];
        $bed->bed_no_from = $_POST['bed_no_from'];
        //$ward->save();
        
        $wardData = new Wards();
        $wardData->ward_status = 1;
        $wardData->updateReferId("where id=".$bed->ward_id );

        $roomExist = Beds::find_by_room_number($bed->room_number);
        if(!isset($roomExist)){
            $session->message("Already Exist bed");
            redirect_to('beds.php');
        }
        
        if(!empty($_POST['id'])){
            $bedListDetail = BedsList::find_by_bed_id_for_edit($_POST['id']);
            //pre_d($bedListDetail);die;
            
            $bed->id = $_POST['id'];
            $bed->save();

            //pre_d($bed);die;
            if(!empty($bedListDetail)){
                for($a = count($bedListDetail); $a < $bed->bed_no_from; $a++){
                    $bedList = new BedsList();
                    $bedList->bed_location_id = $_POST['bed_location_id'];
                    $bedList->ward_id = $_POST['ward_id'];
                    $bedList->room_number = $_POST['room_number'];                
                    $bedList->bed_no = $a;
                    $bedList->bed_id = $bed->id;
                    //pre_d($bedList);
                    $bedList->save();
                }  
            }
            //pre_d($bedListDetail);die;

            $session->message("New bed updated.");
        }else{
           
            $bed_id = $bed->createBed(); 
            
            for($a = $bed->bed_no_to; $a <= $bed->bed_no_from; $a++){
                $bedList = new BedsList();
                $bedList->bed_location_id = $_POST['bed_location_id'];
                $bedList->ward_id = $_POST['ward_id'];
                $bedList->room_number = $_POST['room_number'];                
                $bedList->bed_no = $a;
                $bedList->bed_id = $bed_id;
                $bedList->save();
            }   
        }
        $session->message("New bed created.");
        redirect_to('beds.php');
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
                        <div class="header">
                            <ul class="header-dropdown">
                                <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Weekly">W</a></li>
                                <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Monthly">M</a></li>
                                <li><a class="tab_btn active" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Yearly">Y</a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                        <?php
if (!empty($message)) {?>
                                            <div id="success" class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                        aria-hidden="true">&times;</span></button>
                                                <?php echo output_message($message); ?>
                                            </div>
                                        <?php }
?>

<input type="hidden" value="beds.php" class="urlWard"/>
<a href="#top"></a>
                              <div class="col-lg-12 col-md-12">
                           <form class="pb-4" action="beds.php" method="post" data-parsley-validate novalidate>

                            <div class="form-group row">
                                 <div class="offset-sm-2 col-sm-2 col-3"> 
                                  <label>Location <span class="text-danger">*</span></label></div>
                             <div class="col-sm-6 col-9"> 
                                    
                              
                                <select class="custom-select bed_location_id" id="inputGroupSelect01" name="bed_location_id" required>
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
                                  <div class="offset-sm-2 col-sm-2 col-3">  <label> Ward <span class="text-danger">*</span></label></div>
                                  <div class="col-sm-6 col-9">   
                                <select class="custom-select ward_id" id="inputGroupSelect01" name="ward_id" required>
                                    <option value="">-- Select Ward --</option>
                                </select></div>                      
                                </div>
                             
                                  <div class="form-group row">
                                  <div class="offset-sm-2 col-sm-2 col-3">  <label>Room No<span class="text-danger">*</span></label></div>
                                  <div class="col-sm-6 col-9"> 
                                      <input type="text" class="form-control" placeholder="Name" required name="room_number" id="room_number">
                                    </div>                      
                                </div>
                                  <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-2 col-3">  
                                      <label>Bed To No<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-2 col-9"> 
                                        <input type="text" class="form-control" placeholder="Bed To" required="" name="bed_no_to" id="bed_no_to">
                                    </div>
                                    <div class="col-sm-2 col-3">  
                                        <label>Bed From No<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-2 col-9"> 
                                        <input type="text" class="form-control" placeholder="Bed From" required="" name="bed_no_from" id="bed_no_from">
                                    </div>                     
                                </div>

                            
                                    <input type="hidden" name="id" id="bed_id"/>
                                 <div class="col-sm-12 col-12 text-center">
                                      <button type="submit" class="btn btn-primary">Save</button>
                                    <!-- <button type="" class="btn btn-primary">New</button> -->
                                </div>


                            
                            </form>
                                    <div class="table-responsive mt-4">
                                                    <table class="table no-margin table-dark table-striped table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Location</th>
                                                            <th>Ward Name</th>
                                                            <th>Room No.</th>
                                                            <th>Bed No.</th>
                                                            
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                        if (!empty($finds)) {
                                                            foreach ($finds as $find) {   ?>
                                                            <tr>
                                                                <td><?php echo $index++; ?></td>
                                                                 <td><a href="javascript:void(0)"> <?= ucfirst($find->location_name) ?> </a></td>
                                                                <td><a href="javascript:void(0)"> <?= ucfirst($find->ward_number) ?> </a></td>
                                                                <td><a href="javascript:void(0)"> <?= $find->room_number ?> </a></td>
                                                                <td>
                                                                    <?php 
                                                                        if(!empty($find->bed_no_to) && !empty($find->bed_no_from)){
                                                                            if($find->bed_no_to < $find->bed_no_from){
                                                                                for($i=$find->bed_no_to; $i <= $find->bed_no_from;  $i++){
                                                                                    echo "<a href='javascript:void(0)'> $i </a><br>";
                                                                                }
                                                                            }
                                                                        }
                                                                    ?>
                                                                    <!-- <a href="#"><?//= $find->bed_no_to ?> </a>
                                                                    <a href="#"><?//= $find->bed_no_from ?> </a> -->
                                                                </td>
                                                                <td> 
                                                                    <a href="javascript:void(0)" id="editBed" onclick="editBed('<?= $find->id ?>', '<?= $find->bed_location_id ?>', '<?= $find->ward_id ?>', '<?= $find->room_number ?>', '<?= $find->bed_no_to ?>', '<?= $find->bed_no_from ?>')">  <i class="fa fa-edit" title="Edit"></i> </a> 
                                                                    <a href="javascript:void(0)" id="deleteBed" onclick="deleteBed('<?= $find->id ?>')" >  <i class="icon-trash" title="Delete"></i> </a> 
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                        } ?>
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