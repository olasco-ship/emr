<?php
require_once("includes/initialize.php");

if (!$session->is_logged_in()) {
    redirect_to(emr_lucid . "/index.php");
}


require('layout/header.php');
?>


<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <!--                        <div class="col-lg-6 col-md-8 col-sm-12">-->
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left">
                            </i></a> OBAFEMI AWOLOWO UNIVERSITY TEACHING HOSPITAL COMPLEX</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Electronic Medical Record</li>
                        <li class="breadcrumb-item">Main Dashboard</li>

                    </ul>
                </div>

            </div>
        </div>

        <div class="row clearfix">

            <div class="col-lg-9 col-md-12">
                <div class="card">
                    <div class="body">
                        <div id="demo" class="carousel slide" data-ride="carousel">

                            <ul class="carousel-indicators">
                                <li data-target="#demo" data-slide-to="0" class="active"></li>
                                <li data-target="#demo" data-slide-to="1"></li>
                                <li data-target="#demo" data-slide-to="2"></li>
                            </ul>

                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="carousel/1.png" alt="Pharmacy" width="1100" height="500">
                                </div>
                                <div class="carousel-item">
                                    <img src="carousel/ross.jpg" alt="Pharmacy" width="1100" height="500">
                                </div>
                                <div class="carousel-item">
                                    <img src="carousel/2.jpg" alt="Pharmacy" width="1100" height="500">
                                </div>
                            </div>

                            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#demo" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>


                    </div>
                </div>

            </div>

            <div class="col-lg-3 col-md-12">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-6">
                        <div class="card top_counter">
                            <div class="body">
                                <div id="top_counter1" class="carousel vert slide" data-ride="carousel"
                                     data-interval="2500">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="icon"><i class="fa fa-user"></i></div>
                                            <div class="content">
                                                <div class="text">Total Patient</div>
                                                <h5 class="number">215</h5>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="icon"><i class="fa fa-user"></i></div>
                                            <div class="content">
                                                <div class="text">New Patient</div>
                                                <h5 class="number">21</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div id="top_counter2" class="carousel vert slide" data-ride="carousel"
                                     data-interval="2100">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="icon"><i class="fa fa-user-md"></i></div>
                                            <div class="content">
                                                <div class="text">Laboratory</div>
                                                <h5 class="number">06</h5>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="icon"><i class="fa fa-user-md"></i></div>
                                            <div class="content">
                                                <div class="text">Radiology</div>
                                                <h5 class="number">04</h5>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="icon"><i class="fa fa-user-md"></i></div>
                                            <div class="content">
                                                <div class="text">Treatment</div>
                                                <h5 class="number">23</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <div class="card top_counter">
                            <div class="body">
                                <div id="top_counter3" class="carousel vert slide" data-ride="carousel"
                                     data-interval="2300">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="icon"><i class="fa fa-eye"></i></div>
                                            <div class="content">
                                                <div class="text">Total Visitors</div>
                                                <h5 class="number">10K</h5>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="icon"><i class="fa fa-eye"></i></div>
                                            <div class="content">
                                                <div class="text">Today Visitors</div>
                                                <h5 class="number">142</h5>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="icon"><i class="fa fa-eye"></i></div>
                                            <div class="content">
                                                <div class="text">Month Visitors</div>
                                                <h5 class="number">2,087</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="icon"><i class="fa fa-university"></i></div>
                                <div class="content">
                                    <div class="text">Revenue</div>
                                    <h5 class="number">₦18,925</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="card top_counter">
                            <div class="body">
                                <div class="icon"><i class="fa fa-thumbs-o-up"></i></div>
                                <div class="content">
                                    <div class="text">Happy Patients</div>
                                     <h5 class="number">528</h5>
                                </div>
                                <hr>
                                <div class="icon"><i class="fa fa-smile-o"></i></div>
                                <div class="content">
                                    <div class="text">Smiley Faces</div>
                                       <h5 class="number">2,528</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!--

        <div class="row clearfix">
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Visitors Statistics</h2>
                        <ul class="header-dropdown">
                            <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top"
                                   title="Weekly">W</a></li>
                            <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top"
                                   title="Monthly">M</a></li>
                            <li><a class="tab_btn active" href="javascript:void(0);" data-toggle="tooltip"
                                   data-placement="top" title="Yearly">Y</a></li>
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false"></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another Action</a></li>
                                    <li><a href="javascript:void(0);">Something else</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div id="Visitors_chart" class="flot-chart m-b-20"></div>
                        <div class="row text-center">
                            <div class="col-lg-3 col-md-3 col-6">
                                <div id="Visitors_chart1" class="carousel slide" data-ride="carousel"
                                     data-interval="2000">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="body xl-turquoise">
                                                <h4>2,025</h4>
                                                <span>America</span>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="body xl-parpl">
                                                <h4>1,100</h4>
                                                <span>Canada</span>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="body xl-salmon">
                                                <h4>680</h4>
                                                <span>Brazil</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-6">
                                <div id="Visitors_chart2" class="carousel slide" data-ride="carousel"
                                     data-interval="2200">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="body xl-parpl">
                                                <h4>1,025</h4>
                                                <span>UK</span>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="body xl-slategray">
                                                <h4>582</h4>
                                                <span>France</span>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="body xl-khaki">
                                                <h4>128</h4>
                                                <span>Georgia</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-6">
                                <div class="body xl-salmon">
                                    <h4>3,845</h4>
                                    <span>India</span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-6">
                                <div class="body xl-slategray">
                                    <h4>863</h4>
                                    <span>Other</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>ToDo List <small>This Month task list</small></h2>
                    </div>
                    <div class="body todo_list">
                        <ul class="list-unstyled">
                            <li>
                                <label class="fancy-checkbox mb-0">
                                    <input type="checkbox" name="checkbox" checked>
                                    <span>A Brief History Of Anesthetics</span>
                                </label>
                                <div class="m-l-35 m-b-30">
                                    <small class="text-muted">SCHEDULED FOR 3:00 P.M. ON JUN 2018</small>
                                    <ul class="list-unstyled team-info">
                                        <li><img src="assets/images/xs/avatar1.jpg" data-toggle="tooltip"
                                                 data-placement="top" title="Dr. Chris Fox" alt="Avatar"></li>
                                        <li><img src="assets/images/xs/avatar2.jpg" data-toggle="tooltip"
                                                 data-placement="top" title="Dr. Joge Lucky" alt="Avatar"></li>
                                        <li><img src="assets/images/xs/avatar5.jpg" data-toggle="tooltip"
                                                 data-placement="top" title="Isabella" alt="Avatar"></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <label class="fancy-checkbox mb-0">
                                    <input type="checkbox" name="checkbox">
                                    <span>Using Laser Teatment to Help</span>
                                </label>
                                <div class="m-l-35 m-b-30">
                                    <small class="text-muted">SCHEDULED FOR 4:30 P.M. ON JUN 2018</small>
                                </div>
                            </li>
                            <li>
                                <label class="fancy-checkbox mb-0">
                                    <input type="checkbox" name="checkbox">
                                    <span>Selecting the Apnea Treatment</span>
                                </label>
                                <div class="m-l-35 m-b-30">
                                    <small class="text-muted">SCHEDULED FOR 4:30 P.M. ON JUN 2018</small><br>
                                    <small class="text-warning">ICU PATIENT - LAST 2 DAYS</small><br>
                                    <small>Patient Name: <a href="#">Hossein</a></small>
                                </div>
                            </li>
                            <li>
                                <label class="fancy-checkbox mb-0">
                                    <input type="checkbox" name="checkbox">
                                    <span>Using Laser Teatment to Help</span>
                                </label>
                                <div class="m-l-35">
                                    <small class="text-muted">SCHEDULED FOR 4:30 P.M. ON JUN 2018</small>
                                    <ul class="list-unstyled team-info">
                                        <li><img src="assets/images/xs/avatar4.jpg" data-toggle="tooltip"
                                                 data-placement="top" title="Dr. Chris Fox" alt="Avatar"></li>
                                        <li><img src="assets/images/xs/avatar6.jpg" data-toggle="tooltip"
                                                 data-placement="top" title="Dr. Joge Lucky" alt="Avatar"></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-6 col-md-12">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2>Patient history</h2>
                                <ul class="header-dropdown">
                                    <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip"
                                           data-placement="top" title="Weekly">W</a></li>
                                    <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip"
                                           data-placement="top" title="Monthly">M</a></li>
                                    <li><a class="tab_btn active" href="javascript:void(0);" data-toggle="tooltip"
                                           data-placement="top" title="Yearly">Y</a></li>
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                           role="button" aria-haspopup="true" aria-expanded="false"></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="javascript:void(0);">Action</a></li>
                                            <li><a href="javascript:void(0);">Another Action</a></li>
                                            <li><a href="javascript:void(0);">Something else</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <div id="patient_history" class="chartist"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2>Recent Chat</h2>
                                <ul class="header-dropdown">
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                           role="button" aria-haspopup="true" aria-expanded="false"></a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="javascript:void(0);">Action</a></li>
                                            <li><a href="javascript:void(0);">Another Action</a></li>
                                            <li><a href="javascript:void(0);">Something else</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="body text-center">
                                <div class="cwidget-scroll">
                                    <ul class="chat-widget m-r-5 clearfix">
                                        <li class="left float-left">
                                            <img src="assets/images/xs/avatar2.jpg" class="rounded-circle" alt="">
                                            <div class="chat-info">
                                                <span class="message">Hello, John<br>What is the update on Project X?</span>
                                            </div>
                                        </li>
                                        <li class="right">
                                            <img src="assets/images/xs/avatar1.jpg" class="rounded-circle" alt="">
                                            <div class="chat-info">
                                                <span class="message">Hi, Chandler<br> It is almost completed. I will send you an email later today.</span>
                                            </div>
                                        </li>
                                        <li class="left float-left">
                                            <img src="assets/images/xs/avatar2.jpg" class="rounded-circle" alt="">
                                            <div class="chat-info">
                                                <span class="message">That's great. Will catch you in evening.</span>
                                            </div>
                                        </li>
                                        <li class="right">
                                            <img src="assets/images/xs/avatar1.jpg" class="rounded-circle" alt="">
                                            <div class="chat-info">
                                                <span class="message">Sure we'will have a blast today.</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="input-group p-t-15">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-paper-plane"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Enter text here...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Hospital Activities</h2>
                    </div>
                    <div class="body">
                        <div class="timeline-item green">
                            <span class="date">20-04-2018 - Today</span>
                            <h5>A Brief History Of Anesthetics</h5>
                            <span><a href="javascript:void(0);">Elisse Joson</a> San Francisco, CA</span>
                            <div class="msg">
                                <p>I'm speaking with myself, number one, because I have a very good brain and I've said
                                    a lot of things.</p>
                                <a href="javascript:void(0);" class="m-r-20"><i class="icon-heart"></i> Like</a>
                                <a role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false"
                                   aria-controls="collapseExample"><i class="icon-bubbles"></i> Comment</a>
                                <div class="collapse m-t-10" id="collapseExample">
                                    <div class="well">
                                        <form>
                                            <div class="form-group">
                                                <textarea rows="2" class="form-control no-resize"
                                                          placeholder="Enter here for tweet..."></textarea>
                                            </div>
                                            <button class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="timeline-item blue">
                            <span class="date">19-04-2018 - Yesterday</span>
                            <h5>Using Laser Teatment to Help</h5>
                            <span><a href="javascript:void(0);" title="">Katherine Lumaad</a> Oakland, CA</span>
                            <div class="msg">
                                <p>web by far While that's mock-ups and this is politics, are they really so different?
                                    I think the only card she has is the Lorem card.</p>
                                <div class="timeline_img m-b-20">
                                    <img class="w-25" src="assets/images/blog/blog-page-4.jpg" alt="Awesome Image">
                                    <img class="w-25" src="assets/images/blog/blog-page-2.jpg" alt="Awesome Image">
                                </div>
                                <a href="javascript:void(0);" class="m-r-20"><i class="icon-heart"></i> Like</a>
                                <a role="button" data-toggle="collapse" href="#collapseExample1" aria-expanded="false"
                                   aria-controls="collapseExample1"><i class="icon-bubbles"></i> Comment</a>
                                <div class="collapse m-t-10" id="collapseExample1">
                                    <div class="well">
                                        <form>
                                            <div class="form-group">
                                                <textarea rows="2" class="form-control no-resize"
                                                          placeholder="Enter here for tweet..."></textarea>
                                            </div>
                                            <button class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="timeline-item warning pb-0">
                            <span class="date">21-02-2018</span>
                            <h5>Selecting the right Apnea Treatment</h5>
                            <span><a href="javascript:void(0);" title="">Gary Camara</a> San Francisco, CA</span>
                            <div class="msg">
                                <p>I write the best placeholder text, and I'm the biggest developer on the web by far...
                                    While that's mock-ups and this is politics, is the Lorem card.</p>
                                <a href="javascript:void(0);" class="m-r-20"><i class="icon-heart"></i> Like</a>
                                <a role="button" data-toggle="collapse" href="#collapseExample2" aria-expanded="false"
                                   aria-controls="collapseExample2"><i class="icon-bubbles"></i> Comment</a>
                                <div class="collapse m-t-10" id="collapseExample2">
                                    <div class="well">
                                        <form>
                                            <div class="form-group">
                                                <textarea rows="2" class="form-control no-resize"
                                                          placeholder="Enter here for tweet..."></textarea>
                                            </div>
                                            <button class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Patients Status</h2>
                        <ul class="header-dropdown">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false"></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another Action</a></li>
                                    <li><a href="javascript:void(0);">Something else</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <p class="float-md-right">
                            <span class="badge badge-success">3 Admit</span>
                            <span class="badge badge-default">2 Discharge</span>
                        </p>
                        <div class="table-responsive table_middel">
                            <table class="table m-b-0">
                                <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Patients</th>
                                    <th>Adress</th>
                                    <th>START Date</th>
                                    <th>END Date</th>
                                    <th>Priority</th>
                                    <th>Progress</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><img src="assets/images/xs/avatar3.jpg" class="rounded-circle width30 m-r-15"
                                             alt="profile-image"><span>John</span></td>
                                    <td><span class="text-info">70 Bowman St. South Windsor, CT 06074</span></td>
                                    <td>Sept 13, 2017</td>
                                    <td>Sept 16, 2017</td>
                                    <td><span class="badge badge-warning">MEDIUM</span></td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-warning" role="progressbar"
                                                 aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: 40%;"><span class="sr-only">40% Complete</span></div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-success">Admit</span></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><img src="assets/images/xs/avatar1.jpg" class="rounded-circle width30 m-r-15"
                                             alt="profile-image"><span>Jack Bird</span></td>
                                    <td><span class="text-info">123 6th St. Melbourne, FL 32904</span></td>
                                    <td>Sept 13, 2017</td>
                                    <td>Sept 22, 2017</td>
                                    <td><span class="badge badge-warning">MEDIUM</span></td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="100"
                                                 aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span
                                                        class="sr-only">100% Complete</span></div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-default">Discharge</span></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><img src="assets/images/xs/avatar4.jpg" class="rounded-circle width30 m-r-15"
                                             alt="profile-image"><span>Dean Otto</span></td>
                                    <td><span class="text-info">123 6th St. Melbourne, FL 32904</span></td>
                                    <td>Sept 13, 2017</td>
                                    <td>Sept 23, 2017</td>
                                    <td><span class="badge badge-warning">MEDIUM</span></td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-success" role="progressbar"
                                                 aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: 15%;"><span class="sr-only">15% Complete</span></div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-success">Admit</span></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><img src="assets/images/xs/avatar2.jpg" class="rounded-circle width30 m-r-15"
                                             alt="profile-image"><span>Jack Bird</span></td>
                                    <td><span class="text-info">4 Shirley Ave. West Chicago, IL 60185</span></td>
                                    <td>Sept 17, 2017</td>
                                    <td>Sept 16, 2017</td>
                                    <td><span class="badge badge-success">LOW</span></td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="100"
                                                 aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span
                                                        class="sr-only">100% Complete</span></div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-default">Discharge</span></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><img src="assets/images/xs/avatar5.jpg" class="rounded-circle width30 m-r-15"
                                             alt="profile-image"><span>Hughe L.</span></td>
                                    <td><span class="text-info">4 Shirley Ave. West Chicago, IL 60185</span></td>
                                    <td>Sept 18, 2017</td>
                                    <td>Sept 18, 2017</td>
                                    <td><span class="badge badge-danger">HIGH</span></td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" role="progressbar"
                                                 aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: 85%;"><span class="sr-only">85% Complete</span></div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-success">Admit</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        -->



    </div>
</div>


<?php

require('layout/footer.php');