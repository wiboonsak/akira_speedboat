<!DOCTYPE html>
<!--[if IE 7 ]> <html class="ie ie7"> <![endif]-->
<!--[if IE 8 ]> <html class="ie ie8"> <![endif]-->
<!--[if IE 9 ]> <html class="ie ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="" lang="en">
<!--<![endif]-->

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>TRAVEL LIPE, BOOKING SPEEADBOAT, TRANSPORT, PACKAGE TOUR - MOONLIGHT LIPE - KOH LIPE, SATUN THAILAND</title>
<!-- Font Google -->
<!-- Font Google -->
<link href='http://fonts.googleapis.com/css?family=Lato:300,400%7COpen+Sans:300,400,600' rel='stylesheet' type='text/css'>
<!-- End Font Google -->
<!-- Library CSS -->
<link rel="stylesheet" href="<?php echo base_url('html/css/library/font-awesome.min.css')?>">
<link rel="stylesheet" href="<?php echo base_url('html/css/library/bootstrap.min.css')?>">
<link rel="stylesheet" href="<?php echo base_url('html/css/library/jquery-ui.min.css')?>">
<link rel="stylesheet" href="<?php echo base_url('html/css/library/owl.carousel.css')?>">
<link rel="stylesheet" href="<?php echo base_url('html/css/library/jquery.mb.YTPlayer.min.css')?>">
<!-- End Library CSS -->


<!------ Timeline ---------->
<link href="<?php echo base_url('html/css/bootstrap.min.css')?>" rel="stylesheet" id="bootstrap-css">
<script src="<?php echo base_url('html/js/jquery-1.11.1.min.js')?>"></script>
<!------ Timeline ---------->

<link rel="stylesheet" href="<?php echo base_url('html/css/style.css')?>">
<!-- End Library CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<style>
.modal-dialog {
left: 0;
}

body.modal-open {
padding-right: 0 !important;
margin-right: 0 !important;
}

.modal-open {
overflow: auto;
}
	
.clockdate-wrapper {
    /*background-color: #333;*/
    background-color:#7E0002;
    padding:0px;
    
    width:100%;
    text-align:center;
    border-radius:5px;
    margin:5 auto;
    margin-top:1%;
}
#clock{
    background-color:#930002;
    font-family: sans-serif;
    font-size:30px;
    text-shadow:0px 0px 1px #fff;
    color:#fff;
}
#clock span {
    color:#DCDCDC;
    text-shadow:0px 0px 1px #333;
    font-size:20px;
    position:relative;
    top:-10px;
    left:-3px;
}
#date {
    letter-spacing:10px;
    font-size:14px;
    font-family:arial,sans-serif;
    color:#fff;
}	
	
</style>
  
</head>

<body>
<!-- Preloader -->
<div id="preloader">
<div class="tb-cell">
<div id="page-loading">
<div></div>
<p>Loading</p>
</div>
</div>
</div>
<!-- Wrap -->
<div id="wrap">
<!-- Header -->
<?php include("header.php"); ?>
<!-- End Header -->


<!--Banner-->
<section class="sub-banner">
<!--Background-->
<div class="bg-parallax bg-1"></div>
<!--End Background-->
<!-- Logo -->
<div class="logo-banner text-center">
<a href="" title="">
<img src="<?php echo base_url('images/logo-header.png')?>" alt="">
</a>

</div>
<!-- Logo -->
</section>



<!-- Main -->
<div class="main">
<div class="container">
<div class="main-cn flight-page bg-white clearfix">
<div class="row">

<!-- Flight Right -->
<div class="col-md-9 col-md-push-3">

<!-- Flight List -->
<section class="flight-list">

<!-- Flight List Head DEPART : KOH LIPE - KOH MOOK (FEBRUARY 20, 2019)-->
<div class="flight-list-head" style="margin-top: 10px; padding: 10px !important">
<!--<span class="icon"><img src="images/icon-maker.png" alt=""></span> -->
<h3 style="font-size: 16px !important">
	<span style="color: red"> DEPART : </span>
	<i class="fa fa-ship" aria-hidden="true"></i>
	
	<?php echo $spanRoute?><i class="fa fa-arrow-right" aria-hidden="true"></i> <?php echo $spanTo?></h3>
<p><span style="font-size: 16px !important"><i class="fa fa-calendar-o"></i> <?php echo $this->Package_model->GetEngDateTimeshot($datedata);?>&nbsp;&nbsp;<i class="fa fa-users"></i> <?php echo $Total?> <?php if($Total >1){echo 'Travellers';}else{echo 'Traveller';}?></span>
</p>
</div>
<!-- Flight List Head -->

