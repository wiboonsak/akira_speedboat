<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
<style>
	.xx2{
		float: right !important;
	}
</style>
<?php //$this->load->view('package/backend/side_menu'); ?>
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
                                    <h4 class="page-title">Add / Edit Charter Speed boat</h4>
                                    <!--<ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Highdmin</a></li>
                                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                                        <li class="breadcrumb-item active">Starter</li>
                                    </ol>-->
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
					<div class="pull-right">
                                <button type="button" class="btn btn-info btn-sm" onClick="window.location.href = '<?php echo base_url('TransportCMS/Charter_boat') ?>'"><i class="fa fa-arrow-left"></i> Back</button>
                            </div>
					<input type="hidden" id="arr_transport" name="arr_transport" >
						
						<ul class="nav nav-tabs">                            
                            							
														
							
							<li class="nav-item">
                                <a href="#route" data-toggle="tab" aria-expanded="false" class="nav-link show active">
                                   <i class="mdi mdi-account-settings-variant "></i> Charter Speed boat Detail
                                </a>
                            </li>
						                     
						
                       </ul>		
						
                                        <?php 
                                        if($dataID!=''){
                                        $numcharter = $listcharter->num_rows();
                                        foreach ($listcharter->result() AS $listcharter2){}
                                        }?>	
						<div class="tab-content">		
				<div class="tab-pane show active" id="route">	
					
					<form id="frm2" role="form" method="post" action="" enctype="multipart/form-data">
                                            <input type="hidden" id="charterid" name="charterid" value="<?php echo $dataID?>">	
                  <div class="form-group row">
                               <label class="col-md-3 col-sm-12 col-form-label" for="destination_place_id">Boat size</label>
                               <div class="col-md-9 col-sm-12" >
                                  <select class="form-control" id="Boatid" name="Boatid">
                                     <option value="">-- Select --</option>
                                     <?php foreach($list_boatData->result() as $list_boatData2){ ?> 
                                <option value="<?php echo $list_boatData2->id?>"  <?php if($dataID!=''){ if($listcharter2->boat_sizeid == $list_boatData2->id){echo 'selected';}}?>><?php echo $list_boatData2->boat_size?></option>
									 <?php } ?> 
									  
                                
                                 </select>
                               </div>
                           </div>
                  <div class="form-group row">
                               <label class="col-md-3 col-sm-12 col-form-label" for="destination_place_id">Boat Trip</label>
                               <div class="col-md-9 col-sm-12" >
                                  <select class="form-control" id="boattrip_id" name="boattrip_id">
                                     <option value="">-- Select --</option>
                                     <?php foreach($list_boattripData->result() as $list_boattripData2){ ?> 
                                <option value="<?php echo $list_boattripData2->id?>" <?php if($dataID!=''){ if($listcharter2->boattrip_id == $list_boattripData2->id){echo 'selected';}}?> ><?php echo $list_boattripData2->boat_trip?></option>
									 <?php } ?> 
									  
                                
                                 </select>
                               </div>
                           </div>
                  <div class="form-group row">
                               <label class="col-md-3 col-sm-12 col-form-label" for="destination_place_id">Price</label>
                               <div class="col-md-9 col-sm-12" >
                                   <input type="text" id="price" name="price" class="form-control" value="<?php if($dataID!=''){echo $listcharter2->price;}?>" >
                               </div>
                           </div>
                                    <br>
						   <div class="form-group row" >
                              <div class="col-12" style="text-align: center">
                                 <button type="button" class="btn btn-primary" onClick="addpricecharter()" >Add / Edit Data</button>
                              </div>
                           </div>
                                        </form>			
					
				</div>
							
							
				<div class="tab-pane" id="route2" style="display: none"></div>
							
							
				</div>
						
				</div>
                    
                    
<div id="modal_Large" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                 <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
             </div>
             <div class="modal-body"></div>
                 
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
</div><!-- /.modal -->    


                    </div> <!-- container -->

                </div> <!-- content -->

<footer class="footer text-right">
                    <!--2018 © Highdmin. - Coderthemes.com-->
                </footer>

            </div>

            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
</div>
<!-- END wrapper --> 