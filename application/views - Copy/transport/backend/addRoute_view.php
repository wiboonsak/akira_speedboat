<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
<style>
	.xx2{
		float: right !important;
	}
</style>
<?php $this->load->view('package/backend/side_menu'); ?>
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
                                    <h4 class="page-title">Add / Edit Route</h4>
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
					
					<input type="hidden" id="arr_transport" name="arr_transport" >
						
						<ul class="nav nav-tabs">                            
                            <li class="nav-item">
                                <a href="#profile" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                   <i class="fa fa-file-text-o"></i> Route Data
                                </a>
                            </li>							
														
							<?php if($dataID !=''){ ?>
							<li class="nav-item">
                                <a href="#route" data-toggle="tab" aria-expanded="false" class="nav-link">
                                   <i class="mdi mdi-account-settings-variant "></i> Transport for Route
                                </a>
                            </li>
							<!--<li class="nav-item" id="n33" style="display: none">
                                <a href="#route2" data-toggle="tab" aria-expanded="false" class="nav-link">
                                   <i class="mdi mdi-account-settings-variant "></i> Transport for Route
                                </a>
                            </li> -->                          
							<?php } ?>
                       </ul>		
						
						
						<div class="tab-content">
                        <div class="tab-pane show active" id="profile">
						<?php if($dataID !=''){
								foreach($listRoute->result() as $listRoute2){}
						
						}  ?>						
						
						<form id="frm1" role="form" method="post" action="" enctype="multipart/form-data">
							
							<div class="form-group row">
                              <label class="col-md-3 col-sm-12 col-form-label" for="route_name_en">Route Name</label>
                              <div class="col-md-9 col-sm-12">
                                  <input type="text" id="route_name_en" name="route_name_en" class="form-control" value="<?php if($dataID !=''){ echo $listRoute2->route_name_en;}?>" >
                              </div>
                            </div>
							
							<div class="form-group row">
                               <label class="col-md-3 col-sm-12 col-form-label" for="begin_place_id">Begin Place</label>
                               <div class="col-md-9 col-sm-12">
                                  <select class="form-control" id="begin_place_id" name="begin_place_id">
                                     <option value="">-- Select --</option>
                                     <option value="1" <?php if(($dataID !='') && ($listRoute2->begin_place_id == '1')){ echo "selected"; }?> >Lipe</option>
                                     <option value="2" <?php if(($dataID !='') && ($listRoute2->begin_place_id == '2')){ echo "selected"; }?> >Hatyai</option>
                                     <option value="3" <?php if(($dataID !='') && ($listRoute2->begin_place_id == '3')){ echo "selected"; }?> >Surat Thani Airport</option>
                                     <option value="4" <?php if(($dataID !='') && ($listRoute2->begin_place_id == '4')){ echo "selected"; }?> >Koh Samui</option>
										   <!--<option value="1" <?php //if(($commentNum >0) && ($comment2->result_status == '1')){ echo "selected";  } ?>>Accepted</option>
                                           <option value="2" <?php //if(($commentNum >0) && ($comment2->result_status == '2')){ echo "selected";  } ?>>Minor Revision</option>
                                           <option value="3" <?php //if(($commentNum >0) && ($comment2->result_status == '3')){ echo "selected";  } ?>>Major Revision</option>
                                           <option value="4" <?php //if(($commentNum >0) && ($comment2->result_status == '4')){ echo "selected";  } ?>>Rejected</option>-->
                                 </select>
                               </div>
                            </div>
							
							<div class="form-group row">
                               <label class="col-md-3 col-sm-12 col-form-label" for="destination_place_id">Destination Place</label>
                               <div class="col-md-9 col-sm-12" id="div_destination">
                                  <select class="form-control" id="destination_place_id" name="destination_place_id">
                                     <option value="">-- Select --</option>
                                     <option value="1" <?php if(($dataID !='') && ($listRoute2->destination_place_id == '1')){ echo "selected"; }?> >Lipe</option>
                                     <option value="2" <?php if(($dataID !='') && ($listRoute2->destination_place_id == '2')){ echo "selected"; }?> >Hatyai</option>
                                     <option value="3" <?php if(($dataID !='') && ($listRoute2->destination_place_id == '3')){ echo "selected"; }?> >Surat Thani Airport</option>
                                     <option value="4" <?php if(($dataID !='') && ($listRoute2->destination_place_id == '4')){ echo "selected"; }?> >Koh Samui</option>
										   <!--<option value="1" <?php //if(($commentNum >0) && ($comment2->result_status == '1')){ echo "selected";  } ?>>Accepted</option>
                                           <option value="2" <?php //if(($commentNum >0) && ($comment2->result_status == '2')){ echo "selected";  } ?>>Minor Revision</option>
                                           <option value="3" <?php //if(($commentNum >0) && ($comment2->result_status == '3')){ echo "selected";  } ?>>Major Revision</option>
                                           <option value="4" <?php //if(($commentNum >0) && ($comment2->result_status == '4')){ echo "selected";  } ?>>Rejected</option>-->
                                 </select>
                               </div>
                           </div>
							
						   <div class="form-group row">
                                <label class="col-md-3 col-sm-12 col-form-label">Route Image</label>
								<div class="col-md-9 col-sm-12">
									<div class="fileupload <?php  if(($dataID !='') && ($listRoute2->route_image !='')){ echo 'fileupload-exists'; } else { echo 'fileupload-new'; }?>" data-provides="fileupload">
									<?php if($dataID ==''){ ?>	
												
										<div class="fileupload-new thumbnail" style="width: 225px; height: 150px;" id="upload_new">
											<img src="<?php echo base_url('assets/images/picture-not-available.jpg')?>" alt="image" />
										</div>
												
										<div class="fileupload-preview fileupload-exists thumbnail" id="upload_preview" style="max-width: 225px; max-height: 150px; line-height: 20px;"></div>
									<?php } ?>	
											
									<?php if($dataID !=''){ ?>	
												
										<div class="fileupload-new thumbnail" style="width: 225px; height: 150px;" id="upload_new">
											<?php //if($news_data2->route_image ==''){ ?>	
											<img src="<?php echo base_url('assets/images/picture-not-available.jpg')?>" alt="image" />
											<?php //} ?>	
										</div>
												
										<div class="fileupload-preview fileupload-exists thumbnail" id="upload_preview" style="max-width: 225px; max-height: 150px; line-height: 20px;">
										<?php if($listRoute2->route_image !=''){ ?>	
											<!--<a href="javascript:void(0)"  target="_blank" >--><img src="<?php echo base_url().'uploadfile/'.$listRoute2->route_image?>" alt="image" width="225" height="150" onClick="window.open('<?php echo base_url().'uploadfile/'.$listRoute2->route_image?>','_blank'); location.reload();" /><!--</a>-->
										<?php } ?>	
										</div>
									<?php } ?>	
												
									<div>
										<button type="button" class="btn btn-custom btn-file">
										<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
										<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
										<input type="file" class="btn-light" id="route_image" name="route_image" value="" />
										</button>
									<?php  if(($dataID !='') && ($listRoute2->route_image !='')){ ?>
										<a href="javascript:void(0)" class="btn btn-danger fileupload-exists" onClick="removeFile('<?php echo $dataID?>' , '<?php echo $listRoute2->route_image?>' , 'รูปภาพ' , 'tbl_news_data' , 'route_image')" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
										
									<?php } else { ?>
										<a href="javascript:void(0)" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
									<?php } ?>
									</div>
									</div>
											
									<input type="hidden" name="old_pic" id="old_pic" value="<?php if($dataID !=''){ echo $listRoute2->route_image;}?>" >								<small class="text-danger">(รองรับไฟล์รูปภาพนามสกุล jpg, gif, png  ขนาดไฟล์ไม่ควรเกิน 2MB ขนาดรูปภาพ (กว้างxสูง) 670 x 300 พิกเซล)</small>
								</div>	
                           </div>							
							
						   <br>
						   <div class="form-group row" >
                              <div class="col-12" style="text-align: center">
                                 <button type="button" class="btn btn-primary" onClick="addRoute()" >Add / Edit Data</button>
                              </div>
							  <input type="hidden" id="dataID" name="dataID" value="<?php if($dataID !=''){ echo $dataID;}?>" > 
                           </div>						
							
					</form>	
						
				</div>
				
				<?php if($dataID !=''){	?>		
				<div class="tab-pane" id="route">	
					
					
					<div class="form-group row">
                        <label class="col-md-3 col-sm-12 col-form-label">Travel Time</label>
                        <div class="col-md-4 col-sm-12">						
							
                            <select class="form-control" id="transfer_h_time" name="transfer_h_time">
                               <option value="">-- Hour --</option>
							<?php for($a=1; $a<=24; $a++){ 
								
									if($a < 10){  $txt = '0';  } else { $txt =''; }
							?>								
								<option value="<?php echo $txt.$a?>"  ><?php echo $txt.$a?></option>	
							<?php }	?>
							</select><?php //if(($dataID !='') && ($listRoute2->begin_place_id == '1')){ echo "selected"; }?>
                       </div>
						
					   <div class="col-md-4 col-sm-12">							
							
                            <select class="form-control" id="transfer_m_time" name="transfer_m_time">
                               <option value="">-- Minute --</option>
							<?php for($x=0; $x<=59; $x++){ 
								
									if($x < 10){  $txt = '0';  } else { $txt =''; }
							?>								
								<option value="<?php echo $txt.$x?>"  ><?php echo $txt.$x?></option>
	
							<?php }	?><?php //if(($dataID !='') && ($listRoute2->begin_place_id == '1')){ echo "selected"; }?>
							</select>
                       </div>						
                   </div>					
					
				   <div class="form-group row">	
				   		<label class="col-md-3 col-sm-12 col-form-label">Transport for Route</label>
                   		<div class="col-md-9 col-sm-12 row">	
						
				<?php if($dataID !=''){  $bb ='';
						foreach($listTransport->result() as $listTransport2){ ?>				
					
							<div class="col-md-3 col-6 checkbox checkbox-success checkbox-circle">
                       			<input type="checkbox" id="transport<?php echo $listTransport2->id?>" name="transport[]" class="checkboxName" value="<?php echo $listTransport2->id?>" <?php echo $bb?> onClick="select_transport('<?php echo $listTransport2->id?>' , '<?php echo $listTransport2->transport_name_en?>' , '<?php echo $dataID?>' , this.checked)">
                       			<label for="transport<?php echo $listTransport2->id?>"><?php echo $listTransport2->transport_name_en?></label>
                    		</div>
						
				<?php } } ?>										
							<br>
							<div class="col-12 alert alert-info row" style="color:#000000; background-color: #FFFFFF; display: none;" id="divSelectTransport" ><button type="button" class="btn btn-primary" onclick="add_routeType()" style="float: right;">Add</button></div>					
				    	</div>				    	
				   </div>
				   
				   
				   <div class="form-group row">
						<div class="accordion m-b-30 col-12" id="accordionExample" style="display: none">
                        </div>
				   </div>
				   
				   
				   
				</div>
							
							
				<div class="tab-pane" id="route2" style="display: none"></div>			
							
							
					<?php /* ?>		
							
							<div class="tab-pane" id="route2" style="display: none">	
					
					
					<div class="form-group row">
                        <label class="col-md-3 col-sm-12 col-form-label">Travel Time2</label>
                        <div class="col-md-4 col-sm-12">						
							
                            <select class="form-control" id="transfer_h_time" name="transfer_h_time">
                               <option value="">-- Hour --</option>
							<?php for($a=1; $a<=24; $a++){ 
								
									if($a < 10){  $txt = '0';  } else { $txt =''; }
							?>								
								<option value="<?php echo $txt.$a?>"  ><?php echo $txt.$a?></option>	
							<?php }	?>
							</select><?php //if(($dataID !='') && ($listRoute2->begin_place_id == '1')){ echo "selected"; }?>
                       </div>
						
					   <div class="col-md-4 col-sm-12">							
							
                            <select class="form-control" id="transfer_m_time" name="transfer_m_time">
                               <option value="">-- Minute --</option>
							<?php for($x=0; $x<=59; $x++){ 
								
									if($x < 10){  $txt = '0';  } else { $txt =''; }
							?>								
								<option value="<?php echo $txt.$x?>"  ><?php echo $txt.$x?></option>
	
							<?php }	?><?php //if(($dataID !='') && ($listRoute2->begin_place_id == '1')){ echo "selected"; }?>
							</select>
                       </div>						
                   </div>					
					
				   <div class="form-group row">	
				   		<label class="col-md-3 col-sm-12 col-form-label">Transport for Route</label>
                   		<div class="col-md-9 col-sm-12 row">	
						
				<?php if($dataID !=''){  $bb ='';
						foreach($listTransport->result() as $listTransport2){ ?>				
					
							<div class="col-md-3 col-6 checkbox checkbox-success checkbox-circle">
                       			<input type="checkbox" id="transport<?php echo $listTransport2->id?>" name="transport[]" class="checkboxName" value="<?php echo $listTransport2->id?>" <?php echo $bb?> onClick="select_transport('<?php echo $listTransport2->id?>' , '<?php echo $listTransport2->transport_name_en?>' , '<?php echo $dataID?>' , this.checked)">
                       			<label for="transport<?php echo $listTransport2->id?>"><?php echo $listTransport2->transport_name_en?></label>
                    		</div>
						
				<?php } } ?>										
							<br>
							<div class="col-12 alert alert-info row" style="color:#000000; background-color: #FFFFFF; display: none;" id="divSelectTransport" ><button type="button" class="btn btn-primary" onclick="add_routeType()" style="float: right;">Add</button></div>					
				    	</div>				    	
				   </div>
				   
				   
				   <div class="form-group row">
						<div class="accordion m-b-30 col-12" id="accordionExample33" style="display: none">
                        </div>
				   </div>
				   
				   
				   
				</div>
							
					
				<?php */ } ?>			
							
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
						
						
						
						
						
			<?php /* ?>	<div id="modal_Large33" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                 <h4 class="modal-title" id="myModalLabel">Add / Edit Deatail</h4>
             </div>
             <div class="modal-body">
				 
				 
			 <form id="frmTime" role="form" method="post" action="" enctype="multipart/form-data">			 
				 
				<div class="form-group row">					
                    <label class="col-md-3 col-sm-12 col-form-label">Begin Place</label>
                    <label class="col-md-9 col-sm-12 col-form-label">Lipe</label>	
                </div>
					
				<div class="form-group row"> 
					<label class="col-md-3 col-sm-12 col-form-label">Destination Place</label>
                    <div class="col-md-9">
                        <select class="form-control" id="begin_place_id" name="begin_place_id">
                            <option value="">-- Select --</option>
                            <option value="1" <?php if(($dataID !='') && ($listRoute2->begin_place_id == '1')){ echo "selected"; }?> >Lipe</option>
                            <option value="2" <?php if(($dataID !='') && ($listRoute2->begin_place_id == '2')){ echo "selected"; }?> >Hatyai</option>
                            <option value="3" <?php if(($dataID !='') && ($listRoute2->begin_place_id == '3')){ echo "selected"; }?> >Surat Thani Airport</option>
                            <option value="4" <?php if(($dataID !='') && ($listRoute2->begin_place_id == '4')){ echo "selected"; }?> >Koh Samui</option>
										   <!--<option value="1" <?php //if(($commentNum >0) && ($comment2->result_status == '1')){ echo "selected";  } ?>>Accepted</option>
                                           <option value="2" <?php //if(($commentNum >0) && ($comment2->result_status == '2')){ echo "selected";  } ?>>Minor Revision</option>
                                           <option value="3" <?php //if(($commentNum >0) && ($comment2->result_status == '3')){ echo "selected";  } ?>>Major Revision</option>
                                           <option value="4" <?php //if(($commentNum >0) && ($comment2->result_status == '4')){ echo "selected";  } ?>>Rejected</option>-->
                        </select>
                    </div>
                </div>
				 
				<div class="form-group row">
				 	<label class="col-md-3 col-sm-12 col-form-label">Transport</label>				 
				 	<label class="col-md-9 col-sm-12 col-form-label">Speed Boat</label>				 
				</div> 
				 
				<div class="form-group row">
				 	<label class="col-md-3 col-sm-12 col-form-label">Arrive Time</label>				 
				 	<label class="col-md-9 col-sm-12 col-form-label">09:30</label>					 
				</div> 
				 
				<div class="form-group row">
				 	<label class="col-md-3 col-sm-12 col-form-label">Depart Time</label>
                    <div class="col-md-9">
                        <input type="time" name="arrive_timeX" class="form-control" >
                    </div>					
				</div> 
				 
				<div class="form-group row"> 
					<label class="col-md-3 col-sm-12 col-form-label">Check-in Place</label>
                    <div class="col-md-9">
                        <textarea class="form-control" rows="5"></textarea>
                    </div>
                </div>  
					
				<div class="form-group row">
				 	<label class="col-md-3 col-sm-12 col-form-label">Adult Price</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" >
                    </div>&nbsp;Baht					
				</div>
				 
				<div class="form-group row">
				 	<label class="col-md-3 col-sm-12 col-form-label">Child Price</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" >
                    </div>&nbsp;Baht					
				</div>                
			 
				 <br><div class="col-12" style="text-align: center;">
				 	 <button type="button" class="btn btn-success btn-sm">Submit</button> 	
				 </div>
				 
				 </form>
			 
			 
			 
			 
			 
			 </div>
                 
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
</div><?php */ ?>
						
                    

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