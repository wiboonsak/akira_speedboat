<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
	<?php //$this->load->view('package/backend/side_menu'); //include('../package/backend/side_menu.php')?>
            
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
                                    <h4 class="page-title">Route Manage</h4>
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
<hr>
                <!-- Start Page content -->
                <div class="content">
                   
					<div class="card-box table-responsive">	
                                             <div class="container-fluid">
<div class="pull-right">
                                <button type="button" class="btn btn-success btn-sm" onClick="window.location.href = '<?php echo base_url('TransportCMS/AddRoute') ?>'"><i class="fa fa-plus"></i> Add Route</button>
                            </div>
						<table class="table table-bordered table-hover" id="table2">
							<thead>	
								<tr style="background-color: #f2f2f2">
									<th width="5" style="text-align: center">No.</th>
									<th style="text-align: center">Route Name</th>
									<th style="text-align: center">Begin Place</th>
									<th style="text-align: center">Destination Place</th>
									<th style="text-align: center">Show / Hide</th>
									<th style="text-align: center">Edit</th>
									<th style="text-align: center">Delete</th>
								</tr>								
							</thead>
							<tbody>	
							<?php $n=1; $begin_place =''; $destination_place ='';
								  $numRoute = $listRoute->num_rows();
								  if($numRoute >0){
										foreach($listRoute->result() as $listRoute2){
											
										$place = $this->package_model->list_placeData($listRoute2->begin_place_id);
										foreach($place->result() as $place2){}
										$begin_place = $place2->place_name_en;	
											
										$place3 = $this->package_model->list_placeData($listRoute2->destination_place_id);
										foreach($place3->result() as $place4){}	
										$destination_place = $place4->place_name_en; 					
								?>	
								<tr>
									<td style="text-align: center"><?php echo $n?></td>
									<td><?php echo $listRoute2->route_name_en?></td>
									<td><?php echo $begin_place?></td>
									<td><?php echo $destination_place?></td>
									 <td align="center">
                                                <label>
                                                    <input id="ch<?php echo $listRoute2->id ?>"  type="checkbox" class="js-switch js-check-change" onClick="setShow_onWeb('<?php echo $listRoute2->id ?>', this.value, 'tbl_route_data')" value="<?php echo $listRoute2->show_onweb ?>"  <?php
                                                    if ($listRoute2->show_onweb == '1') {
                                                        echo 'checked';
                                                    }?> data-plugin="switchery" data-color="#007bff" data-size="small"  /></label>
                                            </td>
									<td style="text-align: center"><a href="<?php echo base_url('TransportCMS/editRoute/').$listRoute2->id;?>"><button type="button" class="btn btn-success btn-sm"><i class="icon-pencil"></i></button></a></td>
									<td style="text-align: center"><button type="button" class="btn btn-danger btn-sm" onClick="delete_data('<?php echo $listRoute2->id?>', 'tbl_route_data')"><i class="icon-trash"></i></button></td>
								  
							  </tr>	
						<?php $n++; }  } ?>		
						</tbody>	
						</table>
						
					</div>

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