<div class="panel-group" id="accordion" style="padding-top: 20px;">
<?php $route_id = $this->transport_model->checkRoute($routedata,$placedata);
	echo 'route_id>>'.$route_id;
if($route_id!=0){
	$x=''; $n=1; $txt_routeType =''; $times1=''; $nRows=1;
	$Routetype = $this->transport_model->get_routeType($route_id,$x, '1', 'yes', 'key_group');
	foreach ($Routetype->result() as $Data){ 
	$countDetail = $this->transport_model->count_detailTimeTable($route_id,$Data->key_group);
	$countnum = $countDetail->num_rows();
	if($countnum >0){
	$routeType2 = $this->transport_model->get_routeType($route_id, $Data->key_group, '1', $x, 'id');		
	foreach($routeType2->result() as $routeType3){ 

	if($n == 1){ $txt = ''; } else { $txt = ' + '; }

	$listTransport = $this->transport_model->listTransport($x,$routeType3->transport_id);
	foreach($listTransport->result() as $listTransport2){}			
	$txt_routeType = $txt_routeType.$txt.$listTransport2->transport_name_en;

$n++; }

?>


	<?php   $times = $this->transport_model->get_timeDetail($route_id,$Data->key_group,'1');	
			$numTime = $times->num_rows();
			   $p =1;
				if($numTime >0){						   	
				foreach($times->result() as $times2){  
				$times1 = date('H:i', strtotime($times2->arrive_time.'+'.$Data->transfer_h_time.' hours'));	
				$times1 = date('H:i', strtotime($times1.'+'.$Data->transfer_m_time.' minutes'));
				$price1 = $this->transport_model->getPrice($times2->id,'price','1');
				$price2 = $this->transport_model->getPrice($times2->id,'price_children','1');
				$price3 = ($price1*$Adults)+($price2*$Children);
	?>
	
		
	   <!-- Accordion 1 -->
		<div class="panel">
			<div class="panel-heading" id="heading<?php echo $times2->id?>">
				<div class="panel-title">
					   
					<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $times2->id?>">
						
						
						<div class="col-md-9" align="left">
						<h4><?php echo $txt_routeType?> </h4>
					
						<i class="fa fa-clock-o" style="color:#000000"></i> <?php echo $times2->arrive_time?> > <?php echo $times1?>
						<span style="padding-left: 30px;"><i class="fa fa-hourglass-start" style="color:#000000"></i> <?php if($Data->transfer_h_time!=''){echo $Data->transfer_h_time = str_replace("0", "", $Data->transfer_h_time); } ?> h <?php echo $Data->transfer_m_time?> m</span>
						&nbsp;
						<span ><i class="fa fa-money" style="color:#A4A4A4">&nbsp;</i><?php echo number_format($price3)?> THB</span>
						
						</div>
						<div class="col-md-1" align="left">
						<span class="icon fa fa-angle-down"></span>
						</div>
					</a>
                                  
						<div class="col-md-2" align="right">
                                                      <?php $gettimechselect =  $this->transport_model->gettimechselect();
                                                         $numget1 = $gettimechselect->num_rows();
                                   if($numget1 !=''){
                                    foreach($gettimechselect->result() as $gettimechselect2){ } 
                                    if($times2->arrive_time == $gettimechselect2->arrive_time){
                                    ?>
                                                    <button id="btn-select" type="button" class="awe-btn awe-btn-1 awe-btn-small" onclick="SelectTrip('DEPART','<?php echo $times2->id?>' ,'<?php echo $Adults?>','<?php echo $Children?>', '<?php echo $datedata?>', '<?php echo $dateReturn?>','<?php echo $routedata?>','')"><i class="fa fa-ticket"></i>&nbsp;Select trip</button>
                                    <?php }}?>
						</div>
                                  
				</div>

			</div>
			
		
			
			
			
			<div  id="collapse<?php echo $times2->id?>" class="panel-collapse collapse" aria-labelledby="heading<?php echo $times2->id?>">
			
			<?php $checkDetail = $this->transport_model->checkDetail($times2->id, '1');
			$numchDetail = $checkDetail->num_rows();
			if($numchDetail>0){
				$a =1; $arr =''; $arr2 =''; 
				foreach ($checkDetail->result() as $checkDetail2){	
				$pricedetail1 = $this->transport_model->getPrice($times2->id,'price','1',$checkDetail2->data_order);
				$pricedetail2 = $this->transport_model->getPrice($times2->id,'price_children','1',$checkDetail2->data_order);
				$pricedetail3 = ($pricedetail1*$Adults)+($pricedetail2*$Children);
				$arr = $arr.'/'.$pricedetail1;
				$arr2 = $arr2.'/'.$pricedetail2;
			?>

		<div class="panel-body">
			
		<div class="col-md-11">
		<div class="container" style="background-color: #f1f1f1; border: 1px solid #E5E5E5">
			<div class="row" style="padding-top: 20px">
				<div class="col-sm-8">
					<div class="item">
						<span><i class="fa fa-map-marker"></i></span>
						<div>
							<strong>
								<?php echo $checkDetail2->arrive_time?>
								<?php $checkroute = $this->Package_model->list_placeData($checkDetail2->begin_place_id);  foreach ($checkroute->result() as $checkroute2){} echo $checkroute2->place_name_en?>
							</strong>
						</div>
					</div>
					<?php $checktransport = $this->Package_model->list_transportData($checkDetail2->transport_id);foreach ($checktransport->result() as $checktransport2){} ?>
					<div class="item">
						<span><i class="<?php echo $checktransport2->icon_class?>" aria-hidden="true"  style="color:#2f79b1;"></i></span>
						<div style="color:#2f79b1;">
							<strong>
								<?php  echo $checktransport2->transport_name_en?>
							</strong> &nbsp;&nbsp;<i class="fa fa-info-circle" style="font-size:20px" onclick="transportData('<?php echo $checkDetail2->transport_id?>')"></i>
						</div>
						<p>
							<small><strong>Note : </strong><?php echo $checkDetail2->note_checkin_en?><br>
</small>
						</p>
						<p>
							<!--<button type="button" class="" data-toggle="collapse" data-target="#price1<?php echo $checkDetail2->id?>" style="font-size: 10pt !important">
								<?php //echo $Total?> Travellers =
								<?php //echo number_format($pricedetail3)?> THB <span style="float: right; padding-left: 15px;"> <i class="fa fa-chevron-down" aria-hidden="true"></i> </span>
							</button>-->
							<div id="price1<?php echo $checkDetail2->id?>" ><!--class="collapse" -->
								<ul>
									<?php if($Adults > 0){ ?>
									<li style="font-size: 10pt; font-weight: 100;">
										<?php echo $Adults?> Adults x
										<?php echo number_format($pricedetail1)?> =
										<?php echo number_format($Adults*$pricedetail1)?> THB </li>
									<?php }?>
									<?php if($Children > 0){ ?>
									<li style="font-size: 10pt; font-weight: 100;">
										<?php echo $Children?> Children x
										<?php echo number_format($pricedetail2)?> =
										<?php echo number_format($Children*$pricedetail2)?> THB</li>
									<?php }?>
								</ul>
							</div>
						</p>
					</div>

					<div class="item-end">
						<span><i class="fa fa-map-marker"></i></span>
						<div>
							<strong>
								<?php echo $checkDetail2->depart_time?>
								<?php $checkroute3 = $this->Package_model->list_placeData($checkDetail2->destination_place_id); foreach ($checkroute3->result() as $checkroute4){}echo $checkroute4->place_name_en?>
							</strong>
						</div>
					</div>
				</div>
				<?php //$r = '1';
					//if($a == 1){ 
					//$listroute = $this->transport_model->listRoute($r,$routedata);
					//foreach($listroute->result() as $listroute2){} ?>
				<div class="col-sm-3">
<!--					<img src="<?php //echo base_url('uploadfile/').$listroute2->route_image?>" class="img-responsive" style="padding: 20px 0px;" onclick="mapData('<?php //echo $routedata?>')">-->
				</div>
				<?php //} ?> </div>
			<?php if($numchDetail == $a){  ?>
			<div >
				<?php /*?>
				<button type="button" class="awe-btn awe-btn-1 awe-btn-small" onclick="selecttrip('<?php echo $times2->id?>','<?php echo $Data->key_group?>','<?php echo $arr?>','<?php echo $arr2?>','<?php echo $price3?>')">
					Select this trip</button>
				<?php */?>
				
                         			
				<button type="button" class="awe-btn awe-btn-1 awe-btn-small" onClick="SelectTrip('DEPART','<?php echo $times2->id?>')" ><i class="fa fa-ticket"></i>&nbsp;Select trip</button>
			</div>
			<?php } ?> </div>
		</div>
		<div class="col-md-2">&nbsp;</div>
	</div>
			<?php $a++; }}?>
			</div>
		</div>
	

	<?php $p++; $nRows++; }}?>
	


<!-- Accordion -->

<?php $txt_routeType='';$n=1;}}}?>
</div>	
<!-- start Return List -->

