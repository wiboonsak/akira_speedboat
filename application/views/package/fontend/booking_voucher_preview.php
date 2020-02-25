<?php
//============================================================+
// File name   : example_061.php
// Begin       : 2010-05-24
// Last Update : 2014-01-25
//
// Description : Example 061 for TCPDF class
//               XHTML + CSS
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: XHTML + CSS
 * @author Nicola Asuni
 * @since 2010-05-25
 */

// Include the main TCPDF library (search for installation path).
//require_once('tcpdf_include.php');
if($bookingid==''){
$bookingid = $this->uri->segment(3); 
}else{
    $bookingid = $bookingid;
}
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Akira Speedboat - Transport Booking ID # '.$bookingid.'');
//$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP,PDF_MARGIN_RIGHT);
$pdf->SetMargins(20, 10, 20, true);

$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);



// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// set font
$pdf->SetFont('thsarabun', '',16);


$pdf->AddPage('P', 'A4');
	$getlandbooking = $this->transport_model->getlandbooking($bookingid);
                    foreach ($getlandbooking->result() AS $getlandbookings){}
                    $datedata = $this->transport_model->GetEngDate($getlandbookings->depart_date);
                    $datebook = $this->transport_model->GetEngDateTime($getlandbookings->date_booking);
		
		$html = '<!doctype html>
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
    <div style="font-size: 2em;"><strong>Customer Name:</strong> '.$getlandbookings->customer_name.' '.$getlandbookings->customer_Lastname.'<br><strong>Phone:</strong> '.$getlandbookings->customer_telephone.'<br><strong>Email:</strong> '.$getlandbookings->customer_email.'<br><strong>Line ID: </strong>'.$getlandbookings->Line_id.'</div>

                        
</td>
    <td style="width:380px">  
    <div style="font-size: 3em;color: #3989c6;">BOOKING NO. '.$bookingid.'</div>
    <div style="font-size: 2em;"><strong>Departure Date:</strong> '.$datedata.'<br><strong>Number of Passenger:</strong> Adults x '.$getlandbookings->adult.'  |  Children x '.$getlandbookings->child.'</div>

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
    $html = $html.'
	<tr>
                            <td width="6%" class="no text-center" style="color: #fff;font-size: 2em;background-color: #3989c6;text-align: center!important;">'.$n.'</td>
                            <td width="20%" style="padding: 15px;background-color: #eee;border-bottom: 1px solid #fff;text-align: left!important;margin: 0;font-weight: 400;color: #3989c6;font-size: 2em;">'.$listTransport2->transport_name.'<br>('.number_format($priceland2->price,2).' x '.$getlandbookdetail2->transport_amount.')</td>
							<td width="20%" style="padding: 15px;background-color: #eee;border-bottom: 1px solid #fff;text-align: left!important;margin: 0;font-weight: 400;color: #3989c6;font-size: 2em;">'.$getlandtransfer2->route_name_en.'</td>                          
                            <td width="10%" style="padding: 15px;background-color: #eee;border-bottom: 1px solid #fff;font-size: 1em;text-align: center!important;font-size: 2em;">'.$timestart1.'</td>
							<td width="10%" style="padding: 15px;background: #eee;border-bottom: 1px solid #fff;font-size: 1em;text-align: center!important;background-color: #eee;font-size: 2em;">'.$timeend1.'</td>
                            <td width="30%" style="background: #3989c6;color: #fff;text-align: right;font-size: 1em;background-color: #3989c6;font-size: 2em;">'.number_format(intval($priceland2->price)*intval($getlandbookdetail2->transport_amount),2).' Baht &nbsp;&nbsp;</td>
                        </tr>';
        $n++;}}
        $html = $html.'
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


$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();
ob_clean();
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('booking_pdf_'.$bookingid.'.pdf', 'I');
//$pdf->Output(__DIR__ .'/transportPDF/booking_pdf_'.$bookingid.'.pdf', 'F');
//============================================================+
// END OF FILE
//============================================================+
