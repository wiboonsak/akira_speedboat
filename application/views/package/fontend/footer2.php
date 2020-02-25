<!-- Confidence and Subscribe  -->
        <section class="confidence-subscribe">
            <!-- Background -->
            <div class="bg-parallax bg-3"></div>
            <!-- End Background -->
            <div class="container" style="padding: 0px!important;">
                <div class="row cs-sb-cn">

                    <!-- Confidence -->
                    <div class="col-md-6" style="background-color: white;" align="center">
                        
                          
					<div class="logo-foter" style="padding-top:30px;" >
                                                 
						<h1 style="color: #d83f3f">Have Questions?</h1>
                        <h2 class="text-color">+66 (0) 98 161 6164 <br></h2>
                        <h3><a href="mailto:booking@akiraspeedboat.com" class="text-color" target="_blank">booking@akiraspeedboat.com</a></h3>
                        <p>370 Moo 7 Koh Lipe, Koh Sarai Sub-district,<br>Muang, Satun 91000 Thailand.</p>
                    </div>
					<div style="background-color: white; height: 35px;"></div>		
                       
                    </div>
                    <!-- End Confidence -->
                    <!-- Subscribe -->
                    <div class="col-md-6">
                        <div class="subscribe">
                            <h3>Subscribe to our newsletter</h3>
                            <p>Enter your email address and we’ll send you our regular promotional emails, packed with special offers, great deals, and huge discounts</p>
                            <!-- Subscribe Form -->
                            <div class="subscribe-form">
                                <form action="#" method="get">
                                    <input type="text" name="sub" id="sub" value="" placeholder="Your email" class="subscribe-input" onChange="checkEmail(this.value)">
                                    <button class="awe-btn awe-btn-5 arrow-right text-uppercase awe-btn-lager" onclick="Add()">subcrible</button>
                                </form>
                            </div>
                            <!-- End Subscribe Form -->
                            <!-- Follow us
                            <div class="follow-us">
                                <h4>Follow us</h4>
                                <div class="follow-group">
                                    <a href="" title=""><i class="fa fa-facebook"></i></a>
                                    <a href="" title=""><i class="fa fa-twitter"></i></a>
                                    <a href="" title=""><i class="fa fa-instagram"></i></a>
                                    <a href="" title=""><i class="fa fa-google-plus"></i></a>
                                </div>
                            </div> -->
                            <!-- Follow us -->
                        </div>
                    </div>
                    <!-- End Subscribe -->

                </div>
            </div>
        </section>
        <!-- End Confidence and Subscribe  -->

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <!-- Logo -->
                    <div class="col-md-4 ">
                        <div class="logo-foter" style="color: white">
                            <a href="<?php echo base_url('Welcome/index')?>" title=""><img src="<?php echo base_url('images/logo-invert.png')?>" alt=""></a>
					
                        <h4><a href="mailto:booking@akiraspeedboat.com" class="text-color" target="_blank">booking@akiraspeedboat.com</a></h4>
                        <p>370 Moo 7 Koh Lipe, Koh Sarai Sub-district,<br>Muang, Satun 91000 Thailand.</p>
                    </div>
						 </div>
                    <!-- End Logo -->
                    <!-- Navigation Footer -->
                    <div class="col-xs-6 col-sm-3 col-md-2">
                        <div class="ul-ft">
                            <ul>
                                <li><a href="<?php echo base_url('Welcome/index')?>" title="">Home</a></li>
                                <li><a href="<?php echo base_url('Welcome/index')?>" title="">Book Transport</a></li>
                                <li><a href="<?php echo base_url('Welcome/package_list')?>" title="">Book Tours</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Navigation Footer -->
                    <!-- Navigation Footer -->
                    <div class="col-xs-6 col-sm-3 col-md-2">
                        <div class="ul-ft">
                            <ul>
                                <li><a href="<?php echo base_url('Welcome/contact')?>" title="">Contact Us</a></li>
                                <li><a href="<?php echo base_url('Welcome/payment')?>" title="">How to Payment</a></li>
                                <li><a href="<?php echo base_url('Welcome/timetable')?>" title="">Time Tables</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Navigation Footer -->
                    <!-- Footer Currency, Language -->
                    <div class="col-sm-6 col-md-4">
                       
                        <!--CopyRight-->
                        <p class="copyright" style="font-size: 9pt; margin-top: 60px;">
							© 2019 <a href="https://akiraspeedboat.com/" target="_blank">akiraspeedboat.com</a> All rights reserved.<br>Developed by <a href="http://www.me-fi.com" target="_blank">ME-FI dot com</a>
                        </p>
                        <!--CopyRight-->
                    </div>
                    <!-- End Footer Currency, Language -->
                </div>
            </div>
        </footer>
        <!-- End Footer -->
         <script type="text/javascript">
                function Add(){
                    var sub = $('#sub').val();
                    if(sub == ''){
                         alert('Please enter email');
                         $('#sub').val('');
                         $('#sub').focus();
                    }else if(sub != ''){
                    $.post('<?php echo base_url('Welcome/subsribe')?>', { sub : sub }, function(data){  
			if(data == '1'){
                            alert('Thank you for subscribe');
                            $('#sub').val('');
                            $('#sub').focus();
                        }
                                    });
                                 
                                }else{
                                   return false; 
                                }
                
            }
             //-----------------------------
        function checkEmail(email){
			$.post('<?php echo base_url('Welcome/checkemail')?>',{ email:email }, function(data){
			if(data >0){
				alert('This email is already a mamber.');
                                $('#sub').val('');
                                $('#sub').focus();
                                return false;
				} ;
			});
		
                    }
                </script>