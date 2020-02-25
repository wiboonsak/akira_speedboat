<form method="post" action="<?php echo base_url(); ?>PackageCMS/actioncharter">
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
                                        <th style="text-align:center;">จำนวนเงิน</th>
                                        <th style="text-align:center;">สถานะ</th>
                                        <th style="text-align:center;">วันที่ทำการจอง</th>
                                        <th style="text-align:center;">เอกสารการจอง</th>
                                        <th style="text-align:center;">รายละเอียด</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
 <?php 
    $n=1;
    foreach ($checkinData->result() AS $Data) {?>	
                                        <tr id="row<?php echo $Data->id ?>" class="removech" <?php if($Data->cf_status=='1'){ echo 'style="background-color: #DAFFD8"';}?>  >
                                            <td style="text-align:center;"><?php echo $n?></td>
                                            <td style="text-align:center;"><?php echo $Data->Booking_id ?></td>
                                            <td><?php echo $Data->customer_name." ".$Data->customer_Lastname?><br>
												<a href="tel:<?php echo $Data->customer_telephone ?>">
												<i class="icon-phone"></i>
												<?php echo $Data->customer_telephone ?>
												</a>		
											</td>
                                            <td align="right"><?php echo number_format($Data->total_price ,2)?></td> 
                                            <td style="text-align:center;"><?php if($Data->cf_status=='1'){?><button type="button" class="btn btn-info btn-sm" disabled style="cursor:no-drop">Confrimed</button><?php }else{?><button type="button" class="btn btn-primary btn-sm" onclick="updatecfstatus('<?php echo $Data->id?>')">Pending</button><?php }?></td>
                                            <td style="text-align:center;"><?php echo $this->Package_model->GetthaiDateTime($Data->date_booking)?></td>
                                             <td style="text-align:center;"><a href="<?php echo base_url('application/views/package/fontend/transportPDF/booking_charter_pdf_'.$Data->Booking_id.'.pdf')?>" target="_blank"><i class="fa fa-file-pdf-o fa-2x" style="cursor:pointer;width: 15%"></i></a></td>
                                            <td style="text-align:center;"><button type="button" class="btn btn-info btn-sm" onClick="ShowBookDetail('<?php echo $Data->id?>','<?php echo $Data->Booking_id?>')">Detail</button></td>
                                           
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
