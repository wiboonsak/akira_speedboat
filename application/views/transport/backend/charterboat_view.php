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
                                    <h4 class="page-title">Charter Speed boat Manage</h4>
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
                                <button type="button" class="btn btn-success btn-sm" onClick="window.location.href = '<?php echo base_url('TransportCMS/AddCharter') ?>'"><i class="fa fa-plus"></i> Add Charter Speed boat</button>
                            </div>
						<table class="table table-bordered table-hover" id="table2">
							<thead>	
								<tr style="background-color: #f2f2f2">
									<th width="5" style="text-align: center">No.</th>
									<th style="text-align: center">Boat size</th>
									<th style="text-align: center">Boat Trip</th>
									
									<th style="text-align: center">Show / Hide</th>
									<th style="text-align: center">Edit</th>
									<th style="text-align: center">Delete</th>
								</tr>								
							</thead>
							<tbody>	
							<?php $n=1; foreach ($listcharter->result() AS $listcharter2){
  $list_boatData = $this->package_model->list_boatData($listcharter2->boat_sizeid);
  $list_boattripData = $this->package_model->list_boattripData($listcharter2->boattrip_id);  
  foreach ($list_boatData->result() AS $list_boatData2){}
  foreach ($list_boattripData->result() AS $list_boattripData2){}
                                                            
                                                            
                                                            ?>	
								<tr>
									<td style="text-align: center"><?php echo $n?></td>
									<td style="text-align: center"><?php echo $list_boatData2->boat_size?></td>
									<td style="text-align: center"><?php echo $list_boattripData2->boat_trip?></td>
									
									 <td align="center">
                                                <label>
                                                    <input id="ch<?php echo $listcharter2->id ?>"  type="checkbox" class="js-switch js-check-change" onClick="setShow_onWeb('<?php echo $listcharter2->id ?>', this.value, 'tbl_charter_boat')" value="<?php echo $listcharter2->data_status ?>"  <?php
                                                    if ($listcharter2->data_status == '1') {
                                                        echo 'checked';
                                                    }?> data-plugin="switchery" data-color="#007bff" data-size="small"  /></label>
                                            </td>
									<td style="text-align: center"><a href="<?php echo base_url('TransportCMS/AddCharter/').$listcharter2->id;?>"><button type="button" class="btn btn-success btn-sm"><i class="icon-pencil"></i></button></a></td>
									<td style="text-align: center"><button type="button" class="btn btn-danger btn-sm" onClick="delete_data('<?php echo $listcharter2->id?>', 'tbl_charter_boat')"><i class="icon-trash"></i></button></td>
								  
							  </tr>	
                                                        <?php $n++;}?>
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