<div class="flight-list-head" style="margin-top: 10px; padding: 10px !important">
<!--<span class="icon"><img src="images/icon-maker.png" alt=""></span> -->
<h3 style="font-size: 16px !important">
	<span style="color: red"> RETURN : </span>
	<i class="fa fa-ship" aria-hidden="true"></i>
	
	<?php echo $spanTo?> <i class="fa fa-arrow-right" aria-hidden="true"></i> <?php echo $spanRoute?></h3>
<p><span style="font-size: 16px !important"><i class="fa fa-calendar-o"></i> <?php echo $this->Package_model->GetEngDateTimeshot($dateReturn);?>&nbsp;&nbsp;<i class="fa fa-users"></i> <?php echo $Total?> <?php if($Total >1){echo 'Travellers';}else{echo 'Traveller';}?></span>
</p>
</div>

<div class="panel-group" id="accordion" style="padding-top: 20px;">
<?php $route_idnew = $this->transport_model->checkRoute($placedata,$routedata);
if($route_idnew!=0){
$xnew=''; $nnew=1; $txt_routeTypenew =''; $times1new=''; $nRowsnew=1;
$Routetypenew = $this->transport_model->get_routeType($route_id,$x, '1', 'yes', 'key_group');
	foreach ($Routetypenew->result() as $Datanew){ 
	$countDetailnew = $this->transport_model->count_detailTimeTable($route_idnew,$Datanew->key_group);
	$countnumnew = $countDetailnew->num_rows();
	if($countnumnew >0){
	$routeType2new = $this->transport_model->get_routeType($route_idnew, $Datanew->key_group, '1', $xnew, 'id');		
	foreach($routeType2new->result() as $routeType3new){ 

	if($nnew == 1){ $txtnew = ''; } else { $txtnew = ' + '; }

	$listTransportnew = $this->transport_model->listTransport($xnew,$routeType3new->transport_id);
	foreach($listTransportnew->result() as $listTransport2new){}			
	$txt_routeTypenew = $txt_routeTypenew.$txtnew.$listTransport2new->transport_name_en;

$nnew++; }

?>
	<?php   $timesnew = $this->transport_model->get_timeDetail($route_idnew,$Datanew->key_group,'1');	
			$numTimenew = $timesnew->num_rows();
			   $pnew =1;
				if($numTimenew >0){						   	
				foreach($timesnew->result() as $times2new){  
				$times1new = date('H:i', strtotime($times2new->arrive_time.'+'.$Datanew->transfer_h_time.' hours'));	
				$times1new = date('H:i', strtotime($times1new.'+'.$Datanew->transfer_m_time.' minutes'));
				$price1new = $this->transport_model->getPrice($times2new->id,'price','1');
				$price2new = $this->transport_model->getPrice($times2new->id,'price_children','1');
				$price3new = ($price1new*$Adults)+($price2new*$Children);
	?>
	
		
	   <!-- Accordion 1 -->
		<div class="panel">
			<div class="panel-heading" id="heading<?php echo $times2new->id?>">
				<div class="panel-title">
					   
					<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $times2new->id?>">
						
						
						<div class="col-md-9" align="left">
						<h4><?php echo $txt_routeTypenew?> </h4>
					
						<i class="fa fa-clock-o" style="color:#000000"></i> <?php echo $times2new->arrive_time?> > <?php echo $times1new?>
						<span style="padding-left: 30px;"><i class="fa fa-hourglass-start" style="color:#000000"></i> <?php if($Datanew->transfer_h_time!=''){echo $Datanew->transfer_h_time = str_replace("0", "", $Datanew->transfer_h_time); } ?> h <?php echo $Datanew->transfer_m_time?> m</span>
						&nbsp;
						<span ><i class="fa fa-money" style="color:#A4A4A4">&nbsp;</i><?php echo number_format($price3new)?> THB</span>
						
						</div>
						<div class="col-md-1" align="left">
						<span class="icon fa fa-angle-down"></span>
						</div>
					</a>
						<div class="col-md-2" align="right">
                                                         <?php $gettimechselectnew =  $this->transport_model->gettimechselect();
                                   $numget = $gettimechselectnew->num_rows();
                                   if($numget !=''){
                                    foreach($gettimechselectnew->result() as $gettimechselect2new){ } 
                                    if($times2new->arrive_time == $gettimechselect2new->arrive_time){
                                    ?>
                                                    <button id="btn-select" type="button" class="awe-btn awe-btn-1 awe-btn-small" onclick="SelectTrip('DEPART','<?php echo $times2new->id?>' ,'<?php echo $Adults?>','<?php echo $Children?>', '<?php echo $datedata?>', '<?php echo $dateReturn?>','<?php echo $routedata?>','')"><i class="fa fa-ticket"></i>&nbsp;Select trip</button>
                                   <?php }}?>    
						</div>
				</div>

			</div>
			<div  id="collapse<?php echo $times2new->id?>" class="panel-collapse collapse" aria-labelledby="heading<?php echo $times2new->id?>">
			
			<?php $checkDetailnew = $this->transport_model->checkDetail($times2new->id, '1');
			$numchDetailnew = $checkDetailnew->num_rows();
			if($numchDetailnew>0){
				$anew =1; $arrnew =''; $arr2new ='';
				foreach ($checkDetailnew->result() as $checkDetail2new){	
				$pricedetail1new = $this->transport_model->getPrice($times2new->id,'price','1',$checkDetail2new->data_order);
				$pricedetail2new = $this->transport_model->getPrice($times2new->id,'price_children','1',$checkDetail2new->data_order);
				$pricedetail3new = ($pricedetail1new*$Adults)+($pricedetail2new*$Children);
				$arrnew = $arrnew.'/'.$pricedetail1new;
				$arr2new = $arr2new.'/'.$pricedetail2new;
			?>

		<div class="panel-body">
			
		<div class="col-md-11">
		<div class="container" style="background-color: #f1f1f1; border: 1px solid #E5E5E5">
			<div class="row" style="padding-top: 20px">
				<div class="col-sm-8">
					<div class="item">
						<span><i class="fa fa-map-marker"></i></span>
						<div>
							<strong>
								<?php echo $checkDetail2new->arrive_time?>
								<?php $checkroutenew = $this->Package_model->list_placeData($checkDetail2new->begin_place_id);  foreach ($checkroutenew->result() as $checkroute2new){} echo $checkroute2new->place_name_en?>
							</strong>
						</div>
					</div>
					<?php $checktransportnew = $this->Package_model->list_transportData($checkDetail2new->transport_id);foreach ($checktransportnew->result() as $checktransport2new){} ?>
					<div class="item">
						<span><i class="<?php echo $checktransport2new->icon_class?>" aria-hidden="true"  style="color:#2f79b1;"></i></span>
						<div style="color:#2f79b1;">
							<strong>
								<?php  echo $checktransport2new->transport_name_en?>
							</strong> &nbsp;&nbsp;<i class="fa fa-info-circle" style="font-size:20px" onclick="transportData('<?php echo $checkDetail2new->transport_id?>')"></i>
						</div>
						<p>
							<small><strong>Note : </strong><?php echo $checkDetail2new->note_checkin_en?><br>
</small>
						</p>
						<p>
							<!--<button type="button" class="" data-toggle="collapse" data-target="#price1<?php echo $checkDetail2new->id?>" style="font-size: 10pt !important">
								<?php //echo $Total?> Travellers =
								<?php //echo number_format($pricedetail3)?> THB <span style="float: right; padding-left: 15px;"> <i class="fa fa-chevron-down" aria-hidden="true"></i> </span>
							</button>-->
							<div id="price1<?php echo $checkDetail2new->id?>" ><!--class="collapse" -->
								<ul>
									<?php if($Adults > 0){ ?>
									<li style="font-size: 10pt; font-weight: 100;">
										<?php echo $Adults?> Adults x
										<?php echo number_format($pricedetail1new)?> =
										<?php echo number_format($Adults*$pricedetail1new)?> THB </li>
									<?php }?>
									<?php if($Children > 0){ ?>
									<li style="font-size: 10pt; font-weight: 100;">
										<?php echo $Children?> Children x
										<?php echo number_format($pricedetail2new)?> =
										<?php echo number_format($Children*$pricedetail2new)?> THB</li>
									<?php }?>
								</ul>
							</div>
						</p>
					</div>

					<div class="item-end">
						<span><i class="fa fa-map-marker"></i></span>
						<div>
							<strong>
								<?php echo $checkDetail2new->depart_time?>
								<?php $checkroute3new = $this->Package_model->list_placeData($checkDetail2new->destination_place_id); foreach ($checkroute3new->result() as $checkroute4new){}echo $checkroute4new->place_name_en?>
							</strong>
						</div>
					</div>
				</div>
				<?php $rnew = '1';
					if($anew == 1){ 
					$listroutenew = $this->transport_model->listRoute($rnew,$routedata);
					foreach($listroute->result() as $listroute2){} ?>
				<div class="col-sm-3">
<!--					<img src="<?php //echo base_url('uploadfile/').$listroute2->route_image?>" class="img-responsive" style="padding: 20px 0px;" onclick="mapData('<?php //echo $routedata?>')">-->
				</div>
				<?php } ?> </div>
			<?php if($numchDetailnew == $anew){  ?>
			<div >
				<?php /*?>
				<button type="button" class="awe-btn awe-btn-1 awe-btn-small" onclick="selecttrip('<?php echo $times2->id?>','<?php echo $Data->key_group?>','<?php echo $arr?>','<?php echo $arr2?>','<?php echo $price3?>')">
					Select this trip</button>
				<?php */?>
				
                         			
				<button type="button" class="awe-btn awe-btn-1 awe-btn-small" onClick="SelectTrip('DEPART','<?php echo $times2new->id?>')" ><i class="fa fa-ticket"></i>&nbsp;Select trip</button>
			</div>
			<?php } ?> </div>
		</div>
		<div class="col-md-2">&nbsp;</div>
	</div>
			<?php $anew++; }}?>
			</div>
		</div>
	

	<?php $pnew++; $nRowsnew++; }}?>
	


<!-- Accordion -->

<?php $txt_routeTypenew='';$nnew=1;}}}?>
</div>
<!-- //start Return List -->
</section>
	
	
<!-- End Flight List -->


