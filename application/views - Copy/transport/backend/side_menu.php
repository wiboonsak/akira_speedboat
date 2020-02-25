<style>
    #sidebar-menu > ul > li > a:hover {

        color: #f9bc0b;
    }

    #sidebar-menu > ul > li > a {		
        color: #FFFFFF;
    }

    .nav-second-level li a, .nav-thrid-level li a {		
        color: #FFFFFF;
    }
	
    #sidebar-menu > ul > li > a:focus, #sidebar-menu > ul > li > a:active {		
        color: #FFFFFF !important;
        background-color: #86afcf !important;
    }

    #sidebar-menu > ul > li > a.active {		
        color: #FFFFFF !important;
        background-color: #86afcf !important;
    }

    /*.pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus, .page-item.active .page-link {
            
            
    }*/
	.nav-second-level li a:hover, .nav-thrid-level li a:hover {
    	background-color: #c9eae9;
    	color: #FFFFFF;
	}

    .mce-btn {		
        background-color: #86afcf !important;    
        color: #FFFFFF !important;
    }

    .mce-menubtn button span, .mce-menubtn button i, .mce-btn button span, .mce-btn button i {
        color: #FFFFFF !important;
    }

    .mce-menubar .mce-caret, .mce-btn .mce-caret {
        border-top-color: #FFFFFF !important;
    }

	.nav-second-level li.active > a {
    	color: #FFFFFF;
    	background-color: #c9eae9;
		font-weight: 600;
	}

</style>
<title>[Back Office] Journal of Environmental Management and Energy System | JEMES</title>

<div class="left side-menu" style="background-color: #00aba6">

    <div class="slimscroll-menu" id="remove-scroll">

        <!-- LOGO -->
        <div class="topbar-left" style="background-color: #007b77">
            <a href="<?php echo base_url('CMS_Journal')?>" class="logo">
                <span>
                    <img src="<?php echo base_url('assets_journal/logoJ.png')?>" alt="" height="40">
                </span>
                <i>
                    <img src="<?php echo base_url('assets_journal/logoJ.png')?>" alt="" height="28">
                </i>
            </a>
        </div>

        <!-- User box -->
        <div class="user-box">          
			<h5 style="color: #FFFFFF">Welcome <?php //if (($this->session->userdata('juserLv') == '1') || ($this->session->userdata('juserLv') == '2')) { echo 'Managing'; } else { echo 'Editor/Reviewer';  } ?></h5>			
        </div>      

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">
				
				<li>
                    <a href="<?php echo base_url('TransportCMS/RouteManage')?>">
                        <i class="mdi mdi-logout"></i> <span>Route Manage XXXX</span>
                    </a>
                </li>				
				
				<li>
                    <a href="<?php echo base_url('CMS_Journal/logout')?>">
                        <i class="mdi mdi-logout"></i> <span>Logout</span>
                    </a>
                </li>

            </ul>

        </div>
        <!-- Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>