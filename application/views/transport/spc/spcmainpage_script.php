        <!-- Toastr js -->
        <script src="<?php echo base_url('assets/plugins/jquery-toastr/jquery.toast.min.js')?>" type="text/javascript"></script>
       

 <script src="<?php echo base_url('assets/plugins/switchery/switchery.min.js')?>"></script>

<script>
	//------------------------------spc_deleteData
	
	function delete_data(dataID,table){  
	
		swal({
           title: 'Want to delete this data ?',
           //text: "You won't be able to revert this!",
           type: 'warning',
           showCancelButton: true,
           confirmButtonClass: 'btn btn-confirm mt-2',
           cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
           confirmButtonText: 'Delete'
        }).then(function () {
			
		   $.post('<?php echo base_url('Partnercontrol/spc_deleteData')?>' , { dataID : dataID , table : table }, 
			function(data){  
			   console.log(data);
				if(data==1){ 
                	swal({
                        title: 'Deleted Successfully',
                        //text: "Your file has been deleted",
                        type: 'success',
                        confirmButtonClass: 'btn btn-confirm mt-2'
                    }).then(okay => {
					   if (okay) {
						   location.reload();
					   }
					})				
				}else{
					swal({
						title: "Data can't be deleted. !",
						//text: "You won't be able to revert this!",
						type: 'warning',								
						confirmButtonClass: 'btn btn-confirm mt-2'
					}) 							
				}
			})	
		})
	}	
	//----------------------
	 
    function setShow_onWeb(dataID, val2, table){
        var changeCheckbox = document.querySelector('.js-check-change');
        var x = changeCheckbox.checked;
        if (val2 == '0') {
            var check = '1';
        }
        if (val2 == '1') {
            var check = '0';
        }
        $.post('<?php echo base_url('Partnercontrol/spc_set_ShowOnWeb') ?>', {dataID: dataID, check: check, table: table}, function (data) {
            if (data == 1) {
                $('#ch' + dataID).val(check);
                swal({
                    title: 'Edit data successfully.',
                    //text: 'You clicked the button!',
                    type: 'success',
                    confirmButtonClass: 'btn btn-confirm mt-2'
                });
            } else {
                swal({
                    title: 'Can not be edited.!',
                    //text: "You won't be able to revert this!",
                    type: 'warning',
                    confirmButtonClass: 'btn btn-confirm mt-2'
                });
            }
        });
    }
    //------------------------
	function importRoute(routeID){
		
		var routeValue = $('#routeValue'+routeID).val();
		//console.log(routeValue);
		$.post('<?php echo base_url('Partnercontrol/spc_import_route')?>',{ routeValue:routeValue }, function(data){
			//var data='2';
			if(data=='1'){
				$.toast({
					heading: 'success!',
					text: 'import route success',
					position: 'mid-center',
					//loaderBg: '#5ba035',
					loaderBg: '#6BFF4D',
					icon: 'success',
					hideAfter: 3000,
					stack: 1
				   });
			}else{
				$.toast({
					heading: 'Error!',
					text: 'import Error!',
					position: 'mid-center',
					//loaderBg: '#5ba035',
					loaderBg: '#bf441d',
					icon: 'error',
					hideAfter: 3000,
					stack: 1
				   });
			}
		})
	}
	//-------------------------
	function toast_test(){
		$.toast({
        heading: 'import success!',
        text: 'import success',
        position: 'mid-center',
        //loaderBg: '#5ba035',
        loaderBg: '#6BFF4D',
        icon: 'success',
        hideAfter: 3000,
        stack: 1
       });
	}
	//------------------------------------ 
	function getSpcRoute(){
		$('.sk-three-bounce').css('display','inline-block');
		$('#pageTitle').text('SPC-thailand Route List');
		var partnerID='2';
		$.post('<?php echo base_url('Partnercontrol/spc_RouteManage')?>',{ partnerID:partnerID },function(data){
			//console.log(data);
			$('#showData').empty();
			$('#pageTitle').text('SPC-Route List');
			$('#showData').html(data);
			
		})
	}
	//------------------------getLocation()
	function getLocation(access_token,location_Id , act ){
		$('.sk-three-bounce').css('display','inline-block');
		$('#pageTitle').text('Location List');
		$.post('<?php echo base_url('Partnercontrol/spc_getLocation')?>', {  access_token:access_token ,  location_Id :location_Id , act:act  }, function(data){
		
		   $('#showData').empty();
		   $('#showData').html(data);
		})
		
		// 
	}
   //---------------------

	function getRoute(access_token,route_id, act){
		$('.sk-three-bounce').css('display','inline-block');
		$('#pageTitle').text('Route List');
		$.post('<?php echo base_url('Partnercontrol/spc_getRoute')?>', {  access_token:access_token ,  route_id:route_id , act:act }, function(data){
		
			$('#showData').empty();
			$('#showData').html(data);
		})
		
		// 
	}	
   //---------------------
	$(document).ready(function(){
		//getLocation();
		//getSpcRoute();
	})
	
	
</script>