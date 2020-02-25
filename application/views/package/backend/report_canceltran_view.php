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
                       <h4>Report Transport Cancel</h4>
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
									<label class="col-md-2 col-sm-4 col-form-label">วันที่เดินทาง</label>
                                    <div class="col-md-2 col-sm-8">
                                         <div class="input-group">
                                             <input type="text" class="form-control" id="datepicker1" placeholder="dd/mm/yyyy" autocomplete="off" onchange="datepick2(this.value)">
                                             <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                             </div>
                                         </div>
                                    </div>
                                                                        <label class="col-md-1 col-sm-4 col-form-label" style="text-align:center"> - </label>
                                    <div class="col-md-2 col-sm-8">
                                         <div class="input-group">
                                             <input type="text" class="form-control" id="datepicker2" placeholder="dd/mm/yyyy" autocomplete="off">
                                             <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                             </div>
                                         </div>
                                    </div>
                                   
                                    <div class="col-md-3 col-sm-8">
                                         <div class="col-md-12">
                                             <?php $listcommission = $this->Package_model->list_commissionData();?>
                                              <select class="form-control" id="SearchBooking" name="SearchBooking"  ><!--onchange="placedataupdate(this.value)"-->
                                     <option value="all">ALL</option>
									 <?php foreach($listcommission->result() as $listcommission2){ ?> 
									  
									  
                                     <option value="<?php echo $listcommission2->partner_id?>" ><?php echo $listcommission2->Name?></option>
									  <?php } ?>
									  
									
                                 </select>
                                         </div>
                                    </div>   
                                     <div class="col-md-2">
						<button class="btn  btn-success" type="button" name="Button" onclick="searchinput()" >ค้นหา</button>
					</div>
                                                                       
									</div>
                    <hr>
                                           <div id="showData">
                                           
    <form method="post" action="<?php echo base_url(); ?>PackageCMS/actionTran2">
     <input type="submit" name="export" class="btn btn-success" value="Excel" />
      <button type="button" id="printtable" onclick="printData()" class="btn btn-info" >Print</button>
    </form>
<br>
                            <table id="table2" border='1' cellpedding="0" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">#</th>
                                        <th style="text-align:center;">หมายเลขการจอง</th>
                                         <th style="text-align:center;">ชื่อผู้จอง</th>
										<th style="text-align:center;">วันที่เดินทาง</th>
										<th style="text-align:center;">วันที่เดินทางกลับ</th>
                                        <th style="text-align:center;">จำนวนเงิน</th>
                                        <th style="text-align:center;">สถานะ</th>
                                        <th style="text-align:center;">วันที่ทำการจอง</th>
                                        <th style="text-align:center;">รายละเอียด</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
 <?php 
    $n=1;
    $checkinData =$this->Package_model->ReportTrancancel();        
    foreach ($checkinData->result() AS $Data) {
         $totalDepartPrice = ($Data->NAdult*$Data->DAdultPrice)+($Data->NChild*$Data->DChildPrice);
        $totalReturnPrice = ($Data->NAdult*$Data->RAdultPrice)+($Data->NChild*$Data->RChildPrice);
        ?>	
                                        <tr id="row<?php echo $Data->id ?>" class="removech" <?php if($Data->payment_status=='1'){ echo 'style="background-color: #DAFFD8"';}?>  >
                                            <td style="text-align:center;"><?php echo $n?></td>
                                            <td><?php echo $Data->booking_no ?><br>
												<small class="text-primary">
													(<?php if($Data->travelRound=='return'){ echo "ไป-กลับ";}else if($Data->travelRound=='oneWay'){ echo "เทียวเดียว";}?>)</small>
											</td>
                                            
                                            <td><?php echo $Data->cust_name." ".$Data->cust_lastname?><br>
												<a href="tel:<?php echo $Data->cust_telephone_num ?>">
												<i class="icon-phone"></i>
												<?php echo $Data->cust_telephone_num ?>
												</a>		
											</td>
											<td style="text-align:center;"><?php echo $this->Package_model->GetthaiDateTimeeng($Data->dateGo)?><br><?php echo $Data->DepartTime?></td>
											<td style="text-align:center;"><?php echo $this->Package_model->GetthaiDateTimeeng($Data->backDate)?><br><?php echo $Data->ReturnDepartTime?></td>
											
                                            <td align="right"><?php $totalAll=($totalDepartPrice+$totalReturnPrice);
											   echo number_format($totalAll ,2)?></td> 
                                            <td>
										<?php if($Data->booking_status=='1'){ 
												   echo "<i class='dripicons-checkmark text-success'></i> ยืนยันการจอง";
											   }else if($Data->booking_status==0){ 
												   echo "<i class='fa fa-times-circle text-danger'></i> ไม่ยืนยันการจอง";
											   }else if($Data->booking_status==3){ 
												   echo "<i class='fa fa-times-circle text-danger'></i> ยกเลิกการจอง";
											   }else if($Data->booking_status==2){ 
												   echo "<i class=' dripicons-clock text-info'></i> ประวัติการจอง";
												 }else if($Data->booking_status==4){ 
												   echo "<i class='fa fa-times-circle text-danger'></i> ประวัติลบการจอง";   
											   }?><br>
												
												 <?php if($Data->payment_status=='1'){ echo "<i class='fa fa-money text-success'></i> ชำระเงินเรียบร้อย"; }else{echo "<i class='fa fa-money text-danger'></i> ยังไม่ชำระเงิน"; }?>
												
												  
                                                                                                 (<?php if($Data->payment_type=='1'){ echo "credit card";}else if($Data->payment_type=='2'){  echo "โอนเงิน";}else if($Data->payment_type=='0'){ echo "ยังไม่ระบุ"; }else{echo "Paypal";}?>)
												
											</td>
                                            <td style="text-align:center;"><?php echo $this->Package_model->GetthaiDateTime($Data->date_booking);?></td>
                                            <td><button type="button" class="btn btn-info btn-sm" onClick="ShowBookDetail('<?php echo $Data->id?>','<?php echo $Data->booking_no?>')">Detail</button></td>
                                           
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
       