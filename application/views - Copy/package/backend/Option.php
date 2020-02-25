 <form enctype="multipart/form-data" id="optionForm" name="optionForm" method="post">
<div class="form-group row">
	<label class="col-md-3">Price Option</label>
	<div class="col-md-8"><input type="text" id="Option" name="Option" class="form-control" ></div>
</div>
<div class="form-group row">
	<label class="col-md-3">Min person</label>
	<div class="col-md-8"><input type="text" id="minperson" name="minperson" class="form-control" onChange="minpersonx(this.value)"></div>
</div>
<div class="form-group row">
	<label class="col-md-3">Max person</label>
	<div class="col-md-8"><input type="text" id="maxperson" name="maxperson" class="form-control"></div>
</div>
<div class="form-group row">
	<label class="col-md-3">Adult Price</label>
	<div class="col-md-8"><input type="text" id="Adult" name="Adult" class="form-control"></div>
</div>
<div class="form-group row">
	<label class="col-md-3">Child Price</label>
	<div class="col-md-8"><input type="text" id="Child" name="Child" class="form-control"></div>
        <input type="hidden" name="currentID" id="currentID" value="<?php echo $packageID?>" >
        <input type="hidden" name="currentID2" id="currentID2" >
</div>
    
<div align="center">
   <button type="button" class="btn btn-success btn-sm" onClick="addOption()">Add / Edit Data</button>
</div>
      </form>