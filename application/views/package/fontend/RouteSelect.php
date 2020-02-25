<?php 
 // print_r($travelGo);
//  echo "<br>";
//echo 'num_rows'.$travelGo->num_rows();
//echo $travelRound." dateGo->".$dateGo."  dateReturn->".$dateReturn?>
<style>

</style>
<div class="main-cn flight-page bg-white clearfix" id="BcHead">
                    <div class="row">

                        <!-- Flight Right -->
                        <div class="col-md-9 col-md-push-3">
                          <?php //echo date("H:i:s")?>
                            
                            <section class="breakcrumb-sc text-red">
                                <ul class="breadcrumb arrow">
                                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                                    <li><a href="#" title=""><?php echo $FromLocationName." >>".$ToLocationName?></a></li>
                                    
                                </ul>
                            </section>
							<div id="routeList">
                            <!------DEPART------------>
							<?php 	$WAYTO ="DEPART";
									$DateTravel = $dateGo;
	                                $location1 = $FromLocationName;
									$location2 = $ToLocationName;
									include('routeSelectList.php');?>
							<!-----### Return -------->
     						 <?php 
								   $WAYTO ="RETURN";
								   $DateTravel = $dateReturn;
								   $travelGo = $travelReturn;  
								   $location1 = $ToLocationName;
							       $location2 = $FromLocationName;
							      
							      if($travelRound=='return'){ include('routeSelectList.php'); }?>
							</div>
								<!-- Modal -->
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Modal title</h4>
									  </div>
									  <div class="modal-body">
										...
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										
									  </div>
									</div>
								  </div>
								</div>	
								<!-- Modal -->
                        </div>
                        <!-- End Flight Right -->

                        <!-- Sidebar -->
                        <div class="col-md-3 col-md-pull-9">
                            <!-- Sidebar Content -->
                            <div class="sidebar-cn">

                                <!-- Search Result -->
                                <div class="search-result">
                                    <p id="headSumary">BOOKING SUMMARY</p>
                                </div>
                                <!-- End Search Result -->
                                <!-- Search Form Sidebar -->
                                <div class="search-sidebar">
                                  
                                    <div class="row">
                                        <div class="form-search clearfix">
                                            <div class="col-md-12 td-airline" style="padding-top: 15px;" >
                                               
												<table class="table" width="100%">
													<tr>
														<td colspan="2" style="background-color:#E1E1E1">DEPART:</td>
													</tr>
													<tr>
														<td colspan="2"><strong><span id="departName"><?php echo $FromLocationName."-".$ToLocationName?></span></strong> <br>
												    <span style="color:red;font-size: 12px;" ><span id="dateGo"><?php echo $dateGo?></span>
														<span id="DepartTime"></span></td>
													</tr>
												
													<tr>
													  <td>Duration:</td>
													  <td align="right"><span id="DepartDuration"></span></td>
													</tr>
													<tr>
														<td>Adult x <?php echo $Adults?></td>
														<td align="right"><span id="DepartTotalAdult"></span></td> 
													</tr>
													<tr>
														<td>Children x <?php echo $Children?></td>
														<td align="right"><span id="DepartTotalChildren"></span></td>
													</tr>
													<tr>
														<td>Total depart :</td>
														<td align="right">
															<span id="DepartTotalPrice"></span>
															
															<input type="hidden" name="NAdult" id="NAdult" value="<?php echo $Adults?>">
															<input type="hidden" name="NChild" id="NChild" value="<?php echo $Children?>">
															
															
														    <input type="hidden" name="TimeIDGo" id="TimeIDGo">
															<input type="hidden" name="DTotalPrice" id="DTotalPrice"  value="0">
															<input type="hidden" name="DAdultPrice" id="DAdultPrice"  value="0">
															<input type="hidden" name="DChildPrice" id="DChildPrice"  value="0">
															
															
															
															
															<input type="hidden" name="travelRound" id="travelRound" value="<?php echo $travelRound?>">
														</td>
													</tr> 
												</table>
											 <?php if($travelRound=='return'){ ?>	
										       <table class="table" width="100%">
													<tr>
														<td colspan="2" style="background-color:#E1E1E1">RETURN:</td>
													</tr>
													<tr>
														<td colspan="2"><strong><span id="returnName"><?php echo $ToLocationName."-".$FromLocationName?></span></strong> <br>
												        <span style="color:red;font-size: 12px;" ><span id="backDate"><?php echo $dateReturn?></span> <span id="ReturnDepartTime"></span></td>
													</tr> 
													<tr>
													  <td>Duration:</td>
													  <td align="right"><span id="ReturnDuration"></span> </td>
													</tr> 
													<tr>
														<td>Adult x <?php echo $Adults?></td>
														<td align="right"><span id="ReturnTotalAdult"></span></td> 
													</tr>
													<tr>
														<td>Children x <?php echo $Children?></td>
														<td align="right"><span id="ReturnTotalChildren"></span></td>
													</tr>
													<tr>
														<td>Total return :</td>
														<td align="right">
															 <span id="ReturnTotalPrice"></span>
															
														</td>
													</tr>
												</table>
                                             <?php }?> 
												<table class="table" width="100%">
													<tr  style="background-color:#E1E1E1">
														<td >TOTAL PRICE</td>
														<td  align="right" ><span id="AllTotalPrice"></span></td>
													</tr>
	<input type="hidden" name="TimeIDBack" id="TimeIDBack">
															<input type="hidden" name="RTotalPrice" id="RTotalPrice" value="0">
															<input type="hidden" name="RAdultPrice" id="RAdultPrice" value="0"> 
															<input type="hidden" name="RChildPrice" id="RChildPrice" value="0">												
													<tr>
														<td colspan="2" align="center">
															<!--<button id="conBtn" type="button" class="btn btn-success btn-sm" onClick="doBooking()">CONTINUE</button>-->
															<button id="conBtn" type="button" class="btn btn-success btn-sm" onClick="goConfirm()">CONTINUE</button>
														</td>
													
													</tr>
												</table>
								 		
                                           
									</div>
                                                                                   
                                           
                                        </div>
                                    </div>
                                </div>
                                <!-- End Search Form Sidebar -->
                                <!-- Narrow your results -->
    

                            </div>
                            <!-- End Sidebar Content -->
                        </div>
                        <!-- End Sidebar -->

                        
                    </div>
				
                </div>


<!-- //Modal -->

<script>
	 $('#preloader2').css('display','none');
	
	 
	
</script>
