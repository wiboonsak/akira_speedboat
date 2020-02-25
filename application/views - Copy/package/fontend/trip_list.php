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

<!-- Flight List Head -->
<div class="flight-list-head" style="margin-top: 10px; padding: 10px !important">
<!--<span class="icon"><img src="images/icon-maker.png" alt=""></span> -->
<h3 style="font-size: 16px !important"><i class="fa fa-ship" aria-hidden="true"></i> <?php echo $spanRoute?><i class="fa fa-arrow-right" aria-hidden="true"></i> <?php echo $spanTo?></h3>
<p><span style="font-size: 16px !important"><i class="fa fa-calendar-o"></i> <?php echo $this->Package_model->GetEngDateTimeshot($datedata);?>&nbsp;&nbsp;<i class="fa fa-users"></i> <?php echo $Total?> <?php if($Total >1){echo 'Travellers';}else{echo 'Traveller';}?></span>
</p>
</div>
<!-- Flight List Head -->


<?php $route_id = $this->transport_model->checkRoute($routedata,$placedata);
if($route_id!=0){
$x=''; $n=1; $txt_routeType =''; $times1='';
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
<div class="tour-itinerary">
<h2 class="title-detail" style="color: #2f79b1;">
	<?php echo $txt_routeType?>
</h2>
<!-- Accordion -->
<div class="panel-group no-margin" id="accordion">
	<?php  $times = $this->transport_model->get_timeDetail($route_id,$Data->key_group,'1');	
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
			<h4 class="panel-title">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $times2->id?>">
					<i class="fa fa-circle" aria-hidden="<?php //if($p ==1){ echo 'true'; }?>" style="color:#A4A4A4"></i> <?php echo $times2->arrive_time?> > <?php echo $times1?>
					<span style="padding-left: 30px;"><i class="fa fa-clock-o" style="color:#A4A4A4"></i> <?php if($Data->transfer_h_time!=''){echo $Data->transfer_h_time = str_replace("0", "", $Data->transfer_h_time); } ?> h <?php echo $Data->transfer_m_time?> m</span>
					<span style="padding-left: 30px;"><i class="fa fa-money" style="color:#A4A4A4"></i> <?php echo number_format($price3)?> THB</span>
					<span class="icon fa fa-angle-down"></span>
				</a>
			</h4>

		</div>

		<div id="collapse<?php echo $times2->id?>" class="panel-collapse collapse <?php //if($p ==1){ echo 'in'; }?>" aria-labelledby="heading<?php echo $times2->id?>">
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
		<div class="container" style="background-color: #f1f1f1; border: 1px solid #E5E5E5">
			<div class="row" style="padding-top: 20px">
				<div class="col-sm-5">
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
							<button type="button" class="" data-toggle="collapse" data-target="#price1<?php echo $checkDetail2->id?>" style="font-size: 10pt !important">
								<?php echo $Total?> Travellers =
								<?php echo number_format($pricedetail3)?> THB <span style="float: right; padding-left: 15px;"> <i class="fa fa-chevron-down" aria-hidden="true"></i> </span>
							</button>
							<div id="price1<?php echo $checkDetail2->id?>" class="collapse">
								<ul>
									<li style="font-size: 10pt; font-weight: 100;">
										<?php echo $Adults?> Adults x
										<?php echo number_format($pricedetail1)?> =
										<?php echo number_format($Adults*$pricedetail1)?> THB </li>
									<li style="font-size: 10pt; font-weight: 100;">
										<?php echo $Children?> Children x
										<?php echo number_format($pricedetail2)?> =
										<?php echo number_format($Children*$pricedetail2)?> THB</li>
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
				<?php $r = '1';
					if($a == 1){ 
					$listroute = $this->transport_model->listRoute($r,$routedata);
					foreach($listroute->result() as $listroute2){} ?>
				<div class="col-sm-3">
					<img src="<?php echo base_url('uploadfile/').$listroute2->route_image?>" class="img-responsive" style="padding: 20px 0px;" onclick="mapData('<?php echo $routedata?>')">
				</div>
				<?php } ?> </div>
			<?php if($numchDetail == $a){  ?>
			<div>
				<button type="submit" class="awe-btn awe-btn-medium awe-book" onclick="selecttrip('<?php echo $times2->id?>','<?php echo $Data->key_group?>','<?php echo $arr?>','<?php echo $arr2?>','<?php echo $price3?>')">
					Select this trip</button>

			</div>
			<?php } ?> </div>
	</div>
			<?php $a++; }}?>
		</div>
	</div>
	<!-- End Accordion 1 -->
	<?php $p++; }}?>
	<!-- Accordion 2 -->

