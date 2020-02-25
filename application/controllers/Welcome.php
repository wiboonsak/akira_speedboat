<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    function __construct() {
        parent::__construct(); 
        $this->load->model('Package_model');
        $this->load->model('transport_model');
        $this->load->model('Partner_api_model');
    }
        //-------------------	
    public function index() {
		$data['routeData'] = $this->Package_model->getrouteList();
		
		$rout_active='1';
		$routeID='';
		//$partnerID='2';
		//$data['SPCrouteData'] = $this->Partner_api_model->spc_list_RouteWWW($rout_active,$routeID,$partnerID);
		
        $this->load->view('package/fontend/index' , $data);
    }
    //-------------------	
	public function testpage(){
		$this->load->view('package/fontend/RoutebookingSumary');
	}
	 //-------------------	
    public function package_list() {
        $this->load->view('package/fontend/package_list');
    }
        //-------------------	
    public function package_detail($currentid=null) {
        $data['currentID'] = $currentid;
        $this->load->view('package/fontend/package_detail',$data);
    }
             //-------------------	
    public function book_package($currentid=null) {
        $data['currentID'] = $currentid;
        $this->load->view('package/fontend/book_package',$data);
    }
             //-------------------	
    public function book_package_comfirm($currentid=null) {
        $data['currentID'] = $currentid;
        $this->load->view('package/fontend/book_package_comfirm',$data);
    }
             //-------------------	
    public function timetable() {
        $this->load->view('package/fontend/timetable');
    }
             //-------------------	
    public function payment() {
        $this->load->view('package/fontend/payment');
    }
             //-------------------	
    public function contact() {
        $this->load->view('package/fontend/contact');
    }
             //-------------------	
    public function charter_boat() {
        $partnerID = '1';
	$dataID ='';
         $data['listcharter'] = $this->transport_model->loadcharter($partnerID,$dataID);
        $this->load->view('package/fontend/charter_boat',$data);
    }
              //-------------------	
    public function landtransfer() {
        $partnerID = '1';
	$rout_active ='1';
	$routeID='';
         $data['listLand'] = $this->transport_model->listLand($rout_active,$routeID,$partnerID);
        $this->load->view('package/fontend/landtransfer',$data);
    }
             //-------------------	
    public function email_book_transport() {
        $this->load->view('package/fontend/email_book_transport');
    }
            //------------------------------- 	
    public function AddBooking() {
        $Departing = $this->input->post('Departing');
        $Adults = $this->input->post('Adults');
        $Children = $this->input->post('Children');
        $Name = $this->input->post('Name');
        $Last = $this->input->post('Last');
        $Email = $this->input->post('Email');
        $Line = $this->input->post('Line');
        $Phone = $this->input->post('Phone');
        $currentID = $this->input->post('currentID');
        $price = $this->input->post('price');
        $accept = $this->input->post('accept');
          if(($Departing != '')&&($Departing!= '0000-00-00')){
			
			$dateArray = explode("/",$Departing);
			$date= $dateArray[0];
			$mon= $dateArray[1];
			$year= $dateArray[2];			
			$Departing = $year."-".$mon."-".$date;
		/*} else {
			$txtWhere2 = '';*/
         }
        $keygroup = $this->Package_model->generateRandomString();
        $ch_keygroup = $this->Package_model->check_keygroup($keygroup);
        if($ch_keygroup >0){
            $keygroup = $this->Package_model->generateRandomString();
        }        
        $result_id = $this->Package_model->AddBooking($Departing, $Adults, $Children, $Name ,$Last,$Email,$Line,$Phone,$currentID,$price,$keygroup,$accept);
        if($result_id==1){$result_id = $keygroup;}
        echo $result_id;
//         '............................',$Departing,$Adults,$Children,$Name,$Last,$Email,$Line,$Phone;
    }
               //-------------------	
    public function email_book_package($keygroup=null) {
        $data['keygroup'] = $keygroup;
        $this->load->view('package/fontend/email_book_package',$data);
    }
    //-------------------
	public function send_mail(){	 
		$txt='';
		/*$emaildata = $this->input->post('email');
		$typedata = $this->input->post('type');
		$userID = $this->input->post('userID');*/		
		$keygroup = $this->input->post('keygroup');				
             $checkinData = $this->Package_model->getbooking($keygroup);
             foreach($checkinData->result() as $Data){} 
             if ($Data->cf_status == 1){ $txt='Pending';}else if($Data->cf_status == 2){ $txt='Confrim ';}else{ $txt='Cancel';}
             
             $table = 'tbl_package_booking';
		$key_value1 = $this->Package_model->generateRandomString();	
		$key_value3 = $this->Package_model->generateRandomString();	
		$date1 = date("d");
		$key_value2 = $key_value1.$keygroup.'#'.$date1.$key_value3;		
		
		$from_email = 'wiboonsak.suw@gmail.com';
		$subject = "Booking Package ใบแจ้งการจองแพ็คเกจ";		
		//$to_email = $editor_data2->email;
		//$to_email = $emaildata;
		$to_email = $Data->customer_email;
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
</style>
</head>
        <link href="'.base_url().'assets/css/icons.css" rel="stylesheet" type="text/css" />
                <link href="'.base_url().'assets/css/style.css" rel="stylesheet" type="text/css" />
                 <link href="'.base_url().'assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#EFEFEF">
  <tbody>
    <tr>
      <td bgcolor="#EFEFEF">
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td height="120" bgcolor="#E7E7E7"><img src="'.base_url().'images/email/logo.png" align="left" width="550" height="127" style="margin-top: -55px; padding-left: 15px;"></td>
      <td align="right" bgcolor="#E7E7E7"><img src="'.base_url().'images/email/promotion.png" width="167" height="58"  style="padding-right: 50px;" /></td>
    </tr>
    <tr>
      <td height="70" colspan="2" bgcolor="#E7E7E7"><table width="90%"  border="0" cellspacing="2" align="center" cellpadding="0" bgcolor="#FFFFFF">
        <tbody>
          <tr>
            <td width="19%" height="25" align="right"><strong>CUSTOMER NAME : </strong></td>
            <td height="25" colspan="5" align="left">'.$Data->customer_name.' '.$Data->customer_Lastname.'</td>
          </tr>
          <tr>
            <td height="25" align="right"><strong>TEL : </strong></td>
            <td width="19%" height="25" align="left">'.$Data->customer_telephone.'</td>
            <td width="9%" height="25" align="left"><strong>EMAIL : </strong></td>
            <td width="28%" height="25" align="left">'.$Data->customer_email.'</td>
            <td width="10%" height="25" align="left"><strong>ID LINE : </strong></td>
            <td width="15%" height="25" align="left">'.$Data->IDLine.'</td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td height="197" colspan="2" bgcolor="#E7E7E7"><table width="90%" align="center" border="0" cellspacing="4" cellpadding="0" bgcolor="#FFFFFF">
              
        <tbody>
          <tr>
            <td width="40%" height="25" align="right"><strong>PACKAGE BOOKING ID : </strong></td>
            <td width="62%" height="25" align="left">'.$keygroup.'</td>
          </tr>
          <tr>
            <td height="25" align="right"><strong>PACKAGE : </strong></td>
            <td height="25" align="left">'.$Data->package_name_en.'</td>
          </tr>
          <tr>
            <td width="40%" height="25" align="right"><strong>DEPARTING : </strong></td>
            <td height="25" align="left">'.$this->Package_model->GetEngDateTime1($Data->date_depart).'</td>
          </tr>
          <tr>
            <td width="40%" height="25" align="right"><strong>ADULT : </strong></td>
            <td height="25" align="left">'.$Data->customer_adult.'</td>
          </tr>
          <tr>
            <td width="40%" height="25" align="right"><strong>CHILDREN (3-10 YEARS) : </strong></td>
            <td height="25" align="left">'.$Data->customer_child.'</td>
          </tr>
            <tr>
            <td width="40%" height="25" align="right"><strong>PAYMENT TOTAL : </strong></td>
            <td height="25" align="left">'. number_format($Data->total_price).'</td>
          </tr>
          <tr>
            <td width="40%" height="25" align="right"><strong>STATUS : </strong></td>
            <td height="25" align="left">'.$txt.'</td>
          </tr>
          </tbody>
      </table></td>
    </tr>
    <tr>
      <td bgcolor="#B8B8B8"><img src="'.base_url().'images/email/address.png" align="left" width="287" height="97"/></td>
      <td align="right" bgcolor="#B8B8B8"><img src="'.base_url().'images/email/logo-header.png" style="padding-right: 50px;" /></td>
    </tr>
  </tbody>
</table>
</body>
</html>';	 	
		
//		$this->email->from($from_email, 'Booking Package Moonlight Travel'); 
//        $this->email->to($to_email);
//        $this->email->subject($subject); 
//       	$this->email->message($email_body); 
//        //Send mail 
//		//$this->email->send();  
//		if($this->email->send()){ 
                    $subject = "[For Admin] Booking Package ใบแจ้งการจองแพ็คเกจ";		
                    $this->email->from($from_email, 'Booking Package Moonlight Travel'); 
        $this->email->to($from_email);
        $this->email->subject($subject); 
       	$this->email->message($email_body); 
        if($this->email->send()){ 
		   	$result2 = 1;			
        }	
          	$result = $result2;  
       // }			
		echo $result;		
	}		
	//-------------------
        public function totaladult() {
        $Adults = $this->input->post('Adults');
        $currentID = $this->input->post('currentID');
        $result = $this->Package_model->totaladult($Adults,$currentID);
        echo $result;	
        
}
         //-----------------------------------------trip_list dateReturn 
    public function trip_list() { 
		
		redirect(base_url('Welcome/'), 'refresh');
		
        $Adults = $this->input->post('Adults');
        $Children = $this->input->post('Children');
        $Total = $Adults+$Children;
        $data['routedata'] = $this->input->post('routedata');
        $data['placedata'] = $this->input->post('placedata');
        $data['datedata'] = $this->input->post('datedata');
        $data['dateReturn'] = $this->input->post('dateReturn');
        $data['Adults'] = $Adults;
        $data['Children'] = $Children;
        $data['Total'] = $Total;
        $data['spanRoute'] = $this->input->post('spanRoute');
        $data['spanTo'] = $this->input->post('spanTo');
        $data['idroute'] = $this->input->post('idroute');
		
		$data['routeData'] = $this->Package_model->getrouteList();
		
		$rout_active='1';
		$routeID='';
		
		if(!isset($data['routedata'])){
			 redirect(base_url(), 'refresh');
		}else{ 
        	$this->load->view('package/fontend/trip_list',$data);
		}
		
    }
        //------------------dataID changeValue //
	public  function placedataupdate(){
		$changeValue = $this->input->post('changeValue');
		//$changeValueArray = explode(",",$changeValue);
		
		//$beginPlace = $changeValueArray[0];
		//$partnerID = $changeValueArray[1];
		
		$placeData = $this->input->post('placeData');
		
		$result = $this->Package_model->placedataupdate($changeValue);?>


                 <option value="">---Select---</option>
            <?php $select3 ='';    
            foreach ($result->result() as $result2){
                 if($result2->destination_place_id  == $placeData){ $select3 = 'selected';}?>
		<option value="<?php echo $result2->destination_place_id ?>"<?php echo $select3?>><?php echo $result2->place_name_en ?></option>
                <?php $select3 ='';  }
         }
	
	
      //------------------dataID changeValue //
	public  function transportDetail(){
		$transportID = $this->input->post('transportID');
		$transportData = $this->Package_model->list_transportData($transportID);
                foreach ($transportData->result() as $transportData2){}?>

	<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px; font-weight: bold;"><?php echo $transportData2->transport_name_en?> Information
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
		</h5>
      </div>
      <div class="modal-body">
		  
		  <div class="row">
    <!--<div><h5><?php //echo $transportData2->transport_name_en?> Information</h5></div>
    <div>--><p class="col-12" style="padding-left: 15px; padding-bottom: 15px;"><?php echo $transportData2->transport_info_en?></p>
        <?php  $imglist = $this->Package_model->loadImg3($transportID);
        foreach ($imglist->result() AS $data) {?>
    <!--<div >--><div class="col-12 col-sm-6"><img class="img-fluid" src="<?php echo base_url('uploadfile/').$data->images?>"></div><!--</div>
    </div>-->
                <?php }?>
               </div>
		  
        
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
    </div>
  </div>



        <?php }
     //---------------------------------
	public  function mapDetail(){
		$routeID = $this->input->post('routeID');
		$listRoute = $this->transport_model->listRoute($routeID);
                foreach ($listRoute->result() as $listRoute4){}?>

<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
		  <div class="row">
    <img src="<?php echo base_url('uploadfile/').$listRoute4->route_image?>" class="img-responsive">
               </div>
		  
        
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
    </div>
  </div>



        <?php }
      //------------------dataID changeValue //
	public  function selecttrip(){
                $timesid = $this->input->post('timesid');
                $transportid = $this->input->post('transportid');
                $priceAdults = substr($this->input->post('priceAdults'),1);
                $priceChildren = substr($this->input->post('priceChildren'),1);
                $pricetotal = $this->input->post('pricetotal');
                $Adults = $this->input->post('Adults');
                $Children = $this->input->post('Children');
                $datedata = $this->input->post('datedata');
                $routeid = $this->input->post('routeid');
                 if(($datedata != '')&&($datedata!= '0000-00-00')){
			
			$dateArray = explode("/",$datedata);
			$date= $dateArray[0];
			$mon= $dateArray[1];
			$year= $dateArray[2];			
			$datedata = $year."-".$mon."-".$date;
		/*} else {
			$txtWhere2 = '';*/
         }
        $keygroup = $this->Package_model->generateRandomString();
        $ch_keygroup = $this->Package_model->check_keygroup($keygroup);
        if($ch_keygroup >0){
            $keygroup = $this->Package_model->generateRandomString();
        }        
                $selecttrip = $this->Package_model->selecttrip($timesid,$transportid,$priceAdults,$priceChildren,$pricetotal,$Adults,$Children,$datedata,$routeid,$keygroup);
                 if($selecttrip == 1){$selecttrip = $keygroup;}
                echo $selecttrip;
         }
    //-------------------	
    public function book_transport($keygroub=null) {
        $data['keygroub'] = $keygroub;
        $this->load->view('package/fontend/book_transport',$data);
    }
                //------------------------------- 	
    public function AddBookingTransport() {
        $Name = $this->input->post('Name');
        $Last = $this->input->post('Last');
        $Email = $this->input->post('Email');
        $Line = $this->input->post('Line');
        $Phone = $this->input->post('Phone');
        $keygroub = $this->input->post('keygroub');
        $accept = $this->input->post('accept');
       
        $result_id = $this->Package_model->AddBookingTransport($Name ,$Last,$Email,$Line,$Phone,$keygroub,$accept);
        if($result_id==1){$result_id = $keygroub;}
        echo $result_id;
//         '............................',$Departing,$Adults,$Children,$Name,$Last,$Email,$Line,$Phone;
    }
    //-------------------	
    public function book_transport_comfirm($keygroub=null) {
        $data['keygroub'] = $keygroub;
        $this->load->view('package/fontend/book_transport_comfirm',$data);
    }    
       //-------------------
	public function send_mailtransport(){	 
		$txt=''; $r='';		
		$keygroup = $this->input->post('keygroup');	
                //echo '.................................'.$keygroup;
             $getbooking_title = $this->Package_model->getbooking_title($keygroup);
                        foreach ($getbooking_title->result() AS $getbooking_title2) { }
                        $adultstravel = $getbooking_title2->adult_traveller;
                        $childtravel = $getbooking_title2->child_traveller;
                        $totalpeople = $adultstravel+$childtravel;
             if ($getbooking_title2->cf_status == 1){ $txt='Pending';}else if($getbooking_title2->cf_status == 2){ $txt='Confrimed ';}else{ $txt='Cancel';}
              $route_id = $getbooking_title2->route_id;
          $list_route = $this->transport_model->listRoute($r,$route_id);
          foreach ($list_route->result() AS $list_route2) {}
          $list_placebegin = $this->Package_model->list_placeData($list_route2->begin_place_id);
                        foreach ($list_placebegin->result() AS $list_placebegin2) {}
           $list_placedes = $this->Package_model->list_placeData($list_route2->destination_place_id);
                        foreach ($list_placedes->result() AS $list_placedes2) {}
              $Routetype = $this->transport_model->get_routeType($route_id, $getbooking_title2->route_type_id, $r, 'yes', 'id');
foreach ($Routetype->result() as $Data){}
$dayofweek = date('l', strtotime($getbooking_title2->date_depart));
$times = $this->transport_model->get_timeDetail($r,$r,$r,$r,$getbooking_title2->time_id);	
						   //$numTime = $times->num_rows();
                                                   
						   //if($numTime >0){						   	
                                                                foreach($times->result() as $times2){}  
						   		$times1 = date('H:i', strtotime($times2->arrive_time.'+'.$Data->transfer_h_time.' hours'));	
						   		$times1 = date('H:i', strtotime($times1.'+'.$Data->transfer_m_time.' minutes'));
             $table = 'tbl_package_booking';
		$key_value1 = $this->Package_model->generateRandomString();	
		$key_value3 = $this->Package_model->generateRandomString();	
		$date1 = date("d");
		$key_value2 = $key_value1.$keygroup.'#'.$date1.$key_value3;		
		
		$from_email = 'wiboonsak.suw@gmail.com';
		$subject = "Booking Transport ใบแจ้งการจองเรือ";		
		//$to_email = $editor_data2->email;
		//$to_email = $emaildata;
		$to_email = $getbooking_title2->cust_email;
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
</style>
</head>
<body>      
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td height="120" bgcolor="#E7E7E7"><img src="'.base_url().'html/images/email/logo-trip.png" align="left" width="550" height="127" style="margin-top: -55px; padding-left: 15px;"></td>
      <td align="right" bgcolor="#E7E7E7"><img src="'.base_url().'html/images/email/promotion.png" width="167" height="58"  style="padding-right: 50px;" /></td>
    </tr>
    <tr>
      <td height="70" colspan="2" bgcolor="#E7E7E7"><table width="90%"  border="0" cellspacing="2" align="center" cellpadding="0" bgcolor="#FFFFFF">
        <tbody>
          <tr>
            <td width="19%" height="25" align="right"><strong>CUSTOMER NAME  :</strong></td>
            <td height="25" colspan="5" align="left">'.$getbooking_title2->cust_name.' '.$getbooking_title2->cust_lastname.'</td>
          </tr>
          <tr>
            <td height="25" align="right"><strong>TEL :</strong></td>
            <td width="19%" height="25" align="left">'.$getbooking_title2->cust_telephone_num.'</td>
            <td width="9%" height="25" align="left"><strong>EMAIL  :</strong></td>
            <td width="28%" height="25" align="left">'.$getbooking_title2->cust_email.'</td>
            <td width="10%" height="25" align="left"><strong>ID LINE :</strong></td>
            <td width="15%" height="25" align="left">'.$getbooking_title2->cust_line.'</td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td height="197" colspan="2" bgcolor="#E7E7E7">
       <table width="90%" align="center" border="0" cellspacing="4" cellpadding="0" bgcolor="#FFFFFF">
        <tbody>
          <tr>
            <td width="40%" height="25" align="right"><strong>BOOKING ID :</strong></td>
            <td width="62%" height="25" align="left">'.$keygroup.'</td>
          </tr>
          <tr>
            <td height="25" align="right"><strong>ROUTING :</strong></td>
            <td height="25" align="left">'.$list_placebegin2->place_name_en.'  to  '. $list_placedes2->place_name_en.'</td>
          </tr>
          <tr>
            <td width="40%" height="25" align="right"><strong>DEPARTING :</strong></td>
            <td height="25" align="left">'. $dayofweek.','. $this->Package_model->GetEngDateTime2($getbooking_title2->date_depart).'</td>
          </tr>
          <tr>  
            <td width="40%" height="25" align="right"><strong>TIME :</strong></td>
            <td height="25" align="left">'.$times2->arrive_time.' > '. $times1.'</td>
          </tr>
          <tr>
            <td width="40%" height="25" align="right"><strong>ADULT :</strong></td>
            <td height="25" align="left"> '.$adultstravel.'</td>
          </tr>
          <tr>
            <td width="40%" height="25" align="right"><strong>CHILDREN (3-10 YEARS) :</strong></td>
            <td height="25" align="left"> '. $childtravel.'</td>
          </tr>
          <tr>
            <td width="40%" height="25" align="right"><strong>PAYMENT TOTAL : </strong></td>
            <td height="25" align="left">'. number_format($getbooking_title2->total_price).' THB</td>
          </tr>
          <tr>
            <td width="40%" height="25" align="right"><strong>STATUS : </strong></td>
            <td height="25" align="left">'.$txt.'</td>
          </tr>
          
          <tr>
            <td colspan="2">
            	<!------ Trip Detail ------->         
       			<div style="margin:0 auto; padding: 10px; background-color: #FFFFFF; width: 84%">            
				 <h2 class="title-detail" style="color: #2f79b1;">Trip Details:</h2>
				 <!-- Accordion -->
					  <div class="panel-group no-margin" id="accordion">
								  <!-- Accordion 1 -->
								  <div class="panel">
									 <div id="collapseOne" class="panel-collapse collapse in" aria-labelledby="headingOne">';
                                                                         
                                                  $checkDetail = $this->transport_model->checkDetail($getbooking_title2->time_id);
                                                    $a =0; 
                                                 $priceArray = explode("/",$getbooking_title2->adult_price);
                                                 $priceArray2 = explode("/",$getbooking_title2->child_price);
 foreach ($checkDetail->result() as $checkDetail2){
     $checkroute = $this->Package_model->list_placeData($checkDetail2->begin_place_id);  foreach ($checkroute->result() as $checkroute2){}
     $checktransport = $this->Package_model->list_transportData($checkDetail2->transport_id);foreach ($checktransport->result() as $checktransport2){}
     $p1 = $priceArray[$a];
     $p2 = $priceArray2[$a];
     $totalprice = ($adultstravel*$p1)+($childtravel*$p2);
     $checkroute3 = $this->Package_model->list_placeData($checkDetail2->destination_place_id); foreach ($checkroute3->result() as $checkroute4){}
     $email_body = $email_body.'
										 <div class="panel-body" style="padding-top: 10px;">                                                   
											<div class="" style="background-color: #f1f1f1; border: 1px solid #E5E5E5">
												<div class="row" style="padding: 20px 0px 20px 25px;">
													<div class="col-sm-10">
														<div class="item">
															<span><i class="fa fa-map-marker"></i></span>
															<div><strong>'.$checkDetail2->arrive_time.' '.$checkroute2->place_name_en.'</strong></div>														</div>
														<div class="item">															<span><i class="fa fa-ship" aria-hidden="true"  style="color:#2f79b1;"></i></span>
															<div style="color:#2f79b1; padding-top: 20px;  font-size: 14pt"><strong>'.$checktransport2->transport_name_en.'</strong></div>
															<p>
<!--																<small><strong>Check-in: </strong>'.$checkDetail2->note_checkin_en.'<br></small>-->
															</p>
                                                                                                            <p style="font-size: 10pt !important"><strong><?php echo $totalpeople?> Travellers = '.number_format($totalprice).' THB</strong> 			
																<ul style="font-size: 10pt; padding-bottom: 15px !important">
																	<li style="font-size: 10pt; font-weight: 100;">'.$adultstravel.' Adults x '.number_format($p1).' = '. number_format($adultstravel*$p1).' THB</li>
																	<li style="font-size: 10pt; font-weight: 100;">'. $childtravel.' Children x '. number_format($p2).' = '. number_format($childtravel*$p2).' THB</li>
																</ul>
															</p>															
														</div>

														<div class="item-end">
															<span><i class="fa fa-map-marker"></i></span>
															<div><strong>'. $checkDetail2->depart_time.' '.$checkroute4->place_name_en.'</strong></div>																	
														</div>
													</div>														
												</div>                                                    
											 </div>
										 </div>';
 $a++; } 
										 
									$email_body = $email_body.' </div>
									 <!-- End Accordion 1 -->                                          
								   </div>
								   <!-- Accordion -->
								</div>
				 <!------ Trip Detail ------->
			   </div>
            </td>
          </tr>
        </tbody>
      </table>
      
       
      </td>
    </tr>
    
    <tr>
    <td bgcolor="#B8B8B8"><img src="'.base_url().'html/images/email/address.png" align="left" width="287" height="97"/></td>
      <td align="right" bgcolor="#B8B8B8"><img src="'.base_url().'html/images/email/logo-header.png" style="padding-right: 50px;" /></td>
    </tr>
  </tbody>
</table>
</body>
</html>';		
		
//		$this->email->from($from_email, 'Booking Transport Moonlight Travel'); 
//        $this->email->to($to_email);
//        $this->email->subject($subject); 
//       	$this->email->message($email_body); 
//        //Send mail 
//		//$this->email->send();  
//		if($this->email->send()){ 
                    $subject = "[For Admin] Booking Transport ใบแจ้งการจองเรือ";		
                    $this->email->from($from_email, 'Booking Transport Moonlight Travel'); 
        $this->email->to($from_email);
        $this->email->subject($subject); 
       	$this->email->message($email_body); 
        if($this->email->send()){ 
		   	$result2 = '1';		
        }	
          	$result = $result2;  
        //}			
		echo $result;		
	}
            //------------------------------------------
	public  function checkemail(){
		$changeValue = $this->input->post('email');
		$result = $this->Package_model->count_email($changeValue);
		echo $result;
		
	}
            //-------------------------
    public function subsribe(){
        $sub = $this->input->post('sub');
         $result = $this->Package_model->addsub($sub);
        echo $result;
    }
         //---------------------------------------------------------
    public function loaddetail() {
         $tranid = $this->input->post('tranid');
         $timestart = $this->input->post('timestart');
         $timeend = $this->input->post('timeend');
         $x = $this->input->post('x');
         $landid = $this->input->post('landid');
         $landbook_id = $this->input->post('landbook_id');
        $landbookdetail_id = $this->input->post('landbookdetail_id');
        $landData = $this->transport_model->listLand('',$landid,'1');
        $priceland = $this->transport_model->listprice($tranid,$timestart,$timeend);
        foreach ($landData->result() AS $landData2){}
        foreach ($priceland->result() AS $priceland2){}
        
        
        $listTransport = $this->Package_model->list_transferData($priceland2->transport_id);
        foreach ($listTransport->result() AS $listTransport2){}
        $timestartarray = explode(":",$timestart);
			$h = $timestartarray[0];
			$m = $timestartarray[1];
			$timestart1 = $h.":".$m;
                        
            $timeendarray = explode(":",$timeend);
			$h1 = $timeendarray[0];
			$m1 = $timeendarray[1];
			$timeend1 = $h1.":".$m1;
        ?>
       <div id="detail<?php echo $x?>">
           <table class="table" width="100%" >
               <tr>
                   <td colspan="2" style="background-color:#E1E1E1"><?php echo $landData2->route_name_en?> <button type="button" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" style="float:right" onclick="deleteselect('<?php echo $x?>','<?php echo $landbook_id?>','<?php echo $landbookdetail_id?>')"> <i class="fas fa-times"></i> </button><br> <?php echo $timestart1?> / <?php echo $timeend1?></td>
               </tr>
               
               
               <tr>
                   <td><span><?php echo $listTransport2->transport_name?></span></td><td align="right"><span ><?php echo number_format($priceland2->price,2)?></span></td>
               </tr>
           </table>
           <input type="hidden" class="priceland" value="<?php echo $priceland2->price?>"/>
           <input type="hidden" id="landbookdetail_id<?php echo $x?>" value="<?php echo $landbookdetail_id?>"/>
           <input type="hidden" id="priceid<?php echo $x?>" name="priceid<?php echo $x?>" value="<?php echo $priceland2->id?>"/>
       </div>
        <?php
    }
    //-----------------------------------
           //---------------------------------------------------------
    public function loaddetaillast() {
         $landbook_id = $this->input->post('landbook_id');
         $n = 0;
        $getlandbookdetail = $this->transport_model->getlandbookdetailgroupby($landbook_id);
        foreach ($getlandbookdetail->result() AS $loadland2){$n++;
        $landData = $this->transport_model->listLand('',$loadland2->landtransfer_id,'1');
        foreach ($landData->result() AS $landData2){}
//        $priceland = $this->transport_model->listprice($loadland2->transport_id,$loadland2->time_start,$loadland2->time_end);
        
        //foreach ($priceland->result() AS $priceland2){}
        
        
        //$listTransport = $this->Package_model->list_transferData($priceland2->transport_id);
        //foreach ($listTransport->result() AS $listTransport2){}
        $timestartarray = explode(":",$loadland2->time_start);
			$h = $timestartarray[0];
			$m = $timestartarray[1];
			$timestart1 = $h.":".$m;
                        
            $timeendarray = explode(":",$loadland2->time_end);
			$h1 = $timeendarray[0];
			$m1 = $timeendarray[1];
			$timeend1 = $h1.":".$m1;
                        
        ?>
       <div id="detail<?php echo $loadland2->transport_id.$h.$loadland2->landtransfer_id?>">
           <table class="table" width="100%" >
               <tr>
                   <td colspan="2" style="background-color:#E1E1E1"><?php echo $landData2->route_name_en?> <button type="button" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" style="float:right" onclick="deleteselect('<?php echo $loadland2->transport_id.$h.$loadland2->landtransfer_id?>','<?php echo $landbook_id?>','<?php echo $loadland2->id?>',<?php echo $n?>)"> <i class="fas fa-times"></i> </button><br> <?php echo $timestart1?> - <?php echo $timeend1?></td>
                   
                    <?php $getlandbookdetailgroupby1 = $this->transport_model->getlandbookdetailbytime($landbook_id,$loadland2->time_start,$loadland2->time_end);
                   $test = '';$xx='';
        foreach ($getlandbookdetailgroupby1->result() AS $loadlandgroupby1){
            $priceland1 = $this->transport_model->listprice($loadlandgroupby1->transport_id,$loadlandgroupby1->time_start,$loadlandgroupby1->time_end);
        
        foreach ($priceland1->result() AS $priceland21){}
        $listTransport1 = $this->Package_model->list_transferData($priceland21->transport_id);
        foreach ($listTransport1->result() AS $listTransport21){}
          $test = $test.'||'.$loadlandgroupby1->priceland_id; 
          $xx = $xx.'||'.$loadlandgroupby1->transport_id.$h.$loadlandgroupby1->landtransfer_id; 
          
                    }?>
               <input type="hidden" id="iddetail<?php echo $n?>" value="<?php echo substr($test,2)?>">
               <input type="hidden" id="xx<?php echo $n?>"  value="<?php echo substr($xx,2)?>"/>
               </tr>
               <?php $getlandbookdetailgroupby = $this->transport_model->getlandbookdetailbytime($landbook_id,$loadland2->time_start,$loadland2->time_end);
        foreach ($getlandbookdetailgroupby->result() AS $loadlandgroupby){
            $priceland = $this->transport_model->listprice($loadlandgroupby->transport_id,$loadlandgroupby->time_start,$loadlandgroupby->time_end);
        
        foreach ($priceland->result() AS $priceland2){}
        $listTransport = $this->Package_model->list_transferData($priceland2->transport_id);
        foreach ($listTransport->result() AS $listTransport2){}
            ?>
               <tr>
                   <td><span><?php echo $listTransport2->transport_name?></span> (<?php echo number_format($priceland2->price,2)?> x <?php echo $loadlandgroupby->transport_amount?>)</td><td align="right"><span ><?php echo number_format(intval($priceland2->price)*intval($loadlandgroupby->transport_amount),2)?></span></td>
               </tr>
               <input type="hidden" class="priceland" value="<?php echo intval($priceland2->price)*intval($loadlandgroupby->transport_amount)?>"/>
           <input type="hidden" id="landbookdetail_id<?php echo $loadlandgroupby->transport_id.$h.$loadlandgroupby->landtransfer_id?>" value="<?php echo $loadlandgroupby->id?>"/>
           <input type="hidden" id="priceid<?php echo $loadlandgroupby->transport_id.$h.$loadlandgroupby->landtransfer_id?>" name="priceid<?php echo $loadlandgroupby->transport_id.$h.$loadlandgroupby->landtransfer_id?>" value="<?php echo $priceland2->id?>"/>
        <?php }?>
           </table>
           
       </div>
        <?php
    }
    }
    //----------------------------------------------
    public function addtran(){
        $tranid = $this->input->post('tranid');
        $timestart = $this->input->post('timestart');
        $timeend = $this->input->post('timeend');
        $priceland = $this->transport_model->listprice($tranid,$timestart,$timeend);
        foreach ($priceland->result() AS $priceland2){}
        $keygroup = $this->input->post('keygroup');
        $landbook_id = $this->input->post('landbook_id');
        $partner_id = $this->input->post('partner_id');
        $Adults = $this->input->post('Adults');
        $datedata = $this->input->post('datedata');
        $Adultspepreple = $this->input->post('Adultspepreple');
        $Children = $this->input->post('Children');
        
        if($datedata!=''){
        $datearray = explode("/",$datedata);
			$d = $datearray[0];
			$m = $datearray[1];
			$y = $datearray[2];
			$datedata = $y."-".$m."-".$d;
        }
         if($keygroup == ''){
        $keygroup = $this->transport_model->generateRandomString();
        $ch_keygroup = $this->transport_model->check_keygroup($keygroup);
        if($ch_keygroup >0){
            $keygroup = $this->Package_model->generateRandomString();
        }        
        }
        $result = $this->transport_model->bookinglandfirst($landbook_id,$keygroup,$priceland2->id,$partner_id,$Adults,$datedata,$Adultspepreple,$Children);
        echo $keygroup.','.$result;
    }
    //----------------------------------------------
    public function updateday(){
        $landbook_id = $this->input->post('landbook_id');
        $Adults = $this->input->post('Adults');
        $datedata = $this->input->post('datedata');
        $Children = $this->input->post('Children');
        
        if($datedata!=''){
        $datearray = explode("/",$datedata);
			$d = $datearray[0];
			$m = $datearray[1];
			$y = $datearray[2];
			$datedata = $y."-".$m."-".$d;
        }
        $result = $this->transport_model->updateday($landbook_id,$Adults,$datedata,$Children);
        echo $result;
    }
    //----------------------------------------------
    public function updatetran(){
        $tranid = $this->input->post('tranid');
        $timestart = $this->input->post('timestart');
        $timeend = $this->input->post('timeend');
        $priceland = $this->transport_model->listprice($tranid,$timestart,$timeend);
        foreach ($priceland->result() AS $priceland2){}
        $landbook_id = $this->input->post('landbook_id');
        $Adults = $this->input->post('Adults');
        $keygroup = $this->input->post('keygroup');
        $getdetailbyid = $this->transport_model->getdetailbyid($landbook_id,$priceland2->id);
        foreach ($getdetailbyid->result() AS $getdetailbyid2){}
        $result = $this->transport_model->updatetran($landbook_id,$priceland2->id,$Adults,$getdetailbyid2->id);
        echo $keygroup.','.$result;
    }
    //---------------------------------------------
    public function deletelandbookdetail(){
        $landbook_id = $this->input->post('landbook_id');
        $landbookdetail_id = $this->input->post('landbookdetail_id');

        $result = $this->transport_model->deletelandbookdetail($landbook_id,$landbookdetail_id);
        echo $result;
    }
    //---------------------------------------------
    public function deletelandbookdetailbyid(){
        $landbook_id = $this->input->post('landbook_id');
        $landbookdetail_id = $this->input->post('landbookdetail_id');
        $iddetail = $this->input->post('iddetail');
        
        $result = $this->transport_model->deletelandbookdetailbyid($landbook_id,$landbookdetail_id,$iddetail);
       
        echo $result;
    }
         //---------------------------------------------------------
    public function loaddetailfirst() {
        $landbook_id = $this->input->post('landbook_id');
        $getlandbookdetail = $this->transport_model->getlandbookdetail($landbook_id);
        $numlandbookdetail = $getlandbookdetail->num_rows();
        if($numlandbookdetail>0){
        foreach ($getlandbookdetail->result() AS $getlandbookdetail2){
        $landbookdetail_id = $getlandbookdetail2->id;
        $getlandtransfer = $this->transport_model->getlandtransfer($getlandbookdetail2->priceland_id);
        foreach ($getlandtransfer->result() AS $getlandtransfer2){}
        

        $listTransport = $this->Package_model->list_transferData($getlandtransfer2->transport_id);
        foreach ($listTransport->result() AS $listTransport2){}
        $timestartarray = explode(":",$getlandtransfer2->time_start);
			$h = $timestartarray[0];
			$m = $timestartarray[1];
			$timestart1 = $h.":".$m;
                        
            $timeendarray = explode(":",$getlandtransfer2->time_end);
			$h1 = $timeendarray[0];
			$m1 = $timeendarray[1];
			$timeend1 = $h1.":".$m1;
                        
                         $getVehicle = $this->transport_model->getVehicleinRoute($getlandtransfer2->landtransfer_id);
                         foreach ($getVehicle->result() AS $VehicleData){}
                         $x = $VehicleData->tranID.$h.$getlandtransfer2->landtransfer_id;
        ?>
       <div id="detail<?php echo $x?>">
           <table class="table" width="100%" >
               <tr>
                   <td colspan="2" style="background-color:#E1E1E1"><?php echo $getlandtransfer2->route_name_en?> <button type="button" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" style="float:right" onclick="deleteselect('<?php echo $x?>','<?php echo $landbook_id?>','<?php echo $landbookdetail_id?>')"> <i class="fas fa-times"></i> </button><br> <?php echo $timestart1?> / <?php echo $timeend1?></td>
               </tr>
               
               
               <tr>
                   <td><span><?php echo $listTransport2->transport_name?></span></td><td align="right"><span ><?php echo number_format($getlandtransfer2->price,2)?> x <?php echo $getlandbookdetail2->transport_amount?> = <?php echo intval($getlandtransfer2->price)*intval($getlandbookdetail2->transport_amount)?></span></td>
               </tr>
           </table>
           <input type="hidden" class="priceland" value="<?php echo intval($getlandtransfer2->price)*intval($getlandbookdetail2->transport_amount)?>"/>
           <input type="hidden" id="landbookdetail_id<?php echo $x?>" value="<?php echo $landbookdetail_id?>"/>
           <input type="hidden" id="priceid<?php echo $x?>" name="priceid<?php echo $x?>" value="<?php echo $getlandtransfer2->id?>"/>
       </div>
        <?php
    }
        }
    }
              //-------------------	
    public function LandbookingSumary($keygroup=NULL) {
        $data['keygroup'] = $keygroup;
        $this->load->view('package/fontend/landbookingSumary',$data);
    }
              //-------------------	
    public function updatelandbook() {
        $cust_name = $this->input->post('custname');
        $cust_lastname = $this->input->post('custlastname');
        $cust_email = $this->input->post('Email');
        $cust_telephone_num = $this->input->post('cust_telephone_num');
        $line_id = $this->input->post('line_id');
        $sumprice = $this->input->post('sumprice');
        
        $landbookid = $this->input->post('landbookid');
        $result = $this->transport_model->updatelandbook($landbookid,$cust_name,$cust_lastname,$cust_email,$cust_telephone_num,$line_id,$sumprice);
        echo $result;
    }
 //-------------------------------------------------------
 public function PDF_preview($bookingid=NULL){
                if($bookingid==''){
		$data['bookingid'] = $this->input->post('bookingid');
                }else{
                $data['bookingid'] = $bookingid;
                }
                $this->load->library('Pdf');
                $this->load->model("transport_model"); 
                $this->load->view('package/fontend/booking_voucher_preview' , $data);
//$result = 1;
		//echo $result;		
	}
 //-------------------------------------------------------
 public function PDF_charter_preview($bookingid=NULL){
                if($bookingid==''){
		$data['bookingid'] = $this->input->post('bookingid');
                }else{
                $data['bookingid'] = $bookingid;
                }
                $this->load->library('Pdf');
                $this->load->model("transport_model"); 
                $this->load->view('package/fontend/booking_charter_preview' , $data);
//$result = 1;
		//echo $result;		
	}
 //-------------------------------------------------------
 public function addpdf($bookingid=NULL){
                if($bookingid==''){
		$data['bookingid'] = $this->input->post('bookingid');
                }else{
                $data['bookingid'] = $bookingid;
                }
                $this->load->library('Pdf');
                $this->load->model("transport_model"); 
                $this->load->view('package/fontend/booking_voucher_pdf' , $data);
//$result = 1;
		//echo $result;		
	}
 //-------------------------------------------------------
 public function addpdfcharter($bookingid=NULL){
                if($bookingid==''){
		$data['bookingid'] = $this->input->post('bookingid');
                }else{
                $data['bookingid'] = $bookingid;
                }
                $this->load->library('Pdf');
                $this->load->model("transport_model"); 
                $this->load->view('package/fontend/bookingcharter_voucher_pdf' , $data);
//$result = 1;
		//echo $result;		
	}
 //-------------------------------------------------------
