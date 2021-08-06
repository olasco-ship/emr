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
                            <div class="text-right"><a href="add_question.php" class="btn btn-primary"> Add Question </a></div>
                                <div class="table-responsive mt-4">
                                    <table class="table no-margin table-dark table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Question </th>
                                            
                                            <th>Operation </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        if (!empty($finds)) {
                                            foreach ($finds as $find) {
                                                // $bodyType = BodyPart::find_by_id($find->body_part_id);
                                                // $symptom = Symptom::find_by_id($find->body_part_symptom_id);
                                        ?>
                                            <tr id="locationId<?= $find->id ?>">
                                                <td><?php echo $index++; ?></td>
                                                <td ><a href="javascript:void(0)"> <?= ucfirst($find->question) ?> </a></td>
                                                
                                                <td> 
                                                    <a href="edit_question.php?id=<?php echo $find->id; ?>">  <i class="fa fa-edit" title="Edit"></i> </a> 
                                                    <!-- <a href="mapping/index.php?id=<?php //echo $find->id; ?>">  <i class="icon-list" title="View Mapping"></i> </a>  -->
                                                    <a href="javascript:void(0)" id="deleteLocation" onclick="deleteBodyQuestion('<?= $find->id ?>')" >  <i class="icon-trash" title="Delete"></i> </a> 
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