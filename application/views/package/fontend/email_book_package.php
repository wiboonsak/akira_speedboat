<html>
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
</style>
</head>

<body>
     <?php 
  $checkinData =$this->Package_model->list_bookingData($keygroup);
    foreach ($checkinData->result() AS $Data) {}?>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td height="35" colspan="2" align="center" bgcolor="#E7E7E7"><img src="<?php echo base_url('images/logo-header.png')?>" alt=""></td>
    </tr>
    <tr>
      <td height="35" colspan="2" bgcolor="#E7E7E7"><table width="90%"  border="0" cellspacing="2" align="center" cellpadding="0" bgcolor="#FFFFFF">
        <tbody>
          <tr>
            <td width="19%" height="25" align="right"><strong>CUSTOMER NAME  : </strong></td>
            <td height="25" colspan="5" align="left">&nbsp;&nbsp;<?php echo $Data->customer_name?>&nbsp;<?php echo $Data->customer_Lastname?></td>
          </tr>
          <tr>
            <td height="25" align="right"><strong>TEL : </strong></td>
            <td width="19%" height="25" align="left">&nbsp;&nbsp;<?php echo $Data->customer_telephone?></td>
            <td width="9%" height="25" align="left"><strong>EMAIL  :</strong></td>
            <td width="28%" height="25" align="left"><?php echo $Data->customer_email?></td>
            <td width="10%" height="25" align="left"><strong>ID LINE :</strong></td>
            <td width="15%" height="25" align="left"><?php echo $Data->IDLine?></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td height="197" colspan="2" bgcolor="#E7E7E7"><table width="90%" align="center" border="0" cellspacing="4" cellpadding="0" bgcolor="#FFFFFF">
              
        <tbody>
          <tr>
            <td width="40%" height="25" align="right"><strong>PACKAGE BOOKING ID : </strong></td>
            <td width="62%" height="25" align="left">&nbsp;&nbsp;<?php echo $Data->transfer_keygroup?></td>
          </tr>
          <tr>
              <?php 
    $packageData = $this->Package_model->list_packageData($Data->package_id);
    foreach ($packageData->result() AS $Data1) {}?>
            <td height="25" align="right"><strong>PACKAGE : </strong></td>
            <td height="25" align="left">&nbsp;&nbsp;<?php echo $Data1->package_name_en?></td>
          </tr>
          <tr>
            <td width="40%" height="25" align="right"><strong>DEPARTING : </strong></td>
            <td height="25" align="left">&nbsp;&nbsp;<?php echo $this->Package_model->GetEngDateTime1($Data->date_depart);?></td>
          </tr>
          <tr>
            <td width="40%" height="25" align="right"><strong>ADULT : </strong></td>
            <td height="25" align="left">&nbsp;&nbsp;<?php echo $Data->customer_adult?></td>
          </tr>
          <?php if($Data->customer_child >0){?>
          <tr>
            <td width="40%" height="25" align="right"><strong>CHILDREN (3-10 YEARS) : </strong></td>
            <td height="25" align="left">&nbsp;&nbsp;<?php echo $Data->customer_child?></td>
          </tr>
          <?php }?>
          <tr>
            <td width="40%" height="25" align="right"><strong>PAYMENT TOTAL : </strong></td>
            <td height="25" align="left">&nbsp;&nbsp;<?php echo number_format($Data->total_price)?></td>
          </tr>
          <tr>
            <td width="40%" height="25" align="right"><strong>STATUS : </strong></td>
            <td height="25" align="left">&nbsp;&nbsp;<?php if ($Data->cf_status == 1){echo 'Pending';}else if($Data->cf_status == 2){echo 'Confrim ';}else{echo 'Cancel';} ?></td>
          </tr>
          </tbody>
      </table></td>
    </tr>
    <tr>
      <td width="46%" bgcolor="#B8B8B8"><h4><a href="mailto:booking@akiraspeedboat.com" target="_blank">booking@akiraspeedboat.com</a></h4>
        <p>370 Moo 7 Koh Lipe, Koh Sarai Sub-district,<br>
      Muang, Satun 91000 Thailand.</p></td>
      <td width="54%" align="center" bgcolor="#B8B8B8"><h2>+66 (0) 98 161 6164 </h2></td>
    </tr>
  </tbody>
</table>
</body>
</html>
