


<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
<style>
	.xx2{
		float: right !important;
	}
</style>
  <!-- Spinkit css -->
 <link href="<?php echo base_url('assets/plugins/spinkit/spinkit.css')?>" rel="stylesheet" />

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
                                    <h4 class="page-title">SPC-Thailand.com</h4>
                                    <br>
									<!--<button type="button" class="btn btn-info btn-sm" onClick="getLocation()">import-Location</button>-->
                               </div>
								<div class="row">
								<div class="col-md-12">
									<button type="button" class="btn btn-primary btn-sm"  onClick="window.location.href='<?php echo base_url('Partnercontrol/spc')?>'"><i class="fa icon-location-pin"></i> SPC Route List</button>
									
									<button type="button" class="btn btn-info btn-sm"  onClick="getLocation()"><i class="fa icon-location-pin"></i> get-Location List</button>
									
									<button type="button" class="btn btn-success btn-sm"  onClick="getRoute()"><i class="fa fi-location"></i> get-Route List</button>
									<div class="sk-three-bounce"  style="display:none"><!--style="display: none"-->
											<div class="sk-child sk-bounce1"></div>
											<div class="sk-child sk-bounce2"></div>
											<div class="sk-child sk-bounce3"></div>
									</div>
								</div>	
									
								
									
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
					
				

				
				<h3 id="pageTitle">Location List</h3>
				<div id="showData">
					<table class="table table-bordered table-hover" id="table2">
							<thead>	
								<tr style="background-color: #f2f2f2">
									<th width="5" style="text-align: center">No.</th>
									<th style="text-align: center">Route Name</th>
									<th style="text-align: center">Begin Place</th>
									<th style="text-align: center">Destination Place</th>
									<th style="text-align: center">Adult Price</th>
									<th style="text-align: center">Adult price net</th>
									<th style="text-align: center">Child price</th>
									<th style="text-align: center">Child price net</th>
									<th style="text-align: center">Show / Hide</th>
									<!--<th style="text-align: center">#Edit</th>-->
									<th style="text-align: center">Delete</th>
								</tr>								
							</thead>
							<tbody>	
							<?php $n=1; $begin_place =''; $destination_place ='';
								  $numRoute = $listRoute->num_rows();
								  echo 'Total Route : '.$numRoute;
								  if($numRoute >0){
										foreach($listRoute->result() as $listRoute2){
											if(($listRoute2->transfer_h_time!=0)&&($listRoute2->transfer_h_time!='')){
												$listRoute2->transfer_h_time = $listRoute2->transfer_h_time." Hr.";
											}else{
												$listRoute2->transfer_h_time='';
											}
											
											if(($listRoute2->transfer_m_time!=0)&&($listRoute2->transfer_m_time!='')){
												$listRoute2->transfer_m_time = $listRoute2->transfer_m_time." Min.";
											}else{
												$listRoute2->transfer_m_time='';
											}
												
								?>	
								<tr>
									<td style="text-align: center"><?php echo $n?></td>
									<td><span class="text-primary"><strong><?php echo $listRoute2->route_name_en?></strong></span>
										<?php echo '<br><strong>DepartTime:</strong> '.$listRoute2->DepartTime." <strong>ArriveTime:</strong> ".$listRoute2->ArriveTime?>
									    <?php echo '<br><strong>Duration:</strong>'.$listRoute2->transfer_h_time." ".$listRoute2->transfer_m_time?>
										
									
									
									</td>
									<td><?php echo $listRoute2->FromPlace?></td>
									<td><?php echo $listRoute2->ToPlace?></td>
									
									<td align="right"><?php echo number_format($listRoute2->price,2)?></td>
									<td align="right"><?php echo number_format($listRoute2->discount_price,2)?></td>
									<td align="right"><?php echo number_format($listRoute2->price_children,2)?></td>
									<td align="right"><?php echo number_format($listRoute2->discount_chilg_price,2)?></td>
								
									 <td align="center">
                                                <label>
                                                    <input id="ch<?php echo $listRoute2->id ?>"  type="checkbox" class="js-switch js-check-change" onClick="setShow_onWeb('<?php echo $listRoute2->id ?>', this.value, 'tbl_route_data')" value="<?php echo $listRoute2->rout_active ?>"  <?php
                                                    if ($listRoute2->rout_active == '1') {
                                                        echo 'checked';
                                                    }?> data-plugin="switchery" data-color="#007bff" data-size="small"  /></label>
                                            </td>
									<!--<td style="text-align: center"><a href="<?php //echo base_url('TransportCMS/editRoute/').$listRoute2->id;?>">#
									    <button type="button" class="btn btn-success btn-sm"><i class="icon-pencil"></i></button></a></td>-->
									<td style="text-align: center"><button type="button" class="btn btn-danger btn-sm" onClick="delete_data('<?php echo $listRoute2->id?>', 'tbl_route_data')"><i class="icon-trash"></i></button></td>
								  
							  </tr>	
						<?php $n++; }  } ?>		
						</tbody>	
						</table>	
						
						
				</div>
		
				</div>
						
				</div>
                    

						
						
						
						
	
						
                    
 </div> <!-- container -->
