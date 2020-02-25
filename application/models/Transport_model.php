<?php 
 class transport_model extends CI_Model
 { 
	  function getRouteData($idFrom,$idTo,$selectDate){
		 	//$sql="SELECT * FROM tbl_route_data WHERE begin_place_id ='".$idFrom."' AND destination_place_id ='".$idTo."' ORDER BY  " ;  b.begin_place_id = '' AND b.destination_place_id transfer_m_time tbl_route_timeTable
		  $today=date("Y-m-d");
		  $currentTime = date("H:i:s");
		  
		  if($selectDate==$today){
			  
			  $txtDate = "  AND a.arrive_time > DATE_ADD(now(), INTERVAL 2 HOUR)  ";
			  
		  }else{
			  $txtDate = ''; 
		  }
		  
		  $sql=" SELECT a.id AS TimeTableID , a.* ,b.id AS RouteID , b.route_name_en , b.partner_id , b.partner_route_id , b.partner_travel_by  , b.partner_travel_type  "
			  ." FROM  tbl_route_timeTable AS a "
			  ." LEFT JOIN tbl_route_data AS b ON a.route_id = b.id "
			  ." WHERE a.route_id IN (SELECT id FROM tbl_route_data WHERE begin_place_id = '".$idFrom."' AND  destination_place_id='".$idTo."' )  "
			  ." $txtDate  "
			  ." ORDER BY a.arrive_time  ASC "
			  ."";
		  
		  $route=$this->db->query($sql);
		   return $route;
	  } 
	 //------------------------------------------------------  	 
	 function getTreavelBy($RouteID,$TimeTableID,$keygroup,$partnerID){
		 
		 if($partnerID=='2'){
			 $WhereKeygroup='';
		 }else{
			 $WhereKeygroup=" AND b.key_group ='".$keygroup."' "; 
		 }
		 
		 
		 $sql="SELECT a.id AS TimeTableID , b.transfer_h_time , b.transfer_m_time , b.partner_id , c.transport_name_en "
			 ." FROM tbl_route_timeTable AS a "
			 ." LEFT JOIN tbl_route_type AS b ON a.route_type_id = b.key_group  "
			 ." LEFT JOIN tbl_transport_type AS c ON b.transport_id=c.id "
			 ." WHERE b.route_id = '".$RouteID."' AND a.id='".$TimeTableID."' $WhereKeygroup  ";
		 $resultData=$this->db->query($sql);
		 $txtTravelBy=''; $txtTravelTime='';
		 foreach($resultData->result() AS $data){
			
			 $txtTravelBy=$txtTravelBy.$data->transport_name_en.",";
			 
			 if(($data->transfer_h_time!=0)&&($data->transfer_h_time!='')){
				 $txtH = $data->transfer_h_time." Hr. ";
			 }else{
				 $txtH='';
			 }
			 
			 if(($data->transfer_m_time!=0)&&($data->transfer_m_time!='')){
				 $txtM = $data->transfer_m_time." Min.";
			 }else{
				 $txtM='';
			 }
			 
			 $txtTravelTime=$txtH.$txtM;
		 }
		 
		 $dataReturn['TravelBy']=substr($txtTravelBy,0,-1);
		 $dataReturn['TravelTime']=$txtTravelTime;
		 return $dataReturn;
	 } 
	 
	 //------------------------------------------------------  
	 function TimeTableDetail($RouteID,$TimetableID,$partner_id){
		  if($partner_id==1){
			  $sqsl="";
		  }else if($partner_id==2){
			  $sqsl="";
		  }
		 
	 }
	 //------------------------------------------------------  
	 function getRoutePrce($TimeTableID){
		 $sql="SELECT * FROM  tbl_detailFor_timeTable   WHERE timeTable_id='".$TimeTableID."'   ";
		 $q = $this->db->query($sql);
		 
		 $returnData['AdultPrice']=0;
		 $returnData['AdultPriceDiscount']=0;
		 $returnData['ChilePrice']=0;
		 $returnData['ChilePriceDiscount']=0;
		 
		 foreach($q->result() AS $data){
			 $returnData['AdultPrice']= $returnData['AdultPrice']+$data->price;
			 $returnData['AdultPriceDiscount']=$returnData['AdultPriceDiscount']+$data->discount_price;
			 $returnData['ChilePrice']=$returnData['ChilePrice']+$data->price_children; 
			 $returnData['ChilePriceDiscount']=$returnData['ChilePriceDiscount']+$data->discount_chilg_price; 
		 }

	 
		 return $returnData;
	 }
	 //------------------------------------------------------  
	 function getRouteDetail($RouteID,$TimetableID){
		 $sql="SELECT a.id AS timeTableID , a.arrive_time , a.arrival_time_2 , b.arrive_time AS detailDepartTime , b.depart_time AS detailArriveTime "
			 ." , b.note_checkin_en, b.price AS adultPrice , b.discount_price AS adultPriceDiscout , b.price_children AS ChildPrice , b.discount_chilg_price AS ChildPriceDiscount , c.transport_name_en  , d.place_name_en AS BeginPlace , e.place_name_en AS DestinationPlace "
			 ." FROM tbl_route_timeTable AS a "
			 ." LEFT JOIN tbl_detailFor_timeTable AS b On a.id = b.timeTable_id "
			 ." LEFT JOIN  tbl_transport_type AS c ON b.transport_id = c.id "
			 ." LEFT JOIN  tbl_place_data AS d ON b.begin_place_id = d.id "
			 ." LEFT JOIN  tbl_place_data AS e ON b.destination_place_id = e.id "
			 ." WHERE a.id='".$TimetableID."' AND a.route_id='".$RouteID."' ORDER BY a.id ASC ";
		 $resultData=$this->db->query($sql);
		 return $resultData;
		 //return $sql;
	 }
	 //------------------------------------------------------  
	 function getRoutePartnerDetail($RouteID,$TimetableID){
		  $sql="SELECT a.id AS timeTableID , a.arrive_time , a.arrival_time_2 , b.arrive_time AS detailDepartTime , b.depart_time AS detailArriveTime "
			 ." , b.note_checkin_en, b.price AS adultPrice , b.discount_price AS adultPriceDiscout , b.price_children AS ChildPrice , b.discount_chilg_price AS ChildPriceDiscount , c.transport_name_en "
			 ." , e.id AS routeDataID ,e.partner_travel_by , d.place_name_en AS BeginPlace , d.partner_check_in_location  "
			 ."  , f.place_name_en AS DestinationPlace , f.partner_check_in_location "
			 ." FROM tbl_route_timeTable AS a "
			 ." LEFT JOIN tbl_detailFor_timeTable AS b On a.id = b.timeTable_id "
			 ." LEFT JOIN tbl_transport_type AS c ON b.transport_id = c.id "
			 ." LEFT JOIN tbl_route_data AS e ON a.route_id = e.id "
			 ." LEFT JOIN tbl_place_data AS d ON e.begin_place_id = d.id "
			 ." LEFT JOIN tbl_place_data AS f ON e.destination_place_id = f.id "
			  
			 ." WHERE a.id='".$TimetableID."' AND a.route_id='".$RouteID."' ORDER BY a.id ASC ";
		 $resultData=$this->db->query($sql);
		 return $resultData;
	 }
	 //------------------------------------------------------   
	 function insertRoute($route_name_en=NULL, $begin_place_id=NULL, $destination_place_id=NULL, $route_image=NULL){		 
			
		 $data = array(
         'route_name_en' => $route_name_en,
         'begin_place_id' => $begin_place_id,
         'destination_place_id' => $destination_place_id,
         'route_image' => $route_image,
         'rout_active' => '1');
         		  
         if($this->db->insert('tbl_route_data', $data)){				 
			//$pass=1;
			$pass = $this->db->insert_id();  
		 }else{
			$pass=0;
			//$this->db->_error_message(); 
		 }		
		 return $pass;		 
	}
	//---------------------------  
	function listRoute($rout_active=NULL,$dataID=NULL,$partnerID=NULL){
		
		if($rout_active !=''){
			$this->db->where('rout_active', $rout_active);
		}
		
		/*if($paper_no !=''){
			$this->db->where('paper_no', $paper_no);
		}*/
		if($dataID !=''){
			$this->db->where('id', $dataID);
		}
		$this->db->where('partner_id', $partnerID);
		$this->db->select('*');
		$this->db->order_by('id','desc');
		$query = $this->db->get('tbl_route_data');
		
		return $query;		
	}
	//--------------------------- 
	function editRoute($route_name_en=NULL, $begin_place_id=NULL, $destination_place_id=NULL, $route_image=NULL, $dataID=NULL){		 
			
		 $data = array(
         'route_name_en' => $route_name_en,
         'begin_place_id' => $begin_place_id,
         'destination_place_id' => $destination_place_id,
         'route_image' => $route_image);
		
         $this->db->where('id', $dataID);
		 if($this->db->update('tbl_route_data', $data)){				 
			//$pass=1;
			$pass = $dataID;  
		 }else{
			$pass=0;
			//$this->db->_error_message(); 
		 }		
		 return $pass;		 
	}
	//--------------------------- 
    function listPlace($place_active=NULL,$dataID=NULL){
		
		if($rout_active !=''){
			$this->db->where('place_active', $place_active);
		}		
		if($dataID !=''){
			$this->db->where('id', $dataID);
		}
		
		$this->db->select('*');
		$this->db->order_by('id','desc');
		$query = $this->db->get('tbl_place_data');
		
		return $query;		
	}
	//--------------------------- 	 
	function listTransport($transport_active=NULL,$dataID=NULL){
		
		if($transport_active !=''){
			$this->db->where('transport_active', $transport_active);
		}		
		if($dataID !=''){
			$this->db->where('id', $dataID);
		}
		
		$this->db->select('*');
		$this->db->order_by('id','desc');
		$query = $this->db->get('tbl_transport_type');
		
		return $query;		
	}
	//--------------------------- 
	function selectTransport($transport_id=NULL, $route_id=NULL, $transfer_h_time=NULL, $transfer_m_time=NULL){	
		
		$this->db->where('route_id', $route_id);
		$this->db->select_max('key_group', 'max');
   		$query = $this->db->get('tbl_route_type');    
   		$max_id = $query->row()->max;
		
		if($max_id >0){
			$max_id = $max_id + 1;
			
		} else {			
			$max_id = 1;
		}
		
		$transport_arr = explode(",",$transport_id);		
		$count_arr = count($transport_arr);
		
		for($x=0; $x < $count_arr; $x++){
			
		   $data = array(
			 'route_id' => $route_id,
			 'transport_id' => $transport_arr[$x],
			 'key_group' => $max_id,
			 'transfer_h_time' => $transfer_h_time,
			 'transfer_m_time' => $transfer_m_time,
			 'rout_active' => '1');
		   $this->db->insert('tbl_route_type', $data);			
		}	
		$result = $route_id.'/'.$max_id.'/'.$transfer_h_time.'/'.$transfer_m_time;
		return $result;		 
		//return $max_id;		 
	} 
	//---------------------------  
	        // get_routeType($route_id, $routeType->key_group, '1', $x, 'id');
	function get_routeType($route_id=NULL, $key=NULL, $rout_active=NULL, $group=NULL, $order=NULL, $limit=NULL){
		
		//SELECT * FROM `tbl_route_type` WHERE route_id = '2' AND key_group = '1' AND rout_active = '1' ORDER BY id ASC			
		
		if($rout_active !=''){
			$this->db->where('rout_active', $rout_active);
		}		
		if($route_id !=''){
			$this->db->where('route_id', $route_id);
		}
		if($key !=''){
			$this->db->where('key_group', $key);
		}
		
		$this->db->select('*');
		if($group !=''){		
			$this->db->group_by('key_group');
		}		
		$this->db->order_by($order,'asc');
		if($limit !=''){
			$this->db->limit(1);
		}
		$query = $this->db->get('tbl_route_type');
		
		return $query;		
	}
	//---------------------------   
	function do_insertTimes($all_data=NULL, $route_type_id=NULL, $route_id=NULL,$transferH=NULL,$transferM=NULL){	
		
		$this->db->where('route_id', $route_id);
		$this->db->where('route_type_id', $route_type_id);
		$this->db->select_max('data_order', 'max');
   		$query = $this->db->get('tbl_route_timeTable');    
   		$max_id = $query->row()->max;
		
		/*if($max_id >0){
			$max_id = $max_id + 1;
			
		} else {			
			$max_id = 1;
		}*/
		
				 
		//----------------------------------
		$count_arr = count($all_data['hr']);
		
		for($x=0; $x < $count_arr; $x++){
			
			if($all_data['hr'][$x] != ''){
			
				$max_id = $max_id + 1;
				
				 $arrive_time[$x] = $all_data['hr'][$x].":".$all_data['min'][$x];
				
				 $times1[$x] = date('H:i', strtotime($arrive_time[$x].'+'.$transferH.' hours'));	
		 		 $timesArrive_2[$x] = date('H:i', strtotime($times1[$x].'+'.$transferM.' minutes'));
				
				//$timesArrive_2[$x] = strtotime("+".$transferH." hours +".$transferM." minutes", strtotime($arrive_time[$x]));
				
				 $data = array(
				 'route_id' => $route_id,
				 'route_type_id' => $route_type_id,
				 'arrive_time' => $arrive_time[$x],
				 'arrival_time_2' => $timesArrive_2[$x],
				 'data_order' => $max_id,
				 'data_status' => '1');
				 $this->db->insert('tbl_route_timeTable', $data);					
		}  }
		return 1;		 
	}
	//---------------------------  
	function get_timeDetail($route_id=NULL, $key=NULL, $data_status=NULL, $limit=NULL, $dataID=NULL){	
		
		if($data_status !=''){
			$this->db->where('data_status', $data_status);
		}		
		if($route_id !=''){
			$this->db->where('route_id', $route_id);
		}
		if($key !=''){
			$this->db->where('route_type_id', $key);
		}
		if($dataID !=''){
			$this->db->where('id', $dataID);
		}		
		$this->db->select('*');				
		$this->db->order_by('arrive_time','asc');
		if($limit !=''){
			$this->db->limit(1);
		}
		$query = $this->db->get('tbl_route_timeTable');
		
		return $query;		
	}
	//--------------------------- 
	function list_checkinPlace($dataID=NULL,$place_active=NULL){
		
		if($place_active !=''){
			$this->db->where('place_active', $place_active);
		}		
		if($dataID !=''){
			$this->db->where('id', $dataID);
		}		
		$this->db->select('*');
		$this->db->order_by('id','desc');
		$query = $this->db->get('tbl_checkin_place');
		
		return $query;		
	}
	//---------------------------
	function checkDetail($timeTable_id=NULL,$data_status=NULL){
		
		if($timeTable_id !=''){
			$this->db->where('timeTable_id', $timeTable_id);
		}
		if($data_status !=''){
			$this->db->where('data_status', $data_status);
		}				
		$this->db->select('*');
		$this->db->order_by('data_order','asc');
		$query = $this->db->get('tbl_detailFor_timeTable');
		
		return $query;		
	}
	//---------------------------
	function checkRoute($begin_place=NULL,$destination_place=NULL){
		
		$sql = "SELECT id FROM `tbl_route_data` WHERE begin_place_id = '".$begin_place."' AND destination_place_id = '".$destination_place."' AND show_onweb = '1' AND rout_active = '1' ";
        $query = $this->db->query($sql);
		
		if($query->num_rows() > 0){
			$row=$query->row();
			$pass = $row->id;	
		
		} else {
			$pass = 0;
		}			
		return $pass;	 
	}
	//---------------------------
	function get_detailTimeTable($timeTable_id=NULL,$data_status=NULL,$limit=NULL,$dataID=NULL){
		
		if($timeTable_id !=''){
			$this->db->where('timeTable_id', $timeTable_id);
		}
		if($data_status !=''){
			$this->db->where('data_status', $data_status);
		}
		if($dataID !=''){
			$this->db->where('id', $dataID);
		}				
		$this->db->select('*');		
		if($limit !=''){
			$this->db->order_by('data_order','desc');
			$this->db->limit(1);
		} else {
			$this->db->order_by('data_order','asc');
		}
		$query = $this->db->get('tbl_detailFor_timeTable'); 
		
		return $query;	
	}
	//---------------------------	
	function count_detailTimeTable($route_id=NULL,$key_group=NULL){
		
		$sql = "SELECT t.* , d.* FROM `tbl_route_timeTable` AS t LEFT JOIN tbl_detailFor_timeTable AS d ON t.id = d.timeTable_id WHERE t.route_id = '".$route_id."' AND t.route_type_id = '".$key_group."' AND t.data_status = '1' AND d.data_status = '1' ";
        $query = $this->db->query($sql);					
		return $query;	 
	} 
	//--------------------------- 
	function get_placeData($currentID=NULL,$notID=NULL){
		
		$txt ='';
		
		if($currentID !=''){
			$txt = "WHERE id = '".$currentID."' ";
		}
		if($notID !=''){
			$txt = "WHERE id != '".$notID."' ";
		}		
		$sql = "SELECT * FROM `tbl_place_data`  $txt ORDER BY place_name_en ASC ";
        $query = $this->db->query($sql);
        
        return $query;
    } 	
	//--------------------------- 
	function getPrice($timeTable_id=NULL, $field=NULL, $data_status=NULL, $data_order=NULL){
		
		if($data_order !=''){
			$txt = "AND data_order = '".$data_order."' ";
		
		} else {
			$txt ='';
		}
		
		$sql = "SELECT SUM($field) AS price FROM `tbl_detailFor_timeTable` WHERE timeTable_id = '".$timeTable_id."' AND data_status = '".$data_status."' $txt ";
		$query = $this->db->query($sql);
        $row=$query->row();
		$pass = $row->price;
		
		return $pass;	 
	} 
	//--------------------------- 
	function do_insertDetailTime($all_data=NULL, $timeTable_id=NULL, $data_order=NULL){		
		
		if($all_data['Hour']=='x'){ $Hour ='0';}else{ $Hour = $all_data['Hour'];}
		if($all_data['Minute']=='x'){ $Minute ='00';}else{ $Minute = $all_data['Minute'];}

		if($all_data['Hour2']=='x'){ $Hour2 ='0';}else{ $Hour2 = $all_data['Hour2'];}
		if($all_data['Minute2']=='x'){ $Minute2 ='00';}else{ $Minute2 = $all_data['Minute2'];}		
		
		$all_data['arrive_time']=$Hour.":".$Minute;
		$all_data['depart_time']=$Hour2.":".$Minute2;
		
		$data = array(
		'timeTable_id' => $timeTable_id, 
		'transport_id' => $all_data['transport_id'],
		'begin_place_id' => $all_data['begin_place_id'],
		'destination_place_id' => $all_data['destination_place_id'],
		'arrive_time' => $all_data['arrive_time'],
		'depart_time' => $all_data['depart_time'],
		'note_checkin_en' => $all_data['note_checkin_en'],
		'price' => $all_data['price'],
		'price_children' => $all_data['price_children'],
		'data_order' => $data_order,
		'data_status' => '1');
		
		if($this->db->insert('tbl_detailFor_timeTable', $data)){		
			$pass = 1 + $data_order;
		} else {
			$pass = 'x';
		}
		return $pass;		 
	}
	//---------------------------   
	function updateDetail($all_data=NULL, $dataID=NULL){		
		
		$data = array(
		'transport_id' => $all_data['transport_id'],
		'destination_place_id' => $all_data['destination_place_id'],
		'arrive_time' => $all_data['arrive_time'],
		'depart_time' => $all_data['depart_time'],
		'note_checkin_en' => $all_data['note_checkin_en'],
		'price' => $all_data['price'],
		'price_children' => $all_data['price_children']);
		
		$this->db->where('id', $dataID);		
		if($this->db->update('tbl_detailFor_timeTable', $data)){		
			$pass = 1;
		} else {
			$pass = 'x';
		}
		return $pass;		 
	}
	//---------------------------
	function delete_transport($key_group=NULL, $route_id=NULL, $transport_id=NULL){
	 
	 	$this->db->where('key_group', $key_group);
	 	$this->db->where('route_id', $route_id);
	 	$this->db->where('transport_id', $transport_id);
		$this->db->delete('tbl_route_type');		
			
		return 1;
	} 
	//--------------------------- tbl_route_timeTable
	function update_routeType($transport_id=NULL, $route_id=NULL, $transfer_h_time=NULL, $transfer_m_time=NULL, $key_group=NULL){	
		
		$pass = 0;
		
		$sql = "SELECT * FROM `tbl_route_type` WHERE key_group = '".$key_group."' AND route_id = '".$route_id."' AND transport_id = '".$transport_id."' ";
        $query = $this->db->query($sql);
		$numberCount = $query->num_rows();
		
		if($numberCount <1){
			
			$data = array(
			 'route_id' => $route_id,
			 'transport_id' => $transport_id,
			 'key_group' => $key_group,
			 'transfer_h_time' => $transfer_h_time,
			 'transfer_m_time' => $transfer_m_time,
			 'rout_active' => '1');
			
		   if($this->db->insert('tbl_route_type', $data)){
			
				$pass = 1;
		   } else {
				$pass = 'x';
			}

		}else{
			$data = array(
			 'route_id' => $route_id,
			 'transport_id' => $transport_id,
			 'key_group' => $key_group,
			 'transfer_h_time' => $transfer_h_time,
			 'transfer_m_time' => $transfer_m_time,
			 'rout_active' => '1');
			  $this->db->where('route_id',$route_id);
			  $this->db->where('key_group',$key_group);
		   if($this->db->update('tbl_route_type', $data)){
				$pass = 1;
		   } else {
				$pass = 'x';
			}
		}

		$timeAdd = $transfer_h_time.":".$transfer_m_time.':00';
		
		$sql="UPDATE tbl_route_timeTable SET arrival_time_2 = ADDTIME(arrive_time, '".$timeAdd."') WHERE route_id = '".$route_id."' AND route_type_id ='".$key_group."'  ";
		if($this->db->query($sql)){
			$pass=1;
		}else{
			$pass='x';
		}
		
		return $pass;				 
	} 
	//--------------------------- 
	function do_deleteRouteType($key_group=NULL, $route_id=NULL){	
		
		$pass = 0;
		
		$sql = "SELECT * FROM `tbl_booking_detail` WHERE route_type_id = '".$key_group."' AND route_id = '".$route_id."' ";
        $query = $this->db->query($sql);
		$numberCount = $query->num_rows();
		
		if($numberCount <1){
			
			$this->db->where('key_group', $key_group);
	 		$this->db->where('route_id', $route_id);
	 		$this->db->delete('tbl_route_type');			
			
			$sql1 = "SELECT id FROM `tbl_route_timeTable` WHERE route_id = '".$route_id."' AND route_type_id = '".$key_group."' ";
        	$query1 = $this->db->query($sql1);			
			$numberCount = $query1->num_rows();	
			
			if($numberCount >0){
				
				foreach ($query1->result() as $data){
					
					$sql2 = "SELECT id FROM `tbl_detailFor_timeTable` WHERE timeTable_id = '".$data->id."' ";
        			$query2 = $this->db->query($sql2);			
					$numberCount2 = $query2->num_rows();
					if($numberCount >0){
				
						foreach ($query2->result() as $data3){
							
							$this->db->where('id', $data3->id);
	 						$this->db->delete('tbl_detailFor_timeTable');
						}
					}                   
            	}
			
				$this->db->where('route_type_id', $key_group);
	 			$this->db->where('route_id', $route_id);
	 			$this->db->delete('tbl_route_timeTable');			
			}			
			
			$pass = 1;

		} else {
			
			$data = array(			
			'rout_active' => '3');
		
			$this->db->where('key_group', $key_group);
	 		$this->db->where('route_id', $route_id);		
			$this->db->update('tbl_route_type', $data);
			$pass = 1;
			
		}
		return $pass;				 
	} 
	//---------------------------	 
	function do_deleteDetail($dataID=NULL,$timeTable_id=NULL){
		
		$sql = "SELECT * FROM `tbl_booking_detail` WHERE time_id = '".$timeTable_id."' ";
        $query = $this->db->query($sql);
		$numberCount = $query->num_rows();
		
		if($numberCount <1){
			
			$this->db->where('id', $dataID);	 		
			$this->db->delete('tbl_detailFor_timeTable');
			
		} else {
			
			$data = array(			
			'data_status' => '3');
		
			$this->db->where('id', $dataID);		
			$this->db->update('tbl_detailFor_timeTable', $data);			
		}			
		return 1;
	} 
	//--------------------------- 
	function count_routeType($key_group=NULL,$route_id=NULL){	 
	 
		$sql = "SELECT * FROM `tbl_booking_detail` WHERE route_type_id = '".$key_group."' AND route_id = '".$route_id."' ";
        $query = $this->db->query($sql);
		$numberCount = $query->num_rows(); 
		
		return $numberCount;
	}
	//--------------------------- 
	function do_removeFile($dataID=NULL){
		
		$x ='';		
        $data = array('route_image' => $x);
		
		$this->db->where('id', $dataID);
        if($this->db->update('tbl_route_data', $data)){
            return "1";
        } else {
            return "0";
        }
    } 
	//---------------------------	 
	function do_deleteData($dataID=NULL,$table=NULL){
		
		$sql = "SELECT * FROM `tbl_booking_detail` WHERE route_id = '".$dataID."' ";
        $query = $this->db->query($sql);
		$numberCount = $query->num_rows();
		
		if($numberCount <1){
			
			$this->db->where('id', $dataID);	 		
			$this->db->delete('tbl_route_data');
			
		} else {
			
			$data = array(			
			'rout_active' => '3');
		
			$this->db->where('id', $dataID);		
			$this->db->update('tbl_route_data', $data);			
		}			
		return 1;
	}
        //---------------------------	 
	function deleteData($dataID=NULL,$table=NULL){
			$this->db->where('id', $dataID);	 		
                        if($this->db->delete($table)){
                            $pass = '1';
                        }else{
                            $pass = '0';
                        }
		return $pass;
	}  
	//---------------------------- 
	 function deleteRouteTime($TimeID){
		 if($this->db->delete('tbl_route_timeTable', array('id' => $TimeID))){
			 $pass=1;
		 }else{
			 $pass=0;
		 }
		 return $pass;
	 }
	//---------------------------- 
    //----------------------------	
	function gettimechselect(){
		$sql = "SELECT *, tbl_route_timeTable.arrive_time,TIME_FORMAT(DATE_ADD(NOW(), INTERVAL 2 HOUR),'%H:%i') AS time_next FROM tbl_route_timeTable WHERE tbl_route_timeTable.arrive_time >= TIME_FORMAT(DATE_ADD(NOW(), INTERVAL 2 HOUR),'%H:%i') ";
        $query = $this->db->query($sql);					
		return $query;	 
	} 
	//--------------------------
	 function addtravelBooking($params){
		 
		 //------------------------------------// $params['TimeIDGo']  
		 $sql="SELECT a.id AS TimTableID , a.route_id , b.begin_place_id , b.destination_place_id , b.partner_id FROM tbl_route_timeTable a LEFT JOIN tbl_route_data b ON a.route_id=b.id WHERE a.id ='".$params['TimeIDGo']."'";
		 $resultDataDepart = $this->db->query($sql);
		 foreach($resultDataDepart->result() AS $data1){ }
		 $sqlcommis="SELECT * FROM tbl_travel_comission  WHERE partner_id ='".$data1->partner_id."'";
		 $resultcommis = $this->db->query($sqlcommis);
		 foreach($resultcommis->result() AS $datacommis){ }
                 
                 $commission = $datacommis->commission;
		 $depart_partner_id = $data1->partner_id;
		 $depart_route_id = $data1->route_id;
		 $begin_location_id = $data1->begin_place_id;
		 $destination_location_id = $data1->destination_place_id;
		 //echo 'TimeIDBack->'.$params['TimeIDBack'].':';
		 
		 
		 if($params['TimeIDBack']!='0'){
			  $sql="SELECT a.id AS TimTableID , a.route_id , b.partner_id FROM tbl_route_timeTable a LEFT JOIN tbl_route_data b ON a.route_id=b.id WHERE a.id ='".$params['TimeIDBack']."'";
		 $resultDataReturn = $this->db->query($sql);
			 
		 foreach($resultDataReturn->result() AS $data2){ }
                 $sqlcommisback="SELECT * FROM tbl_travel_comission  WHERE partner_id ='".$data2->partner_id."'";
		 $resultcommisvack = $this->db->query($sqlcommisback);
		 foreach($resultcommisvack->result() AS $datacommisback){ }
		 $return_partner_id = $data2->partner_id;
		 $return_route_id = $data2->route_id; 
                 $commissionback = $datacommisback->commission;
		 }else{
			 $return_route_id ='0';
			 $return_partner_id ='0';
                         $commissionback = '0';
		 }
		//----------make booking no-----------//
		// $Month = strtoupper(date("M"));
		// $dateTimeNo = date("d_yHis");
		 //$rand = substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 2);
		 //$booking_no = $Month.$dateTimeNo;
		 
		 if($this->session->userdata('booking_no')==''){ 
		    $sql = "SELECT MAX(id) AS top_id FROM  tbl_travel_booking ";
			$result1= $this->db->query($sql);
			foreach($result1->result() AS $dataNumBooking){}
		 
			$top_id = $dataNumBooking->top_id+1;
		
			$orderID = "AK".date('dmy')."-"  . substr("000".$top_id, -3);

		 
		    $booking_no = $orderID;
		    $this->session->set_userdata('booking_no', $booking_no);
			
			$doData ='Insert';
			 
		  } else{
			 $booking_no = $this->session->userdata('booking_no');
			 $doData ='Update';
		  }
		 
		 //----------set null value-----------------//
		 if(!isset($params['destination_location_id'])){ $params['destination_location_id']='0';}
		 if(!isset($params['depart_checkin'])){ $params['depart_checkin']='0';}
		 if(!isset($params['return_checkin'])){ $params['return_checkin']='0';}
		 if(!isset($params['returnName'])){ $params['returnName']='0';}
		 if(!isset($params['backDate'])){ $params['backDate']='0';}
		 if(!isset($params['ReturnDepartTime'])){ $params['ReturnDepartTime']='0';}
		 if(!isset($params['ReturnTotalAdult'])){ $params['ReturnTotalAdult']='0';}
		 if(!isset($params['ReturnTotalChildren'])){ $params['ReturnTotalChildren']='0';}
		 if(!isset($params['cust_prefix'])){ $params['cust_prefix']='-';}
		 
		  $date_booking = date("Y-m-d H:i:s");  
		 //----------------------------------------//departName DChildPrice
                
		 $data=array('booking_no'=>$booking_no,
					 'cust_prefix'=>'',
					 'cust_name'=>$params['cust_name'],
					 'cust_lastname'=>$params['cust_lastname'],
					 'cust_email'=>$params['cust_email'],
					 'cust_telephone_num'=>$params['cust_telephone_num'],
					 'line_id'=>$params['line_id'],
					 'NAdult'=>$params['NAdult'],
					 'NChild'=>$params['NChild'],
					 'travelRound'=>$params['travelRound'],
					 'TimeIDGo'=>$params['TimeIDGo'],
					 'DAdultPrice'=>$params['DAdultPrice'],
					 'DChildPrice'=>$params['DChildPrice'],
					 'TimeIDBack'=>$params['TimeIDBack'],
					 'RAdultPrice'=>$params['RAdultPrice'],
					 'RChildPrice'=>$params['RChildPrice'],
					 'RTotalPrice'=>$params['RTotalPrice'],
					 'departName'=>$params['departName'],
					 'dateGo'=>$params['dateGo'],
					 'DepartTime'=>$params['DepartTime'],
					 'DepartDuration'=>$params['DepartDuration'],
					 'DepartTotalAdult'=>$params['DepartTotalAdult'],
					 'DepartTotalChildren'=>$params['DepartTotalChildren'],
					 'returnName'=>$params['returnName'],
					 'backDate'=>$params['backDate'],
					 'ReturnDepartTime'=>$params['ReturnDepartTime'],
					 'ReturnDuration'=>$params['ReturnDuration'],
					 'ReturnTotalAdult'=>$params['ReturnTotalAdult'],
					 'ReturnTotalChildren'=>$params['ReturnTotalChildren'],
					 'begin_location_id'=>$begin_location_id,
					 'destination_location_id'=>$destination_location_id,
					 'depart_checkin'=>$params['depart_checkin'],
					 'return_checkin'=>$params['return_checkin'],
					 'booking_status'=>'0',
					 'payment_status'=>'0',
					 'payment_type'=>'0',
					 'depart_route_id'=>$depart_route_id,
					 'return_route_id'=>$return_route_id,
					 'depart_partner_id'=>$depart_partner_id,
					 'return_partner_id'=>$return_partner_id,
					 'commission_go'=>$commission,
					 'commission_back'=>$commissionback,
					 'user_edit'=>'0',
					 'date_booking'=>$date_booking
					);
		 
		 if($doData =='Insert'){
			 if($this->db->insert('tbl_travel_booking', $data)){
			   	$pass=1;
		   	  }else{
			   	$pass='0';
		   	 }
		 }  else  if($doData =='Update') {
			    $this->db->where('booking_no', $this->session->userdata('booking_no'));
			 	if($this->db->update('tbl_travel_booking',$data)){
					$pass=1;
				}else{
					$pass='0';
				}
			 
		 }		 
		 
		   return $pass;
		 
		  // return  $data;
		 
		  /* หมายเหตุ
		 	booking_status = 0 insert ครั้งแรก    = 1  เมือเลือกกดปุ่ม ชำระเงิน   
			payment_status = 0 insert ครั้งแรก    = 1  admin กดปุ่ม  ,  หรือ ชำระเงินเสร็จแล้ว
			payment_type   = 0 insert ครั้งแรก  เพราะไม่ระบุ   2 เลือกโอนเงิน 1 เครดิตการ์ด 3 อื่นๆ
		 */
		 
	 }
	 //---------------------
	 function getTransportBookingDetail(){
		 $sql="SELECT * FROM tbl_travel_booking WHERE booking_no ='".$this->session->userdata('booking_no')."' ";
		 $result = $this->db->query($sql);
		 return $result;
	 }
	 //-----------------
	 function findTranbookID($booking_no=NULL){
		 $sql="SELECT id FROM tbl_travel_booking WHERE booking_no ='".$booking_no."' ";
		 $resultData = $this->db->query($sql);
		 foreach($resultData->result() AS $dataDetail){}
		 
		 return $dataDetail->id;
		 //return $sql;
	 }
	 //-----------------
	 function addPaymentStatus($booking_status=NULL,$payment_status=NULL,$payment_type=NULL){
		
		 $data=array('booking_status'=>$booking_status,
					 'payment_status'=>$payment_status,
					 'payment_type'=>$payment_type); 
		 
		  $this->db->where('booking_no', $this->session->userdata('booking_no'));
		  if($this->db->update('tbl_travel_booking',$data)){
			  	$booking_no='';
				$data['pass']=1;
			    $this->session->set_userdata('ShowBookingNo', $this->session->userdata('booking_no'));
			    $this->session->set_userdata('booking_no', $booking_no);
			}else{
				$data['pass']='0';
			}
		 
		  $data['booking_no'] = $this->session->userdata('ShowBookingNo');
		 
		  return $data;
		 
	 }
	 //------------------------
	 function transport_booking_list($booking_status=NULL,$payment_status=NULL,$payment_type=NULL,$partner_id=NULL,$dateStart=NULL,$dateEnd=NULL,$dataID=NULL){
		 if($booking_status!='all'){
			 $txtBookStatus=" AND booking_status='".$booking_status."' ";
		 }else{
			 $txtBookStatus="";
		 }
		 
		 if($payment_status!='all'){
			 $txtPayment =" AND payment_status='".$payment_status."' ";
		 }else{
			 $txtPayment ="";
		 }
		 
		 if($payment_type!='all'){
			 $txtPayment_type =" AND payment_type='".$payment_type."' ";
		 }else{
			 $txtPayment_type ="";
		 }
		 
		  if($partner_id!='all'){
			 $txtPartnerID =" AND partner_id='".$partner_id."' ";
		 }else{
			 $txtPartnerID ="";
		 }
		 
		 if($dataID!='all'){
			 $txtDataID = " AND id='".$dataID."' ";
		 }else{
			  $txtDataID = "";
		 }
		 
		 if($dateStart!='all'){
			 $dateStartArray = explode("/",$dateStart);
			 $dateSelect = $dateStartArray[2]."-".$dateStartArray[1]."-".$dateStartArray[0];
			 
			 
			 $dateSelect = date("d M Y", strtotime($dateSelect));
			 
			 $txtDate =" AND ( dateGo ='".$dateSelect."' OR backDate ='".$dateSelect."' )";
		 }else{
			 $txtDate='';
		 }
		 
		 $sql="SELECT *, ((DAdultPrice*NAdult)+(DChildPrice*NChild)) AS totalDepartPrice , ((RAdultPrice*NAdult)+(RChildPrice*NChild)) AS totalReturnPrice  FROM  tbl_travel_booking  WHERE 1 $txtBookStatus $txtPayment $txtPayment_type $txtDate $txtDataID  ORDER BY id DESC ";
		 $result = $this->db->query($sql);
		 return $result;
	 }

	 //------------------------ 
	 function confirmTransportBookPayment($DataID=NULL,$payment_status=NULL){
		 
		 $data=array('payment_status'=>$payment_status, 'user_edit'=>$this->session->userdata('user_id'));
		 $this->db->where('id', $DataID);
		 if($this->db->update('tbl_travel_booking',$data)){
		    $pass=1;
		}else{
			$pass='0';
		}
		 
		 return $pass;
	 }
	 
	 //------------------------ 
	 function chTransportBookStatus($booking_status,$DataID){
		 $data=array('booking_status'=>$booking_status, 'user_edit'=>$this->session->userdata('user_id'));
		 $this->db->where('id', $DataID);
		 if($this->db->update('tbl_travel_booking',$data)){
		    $pass=1;
		}else{
			$pass='0';
		}
		 
		 return $pass;
	 }
	              //---------------------------
        function getbooking($booking_no=NULL) {
            $sql = "SELECT *  FROM tbl_travel_booking WHERE booking_no = '".$booking_no."'";
            $query = $this->db->query($sql);

        return $query;
    }
    //---------------------------  
	function listLand($rout_active=NULL,$dataID=NULL,$partnerID=NULL){
		
		if($rout_active !=''){
			$this->db->where('rout_active', $rout_active);
		}
		
		/*if($paper_no !=''){
			$this->db->where('paper_no', $paper_no);
		}*/
		if($dataID !=''){
			$this->db->where('id', $dataID);
		}
		$this->db->where('partner_id', $partnerID);
		$this->db->select('*');
		$this->db->order_by('id','ASC');
		$query = $this->db->get('tbl_landtransfer');
		
		return $query;		
	}
	 //------------------------------------------------------   
	 function insertLand($route_name_en=NULL, $begin_place_id=NULL, $destination_place_id=NULL){		 
			
		 $data = array(
         'route_name_en' => $route_name_en,
         'begin_place_id' => $begin_place_id,
         'destination_place_id' => $destination_place_id,
         'rout_active' => '1');
         		  
         if($this->db->insert('tbl_landtransfer', $data)){				 
			//$pass=1;
			$pass = $this->db->insert_id();  
		 }else{
			$pass=0;
			//$this->db->_error_message(); 
		 }		
		 return $pass;		 
	}
        //--------------------------- 
	function editLand($route_name_en=NULL, $begin_place_id=NULL, $destination_place_id=NULL, $dataID=NULL){		 
			
		 $data = array(
         'route_name_en' => $route_name_en,
         'begin_place_id' => $begin_place_id,
         'destination_place_id' => $destination_place_id);
		
         $this->db->where('id', $dataID);
		 if($this->db->update('tbl_landtransfer', $data)){				 
			//$pass=1;
			$pass = $dataID;  
		 }else{
			$pass=0;
			//$this->db->_error_message(); 
		 }		
		 return $pass;		 
	}
        //--------------------------- 	 
	function loadland($dataID=NULL){
			
		if($dataID !=''){
			$this->db->where('landtransfer_id', $dataID);
		}
		
		$this->db->select('*');
		$this->db->order_by('time_start','ASC');
		$query = $this->db->get('tbl_pricelandtransfer');
		
		return $query;		
	}
        //------------------------------------------------------   
	 function insertpriceLand($time_start=NULL, $time_end=NULL, $transport=NULL,$price=NULL,$landID=NULL,$pricelandID=NULL){		
         $today = date("Y-m-d H:i:s");
         if($pricelandID==''){
	 $data = array(
         'landtransfer_id' => $landID,
         'transport_id' => $transport,
         'price' => $price,
         'time_start' => $time_start,
         'time_end' => $time_end,
         'date_add' => $today,
         'data_status' => '1');
         		  
         if($this->db->insert('tbl_pricelandtransfer', $data)){				 
			//$pass=1;
			$pass = $this->db->insert_id();  
		 }else{
			$pass=0;
			//$this->db->_error_message(); 
		 }
         }else{
            $data = array(
         'landtransfer_id' => $landID,
         'transport_id' => $transport,
         'price' => $price,
         'time_start' => $time_start,
         'time_end' => $time_end,
         'date_add' => $today);
           $this->db->where('id', $pricelandID);
         if($this->db->update('tbl_pricelandtransfer', $data)){				 
			
			$pass = $pricelandID;  
		 }else{
			$pass=0;
			//$this->db->_error_message(); 
		 } 
         }
		 return $pass;		 
	}
	//---------------------------
        function getpriceland($landid=NULL) {
            $sql = "SELECT a.*,b.transport_name,b.id AS tranid ,concat(a.time_start,a.time_end) AS time  FROM tbl_pricelandtransfer AS a LEFT JOIN tbl_transportforland AS b ON a.transport_id = b.id WHERE a.landtransfer_id = '".$landid."' AND a.data_status = '1' ORDER BY a.time_start ASC";
            $query = $this->db->query($sql);

        return $query;
    }
	 //--------------------------
	 function getVehicleinRoute($landid=NULL){
		 $sql="SELECT DISTINCT(a.transport_id) AS tranID , b.transport_name FROM tbl_pricelandtransfer AS a LEFT JOIN tbl_transportforland AS b ON a.transport_id = b.id WHERE a.landtransfer_id='".$landid."' ORDER BY b.id ASC ";
		 $query=$this->db->query($sql);
		 return $query;
	 }
	  //--------------------------
	 function gettime($landid=NULL){
		 $sql="SELECT concat(time_start,time_end) AS time,time_start , time_end FROM `tbl_pricelandtransfer` WHERE landtransfer_id = '".$landid."' GROUP BY time ORDER BY time_start ASC ";
		 $query=$this->db->query($sql);
		 return $query;
	 }
         //--------------------------- 	 
	function listprice($tranid=NULL,$timestart=NULL,$timeend=NULL){
			
		$sql="SELECT *  FROM `tbl_pricelandtransfer` WHERE transport_id = '".$tranid."' AND time_start = '".$timestart."' AND time_end = '".$timeend."'  ";
		 $query=$this->db->query($sql);
		
		return $query;		
	}
     //--------------------------------
    function generateRandomString() {
		$alphabet = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
    //--------------------------------
    function bookinglandfirst($landbook_id=NULL,$keygroup=NULL,$priceland_id=NULL,$partner_id=NULL,$Adults=NULL,$datedata=NULL,$Adultspepreple=NULL,$Children=NULL){
        $today = date("Y-m-d H:i:s");
        if($landbook_id ==''){
	 $data = array(
         'Booking_id' => $keygroup,
         'date_booking' => $today,
         'partner_id' => $partner_id,
         'depart_date' => $datedata,
         'adult' => $Adultspepreple,
         'child' => $Children,
         'booking_status' => '0');
         		  
         if($this->db->insert('tbl_landtransferbooking', $data)){
             $landbook_id = $this->db->insert_id();
			 $data1 = array(
         'landbooking_id' => $landbook_id,
         'priceland_id' => $priceland_id,
         'transport_amount' => $Adults,
         'date_booking' => $today);
                if($this->db->insert('tbl_landbookdetail', $data1)){
                    $pass = $this->db->insert_id();
                }else{
                    $pass = 0;
                } 
		 }else{
			$pass = 0;
			
		 }
         }else{
          $data2 = array(
         'landbooking_id' => $landbook_id,
         'priceland_id' => $priceland_id,
         'transport_amount' => $Adults,
         'date_booking' => $today);
                if($this->db->insert('tbl_landbookdetail', $data2)){
                    $pass = $this->db->insert_id();
                }else{
                    $pass = 0;
                } 
         }
		 return $landbook_id.','.$pass;		
    }
      //--------------------------------
    function updateday($landbook_id=NULL,$Adults=NULL,$datedata=NULL,$Children=NULL){
        $today = date("Y-m-d H:i:s");
          $data = array(
         'adult' => $Adults,
         'child' => $Children,
         'depart_date' => $datedata,
         'date_booking' => $today);
           $this->db->where('id', $landbook_id);
         if($this->db->update('tbl_landtransferbooking', $data)){	
                    $pass = $landbook_id;
                }else{
                    $pass = 0;
                } 
		 return $pass;		
    }
      //--------------------------------
    function updatetran($landbook_id=NULL,$priceland_id=NULL,$Adults=NULL,$landdetailid=NULL){
        
        
        $today = date("Y-m-d H:i:s");
          $data = array(
         'landbooking_id' => $landbook_id,
         'priceland_id' => $priceland_id,
         'transport_amount' => $Adults,
         'date_booking' => $today);
           $this->db->where('id', $landdetailid);
         if($this->db->update('tbl_landbookdetail', $data)){	
                    $pass = $landdetailid;
                }else{
                    $pass = 0;
                } 
		 return $landbook_id.','.$pass;		
    }
      //--------------------------------
    function updatecharter($charterbook_id=NULL,$charterid=NULL,$Adults=NULL,$charterdetailid=NULL){
        
        
        $today = date("Y-m-d H:i:s");
          $data = array(
         'charterbooking_id' => $charterbook_id,
         'charter_id' => $charterid,
         'transport_amount' => $Adults,
         'date_booking' => $today);
           $this->db->where('id', $charterdetailid);
         if($this->db->update('tbl_charterbookdetail', $data)){	
                    $pass = $charterdetailid;
                }else{
                    $pass = 0;
                } 
		 return $charterbook_id.','.$pass;		
    }
     //------------------------------ 
	function check_keygroup($keygroup=NULL){
		$sql = "SELECT * FROM `tbl_landtransferbooking` WHERE Booking_id ='".$keygroup."' ";
        $query = $this->db->query($sql);
		$numkeygroup = $query->num_rows();			
		return $numkeygroup;		
	}
     //------------------------------ 
	function deletelandbookdetail($landbook_id=NULL,$landbookdetail_id=NULL){
		$sql = "DELETE FROM `tbl_landbookdetail` WHERE landbooking_id = '".$landbook_id."' AND id = '".$landbookdetail_id."'";
        if($this->db->query($sql)){
            $query = 1;
        }else{
            $query = 0;
        }
		return $query;		
	}
     //------------------------------ 
	function deletelandbookdetailbyid($landbook_id=NULL,$landbookdetail_id=NULL,$arrayid=NULL){
            $arrayid = explode('||',$arrayid);
                for($i=0;$i<count($arrayid);$i++){
                    $iddel = $arrayid[$i];
                    $sql = "DELETE FROM `tbl_landbookdetail` WHERE landbooking_id = '".$landbook_id."' AND priceland_id = '".$iddel."'";
        if($this->db->query($sql)){
            $query = 1;
        }else{
            $query = 0;
        }
                }
		return $query;		
	}
     //------------------------------ 
	function deletecharterbookdetailbyid($charterbook_id=NULL,$charterbookdetail_id=NULL,$arrayid=NULL){
            $arrayid = explode('||',$arrayid);
                for($i=0;$i<count($arrayid);$i++){
                    $iddel = $arrayid[$i];
                    $sql = "DELETE FROM `tbl_charterbookdetail` WHERE charterbooking_id = '".$charterbook_id."' AND charter_id = '".$iddel."'";
        if($this->db->query($sql)){
            $query = 1;
        }else{
            $query = 0;
        }
                }
		return $query;		
	}
        //-----------------------------------
        function getlandbooking($keygroup=NULL){
            $sql = "SELECT * FROM `tbl_landtransferbooking` WHERE Booking_id = '".$keygroup."'";
            $query = $this->db->query($sql);
		return $query;		
        }
        //-----------------------------------
        function getlandbookdetail($landbook_id=NULL){
            $sql = "SELECT a.*,b.time_start,b.landtransfer_id,b.transport_id,b.time_end,a.transport_amount FROM `tbl_landbookdetail` AS a LEFT JOIN tbl_pricelandtransfer AS b ON a.priceland_id = b.id WHERE  a.landbooking_id = '".$landbook_id."' ORDER BY b.time_start ASC";
            $query = $this->db->query($sql);
		return $query;		
        }
        //-----------------------------------
        function getlandbookdetailbytime($landbook_id=NULL,$timestart=NULL,$timeend=NULL){
            $sql = "SELECT a.*,b.time_start,b.landtransfer_id,b.transport_id,b.time_end FROM `tbl_landbookdetail` AS a LEFT JOIN tbl_pricelandtransfer AS b ON a.priceland_id = b.id WHERE  a.landbooking_id = '".$landbook_id."' AND b.time_start = '".$timestart."' ANd b.time_end = '".$timeend."' ORDER BY b.time_start ASC";
            $query = $this->db->query($sql);
		return $query;		
        }
        //-----------------------------------
        function getlandbookdetailgroupby($landbook_id=NULL){
            $sql = "SELECT a.*,b.time_start,b.landtransfer_id,b.transport_id,b.time_end,concat(b.time_start,b.time_end) AS time FROM `tbl_landbookdetail` AS a LEFT JOIN tbl_pricelandtransfer AS b ON a.priceland_id = b.id WHERE  a.landbooking_id = '".$landbook_id."' GROUP BY time ORDER BY b.time_start ASC";
            $query = $this->db->query($sql);
		return $query;	
        }
        //-----------------------------------
        function getlandtransfer($priceland_id=NULL){
            $sql = "SELECT a.*,b.route_name_en FROM `tbl_pricelandtransfer` AS a LEFT JOIN `tbl_landtransfer` AS b ON a.landtransfer_id = b.id WHERE  a.id = '".$priceland_id."'";
            $query = $this->db->query($sql);
		return $query;		
        }
        //--------------------------------
    function updatelandbook($landbookid=NULL,$cust_name=NULL,$cust_lastname=NULL,$cust_email=NULL,$cust_telephone_num=NULL,$line_id=NULL,$sumprice=NULL){
        if($landbookid !=''){
	 $data = array(
         'customer_name' => $cust_name,
         'customer_Lastname' => $cust_lastname,
         'customer_email' => $cust_email,
         'customer_telephone' => $cust_telephone_num,
         'Line_id' => $line_id,
         'total_price' => $sumprice,
         'booking_status' => '1');
         $this->db->where('id', $landbookid);
         if($this->db->update('tbl_landtransferbooking', $data)){				 
			$pass = $landbookid;  
		 }else{
			$pass=0;
		 }
         }else{
                    $pass = 0;
         }
		 return $pass;		
    }
     //------------------------
	 function landbook_booking_list($booking_status=NULL,$dataID=NULL,$datebook=NULL,$SearchBooking=NULL,$cfstatusno1=NULL,$cfstatusno2=NULL,$cfstatus=NULL,$SearchBookingpart=NULL){
                  if($SearchBookingpart==''){
                    $SearchBookingpart = 'all';
                }else{
                    $SearchBookingpart = $SearchBookingpart;
                }
             
		 if($booking_status!='all'){
			 $txtBookStatus=" AND booking_status='".$booking_status."' ";
		 }else{
			 $txtBookStatus="";
		 }
		 if(($cfstatusno1!='all')&&($cfstatusno2!='all')){
			 $txtcfStatusno=" AND cf_status!='".$cfstatusno1."' AND cf_status!='".$cfstatusno2."' ";
		 }else{
			 $txtcfStatusno="";
		 }
		 if($cfstatus!='all'){
			 $txtcfStatus=" AND cf_status='".$cfstatus."' ";
		 }else{
			 $txtcfStatus="";
		 }
		 if($dataID!='all'){
			 $txtDataID = " AND id='".$dataID."' ";
		 }else{
			  $txtDataID = "";
		 }
		 if($SearchBookingpart!='all'){
			 $txtpartner_id = " AND Booking_id LIKE '%".$SearchBookingpart."%' ";
		 }else{
			  $txtpartner_id = "";
		 }
		 if($SearchBooking!='all'){
			 $txtname = " AND customer_name LIKE '%".$SearchBooking."%' OR customer_Lastname LIKE '%".$SearchBooking."%' OR Booking_id LIKE '%".$SearchBooking."%' ";
		 }else{
			  $txtname = "";
		 }
		 if($datebook!='all'){
			 $dateStartArray = explode("/",$datebook);
			 $dateSelect = $dateStartArray[2]."-".$dateStartArray[1]."-".$dateStartArray[0];
			 //$dateSelect = date("d M Y", strtotime($dateSelect));
			 $txtDate =" AND  date_booking  LIKE  '%".$dateSelect."%'";
		 }else{
			 $txtDate='';
		 }
		 
		 $sql="SELECT * FROM  tbl_landtransferbooking  WHERE 1 $txtBookStatus $txtcfStatusno $txtcfStatus $txtDate $txtDataID $txtname $txtpartner_id  ORDER BY id DESC ";
		 $result = $this->db->query($sql);
		 return $result;
	 }
   //----------------------------------------
   function updatecfstatus($dataID=NULL,$cfstatus=NULL){
       $data = array(
         'cf_status' => $cfstatus);
         $this->db->where('id', $dataID);
         if($this->db->update('tbl_landtransferbooking', $data)){				 
			$pass = $dataID;  
		 }else{
			$pass=0;
		 }
   }
   //----------------------------------------
   function updatecfstatusch($dataID=NULL,$cfstatus=NULL){
       $data = array(
         'cf_status' => $cfstatus);
         $this->db->where('id', $dataID);
         if($this->db->update('tbl_charterbooking', $data)){				 
			$pass = $dataID;  
		 }else{
			$pass=0;
		 }
   }
   //---------------------------  
	function listcharter($data_status=NULL,$dataID=NULL,$partnerID=NULL){
		
		if($data_status !=''){
			$this->db->where('data_status', $data_status);
		}
		
		/*if($paper_no !=''){
			$this->db->where('paper_no', $paper_no);
		}*/
		if($dataID !=''){
			$this->db->where('id', $dataID);
		}
		$this->db->where('partner_id', $partnerID);
		$this->db->select('*');
		$this->db->order_by('id','ASC');
		$query = $this->db->get('tbl_charter_boat');
		
		return $query;		
	}
             //--------------------------- 	 
	function loadcharter($partnerID=NULL,$dataid=NULL){
                if($partnerID!=''){
                    $txtpart = "AND a.partner_id = '$partnerID'";
                }else{
                    $txtpart = '';
                }	
                if($dataid!=''){
                    $txtdataid = "AND a.id = '$dataid'";
                }else{
                    $txtdataid = '';
                }	
		$sql="SELECT a.*,b.boat_size,c.boat_trip FROM  tbl_charter_boat AS a LEFT JOIN tbl_boatsize AS b ON a.boat_sizeid = b.id LEFT JOIN tbl_boat_trip AS c ON a.boattrip_id = c.id WHERE a.data_status = '1' $txtpart $txtdataid ORDER BY id DESC ";
		 $result = $this->db->query($sql);
		
		return $result;		
	}
        //------------------------------------------------------   
	 function insertpricecharter($Boatid=NULL, $boattrip_id=NULL, $price=NULL,$charterid=NULL){
         $today = date("Y-m-d H:i:s");
         if($charterid==''){
	 $data = array(
         'boat_sizeid' => $Boatid,
         'boattrip_id' => $boattrip_id,
         'price' => $price,
         'partner_id' => '1',
         'date_add' => $today,
         'data_status' => '1');
         		  
         if($this->db->insert('tbl_charter_boat', $data)){				 
			//$pass=1;
			$pass = $this->db->insert_id();  
		 }else{
			$pass=0;
			//$this->db->_error_message(); 
		 }
         }else{
            $data = array(
        'boat_sizeid' => $Boatid,
         'boattrip_id' => $boattrip_id,
         'price' => $price,
         'date_add' => $today);
           $this->db->where('id', $charterid);
         if($this->db->update('tbl_charter_boat', $data)){				 
			
			$pass = $charterid;  
		 }else{
			$pass=0;
			//$this->db->_error_message(); 
		 } 
         }
		 return $pass;		 
	}
             //-----------------------------------
        function getcharterbooking($keygroup=NULL){
            $sql = "SELECT * FROM `tbl_charterbooking` WHERE Booking_id = '".$keygroup."'";
            $query = $this->db->query($sql);
		return $query;		
        }
         //-----------------------------------
        function getcharterbookdetail($charterbook_id=NULL){
            $sql = "SELECT * FROM `tbl_charterbookdetail`  WHERE  charterbooking_id = '".$charterbook_id."' ORDER BY date_booking ASC";
            $query = $this->db->query($sql);
		return $query;		
        }
         //--------------------------
	 function getboatinRoute(){
		 $sql="SELECT DISTINCT(a.boat_sizeid) AS boat_sizeid , b.boat_size FROM tbl_charter_boat AS a LEFT JOIN tbl_boatsize AS b ON a.boat_sizeid = b.id ORDER BY b.id ASC ";
		 $query=$this->db->query($sql);
		 return $query;
	 }
          //--------------------------
	 function getchartergrop(){
		 $sql="SELECT a.*,b.boat_size,c.boat_trip FROM  tbl_charter_boat AS a LEFT JOIN tbl_boatsize AS b ON a.boat_sizeid = b.id LEFT JOIN tbl_boat_trip AS c ON a.boattrip_id = c.id WHERE a.data_status = '1' AND a.partner_id = '1' GROUP BY a.boattrip_id ORDER BY id ASC ";
		 $query=$this->db->query($sql);
		 return $query;
	 }
          //--------------------------
	 function getcharterbyboatsize($boatsize=NULL,$boattrip=NULL){
		 $sql="SELECT * FROM  tbl_charter_boat  WHERE boat_sizeid = '".$boatsize."' AND boattrip_id = '".$boattrip."' AND data_status = '1' AND partner_id = '1'";
		 $query=$this->db->query($sql);
		 return $query;
	 }
          //--------------------------------
    function bookingcharterfirst($charterbook_id=NULL,$keygroup=NULL,$charterid=NULL,$partner_id=NULL,$Adults=NULL,$datedata=NULL,$Adultspepreple=NULL,$Children=NULL){
        $today = date("Y-m-d H:i:s");
        if($charterbook_id ==''){
	 $data = array(
         'Booking_id' => $keygroup,
         'date_booking' => $today,
         'partner_id' => $partner_id,
         'depart_date' => $datedata,
         'adult' => $Adultspepreple,
         'child' => $Children,
         'booking_status' => '0');
         		  
         if($this->db->insert('tbl_charterbooking', $data)){
             $charterbook_id = $this->db->insert_id();
			 $data1 = array(
         'charterbooking_id' => $charterbook_id,
         'charter_id' => $charterid,
         'transport_amount' => $Adults,
         'date_booking' => $today);
                if($this->db->insert('tbl_charterbookdetail', $data1)){
                    $pass = $this->db->insert_id();
                }else{
                    $pass = 0;
                } 
		 }else{
			$pass = 0;
			
		 }
         }else{
          $data2 = array(
         'charterbooking_id' => $charterbook_id,
         'charter_id' => $charterid,
         'transport_amount' => $Adults,
         'date_booking' => $today);
                if($this->db->insert('tbl_charterbookdetail', $data2)){
                    $pass = $this->db->insert_id();
                }else{
                    $pass = 0;
                } 
         }
		 return $charterbook_id.','.$pass;		
    }
       //------------------------------ 
	function deletecharterbookdetail($charterbook_id=NULL,$chartbookdetail_id=NULL){
		$sql = "DELETE FROM `tbl_charterbookdetail` WHERE charterbooking_id = '".$charterbook_id."' AND id = '".$chartbookdetail_id."'";
        $query = $this->db->query($sql);
		return $query;		
	}
           //-----------------------------------
        function getchearterbooking($keygroup=NULL){
            $sql = "SELECT * FROM `tbl_charterbooking` WHERE Booking_id = '".$keygroup."'";
            $query = $this->db->query($sql);
		return $query;		
        }
              //--------------------------------
    function updatecharterbook($charterbookid=NULL,$cust_name=NULL,$cust_lastname=NULL,$cust_email=NULL,$cust_telephone_num=NULL,$line_id=NULL,$sumprice=NULL){
        if($charterbookid !=''){
	 $data = array(
         'customer_name' => $cust_name,
         'customer_Lastname' => $cust_lastname,
         'customer_email' => $cust_email,
         'customer_telephone' => $cust_telephone_num,
         'Line_id' => $line_id,
         'total_price' => $sumprice,
         'booking_status' => '1');
         $this->db->where('id', $charterbookid);
         if($this->db->update('tbl_charterbooking', $data)){				 
			$pass = $charterbookid;  
		 }else{
			$pass=0;
		 }
         }else{
                    $pass = 0;
         }
		 return $pass;		
    }
     //------------------------
	 function charter_booking_list($booking_status=NULL,$dataID=NULL,$datebook=NULL,$SearchBooking=NULL,$cfstatusno1=NULL,$cfstatusno2=NULL,$cfstatus=NULL,$SearchBookingpart=NULL){
                  if($SearchBookingpart==''){
                    $SearchBookingpart = 'all';
                }else{
                    $SearchBookingpart = $SearchBookingpart;
                }
             
		 if($booking_status!='all'){
			 $txtBookStatus=" AND booking_status='".$booking_status."' ";
		 }else{
			 $txtBookStatus="";
		 }
		 if(($cfstatusno1!='all')&&($cfstatusno2!='all')){
			 $txtcfStatusno=" AND cf_status!='".$cfstatusno1."' AND cf_status!='".$cfstatusno2."' ";
		 }else{
			 $txtcfStatusno="";
		 }
		 if($cfstatus!='all'){
			 $txtcfStatus=" AND cf_status='".$cfstatus."' ";
		 }else{
			 $txtcfStatus="";
		 }
		 if($dataID!='all'){
			 $txtDataID = " AND id='".$dataID."' ";
		 }else{
			  $txtDataID = "";
		 }
		 if($SearchBookingpart!='all'){
			 $txtpartner_id = " AND Booking_id LIKE '%".$SearchBookingpart."%' ";
		 }else{
			  $txtpartner_id = "";
		 }
		 if($SearchBooking!='all'){
			 $txtname = " AND customer_name LIKE '%".$SearchBooking."%' OR customer_Lastname LIKE '%".$SearchBooking."%' OR Booking_id LIKE '%".$SearchBooking."%' ";
		 }else{
			  $txtname = "";
		 }
		 if($datebook!='all'){
			 $dateStartArray = explode("/",$datebook);
			 $dateSelect = $dateStartArray[2]."-".$dateStartArray[1]."-".$dateStartArray[0];
			 //$dateSelect = date("d M Y", strtotime($dateSelect));
			 $txtDate =" AND  date_booking  LIKE  '%".$dateSelect."%'";
		 }else{
			 $txtDate='';
		 }
		 
		 $sql="SELECT * FROM  tbl_charterbooking  WHERE 1 $txtBookStatus $txtcfStatusno $txtcfStatus $txtDate $txtDataID $txtname $txtpartner_id  ORDER BY id DESC ";
		 $result = $this->db->query($sql);
		 return $result;
	 }
         //---------------------------
	function deleteland($dataID=NULL){

	 	$this->db->where('id', $dataID);
                if($this->db->delete('tbl_landtransferbooking')){
                    $this->db->where('landbooking_id', $dataID);
                    $this->db->delete('tbl_landbookdetail');
                }		
			
		return 1;
	}
         //---------------------------
	function deletecharter($dataID=NULL){

	 	$this->db->where('id', $dataID);
                if($this->db->delete('tbl_charterbooking')){
                    $this->db->where('charterbooking_id', $dataID);
                    $this->db->delete('tbl_charterbookdetail');
                }		
			
		return 1;
	}
        //-----------------------------------
        function getpricelandtransfer($landsfer_id=NULL,$timestart=NULL,$timeend=NULL){
            $sql = "SELECT concat(time_start,time_end) AS time FROM  tbl_pricelandtransfer  WHERE landtransfer_id = '".$landsfer_id."' AND time_start = '".$timestart."' AND time_end = '".$timeend."' GROUP BY time ";
            $query = $this->db->query($sql);
		return $query;		
        }
        //-----------------------------------
        function getdetailbyid($landbook_id=NULL,$priceland_id=NULL){
            $sql = "SELECT * FROM  tbl_landbookdetail  WHERE landbooking_id = '".$landbook_id."' AND priceland_id = '".$priceland_id."' ";
            $query = $this->db->query($sql);
		return $query;		
        }
        //-----------------------------------
        function getdetailcharterbyid($charterbook_id=NULL,$charterid=NULL){
            $sql = "SELECT * FROM  tbl_charterbookdetail  WHERE charterbooking_id = '".$charterbook_id."' AND charter_id = '".$charterid."' ";
            $query = $this->db->query($sql);
		return $query;		
        }
        //---------------------------  
	function GetEngDate($day){
		$dateArray = explode("-",$day);
		$date= $dateArray[2];
		$mon= $dateArray[1];
		$year= $dateArray[0] ;
		//$monthArray = array("01"=>"มกราคม","02"=>"กุมภาพันธ์","03"=>"มีนาคม","04"=>"เมษายน", "05"=>"พฤษภาคม","06"=>"มิถุนายน","07"=>"กรกฏาคม","08"=>"สิงหาคม","09"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");
       $monthArray=Array("01"=>"January","02"=>"February","03"=>"March","04"=>"April","05"=>"May","06"=>"June","07"=>"July","08"=>"August","09"=>"September","10"=>"October","11"=>"November","12"=>"December");
		if($date < 10){ $date = str_replace("0", "", $date); } 
		return $date."&nbsp;".$monthArray[$mon]."&nbsp;".$year;
	} 
 //-----------------------------------
        function pricelandtran($landsfer_id=NULL,$tranid=NULL,$timesstart=NULL,$timeend=NULL){
            $sql = "SELECT * FROM  tbl_pricelandtransfer WHERE landtransfer_id = '".$landsfer_id."' AND transport_id = '".$tranid."' AND time_start = '".$timesstart.':00'."' AND time_end = '".$timeend.':00'."'";
            $query = $this->db->query($sql);
		return $query;		
        }
         //---------------------------  
	function GetEngDateTime($day){
		$DateTimeArray= explode(" ",$day);
		$dateArray = explode("-",$DateTimeArray[0]);
		$date= $dateArray[2];
		$mon= $dateArray[1];
		$year= $dateArray[0] ;
		//$monthArray = array("01"=>"มกราคม","02"=>"กุมภาพันธ์","03"=>"มีนาคม","04"=>"เมษายน", "05"=>"พฤษภาคม","06"=>"มิถุนายน","07"=>"กรกฏาคม","08"=>"สิงหาคม","09"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");
       $monthArray=Array("01"=>"January","02"=>"February","03"=>"March","04"=>"April","05"=>"May","06"=>"June","07"=>"July","08"=>"August","09"=>"September","10"=>"October","11"=>"November","12"=>"December");
		if($date < 10){ $date = str_replace("0", "", $date); } 
		return $date."&nbsp;".$monthArray[$mon]."&nbsp;".$year;
	} 
         //-----------------------------------
        function getcharterbookdetailgroupby($charterbook_id=NULL){
            $sql = "SELECT a.*,b.boat_sizeid,b.boattrip_id,concat(b.boattrip_id) AS boattrip FROM `tbl_charterbookdetail` AS a LEFT JOIN tbl_charter_boat AS b ON a.charter_id = b.id WHERE  a.charterbooking_id = '".$charterbook_id."' GROUP BY boattrip ORDER BY a.date_booking ASC";
            $query = $this->db->query($sql);
		return $query;	
        }
         //-----------------------------------
        function getcharterbookdetailbyid($charterbook_id=NULL,$boattrip_id=NULL){
            $sql = "SELECT a.*,b.boat_sizeid,b.boattrip_id FROM `tbl_charterbookdetail` AS a LEFT JOIN tbl_charter_boat AS b ON a.charter_id = b.id WHERE  a.charterbooking_id = '".$charterbook_id."' AND b.boattrip_id = '".$boattrip_id."'  ORDER BY a.date_booking ASC";
            $query = $this->db->query($sql);
		return $query;		
        }
         //-----------------------------------
        function getcharter_boat($charter_id=NULL){
            $sql = "SELECT a.*,b.boat_size FROM `tbl_charter_boat` AS a LEFT JOIN tbl_boatsize AS b ON a.boat_sizeid = b.id WHERE  a.id = '".$charter_id."' ORDER BY a.date_add ASC";
            $query = $this->db->query($sql);
		return $query;		
        }
        //--------------------------------
    function updatedaycharter($charterbook_id=NULL,$Adults=NULL,$datedata=NULL,$Children=NULL){
        $today = date("Y-m-d H:i:s");
          $data = array(
         'adult' => $Adults,
         'child' => $Children,
         'depart_date' => $datedata,
         'date_booking' => $today);
           $this->db->where('id', $charterbook_id);
         if($this->db->update('tbl_charterbooking', $data)){	
                    $pass = $charterbook_id;
                }else{
                    $pass = 0;
                } 
		 return $pass;		
    }










    //------------------------ 
	 
	 
 }
