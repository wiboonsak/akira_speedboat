<?php foreach($bookingData->result() AS $data){}
	  if(isset($data->id)){
		    $cust_name=$data->cust_name;
			$cust_lastname=$data->cust_lastname;
			$cust_email=$data->cust_email;
			$cust_telephone_num=$data->cust_telephone_num;
			$line_id=$data->line_id;
	  }else{
		   $cust_name='';
		   $cust_lastname='';
		   $cust_email='';
		   $cust_telephone_num='';
		   $line_id='';
	  }

?>
<div class=" bg-white total-trip clearfix" >
                    <div class="row">
<!-- Payment Room -->
                    <div class="payment-room">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="payment-info">
                                    <h2>AKIRA SPEEDBOAT</h2>
                                   
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                
                            </div>
                        </div>
                    </div>
                    <!-- Payment Room -->

                    <div class="payment-form">
                        <div class="row form">
						  <div class="col-md-6">
                                <h2>BOOKING SUMMARY</h2>
                             
                                   <div class="row">
                                        <div class="form-search clearfix">
                                            <div class="col-md-12 td-airline" style="padding-top: 15px;" >
                                               
												<table class="table" width="100%">
													<tr>
														<td colspan="2" style="background-color:#E1E1E1">DEPART:</td>
													</tr>
													<tr>
														<td colspan="2"><strong><?php echo $departName?></strong>&nbsp;&nbsp;
												    <span style="color:red;font-size: 12px;" ><?php echo $dateGo?> </span>
														<span id="DepartTime"><?php echo $DepartTime?></span></td>
													</tr>
												
													<tr>
													  <td>Duration:</td>
													  <td align="right"> <?php echo $DepartDuration?></td>
													</tr>
													<tr>
														<td>Adult x <?php echo $NAdult?></td>
														<td align="right"><?php echo $DepartTotalAdult?></td> 
													</tr>
													<tr>
														<td>Children x <?php echo $NChild?></td>
														<td align="right"><?php echo $DepartTotalChildren?></td>
													</tr>
													<tr>
														<td>Total depart :</td>
														<td align="right">
														<?php echo $DepartTotalPrice?>
															
															
														</td>
													</tr> 
												</table>
											 <?php if($travelRound=='return'){ ?>	
										       <table class="table" width="100%">
													<tr>
														<td colspan="2" style="background-color:#E1E1E1">RETURN:</td>
													</tr>
													<tr>
														<td colspan="2">														
														<strong><?php echo $returnName?></strong>&nbsp;&nbsp;
												    <span style="color:red;font-size: 12px;" ><?php echo $backDate?> </span>
														<span id="DepartTime"><?php echo $ReturnDepartTime?>
														
														
														</td>
													</tr> 
													<tr>
													  <td>Duration:</td>
													  <td align="right"><?php echo $ReturnDuration?></td>
													</tr>
													<tr>
														<td>Adult x <?php echo $NAdult?></td>
														<td align="right"><?php echo $ReturnTotalAdult?></td> 
													</tr>
													<tr>
														<td>Children x <?php echo $NChild?></td>
														<td align="right"><?php echo $ReturnTotalChildren?>
														</td>
													</tr>
													<tr>
														<td>Total return :</td>
														<td align="right">
															 <?php echo $ReturnTotalPrice?>
														</td>
													</tr>
												</table>
                                             <?php }?> 
												<span id="totalPriceSpan"></span>
												<table class="table" width="100%">
													<tr  style="background-color:#E1E1E1">
														<td >TOTAL PRICE</td>
														<td  align="right" ><span id="AllTotalPrice" style="color: #a94442"><?php echo $AllTotalPrice?></span></td>
													</tr>
													
												</table>
								 		
                                           
									</div>
                                                                                   
                                           
                                        </div>
                                    </div>
                            </div>
                             <div class="col-md-6" id="rightSpace">
								<form id="confirmForm" name="confirmForm" method="post">
								
                                <h2>Your Information</h2>
								<!-- <div class="form-field">
                                    <select id="cust_prefix" name="cust_prefix" class="field-input">
									  	<option value="0">Please select Title</option>
										<option value="Mr.">Mr.</option>
										<option value="Miss.">Miss.</option>
										<option value="Mrs.">Mrs.</option>
									 </select>
                                </div>-->
									
									
									
                                <div class="form-field">
                                    <input type="text" id="cust_name" name="cust_name" placeholder="First Name" class="field-input" value="<?php echo $cust_name?>">
                                </div>
                                <div class="form-field">
                                    <input type="text" id="cust_lastname" name="cust_lastname" placeholder="Last Name" class="field-input"  value="<?php echo $cust_lastname?>">
                                </div>
                                <div class="form-field">
                                    <input type="text" id="cust_email" name="cust_email" placeholder="Email" class="field-input" value="<?php echo $cust_email?>">
                                </div>
                               
                                <div class="form-field">
                                    <input type="text" id="cust_telephone_num" name="cust_telephone_num" placeholder="Phone number" class="field-input"  value="<?php echo $cust_telephone_num?>">
                                </div>
                                <div class="form-field">
                                    <input type="text" id="line_id" name="line_id" placeholder="Line ID" class="field-input"  value="<?php echo $line_id?>">
                                </div>
             
                         
                            	<input type="hidden" id="NAdult" name="NAdult" value="<?php echo $NAdult?>">
                            	<input type="hidden" id="NChild" name="NChild" value="<?php echo $NChild?>">
                            	<input type="hidden" id="travelRound" name="travelRound" value="<?php echo $travelRound?>">
                            	<input type="hidden" id="TimeIDGo" name="TimeIDGo" value="<?php echo $TimeIDGo?>">
                            	<input type="hidden" id="DTotalPrice" name="DTotalPrice" value="<?php echo $DTotalPrice?>">
                            	<input type="hidden" id="DAdultPrice" name="DAdultPrice" value="<?php echo $DAdultPrice?>">
                            	<input type="hidden" id="DChildPrice" name="DChildPrice" value="<?php echo $DChildPrice?>">
                            	<input type="hidden" id="TimeIDBack" name="TimeIDBack" value="<?php echo $TimeIDBack?>">
                            	<input type="hidden" id="RTotalPrice" name="RTotalPrice" value="<?php echo $RTotalPrice?>">
                            	<input type="hidden" id="RAdultPrice" name="RAdultPrice" value="<?php echo $RAdultPrice?>">
                            	<input type="hidden" id="RChildPrice" name="RChildPrice" value="<?php echo $RChildPrice?>">
                            									
								
								<input type="hidden" id="departName" name="departName" value="<?php echo $departName?>">
								<input type="hidden" id="dateGo" name="dateGo" value="<?php echo $dateGo?>">
								<input type="hidden" id="DepartTime" name="DepartTime" value="<?php echo $DepartTime?>">
								<input type="hidden" id="DepartDuration" name="DepartDuration" value="<?php echo $DepartDuration?>">
								<input type="hidden" id="DepartTotalAdult" name="DepartTotalAdult" value="<?php echo $DepartTotalAdult?>">
								<input type="hidden" id="DepartTotalChildren" name="DepartTotalChildren" value="<?php echo $DepartTotalChildren?>">
								
								<input type="hidden" id="returnName" name="returnName" value="<?php echo $returnName?>">
								<input type="hidden" id="backDate" name="backDate" value="<?php echo $backDate?>">
								<input type="hidden" id="ReturnDepartTime" name="ReturnDepartTime" value="<?php echo $ReturnDepartTime?>">
								<input type="hidden" id="ReturnDuration" name="ReturnDuration" value="<?php echo $ReturnDuration?>">
								<input type="hidden" id="ReturnTotalAdult" name="ReturnTotalAdult" value="<?php echo $ReturnTotalAdult?>">
								<input type="hidden" id="ReturnTotalChildren" name="ReturnTotalChildren" value="<?php echo $ReturnTotalChildren?>">
			
                            </form>
							 <div class="radio-checkbox">
                                    <input type="checkbox" class="checkbox" id="accept" onChange="enableBooking(this.checked)">
                                    <label for="accept">I accept the Terms and Coditions.</label>
                             </div>
                           			<button id="btnBooknow" class="awe-btn awe-btn-lager" onClick="booknow()" disabled>Book now</button>
						   </div>
                        </div>

                        <div class="submit text-center">
                          

                        </div>
						
                    </div>
		<!----------------->
						<div>&nbsp;</div>
       </div>

                    </div>