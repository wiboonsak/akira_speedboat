<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
     <!-- Begin page --> 	
        <div id="wrapper">
            	<?php //include('side_menu.php')?>
<div class="content-page">
    <!-- Top Bar Start -->
    <div class="topbar">
        <nav class="navbar-custom">                  
            <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                    <button class="button-menu-mobile open-left disable-btn">
                        <i class="dripicons-menu"></i>
                    </button>
                </li>
                <li>
                    <div class="page-title-box">
                       <h4>Report Land Transfer Booking</h4>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
    <!-- Top Bar End -->
<hr>
    <!-- Start Page content -->
    <div class="content">
        <div class="container-fluid">

            <div class="card-box">									

                   <div class="form-group row">
									<label class="col-md-2 col-sm-4 col-form-label">วันที่ทำการจอง</label>
                                    <div class="col-md-5 col-sm-8">
                                         <div class="input-group">
                                             <input type="text" class="form-control" id="datepicker1" placeholder="dd/mm/yyyy" autocomplete="off" onchange="datepick2(this.value)">
                                             <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                             </div>
                                         </div>
                                    </div>
                                    <div class="col-md-3 col-sm-8">
                                         <div class="col-md-12">
                                            <input type="text" class="form-control" id="SearchBookingpart" placeholder="Booking Number"/>
                                         </div>
                                    </div>   
                                     <div class="col-md-2">
						<button class="btn  btn-success" type="button" name="Button" onclick="searchinput()" >ค้นหา</button>
					</div>
                                                                       
									</div>
                    <hr>
                                           <div id="showData">
                                           
    <form method="post" action="<?php echo base_url(); ?>PackageCMS/actioncharter/<?php echo $cfstatus?>">
     <input type="submit" name="export" class="btn btn-success" value="Excel" />
      <button type="button" id="printtable" onclick="printData()" class="btn btn-info" >Print</button>
    </form>
<br>
                            <table id="table2" border="1" cellspacing='0' cellpedding="0" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">#</th>
                                        <th style="text-align:center;">หมายเลขการจอง</th>
                                         <th style="text-align:center;">ชื่อผู้จอง</th>
                                        <th style="text-align:center;">จำนวนเงิน</th>
                                        <th style="text-align:center;">สถานะ</th>
                                        <th style="text-align:center;">วันที่ทำการจอง</th>
                                        <th style="text-align:center;">รายละเอียด</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
 <?php 
    $n=1;
    foreach ($checkinData->result() AS $Data) {?>	
                                        <tr id="row<?php echo $Data->id ?>" class="removech" <?php if(($Data->cf_status=='1')||($Data->cf_status=='2')){ echo 'style="background-color: #DAFFD8"';}?>  >
                                            <td style="text-align:center;"><?php echo $n?></td>
                                            <td style="text-align:center;"><?php echo $Data->Booking_id ?></td>
                                            <td><?php echo $Data->customer_name." ".$Data->customer_Lastname?><br>
												<a href="tel:<?php echo $Data->customer_telephone ?>">
												<i class="icon-phone"></i>
												<?php echo $Data->customer_telephone ?>
												</a>		
											</td>
                                            <td align="right"><?php echo number_format($Data->total_price ,2)?></td> 
                                            <td style="text-align:center;"><?php if($Data->cf_status=='1'){?><button type="button" class="btn btn-info btn-sm" disabled style="cursor:no-drop">Confrimed</button><?php }else if($Data->cf_status=='3'){?><button type="button" class="btn btn-danger btn-sm" onclick="updatecfstatus('<?php echo $Data->id?>')" disabled style="cursor:no-drop">Cancel</button><?php }else{?><button type="button" class="btn btn-info btn-sm" disabled style="cursor:no-drop">Confrimed</button><?php }?></td>
                                            <td style="text-align:center;"><?php echo $this->Package_model->GetthaiDateTime($Data->date_booking)?></td>
                                            <td style="text-align:center;"><button type="button" class="btn btn-info btn-sm" onClick="ShowBookDetail('<?php echo $Data->id?>','<?php echo $Data->Booking_id?>')">Detail</button></td>
                                           
                                        </tr>
                                    <?php $n++; }?>
                                </tbody>
                            </table>
                    </div>
                    </div>
              
            </div>

        </div> <!-- container -->

    </div> <!-- content -->

    <footer class="footer text-right">
        <!--2018 © Highdmin. - Coderthemes.com-->
    </footer>
<!--GetEngDateTime-->
</div>
       