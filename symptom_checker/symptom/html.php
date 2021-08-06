<?php
require('../../layout/header.php');
?>
    <div id="main-content">
        <div class="container-fluid">
            <?php include "../../layout/header_chart.php"; ?>


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
                        if (!empty($message)) { 
                    ?>
                        <div id="success" class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <?php echo output_message($message); ?>
                        </div>
                    <?php } ?>
                            <div class="col-lg-12 col-md-12">
                           <form class=" pb-4" action="../model/SymptomModel.php" method="post">
                           <input type="hidden" name="id" id="body_id"/>
                            <div class="form-group row">
                                  <div class="offset-sm-2 col-sm-2 col-3">  <label> Select Body Part <span class="text-danger">*</span></label></div>
                                    <div class="col-sm-4 col-9"> 
                                        <!-- <input type="text" class="form-control body_part_id" name="body_part_id" required=""> -->
                                        <select class="form-control body_part_id" name="body_part_id" required="">
                                            <option value=""> Select Body Part </option>
                                            <?php 
                                                if(!empty($allBodyPart)){
                                                    foreach ($allBodyPart as $PartData) {
                                                        ?>
                                                                <option value="<?php echo $PartData->id; ?>"><?php echo $PartData->name; ?></option>
                                            <?php
                                                    }
                                                }
                                            ?>
                                            
                                        </select>
                                        <input type="hidden" name="body_part_name" id="body_part_name"/>
                                    </div>
                                   
                                    <!-- <button type="" class="btn btn-primary">New</button> -->
                                </div>
                                </div>
                                <div class="form-group row">
                                  <div class="offset-sm-2 col-sm-2 col-3">  <label> Name <span class="text-danger">*</span></label></div>
                                    <div class="col-sm-4 col-9"> 
                                        <input type="text" class="form-control name" placeholder="Name" name="name" required="">
                                    </div>
                                    
                                </div>
                                <div class="col-sm-12 col-12 text-center"> 
                                    <button type="submit" class="btnSubmit btn btn-primary">Save</button>
                                </div>
                            
                            </form>
                                    <div class="table-responsive mt-4">
                                                    <table class="table no-margin table-dark table-striped table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Symptom Name </th>
                                                            <th>Body </th>
                                                            <th>Operation </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                        if (!empty($finds)) {
                                                            foreach ($finds as $find) {   
                                                              
                                                        ?>
                                                            <tr id="locationId<?= $find->id ?>">
                                                                <td><?php echo $index++; ?></td>
                                                                <td ><a href="javascript:void(0)"> <?= ucfirst($find->name) ?> </a></td>
                                                                <?php if(isset($find->body_part_id))  { ?>
                                                                <td ><a href="javascript:void(0)"> 
                                                                    <?php 
                                                                        
                                                                            $findBodyId = BodyPart::find_by_id($find->body_part_id)    ;  
                                                                          
                                                                        echo ucfirst($findBodyId->name) ?> 
                                                                </a></td>
                                                                        <?php } ?>
                                                                <td> 
                                                                    <a href="javascript:void(0)" id="editLocation" onclick="editDataSymptom('<?= $find->id ?>', '<?= $find->name ?>', '<?= $find->body_part_id ?>', '<?= $find->body_part_name ?>')">  <i class="fa fa-edit" title="Edit"></i> </a> 
                                                                    <a href="javascript:void(0)" id="deleteLocation" onclick="deleteBodySymptom('<?= $find->id ?>')" >  <i class="icon-trash" title="Delete"></i> </a> 
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
require('../../layout/footer.php');
?>

<script src="../js/script.js" ></script>