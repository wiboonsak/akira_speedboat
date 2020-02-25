<h2>Select Payment</h2>
<p>Paypal</p>
  <table class="table table-bordered table-hover">
	  <tr>
	  <td align="center"><img src="<?php echo base_url('assets/images/paypal-express-checkout-logo.png')?>"></td>
	  </tr>
	  <tr>
	  <td align="center"><button type="button" class="awe-btn awe-btn-1 awe-btn-medium ">Pay by paypal</button></td>
	  </tr>
</table>
<p>Transfer money</p>
  <table class="table table-bordered table-hover">
                  <tr style="background-color:#BCBCBC">
                   <th style="background-color:#BCBCBC">BANK NAME</th>
                   <th style="background-color:#BCBCBC">ACCOUNT NAME</th>
                   <th style="background-color:#BCBCBC">ACCOUNT NO.</th>
                   <th style="background-color:#BCBCBC">SWIFT CODE</th>
                 </tr>
                 <tr>
                  <td>Kasikorn Bank</td>
                  <td>นาย แมนเมธี จิระโร</td>
                  <td>049-3-99382-8</td>
                  <td>KASITHBK</td>
                </tr>
               <tr>
                   <td colspan="4">
					  <img src="<?php echo base_url('assets/images/qu-code.jpg')?>" alt="Akira Speedboat" title="qrcode ชำระเงิน" />
					</td>
               </tr> <tr>
                   <td colspan="4" align="center">
					  <button type="button" class="awe-btn awe-btn-1 awe-btn-medium ">Pay by Transfer</button>
					   <?php echo $this->session->userdata('booking_no')?>
					</td>
               </tr>
</table>
