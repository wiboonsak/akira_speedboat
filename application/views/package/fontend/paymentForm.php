<?php 
  foreach($bookData->result() AS $data){}
  //echo $data->booking_no;
 // echo $data->id;

  $data->NAdult;
  $data->NChild;

  $data->DAdultPrice;
  $data->DChildPrice;

  $data->RAdultPrice;
  $data->RChildPrice;
  
 
  $price_total=(($data->DAdultPrice*$data->NAdult) + ($data->DChildPrice*$data->NChild) + ($data->RAdultPrice*$data->NAdult) + ($data->RChildPrice*$data->NChild));


?>
<h2 id="titleSelectPay">Select Payment</h2>
<br>
<div id="paymentSpace">
	<?php  // echo 'booking_no->'.$data->booking_no.' >>price_total'.$price_total;?>
<!--  <table class="table table-bordered table-hover">
	<tr>
	  <td align="center">-->
    <div align="center">
              <input type="hidden" id="id" name="" value="<?php echo $data->booking_no?>">
		  <!---------paypal-------------------->
			 <script src="https://www.paypalobjects.com/api/checkout.js"></script>
                         <div id="paypal-button-container" style="width: 100%"></div>

    <?php //if($this->input->get("cancelpay")=="no"){echo "<font color='red'>Cancel Paypal</font>";}?>

     <script>


paypal.Button.render({
    style: {
 size: 'large'
 },
  env: 'sandbox', // sandbox | production
    client: {
      sandbox:'Afs9gPOXFBOHB2ylAzeb8Z9ofmRdEMRfrAeXooltrE8DC7-DMa48uoByGlAA5UJ1pFF3RLw2jxCUlwYo'
    },
    

  // Show the buyer a 'Pay Now' button in the checkout flow
  commit: true,

  // payment() is called when the button is clicked
  payment: function(data, actions) {
    // Make a call to the REST API to set up the payment
    return actions.payment.create({
      payment: {
        transactions: [
          {
            amount: { total: '<?php echo $price_total?>', currency: 'THB' }        
          }
        ],
        redirect_urls: {
          return_url: 'http://www.ok-demo.com/akira_speedboat/Travelcontroller/sendmail/',
          cancel_url: 'http://www.ok-demo.com/akira_speedboat/'
        }
      }
    });
  },

  // onAuthorize() is called when the buyer approves the payment
  onAuthorize: function(data, actions) {

    // Make a call to the REST API to execute the payment
    return actions.payment.execute().then(function() {
      actions.redirect();
      
      }
    );
  },

  onCancel: function(data, actions) {
    actions.redirect();
    }

}, '#paypal-button-container');   

  </script>
		  <!-------//paypal-------------------->
                  </div>
    <br>
<!--		</td>
	  </tr>-->
<!--	  <tr>
	  <td align="center">-->
 <div align="center">
              <button type="button" class="awe-btn awe-btn-1 awe-btn-medium " onClick="payTransfer()" style="width: 90%;">Pay by Transfer money , Postpay </button>
              </div>
<!--          </td>
	  </tr>-->
	  
</table>
<p>&nbsp;</p>
</div>


								
                              