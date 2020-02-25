   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<section class="flight-list" style="margin-top: -20px;">

                                <!-- Flight List Head -->
                                <div class="flight-list-head"> 
      
                                    <h3><?php echo $WAYTO?> : <?php echo $location1?> - <?php echo $location2?></h3>
                                    <br><i class="far fa-calendar-alt"></i><span style="color: orangered"> <?php echo $DateTravel?></span>
											
                                </div>
                                <!-- Flight List Head -->

                                <!-- Flight List Table -->
                                <div class="flight-list-cn">
                                    <div class="responsive-table ">
                                       
										<table class="table flight-table table-radio">
                                            <thead>
                                                <tr>
                                                    <th style="padding-left: 10px;">Select</th>
                                                    <th class="text-center">Departure</th>
                                                    <th class="text-center">Arrival</th>
                                                    <th class="text-center">Duration</th>
                                                    <th class="text-center">Adult</th>
                                                    <th class="text-center">Child</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              
							<?php  
							
							$TXT_transfer_h_tim='';$TXT_transfer_m_time=''; $departTime=''; $timesArrive=''; $txtTravelBy='';
							$countRow=0;			
							foreach($travelGo->result() AS $data){ 
								
								$departTime = $data->arrive_time;
								$arriveTime = $data->arrival_time_2;
								
								
								
								if($data->partner_id=='2'){  /// partner spc 
									//  1:Speedboat, 2:Van, 3 : Car, 4: Ferry, 5:airplan 
									$TravelByArray=array('1'=>'Speedboat','2'=>'Van','3'=>'Car','4'=>'Ferry','5'=>'airplan');
									$travelByDataArray = explode(",",$data->partner_travel_by);
									
									foreach ($travelByDataArray as $value)
										{
										    if($value!=''){
												$txtTravelBy = $txtTravelBy.$TravelByArray[$value].",";
											}
										}
									
									   
									    $from_time = strtotime($departTime);
									    $to_time = strtotime($arriveTime);
										
										
									    $resultTime =  abs($to_time - $from_time)/3600;
									
									   //echo $departTime."->".$arriveTime;
									
									   $departTimeArray = explode(":",$departTime);
									   $arriveTimeArray = explode(":",$arriveTime);
									
									    $durationHr = abs((int)$departTimeArray[0]-(int)$arriveTimeArray[0]);
									    $durationMin = abs((int)$departTimeArray[1]-(int)$arriveTimeArray[1]);
									
									   //echo "duration->". $durationHr." : ".$durationMin;
									   
										   
									    if(($durationHr!='0')&&($durationMin!='0')){
											
												$txtDuration[$data->TimeTableID]=$durationHr." Hr. ".$durationMin." Min.";
										}else  if(($durationHr=='0')&&($durationMin!='0')){
												$txtDuration[$data->TimeTableID]= $durationMin." Min.";
										}else  if(($durationHr!='0')&&($durationMin=='0')){
												$txtDuration[$data->TimeTableID]= $durationHr." Hr.";
										}
									
								        $txtTravelBy = substr($txtTravelBy,0,-1);

									}else if($data->partner_id=='1'){
									
									    $travelData = $this->transport_model->getTreavelBy($data->RouteID,$data->TimeTableID,$data->route_type_id,$data->partner_id);
									    $txtTravelBy=$travelData['TravelBy'];
									    $txtDuration[$data->TimeTableID]=$travelData['TravelTime'];
									}
								
								
								   //---------get price------------------ AdultPrice AdultPriceDiscount ChilePrice ChilePriceDiscount
		 							$dataPrice = $this->transport_model->getRoutePrce($data->TimeTableID);
	
							?>
							<tr>
								<td class="td-airline ">
									<div class="radio-checkbox">
										<input type="checkbox" name="airline"  id="radio-air-<?php echo $data->TimeTableID?>" class="radio <?php echo $WAYTO?>" onClick="selectTimeTravel('<?php echo $data->TimeTableID?>' , ' <?php echo date('H:i',strtotime($departTime));?>-<?php echo date('H:i',strtotime($arriveTime));?>' , '<?php echo  $txtDuration[$data->TimeTableID]?>' , '<?php echo $dataPrice['AdultPrice']?>' , '<?php echo $dataPrice['ChilePrice']?>' , '<?php echo $WAYTO?>' , this.checked )">
										<label for="radio-air-<?php echo $data->TimeTableID?>"></label>
										&nbsp;
								 </div> 
									<span class="td-time">&nbsp;<strong><?php echo $txtTravelBy?></strong> </span>

									<div class="fa-pull-right">
										<a href="javascript:void(0)" onClick="showInfo('<?php echo $data->RouteID?>','<?php echo $data->TimeTableID?>','<?php echo date('H:i',strtotime($departTime));?>','<?php echo date('H:i',strtotime($arriveTime));?>','<?php echo $location1."-".$location2?>','<?php echo $data->partner_id?>')" title="info">
										<i class="fas fa-info-circle" style="color: skyblue"></i>
									</a>

									</div> 
								</td>	
								<td class="td-time text-center" >
									<p> <?php echo date('H:i',strtotime($departTime));  //echo $data->arrive_time ?></p>
								</td>
								<td class="td-time text-center">
									<p> <?php echo date('H:i',strtotime($arriveTime));?></p>
								</td>
								<td class="td-time text-center">

								<p><?php echo  $txtDuration[$data->TimeTableID]?></p>

								</td>
								<td class="td-price text-center">
									<span><ins><?php echo number_format($dataPrice['AdultPrice'])?></ins> ฿</span>
								</td>
								<td class="td-price text-center">
									<span><ins><?php echo number_format($dataPrice['ChilePrice'])?></ins> ฿</span>
                                                                 
								</td>
                                            
							</tr>
							  <?php $txtTravelBy=''; $countRow++; }?>
							  <?php if($countRow==0){ ?>
								<tr>
								   <td colspan="6">
									   <h3 align="center" style="color: red"><i class="fas fa-info-circle" ></i> No Data for <?php echo $location1?> - <?php echo $location2?></h3>
								   </td>
								</tr>
							 <?php }?>	
                                            </tbody>
                                        </table>
										
                                    </div>
                                </div>
                                <!-- End Flight List Table -->
</section>
				