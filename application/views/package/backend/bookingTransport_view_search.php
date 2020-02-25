<form method="post" action="<?php echo base_url(); ?>PackageCMS/<?php if($booking_status!='3'){echo 'actionTran';}else{echo 'actionTran2';}?>">
     <input type="submit" name="export" class="btn btn-success" value="Excel" />
      <button type="button" id="printtable" onclick="printData1()" class="btn btn-info" >Print</button>
    </form>
<br>
<table id="table3" border="1" cellspacing='0' cellpedding="0" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">#</th>
                                        <th style="text-align:center;">หมายเลขการจอง</th>
                                         <th style="text-align:center;">ชื่อผู้จอง</th>
										<th style="text-align:center;">วันที่เดินทาง</th>
										<th style="text-align:center;">วันที่เดินทางกลับ</th>
                                        <th style="text-align:center;">จำนวนเงิน</th>
                                        <th style="text-align:center;">สถานะ</th>
                                        <th style="text-align:center;">วันที่ทำการจอง</th>
                                        <th style="text-align:center;">รายละเอียด</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
 <?php 
    $n=1;
    foreach ($checkinData->result() AS $Data) {?>	
                                        <tr id="row<?php echo $Data->id ?>" class="removech" <?php if($Data->payment_status=='1'){ echo 'style="background-color: #DAFFD8"';}?>  >
                                            <td style="text-align:center;"><?php echo $n?></td>
                                            <td><?php echo $Data->booking_no ?><br>
												<small class="text-primary">
													(<?php if($Data->travelRound=='return'){ echo "ไป-กลับ";}else if($Data->travelRound=='oneWay'){ echo "เทียวเดียว";}?>)</small>
											</td>
                                            
                                            <td><?php echo $Data->cust_name." ".$Data->cust_lastname?><br>
												<a href="tel:<?php echo $Data->cust_telephone_num ?>">
												<i class="icon-phone"></i>
												<?php echo $Data->cust_telephone_num ?>
												</a>		
											</td>
											<td style="text-align:center;"><?php echo $this->Package_model->GetthaiDateTimeeng($Data->dateGo)?><br><?php echo $Data->DepartTime?></td>
                                                                                        <td style="text-align:center;"><?php if($Data->ReturnDepartTime!=''){?><?php echo $this->Package_model->GetthaiDateTimeeng($Data->backDate)?><br><?php echo $Data->ReturnDepartTime?><?php }?></td>
											
                                            <td align="right"><?php $totalAll=($Data->totalDepartPrice+$Data->totalReturnPrice);
											   echo number_format($totalAll ,2)?></td> 
                                            <td>
										<?php if($Data->booking_status=='1'){ 
												   echo "<i class='dripicons-checkmark text-success'></i> ยืนยันการจอง";
											   }else if($Data->booking_status==0){ 
												   echo "<i class='fa fa-times-circle text-danger'></i> ไม่ยืนยันการจอง";
											   }else if($Data->booking_status==3){ 
												   echo "<i class='fa fa-times-circle text-danger'></i> ยกเลิกการจอง";
											   }else if($Data->booking_status==2){ 
												   echo "<i class=' dripicons-clock text-info'></i> ประวัติการจอง";
												 }else if($Data->booking_status==4){ 
												   echo "<i class='fa fa-times-circle text-danger'></i> ประวัติลบการจอง";   
											   }?><br>
												
												 <?php if($Data->payment_status=='1'){ echo "<i class='fa fa-money text-success'></i> ชำระเงินเรียบร้อย"; }else{echo "<i class='fa fa-money text-danger'></i> ยังไม่ชำระเงิน"; }?>
												
												  
                                                                                                 (<?php if($Data->payment_type=='1'){ echo "credit card";}else if($Data->payment_type=='2'){  echo "โอนเงิน";}else if($Data->payment_type=='0'){ echo "ยังไม่ระบุ"; }else{echo "Paypal";}?>)
												
											</td>
                                            <td style="text-align:center;"><?php echo $this->Package_model->GetthaiDateTime($Data->date_booking)?></td>
                                            <td><button type="button" class="btn btn-info btn-sm" onClick="ShowBookDetail('<?php echo $Data->id?>','<?php echo $Data->booking_no?>')">Detail</button></td>
                                           
                                        </tr>
                                    <?php $n++; }?>
                                </tbody>
                            </table>

<script>
   
	$('#table3').DataTable({
    		ordering: false,
		    pageLength:100
    });
                function printData1()
{
   var divToPrint=document.getElementById("table3");
      var htmlToPrint = '' +
        '<style type="text/css">' +
        'table th, table td {' +
        'border:1px solid #000;' +
        '}' +
        '</style>';
 htmlToPrint += divToPrint.outerHTML;
   newWin= window.open("");
   newWin.document.write(htmlToPrint);
   newWin.print();
   newWin.close();
}

</script>
