<?php
/**
 * Created by PhpStorm.
 * User: FEMI
 * Date: 4/16/2019
 * Time: 1:52 PM
 */



require_once("../includes/initialize.php");

$index = 1;

$finds = ConsultingRooms::find_all();


if(is_post()){
    if ($_POST['room_no']) {
        if (empty($_POST['room_no'])) {
            $errorRoom= "Consulting Room is Required";
            $errorMessage .= $errorRoom . "<br/>";
        } else {
            $room_no = test_input($_POST['room_no']);
        }
    }

    $clinic_id = test_input($_POST['clinic_id']);


    if ((!$errorMessage) and empty($errorMessage)){
        $consultingRoom                = new ConsultingRooms();
        $consultingRoom->sync          = "off";
        $consultingRoom->room_no       = $room_no;
        $consultingRoom->clinic_id     = $clinic_id;
        $consultingRoom->date          = strftime("%Y-%m-%d %H:%M:%S", time());
        if ($consultingRoom->create()){
            $done = TRUE;
            $session->message("A new Consulting Room has been created.");
            redirect_to('index.php');
        } else {
            $done = FALSE;
            $session->message("Could not create a new Consulting Room.");

        }
    }
}




require('../layout/header.php');
?>



    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Consulting Rooms </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item"> Consultation </li>

                        </ul>
                    </div>

                </div>
            </div>



            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">
                        <div class="body">

                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="body">
                                        <a href="../nursing/home.php" style="font-size: large">&laquo; Back</a>
                                        <ul class="nav nav-tabs-new">
                                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Home-new"> Consulting Rooms </a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new">Add Consulting Rooms </a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="Home-new">
                                                <h6>Consulting Rooms</h6>
                                                <div class="table-responsive">
                                                    <table class="table no-margin">
                                                        <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Consulting Rooms</th>
                                                            <th>Clinics</th>
                                                            <th>Date Added</th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach($finds as $find) {
                                                            $clinic = Clinic::find_by_id($find->clinic_id);
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $index++; ?></td>
                                                                <td><?php echo $find->room_no; ?></td>
                                                                <td><?php echo $clinic->name ?></td>
                                                                <td><?php $d_date = date('d/m/Y h:i a', strtotime($find->date)); echo $d_date; ?></td>
                                                                <td><a href="edit.php?id=<?php echo $find->id; ?>">Edit</a> </td>
                                                                <td><a href="delete.php?id=<?php echo $find->id; ?>">Delete</a> </td>
                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="Profile-new">
                                                <h6>Add Consulting Room </h6>
                                                <form action="" method="post">

                                                    <div class="input-group">
                                                        <select class="form-control" style="width: 350px" id="clinic_id" name="clinic_id">
                                                            <option value="">--Select Clinic--</option>
                                                            <?php
                                                            $finds = Clinic::find_all();
                                                            foreach ($finds as $find) {
                                                                ?>
                                                                <option
                                                                    value="<?php echo $find->id; ?>"><?php echo $find->name; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="input-group">
                                                        <input class="form-control" name="room_no" placeholder="Consulting Room" style="width: 300px" type="text" required >
                                                    </div>
                                                    <div class="input-group">
                                                        <button type="submit" class="btn btn-primary">Save Consulting Rooms</button>
                                                    </div>



                                                </form>
                                            </div>

                                        </div>
                                    </div>
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