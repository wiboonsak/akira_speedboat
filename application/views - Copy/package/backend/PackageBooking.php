<?php 
	if($_POST['action']=='delete'){		
			
			$query=" DELETE FROM  `tbl_package_booking`  WHERE id='".$_POST['KEY']."'  ";
			mysqli_query($link,$query);
		
		/*	$query=" DELETE FROM  `tbl_hotel_booking_detail`  WHERE order_id='".$_POST['order_id']."'  ";
			mysqli_query($link,$query);
			
			$query=" DELETE FROM  `tbl_used_giftVoucher`  WHERE order_id='".$_POST['order_id']."'  ";
			mysqli_query($link,$query);
			
			$query=" DELETE FROM  `tbl_book_Extra_Service`  WHERE order_id='".$_POST['order_id']."'  ";
			mysqli_query($link,$query);	*/	
	}	
	if($_POST['action']=='DeleteAll'){
	/*	for($i=0;$i<$_POST['ListCount'];$i++){
				$path_file = 'voucher_pdf/voucher_'.$_POST['select_id'][$i].'.pdf';
				$path_file2 = '../voucher_pdf/voucher_'.$_POST['select_id'][$i].'.pdf';
				@unlink ($path_file);
				@unlink ($path_file2);	*/	
			
				$query=" DELETE FROM  `tbl_package_booking`  WHERE order_id='".$_POST['select_id'][$i]."'  ";
				mysqli_query($link,$query);
				
				/*$query=" DELETE FROM  `tbl_hotel_booking_detail`  WHERE order_id='".$_POST['select_id'][$i]."'  ";
				mysqli_query($link,$query);	*/	
				
		//}
	}
	if($_POST['action']=='Archive'){
		$query=" update `tbl_hotel_booking` set archive_status='1'  WHERE order_id='".$_POST['KEY']."'  ";
		//echo $query;
		if(mysqli_query($link,$query)){
			
			$URL="main.php";
			echo ("<script>location.href='$URL';</script>");
		}
	}
	if($_POST['action']=='ArchiveAll'){
		for($i=0;$i<$_POST['ListCount'];$i++){
			$query=" update `tbl_hotel_booking` set archive_status='1'  WHERE order_id='".$_POST['select_id'][$i]."'  ";
			//echo $query;
			mysqli_query($link,$query);
		}
		
		$URL="main.php";
		echo ("<script>location.href='$URL';</script>");
	}
	if($_POST['action']=="searchBooking"){
		$where_search = " and ( customer_name like '%".$_POST['SearchBooking']."%'"	
						." or  order_id like '%".$_POST['SearchBooking']."%' )";
		$dateCheckIn = $_POST['display_indate'];
		$dateCheckOut = $_POST['display_outdate'];
		if($dateCheckIn <> ''){
			$where_search .= " AND (
		     ( ( '".$dateCheckIn."'  BETWEEN a.checkin_date AND IF(STR_TO_DATE('".$dateCheckIn."','%Y-%m-%d')= a.checkout_date ,a.checkout_date -1 ,a.checkout_date ) )  and (a.checkin_date <> a.checkout_date) )
			 
			OR 
			( (   '".$dateCheckOut."'   BETWEEN a.checkin_date AND a.checkout_date+1 )  and (a.checkin_date <> a.checkout_date) )   )  ";
		}
	}
  //////////////////////////////////////////////////////////////////////
/*	if($_POST['action']=='SendAll'){
		require_once('sendmail/PHPMailerAutoload.php'); $mail = new PHPMailer(true);
		for($i=0;$i<$_POST['ListCount'];$i++){
		/*	$query=" update `tbl_hotel_booking` set archive_status='1'  WHERE order_id='".$_POST['select_id'][$i]."'  ";
			//echo $query;
			mysqli_query($link,$query);*/
			
		//require_once("func_price.php");	
			
	//$_GET['OrderNo'] = '';		
			
