<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
     <!-- Begin page --> 	
        <div id="wrapper">
            	
<div class="content-page">
    <!-- Top Bar Start -->
    <div class="topbar">
        <nav class="navbar-custom">                  
            <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                    <button class="button-menu-mobile open-left disable-btn">
                        <i class="dripicons-menu"></i>
                    </button>
                </li>
                <li>
                    <div class="page-title-box">
                       <h4>Transport Booking</h4>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
    <!-- Top Bar End -->

    <!-- Start Page content -->
    <div class="content">
        <div class="container-fluid">

            <div class="card-box">									

                   <div class="form-group row">
									<label class="col-md-2 col-sm-4 col-form-label">วันเดินทาง</label>
                                    <div class="col-md-4 col-sm-8">
                                         <div class="input-group">
                                             <input type="text" class="form-control" id="datepicker1" placeholder="dd/mm/yyyy">
                                             <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                             </div>
                                         </div>
                                    </div>
                                   <div class="col-md-4 col-sm-8">
                                        <select id="bookingType" name="bookingType" class="form-control">
												<option value="1">รายการจอง</option>
												<option value="3">รายการยกเลิก</option>
												<option value="2">ประวัติ</option>
									    </select>
                                    </div> 
                                     <div class="col-md-2">
									<button class="btn  btn-success" type="button" name="Button" onclick="searchinput()" >ค้นหา</button>
									</div>
                                                                       
									</div>
                    
                                           <div id="showData"></div>
                    </div>
              
            </div>

        </div> <!-- container -->

    </div> <!-- content -->

  

</div>
       