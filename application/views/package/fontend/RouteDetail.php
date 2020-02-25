<?php //echo $detailRoute?>

<div class="row">
<!--
<div class="col-md-12" >
	 <h5 align="center"> Number of passengers 	Adult : <?php //echo $NAdult?> , Child : <?php //echo $NChild?> </h5><hr>
</div>
-->
<?php 
	//NAdult NChild
	$n=1; $adultTotal =0; $childTotal=0; 
	$TravelByArray=array('1'=>'Speedboat','2'=>'Van','3'=>'Car','4'=>'Ferry','5'=>'airplan');
	$txtTravelBy='';
	
	foreach($detailRoute->result() AS $data){ 
	$adultTotal=$adultTotal+($data->adultPrice*$NAdult);
	$childTotal=$childTotal+($data->ChildPrice*$NChild);
	if($partner_id=='1'){
		$checkINNPlace=$data->note_checkin_en;
		$partner_travel_by = $data->transport_name_en;
	}else if($partner_id=='2'){
		
		$checkINNPlace=strip_tags($data->partner_check_in_location);
    	$travelByDataArray = explode(",",$data->partner_travel_by);
									
		foreach ($travelByDataArray as $value)
										{
										    if($value!=''){
												$txtTravelBy = $txtTravelBy.$TravelByArray[$value].",";
											}
										}
	  $partner_travel_by=$txtTravelBy;
	}
	?>
	
<div class="col-md-12" > 
	  
	   <span class="badge" style="padding: 10px; background-color: #aa986b"> <?php echo $n?> </span>	
		&nbsp;&nbsp;	
	    From <span class="text-primary"><strong><?php echo $data->BeginPlace?></strong></span> Depart time : <?php echo $data->arrive_time?>

		&nbsp;
		To
		&nbsp;
	<span class="text-primary"><strong><?php echo $data->DestinationPlace?></strong></span> Arrive time : <?php echo $data->arrival_time_2?>

	<br>

	<label style="padding-left: 50px;" class="col-12 col-form-label"><strong>Transport :&nbsp;</strong></label>&nbsp;<?php echo $partner_travel_by?>
	
	<br>
	<label style="padding-left: 50px;" class="col-12 col-form-label"><strong>Check-in :&nbsp;</strong></label>&nbsp;<?php echo $checkINNPlace?>
	<br>
	<label style="padding-left: 50px;" class="col-12 col-form-label "><strong >Adult Price :&nbsp;</strong><span style="color: #d83f3f"><?php echo number_format($data->adultPrice)?> x <?php echo $NAdult?> = <?php echo number_format(($data->adultPrice*$NAdult))?></span> THB <br>
	<strong>Child Price :&nbsp;</strong> <span style="color: #d83f3f"><?php echo number_format($data->ChildPrice)?> x <?php echo $NChild?> = <?php echo number_format(($data->ChildPrice*$NChild))?> </span> THB</label>   
</div>
<?php $n++; }?>
<div class="col-12">
	&nbsp;<hr size="1">
	
</div>

<div class="col-md-12" style="padding-left: 10px;">
	<div class="col-md-6"><strong>Total Adult Price : <span style="color: #d83f3f"><?php echo number_format($adultTotal)?>  </span>THB</strong></div>
	<div class="col-md-6"><strong>Total Child Price : <span style="color: #d83f3f"><?php echo number_format($childTotal)?>  </span>THB</strong></div>

	</div>	
</div>	