/*	$queryBooking = "SELECT ClientEmail , booking_first_name , booking_last_name , date_check_in , order_id FROM  `tbl_hotel_booking` WHERE order_id = '".$_POST['select_id'][$i]."'  ";
 	$resultBooking=mysqli_query($link,$queryBooking);
 	$Booking=mysqli_fetch_assoc($resultBooking);   

 	$query="SELECT * FROM tbl_hotel_data  ";
 	$result=mysqli_query($link,$query);
 	$data=mysqli_fetch_assoc($result) ;
			
	$dateArray = explode("-",$Booking['date_check_in']);
	$date= $dateArray[2];
	$mon= $dateArray[1];
	$year= $dateArray[0];
	$monthArray = array("01"=>"January","02"=>"February","03"=>"March","04"=>"April", "05"=>"May","06"=>"June","07"=>"July","08"=>"August","09"=>"September","10"=>"October","11"=>"November","12"=>"December");
	$Check_in= $date."  ".$monthArray[$mon]."  ".$year;	
			

  	$name = $Booking['booking_first_name']." ".$Booking['booking_last_name']; 
  	$order_id = $Booking['order_id'];
  	//$Check_in = get_dateENG2($Booking['date_check_in']);
  	$memberEmail = $Booking['ClientEmail'];
  	//$memberName = $name;  
  	$contact_info_en = $data['contact_info_en'];	  
  	$policies_en = $data['policies_en'];
		
	$_GET['OrderNo'] = $_POST['select_id'][$i];		
			
	include("sendmail/sendmail_to_admin33.php");
	include("sendmail/sendmail33.php");	
	
	/*if($redirect==1){
		echo '<script language="javascript">';
		echo 'alert("ส่งใบจองห้องพักเรียบร้อยแล้ว");';
		echo '</script>';
	}*/
			
			
/*	} //error_reporting(0);
		
		echo '<script language="javascript">';
		echo 'alert("ส่งใบจองห้องพักเรียบร้อยแล้ว");';
		echo '</script>';
		
		$URL="main.php";
		echo ("<script>location.href='$URL';</script>");
	}*/
		
  ###############################################################################  OrderAllNewBooking
  
		if($_GET['work']=="PackageBooking"){
			$where_status = "where a.status_payment in ('1','0') ";
		}/*else if($_GET['work']=="OrderAllWTF"){
			$where_status = " and booking_status in ('0','1')   and payment_type = 'Transfer' and  archive_status <> '1' ";
		}else if($_GET['work']=="OrderAllCTF"){
			$where_status = " and booking_status = '2' and payment_type = 'Transfer' and  archive_status <> '1'";
		}else if($_GET['work']=="OrderAllCPP"){
			$where_status = " a.booking_status = '2' and a.payment_type = 'payPal' ";
		}else if($_GET['work']=="OrderHistory"){ 
			$where_status = " and booking_status in ('-1','0','1','2') and   archive_status = '1'  ";
		
		}else if($_GET['work']=="OrderAll_PSB"){
			$where_status = " a.booking_status = '2' and a.payment_type != 'payPal' ";
		}*/
		
		
		$query="SELECT * FROM `tbl_package_booking` as a ".$where_status." ".$where_search."  ORDER BY id DESC   ";
		$resultData=mysqli_query($link,$query);
		//$queryLimit = $query." LIMIT $startRow, $rowPerPage ";
		//$resultData=mysqli_query($link,$queryLimit);
		//$result2=mysqli_query($link,$query);		
		//$xrow=mysqli_num_rows($result2);
		//$totalPage=ceil($xrow/$rowPerPage); 

