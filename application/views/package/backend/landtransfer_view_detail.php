<?php foreach($checkinData->result() AS $Data){}
?>
<style>
@media print {
    body * {
        visibility:hidden;
    }
}	
	
  </style>
<input type="hidden" name="DataId" id="DataID" value="<?php echo $DataID?>">
<input type="hidden" name="bookingID" id="bookingID" value="<?php echo $Data->Booking_id?>">
<div class="card" style="margin-top: -20px;">
   
    <div class="card-body" style="height: 100%">
		 
		<div id="printThis" >
            
			<div class="row">
			   <div class="col-md-5">
					<span>
                          <img src="<?php echo base_url('images/logo-header.png') ?>" alt="" width="90%" style="text-align:center" >
           			</span>
				
				</div>
			   <div class="col-md-7" style="vertical-align:middle; padding-top: 20PX;">
				<!--	<h5 class="card-title">รายละเอียดลูกค้า</h5>-->
		
		    <div class="row">
				<div class="col-4" style="text-align: right">ชื่อลูกค้า : </div>
				<div class="col-8"><?php echo $Data->customer_name." ".$Data->customer_Lastname?></div>
		     </div>	
			 <div class="row">
				<div class="col-4"  style="text-align: right">โทรศัพท์ :</div>
				<div class="col-8"> <a href="tel:<?php echo $Data->customer_telephone ?>">
												<?php echo $Data->customer_telephone ?>
												</a>		
				</div>
		    </div>	
		    <div class="row">
				<div class="col-4"  style="text-align: right">Email : </div>
				<div class="col-8"><?php echo $Data->customer_email?></div>
		    </div>	
		   <div class="row">
				<div class="col-4"  style="text-align: right">ID LINE : </div>
				<div class="col-8"><?php echo $Data->Line_id?></div>
		    </div>	
				
				</div>
			
			</div>
			
			
			
		  

		<hr>
		
		<h5 class="card-title">ข้อมูลหมายเลขการจอง : <span class="text-danger"><?php echo $Data->Booking_id; ?></span>&nbsp;วันที่จอง : <?php echo $Data->date_booking?></h5>
		
		
			<div class="row">
				
				<div class="col-md-12">
                  <?php 
                  $getlandbookdetail = $this->transport_model->getlandbookdetail($Data->id);
        $numlandbookdetail = $getlandbookdetail->num_rows();
        if($numlandbookdetail>0){
        foreach ($getlandbookdetail->result() AS $getlandbookdetail2){
        $landbookdetail_id = $getlandbookdetail2->id;
        $getlandtransfer = $this->transport_model->getlandtransfer($getlandbookdetail2->priceland_id);
        foreach ($getlandtransfer->result() AS $getlandtransfer2){}
        

        $listTransport = $this->transport_model->listTransport('Y',$getlandtransfer2->transport_id);
        foreach ($listTransport->result() AS $listTransport2){}
        $timestartarray = explode(":",$getlandtransfer2->time_start);
			$h = $timestartarray[0];
			$m = $timestartarray[1];
			$timestart1 = $h.":".$m;
                        
            $timeendarray = explode(":",$getlandtransfer2->time_end);
			$h1 = $timeendarray[0];
			$m1 = $timeendarray[1];
			$timeend1 = $h1.":".$m1;
                  
                  
                  
                  ?>
					
					<table class="table" width="100%">
													<tr>
        <td colspan="2" style="background-color:#E1E1E1"><?php echo $getlandtransfer2->route_name_en?> <span style="float:right"><?php echo $timestart1?> / <?php echo $timeend1?></span></td>
													</tr>
                                                                                                        <tr>
                   <td><span><?php echo $listTransport2->transport_name_en?></span></td><td align="right"><span ><?php echo number_format($getlandtransfer2->price,2)?></span></td>
               </tr>
               <input type="hidden" class="priceland" value="<?php echo $getlandtransfer2->price?>"/>

												</table>
        <?php } }?>	
					
				</div>
				
				
				
			
			</div>
		  <div class="col-12 bg-danger text-white" style="padding: 10px; text-align: right" >
		     Total Price : <?php echo number_format($Data->total_price,2);?>
			
		  </div>
		  </div>

		 <hr>
		
		<div class="row" >
                        <div class="col-md-12"><h5 class="card-title">สถานะคำสั่งจอง : <span id="TitleBookStatus" ><?php if($Data->cf_status !='0'){echo 'Confrimed';}else{echo 'Pending';}?></span></h5></div>
			
			<div class="row col-md-12" align="center" style="padding: 5px;">
	            <?php if($Data->booking_status=='1'){ ?>
                             <?php if(($Data->cf_status=='0')||($Data->cf_status=='1')){ ?>   
				<div class="col-md-4">
					<button type="button" class="btn btn-warning btn-sm" onClick="chBookStatus('Cancel','<?php echo $DataID?>')"><i class="fa fa-times-circle"></i> ยกเลิกการจอง</button>
					<div id="Cfcancel"  class="cfArea"  style="padding-top: 10px; padding-bottom: 5px;"></div>
				
				</div>
				<div class="col-md-4">
					<button type="button" class="btn btn-success btn-sm"  onClick="chBookStatus('Save','<?php echo $DataID?>')"><i class="fa fa-folder-o"></i> จัดเก็บประวัติ</button>
					<div id="CfHistory"  class="cfArea" style="padding-top: 10px; padding-bottom: 5px;"></div>
				</div>
				<div class="col-md-4" >
					<button type="button" class="btn btn-danger btn-sm"  onClick="chBookStatus('Delete','<?php echo $DataID?>')"><i class="fa fa-minus-circle"></i> ลบ</button>
					 <div id="CfDelete" class="cfArea" style="padding-top: 10px;padding-bottom: 5px;"></div>
				</div>
                            <?php }else{?>
                            <div class="col-md-12" style="text-align:center" >
					<button type="button" class="btn btn-danger btn-sm"  onClick="chBookStatus('Delete','<?php echo $DataID?>')"><i class="fa fa-minus-circle"></i> ลบ</button>
					 <div id="CfDelete" class="cfArea" style="padding-top: 10px;padding-bottom: 5px;"></div>
				</div>
			  <?php }?>  
			  <?php }?>  
				
			
		</div>
		
	</div>

</div>