</div>
<!-- End Flight Right -->

<!-- Sidebar -->
<div class="col-md-3 col-md-pull-9">
<!-- Sidebar Content -->
<div class="sidebar-cn">

<!-- Search Result -->
<div class="search-result">
	<div id="clockdate">
	  <div class="clockdate-wrapper">
		<div id="clock"></div>
		<div id="date"></div>
	  </div>
	</div>
	
</div>
<!-- End Search Result -->
<!-- Search Form Sidebar -->
<div class="search-sidebar">

<div class="row">
	<form action="<?php echo base_url('Welcome/trip_list') ?>" method="post" enctype="multipart/form-data" onsubmit="return CheckForm()" name="frm2" id="frm2">
		 <ul class="form-radio">
			 <li>
				 <div class="radio-checkbox">
					 <input type="radio" name="tripType" id="radio-5" class="radio" value="2" onClick="changeSearchForm('roundTrip', this.checked)" checked>
					 <label for="radio-5">Return Trip</label>
				 </div>
			 </li>
			 <li>
				 <div class="radio-checkbox">
					 <input type="radio" name="tripType" id="radio-6" class="radio" value="1" onClick="changeSearchForm('oneTrip', this.checked)">
					 <label for="radio-6">One-Way</label>
				 </div>
			 </li>
		 </ul> 
		<div class="form-search clearfix">
			<div class="form-field field-select field-lenght">
				<div class="select">
					<span id="formroute">
						<?php echo $spanRoute?>
					</span>
					<select id="routedata" name="routedata" onchange="placedataupdate(this.value)">
						<option value="">---Select---</option>
						<?php $select2 ='';
				$routeData1 = $this->Package_model->getrouteList();
				foreach ($routeData1->result() as $routeData2) {
				  if($routeData2->begin_place_id == $routedata){ $select2 = 'selected';}
					?>
						<option value="<?php echo $routeData2->begin_place_id ?>" <?php echo $select2?>>
							<?php echo $routeData2->place_name_en ?> </option>

						<?php $select2 ='';}?>
					</select>
				</div>
			</div>
			<div class="form-field field-select field-lenght">
				<div class="select">
					<span id="formto">
						<?php echo $spanTo?>
					</span>
					<select id="placedata" name="placedata">
						<option value="">---Select---</option>
						<?php $select3 ='';
				$placeData1 = $this->Package_model->list_placeData();
				foreach ($placeData1->result() as $placeData2) {
				   if($placeData2->id == $placedata){ $select3 = 'selected';}
					?>
						<option value="<?php echo $placeData2->id ?>" <?php echo $select3?>>
							<?php echo $placeData2->place_name_en ?> </option>
						<?php $select3 ='';} ?>
					</select>
				</div>
			</div>

			<div class="form-field field-date">
				<input type="text" class="field-input calendar-input" placeholder="Departing" id="datedata" name="datedata" value="<?php echo $datedata?>" autocomplete="off">
			</div>
		<div class="form-field field-date">
			<input type="text" class="field-input calendar-input" id="dateReturn" name="dateReturn" placeholder="Returning" value="<?php echo $dateReturn?>"  autocomplete="off">
			 <div id="hrid" style="height: 3px; background-color: #c0c0c0; margin-top: -16px;  height: 3px; display: none"></div>
		</div>

			<div class="form-field field-select field-adult">
				<div class="select">
					Adults :
					<span id="Adult">
						<?php echo $Adults?>
					</span>
					<select id="Adults" name="Adults">
						<option value="">Adults</option>
						<?php $select4 = ''; 
				for ($a = 1; $a <= 10; $a++) {
					if($a == $Adults){ $select4 = 'selected';}
					?>
						<option value="<?php echo $a ?>" <?php echo $select4?>>
							<?php echo $a ?> </option>
						<?php $select4 = '';} ?>
					</select>
				</div>
			</div>
			<div class="form-field field-select field-children">
				<div class="select">
					Children :
					<span id="Children">
						<?php if($Children!=''){echo $Children;}else{echo 'Children';}?>
					</span>
					<select id="Children" name="Children">
						<option value="0">Children</option>
						<?php $select5 = ''; 
				for ($a = 1; $a <= 10; $a++) { 
					if($a == $Children){ $select5 = 'selected';}
					?>
						<option value="<?php echo $a ?>" <?php echo $select5?>>
							<?php echo $a ?> </option>
						<?php $select5 = '';} ?>
					</select>
				</div>
			</div>


			<div class="form-submit">
				<button type="submit"   class="awe-btn awe-btn-small awe-search">Search</button>
			</div>
			<input type="hidden" id="spanRoute" name="spanRoute" value="">
			<input type="hidden" id="spanTo" name="spanTo" value="">
		</div>
	</form>
