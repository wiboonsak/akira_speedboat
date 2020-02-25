<div style="padding: 10px;">
<div class="row">
	<div class="col-md-12">
		<div class="col-md-4">
			<label>Title**</label>
			<select name="cust_prefix" id="cust_prefix" class="form-control form-control-sm">
				<option value="0">Please select</option>
				<option value="Mr.">Mr.</option>
				<option value="Miss.">Miss.</option>
				<option value="Mrs.">Mrs.</option>
			</select>
		</div>
		<div class="col-md-4">
		  <label for="custname">First Name*</label>
		   <input type="text" id="custname" name="custname" class="form-control form-control-sm">
		</div>
			<div class="col-md-4">
		  <label for="custlastname">Last Name*</label>
		   <input type="text" id="custlastname" name="custlastname" class="form-control form-control-sm">
		</div>
	</div>
</div>
<div class="row" style="margin-top: 5px;">
	<div class="col-md-12">
		   
			<div class="col-md-4">
		     <label for="Email">Email*</label>
		     <input type="text" name="Email" id="Email" class="form-control form-control-sm">
		    </div>
			<div class="col-md-4">
		     <label for="phone">PHONE*</label>
		     <input type="text" name="phone" id="phone" class="form-control form-control-sm">
		    </div>  
			 <div class="col-md-4">
		   	<label for="LineID">Line ID</label>
		 	<input type="text" name="LineID" id="LineID" class="form-control form-control-sm">
		    </div> 
	</div>
</div>
<div class="row" style="margin-top: 10px;" align="center">
	<button type="button" class="btn btn-success" onClick="goConfirm()">Confirm</button>
	&nbsp;
	<button type="button" class="btn btn-warning" onClick="getRoute()">Cancel</button>
</div>
	
