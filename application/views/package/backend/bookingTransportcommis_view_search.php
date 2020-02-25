     <form method="post" action="<?php echo base_url(); ?>PackageCMS/actionTran3">
     <input type="submit" name="export" class="btn btn-success" value="Excel" />
      <button type="button" id="printtable" onclick="printData1()" class="btn btn-info" >Print</button>
    </form>
<br>
<br>
<table id="table3" border="1" cellspacing='0' cellpedding="0" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                       <th style="text-align:center;">#</th>
                                        <th style="text-align:center;">หมายเลขการจอง</th>
                                        <th style="text-align:center;">เที่ยวไป</th>
                                        <th style="text-align:center;">เที่ยวกลับ</th>
                                         <th style="text-align:center;">ชื่อผู้จอง</th>
                                        <th style="text-align:center;">จำนวนเงิน</th>
                                        <th style="text-align:center;">คอมมิชชั่น</th>
                                        <th style="text-align:center;">คงเหลือ</th>
                                        <th style="text-align:center;">วันที่ทำการจอง</th>
                                    </tr>
                                </thead>
                                <tbody>
 <?php 
    $n=1;
    foreach ($checkinData->result() AS $Data) {?>	
                                        <tr id="row<?php echo $Data->id ?>" class="removech" >
                                            <td style="text-align:center;"><?php echo $n?></td>
                                            <td><?php echo $Data->booking_no ?><br>
												<small class="text-primary">
													(<?php if($Data->travelRound=='return'){ echo "ไป-กลับ";}else if($Data->travelRound=='oneWay'){ echo "เทียวเดียว";}?>)</small>
											</td>
                                              <td style="text-align:center;"><?php echo $Data->departName?><br><?php echo $this->Package_model->GetthaiDateTimeeng($Data->dateGo)?> <?php echo $Data->DepartTime?></td>
                                                                                        <td style="text-align:center;"><?php if($Data->returnName != ''){?><?php echo $Data->returnName?><br><?php echo $this->Package_model->GetthaiDateTimeeng($Data->backDate)?> <?php echo $Data->ReturnDepartTime?><?php }?></td>
                                            <td><?php echo $Data->cust_name." ".$Data->cust_lastname?><br>
												<a href="tel:<?php echo $Data->cust_telephone_num ?>">
												<i class="icon-phone"></i>
												<?php echo $Data->cust_telephone_num ?>
												</a>		
											</td>
                                            <td align="right"><?php $totalAll=($Data->totalDepartPrice+$Data->totalReturnPrice);
											   echo number_format($totalAll ,2)?></td> 
                                            <td align="right"><?php $commission = ($totalAll*$Data->commission_go)/100;
											   echo number_format($commission ,2)?></td> 
                                             <td align="right"><?php $balance = $totalAll-$commission;
											   echo number_format($balance ,2)?></td> 
                                            <td style="text-align:center;"><?php echo $this->Package_model->GetthaiDateTime($Data->date_booking)?></td>
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
