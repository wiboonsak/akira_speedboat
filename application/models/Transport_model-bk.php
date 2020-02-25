<?php 
 class transport_model extends CI_Model
 { 
	 
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
	function listRoute($rout_active=NULL,$dataID=NULL){
		
		if($rout_active !=''){
			$this->db->where('rout_active', $rout_active);
		}
		/*if($paper_no !=''){
			$this->db->where('paper_no', $paper_no);
		}*/
		if($dataID !=''){
			$this->db->where('id', $dataID);
		}
		
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
		$result = $route_id.'/'.$max_id;
		return $result;		 
		//return $max_id;		 
	} 
	//---------------------------  
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
	function do_insertTimes($all_data=NULL, $route_type_id=NULL, $route_id=NULL){	
		
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
		
		$count_arr = count($all_data['hr']);
		
		for($x=0; $x < $count_arr; $x++){
			
			if($all_data['hr'][$x] != ''){
			
				$max_id = $max_id + 1;
				
				$arrive_time[$x] = $all_data['hr'][$x].":".$all_data['min'][$x];
				
				
				 $data = array(
				 'route_id' => $route_id,
				 'route_type_id' => $route_type_id,
				 'arrive_time' => $arrive_time[$x],
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
		$sql = "SELECT * FROM `tbl_place_data`  $txt ";
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
	//--------------------------- 
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
	//---------------------------- 
	 function deleteRouteTime($TimeID){
		 if($this->db->delete('tbl_route_timetable', array('id' => $TimeID))){
			 $pass=1;
		 }else{
			 $pass=0;
		 }
		 return $pass;
	 }
	//---------------------------- 
	 
 }
