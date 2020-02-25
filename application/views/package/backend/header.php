<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <!--<title>Highdmin - Responsive Bootstrap 4 Admin Dashboard</title>-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url('assets/favicon.ico')?>">
		<!-- X editable -->
        
        <link href="<?php echo base_url('assets/plugins/bootstrap-xeditable/css/bootstrap-editable.css')?>" rel="stylesheet" />
		<link href="<?php echo base_url('assets/plugins/sweet-alert/sweetalert2.min.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/plugins/switchery/switchery.min.css')?>" rel="stylesheet" />
                <link href="<?php echo base_url('assets/plugins/summernote/summernote-bs4.css" rel="stylesheet') ?>"
        <!-- App css -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/icons.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/metismenu.min.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet" type="text/css" />		
		<link href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap4.min.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/datatables/buttons.bootstrap4.min.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/jquery-toastr/jquery.toast.min.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css')?>" rel="stylesheet" />

        <script src="<?php echo base_url('assets/js/modernizr.min.js')?>"></script>
    <style>
@media screen {
    #printSection {
        display: none;
    }
}
@media print {
    body * {
        visibility:hidden;
       
    }
    #printSection, #printSection * {
        visibility:visible;
    }
    #printSection {
        position:absolute;
        left:0;
        top:0;
        width: 100%
    }
    
    
}
            </style>
    </head>

    <body>
	   <!-- Begin page -->
        <div id="wrapper">
	    <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu" style="width: 260px;">

                <div class="slimscroll-menu" id="remove-scroll">

                    <!-- LOGO -->
                    <div class="topbar-left">
                        <a href="<?php echo base_url('dashboard')?>" class="logo">
                            <span>
                                <img src="<?php echo base_url('images/logo-header.png');?>" alt="" width="90%" >
                            </span>
                            <i>
                                <img src="<?php echo base_url('images/logo-header.png');?>" alt="" width="90%" >
                            </i>
                        </a>
                    </div>

                    <!-- User box -->
                    <div class="user-box" align="center" >
                        <h5> <i class="fa fa fa-user-circle-o"></i>&nbsp;<?php echo $this->session->userdata('name')?> </h5>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul class="metismenu" id="side-menu">

                            <!--<li class="menu-title">Navigation</li>-->

                            <li>
                                <a href="<?php echo base_url('dashboard/')?>">
                                    <i class="fi-air-play"></i> <span> Dashboard </span> <!--<span class="badge badge-danger badge-pill pull-right">7</span>-->
                                </a>
                            </li>
 							<li>
                                <a href="javascript: void(0);">
                                    <i class="fa fa-sign-in"></i> <span> New Booking </span><span class="menu-arrow"></span> <!--<span class="badge badge-danger badge-pill pull-right">7</span>-->
                                </a>
								  <ul class="nav-second-level" aria-expanded="false">
                                     <li >
									<a href="<?php echo base_url('PackageCMS/bookinglist')?>">
										<i class="fa fa-circle"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #FFFFFF;"></span> <span>Package Booking</span>
									</a>
								</li> 
							   <li >
									<a href="<?php echo base_url('PackageCMS/bookingTransport_view')?>">
										<i class="fa fa-circle"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Transport Booking</span>
									</a>
								</li>
							   <li >
									<a href="<?php echo base_url('PackageCMS/landTransfer_view')?>">
										<i class="fa fa-circle"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Land Transfer Booking</span>
									</a>
								</li>
							   <li >
									<a href="<?php echo base_url('PackageCMS/Charterboat_view')?>">
										<i class="fa fa-circle"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Charter Boat Booking</span>
									</a>
								</li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);"> <i class="fa fa-automobile "></i><span> Transport Manage </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                   <li>
										<a href="<?php echo base_url('PackageCMS/commissionadd')?>">
											<i class="fa fa-percent"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Commission</span>
										</a>
									</li>
									 <li>
                                   <li>
										<a href="<?php echo base_url('PackageCMS/placeAdd')?>">
											<i class="fa fa-map-marker"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Place</span>
										</a>
									</li>

									 <li>
										<a href="<?php echo base_url('PackageCMS/transportlist')?>">
											<i class="fa fa-automobile "></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Vehicle</span>
										</a>
									</li>
									 <li>
										<a href="<?php echo base_url('TransportCMS/RouteManage')?>">
											<i class="fa fa-map-signs"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Route</span>
										</a>
									</li>

									<li>
										<a href="<?php echo base_url('Partnercontrol')?>">
											<i class="fa fa fa-handshake-o"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Partner Spc</span>
										</a>
									</li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);"> <i class="fa fa-automobile "></i><span> Land Transfer Manage </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                <li>
										<a href="<?php echo base_url('PackageCMS/Transport_Add')?>">
											<i class="fa fa-automobile"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Transport</span>
										</a>
									</li>
				<li>
										<a href="<?php echo base_url('TransportCMS/Land_Transfer')?>">
											<i class="fa fa-map-signs"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Land Transfer</span>
										</a>
									</li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);"> <i class="fa fa-ship"></i><span> Charter boat Manage </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
									 <li>
										<a href="<?php echo base_url('PackageCMS/Boatadd')?>">
											<i class="fa fa-ship"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Boat size</span>
										</a>
									</li>
									 <li>
										<a href="<?php echo base_url('PackageCMS/Boattripadd')?>">
											<i class="fa fa-ship"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Boat Trip</span>
										</a>
									</li>
									 <li>
										<a href="<?php echo base_url('TransportCMS/Charter_boat')?>">
											<i class="fa fa-ship"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Charter Speed boat</span>
										</a>
									</li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);"><i class="fi-briefcase"></i> <span> Package Manage </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
									<li>
										<a href="<?php echo base_url('PackageCMS')?>">
											<i class="fi-folder"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Package Feature</span>
										</a>
									</li>  
									<li>
										<a href="<?php echo base_url('PackageCMS/packagelist')?>">
											<i class="fi-folder"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Package Tour</span>
										</a>
									</li>  
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="fa fa-automobile"></i> <span> Transport Report </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
									<li>
										<a href="<?php echo base_url('PackageCMS/ReportTransportbooking')?>">
											<i class="fa fa-bar-chart"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Transport Booking</span>
										</a>
									</li>  
									<li>
										<a href="<?php echo base_url('PackageCMS/ReportTransportcancel')?>">
											<i class="fa fa-bar-chart"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Report Cancel</span>
										</a>
									</li>  
									<li>
										<a href="<?php echo base_url('PackageCMS/ReportTransportcommission')?>">
											<i class="fa fa-bar-chart"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Report Commission</span>
										</a>
									</li>  
                                </ul>
                            </li>
                            
                            <li>
                                <a href="javascript: void(0);"><i class="fi-briefcase"></i> <span> Package Report </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
									<li>
										<a href="<?php echo base_url('PackageCMS/Reportbooking')?>">
											<i class="fa fa-bar-chart"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Package Booking</span>
										</a>
									</li>  
									<li>
										<a href="<?php echo base_url('PackageCMS/Reportcancel')?>">
											<i class="fa fa-bar-chart"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Report Cancel</span>
										</a>
									</li>  
                                </ul>
                            </li>
                          <li>
                                <a href="javascript: void(0);"><i class="fi-briefcase"></i> <span> Land Transfer Report </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
									<li>
										<a href="<?php echo base_url('PackageCMS/Reportlandsferbooking')?>">
											<i class="fa fa-bar-chart"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Land Transfer Booking</span>
										</a>
									</li>  
									<li>
										<a href="<?php echo base_url('PackageCMS/ReportlandsferCancel')?>">
											<i class="fa fa-bar-chart"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Report Cancel</span>
										</a>
									</li>  
                                </ul>
                            </li>
                          <li>
                                <a href="javascript: void(0);"><i class="fi-briefcase"></i> <span> Charter Boat Report </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
									<li>
										<a href="<?php echo base_url('PackageCMS/Reportcharterbooking')?>">
											<i class="fa fa-bar-chart"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Charter Boat Booking</span>
										</a>
									</li>  
									<li>
										<a href="<?php echo base_url('PackageCMS/ReportcharterCancel')?>">
											<i class="fa fa-bar-chart"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Report Cancel</span>
										</a>
									</li>  
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);"><i class="fa fa-user"></i> <span> Admin Manage </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
   						   <?php if($this->session->userdata('adtype')){?>
							<li>
							<a href="<?php echo base_url('PackageCMS/adminlist')?>">
								<i class="fa fa-group"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Admin List</span> 
							</a>
						    </li> 
						   <?php }?>
							<li>
							<a href="javascript:void(0);" onClick="cangePassForm()">
								<i class="fa fa-desktop"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Change Password</span>
							</a>
						    </li> 
									
								
							<li>
								<a href="<?php echo base_url('Logout')?>">
									<i class="fa fa-desktop"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Log out</span>
								</a>
							</li> 
									
									
                                </ul>
                            </li>
                            <!--<li>
                                <a href="javascript:void(0);"><i class="fi-marquee-plus"></i><span class="badge badge-success pull-right">Hot</span> <span> Extra Pages </span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="extras-timeline.html">Timeline</a></li>
                                    <li><a href="extras-profile.html">Profile</a></li>
                                    <li><a href="extras-invoice.html">Invoice</a></li>
                                    <li><a href="extras-faq.html">FAQ</a></li>
                                    <li><a href="extras-pricing.html">Pricing</a></li>
                                    <li><a href="extras-email-template.html">Email Templates</a></li>
                                    <li><a href="extras-ratings.html">Ratings</a></li>
                                    <li><a href="extras-search-results.html">Search Results</a></li>
                                    <li><a href="extras-gallery.html">Gallery</a></li>
                                    <li><a href="extras-maintenance.html">Maintenance</a></li>
                                    <li><a href="extras-coming-soon.html">Coming Soon</a></li>
                                </ul>
                            </li>-->

                          

                        </ul>

                    </div>
                    <!-- Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->
	
		