</div>
<!-- Accordion -->
</div>
<?php $txt_routeType='';$n=1;}}}?>
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
<p>
	Select <br>
	<span>departure trip</span>
</p>
</div>
<!-- End Search Result -->
<!-- Search Form Sidebar -->
<div class="search-sidebar">

<div class="row">
	<form action="<?php echo base_url('Welcome/trip_list') ?>" method="post" enctype="multipart/form-data" onsubmit="return CheckForm()" name="frm2" id="frm2">
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
				<input type="text" class="field-input calendar-input" placeholder="Departing" id="datedata" name="datedata" value="<?php echo $datedata?>">
			</div>
			<!-- <div class="form-field field-date">
			<input type="text" class="field-input calendar-input" placeholder="Returning">
		</div>-->

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
				<button type="submit" class="awe-btn awe-btn-medium awe-search">Search</button>
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
<script type="text/javascript">
$( document ).ready( function () {

placedataupdate( '<?php echo $routedata?>', '<?php echo $placedata?>' );

} );
//==================================
function placedataupdate( changeValue, placeData ) {
$.post( '<?php echo base_url('
Welcome / placedataupdate ') ?>', {
changeValue: changeValue,
placeData: placeData
},
function ( data ) {
$( '#placedata' ).empty();
$( '#placedata' ).html( data );
} );
}
//==================================
function transportData( transportID ) {
$.post( '<?php echo base_url('
Welcome / transportDetail ') ?>', {
transportID: transportID
},
function ( data ) {
//$('#routemodal').empty();
$( '#exampleModal' ).empty();
//$('#routemodal').html(data);
$( '#exampleModal' ).html( data );
$( '#exampleModal' ).modal( 'show' );
} );
}
//==================================
function mapData( routeID ) {
$.post( '<?php echo base_url('
Welcome / mapDetail ') ?>', {
routeID: routeID
},
function ( data ) {
//$('#routemodal').empty();
$( '#exampleModal' ).empty();
//$('#routemodal').html(data);
$( '#exampleModal' ).html( data );
$( '#exampleModal' ).modal( 'show' );
} );
}
//==================================
function CheckForm() {
var routedata = $( '#routedata' ).val();
var placedata = $( '#placedata' ).val();
	var datedata = $( '#datedata' ).val();
	var Adults = $( '#Adults' ).val();
		if ( ( routedata == '' ) ) {
		alert( 'Please Select Form .' );
		return false;
		} else if ( ( placedata == '' ) ) {
		alert( 'Please Select To .' );
		return false;
		} else if ( ( datedata == '' ) ) {
		alert( 'Please Select Departing .' );
		return false;
		} else if ( ( Adults == '' ) ) {
		alert( 'Please Select Adults .' );
		return false;
		} else {
			$( '#spanRoute' ).val( $( '#formroute' ).text() );
			$( '#spanTo' ).val( $( '#formto' ).text() );

			$( '#frm2' ).submit();
/*     var postData = new FormData($("#frm1")[0]);
$.ajax({
type: 'POST',
url: '<?php //echo base_url('Welcome/trip_list') ?>',
processData: false,
contentType: false,
data: postData,
success: function (data, status) {
if (status == 'success') {

} else {

}
}
});*/
}
}
//==================================
function selecttrip( timesid, transportid, priceAdults, priceChildren, pricetotal ) {
	var routeid = '<?php echo $route_id?>';
	var Adults = $( '#Adults' ).val();
	var Children = '<?php echo $Children?>';
	var datedata = $( '#datedata' ).val();

$.post( '<?php echo base_url('Welcome / selecttrip ') ?>', {timesid: timesid,transportid: transportid,
				priceAdults: priceAdults,priceChildren: priceChildren,pricetotal: pricetotal,Adults: Adults,Children: Children,datedata: datedata,routeid: routeid
				},
	   	function ( data ) {
				if ( data != 0 ) {
					window.location.href = "<?php echo base_url('Welcome/book_transport/') ?>" + data;
		  } else {
			  	alert( "Can not be add" );
		  }
	} );
	}
</script>
</body>

</html>