<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
	<?php //$this->load->view('package/backend/side_menu'); //include('../package/backend/side_menu.php')?>

                   
	<div class="table-responsive">	
                                             <div class="container-fluid">
<div class="pull-right">
                                <!--<button type="button" class="btn btn-success btn-sm" onClick="window.location.href = '<?php //echo base_url('TransportCMS/AddRoute') ?>'"><i class="fa fa-plus"></i> import-spc route</button>-->
                            </div>
						<table class="table table-bordered table-hover" id="table2">
							<thead>	
								<tr style="background-color: #f2f2f2">
									<th width="5" style="text-align: center">No.</th>
									<th style="text-align: center">Route Name</th>
									<th style="text-align: center">Begin Place</th>
									<th style="text-align: center">Destination Place</th>
									<th style="text-align: center">Show / Hide</th>
									<!--<th style="text-align: center">#Edit</th>-->
									<th style="text-align: center">Delete</th>
								</tr>								
							</thead>
							<tbody>	
							<?php $n=1; $begin_place =''; $destination_place ='';
								  $numRoute = $listRoute->num_rows();
								echo '$numRoute>>'.$numRoute;
								  if($numRoute >0){
										foreach($listRoute->result() as $listRoute2){
											
												
								?>	
								<tr>
									<td style="text-align: center"><?php echo $n?></td>
									<td><?php echo $listRoute2->route_name_en?></td>
									<td><?php echo $listRoute2->FromPlace?></td>
									<td><?php echo $listRoute2->ToPlace?>
									 [<?php echo $listRoute2->show_onweb?> ]
									</td>
									 <td align="center">
										
                                                <label>
                                                    <input id="ch<?php echo $listRoute2->id ?>"  type="checkbox" class="js-switch js-check-change" onClick="setShow_onWeb('<?php echo $listRoute2->id ?>', this.value, 'tbl_route_data')" value="<?php echo $listRoute2->show_onweb ?>"  <?php
                                                    if ($listRoute2->show_onweb == '1') {
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

                    </div> <!-- container -->


   

            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
</div>
 
<script>
	$('.sk-three-bounce').css('display','none');
</script>
<!-- END wrapper --> 