public function send_maillandbook(){	 
		$bookingid = $this->input->post('bookingid');
		$getlandbooking = $this->transport_model->getlandbooking($bookingid);
                    foreach ($getlandbooking->result() AS $getlandbookings){}
                    $datedata = $this->transport_model->GetEngDate($getlandbookings->depart_date);
                    $datebook = $this->transport_model->GetEngDateTime($getlandbookings->date_booking);
		$from_email = 'wiboonsak.suw@gmail.com';		
		$to_email = $getlandbookings->customer_email;
		$email_body = '<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Booking Transport || Akira Speedboat</title>
	
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	
	

<link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">

</head>

<body style="margin: 0;font-size: 8px;font-weight: 400;line-height: 1.5;color: #212529;text-align: left;background-color: #fff;">
	

<div style="padding: 30px;">

    
    <div style="position: relative;background-color: #FFF;min-height: 680px;padding: 15px;overflow: auto!important;">
        <div style="100%">
            <header style="padding: 10px 0;margin-bottom: 20px;border-bottom: 1px solid #3989c6;">
            <table >
  <tr >
    <td style="width:380px"> <a target="_blank" href="#"> <img src="http://www.ok-demo.com/akira_speedboat/images/logo-header.png" data-holder-rendered="true" /></a>                    
                        <div style="font-size: 2em;">Phone: +66 (0) 98 161 6164</div>
                        <div style="font-size: 2em;">Email: booking@akiraspeedboat.com</div>
                        <div style="font-size: 2em;">370 Moo 7 Koh Lipe, T.Koh Sarai, Muang, Satun 91000.</div>
			</td>
    <td style="width:380px"> <div style="font-size: 3em;color: #3989c6;">BOOKING TRANSPORT</div> 
    <div style="font-size: 2em;">Date of Booking: '.$datebook.'</div>

</td>
  </tr>
 
</table>
                
            </header>
            <main style="padding-bottom: 50px;">
            <table >
  <tr >
    <td style="width:380px">
    <div style="font-size: 3em;">CUSTOMER:</div>
    <div style="font-size: 2em;"><strong>Customer Name:</strong> '.$getlandbookings->customer_name.' '.$getlandbookings->customer_Lastname.'</div>
    <div style="font-size: 2em;"><strong>Phone:</strong> '.$getlandbookings->customer_telephone.'</div>
    <div style="font-size: 2em;"><strong>Email:</strong> '.$getlandbookings->customer_email.'</div>
    <div style="font-size: 2em;"><strong>Line ID: </strong>'.$getlandbookings->Line_id.'</div>
                        
</td>
    <td style="width:380px">  
    <div style="font-size: 3em;color: #3989c6;">BOOKING NO. '.$bookingid.'</div>
    <div style="font-size: 2em;"><strong>Departure Date:</strong> '.$datedata.'</div>
    <div style="font-size: 2em;"><strong>Number of Passenger:</strong> Adults x '.$getlandbookings->adult.'  |  Children x '.$getlandbookings->child.'</div>

</td>
  </tr>
 
</table>
                <br>
                <br>
                <table border="0" cellspacing="0" cellpadding="0" style="width:650px;border-collapse: collapse;border-spacing: 0;margin-bottom: 20px;">
                    <thead>
                        <tr>
                            <th width="6%" style="white-space: nowrap;font-weight: 400;font-size: 16px;text-align: center!important; padding: 15px;background-color: #eee;border-bottom: 1px solid #fff;">#</th>
                            <th style="white-space: nowrap;font-weight: 400;font-size: 16px;text-align: center!important;background-color: #eee;" width="20%">VEHICLES</th>
			    <th style="white-space: nowrap;font-weight: 400;font-size: 16px;text-align: center!important;background-color: #eee;" width="20%">ROUTE</th>
                            <th width="10%" style="white-space: nowrap;font-weight: 400;font-size: 16px;text-align: center!important;background-color: #eee;">DEPARTS</th>
			    <th width="10%" style="white-space: nowrap;font-weight: 400;font-size: 16px;text-align: center!important;background-color: #eee;">ARRIVES</th>
                            <th width="30%" style="white-space: nowrap;font-weight: 400;font-size: 16px;text-align: center!important;background-color: #eee;">SAILING PRICE</th>
                        </tr>
                    </thead>
                    <tbody>
					';
                                               
   $n = 1;
                        $getlandbookdetail = $this->transport_model->getlandbookdetail($getlandbookings->id);
        $numlandbookdetail = $getlandbookdetail->num_rows();
        if($numlandbookdetail>0){
        foreach ($getlandbookdetail->result() AS $getlandbookdetail2){
        $landbookdetail_id = $getlandbookdetail2->id;
        $getlandtransfer = $this->transport_model->getlandtransfer($getlandbookdetail2->priceland_id);
        foreach ($getlandtransfer->result() AS $getlandtransfer2){}

        $timestartarray = explode(":",$getlandtransfer2->time_start);
			$h = $timestartarray[0];
			$m = $timestartarray[1];
			$timestart1 = $h.":".$m;
                        
            $timeendarray = explode(":",$getlandtransfer2->time_end);
			$h1 = $timeendarray[0];
			$m1 = $timeendarray[1];
			$timeend1 = $h1.":".$m1;
                        
                         $getVehicle = $this->transport_model->getVehicleinRoute($getlandtransfer2->landtransfer_id);
                         foreach ($getVehicle->result() AS $VehicleData){}
                         $x = $VehicleData->tranID.$h;
                         $priceland = $this->transport_model->listprice($getlandbookdetail2->transport_id,$getlandbookdetail2->time_start,$getlandbookdetail2->time_end);
        
        foreach ($priceland->result() AS $priceland2){}
        $listTransport = $this->Package_model->list_transferData($priceland2->transport_id);
        foreach ($listTransport->result() AS $listTransport2){}
    $email_body = $email_body.'
	<tr>
                            <td width="6%" class="no text-center" style="color: #fff;font-size: 2em;background-color: #3989c6;text-align: center!important;">'.$n.'</td>
                            <td width="20%" style="padding: 15px;background-color: #eee;border-bottom: 1px solid #fff;text-align: left!important;margin: 0;font-weight: 400;color: #3989c6;font-size: 2em;">'.$listTransport2->transport_name.'<br>('.number_format($priceland2->price,2).' x '.$getlandbookdetail2->transport_amount.')</td>
							<td width="20%" style="padding: 15px;background-color: #eee;border-bottom: 1px solid #fff;text-align: left!important;margin: 0;font-weight: 400;color: #3989c6;font-size: 2em;">'.$getlandtransfer2->route_name_en.'</td>                          
                            <td width="10%" style="padding: 15px;background-color: #eee;border-bottom: 1px solid #fff;font-size: 1em;text-align: center!important;font-size: 2em;">'.$timestart1.'</td>
							<td width="10%" style="padding: 15px;background: #eee;border-bottom: 1px solid #fff;font-size: 1em;text-align: center!important;background-color: #eee;font-size: 2em;">'.$timeend1.'</td>
                            <td width="30%" style="background: #3989c6;color: #fff;text-align: right;font-size: 1em;padding: 15px;border-bottom: 1px solid #fff;background-color: #3989c6;font-size: 2em;">'.number_format(intval($priceland2->price)*intval($getlandbookdetail2->transport_amount),2).' Baht &nbsp;&nbsp;</td>
                        </tr>';
        $n++;}}
        $email_body = $email_body.'
				</tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="border: none;color: #3989c6;font-size: 1.4em;background: 0 0; border-bottom: none;white-space: nowrap;text-align: right;padding: 10px 20px;"></td>
                            <td colspan="2" style="color: #3989c6;font-size: 1.4em;border-top: none;background: 0 0;border-bottom: none;white-space: nowrap;text-align: right;padding: 10px 20px;font-size: 2em;">GRAND TOTAL</td>
                            <td style="border-top: none;background: 0 0;border-bottom: none;white-space: nowrap;text-align: right;padding: 10px 20px;color: #3989c6;font-size: 2em;">'.number_format($getlandbookings->total_price,2).' Baht &nbsp;&nbsp;</td>
                        </tr>
                    </tfoot>
                </table>
                <div style="font-size: 3em;margin-bottom: 50px;">Thank you!</div>
                <div style="padding-left: 6px;border-left: 6px solid #3989c6;">
                   &nbsp;&nbsp; <div style="font-size: 2em;">NOTICE:</div>
                    &nbsp;&nbsp;<div style="font-size: 2em;">The Price included Ferry ticket and Transfer, Please check in before 30 minutes.</div>
                </div>
            </main>
            <br>
            <footer style="width: 650px;text-align: center!important;color: #777;border-top: 1px solid #aaa;padding: 8px 0;">
                <p style="font-size: 2em;">&nbsp;&nbsp;This booking was created on a computer and is valid without the signature and seal.</p>
            </footer>
        </div>
       
    </div>
</div>
	
</body>
</html>';		
		

        $subject = "Booking LAND TRANSFER";	
        
        $this->email->from($from_email, 'Booking LAND TRANSFER Akira Speedboat'); 
        $this->email->to($to_email);
        $this->email->subject($subject); 
       	$this->email->message($email_body); 
        $this->email->attach(base_url().'application/views/package/fontend/transportPDF/booking_pdf_'.$bookingid.'.pdf');
        if($this->email->send()){
             $subject1 = "[For Admin] Booking LAND TRANSFER";	
        
        $this->email->from($from_email, '[For Admin] Booking LAND TRANSFER Akira Speedboat'); 
        $this->email->to($from_email);
        $this->email->subject($subject1); 
       	$this->email->message($email_body); 
        $this->email->attach(base_url().'application/views/package/fontend/transportPDF/booking_pdf_'.$bookingid.'.pdf');
        $this->email->send();
		   	$result2 = '1';		
        }else{
            $result2 = '0';
        }	
          	$result = $result2;  
        //}			
		echo $result;		
	}
         //-----------------------------------
    public function addcharterbook(){
        $charterid = $this->input->post('charterid');
        $keygroup = $this->input->post('keygroup');
        $charterbook_id = $this->input->post('charterbook_id');
        $partner_id = $this->input->post('partner_id');
        $Adults = $this->input->post('Adults');
        $datedata = $this->input->post('datedata');
        $Adultspepreple = $this->input->post('Adultspepreple');
        $Children = $this->input->post('Children');
         if($datedata!=''){
        $datearray = explode("/",$datedata);
			$d = $datearray[0];
			$m = $datearray[1];
			$y = $datearray[2];
			$datedata = $y."-".$m."-".$d;
        }
         if($keygroup == ''){
        $keygroup = $this->transport_model->generateRandomString();
        $ch_keygroup = $this->transport_model->check_keygroup($keygroup);
        if($ch_keygroup >0){
            $keygroup = $this->Package_model->generateRandomString();
        }        
        }
        $result = $this->transport_model->bookingcharterfirst($charterbook_id,$keygroup,$charterid,$partner_id,$Adults,$datedata,$Adultspepreple,$Children);
        echo $keygroup.','.$result;
    }
          //---------------------------------------------------------
    public function loadcherterdetail() {
         $charterbook_id = $this->input->post('charterbook_id');
         $n = 0;
        $getcharterbookdetail = $this->transport_model->getcharterbookdetailgroupby($charterbook_id);
        foreach ($getcharterbookdetail->result() AS $loadcharter){$n++;
       $list_boattripData = $this->Package_model->list_boattripData($loadcharter->boattrip_id);
       foreach ($list_boattripData->result() AS $boattripdata){}
       $getcharterbyboatsize = $this->transport_model->getcharterbyboatsize($loadcharter->boat_sizeid,$loadcharter->boattrip_id);
       foreach ($getcharterbyboatsize->result() AS $getcharterbyboatsizes){}
        ?>
       <div id="detail<?php echo $loadcharter->boat_sizeid.$getcharterbyboatsizes->id?>">
           <table class="table" width="100%" >
               <tr>
                   <td colspan="2" style="background-color:#E1E1E1"><?php echo $boattripdata->boat_trip?> <button type="button" class="btn btn-icon waves-effect waves-light btn-danger btn-sm" style="float:right" onclick="deleteselect('<?php echo $loadcharter->boat_sizeid.$getcharterbyboatsizes->id?>','<?php echo $charterbook_id?>','<?php echo $loadcharter->id?>',<?php echo $n?>)"> <i class="fas fa-times"></i> </button></td>
                   
                    <?php $getcharterbookdetailbyid = $this->transport_model->getcharterbookdetailbyid($charterbook_id,$loadcharter->boattrip_id);
                   $test = '';$xx='';
        foreach ($getcharterbookdetailbyid->result() AS $loadcharterby){
            $list_boatData = $this->Package_model->list_boatData($loadcharterby->boat_sizeid);
        
        foreach ($list_boatData->result() AS $boatData){}
       
          $test = $test.'||'.$loadcharterby->charter_id; 
          $xx = $xx.'||'.$loadcharterby->boat_sizeid.$loadcharterby->charter_id; 
          
                    }?>
               <input type="hidden" id="iddetail<?php echo $n?>" value="<?php echo substr($test,2)?>">
               <input type="hidden" id="xx<?php echo $n?>"  value="<?php echo substr($xx,2)?>"/>
               </tr>
               <?php $getcharterbookdetailbyid1 = $this->transport_model->getcharterbookdetailbyid($charterbook_id,$loadcharter->boattrip_id,$loadcharter->boat_sizeid);
        foreach ($getcharterbookdetailbyid1->result() AS $loadcharterbyid){
        $getcharter_boat = $this->transport_model->getcharter_boat($loadcharterbyid->charter_id);
        foreach ($getcharter_boat->result() AS $getcharter_boat2){}?>
               <tr>
                   <td><span><?php echo $getcharter_boat2->boat_size?></span> (<?php echo number_format($getcharter_boat2->price,2)?> x <?php echo $loadcharterbyid->transport_amount?>)</td><td align="right"><span ><?php echo number_format(intval($getcharter_boat2->price)*intval($loadcharterbyid->transport_amount),2)?></span></td>
               </tr>
               <input type="hidden" class="pricecharter" value="<?php echo intval($getcharter_boat2->price)*intval($loadcharterbyid->transport_amount)?>"/>
           <input type="hidden" id="charterbookdetail_id<?php echo $loadcharterbyid->boat_sizeid.$loadcharterbyid->charter_id?>" value="<?php echo $loadcharterbyid->id?>"/>
           <input type="hidden" id="priceid<?php echo $loadcharterbyid->boat_sizeid.$loadcharterbyid->charter_id?>" name="priceid<?php echo $loadcharterbyid->boat_sizeid.$loadcharterbyid->charter_id?>" value="<?php echo $getcharter_boat2->id?>"/>
        <?php }?>
           </table>
           
       </div>
        <?php
    }
    }
    //----------------------------------------------
  public function deletecharterbookdetail(){
        $charterbook_id = $this->input->post('charterbook_id');
        $chartbookdetail_id = $this->input->post('chartbookdetail_id');
        $result = $this->transport_model->deletecharterbookdetail($charterbook_id,$chartbookdetail_id);
        $result = 1;
        echo $result;
    }
     //---------------------------------------------
    public function deletecharterbookdetailbyid(){
        $charterbook_id = $this->input->post('charterbook_id');
        $charterbookdetail_id = $this->input->post('charterbookdetail_id');
        $iddetail = $this->input->post('iddetail');
        
        $result = $this->transport_model->deletecharterbookdetailbyid($charterbook_id,$charterbookdetail_id,$iddetail);
       
        echo $result;
    }
                 //-------------------	
    public function CharterbookingSumary($keygroup=NULL) {
        $data['keygroup'] = $keygroup;
        $this->load->view('package/fontend/charterbookingSumary',$data);
    }
                //-------------------	
    public function updatecharterbook() {
        $cust_name = $this->input->post('custname');
        $cust_lastname = $this->input->post('custlastname');
        $cust_email = $this->input->post('Email');
        $cust_telephone_num = $this->input->post('cust_telephone_num');
        $line_id = $this->input->post('line_id');
        $sumprice = $this->input->post('sumprice');
        $charterbookid = $this->input->post('charterbookid');
        $result = $this->transport_model->updatecharterbook($charterbookid,$cust_name,$cust_lastname,$cust_email,$cust_telephone_num,$line_id,$sumprice);
        echo $result;
    }
 
