<script>
     
	
	//---------------------------------
	function addLand(){
		
			var route_name_en = $('#route_name_en').val();
			var begin_place_id = $('#begin_place_id').val();
			var destination_place_id = $('#destination_place_id').val();
		
			if(route_name_en ==''){
				swal({
				   title: 'Please insert route name !',
				   confirmButtonClass: 'btn btn-confirm mt-2',
				   type: 'warning'
				})
				
			}else if(begin_place_id ==''){
				swal({
				   title: 'Please insert begin place !',
				   confirmButtonClass: 'btn btn-confirm mt-2',
				   type: 'warning'
				})
			
			}else if(destination_place_id ==''){
				swal({
				   title: 'Please insert destination place !',
				   confirmButtonClass: 'btn btn-confirm mt-2',
				   type: 'warning'
				})
				
			}else{  
				
				var form_data = $('#frm1').serialize();
				var route_image = $('#route_image').val();								
				var dataID = $('#dataID').val();
				
				//if(dataID != ''){
					
				   var nameFunction = 'do_addLand';				   	
					
				/*} else {
				   var nameFunction = 'do_editddRoute';				   	
				}*/
				
				var postData = new FormData($("#frm1")[0]);
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url('TransportCMS/')?>'+nameFunction,
					processData: false,
					contentType: false,
					data: postData,
					success: function(data, status){				
						
						//console.log(data);
						//$('#currentID').val(data);
						// console.log("File Uploaded");
						console.log('data->' + data + '  status->' + status);
						if(data >0){
							swal({
								title: 'Saved Successfully.',
								//text: 'You clicked the button!',
								type: 'success',
								confirmButtonClass: 'btn btn-confirm mt-2'
							}).then(okey => {
								if(okey){
									window.location.href = "<?php echo base_url('TransportCMS/AddLand/')?>"+data;
								}
							})

						} else {
							swal({
								title: "Data can't be saved. !",
								//text: "You won't be able to revert this!",
								type: 'warning',
								confirmButtonClass: 'btn btn-confirm mt-2'
							});
						}
					}
				});
			}
	}
	//----------------------
	
	$(".fileupload-exists").click(function(){ 
  		$("#upload_preview").empty();
		$("#upload_preview").addClass("fileupload-exists");
		$("#upload_new").removeClass("fileupload-exists");
		$("#route_image").val("");
		$("[data-provides=fileupload]").removeClass("fileupload-exists");									
		$("[data-provides=fileupload]").addClass("fileupload-new");									
	})
	//----------------------
	
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
        $.post('<?php echo base_url('PackageCMS/set_ShowOnWeb') ?>', {dataID: dataID, check: check, table: table}, function (data) {
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
	//------------------------------
	
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
			
		   $.post('<?php echo base_url('TransportCMS/deleteData1')?>' , { dataID : dataID , table : table }, 
			function(data){  
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
    
        //----------------------------------
   function  loadland() {
        var dataID = $('#dataID').val();
        $.post('<?php echo base_url('TransportCMS/loadland') ?>', {dataID:dataID}, function (data) {
            $('#showland').html(data);
        });
    }
		//----------------------
	
	/*function showRouteType_Times(route_type_id){
		
		var route_id = $('#dataID').val();
			
		$.post('http://travellipe.com/TransportCMS/RouteType_Times' , { route_id : route_id , route_type_id : route_type_id }, function(data){				
			
			$('#accordionExample').empty();
			$('#accordionExample').html(data);
			$('#accordionExample').show();			
				
		})			
	}*/

//---------------------------------
	function addpriceLand(){
		
			var Start_h_time = $('#Start_h_time').val();
			var Start_m_time = $('#Start_m_time').val();
			var End_h_time = $('#End_h_time').val();
			var End_m_time = $('#End_m_time').val();
			var transport = $('#transport').val();
			var price = $('#price').val();
			var landID = $('#landID').val();
		
			if(Start_h_time =='0'){
				swal({
				   title: 'Please Select Start Time Hour !',
				   confirmButtonClass: 'btn btn-confirm mt-2',
				   type: 'warning'
				})
				
			}else if(Start_m_time ==''){
				swal({
				   title: 'Please Select Start Time Minute !',
				   confirmButtonClass: 'btn btn-confirm mt-2',
				   type: 'warning'
				})
			
			}else if(End_h_time =='0'){
				swal({
				   title: 'Please Select End Time Hour !',
				   confirmButtonClass: 'btn btn-confirm mt-2',
				   type: 'warning'
				})
			}else if(End_m_time ==''){
				swal({
				   title: 'Please Select End Time Minute !',
				   confirmButtonClass: 'btn btn-confirm mt-2',
				   type: 'warning'
				})
			}else if(transport ==''){
				swal({
				   title: 'Please insert Transport !',
				   confirmButtonClass: 'btn btn-confirm mt-2',
				   type: 'warning'
				})
			}else if(price ==''){
				swal({
				   title: 'Please insert Price !',
				   confirmButtonClass: 'btn btn-confirm mt-2',
				   type: 'warning'
				})
				
			}else{  			   	
				var postData = new FormData($("#frm2")[0]);
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url('TransportCMS/Addpriceland')?>',
					processData: false,
					contentType: false,
					data: postData,
					success: function(data, status){				
						if(data >0){
							swal({
								title: 'Saved Successfully.',
								//text: 'You clicked the button!',
								type: 'success',
								confirmButtonClass: 'btn btn-confirm mt-2'
							}).then(okey => {
								if(okey){
									window.location.href = "<?php echo base_url('TransportCMS/AddLand/')?>"+landID;
								}
							})

						} else {
							swal({
								title: "Data can't be saved. !",
								//text: "You won't be able to revert this!",
								type: 'warning',
								confirmButtonClass: 'btn btn-confirm mt-2'
							});
						}
					}
				});
			}
	}
        //---------------------------------
        function updateThis(id,h,m,h1,m1,transport_id,price){
        $('#Start_h_time').val(h);
        $('#Start_m_time').val(m);
        $('#End_h_time').val(h1);
        $('#End_m_time').val(m1);
        $('#transport').val(transport_id);
        $('#price').val(price);
        $('#pricelandID').val(id);
        
        }
</script>

<script type="text/javascript">
   $(document).ready(function(){
		$('#table2').DataTable();
	   
	    loadland();
	   
	 /*   $('[data-plugin="switchery"]').each(function (idx, obj){
       		new Switchery($(this)[0], $(this).data());
		});*/
				
   })
</script>

</body>
</html> 