//echo ">>>>".$query;

		
?>
<script src="assets/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="../js/booking.js"></script>
<?php 
$min_day	= strtotime("-1 year") ;
$min_date	= date("Y-m-d",$min_day);
$max_day	= strtotime("+1 year");
$max_date	= date("Y-m-d",$max_day); ?>
 <script>
 
  $(function() {

    $( "#display_indate" ).datepicker({
	  //showButtonPanel: true,
	/*  selectOtherMonths: true,
	  defaultDate: +1,
	  dateFormat: "yy-mm-dd"  ,
	  minDate: "<?//=$min_date?>", 
	  maxDate: "<?//=$max_date?>",
} );*/
	  
	  
	 // $('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true,
					dateFormat: "yy-mm-dd" 
				})
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
	
	//$( ".display_indate" ).datepicker( "option", "altFormat", "yyyy-mm-dd" );
  });
  
    $(function() {
    $( "#display_outdate" ).datepicker({
	  //showButtonPanel: true,
	/*  selectOtherMonths: true,
	  defaultDate: +2,
	  dateFormat: "yy-mm-dd" ,
	  minDate: "<?//=$min_date?>", 
	  maxDate: "<?//=$max_date?>",
});*/
		
			autoclose: true,
			todayHighlight: true,
			dateFormat: "yy-mm-dd" 
				})
				//show datepicker when clicking on the icon
				/*.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});*/
		$('#iconOut').on(ace.click_event, function(){
					$(this).prev().focus();
});
		
  });
  /*
 function chkOutDate(){
  	var CheckinDate = new Date(document.getElementById('display_indate').value);
	var NewCheckoutDate = new Date(document.getElementById('display_indate').value);
	NewCheckoutDate.setDate(CheckinDate.getDate()+1);
	//alert(NewCheckoutDate.toString()); 
	var day			=  NewCheckoutDate.getDate() ;
	var monthIndex  =  NewCheckoutDate.getMonth();
	var year 		=  NewCheckoutDate.getFullYear();
	var strNewCheckoutDate = '';
	 
 	if(document.getElementById('display_outdate').value < document.getElementById('display_indate').value ){
		
		 
		// strNewCheckoutDate 		=   getNewCheckoutDate(day,monthIndex,year); 
		 var dayList = [
		  '01', '02', '03','04', '05', 
		  '06', '07','08', '09', '10',
		  '11', '12', '13', '14', '15',
		  '16', '17', '18', '19', '20',
		  '21', '22', '23', '24', '25',
		  '26', '27', '28', '29', '30','31'
		];
		
		var monthList = [
		  '01', '02', '03',
		  '04', '05', '06', '07',
		  '08', '09', '10',
		  '11', '12'
		];
	strNewCheckoutDate =  year + '-' + monthList[monthIndex] + '-' +dayList[day-1]  ;  
 		 document.getElementById('display_outdate').value = strNewCheckoutDate; 
	}
 } */
  </script>
<script language="javascript">
	function searchBooking(){
			document.form1.action.value='searchBooking';
			document.form1.submit();
	}
	function archiveThis(ids){
		
		    if(confirm('ต้องการจัดเก็บรายการ Order เลขที่    '+ids+' ?')){
							document.form1.KEY.value=ids;	
							document.form1.action.value='Archive';
							document.form1.submit();
			}else{
								return false;
			}
				
		}
	
