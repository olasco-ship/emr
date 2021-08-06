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
                            Clinics
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
                            $clinics = Clinic::order_name();
                            $subClinic = SubClinic::find_by_id($user->sub_clinic_id);
                            ?>


                            <div class="container">
                                <h2> Clinical Departments  </h2>
                                <div id="accordion">
                                    <!-- --><?php
                                    /*                                    echo gethostname() ;
                                                                        */?>
                                    <?php  foreach ($clinics as $clinic) {  ?>
                                    <div class="card">
                                        <div class="card-header">
                                            <ul class="list-group">
                                                <li class='list-group-item'>
                                                    <a class="card-link" data-toggle="collapse"
                                                       href="#collapse<?php echo $clinic->id; ?>"><?php echo $clinic->name ?></a>
                                                    <!-- <a href='clinic.php?id=<?php  echo $clinic->id ?>'><?php echo $clinic->name ?></a> -->
                                                </li>
                                            </ul>
                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>

                                <div id="collapse<?php echo $clinic->id; ?>"
                                     class="collapse" data-parent="#accordion">
                                    <div class="card-body">

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