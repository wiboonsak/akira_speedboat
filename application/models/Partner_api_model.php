<?php 
 class Partner_api_model extends CI_Model
 { 
	 
	 ///----------------------------------------
	 function autoImportLocation($getLocationList,$partnerID){
		 $data=json_decode($getLocationList,true);
		 
		  foreach($data as $key=>$val){  
		  //------------ราม สถานที่ ของ partner เข้าด้วยกัน-----//
		  foreach($val['value'] AS $dataValue){ 
		 
		    $sql="SELECT COUNT(id) AS CountID  FROM tbl_place_data WHERE partner_location_id = '".$dataValue['location_id']."' AND partner_id='".$partnerID."' ";
		   $q = $this->db->query($sql);
		   $dataCount = $q->result_array();
		 
		   if($dataValue['check_in_location']==''){
			   $dataValue['check_in_location']=' ';
		   }	  
			  
			  
		   $data=array('place_name_th'=>'',
					   'place_name_en'=>$dataValue['location_name'],
					   'partner_id'=>$partnerID,
					   'partner_location_id'=>$dataValue['location_id'],
					   'partner_check_in_location'=>$dataValue['check_in_location'],
					   'partner_transfer_type'=>$dataValue['type'],
					   'place_active'=>'1'
					  );
		 
		  if($dataCount[0]['CountID']==0){
			  
			   $this->db->insert('tbl_place_data',$data);
		  }elseif($dataCount[0]['CountID']>0){
			  
			  $this->db->where('partner_location_id', $partnerID);
			  $this->db->where('partner_id', $partnerID);
			  $this->db->update('tbl_place_data',$data);
		  }
		 
		 }//end  foreach($val['value'] AS $dataValue)
			  
	  }//end  foreach($data as $key=>$val){ 

		 //---------get location list
		 	//$sql="SELECT * FROM tbl_partner_location ";
		    $sql="SELECT * FROM tbl_place_data WHERE  partner_id='".$partnerID."' ORDER BY id ASC ";
		    $result = $this->db->query($sql);
		 	return $result;	
		 
		 //------------แยกตารางสถานที่ partner ออกจากกัน -----//
		 /*
		 foreach($val['value'] AS $dataValue){ 
		   	  
			   $sql="SELECT COUNT(id) AS CountID FROM tbl_partner_location WHERE partner_location_id='".$dataValue['location_id']."' AND partner_id='".$partnerID."' ";
			   
			   $q = $this->db->query($sql);
			   $data = $q->result_array();
			   	
			   if($data[0]['CountID']==0){ 
			   	 $sql="INSERT INTO tbl_partner_location (id,partner_location_id,partner_location_name,partner_check_in_location,partner_type,partner_id,location_status) VALUES "
				   ."('','".$dataValue['location_id']."' , '".$dataValue['location_name']."' , '".$dataValue['check_in_location']."' , '".$dataValue['type']."', '".$partnerID."' ,'1' )";
			   	  $this->db->query($sql);
			   }else{
				  $sql="UPDATE tbl_partner_location SET  partner_location_name = '".$dataValue['location_name']."' , partner_check_in_location = '".$dataValue['check_in_location']."' ,  partner_type = '".$dataValue['type']."' WHERE  partner_location_id='".$dataValue['location_id']."' AND partner_id='".$partnerID."'  "; 
				   $this->db->query($sql); 
			   }
			 
		   }  */
		   //------end foreach
		 	
		  
	 }
	 ///----------------------------------------
	 function spc_import_route($routeValue=NULL){
		  $routeValue = json_decode($routeValue);
		 
		    //--------data SET 1  tbl_route_data
		   /*$routeValue->route_id;                 // tbl_route_data.partner_route_id
		   $routeValue->route_name;               // tbl_route_data.route_name_th
		   $routeValue->location_id_from;         // tbl_route_data.begin_place_id    
		   $routeValue->location_id_to;           // tbl_route_data.destination_place_id 
		   $routeValue->travel_by;                // tbl_route_data.partner_travel_by 
		   $routeValue->type;                     // tbl_route_data.partner_travel_type */
		 
		 $partner_route_id =$routeValue->route_id;
		 
		 $sqlCount = "SELECT COUNT(id) AS CountRouteDataID FROM tbl_route_data WHERE  partner_id='2' AND partner_route_id ='".$partner_route_id."' ";
		 $data=$this->db->query($sqlCount);
		 foreach($data->result() AS $countRow){}
 
		//echo 'CountRouteDataID->'.$countRow->CountRouteDataID;
	    //-----------------get place data------------//
		$sql="SELECT (SELECT id AS idForm FROM tbl_place_data WHERE partner_location_id='".$routeValue->location_id_from."'  AND partner_id='2') AS idFrom , (SELECT id AS idForm FROM tbl_place_data WHERE partner_location_id='".$routeValue->location_id_to."' AND partner_id='2') AS idTo FROM `tbl_place_data` LIMIT 1 ";	 
		$sqlResult = $this->db->query($sql);
		$dataCheck = $sqlResult->result_array();
		 
		$idFrom = $dataCheck[0]['idFrom'];
		$idTo = $dataCheck[0]['idTo'];
		
		//--------------------------------------------//
			 
			 
	 if($countRow->CountRouteDataID ==0){
			 $sql="INSERT INTO tbl_route_data "
			 ."(route_name_en , begin_place_id , destination_place_id , partner_id "
			 .",partner_route_id , partner_location_id_from ,partner_location_id_to , partner_travel_by , partner_travel_type ) VALUES "
			 ."( '".$routeValue->route_name."' ,'".$idFrom."' ,'".$idTo."' ,'2'  "
			 .",'".$routeValue->route_id."','".$routeValue->location_id_from."' ,'".$routeValue->location_id_to."' ,'".$routeValue->travel_by."','".$routeValue->type."'  )";
			 if($this->db->query($sql)){
				  $Step1 = 1;
				  $pass=1;
				  $route_id = $this->db->insert_id();
			 }else{
				  $pass=0;
				  $Step1 = 0;
				  $route_id = 0;
			 }
		 
		    //########################INSERT CHILD TABLE############### 
		 	  if($Step1==1){
					$a = $routeValue->duration;
					if (strpos($a, 'Hr') !== false) {
						$durationArray = explode(" ",$a);
						$hrMinArray = explode(".",$durationArray[0]);
						
						if(!isset($hrMinArray[1])){ $hrMinArray[1]=0;}
						//echo 'HR '.$hrMinArray[0].":>".$hrMinArray[1].'<br>';
						 $durationH = $hrMinArray[0];
						 $durationM = $hrMinArray[1];
					}
			         if (strpos($a, 'Minutes') !== false) {
						$durationArray = explode(" ",$a); 
						//echo 'MIN : '.$durationArray[0].'<br>';
						 $durationH = 0;
						 $durationM = $durationArray[0];
					}
				
				$transfer_h_time = $durationH;
				$transfer_m_time = $durationM;
				
				$data=array('route_id'=>$route_id 
							,'transport_id'=>'0'
							,'key_group'=>$route_id
							,'partner_id'=>'2'
							,'partner_travelby'=>$routeValue->travel_by
							,'partner_travel_type'=>$routeValue->type
							,'transfer_h_time'=>$transfer_h_time
							,'transfer_m_time'=>$transfer_m_time);
				
				 if($this->db->insert('tbl_route_type',$data)){
				 	$Step2 =1;
				 	$route_type_id = $this->db->insert_id();
					$resultImport=1;
				 }else{
					 $Step2 = 0;
					 $route_type_id=0;
					  $resultImport=0;
				 }
				
			

		 
		   //------------ tbl_route_timeTable ---------------//  $routeValue->duration;  
		 	$data=array('route_id'=>$route_id 
							,'route_type_id'=>$route_type_id
							,'arrive_time'=>$routeValue->depart_time
						    ,'arrival_time_2'=>$routeValue->arrival_time
							,'total_price'=>'0'
							,'data_order'=>'1'
							,'data_status'=>'1'
							,'partner_id'=>'2');
		      if($this->db->insert('tbl_route_timeTable',$data)){
				 	$Step3 =1;
				 	$timetableID = $this->db->insert_id();
				     $resultImport=1;
				 }else{
					 $Step3 = 0;
					 $timetableID=0;
				      $resultImport=0;
				 }
		   
		   
		   //---------data set 3  tbl_detailFor_timeTable  $routeValue->location_id_from $routeValue->location_id_to
           // $routeValue->adult_price;              //  tbl_detailFor_timeTable.price
           // $routeValue->child_price;              //  tbl_detailFor_timeTable.price_children
           // $routeValue->adult_price_net;          //  tbl_detailFor_timeTable.discount_price
           // $routeValue->child_price_net;          //  tbl_detailFor_timeTable.discount_chilg_price
           // $routeValue->depart_time;              //  tbl_detailFor_timeTable.arrive_time   *** สลับฟิลด์ ตอนสร้างโค้ด ***
           // $routeValue->arrival_time;             //  tbl_detailFor_timeTable.depart_time   *** สลับฟิลด์ ตอนสร้างโค้ด ***
          //  $routeValue->check_in_point;           //  tbl_detailFor_timeTable.note_checkin_en   
		 
		 	$data=array('timeTable_id'=>$timetableID
							,'transport_id'=>$route_type_id
							,'begin_place_id'=>$routeValue->location_id_from
							,'destination_place_id'=>$routeValue->location_id_to
							,'price'=>$routeValue->adult_price
							,'price_children'=>$routeValue->child_price
							,'discount_price'=> $routeValue->adult_price_net  
							,'discount_chilg_price'=>$routeValue->child_price_net
							,'data_order'=>'1'
							,'data_status'=>'1'
							,'partner_travel_by'=>$routeValue->travel_by
							,'partner_travel_type'=>$routeValue->type
							);
		        if($this->db->insert(' tbl_detailFor_timeTable',$data)){
				 	$Step4 =1;
				 	$DetailTimetableID = $this->db->insert_id();
				    $resultImport=1;
				 }else{
					$Step4 = 0;
					$DetailTimetableID=0;
				 	$resultImport=0;
				 }
		 
		 
				$data['successInsert']=array('step1'=>$Step1,'step2'=>$Step2,'step3'=>$Step3,'step4'=>$Step4);
			 
			} /// END if($Step1==1)
	
		 
		   //######################################################### $idFrom $idTo 
 		 }else if($countRow->CountRouteDataID > 0){
			 $sql="UPDATE tbl_route_data SET "
				  ." route_name_en = '".$routeValue->route_name."'  , begin_place_id = '".$idFrom."'  , destination_place_id = '".$idTo."'  "
				  ." ,partner_route_id = '".$routeValue->route_id."' , partner_location_id_from = '".$routeValue->location_id_from."'  ,partner_location_id_to = '".$routeValue->location_id_to."' , partner_travel_by = '".$routeValue->travel_by."' ,partner_travel_type='".$routeValue->type."' "
				 ." WHERE  partner_id='2' AND partner_route_id ='".$partner_route_id."' ";
			 if($this->db->query($sql)){
				 $pass=1;
				 $Step1 =1;
			 }else{
				 $pass=0;
				 $Step1 =0;
			 }
		 
		 	  //######################## UPDATE CHILD TABLE############### 
		      /// tbl_route_type -> route_id ,  tbl_route_timeTable->route_id ,  tbl_detailFor_timeTable ->timetalbe_id
		 
		 	  $sql="SELECT id FROM tbl_route_data WHERE partner_id='2' AND partner_route_id ='".$partner_route_id."' " ;
		      $resultData = $this->db->query($sql);
		      foreach($resultData->result() AS $mainData){}
		      $route_id = $mainData->id;
		 
		      $sql="SELECT id FROM tbl_route_timeTable WHERE route_id ='".$route_id."' ";
		      $resultData=$this->db->query($sql);
		      foreach($resultData->result() AS $detailTimeData){}
		      $timetableID = $detailTimeData->id;
		 	  
		      //-update route type---------//
		      	$a = $routeValue->duration;
					if (strpos($a, 'Hr') !== false) {
						$durationArray = explode(" ",$a);
						$hrMinArray = explode(".",$durationArray[0]);
						
						if(!isset($hrMinArray[1])){ $hrMinArray[1]=0;}
						//echo 'HR '.$hrMinArray[0].":>".$hrMinArray[1].'<br>';
						 $durationH = $hrMinArray[0];
						 $durationM = $hrMinArray[1];
					}
			         if (strpos($a, 'Minutes') !== false) {
						$durationArray = explode(" ",$a); 
						//echo 'MIN : '.$durationArray[0].'<br>';
						 $durationH = 0;
						 $durationM = $durationArray[0];
					}
				
				$transfer_h_time = $durationH;
				$transfer_m_time = $durationM;
				
				$data=array('transport_id'=>'0'
							,'key_group'=>$route_id
							,'partner_id'=>'2'
							,'partner_travelby'=>$routeValue->travel_by
							,'partner_travel_type'=>$routeValue->type
							,'transfer_h_time'=>$transfer_h_time
							,'transfer_m_time'=>$transfer_m_time);
		 
				 $this->db->where('route_id',$route_id);
				 if($this->db->update('tbl_route_type',$data)){
				 	$Step2 =1;
				 	$resultImport=1;
				 }else{
					 $Step2 = 0;
					 $resultImport=0;
				 }
		 	  //-update route timetable ---------//
		        $data=array( 'arrive_time'=>$routeValue->depart_time
							,'arrival_time_2'=>$routeValue->arrival_time
							,'total_price'=>'0'
							,'data_order'=>'1'
							,'data_status'=>'1'
							,'partner_id'=>'2');
		      $this->db->where('route_id',$route_id);
		      if($this->db->update('tbl_route_timeTable',$data)){
				 	$Step3 =1;
				 	$resultImport=1;
				 }else{
					 $Step3 = 0;
					 $resultImport=0;
				 }
		     //-----------------------------------//
		       $data=array('timeTable_id'=>$timetableID
							
							,'begin_place_id'=>$routeValue->location_id_from
							,'destination_place_id'=>$routeValue->location_id_to
							,'price'=>$routeValue->adult_price
							,'price_children'=>$routeValue->child_price
							,'discount_price'=> $routeValue->adult_price_net  
							,'discount_chilg_price'=>$routeValue->child_price_net
							,'data_order'=>'1'
							,'data_status'=>'1'
							,'partner_travel_by'=>$routeValue->travel_by
							,'partner_travel_type'=>$routeValue->type
							);
		         $this->db->where('timeTable_id',$route_id);
		        if($this->db->update(' tbl_detailFor_timeTable',$data)){
				 	$Step4 =1;
				    $resultImport=1;
				 }else{
					$Step4 = 0;
				 	$resultImport=0;
				 }
		 
		 
				$data['successUodate']=array('step1'=>$Step1,'step2'=>$Step2,'step3'=>$Step3,'step4'=>$Step4);
		 
		 	 //######################## END UPDATE CHILD TABLE###############  
		 
		 }  // end if if($countRow->CountRouteDataID > 0)
		 
		
		 
		return $resultImport;
		
	
	 }

	 //--------------------------------------------------- 
	 function spc_list_Route($rout_active=NULL,$routeID=NULL,$partnerID=NULL){
		
		 if($rout_active!=''){
			 $txtActive = " AND a.rout_active='".$rout_active."' ";
		 }else{
			$txtActive = " "; 
		 }
		
		 $sql="SELECT a.* , b.partner_location_name AS FromPlace , c.partner_location_name AS ToPlace "
		 ." , d.transfer_h_time , d.transfer_m_time , e.arrive_time AS DepartTime , e.arrival_time_2 AS ArriveTime "
		 ." , f.price , f.discount_price , f.price_children , f.discount_chilg_price "
		 ." FROM  tbl_route_data a "
		 ." LEFT JOIN  tbl_partner_location b ON a.partner_location_id_from = b.partner_location_id "	 
		 ." LEFT JOIN  tbl_partner_location c ON a.partner_location_id_to = c.partner_location_id "	
		 ." LEFT JOIN  tbl_route_type d ON a.id = d.route_id "	 
		 ." LEFT JOIN  tbl_route_timeTable e ON a.id = e.route_id "	 
		 ." LEFT JOIN   tbl_detailFor_timeTable f ON e.id=f.timeTable_id  "	 
		 ." WHERE a.partner_id ='".$partnerID."' $txtActive ORDER BY a.id ASC  "	 
		 ." ";
		 
		$result = $this->db->query($sql); 
		 
		return $result;		
	 }
	  //--------------------------------------------------- 
	 function spc_list_RouteWWW($rout_active=NULL,$routeID=NULL,$partnerID=NULL){
		
		 if($rout_active!=''){
			 $txtActive = " AND a.rout_active='".$rout_active."' ";
		 }else{
			$txtActive = " "; 
		 }
		
		 $sql="SELECT a.* , b.partner_location_name AS FromPlace , c.partner_location_name AS ToPlace "
		 ." , d.transfer_h_time , d.transfer_m_time , e.arrive_time AS DepartTime , e.arrival_time_2 AS ArriveTime "
		 ." , f.price , f.discount_price , f.price_children , f.discount_chilg_price "
		 ." FROM  tbl_route_data a "
		 ." LEFT JOIN  tbl_partner_location b ON a.partner_location_id_from = b.partner_location_id "	 
		 ." LEFT JOIN  tbl_partner_location c ON a.partner_location_id_to = c.partner_location_id "	
		 ." LEFT JOIN  tbl_route_type d ON a.id = d.route_id "	 
		 ." LEFT JOIN  tbl_route_timeTable e ON a.id = e.route_id "	 
		 ." LEFT JOIN   tbl_detailFor_timeTable f ON e.id=f.timeTable_id  "	 
		 ." WHERE a.partner_id ='".$partnerID."' $txtActive GROUP BY a.partner_location_id_from ORDER BY FromPlace ASC  "	 
		 ." ";
		 
		$result = $this->db->query($sql); 
		 
		return $result;		
	 }
	 //---------------------------------------------------
	 function spcShowOnWeb($dataID, $check, $table){
		   $data = array(
            'rout_active' => $check
        );
        $this->db->where('id', $dataID);
        if ($this->db->update($table, $data)) {
            $pass = 1;
        } else {
            $pass = 0;
            //$this->db->_error_message(); 
        }
        return $pass;
	 }
	 //---------------------------------------------------spc_deleteRoute

	function spc_deleteRoute($dataID=NULL,$table=NULL){
		
		$sql = "SELECT * FROM `tbl_booking_detail` WHERE route_id = '".$dataID."' ";
        $query = $this->db->query($sql);
		$numberCount = $query->num_rows();
		
		if($numberCount <1){
						
			$this->db->where('id', $dataID);	 		
			$this->db->delete('tbl_route_data');
			
			$sql="SELECT id FROM tbl_route_timeTable WHERE route_id ='".$dataID."' ";
			$resultData = $this->db->query($sql);
			foreach($resultData->result() AS $data){
				$sql = "DELETE FROM  tbl_detailFor_timeTable WHERE timeTable_id = '".$data->id."' ";
				$this->db->query($sql);
			}
			
			$sql = "DELETE FROM tbl_route_type WHERE route_id = '".$dataID."' ";
			$this->db->query($sql);

			$sql = "DELETE FROM tbl_route_timeTable WHERE route_id = '".$dataID."' ";
			$this->db->query($sql);
			
		} else {
			
			$data = array(			
			'rout_active' => '3');
		
			$this->db->where('id', $dataID);		
			$this->db->update('tbl_route_data', $data);			
		}
		
		return 1;
	}  
	 
	 

 } //end class
		