</div>
</div>
<!-- End Search Form Sidebar -->


</div>
<!-- End Sidebar Content -->
</div>
<!-- End Sidebar -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<!--<div class="modal-dialog" role="document">
<div class="modal-content">
<div  id="routemodal" class="modal-body">

</div>
</div>
</div>-->
</div>


</div>

</div>
</div>
</div>
<!-- End Main -->


<!-- Footer -->
<?php include("footer.php"); ?>
<!-- End Footer -->

</div>

<!-- Library JS -->
<script type="text/javascript" src="<?php echo base_url('html/js/library/jquery-1.11.0.min.js')?>"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?php echo base_url('html/js/library/jquery-ui.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('html/js/library/bootstrap.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('html/js/library/owl.carousel.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('html/js/library/parallax.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('html/js/library/jquery.nicescroll.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('html/js/library/jquery.ui.touch-punch.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('html/js/library/jquery.mb.YTPlayer.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('html/js/library/SmoothScroll.js')?>"></script>
<!-- End Library JS -->
<!-- Main Js -->
<script type="text/javascript" src="<?php echo base_url('html/js/script.js')?>"></script>
<!-- End Main Js -->
<script>
	function startTime() {
    var today = new Date();
    var hr = today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
    hr = (hr == 0) ? 12 : hr;
    hr = (hr > 12) ? hr - 12 : hr;
    //Add a zero in front of numbers<10
    hr = checkTime(hr);
    min = checkTime(min);
    sec = checkTime(sec);
    document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;
    
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    var curWeekDay = days[today.getDay()];
    var curDay = today.getDate();
    var curMonth = months[today.getMonth()];
    var curYear = today.getFullYear();
    var date = curWeekDay+", "+curDay+" "+curMonth+" "+curYear;
    document.getElementById("date").innerHTML = date;
    
    var time = setTimeout(function(){ startTime() }, 500);
}
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
	
  //-----------------------------------	
  function SelectTrip(selectType, timeID , adult , child , dateDepart , dateReturn , routeID ){
	  alert('ok');
  }	
	
	
//-----------------------------	
$( document ).ready( function () {

placedataupdate( '<?php echo $routedata?>', '<?php echo $placedata?>' );
	startTime();

} );
//==================================
	  //================================== changeSearchForm('roundTrip',ischecked)changeSearchForm('oneTrip')dateReturn hrid display: none
		  function 	changeSearchForm(tripType,ischecked){
			  
			  if(tripType=='roundTrip'){
				    $('#dateReturn').val('');
					$("#dateReturn").prop('disabled', false);
					$("#hrid").css("display","none")
			  }else if(tripType=='oneTrip'){ 
				    $('#dateReturn').val('');
				    //$('#dateReturn').hide();
				    $("#dateReturn").prop('disabled', true);
				    $("#dateReturn").css("cursor: not-allowed;");
				    $("#hrid").css("display","block")
			  }
		  }
//==================================
function placedataupdate( changeValue, placeData ) {
	$.post( '<?php echo base_url('Welcome/placedataupdate') ?>', {changeValue: changeValue,placeData: placeData}, function ( data ) {
	$('#formto').text("To:");
	$( '#placedata' ).empty();
	$( '#placedata' ).html( data );
	} );
}
//==================================
function transportData( transportID ) {
$.post( '<?php echo base_url('Welcome/transportDetail') ?>', {transportID: transportID},function ( data ) {
//$('#routemodal').empty();
	$( '#exampleModal' ).empty();
	
	//$('#routemodal').html(data);
	$( '#exampleModal' ).html( data );
	$( '#exampleModal' ).modal( 'show' );
	} );
}
//==================================
function mapData( routeID ) {
$.post( '<?php echo base_url('Welcome/mapDetail') ?>', { routeID: routeID},function ( data ) {
//$('#routemodal').empty();
		$( '#exampleModal' ).empty();
		//$('#routemodal').html(data);
		$( '#exampleModal' ).html( data );
		$( '#exampleModal' ).modal( 'show' );
		} );
}
//==================================
          function CheckForm() {
          var routedata = $('#routedata').val();
          var placedata = $('#placedata').val();
          var datedata = $('#datedata').val();
          var Adults = $('#Adults').val();
		  var dateReturn = $('#dateReturn').val();	  
			 
			 // var xx = new Date(datedata).getTime() 
			 // console.log('dults>'+Adults+' #datedata>'+datedata+' dateReturn>'+dateReturn+' xx'+xx);
			  
           if ((routedata == '')) {
             alert('Please Select Form .');
             return false;
           } else if ((placedata == '')) {
             alert('Please Select To .');
             return false;
		    } else if ((datedata == '')) {
             alert('Please Select Depart Date .');
             return false;
		   }else if($('#radio-5').is(':checked')&&(dateReturn=='')){ 
			  alert('Please Select Return Date .');
             return false;
           } else if ((Adults == '0')) {
             alert('Please Select Adults .');
             return false;
           }else{
               $('#spanRoute').val($('#formroute').text());
               $('#spanTo').val($('#formto').text());
                
			   
			 if($('#radio-5').is(':checked')){
			   var parts1 = datedata.split("/");
			   var date1 = new Date(parts1[1] + "/" + parts1[0] + "/" + parts1[2]);
			   
			   var parts2 = dateReturn.split("/");
			   var date2 = new Date(parts2[1] + "/" + parts2[0] + "/" + parts2[2]);
			 
			   if(date1 <= date2 )
			  	{
					$('#frm2').submit();	
					console.log('1>'+1);
				}else {
					console.log('2>'+2);
					alert('Return date must be more than depart date.');
					$('#dateReturn').focus();
					return false;	
				}
			 } else if($('#radio-6').is(':checked')){
			  	$('#frm2').submit();	
			 }
       
        }}
//==================================
function selecttrip( timesid, transportid, priceAdults, priceChildren, pricetotal ) {
	var routeid = '<?php echo $route_id?>';
	var Adults = $( '#Adults' ).val();
	var Children = '<?php echo $Children?>';
	var datedata = $( '#datedata' ).val();

	//---------Add depart and return and show cart------->
	
	
	
	
	//$.post( '<?php //echo base_url('Welcome/selecttrip') ?>', {timesid: timesid,transportid: transportid,
	//			priceAdults: priceAdults,priceChildren: priceChildren,pricetotal: pricetotal,Adults: Adults,Children: Children,datedata: datedata,routeid: routeid},function ( data ) {
	//			if ( data != '0' ) {
					//window.location.href = "<?php //echo base_url('Welcome/book_transport/') ?>" + data;
	//	      } else {
	//		  	  alert( "Can not be add" );
	//	     }
	// } )
	
	
	}
    /*    $(function(){
    setInterval(function(){ // เขียนฟังก์ชัน javascript ให้ทำงานทุก ๆ 1 วินาที
        // 1 วินาที่ เท่า 1000
        // คำสั่งที่ต้องการให้ทำงาน 
        var getData=$.ajax({ // ใช้ ajax ด้วย jQuery ดึงข้อมูลจากฐานข้อมูล
                url:"<?php //echo base_url('Welcome/time') ?>",
                data:"rev=1",
                async:false,
                success:function(getData){
                    $("#showtime").html(getData); // ส่วนที่ 3 นำข้อมูลมาแสดง
                }
        }).responseText;
    },1000);    
});*/
	//---------------------------
	    //-------------------------------------
		function setTopmenySelect(idMenu){
			$('.topmenu').removeClass('current-menu-parent');
			$('#'+idMenu).addClass('current-menu-parent');
		}
			setTopmenySelect('liindex');	
</script>
</body>

</html>