public function send_mailcharterbook(){	 
		$bookingid = $this->input->post('bookingid');
		$getchearterbooking = $this->transport_model->getchearterbooking($bookingid);
                    foreach ($getchearterbooking->result() AS $getchearterbookings){}
                    $datedata = $this->transport_model->GetEngDate($getchearterbookings->depart_date);
                    $datebook = $this->transport_model->GetEngDateTime($getchearterbookings->date_booking);
		$from_email = 'wiboonsak.suw@gmail.com';		
		$to_email = $getchearterbookings->customer_email;
		$email_body = '<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Booking Transport || Akira Speedboat</title>
	
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	
	

<link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">

</head>

<body style="margin: 0;font-size: 8px;font-weight: 400;line-height: 1.5;color: #212529;text-align: left;background-color: #fff;">
	

<div style="padding: 30px;">

    
    <div style="position: relative;background-color: #FFF;min-height: 680px;padding: 15px;overflow: auto!important;">
        <div style="100%">
            <header style="padding: 10px 0;margin-bottom: 20px;border-bottom: 1px solid #3989c6;">
            <table >
  <tr >
    <td style="width:380px"> <a target="_blank" href="#"> <img src="http://www.ok-demo.com/akira_speedboat/images/logo-header.png" data-holder-rendered="true" /></a>                    
                        <div style="font-size: 2em;padding:0px;margin:0px">Phone: +66 (0) 98 161 6164<br>Email: booking@akiraspeedboat.com<br>370 Moo 7 Koh Lipe, T.Koh Sarai, Muang, Satun 91000.</div>
			</td>
    <td style="width:380px"> <div style="font-size: 3em;color: #3989c6;">BOOKING TRANSPORT</div> 
    <div style="font-size: 2em;">Date of Booking: '.$datebook.'</div>

</td>
  </tr>
 
</table>
                
            </header>
            <main style="padding-bottom: 50px;">
            <table >
  <tr >
    <td style="width:380px">
    <div style="font-size: 3em;">CUSTOMER:</div>
    <div style="font-size: 2em;"><strong>Customer Name:</strong> '.$getchearterbookings->customer_name.' '.$getchearterbookings->customer_Lastname.'<br><strong>Phone:</strong> '.$getchearterbookings->customer_telephone.'<br><strong>Email:</strong> '.$getchearterbookings->customer_email.'<br><strong>Line ID: </strong>'.$getchearterbookings->Line_id.'</div>

                        
</td>
    <td style="width:380px">  
    <div style="font-size: 3em;color: #3989c6;">BOOKING NO. '.$bookingid.'</div>
    <div style="font-size: 2em;"><strong>Departure Date:</strong> '.$datedata.'<br><strong>Number of Passenger:</strong> Adults x '.$getchearterbookings->adult.'  |  Children x '.$getchearterbookings->child.'</div>

</td>
  </tr>
 
</table>
                <br>
                <br>
                <table border="0" cellspacing="0" cellpadding="0" style="width:650px;border-collapse: collapse;border-spacing: 0;margin-bottom: 20px;">
                    <thead>
                        <tr>
                            <th width="6%" style="white-space: nowrap;font-weight: 400;font-size: 16px;text-align: center!important; padding: 15px;background-color: #eee;border-bottom: 1px solid #fff;">#</th>
                            <th style="white-space: nowrap;font-weight: 400;font-size: 16px;text-align: center!important;background-color: #eee;" width="30%">BOAT SIZE</th>
			    <th style="white-space: nowrap;font-weight: 400;font-size: 16px;text-align: center!important;background-color: #eee;" width="27%">TRIP</th>
                            
                            <th width="30%" style="white-space: nowrap;font-weight: 400;font-size: 16px;text-align: center!important;background-color: #eee;">SAILING PRICE</th>
                        </tr>
                    </thead>
                    <tbody>
					';
                                               
   $n = 1;
                        $getcharterbookdetail = $this->transport_model->getcharterbookdetail($getchearterbookings->id);
        $numcharterbookdetail = $getcharterbookdetail->num_rows();
        if($numcharterbookdetail>0){
        foreach ($getcharterbookdetail->result() AS $getcharterbookdetail2){
        $charterbookdetail_id = $getcharterbookdetail2->id;
        $loadcharter = $this->transport_model->loadcharter('1',$getcharterbookdetail2->charter_id);
         foreach ($loadcharter->result() AS $loadcharter2){}
    $email_body = $email_body.'
	<tr>
                            <td width="6%" class="no text-center" style="color: #fff;font-size: 2em;background-color: #3989c6;text-align: center!important;">'.$n.'</td>
                            <td width="30%" style="padding: 15px;background-color: #eee;border-bottom: 1px solid #fff;text-align: left!important;margin: 0;font-weight: 400;color: #3989c6;font-size: 2em;">'.$loadcharter2->boat_size.'<br>('.number_format($loadcharter2->price,2).' x '.$getcharterbookdetail2->transport_amount.')</td>
							<td width="27%" style="padding: 15px;background-color: #eee;border-bottom: 1px solid #fff;text-align: left!important;margin: 0;font-weight: 400;color: #3989c6;font-size: 2em;">'.$loadcharter2->boat_trip.'</td>                          
                            <td width="30%" style="background: #3989c6;color: #fff;text-align: right;font-size: 1em;background-color: #3989c6;font-size: 2em;">'.number_format(intval($loadcharter2->price)*intval($getcharterbookdetail2->transport_amount),2).' Baht &nbsp;&nbsp;</td>
                        </tr>';
        $n++;}}
        $email_body = $email_body.'
				</tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="border: none;color: #3989c6;font-size: 1.4em;background: 0 0; border-bottom: none;white-space: nowrap;text-align: right;padding: 10px 20px;"></td>
                            <td colspan="1" style="color: #3989c6;font-size: 1.4em;border-top: none;background: 0 0;border-bottom: none;white-space: nowrap;text-align: right;padding: 10px 20px;font-size: 2em;">GRAND TOTAL</td>
                            <td style="border-top: none;background: 0 0;border-bottom: none;white-space: nowrap;text-align: right;padding: 10px 20px;color: #3989c6;font-size: 2em;">'.number_format($getchearterbookings->total_price,2).' Baht &nbsp;&nbsp;</td>
                        </tr>
                    </tfoot>
                </table>
                <div style="font-size: 3em;margin-bottom: 50px;">Thank you!</div>
                <div style="padding-left: 6px;border-left: 6px solid #3989c6;">
                   &nbsp;&nbsp; <div style="font-size: 2em;">NOTICE:<br>The Price included Ferry ticket and Transfer, Please check in before 30 minutes.</div>
                </div>
            </main>
            <br>
            <footer style="width: 650px;text-align: center!important;color: #777;border-top: 1px solid #aaa;padding: 8px 0;">
                <p style="font-size: 2em;">&nbsp;&nbsp;This booking was created on a computer and is valid without the signature and seal.</p>
            </footer>
        </div>
       
    </div>
</div>
	
</body>
</html>';		
		

        $subject = "Booking Charter Speed boat";	
        
        $this->email->from($from_email, 'Booking Charter Speed boat Akira Speedboat'); 
        $this->email->to($to_email);
        $this->email->subject($subject); 
       	$this->email->message($email_body); 
        $this->email->attach(base_url().'application/views/package/fontend/transportPDF/booking_charter_pdf_'.$bookingid.'.pdf');
        if($this->email->send()){
            $subject1 = "[For Admin] Booking Charter Speed boat";	
        
        $this->email->from($from_email, '[For Admin] Booking Charter Speed boat Akira Speedboat'); 
        $this->email->to($from_email);
        $this->email->subject($subject1); 
       	$this->email->message($email_body); 
        $this->email->attach(base_url().'application/views/package/fontend/transportPDF/booking_charter_pdf_'.$bookingid.'.pdf');
        $this->email->send();
		   	$result2 = '1';		
        }else{
            $result2 = '0';
        }	
          	$result = $result2;  
        //}			
		echo $result;		
	}
         //-------------------	
	public function booking_transport_voucher(){
		$this->load->view('package/fontend/booking_transport_voucher');
	}
         //-------------------	
	public function booking_charter_voucher(){
		$this->load->view('package/fontend/booking_charter_voucher');
	}
          //----------------------------------------------
    public function updatecharter(){

        $charterid = $this->input->post('charterid');
        $charterbook_id = $this->input->post('charterbook_id');
        $Adults = $this->input->post('Adults');
        $keygroup = $this->input->post('keygroup');
        $getdetailcharterbyid = $this->transport_model->getdetailcharterbyid($charterbook_id,$charterid);
        foreach ($getdetailcharterbyid->result() AS $getdetailcharterbyid2){}
        $result = $this->transport_model->updatecharter($charterbook_id,$charterid,$Adults,$getdetailcharterbyid2->id);
        echo $keygroup.','.$result;
    }
    //----------------------------------------------
    public function updatedaycharter(){
        $charterbook_id = $this->input->post('charterbook_id');
        $Adults = $this->input->post('Adults');
        $datedata = $this->input->post('datedata');
        $Children = $this->input->post('Children');
        
        if($datedata!=''){
        $datearray = explode("/",$datedata);
			$d = $datearray[0];
			$m = $datearray[1];
			$y = $datearray[2];
			$datedata = $y."-".$m."-".$d;
        }
        $result = $this->transport_model->updatedaycharter($charterbook_id,$Adults,$datedata,$Children);
        echo $result;
    }
}

