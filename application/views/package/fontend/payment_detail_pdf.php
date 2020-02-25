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

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Akira Speedboat - Transport Booking ID # '.$booking_no.'');
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
$pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);



// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('thsarabun', '',16);

// add a page
$pdf->AddPage();

/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */                   
	$txt = '';
		/*$emaildata = $this->input->post('email');
		$typedata = $this->input->post('type');
		$userID = $this->input->post('userID');*/					
             $checkinData2 = $this->transport_model->getbooking($booking_no);
             foreach($checkinData2->result() as $Data1){}

                $DataID = $Data1->id;
		$booking_status = $Data1->booking_status;
		$payment_status = 'all';
		$payment_type = 'all';
		$partner_id = 'all';
		$dateStart = 'all';
		$dateEnd = 'all';
		$checkinData = $this->transport_model->transport_booking_list($booking_status,$payment_status,$payment_type,$partner_id,$dateStart,$dateEnd,$DataID);
                
                foreach($checkinData->result() AS $Data){}

      if($Data->booking_status=='1'){
		  $txtbookStatus='<span class="text-primary">ยืนยันสั่งจอง</span>';
	  }else if($Data->booking_status=='2'){
		   $txtbookStatus='<span class="text-success">ประวัติสั่งจอง</span>';
	  }else if($Data->booking_status=='3'){
		   $txtbookStatus='<span class="text-danger">ยกเลิกสั่งจอง</span>';
	   }else if($Data->booking_status=='4'){
		   $txtbookStatus='<span class="text-danger">รายการลบคำสั่งจอง</span>';
	  }
          if($Data->travelRound=='return'){ $txt = "ไป-กลับ";}else if($Data->travelRound=='oneWay'){ $txt = "เทียวเดียว";}
          
$html = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Booking Package</title>
<style>
	body{
		margin: 15px 0px 0px;
		
	}
	tr td{
		font-family: tahoma, serif;
		font-size: 10pt;
		color: #56201D; 
	}
        .card{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(0,0,0,.125);border-radius:.25rem}
        .card-body{-ms-flex:1 1 auto;flex:1 1 auto;padding:1.25rem}
        .card-title{margin-bottom:.75rem}
        .col-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}.col-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}.col-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}
        .col-md-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}
        .table{width:100%;max-width:100%;margin-bottom:1rem;background-color:transparent}
        .text-danger{color:#dc3545!important}
        .row{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}
        .bg-danger{background-color:#dc3545!important}
        .text-white{color:#fff!important}
        .text-primary{color:#007bff!important}
</style>
 			
</head>
<body>
<div class="card" style="margin-top: -20px;">
  	<div class="card-body">
		 <div class="row">
			   
					<span>
                          <img src="http://www.ok-demo.com/akira_speedboat/images/logo-header.png" alt="" width="200px" style="text-align:center" >
           			</span>
				
		    <div class="">
				  ชื่อลูกค้า : '.$Data->cust_name.' '.$Data->cust_lastname.'<br>
                                โทรศัพท์ : <a href="tel: '.$Data->cust_telephone_num.'">'.$Data->cust_telephone_num.' </a><br>	
                                Email : '.$Data->cust_email.'<br>
                                ID LINE : '.$Data->line_id.'
		    </div>	
                    </div>
                    <hr>
		
                <h5 class="">ข้อมูลหมายเลขการจอง : <span style="color:red">'.$Data->booking_no.'</span>&nbsp;วันที่จอง : '. $Data->date_booking.'&nbsp;<small style="color:blue">'.$txt.'</small></h5>
		
		
			<div class="row">
				
				<div class="col-md-6">
					<table class="table" width="100%" style="background-color:white">
						<tr>
							<td colspan="2" style="background-color:#E1E1E1; ">DEPART : <span style="color:red">'.$Data->departName.'</span></td>
						</tr>
						<tr>
							<td >TIME :</td>
							<td align="right">	
						    <span style="color:red;font-size: 12px;" >'.$Data->dateGo.' </span>
							<span >'. $Data->DepartTime.'</span></td>
						</tr>

						<tr>
						  <td>Duration:</td>
						  <td align="right">'. $Data->DepartDuration.'</td>
						</tr>
						<tr>
							<td>Adult x '. $Data->NAdult.'</td>
							<td align="right">'. $Data->DepartTotalAdult.'</td> 
						</tr>
						<tr>
							<td>Children x '. $Data->NChild.'</td>
							<td align="right">'. $Data->DepartTotalChildren.'</td>
						</tr>
						<tr>
							<td>Total depart :</td>
							<td align="right">
							'.  number_format($Data->totalDepartPrice,2).'

							</td>
						</tr> 
					</table>
					
					
				</div>
                                <div class="col-md-6">
					
					<table class="table" width="100%" style="background-color:white">
						<tr>
							<td colspan="2" style="background-color:#E1E1E1; ">RETURN: <span style="color:red">'.$Data->returnName.'</span></td>
						</tr>
						<tr>
							<td >TIME :</td>
							<td align="right">	
						    <span style="color:red;font-size: 12px;" >'.$Data->backDate.' </span>
							<span >'. $Data->ReturnDepartTime.'</span></td>
						</tr>

						<tr>
						  <td>Duration:</td>
						  <td align="right">'. $Data->ReturnDuration.'</td>
						</tr>
						<tr>
							<td>Adult x '. $Data->NAdult.'</td>
							<td align="right">'. $Data->ReturnTotalAdult.'</td> 
						</tr>
						<tr>
							<td>Children x '. $Data->NChild.'</td>
							<td align="right">'. $Data->ReturnTotalChildren.'</td>
						</tr>
						<tr>
							<td>Total depart :</td>
							<td align="right">
							'.  number_format($Data->totalReturnPrice,2).'

							</td>
						</tr> 
					</table>
					
					
				</div>
                                <div class="col-12 bg-danger text-white" style="padding: 10px; text-align: right;background-color:#dc3545;color:white" >
		     Total Price : '. number_format(($Data->totalDepartPrice+$Data->totalReturnPrice),2).'
			
		  </div>
				</div>
                    </div>
                    </div>
</body>
</html>';

//$html2='<p>test ja</p>';
// set style for barcode
$style = array(
	'border' => 0,
	'vpadding' => 'auto',
	'hpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255)
	'module_width' => 1, // width of a single module in points
	'module_height' => 1 // height of a single module in points
);

//$html = $html;

// $html = $html.$pdf->write2DBarcode('http://www.tireshop.com.122.155.167.147.no-domain.name/', 'QRCODE,L', 140, 30, 50, 50, $style, 'Y');
// output the HTML content

//$pdf->Image( base_url('assets_saraban/images/psu.png'), 20, 8, 12, 18, '', '', '', true, 100);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
/*$pdf->ImageSVG($file='images/favicon.png', $x=30, $y=100, $w='', $h=100, $link='', $align='', $palign='', $border=0, $fitonpage=false);*/

$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
//$pdf->Output('allowance.pdf', 'I');
//$pdf->Output('uploadfile/booking_pdf_'.$booking_no.'.pdf', 'F');
$pdf->Output("/akira_speedboat/uploadfile/".'booking_pdf_'.$booking_no.'.pdf', 'F');
////============================================================+
// END OF FILE
//============================================================+
