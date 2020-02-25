<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class booking_pdf extends CI_Controller {
  public function __construct()
{
parent::__construct();
$this->load->library('mpdf');
}   //-------------------	
   public function index()
{
   $txt = '';
		/*$emaildata = $this->input->post('email');
		$typedata = $this->input->post('type');
		$userID = $this->input->post('userID');*/					
             $checkinData2 = $this->transport_model->getbooking($booking_no);
             foreach($checkinData2->result() as $Data1){}

                $DataID = $Data1->id;
		$booking_status = $Data1->booking_status;
		$payment_status = 'all';
		$payment_type = 'all';
		$partner_id = 'all';
		$dateStart = 'all';
		$dateEnd = 'all';
		$checkinData = $this->transport_model->transport_booking_list($booking_status,$payment_status,$payment_type,$partner_id,$dateStart,$dateEnd,$DataID);
                
                foreach($checkinData->result() AS $Data){}

      if($Data->booking_status=='1'){
		  $txtbookStatus='<span class="text-primary">ยืนยันสั่งจอง</span>';
	  }else if($Data->booking_status=='2'){
		   $txtbookStatus='<span class="text-success">ประวัติสั่งจอง</span>';
	  }else if($Data->booking_status=='3'){
		   $txtbookStatus='<span class="text-danger">ยกเลิกสั่งจอง</span>';
	   }else if($Data->booking_status=='4'){
		   $txtbookStatus='<span class="text-danger">รายการลบคำสั่งจอง</span>';
	  }
          if($Data->travelRound=='return'){ $txt = "ไป-กลับ";}else if($Data->travelRound=='oneWay'){ $txt = "เทียวเดียว";}
                
		$html = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Booking Package</title>
<style>
	body{
		margin: 15px 0px 0px;
		
	}
	tr td{
		font-family: tahoma, serif;
		font-size: 10pt;
		color: #56201D; 
	}
        .card{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(0,0,0,.125);border-radius:.25rem}
        .card-body{-ms-flex:1 1 auto;flex:1 1 auto;padding:1.25rem}
        .card-title{margin-bottom:.75rem}
        .col-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}.col-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}.col-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}
        .col-md-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}
        .table{width:100%;max-width:100%;margin-bottom:1rem;background-color:transparent}
        .text-danger{color:#dc3545!important}
        .row{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}
        .bg-danger{background-color:#dc3545!important}
        .text-white{color:#fff!important}
        .text-primary{color:#007bff!important}
</style>
 			
</head>
<body>
<div class="" style="margin-top: -20px;">
  	<div class="">
		 
			<h5 class="">รายละเอียดลูกค้า</h5>
		
		    <div class="row">
				<div class="col-4" style="text-align: right">ชื่อลูกค้า : </div>
				<div class="col-8">'.$Data->cust_name.' '.$Data->cust_lastname.'</div>
		    </div>	
			 <div class="row">
				<div class="col-4"  style="text-align: right">โทรศัพท์ :</div>
				<div class="col-8"> <a href="tel: '.$Data->cust_telephone_num.'">
												'.$Data->cust_telephone_num.' 
												</a>		
				</div>
		    </div>	
		    <div class="row">
				<div class="col-4"  style="text-align: right">Email : </div>
				<div class="col-8">'.$Data->cust_email.'</div>
		    </div>	
		   <div class="row">
				<div class="col-4"  style="text-align: right">ID LINE : </div>
				<div class="col-8">'.$Data->line_id.'</div>
		    </div>	
		  

		<hr>
		
                <h5 class="">ข้อมูลหมายเลขการจอง : <span class="text-danger">'.$Data->booking_no.'</span>&nbsp;วันที่จอง : '. $Data->date_booking.'&nbsp;<small class="text-primary">'.$txt.'</small></h5>
		
		
			<div class="row">
				
				<!--<div class="col-md-6">-->
					<div style="width:50%">
					<table class="table" width="100%">
						<tr>
							<td colspan="2" style="background-color:#E1E1E1; ">DEPART : <span class="text-danger">'.$Data->departName.'</span></td>
						</tr>
						<tr>
							<td >TIME :</td>
							<td align="right">	
						    <span style="color:red;font-size: 12px;" >'.$Data->dateGo.' </span>
							<span >'. $Data->DepartTime.'</span></td>
						</tr>

						<tr>
						  <td>Duration:</td>
						  <td align="right">'. $Data->DepartDuration.'</td>
						</tr>
						<tr>
							<td>Adult x '. $Data->NAdult.'</td>
							<td align="right">'. $Data->DepartTotalAdult.'</td> 
						</tr>
						<tr>
							<td>Children x '. $Data->NChild.'</td>
							<td align="right">'. $Data->DepartTotalChildren.'</td>
						</tr>
						<tr>
							<td>Total depart :</td>
							<td align="right">
							'.  number_format($Data->totalDepartPrice,2).'

							</td>
						</tr> 
					</table>
					
					
				</div>
				
				
				<!--<div class="col-md-6">-->
					<div style="width:50%">
					<table class="table" width="100%">
													<tr>
														<td colspan="2" style="background-color:#E1E1E1">RETURN : <span class="text-danger">'. $Data->returnName.'</span></td>
													</tr>
													<tr>
														<td >Time:	</td>													
														<td align="right">
												         <span style="color:red;font-size: 12px;" >'. $Data->backDate.' </span>
														<span id="DepartTime">'. $Data->ReturnDepartTime.'
														
														
														</td>
													</tr> 
													<tr>
													  <td>Duration:</td>
													  <td align="right">'. $Data->ReturnDuration.'</td>
													</tr>
													<tr>
														<td>Adult x '. $Data->NAdult.'</td>
														<td align="right">'. $Data->ReturnTotalAdult.'</td> 
													</tr>
													<tr>
														<td>Children x '. $Data->NChild.'</td>
														<td align="right">'. $Data->ReturnTotalChildren.'
														</td>
													</tr>
													<tr>
														<td>Total return :</td>
														<td align="right">
															 '. number_format($Data->totalReturnPrice,2).'
														</td>
													</tr>
												</table>
				
				</div>
			
			</div>
		  <div class="col-12 bg-danger text-white" style="padding: 10px; text-align: right" >
		     Total Price : '. number_format(($Data->totalDepartPrice+$Data->totalReturnPrice),2).'
			
		  </div>
		  
		  <hr>
		</div>
	</div>
</body>
</html>';	 	
$this->mpdf->SetDisplayMode('fullpage');
$this->mpdf->list_indent_first_level = 0;
$this->mpdf->WriteHTML($html, 2);
$this->mpdf->Output('../../download/Booking_'.$booking_no.'.pdf');
exit;    
}
    	
}

