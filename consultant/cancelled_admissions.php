<?php
require_once("../includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}

$user = User::find_by_id($session->user_id);






require('../layout/header.php');
?>

<style type="text/css">

    .table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
    word-break: keep-all;
    white-space: nowrap;
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
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        <div class="bh_chart hidden-xs">
                            <div class="float-left m-r-15">
                                <small>Visitors</small>
                                <h6 class="mb-0 mt-1"><i class="icon-user"></i> 1,784</h6>
                            </div>
                            <span class="bh_visitors float-right">2,5,1,8,3,6,7,5</span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Visits</small>
                                <h6 class="mb-0 mt-1"><i class="icon-globe"></i> 325</h6>
                            </div>
                            <span class="bh_visits float-right">10,8,9,3,5,8,5</span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Chats</small>
                                <h6 class="mb-0 mt-1"><i class="icon-bubbles"></i> 13</h6>
                            </div>
                            <span class="bh_chats float-right">1,8,5,6,2,4,3,2</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="header">
                            <!-- <h2>Total Revenue</h2>-->
                            <ul class="header-dropdown">
                                <li><a class="tab_btn" href="javascript:void(0);" title="Weekly">W</a></li>
                                <li><a class="tab_btn" href="javascript:void(0);" title="Monthly">M</a></li>
                                <li><a class="tab_btn active" href="javascript:void(0);" title="Yearly">Y</a></li>
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

                            <a style="font-size: larger" href="index.php">&laquo;Back</a>

                            <div class="row clearfix">
                                <?php
                                    $clinics = Clinic::find_all();
                                    $subClinic = SubClinic::find_by_id($user->sub_clinic_id);
                                ?>


                                        <div class="col-sm-12"> 
                <form>
                <div class="row">
                    <div class="col-sm-4">
                    <div class="form-group">
                    <label>IPD No.</label>
                    <input type="text" class="form-control" name="IPD_No." value="Kemi" required="" >
                    </div>
                    </div>
                        <div class="col-sm-4">
                    <div class="form-group">
                    <label>Patient Name</label>
                    <input type="text" class="form-control" name="Patient_Name" value="Kemi" required="" >
                    </div>
                    </div>
                        <div class="col-sm-4">
                    <div class="form-group">
                    <label>Location/Ward</label>
                    <input type="text" class="form-control" name="Location/Ward" value="Kemi" required="" >
                    </div>
                    </div>
                </div>  
                <div class="row">
                    
                        <div class="col-sm-4">
                    <div class="form-group">
                    <label>Patient Category</label>
                    <select class="form-control" name="bed_no">
                        <option value="">-- Patient Category --</option>

                        <option value="1">1</option>
                        <option value="2" selected="selected">2</option>
                        <option value="3">3</option>
                    </select>
                    </div>
                    </div>
                        <div class="col-sm-4">
                    <div class="form-group">
                    <label>Admi. Date From</label>
                      <input type="date" class="form-control" id="adm_date" name="adm_date_start" value="2020-01-16">
                    </div>
                    </div>
                        <div class="col-sm-4">
                    <div class="form-group">
                    <label>Admi. Date To</label>
                     <input type="date" class="form-control" id="adm_date" name="adm_date_end" value="2020-01-16">
                    </div>
                    </div>
                </div>  
                    <div class="row">
                    <div class="col-sm-4">
                    <div class="form-group">
                    <label>Gender</label>
                    <br>
                        <label class="fancy-radio">
                        <input type="radio" name="gender" value="Male" required="" data-parsley-errors-container="#error-radio">
                        <span><i></i>Male</span>
                        </label>
                        <label class="fancy-radio">
                        <input type="radio" name="gender" value="Female" checked="checked">
                        <span><i></i>Female</span>
                        </label>
                    </div>

                   
                    </div>
                     <div class="col-sm-4">
                          <br><button type="button" class="btn btn-primary">Search</button></div>
                    
                </div>


                </form>
            </div>
 <div class="table-responsive mt-4">              
   <table class="table table-hover">
    <thead>
      <tr>
        <th>S.N.</th>
        <th>Adm. Date</th>
        <th>IPD. No.</th>
        <th>Mobile No.</th>
        <th>Consultant Dr.  </th>
        <th>Room</th>
        <th>Bed No.</th>
        <th>Cancel By   </th>
        <th>Cancellation Date</th>
        <th>Reason for Cancellation</th>
      
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>11/02/2019</td>
        <td>435</td>
        <td>+5697823448</td>
        <td>Mr. jorden</td> 
        <td>6</td>
        <td>9</td>
        <td>Dr. robert</td>
        <td>21/04/2019</td>
        <td> because of services</td>
      
      </tr>
          <tr>
        <td>2</td>
        <td>11/02/2019</td>
        <td>435</td>
        <td>+5697823448</td>
        <td>Mr. jorden</td> 
        <td>6</td>
        <td>9</td>
        <td>Dr. robert</td>
        <td>21/04/2019</td>
        <td> because of services</td>
      
      </tr>
          <tr>
        <td>3</td>
        <td>11/02/2019</td>
        <td>435</td>
        <td>+5697823448</td>
        <td>Mr. jorden</td> 
        <td>6</td>
        <td>9</td>
        <td>Dr. robert</td>
        <td>21/04/2019</td>
        <td> because of services</td>
      
      </tr>
          <tr>
        <td>4</td>
        <td>11/02/2019</td>
        <td>435</td>
        <td>+5697823448</td>
        <td>Mr. jorden</td> 
        <td>6</td>
        <td>9</td>
        <td>Dr. robert</td>
        <td>21/04/2019</td>
        <td> because of services</td>
      
      </tr>
          <tr>
        <td>5</td>
        <td>11/02/2019</td>
        <td>435</td>
        <td>+5697823448</td>
        <td>Mr. jorden</td> 
        <td>6</td>
        <td>9</td>
        <td>Dr. robert</td>
        <td>21/04/2019</td>
        <td> because of services</td>
      
      </tr>
        

   
    
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