</script>
<script language="JavaScript">
//<!--
	 function windowOpener(windowHeight, windowWidth, windowName, windowUri)
			{
					var centerWidth = (window.screen.width - windowWidth) / 2;
					var centerHeight = (window.screen.height - windowHeight) / 2;
    				newWindow = window.open(windowUri, windowName, 'resizable=1,scrollbars=yes,width=' + windowWidth +  ',height=' + windowHeight +  ',left=' +centerWidth + ',top=' + centerHeight);
					newWindow.focus();
					return newWindow.name;
		}

	function CheckForm(){
					if(document.form1.province_id.value=='x'){
								alert('กรุณาเลือกจังหวัด');
								return false
						}else if(document.form1.location_name_th.value==''){
							alert('ชื่อพื้นที่ ไทย');
								return false
						}else if(document.form1.location_name_en.value==''){
							alert('ชื่อพื้นที่ อังกฤษ ');
								return false
						}else{
							document.form1.action.value='Add';
							document.form1.submit();
							}
		}
		
	function DeleteThis(id, orderNo){
			 if(confirm('ต้องการลบ '+orderNo)){
		 		document.form1.action.value='delete';
				document.form1.KEY.value=id;
				document.form1.order_id.value=orderNo;
				document.form1.submit();
		 }else{
		 		return false();
		 }
	}
	
	function SetAllCheckBoxes(FormName, FieldName)
				{  
				     var CheckValue = false;
						    if(document.forms[FormName].select_all.checked==true) CheckValue = true;
						  
							if(!document.forms[FormName])
								return;
							var objCheckBoxes = document.forms[FormName].elements[FieldName];
							if(!objCheckBoxes)
								return;
							var countCheckBoxes = objCheckBoxes.length;
							if(!countCheckBoxes)
								objCheckBoxes.checked = CheckValue;
							else
								// set the check value for all check boxes
								for(var i = 0; i < countCheckBoxes; i++)
									objCheckBoxes[i].checked = CheckValue;
						 

				}
				function delAll(){
							if(confirm('ต้องการลบข้อมูล Booking  ที่เลือกทั้งหมด ')){
										document.form1.action.value='DeleteAll';
										document.form1.submit();
							}else{
									   return false;
							}
						
				}
			   function archiveAll(){
							if(confirm('ต้องการจัดเก็บข้อมูล Booking ที่เลือกทั้งหมด ')){
										document.form1.action.value='ArchiveAll';
										document.form1.submit();
							}else{
									   return false;
							}
						
				}
				function send_voucher(){
							if(confirm('ต้องการส่งใบจองห้องพัก ')){
										document.form1.action.value='SendAll';
										document.form1.submit();
							}else{
									   return false;
							}
						
				}
//-->
</script>
<style>
	.font-head{
		font-weight: bold;
		color: #000000;
	}
