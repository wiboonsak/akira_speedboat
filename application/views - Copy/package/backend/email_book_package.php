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
        <link href="<?php echo base_url('assets/css/icons.css')?>" rel="stylesheet" type="text/css" />
                <link href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet" type="text/css" />
                 <link href="<?php echo base_url('assets/plugins/datatables/buttons.bootstrap4.min.css')?>" rel="stylesheet" type="text/css" />
<body>
        <?php $keygroup = $this->uri->segment(3);
    ?>
     <?php 
  $checkinData =$this->Package_model->list_bookingData($keygroup);
    foreach ($checkinData->result() AS $Data) {}?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody>

    <tr>
      <td height="70" colspan="2" bgcolor="#E7E7E7"><table width="90%"  border="0" cellspacing="2" align="center" cellpadding="0" bgcolor="#FFFFFF">
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
            <td width="40%" height="25" align="right"><strong>STATUS : </strong></td>
            <td height="25" align="left">&nbsp;&nbsp;<?php if ($Data->cf_status == 1){echo 'Pending';}else if($Data->cf_status == 2){echo 'Confrim ';}else{echo 'Cancel';} ?></td>
          </tr>
          </tbody>
      </table></td>
    </tr>
    <tr>
      <td bgcolor="#B8B8B8">&nbsp;</td>
      <td align="right" bgcolor="#B8B8B8">&nbsp;</td>
    </tr>
     <tr>
      <td height="200" colspan="2" bgcolor="#E7E7E7" >
      <textarea style="margin: 0 5%;width: 90%;" rows="7" id="textareapdf"><?php echo $Data->comment?></textarea>
      <br>
      <br>
      <div style="text-align: center">
          <?php if($Data->cf_status == 1){?>
          <button  align="center" type="button" class="btn btn-success "   onClick="confrim_data('<?php echo $keygroup ?>')">Confrim</button>
          <?php }?>
          <?php if($Data->cf_status == 2){?>
      <button  align="center" type="button" class="btn btn-danger "  onClick="cancel_data('<?php echo $keygroup ?>')">Cancel</button>
       <?php }?>
      </div>
      </td>
    </tr>
  </tbody>
</table>
    <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/popper.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
    <script type="text/javascript">
    function confrim_data(keygroup) {
        var textareapdf = $('#textareapdf').val();
                $.post('<?php echo base_url('PackageCMS/confrim_data') ?>', {keygroup: keygroup,textareapdf:textareapdf}, function (data) {
                    if (data > 0) {
                        alert("Confrim data successfully.");
                        window.opener.location.href = "<?php echo base_url('PackageCMS/bookinglist') ?>";
                        window.close();
                    } else {
                        alert("Can not be Confrim!");
                    }
                });
                }
      //----------------------------
      function cancel_data(keygroup) {
        var textareapdf = $('#textareapdf').val();
        if(textareapdf == ''){
              alert("Please enter comment!");
            
        }else{
                $.post('<?php echo base_url('PackageCMS/cancel_data') ?>', {keygroup: keygroup,textareapdf:textareapdf}, function (data) {
                    if (data > 0) {
                        alert("Cancel data successfully.");
                        window.opener.location.href = "<?php echo base_url('PackageCMS/bookinglist') ?>";
                        window.close();
                    } else {
                        alert("Can not be Cancel!");
                    }
                });
                }
                }
        
    
    </script>
</body>
</html>
