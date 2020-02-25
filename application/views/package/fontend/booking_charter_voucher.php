<!doctype html>
<html id="printData">
<head>
<meta charset="utf-8">
<title>Booking Transport || Akira Speedboat</title>
	
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	
	
<link rel="stylesheet" href="<?php echo base_url('html/css/invoice.css')?>">
<link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">

</head>
<style type="text/css" media="print">
.romoves{
    display:none;
}
</style>
<body>
	<?php $bookingid = $this->uri->segment(3);?>

<div id="invoice">

    <div class="toolbar hidden-print romoves" id="romoves">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info" onclick="printData('printData')"><i class="fa fa-print"></i> Print</button>
            <a href="<?php echo base_url('Welcome/PDF_charter_preview/').$bookingid?>" target="_blank"><button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button></a>
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto" >
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="#"> <img src="<?php echo base_url('images/logo-header.png')?>" data-holder-rendered="true" /></a>                    
                        <!--<h2 class="name">
                            <a target="_blank" href="#">Akira Speedboat</a>
                        </h2>  -->                      
                        <div>Phone: +66 (0) 98 161 6164</div>
                        <div>Email: booking@akiraspeedboat.com</div>
						<div>370 Moo 7 Koh Lipe, T.Koh Sarai, Muang, Satun 91000.</div>
                    </div>
                    		<?php 
                    
                     $getchearterbooking = $this->transport_model->getchearterbooking($bookingid);
                    foreach ($getchearterbooking->result() AS $getchearterbookings){}
                    $datedata = $this->transport_model->GetEngDate($getchearterbookings->depart_date);
                    $datebook = $this->transport_model->GetEngDateTime($getchearterbookings->date_booking);

?>	
					<div class="col invoice-details">
                        <h1 class="invoice-id">BOOKING TRANSPORT</h1>
                        <div class="date">Date of Booking: <?php echo $datebook?></div>
                    </div>
					
                </div>
            </header>

			
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <h5 class="text-gray-light">CUSTOMER:</h5>
                        <div class="to"><strong>Customer Name:</strong> <?php echo $getchearterbookings->customer_name.' '.$getchearterbookings->customer_Lastname?></div>
                        <div class="address"><strong>Phone:</strong> <?php echo $getchearterbookings->customer_telephone?></div>
                        <div class="email"><strong>Email:</strong> <?php echo $getchearterbookings->customer_email?></div>
						<div class="email"><strong>Line ID: </strong><?php echo $getchearterbookings->Line_id?></div>
                    </div>
                    <div class="col invoice-details">
                        <h5 class="invoice-id">BOOKING NO. <?php echo $bookingid?></h5>
                        <div class="date"><strong>Departure Date:</strong> <?php echo $datedata?></div>
						<div class="date"><strong>Number of Passenger:</strong> Adults x <?php echo $getchearterbookings->adult?>  |  Children x <?php echo $getchearterbookings->child?></div>
						<div class="date"></div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th class="text-center" width="10%">#</th>
                            <th class="text-center" width="30%">BOAT SIZE</th>
			<th class="text-center" width="30%">TRIP</th>
                            
                            <th class="text-center" width="30%">SAILING PRICE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1;
                                                                   
   $n = 1;
                        $getcharterbookdetail = $this->transport_model->getcharterbookdetail($getchearterbookings->id);
        $numcharterbookdetail = $getcharterbookdetail->num_rows();
        if($numcharterbookdetail>0){
        foreach ($getcharterbookdetail->result() AS $getcharterbookdetail2){
        $charterbookdetail_id = $getcharterbookdetail2->id;
        $loadcharter = $this->transport_model->loadcharter('1',$getcharterbookdetail2->charter_id);
         foreach ($loadcharter->result() AS $loadcharter2){}
                        ?>
                        <tr>
                            <td class="no text-center"><?php echo $n?></td>
                            <td class="text-left">
								<h3><div><?php echo $loadcharter2->boat_size?><br>(<?php echo number_format($loadcharter2->price,2)?> x <?php echo $getcharterbookdetail2->transport_amount?>)</div></h3>
                            </td>
							<td class="text-left">								
								<h3><div><?php echo $loadcharter2->boat_trip?></div></h3>                               
                            </td>                          
                            <td class="total"><?php echo number_format(intval($loadcharter2->price)*intval($getcharterbookdetail2->transport_amount),2)?> Baht</td>
                        </tr>
        <?php $n++;}}?>
                                            
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="1">GRAND TOTAL</td>
                            <td><?php echo number_format($getchearterbookings->total_price,2)?> Baht</td>
                        </tr>
                        <!--<tr>
                            <td colspan="3"></td>
                            <td colspan="2">TAX 25%</td>
                            <td>1,300.00</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>6,500.00</td>
                        </tr>-->
                    </tfoot>
                </table>
                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">The Price included Ferry ticket and Transfer, Please check in before 30 minutes.</div>
                </div>
            </main>
            <footer>
                This booking was created on a computer and is valid without the signature and seal.
            </footer>
            <input id="bookingid" name="bookingid" type="hidden" value="<?php echo $bookingid?>">
        </div>
       
    </div>
</div>
 <script>
     function printData(printData)
{
   
      var printContents = document.getElementById(printData).innerHTML; 
      var originalContents = document.body.innerHTML; 
             document.body.innerHTML = printContents; 
             window.print(); 
             document.body.innerHTML = originalContents;

}
 </script>	
</body>
</html>
