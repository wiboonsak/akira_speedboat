

<div class="left side-menu" >

    <div class="slimscroll-menu" id="remove-scroll">

        <!-- LOGO -->
        <div class="topbar-left" >
            <a href="<?php echo base_url('PackageCMS') ?>" class="logo">
                <span>
                    <img src="<?php echo base_url('images/logo-header.png') ?>" alt="" width="90%" >
                </span>
                <i>
                    <img src="<?php echo base_url('images/logo-header.png') ?>" alt="" width="90%" >
                </i>
            </a>
        </div>

        <!-- User box -->
        <div class="user-box">          
			<h5 style="color: #FFFFFF;text-align: center">Welcome</h5>			
        </div>
        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">
				 <li> <p style="background-color:#9F0104; font-size: 15px; line-height: 2.6; padding-left: 20px; margin-bottom: 0px; color: #FFFFFF;"> <strong>New Booking</strong> </p>
                    <!--</a>-->
                </li>
                 <li >
                    <a href="<?php echo base_url('PackageCMS/bookingTransport_view')?>">
                        <i class="fa fa-automobile "></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Transport Booking</span>
                    </a>
                </li>
                <li >
                    <a href="<?php echo base_url('PackageCMS/bookinglist')?>">
                        <i class="fi-folder"></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #FFFFFF;"></span> <span>Package Booking</span>
                    </a>
                </li> 
                <li> <p style="background-color: #9F0104; font-size: 15px; line-height: 2.6; padding-left: 20px; margin-bottom: 0px; color: #FFFFFF;"> <strong>Transport Managing</strong> </p>
                    <!--</a>-->
                </li>
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
                        <i class="fa fa-map-marker "></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Route</span>
                    </a>
                </li>
                 <li>
                    <a href="<?php echo base_url('TransportCMS/Land_Transfer')?>">
                        <i class="fa fa-map-marker "></i><span class="badge badge-danger badge-pill pull-right" style="background-color: #F9BC0B;"></span> <span>Land Transfer</span>
                    </a>
                </li>
                <li> <p style="background-color: #9F0104; font-size: 15px; line-height: 2.6; padding-left: 20px; margin-bottom: 0px; color: #FFFFFF;"> <strong>Package Managing</strong> </p>
                    <!--</a>-->
                </li>
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
                <li> <p style="background-color: #9F0104; font-size: 15px; line-height: 2.6; padding-left: 20px; margin-bottom: 0px; color: #FFFFFF;"> <strong>Report</strong> </p>
                    <!--</a>-->
                </li>
                 <li>
                        <a href="javascript: void(0);"><i class="fa fa-automobile "></i><span>Transport Report</span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <a href="<?php echo base_url('PackageCMS/ReportTransportbooking')?>">Transport Booking</a> 
                           <a href="<?php echo base_url('PackageCMS/ReportTransportcancel')?>">Report Cancel</a> 
                            </ul>
                </li>     
                 <li>
                        <a href="javascript: void(0);"><i class="fi-folder"></i><span>Package Report</span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                           <li><a href="<?php echo base_url('PackageCMS/Reportbooking')?>">Package Booking</a></li>  
                           <li><a href="<?php echo base_url('PackageCMS/Reportcancel')?>">Report Cancel</a></li> 
                            </ul>
                </li> 
                   <li> <p style="background-color: #9F0104; font-size: 15px; line-height: 2.6; padding-left: 20px; margin-bottom: 0px; color: #FFFFFF;"> <strong>Admin Managing</strong> </p>
                    <!--</a>-->
                </li>
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
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<script>
			function cangePassForm(){
				$.post('<?php echo base_url('PackageCMS/cangePassForm')?>' , { }, function(data){
						$('#myModal .modal-body').empty();
						$('#myModalLabel').text('เปลี่ยนรหัสผ่าน');
						$('.bodyA').html(data);
						$('#myModal').modal('show');	
				})
			}
			//-----------------------newpass cnewpass
			function DoChangePass(){
				var newpass = $('#newpass').val();
				var cnewpass = $('#cnewpass').val();
				if(newpass==''){
					$('#ShowError').html('<span class="text-danger">กรุณาใส่รหัสผ่านใหม่</span>');
					return false;
				}else if(cnewpass==''){
					$('#ShowError').html('<span class="text-danger">กรุณายืนยันรหัสผ่านใหม่</span>');
					return false;	
				}else if(newpass!=cnewpass){
					$('#ShowError').html('<span class="text-danger">รหัสผ่านและยืนยันรหัสผ่านต้องตรงกัน</span>');
					return false;	
				}else{
					$('#ShowError').empty();
					$.post('<?php echo base_url('PackageCMS/doChangePass')?>', { newpass : newpass  }, function(data){
						if(data==1){
							alert('เปลียนรหัสผ่านเรียบร้อย');
							$('#myModal').modal('hide');	
						}else{
							$('#ShowError').html('<span class="text-danger">Error ไม่สามารถเปลียนรหัสผ่านได้</span>');
						}
					})
				}
			}
		</script>
