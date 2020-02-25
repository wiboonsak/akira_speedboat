<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Travelcontroller extends CI_Controller {
    function __construct() {
        parent::__construct(); 
        $this->load->model('Package_model');
        $this->load->model('transport_model');
        $this->load->model('Partner_api_model');
    }
    //-------------------	
    public function index() {
		echo "hahaha, please go back index :)";
    }
	//------------------- 
	public function getroute(){
		
		$dataGoArray = explode("/",$this->input->post('dateGo'));
		$data['dateGo'] =date("d M Y", strtotime($dataGoArray[2]."-".$dataGoArray[1]."-".$dataGoArray[0]));
		
		if($this->input->post('dateReturn')!='0'){
			$dataReturnArray = explode("/",$this->input->post('dateReturn'));
			$data['dateReturn'] =date("d M Y", strtotime($dataReturnArray[2]."-".$dataReturnArray[1]."-".$dataReturnArray[0]));
			$returnDate = $dataReturnArray[2]."-".$dataReturnArray[1]."-".$dataReturnArray[0];
		}else{
			$data['dateReturn']='';
			$returnDate = '';
		}
		
		$departDate = $dataGoArray[2]."-".$dataGoArray[1]."-".$dataGoArray[0];
		
				
		$data['idFrom'] = $this->input->post('idFrom');
		$data['idTo'] = $this->input->post('idTo');
		$data['Adults'] = $this->input->post('Adults');
		$data['Children'] = $this->input->post('Children');
		$data['travelRound'] = $this->input->post('travelRound');
		$data['FromLocationName']= $this->input->post('routeName');
		$data['ToLocationName']= $this->input->post('placeName');
		//----------------------------------- 
		//echo "idFrom->".$idFrom." idTo->".$idTo." dateGo->".$dateGo." dateReturn->".$dateReturn." Adults->".$Adults." Children->".$Children; 
		//------get travel go----------------
		$data['travelGo']=$this->transport_model->getRouteData($data['idFrom'],$data['idTo'],$departDate);
		//-----get travel return----------------
		$data['travelReturn']=$this->transport_model->getRouteData($data['idTo'],$data['idFrom'],$returnDate);
		
		$this->load->view('package/fontend/RouteSelect',$data);
		
	}
	
	//-------------------RouteID , TimetableID detailRoute 
	public function timetable_detail(){
		$data['RouteID'] = $this->input->post('RouteID');
		$data['TimetableID'] = $this->input->post('TimetableID');
		$data['partner_id'] = $this->input->post('partner_id');
		$data['NAdult'] = $this->input->post('NAdult');
		$data['NChild'] = $this->input->post('NChild');
		
		//$data['TimeTableDetail']=$this->transport_model->TimeTableDetail($data['RouteID'],$data['TimetableID'],$data['partner_id']);
		
		//echo "Process Code & Data partner_id->".$data['partner_id']." TimetableID->".$data['TimetableID']."<br><hr>";
		
		if($data['partner_id']=='1'){
			$data['detailRoute']=$this->transport_model->getRouteDetail($data['RouteID'],$data['TimetableID']);	
			$this->load->view('package/fontend/RouteDetail',$data);
		}else{
			$data['detailRoute']=$this->transport_model->getRoutePartnerDetail($data['RouteID'],$data['TimetableID']);	
			$this->load->view('package/fontend/RouteDetail',$data);
		}
		
		
	}
	//-------------------
	public function travelBookingForm(){
		$this->load->view('package/fontend/RoutebookingForm');
	}
	
	//-------------------
	public function sumaryBooking(){
	
		$data['NAdult']=$this->input->post('NAdult');
		$data['NChild']=$this->input->post('NChild');
		$data['travelRound']=$this->input->post('travelRound');
		$data['TimeIDGo']=$this->input->post('TimeIDGo');
		$data['DTotalPrice']=$this->input->post('DTotalPrice');
		$data['DAdultPrice']=$this->input->post('DAdultPrice');
		$data['DChildPrice']=$this->input->post('DChildPrice');
		$data['TimeIDBack']=$this->input->post('TimeIDBack');
		$data['RTotalPrice']=$this->input->post('RTotalPrice');
		$data['RAdultPrice']=$this->input->post('RAdultPrice');
		$data['RChildPrice']=$this->input->post('RChildPrice');
		
		//------------------------------------------------dateReturn ReturnDepartTime dateReturn DepartTotalAdult
		$data['departName']=$this->input->post('departName');
		$data['dateGo']=$this->input->post('dateGo');
		$data['DepartTime']=$this->input->post('DepartTime');
		$data['DepartDuration']=$this->input->post('DepartDuration');
		$data['DepartTotalAdult']=$this->input->post('DepartTotalAdult');
		$data['DepartTotalChildren']=$this->input->post('DepartTotalChildren');
		$data['DepartTotalPrice']=$this->input->post('DepartTotalPrice');
		
		$data['returnName']=$this->input->post('returnName');
		$data['backDate']=$this->input->post('backDate');
		$data['ReturnDepartTime']=$this->input->post('ReturnDepartTime');
		$data['ReturnDuration']=$this->input->post('ReturnDuration');
		$data['ReturnTotalAdult']=$this->input->post('ReturnTotalAdult');
		$data['ReturnTotalChildren']=$this->input->post('ReturnTotalChildren');
		$data['ReturnTotalPrice']=$this->input->post('ReturnTotalPrice');
		
		$data['AllTotalPrice']=$this->input->post('AllTotalPrice');
		
		$data['bookingData']=$this->transport_model->getTransportBookingDetail();

		$this->load->view('package/fontend/RoutebookingSumary',$data);
		
		
	}
	//-------------------
	public function paymentForm(){
		$data['bookData'] = $this->transport_model->getTransportBookingDetail();
		$this->load->view('package/fontend/paymentForm',$data);
	}
	//-------------------
	public function addTravelBooking(){
		$FormValue = $this->input->post('allData');
		$params = array();
		parse_str($FormValue, $params);
		//print_r($params);
		$result = $this->transport_model->addtravelBooking($params);
		//echo $result;
		print_r($result);
	}
	
 //-------------------
	public function payBytransfer(){
		$booking_status='1';
		$payment_status="0";
		$payment_type="2";
		$result=$this->transport_model->addPaymentStatus($booking_status,$payment_status,$payment_type);
		if($result['pass']==1){
			$this->load->view('package/fontend/transfer_money_detail');
			$this->linenotify($result['booking_no']);
		}else{
			echo $result['pass'];
		}
		
	}
 //-------------------
	public function payByPaypal(){
		$booking_status='1';
		$payment_status="0";
		$payment_type="1";
		
	}
 //-------------------
 public function linenotify($booking_no){
	  	   //---------line notify----------------//
			$DataID = $this->transport_model->findTranbookID($booking_no);
	       
	 		$data['DataID'] = $DataID;
			$booking_status='all';
			$payment_status='all';
			$payment_type='all';
			$partner_id ='all';
			$dateStart='all';
			$dateEnd='all';
		
			$data['checkinData'] =$this->transport_model->transport_booking_list($booking_status,$payment_status,$payment_type,$partner_id,$dateStart,$dateEnd,$data['DataID']);
		    foreach($data['checkinData']->result() AS $data){}
	        if($data->payment_type=='1'){
				$txtPayment = 'credit card';
			}else  if($data->payment_type=='2'){
				$txtPayment = 'transfer money';
			}
	 
	        if($data->travelRound=='oneWay'){
				 $txttravelRound = "One way";
			}else  if($data->travelRound=='return'){
				$txttravelRound = "Round trip";
			}
	 
	 		 if($data->payment_status=='1'){
				$txtPaymentStatus = "Success";
			 }else  if($data->payment_status=='0'){
				$txtPaymentStatus = "Pending";
			 }
	       
		        //$xhtmlDetail = $this->load->view('package/backend/bookingTransport_for_line',$data);
  		       //ini_set('display_errors', 1);
				//ini_set('display_startup_errors', 1);
				//error_reporting(E_ALL);
				date_default_timezone_set("Asia/Bangkok");

				$sToken = "FOwz8Bmqootv7n0s4EeWmiJXxJ8cQKPbw8TbGotc80R";
				///$sMessage = "รายการจอง akira-speedboat";
	            
	 
	 			$sMessage ="\n Booking_no : ".$data->booking_no
					      ."\n Trip typ :  ".$txttravelRound
					      ."\n Name : ".$data->cust_name." ".$data->cust_lastname
						  ."\n Telphone : ".$data->cust_telephone_num.",  Email : ".$data->cust_email." , Line : ".$data->line_id
					      ."\n Adult : ".$data->NAdult." , Child : ".$data->NChild
	 					  ."\n Depart : ".$data->departName."  ".$data->dateGo." ".$data->DepartTime
					      ."\n Return : ".$data->returnName."  ".$data->backDate." ".$data->ReturnDepartTime
					      ."\n Payment by : ".$txtPayment
					      ."\n Payment Status : ".$txtPaymentStatus
					      ."";

	            $chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					//echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne );   
	            
	            //------------send mail-----------------//
				$this->EmailtoUser($DataID,$booking_no);
		  
 }
	 //----------------------------------
	public function chBookStatus(){
		$booking_status=$this->input->post('booking_status');
		$DataID=$this->input->post('DataID');
		
		$result = $this->transport_model->chTransportBookStatus($booking_status,$DataID);
		echo $result;
	}
	//-------------------
	public function confirmTransportPayment(){
		$DataID = $this->input->post('DataID');
		$booking_no = $this->input->post('bookingNo');
		$payment_status = $this->input->post('payment_status');
		$result = $this->transport_model->confirmTransportBookPayment($DataID,$payment_status);
		
		if($result==1){
		  	$this->EmailtoUser($DataID,$booking_no);			
		}
		
		echo $result; 
	}
	//-----------------------------------
	public function EmailtoUser($booking_id,$booking_no){
		    //----------select data---------------
			$data['DataID'] = $booking_id;
			$booking_status='all';
			$payment_status='all';
			$payment_type='all';
			$partner_id ='all';
			$dateStart='all';
			$dateEnd='all';
		
			$data['checkinData'] =$this->transport_model->transport_booking_list($booking_status,$payment_status,$payment_type,$partner_id,$dateStart,$dateEnd,$data['DataID']);
		    foreach($data['checkinData']->result() AS $data){}
		
	        if($data->payment_type=='1'){
				$txtPayment = 'credit card';
			}else  if($data->payment_type=='2'){
				$txtPayment = 'transfer money';
			}
	 
	        if($data->travelRound=='oneWay'){
				 $txttravelRound = "One way";
			}else  if($data->travelRound=='return'){
				$txttravelRound = "Round trip";
			}
	 
		
	 		 if($data->payment_status=='1'){
				$txtPaymentStatus = "Success";
			 }else  if($data->payment_status=='0'){
				$txtPaymentStatus = "Pending";
			 }
			
			$htmlContent='';
		    $htmlContentFooter='';
		
		
			$cust_name=$data->cust_name;
		    $cust_lastname=$data->cust_lastname;
			$cust_email=$data->cust_email;
			$cust_telephone_num=$data->cust_telephone_num;
			$lineID=$data->line_id;
			$booking_no=$data->booking_no;
		
			if(($data->payment_type=='2')&&($data->payment_status=='0')){
				///$htmlContent = '<table class="table" border="0" width="100%" cellpadding="5">';
				//$htmlContent .='<tr><td  valign="top">';
				//$htmlContent .='<p style="font-size:20pt; color:orange"><img src="'.base_url('assets/images/mark.png').'" align="left" style="width:40px;height:auto"><strong>&nbsp;&nbsp;Booking Pending</strong></p>';
				//$htmlContent .='<p>Please Note Booking is in Pending only, will be Confirmed Only after receiving the Payment.</p>';
				//$htmlContent .='<p style="color:red;font-size: 14pt;"><strong>Booking Code :'.$booking_no.'</strong></p>';
				//$htmlContent .='<p>Thanks for choosing Akiraspeedboat.com</p>';
				//$htmlContent .='</td><td valign="top"><img src="'.base_url('assets/images/booking_online.jpg').'" style="width:250px; height:auto"></td></tr></table>';
				//  $cust_name." ".$cust_lastname  $cust_email $cust_telephone_num
				
				$htmlContent.='<table class="table" border="0" width="100%" cellpadding="5">
				<tbody>
				
				<tr>
				<td  valigh="top">
				  <img src="'.base_url('assets/images/booking_online.png').'">
				</td>
				</tr>
				<tr>
				<td valigh="top">
				 		  <div>Customer name : '.$cust_name." ".$cust_lastname.'<br>
						   Email : '.$cust_email.'<br>
						   Telelphone no. : '.$cust_telephone_num.'<br>
						   LINE ID. : '.$lineID.'</br>
						  </div>			  
				  </td>
				  <td  valigh="top" style="color:orange">
					 <div><strong style="color:red;font-size:16px;">Booking Code : '.$booking_no.'</strong></div>
					 <strong><img src="'.base_url('assets/images/mark.png').'" style="width:30px;height:auto;padding-right:10px;" align="left" valign> Booking Pending</strong>
				     <br>
				     Please Note Booking is in Pending only , will be Confirmed Only after receiving the Payment.
				 </td>
				</tr>
				
				</tbody>
				</table>';
				
				
				$htmlContentFooter ='<br> <table class="table table-bordered table-hover">
                  <tr style="background-color:#BCBCBC">
                   <th style="background-color:#BCBCBC">BANK NAME</th>
                   <th style="background-color:#BCBCBC">ACCOUNT NAME</th>
                   <th style="background-color:#BCBCBC">ACCOUNT NO.</th>
                   <th style="background-color:#BCBCBC">SWIFT CODE</th>
                 </tr>
                 <tr>
                  <td>Kasikorn Bank</td>
                  <td>นาย แมนเมธี จิระโร</td>
                  <td>049-3-99382-8</td>
                  <td>KASITHBK</td>
                </tr>
               <tr>
                   <td colspan="2">
					  <img src="'.base_url('assets/images/qu-code.jpg').'" style="width:300px; height:auto" alt="Akira Speedboat" title="qrcode ชำระเงิน" />
					</td>
					<td valign="top">
					 <h4>วิธีเเจ้งการชำระเงิน (เลือกข้อใดข้อหนึ่ง)</h4>
						  	<p>หลักฐานการชำระเงินที่คุณชำระเงินเข้ามาแล้ว รบกวนถ่ายรูป Capture หรือเก็บสลิปเอาไว้ยืนยันการชำระเงิน เพื่อใช้ในการแจ้งให้เราทราบ</p>
						  		<ol>
									<li>โทรเเจ้งยอดชำระกับทางเจ้าหน้าที่ที่เบอร์  +66 (0) 98 161 6164</li>
									<li>ส่งหลักฐานการการชำระ มาที่อีเมล์ booking@akiraspeedboat.com พร้อมระบุชื่อ นามสกุล, เบอร์โทรศัพท์ติดต่อกลับ</li>
                                    <li>ส่งหลังฐานไปทาง live chat messenger มุมขวาล่าง ของหน้าเว็บไซต์</li>
						  		</ol>
					</td>
               </tr> 
</table>';
			}else if(($data->payment_type=='2')&&($data->payment_status=='1')){  //
				
				//$htmlContent = '<table class="table" border="0" width="100%" cellpadding="5">';
				//$htmlContent .='<tr><td>';
				//$htmlContent .='<p style="font-size:20pt; color:green"><strong><img src="'.base_url('assets/images/check.png').'" align="left" style="width:40px;height:auto">&nbsp;Booking Confirm</strong></p>';
				//$htmlContent .='<p>Please Note Booking is confirm</p>';
				//$htmlContent .='<p style="color:red;font-size: 14pt;"><strong>Booking Code :'.$data->booking_no.'</strong></p>';
				//$htmlContent .='<p>Thanks for choosing Akiraspeedboat.com</p>';
				//$htmlContent .='</td><td valign="middle"><img src="http://www.akiralipe.com/travel/img/booking_online.jpg" style="width:250px; height:auto"></td></tr></table>';   
				
				
			
				$htmlContent.='<table class="table" border="0" width="100%" cellpadding="5">
				<tbody>
				
				<tr>
				<td  valigh="top">
				  <img src="'.base_url('assets/images/booking_online.png').'">
				</td>
				</tr>
				<tr>
				<td valigh="top">
				 		  <div>Customer name : '.$cust_name." ".$cust_lastname.'<br>
						   Email : '.$cust_email.'<br>
						   Telelphone no. : '.$cust_telephone_num.'<br>
						   LINE ID. : '.$lineID.'</br>
						  </div>			  
				  </td>
				  <td  valigh="top" style="color:green">
					 <div><strong style="color:red;font-size:16px;">Booking Code : '.$booking_no.'</strong></div>
					 <strong><img src="'.base_url('assets/images/check.png').'" style="width:30px;height:auto;padding-right:10px;" align="left" valign> Booking Confirm</strong>
				     <br>
				     Thanks for choosing Akiraspeedboat.com
				 </td>
				</tr>
				
				</tbody>
				</table>';
				
			
			}
			
		    
		     
		    $departName=$data->departName;
			$dateGo=$data->dateGo;
		    $DepartTime=$data->DepartTime;
			$DepartDuration=$data->DepartDuration;
			$DepartTotalAdult=$data->DepartTotalAdult;
			$DepartTotalChildren=$data->DepartTotalChildren;
			$DepartTotalPrice=($data->DAdultPrice*$data->NAdult)+($data->DChildPrice*$data->NChild);
		    $DepartTotalPriceTXT = number_format($DepartTotalPrice,2);
			
			$returnName = $data->returnName;
			$backDate = $data->backDate;
			$ReturnDepartTime = $data->ReturnDepartTime;
			$ReturnDuration = $data->ReturnDuration;
			$ReturnTotalAdult = $data->ReturnTotalAdult;
			$ReturnTotalChildren = $data->ReturnTotalChildren;
		    $ReturnTotalPrice = ($data->RAdultPrice*$data->NAdult)+($data->RChildPrice*$data->NChild);
		    $ReturnTotalPriceTXT = number_format($ReturnTotalPrice,2);
		
		    $NAdult = $data->NAdult;
		    $NChild = $data->NChild;
		    $AllTotalPrice = number_format($DepartTotalPrice+$ReturnTotalPrice,2);
			
		    if($data->return_checkin=='0'){  $data->return_checkin=''; } 
		    if($data->depart_checkin=='0'){  $data->depart_checkin=''; } 
		
		        $htmlContent .='<table class="table" width="100%" cellspacing="0" cellpadding="0" >
													
													<tr>
														<td colspan="2" style="background-color:#E1E1E1">DEPART:</td>
													</tr>
													<tr>
														<td colspan="2"><strong>'.$departName.'</strong>&nbsp;&nbsp;
												    <span style="color:red;font-size: 12px;" >'.$dateGo.' </span>
														<span id="DepartTime">'.$DepartTime.'</span></td>
													</tr>
												
													<tr>
													  <td>Duration:</td>
													  <td align="right">'.$DepartDuration.'</td>
													</tr>
													<tr>
														<td>Adult '.$data->DAdultPrice.' x '.$NAdult.'</td>
														<td align="right">'.$DepartTotalAdult.'</td> 
													</tr>
													<tr>
														<td>Children '.$data->DChildPrice.' x '.$NChild.'</td>
														<td align="right">'.$DepartTotalChildren.'</td>
													</tr>
													<tr>
														<td>Total depart :</td>
														<td align="right">'.$DepartTotalPriceTXT.'</td>
													</tr>';
		 				     if($data->payment_status=='1'){
								 					$htmlContent .='<tr><td colspan="2">depart check in : '.$data->depart_checkin.'</td></tr>';
							 }				
						
		
		
		                  if($data->travelRound=='return'){ 
			  	  					$htmlContent = $htmlContent.'<tr>
														<td colspan="2" style="background-color:#E1E1E1">RETURN:</td>
													</tr>
													<tr>
														<td colspan="2">														
														<strong>'.$returnName.'</strong>&nbsp;&nbsp;
												    <span style="color:red;font-size: 12px;" >'.$backDate.'</span>
														<span id="DepartTime">'.$ReturnDepartTime.'</td>
													</tr> 
													<tr>
													  <td>Duration:</td>
													  <td align="right">'.$ReturnDuration.'</td>
													</tr>
													<tr>
														<td>Adult '.$data->RAdultPrice.' x '.$NAdult.'</td>
														<td align="right">'.$ReturnTotalAdult.'</td> 
													</tr>
													<tr>
														<td>Children '.$data->RChildPrice.' x '.$NChild.'</td>
														<td align="right">'.$ReturnTotalChildren.'
														</td>
													</tr>
													<tr>
														<td>Total return :</td>
														<td align="right">
															 '.$ReturnTotalPriceTXT.'
														</td>
													</tr>
									';
				   if($data->payment_status=='1'){
								 					$htmlContent .='<tr><td colspan="2">return check in : '.$data->return_checkin.'</td></tr>';
					}	
			   }
		
			$htmlContent .='<tr style="background-color:orange;"><td height="40"><strong>TOTAL PRICE :</strong></td><td align="right">'.$AllTotalPrice.'</td></tr></table>';
		
		   $htmlContent=$htmlContent.$htmlContentFooter;
		    //------------------------------------
	 		//$this->load->library('email');
	       	//$htmlContent = '<h1>HTML email with attachment testing by CodeIgniter Email Library</h1>'; 


			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			$this->email->to($data->cust_email);
			$this->email->from('mailsender@akiraspeedboat.com','Akira Speedboat');
			$this->email->subject('ใบยืนยันการจองตั๋วเรือ Akiraspeedboat.com - หมายเลขการจอง ID : '.$data->booking_no);
			$this->email->message($htmlContent);
			//$this->email->attach('files/attachment.pdf');
			 //if($data->payment_status=='1'){
		    $this->email->send();
			// }
	       //------------------------------------------------//  
	}
	//-----------------------------------
	 //-------------------
	public function sendmail(){
            
		$booking_status='1';
		$payment_status="1";
		$payment_type="4";
                
		$result=$this->transport_model->addPaymentStatus($booking_status,$payment_status,$payment_type);
		if($result['pass']==1){
                        $data['booking_no']=$result['booking_no'];
                        $this->load->library('Pdf');
                        $this->load->view('package/fontend/payment_detail_pdf' , $data);
			//$this->sendmailtouser($result['booking_no']);
		}
		
	}
	 //-------------------
	public function sendmailtouser($booking_no){
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
                
		$from_email = 'booking@akiraspeedboat.com';
		$subject = "Akira Speedboat - Transport Booking ID # $Data->booking_no ";		
		//$to_email = $editor_data2->email;
		//$to_email = $emaildata;
		$to_email = $Data->cust_email;
		$email_body = '<html>
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
		 <div class="row">
			   <div class="col-md-5">
					<span>
                          <img src="http://www.ok-demo.com/akira_speedboat/images/logo-header.png" alt="" width="90%" style="text-align:center" >
           			</span>
				
				</div>
			   <div class="col-md-7" style="vertical-align:middle; padding-top: 20PX;">
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
                    </div>
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
		
//		$this->email->from($from_email, 'Booking Package Moonlight Travel'); 
//        $this->email->to($to_email);
//        $this->email->subject($subject); 
//       	$this->email->message($email_body); 
//        //Send mail 
//		//$this->email->send();  
//		if($this->email->send()){ 
                    $subject = "Akira Speedboat - Transport Booking ID # $Data->booking_no ";			
                    $this->email->from($from_email, 'Akira Speedboat - Transport Booking ID # '.$Data->booking_no.''); 
        $this->email->to($to_email);
        $this->email->subject($subject); 
       	$this->email->message($email_body); 
        if($this->email->send()){ 
	 header("location:".base_url('Welcome/index'));			
        }else{
            echo 1;
        }
        }
        
        //////
//         //-------------------
//	public function bookingPDF($booking_no){
//         	$txt = '';
//		/*$emaildata = $this->input->post('email');
//		$typedata = $this->input->post('type');
//		$userID = $this->input->post('userID');*/					
//             $checkinData2 = $this->transport_model->getbooking($booking_no);
//             foreach($checkinData2->result() as $Data1){}
//
//                $DataID = $Data1->id;
//		$booking_status = $Data1->booking_status;
//		$payment_status = 'all';
//		$payment_type = 'all';
//		$partner_id = 'all';
//		$dateStart = 'all';
//		$dateEnd = 'all';
//		$checkinData = $this->transport_model->transport_booking_list($booking_status,$payment_status,$payment_type,$partner_id,$dateStart,$dateEnd,$DataID);
//                
//                foreach($checkinData->result() AS $Data){}
//
//      if($Data->booking_status=='1'){
//		  $txtbookStatus='<span class="text-primary">ยืนยันสั่งจอง</span>';
//	  }else if($Data->booking_status=='2'){
//		   $txtbookStatus='<span class="text-success">ประวัติสั่งจอง</span>';
//	  }else if($Data->booking_status=='3'){
//		   $txtbookStatus='<span class="text-danger">ยกเลิกสั่งจอง</span>';
//	   }else if($Data->booking_status=='4'){
//		   $txtbookStatus='<span class="text-danger">รายการลบคำสั่งจอง</span>';
//	  }
//          if($Data->travelRound=='return'){ $txt = "ไป-กลับ";}else if($Data->travelRound=='oneWay'){ $txt = "เทียวเดียว";}
//                
//		$html = '<html>
//<head>
//<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
//<title>Booking Package</title>
//<style>
//	body{
//		margin: 15px 0px 0px;
//		
//	}
//	tr td{
//		font-family: tahoma, serif;
//		font-size: 10pt;
//		color: #56201D; 
//	}
//        .card{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(0,0,0,.125);border-radius:.25rem}
//        .card-body{-ms-flex:1 1 auto;flex:1 1 auto;padding:1.25rem}
//        .card-title{margin-bottom:.75rem}
//        .col-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}.col-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}.col-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}
//        .col-md-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}
//        .table{width:100%;max-width:100%;margin-bottom:1rem;background-color:transparent}
//        .text-danger{color:#dc3545!important}
//        .row{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}
//        .bg-danger{background-color:#dc3545!important}
//        .text-white{color:#fff!important}
//        .text-primary{color:#007bff!important}
//</style>
// 			
//</head>
//<body>
//<div class="" style="margin-top: -20px;">
//  	<div class="">
//		 
//			<h5 class="">รายละเอียดลูกค้า</h5>
//		
//		    <div class="row">
//				<div class="col-4" style="text-align: right">ชื่อลูกค้า : </div>
//				<div class="col-8">'.$Data->cust_name.' '.$Data->cust_lastname.'</div>
//		    </div>	
//			 <div class="row">
//				<div class="col-4"  style="text-align: right">โทรศัพท์ :</div>
//				<div class="col-8"> <a href="tel: '.$Data->cust_telephone_num.'">
//												'.$Data->cust_telephone_num.' 
//												</a>		
//				</div>
//		    </div>	
//		    <div class="row">
//				<div class="col-4"  style="text-align: right">Email : </div>
//				<div class="col-8">'.$Data->cust_email.'</div>
//		    </div>	
//		   <div class="row">
//				<div class="col-4"  style="text-align: right">ID LINE : </div>
//				<div class="col-8">'.$Data->line_id.'</div>
//		    </div>	
//		  
//
//		<hr>
//		
//                <h5 class="">ข้อมูลหมายเลขการจอง : <span class="text-danger">'.$Data->booking_no.'</span>&nbsp;วันที่จอง : '. $Data->date_booking.'&nbsp;<small class="text-primary">'.$txt.'</small></h5>
//		
//		
//			<div class="row">
//				
//				<!--<div class="col-md-6">-->
//					<div style="width:50%">
//					<table class="table" width="100%">
//						<tr>
//							<td colspan="2" style="background-color:#E1E1E1; ">DEPART : <span class="text-danger">'.$Data->departName.'</span></td>
//						</tr>
//						<tr>
//							<td >TIME :</td>
//							<td align="right">	
//						    <span style="color:red;font-size: 12px;" >'.$Data->dateGo.' </span>
//							<span >'. $Data->DepartTime.'</span></td>
//						</tr>
//
//						<tr>
//						  <td>Duration:</td>
//						  <td align="right">'. $Data->DepartDuration.'</td>
//						</tr>
//						<tr>
//							<td>Adult x '. $Data->NAdult.'</td>
//							<td align="right">'. $Data->DepartTotalAdult.'</td> 
//						</tr>
//						<tr>
//							<td>Children x '. $Data->NChild.'</td>
//							<td align="right">'. $Data->DepartTotalChildren.'</td>
//						</tr>
//						<tr>
//							<td>Total depart :</td>
//							<td align="right">
//							'.  number_format($Data->totalDepartPrice,2).'
//
//							</td>
//						</tr> 
//					</table>
//					
//					
//				</div>
//				
//				
//				<!--<div class="col-md-6">-->
//					<div style="width:50%">
//					<table class="table" width="100%">
//													<tr>
//														<td colspan="2" style="background-color:#E1E1E1">RETURN : <span class="text-danger">'. $Data->returnName.'</span></td>
//													</tr>
//													<tr>
//														<td >Time:	</td>													
//														<td align="right">
//												         <span style="color:red;font-size: 12px;" >'. $Data->backDate.' </span>
//														<span id="DepartTime">'. $Data->ReturnDepartTime.'
//														
//														
//														</td>
//													</tr> 
//													<tr>
//													  <td>Duration:</td>
//													  <td align="right">'. $Data->ReturnDuration.'</td>
//													</tr>
//													<tr>
//														<td>Adult x '. $Data->NAdult.'</td>
//														<td align="right">'. $Data->ReturnTotalAdult.'</td> 
//													</tr>
//													<tr>
//														<td>Children x '. $Data->NChild.'</td>
//														<td align="right">'. $Data->ReturnTotalChildren.'
//														</td>
//													</tr>
//													<tr>
//														<td>Total return :</td>
//														<td align="right">
//															 '. number_format($Data->totalReturnPrice,2).'
//														</td>
//													</tr>
//												</table>
//				
//				</div>
//			
//			</div>
//		  <div class="col-12 bg-danger text-white" style="padding: 10px; text-align: right" >
//		     Total Price : '. number_format(($Data->totalDepartPrice+$Data->totalReturnPrice),2).'
//			
//		  </div>
//		  
//		  <hr>
//		</div>
//	</div>
//</body>
//</html>';	 	
//$this->mpdf->SetDisplayMode('fullpage');
//$this->mpdf->list_indent_first_level = 0;
//$this->mpdf->WriteHTML($html, 2);
//$this->mpdf->Output('../../download/Booking_'.$booking_no.'.pdf');
//exit;
//    
//        }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
} //end class