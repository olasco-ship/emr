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

$finds = Locations::find_all();
$index = 1;

if(!empty($_GET['id'])){
    $location = new Locations();
    $location->id = $_GET['id'];
    if($location->delete()){
        // $dat = [
        //     "status" => true,
        //     "message" => "Successfull Delete",
        //     'data' => 1
        // ];
        // echo json_encode($dat);
        // exit();
        $session->message("Location has been deleted.");
        redirect_to('location.php');
    }else{
        // $dat = [
        //     "status" => false,
        //     "message" => "Not Delete",
        //     'data' => 0
        // ];
        // echo json_encode($dat);
        // exit();
        $session->message("Location not delete.");
        redirect_to('location.php');
    }
    
}

if(is_post()){

    if(!empty($_POST['location_name'])){
        $location       = new Locations();
        $location->sync = "off";
        $location->location_name = $_POST['location_name'];
        if(!empty($_POST['id'])){
            $location->id = $_POST['id'];
            $location->save();
        }else{
            $location->create();
        }
        
        $session->message("Location has been created.");
        redirect_to('location.php');
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
                           <form class=" pb-4" action="location.php" method="post">

                            <div class="form-group row">
                                  <div class="offset-sm-2 col-sm-2 col-3">  <label> Name <span class="text-danger">*</span></label></div>
                                    <div class="col-sm-4 col-9"> 
                                        <input type="text" class="form-control location_name" placeholder="Name" name="location_name" required="">
                                        <input type="hidden" name="id" id="location_id"/>
                                    </div>
                                   <div class="col-sm-4 col-12"> <button type="submit" class="btn btn-primary">Save</button>
                                    <!-- <button type="" class="btn btn-primary">New</button> -->
                                </div>
                                </div>
                            
                            </form>
                                    <div class="table-responsive mt-4">
                                                    <table class="table no-margin table-dark table-striped table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Location </th>
                                                            <th>Operation </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                        if (!empty($finds)) {
                                                            foreach ($finds as $find) {   ?>
                                                            <tr id="locationId<?= $find->id ?>">
                                                                <td><?php echo $index++; ?></td>
                                                                <td ><a href="javascript:void(0)"> <?= ucfirst($find->location_name) ?> </a></td>
                                                                <td> 
                                                                    <a href="javascript:void(0)" id="editLocation" onclick="editLocation('<?= $find->id ?>', '<?= $find->location_name ?>')">  <i class="fa fa-edit" title="Edit"></i> </a> 
                                                                    <a href="javascript:void(0)" id="deleteLocation" onclick="deleteLocation('<?= $find->id ?>')" >  <i class="icon-trash" title="Delete"></i> </a> 
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