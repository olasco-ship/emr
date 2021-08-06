<?php
/**
 * Created by PhpStorm.
 * User: MOHIT
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
$ipdDetail  = IPDServices::find_all();


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

  if(!empty($_POST['service_name'])){
      $ipdData                = new IPDServices();
      $ipdData->sync          = "off";
      $ipdData->service_name  = $_POST['service_name'];
      $ipdData->daily_charges = $_POST['daily_charges'];
      //$ipdData->save();
        if(!empty($_POST['id'])){
            $ipdData->id = $_POST['id'];
            $ipdData->save();
        }else{
            $ipdData->create();    
        }
      $session->message("IPD services add successfully");
      redirect_to('add_ipd.php');
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
                         <form class="wardForm pb-4" action="add_ipd.php" method="POST" data-parsley-validate="" novalidate="">
                         <input type="hidden" name="id" id="ipd_id"/>
                                 <div class="form-group row">
                                  <div class="offset-sm-2 col-sm-2 col-3">  <label> IPD Service Name <span class="text-danger">*</span></label></div>
                                    <div class="col-sm-4 col-9"> 
                                      <input type="text" class="form-control" placeholder="IPD Service Name" required="" name="service_name" id="service_name" data-parsley-required-message="Please enter IPD Service Name" data-parsley-ward_number="">
                                     
                                    </div>                      
                                </div>
                                 <div class="form-group row">
                                  <div class="offset-sm-2 col-sm-2 col-3">  <label> Daily Charges <span class="text-danger">*</span></label></div>
                                    <div class="col-sm-4 col-9"> 
                                      <input type="text" class="form-control" placeholder="Daily Charges" required="" name="daily_charges" id="daily_charges" data-parsley-required-message="Please enter Daily Charges" data-parsley-ward_number="">
                                      
                                    </div>                      
                                </div>

                              
                                  
                                 <div class="col-sm-12 col-12 text-center"> <button type="submit" class="btnSubmit btn btn-primary">Save</button>
                                    <!-- <button type="" class="btn btn-primary">New</button></div> -->


                            
                            
                                    
                            </div></form>
                                    <div class="table-responsive">
                                                    <table class="table no-margin table-dark table-striped table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>IPD Service Name </th>
                                                            <th>Daily Charges</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                                if (!empty($ipdDetail)) {
                                                                    foreach ($ipdDetail as $k => $ipdData) {
                                                                        ?>
                                                            <tr>
                                                                <td><?php echo $k+1; ?></td>
                                                                <td> <a href="javascript:void(0)"> <?php echo $ipdData->service_name ?> </a></td>   
                                                                <td> <a href="javascript:void(0)"> <?php echo $ipdData->daily_charges ?> </a></td>                                                                    
                                                               <td> 
                                                                    <a href="javascript:void(0)" id="editWard" onclick="editIpdService('<?= $ipdData->id ?>', '<?= $ipdData->service_name ?>', '<?= $ipdData->daily_charges ?>');">  <i class="fa fa-edit" title="Edit"></i> </a> 
                                                                    <a href="javascript:void(0)" id="deleteWard" >  <i class="icon-trash" title="Delete"></i> </a> 
                                                                </td>        
                                                            </tr>
                                                                <?php
                                                                    }
                                                                   }else{
                                                                       echo "<tr> <td> No data found </td></tr>";
                                                                   }
                                                                 ?>
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