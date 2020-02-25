 <!-- Toastr css -->
<link href="<?php echo base_url('assets/plugins/jquery-toastr/jquery.toast.min.css')?>" rel="stylesheet" />

<table id="datatable" class="table table-bordered table-strip">
<thead>
	<tr>
		<th width="2">#</th>
		<th>route name</th>
		<th  align="right">adult_price</th>
		<th  align="right">child_price</th>
		<th  align="right">adult_price_net</th>
		<th  align="right">child_price_net</th>
		<th>import/remove</th>
		<!--<th>update</th>-->
		
	</tr>	
</thead>
<tbody>


<?php
    $n=1; 
	$data=json_decode($getRoute,true);//converts in array $data[]
    //print_r($data);
       
       foreach($data as $key=>$val){
		  // echo '<!---';
		  // echo 'code:'.$val['code'].' status:'.$val['status']." value:".$val['value']; duration
		   //echo '--->';
		   //print_r($val['value']);
		   foreach($val['value'] AS $dataValue){ 
	
			 $packValue=array('route_id'=>$dataValue['route_id'],'route_name'=>$dataValue['route_name'],'location_id_from'=>$dataValue['location_id_from'],'location_id_to'=>$dataValue['location_id_to'],'adult_price'=>$dataValue['adult_price'],'child_price'=>$dataValue['child_price'],'adult_price_net'=>$dataValue['adult_price_net'],'child_price_net'=>$dataValue['child_price_net'],'depart_time'=>$dataValue['depart_time'],'arrival_time'=>$dataValue['arrival_time'],'travel_by'=>$dataValue['travel_by'],'check_in_point'=>$dataValue['check_in_point'],'type'=>$dataValue['type'],'duration'=>$dataValue['duration']);
			   
			//array_push($packValue,$dataValue['route_id'],$dataValue['route_name'],$dataValue['location_id_from'],$dataValue['location_id_to'],$dataValue['adult_price'],$dataValue['child_price'],$dataValue['adult_price_net'],$dataValue['child_price_net'],$dataValue['depart_time'],$dataValue['arrival_time'],$dataValue['travel_by'],$dataValue['check_in_point'],$dataValue['type']);
	
			?>
		  <tr id="Route<?php echo $dataValue['route_id']?>"> 
			<td><?php echo $n?></td>
			<td>
			<span class="text-primary" style="font-weight: bold">
			<?php echo  $dataValue['route_name']?> 
			</span>	
			<br><small>
			depart_time : <?php echo  $dataValue['depart_time']?>
			, arrival_time : <?php echo  $dataValue['arrival_time']?>
			, type 	<?php echo  $dataValue['type']?>  : travel_by : <?php echo $dataValue['travel_by']?>
			<br>
			<?php echo $dataValue['location_id_from']?> > <?php echo $dataValue['location_id_to']?>
			</small>
			</td>
			<td align="right"><?php echo  $dataValue['adult_price']?></td>
			<td align="right"><?php echo  $dataValue['child_price']?></td>
			<td align="right"><?php echo  $dataValue['adult_price_net']?></td>
			<td align="right"><?php echo  $dataValue['child_price_net']?></td>
			<td> 
				<!--route_id route_name location_id_from location_id_to adult_price child_price adult_price_net child_price_net
	depart_time arrival_time duration travel_by check_in_point type-->
				
			<input type="hidden" name="routeValue<?php echo  $dataValue['route_id']?>" id="routeValue<?php echo  $dataValue['route_id']?>" value='<?php echo json_encode($packValue)?>'>
				
			<?php echo json_encode($packValue)."<br>"?>
				
		  <hr>
			<?php
				 
				    $a = $dataValue['duration'];

					if (strpos($a, 'Hrs') !== false) {
						$durationArray = explode(" ",$a);
						
						
						$hrMinArray = explode(".",$durationArray[0]);
						
						if(!isset($hrMinArray[1])){ $hrMinArray[1]=0;}
						
						echo 'HR '.$hrMinArray[0].":>".$hrMinArray[1].'<br>';
					}
			         if (strpos($a, 'Minutes') !== false) {
						$durationArray = explode(" ",$a); 
						echo 'MIN : '.$durationArray[0].'<br>';
					}
			   ?>
				
			<button type="button" class="btn btn-sm btn-success waves-light waves-effect" onClick="importRoute('<?php echo  $dataValue['route_id']?>')">
				<i class="fa fa-check-circle" id="fa<?php echo  $dataValue['route_id']?>" ></i> import</button> 
			</td>
			
			<!--<td><button type="button" class="btn btn-sm btn-success waves-light waves-effect"><i class="fa fa-refresh"></i> Update</button></button></td>-->
		</tr> 	  
		<?php
		 $n++; unset($packValue);	}
		   
	   } 
    
?>
</tbody>	
</table>
 <script type="text/javascript">
            $(document).ready(function() {

                // Default Datatable
                $('#datatable').DataTable({
					"paging":   false,
					"ordering": false,
					"info":     false
				});

                //Buttons examples
              
            } );
	 	$('.sk-three-bounce').css('display','none');
        </script>