</style>
<div class="main-content-inner">
	<div class="breadcrumbs ace-save-state" id="breadcrumbs">
					 <ul class="breadcrumb">
						    <li>
                              <i class="ace-icon fa fa-home home-icon"></i>
                                    <a href="main.php">Home</a>
                       </li></ul>
                               <!-- /.breadcrumb -->
					
	</div>
	<div class="page-content">
	<div class="ace-settings-container" id="ace-settings-container">
							
	</div><!-- /.ace-settings-container -->

	<div class="page-header">
		<h1 id="pageTitle">
			<?php if($_GET['work']=="PackageBooking"){ echo "รายการสั่งจองแพคเกจทั้งหมด";} 
			/*	  else if($_GET['work']=="OrderAllCPP"){ echo "รายการยืนยันการชำระเงิน - Paypal";}	
				  else if($_GET['work']=="OrderAll_PSB"){ echo "รายการยืนยันการชำระเงิน - Paysbuy";}*/
			?>
		</h1>
    <!--<div id="Error_messae"></div>  -->
	</div><!-- /.page-header -->		

	<div id="workSpace">
		<form action="<?php $_SERVER['PHP_SELF']?>" method="post" name="form1">
		<input type="hidden" name="action" id="action" />
        <input type="hidden" name="KEY" id="KEY" />
		<input type="hidden" name="order_id" id="order_id" />
		<div>
		<table width="100%">
			<tr>
			<td>
				<div class="form-group" style="padding-bottom: 3%;">
					<div class="col-md-4">
						<label class="col-md-3 control-label no-padding-right" style="color: #2679B5; width: 80px"><strong>Check in&nbsp;</strong></label>

						<div class="col-md-9 input-group">
							<input class="form-control date-picker" name="display_indate" id="display_indate" type="text" value="<?php echo $_POST['display_indate']?>">
							<span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
					<div class="col-md-4">
						<label class="col-md-3 control-label no-padding-right" style="color: #2679B5; width: 83px;"><strong>Check out&nbsp;</strong></label>

						<div class="col-md-9 input-group">
							<input class="form-control date-picker" name="display_outdate" id="display_outdate" type="text" value="<?php echo $_POST['display_outdate']?>">
							<span id="iconOut" class="input-group-addon" ><i class="fa fa-calendar bigger-110"></i>
							</span>						
						</div>
					</div>
					<div class="col-md-2">
						<div class="col-md-12 input-group">
							<input name="SearchBooking" id="SearchBooking" type="text" value="<?=$_POST['SearchBooking']?>" style="width: 100%" placeholder="ระบุชื่อผู้จอง หรือ หมายเลขการจอง">
						</div>
					</div>
					<div class="col-md-2">
						<button class="btn btn-sm btn-success" type="button" name="Button" onclick="searchBooking();" >ค้นหา</button>
					</div>
				</div>
			</td>
									
									
				  
				  <!--
				  
					  <td width="144" height="28" align="right"   class="txt-white"><font color="#2679B5"><strong>Check 
						in&nbsp;</strong></font></td>
					  <td width="120"   class="LR10"><input id="display_indate" name="display_indate" type="text"  onChange="chkOutDate();"  value="<?=$_POST['display_indate']?>" style=" width:100px;"/></td>
					  <td width="73" class="LR10"><div align="right"><font color="#2679B5"><strong>Check 
						  out&nbsp;</strong></font></div></td>
					  <td width="130"  class="LR10"><input name="display_outdate" type="text" id="display_outdate"  onChange="chkOutDate();" value="<?=$_POST['display_outdate']?>"  style=" width:100px;"/></td>
					  <td>
                <input type="text" name="SearchBooking" value="<?=$_POST['SearchBooking']?>" />              
              </td>
              		  <td width="5%">  <input type="button" name="Button" value=" ค้นหา " onclick="searchBooking();" /></td>-->
					    
				</tr></table>
			</div>
			<table id="dynamic-table" class="table table-bordered " style="margin-top: 2%;">
			<thead>				
			<tr> 
                  <td width="5%" align="center" class="font-head" >Select 
                      All <br>
                      &nbsp; &nbsp; 
                      <input type="checkbox" name="select_all" value="Y" onclick="SetAllCheckBoxes('form1','select_id');" />
                    </td>
                  <td width="14%"  align="center" class="font-head" >หมายเลขการจอง</td>
                  <td width="21%"  align="center" class="font-head" >แพคเกจ</td>
                  <td width="14%"  align="center" class="font-head" >ประเภทห้องพัก</td>
                  <td align="center" class="font-head" >Check-in&nbsp; 
                    -&nbsp; Check-out</td>
                  <td align="center" class="font-head" >จำนวนเงิน</td>
                  <td align="center" class="font-head" >สถานะ</td>
                  <td align="center" class="font-head">วันที่ทำการจอง</td>
                  <td width="8%" align="center" class="font-head" >รายละเอียด</td>
                  <!--<td width="3%" align="center" class="font-head">ยกเลิก</td>
                  <td align="center" class="font-head">จัดเก็บ</td>-->
                  <td align="center" class="font-head">ลบ</td>
                  
                </tr>
			</thead>
 		   <tbody>
			<?php   $I= 0 ;
					while($data=mysqli_fetch_assoc($resultData)){  $I = $I+1;
			 	    $bgcolor= "#F7F7F7";
				 	/*if($data['booking_status']=='1'){ $bgcolor= "#DCEFDF";
					}elseif($data['booking_status']=='0'){ $bgcolor= "#EFDEBF";
				    }elseif($data['booking_status']=='-1'){ $bgcolor= "#EEEEEE";}*/
														
					//if($data['booking_status']!='2'){ $bgcolor= "#EFDEBF";	#D3F0D7}	
					if($data['status_payment']=='0'){ $bgcolor= "#F4EFAF";	}								 
				/*	if($data['status_payment']=='-1'){ $bgcolor= "#FFC4C4";	}	
					
																 
					$queryEX = "SELECT COUNT(id) AS num FROM  `tbl_book_Extra_Service` WHERE order_id = '".$data['order_number']."' ";
			  		$resultEX=mysqli_query($link,$queryEX);
					$dataEX=mysqli_fetch_assoc($resultEX);	
																 
					if($dataEX['num'] >0){ 	  		
	
						$querySum_Extra = "SELECT SUM((amount * price)) AS price FROM `tbl_book_Extra_Service` WHERE order_id = '".$data['order_number']."' ";				
						$resultSum_Extra=mysqli_query($link,$querySum_Extra);
						$Sum_Extra=mysqli_fetch_assoc($resultSum_Extra);
	
						$data['NetPrice'] = $data['NetPrice'] + $Sum_Extra['price'];	
					}*/
																 
					$queryOffer="SELECT name_th FROM tbl_package_data WHERE id = '".$data['package_id']."' ";
					$resultOffer=mysqli_query($link,$queryOffer);											 
					$dataOffer=mysqli_fetch_assoc($resultOffer); 	
						
					$queryRoom="SELECT room_type_en FROM tbl_room_data WHERE id = '".$data['room_id']."' ";
					$resultRoom=mysqli_query($link,$queryRoom);											 
					$room=mysqli_fetch_assoc($resultRoom);	
																 
			 ?>
			<tr bgcolor="<?=$bgcolor?>" class="removeClass"> 
                  <td style="padding-left:20px;"><div align="center"> <input type="checkbox" name="select_id[]" id="select_id" value="<?php echo $data['order_id']?>" /></div></td>
                  <td style="padding-left:20px;"><?php echo $data['order_id']?></td>
                  <td style="padding-left:20px;"><?php echo $dataOffer['name_th']?></td>
                  <td style="padding-left:20px;"><?php echo $room['room_type_en']?></td>
                  <td width="24%" align="center">&nbsp; 
                    <?php //echo substr($data['date_check_in'],0,10)?>
                    <?php echo GetEngDate($data['checkin_date'])?>
                    - 
                    <?php //echo substr($data['date_check_out'],0,10)?>
                    <?php echo GetEngDate($data['checkout_date'])?>
                    <br> 
                    <strong><?php echo $data['customer_name']; ?></strong>
                  </td>
                  <td width="9%" align="center"><div align="right"> 
                      <?php echo number_format($data['total_price'],2)?>
                      &nbsp;</div></td>
                  <td width="14%" align="center"> 
                    <?php if($data['status_payment']==0){ //รอการชำระเงิน?>
                     Pending Payment
                    <?php } else if($data['status_payment']==1){  //ชำระเงินแล้ว?>
                     Complete
                    <?php } else if($data['booking_status']==0){  ?>
                    ยังไม่ยืนยันสั่งซื้อ 
                    <?php } else if($data['booking_status']==-1){ //ยกเลิก?>
                    Canceled                     
                    <?php } else if($data['booking_status']==4){ //ยกเลิก?>
                     Pending Payment
                    <?php } ?>
                    <br /> 
                    <?php if($data['booking_from']==1){?>
                    สังจองผ่าน admin 
                    <?php } ?>
                    <?php 
					  if($data['how_payment']==1){
					  	echo 'Bank transfer';  
					  } else if($data['how_payment']==2) {
						  echo 'Credit card';
					  }
				 ?>
                  </td>
                  <td width="11%" align="center"><span style="padding-left:20px;"> 
                    <?php echo GetEngDateTime($data['booking_date'])?>
                    <br>
                    <?php echo $data['user_name']?>
                    </span></td>
                  <?php  if($_GET['work']=="OrderHistory"){ $colspan = " colspan = '2' "; } ?>                <?php if($data['booking_status']==2){ ?><td width="4%" align="center" <?=$colspan?> >
                  
                  <!--<a href="../voucher_pdf/voucher_<?php //echo $data['order_number'];?>.pdf" target="_blank">-->
                  <button type="button" class="btn btn-xs btn-info" data-toggle="button" onclick="window.open('../voucher_pdf/voucher_<?php echo $data['order_number'];?>.pdf', '_blank')"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;&nbsp;VOUCHER</button>
                  
                  <!--<a href="../voucher_pdf/voucher_<?php //echo $data['order_number'];?>.pdf" target="_blank"><img src="images/black_icon/16x16/zoom.png" width="16" height="16" style="border:none" /></a>-->
                  
                  </td><?php } else { ?> 
                  <td width="4%" align="center" <?=$colspan?> >
                  
                  <a href="#" onClick="windowOpener('1033', '1000', 'windowName', 'PackageBooking_datail.php?OrderNo=<?php echo $data['order_id']?>')"><button type="button" class="btn btn-xs btn-info" data-toggle="button" style="width: 88.28px" >Detail</button></a>
                  
                  <!--<a href="#" onClick="windowOpener('890', '1000', 'windowName', 'order_detail_admin.php?OrderNo=<?php //echo $data['order_number']?>&work=OrderAllWTF')"><img src="images/black_icon/16x16/zoom.png" width="16" height="16" style="border:none" /></a>--></td>
                  
                  <?php } ?>
                  <?php  //if($_GET['work']!="OrderHistory"){ ?>
                  <!--<td width="8%" align="center"> 
                    <?php //if($Permission['permission']==2){?>
                    <a href="#" onclick="archiveThis('<?php //echo $data['order_number']?>')">จัดเก็บ</a> 
                    <?php //} ?>
                  </td>-->
                  <?php  //} ?>  <?php /* ?>
                  <td width="7%" align="center"> 
                    <?php //if($Permission['permission']==2){?>
                    <!--<a href="#" onclick="DeleteThis('<?php //echo $data['id']?>','<?php //echo $data['order_number']?>')">ลบ</a> -->
                    
                    <!--<a href="#" <?php if(($data['booking_status']== '2')||($data['booking_status']== '-1')){ ?> onClick="windowOpener('890', '1000', 'windowName', 'order_detail_admin.php?OrderNo=<?php echo $data['order_number']?>&work=OrderAllWTF')"<?php } ?> ><button type="button" class="btn btn-xs btn-warning" data-toggle="button" <?php if(($data['booking_status']== '2')||($data['booking_status']== '-1')){ echo "disabled"; }?> >ยกเลิก</button></a>-->                    
                    
                    <button type="button" class="btn btn-xs btn-warning" onClick="windowOpener('890', '1000', 'windowName', 'order_detail_admin.php?OrderNo=<?php echo $data['order_number']?>&work=OrderAllWTF')" data-toggle="button" <?php if(($data['booking_status'] == 1) || ($data['booking_status'] == 4)){ echo "disabled"; }?> >Cancel</button>                
                    
                    <?php //} ?>
                  </td>
                  <td><button type="button" class="btn btn-xs btn-success disable_btn" data-toggle="button" onclick="archiveThis('<?php echo $data['order_number']?>')" <?php if(($data['booking_status'] == 1) || ($data['booking_status'] == 4)){ echo "disabled"; }?> >Save</button></td> <?php */ ?>
                  <td width="4%" align="center"> 
                    <?php if($Permission['permission']==2){?>
                    <!--<a href="#" onclick="DeleteThis('<?php //echo $data['id']?>','<?php //echo $data['order_number']?>')">ลบ</a> -->
                    
                    <button type="button" class="btn btn-xs btn-danger disable_btn" data-toggle="button" onclick="DeleteThis('<?php echo $data['id']?>','<?php echo $data['order_number']?>')">Delete</button>
                    
                    <?php } ?>
                  </td>
                </tr>
			<?php }?>
			</tbody>
			</table>	
			 <?php if( ($Permission['permission']==2) and $I > 0 ){?>
			   <input type="hidden" name="ListCount" value="<?=$I?>">
              <div align="center" style="margin-top: 20px;">
			  <?php //if($_GET['work']!="OrderHistory"){ ?>
                <!--<input type="button" name="Button" value="จัดเก็บที่เลือกทั้งหมด" onclick="archiveAll();" />-->
			  <?php //} ?>
                <!--<button class="btn btn-sm btn-primary disable_btn" type="button" name="Button" onclick="send_voucher();" >ส่งใบจองห้องพัก</button>	
                &nbsp; &nbsp; &nbsp; &nbsp;--> 
                <!--<button class="btn btn-sm btn-success disable_btn" type="button" name="Button" onclick="archiveAll();" >จัดเก็บที่เลือกทั้งหมด</button>	
                &nbsp; &nbsp; &nbsp; &nbsp;-->                
                <button class="btn btn-sm btn-danger disable_btn" type="button" name="Button" onclick="delAll();" >ลบที่เลือกทั้งหมด</button>
              </div><?php } ?>
		</form>
		<!--<br>
		<p style="font-size: 13px"><strong>* หมายเหตุ</strong></p>
		<p style="font-size: 13px">
		<ul>
			<li><strong>ปุ่ม Save</strong> หมายถึง รายการที่เรียบร้อยแล้วให้กดปุ่มจัดเก็บ เพื่อแสดงยอดรายได้ในรายงานรายได้ หากไม่จัดเก็บจะไม่แสดงในรายงาน / สถานะรอชำระเงิน จะไม่สามารถกดปุ่มจัดเก็บได้</li>
			<li><strong>ปุ่ม Detail</strong> หมายถึง ในกรณีที่ลูกค้าจองผ่านหน้าเว็บไซต์ แต่ยังไม่ได้ชำระเงิน โดยจะชำระหน้าเคาน์เตอร์ในวันที่เข้าพัก แอดมินสามารถเลือกวิธีการรับชำระเงิน และกดบันทึก ระบบจะส่งอีเมล์หาลูกค้าเพื่อออก voucher </li>
			<li><strong>ปุ่ม Cancel</strong> หมายถึง ในกรณีที่ออก Voucher เรียบร้อยแล้ว และต้องการยกเลิก แอดมินสามารถกดปุ่มยกเลิกได้ทันที ห้องพักก็จะว่างเพิ่มขึ้นอัตโนมัติ</li>
			<li><strong>ปุ่ม Delete</strong> หมายถึง การลบข้อมูลในกรณีที่ลูกค้าไม่ได้ทำการชำระเงิน / หมดเวลาการชำระเงิน  / จองเพื่อดูราคา  แอดมินสามารถลบได้ทันที</li>
		</ul>
		</p>-->
	</div>	
	<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
				var myTable = $('#dynamic-table').DataTable({
					"bAutoWidth": false,
					"iDisplayLength": 15 ,
					"info": false ,
					"ordering": false ,
					//"ordering": false ,
					select: {
						style: 'multi'
					}
			    } );

		
			})  
			
			$(document).ready(function(){
				$('.removeClass').removeClass('odd');
				$('.removeClass').removeClass('even');
				
				//$.post("check.php");
			})			
	</script>
	</div><!-- /.row -->                                 
<!-- /.page-content --><?php //include('testDD2.php');  ?>


</div><?php  $today = date("Y-m-d"); 

			$queryDel="SELECT * FROM tbl_hotel_booking WHERE `booking_date` < '".$today."' - INTERVAL 2 DAY AND booking_first_name =  '' AND booking_status =  '0' ";
			$resultDel=mysqli_query($link,$queryDel);
	  		while($Del=mysqli_fetch_assoc($resultDel)){
		  
				$queryDel2="DELETE FROM tbl_hotel_booking_detail WHERE order_id = '".$Del['order_id']."' ";
				mysqli_query($link,$queryDel2);
				
				$queryDelEX="DELETE FROM tbl_book_Extra_Service WHERE order_id = '".$Del['order_id']."' ";
				mysqli_query($link,$queryDelEX);
	  		}							
				
	  		$queryDel3="DELETE FROM tbl_hotel_booking WHERE `booking_date` < '".$today."' - INTERVAL 2 DAY AND booking_first_name =  '' AND booking_status =  '0' ";
	  		mysqli_query($link,$queryDel3); ?>