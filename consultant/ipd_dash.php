<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);





require('../layout/header.php');
?>
<style type="text/css">



.ward li:nth-child(1){    
        background-color: #01b2c6;
        color: #fff;
    }
    .ward li a{    
    font-size: 16px;
    color: #fff;
    margin-right: 20px;
    font-weight: 700;
    }
     .ward li{    
   padding: 10px 10px;
    }
   

      .ward li a:nth-child(2){    
  float: right;
    }
    .ward {
    margin: 4px 0;
}
.bed{
    display: flex;
    width: 50%;
    margin: auto;
    flex-wrap: wrap;
    justify-content: space-around;
}
.bed div{
    width: 22%;
    border: 1px solid #01a1df;
    margin-bottom: 8px;
    margin-top: 7px;
    padding: 2px 7px

}
.bed div p{
 color: #01a1df;
    font-weight: 600;
}

   
</style>


    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>
                            Consultancy </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">
                                IPD Dashboard
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">

                        <div class="body">

                            <a style="font-size: larger" href="index.php">&laquo;Back</a>

                            <div class="row clearfix">
                                <?php
                                    $clinics = Clinic::find_all();
                                    $subClinic = SubClinic::find_by_id($user->sub_clinic_id);
                                ?>

                                <div class="container">
                                    <h2> Hospital Wards  </h2>
                                   <?php
                                        $wardData = Wards::find_all();
                                        if (!empty($wardData)) {
                                            foreach ($wardData as $ke => $wData) {
                                                $bedDetail = Beds::find_by_ward_id($wData->id);
                                                $totBed = $bedDetail->bed_no_from - $bedDetail->bed_no_to;
                                                $occBedCount = BedsList::find_by_bed_id_count($bedDetail->id);
                                                $vacantBed = BedsList::find_by_bed_id_count_vacant($bedDetail->id);
                                                
                                    ?>
                                 
                                    <ul class="list-group ward">
                                        <li class='list-group-item'>
                                             <a href="wards_dr.php?ward=<?php echo $wData->id ?>"><?php echo $wData->ward_number ?></a> 
                                             <a data-toggle="collapse"  href="#collapse<?= $ke + 1 ?>"><i class="fa fa-caret-down"></i></a>
                                          <span> - (<span>Total Bed : <?= ($totBed > 0) ? $totBed + 1 : $totBed; ?> </span> | 
                                             <span>occupied Bed : <?= $occBedCount ?> </span> | 
                                             <span>vacant Bed : <?= $vacantBed ?> </span>) </span>
                                                <div id="collapse<?= $ke + 1 ?>" class="panel-collapse collapse" style="background-color: white;">
                                                    <div class="panel-body bed space-around"> 
                                                        <?php
                                                            $bdNo = 0;
                                                            $selectedBedImage = "0";
                                                            if (!empty($bedDetail)) {
                                                                for($a = $bedDetail->bed_no_to; $a <= $bedDetail->bed_no_from; $a++){  
                                                                    $occBedList = BedsList::find_by_bed_id_list($bedDetail->id, $a);
                                                                        if($occBedList->bed_no == $a){
                                                                    ?>
                                                                        <div style="background-color: red;">
                                                                            <img src="../assets/images/bed.png" width="50px">
                                                                            <p style="color: white;">Occupied bed <?= $a  ?></p>
                                                                        </div>
                                                                    <?php                                                                            
                                                                        }else{
                                                                    ?>
                                                                        <div>
                                                                            <img src="../assets/images/bed.png" width="50px">
                                                                            <p>Vacant bed <?= $a  ?></p>
                                                                        </div>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                        <?php                                                                        
                                                                }
                                                            } ?>
                                                    </div>
                                                </div>
                                        </li>
                                    </ul>
                                <?php
                                            }
                                        } ?>
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
?>

<script src="<?php echo emr_lucid ?>/assets/jquery-ui/bootstrap.min.js""></script>