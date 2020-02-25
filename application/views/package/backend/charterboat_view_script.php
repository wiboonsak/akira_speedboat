<style>
.removeRow
{

}
</style>
<script type="text/javascript">
	//------------------------------btnConfirmPay btnCancelPay
	
	//------------------------------ 
	function ShowBookDetail(DataID,booking_no){
		var booking_status= '1';
		$.post('<?php echo base_url('PackageCMS/CharterboatDetail')?>' , {DataID:DataID , booking_status:booking_status },function(data){
			    $('#modal_Large .modal-body').empty();
     			$('#modal_Large  .modal-title').html('No. <span class="text-danger">'+booking_no+'</span>');
     			$('#modal_Large .modal-body').html(data);
     			$('#modal_Large').modal('show');
		})
			   
	}
	
	//--------------------------------
    $(document).ready(function () {
    $("#ckbCheckAll").click(function () {
        $(".delete_checkbox").prop('checked', $(this).prop('checked'));
         $(".removech").addClass('removeRow');
    });
      $('#table2').DataTable(

);
	jQuery('#datepicker1 , #datepicker2').datepicker({
			autoclose: true,
			format: "dd/mm/yyyy",			
			todayHighlight: true
		});
		
		
    $('.delete_checkbox').click(function(){
  if($(this).is(':checked'))
  {
   $(this).closest('tr').addClass('removeRow');
  }
  else
  {
   $(this).closest('tr').removeClass('removeRow');
  }
 });

 $('#delete_all').click(function(){
  var checkbox = $('.delete_checkbox:checked');
  if(checkbox.length > 0)
  {
   var checkbox_value = [];
   $(checkbox).each(function(){
    checkbox_value.push($(this).val());
   });
   $.ajax({
    url:"<?php echo base_url(); ?>PackageCMS/delete_alltransport",
    method:"POST",
    data:{checkbox_value:checkbox_value},
    success:function()
    {
     $('.removeRow').fadeOut(1500);
     $("#ckbCheckAll").prop('checked',false);
      setTimeout(function(){ window.location.href = "<?php echo base_url('PackageCMS/bookingTransport_view')?>"; }, 2000);
    }
   })
  }
  else
  {
   alert('Select atleast one records');
  }
 });
 $('#save_all').click(function(){
  var checkbox = $('.delete_checkbox:checked');
  if(checkbox.length > 0)
  {
   var checkbox_value = [];
   $(checkbox).each(function(){
    checkbox_value.push($(this).val());
   });
   $.ajax({
    url:"<?php echo base_url(); ?>PackageCMS/save_allTransport",
    method:"POST",
    data:{checkbox_value:checkbox_value},
    success:function()
    {
     $('.removeRow').fadeOut(1500);
     $("#ckbCheckAll").prop('checked',false);
      setTimeout(function(){ window.location.href = "<?php echo base_url('PackageCMS/bookingTransport_view')?>"; }, 2000);
    }
   })
  }
  else
  {
   alert('Select atleast one records');
  }
 });

});
     //----------------------
	function delete_data(dataID,table){  
		swal({
           title: 'ต้องการลบข้อมูลนี้?',
           //text: "You won't be able to revert this!",
           type: 'warning',
           showCancelButton: true,
           confirmButtonClass: 'btn btn-confirm mt-2',
           cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
           confirmButtonText: 'ลบข้อมูล'
        }).then(function () {
		   $.post('<?php echo base_url('PackageCMS/deleteData5')?>' , { dataID : dataID , table : table }, 
			function(data){
				if(data==1){ 
                	swal({
                        title: 'ลบข้อมูลเรียบร้อยแล้ว',
                        //text: "Your file has been deleted",
                        type: 'success',
                        confirmButtonClass: 'btn btn-confirm mt-2'
                    });
                    setTimeout(function(){ window.location.href = "<?php echo base_url('PackageCMS/bookingTransport_view')?>"; }, 2000);
				}else{
					swal({
						title: 'ไม่สามารถลบข้อมูลได้!',
						//text: "You won't be able to revert this!",
						type: 'warning',
						confirmButtonClass: 'btn btn-confirm mt-2'
					})
				}
			})
		})
	}
        //-------------------------------------------
	
	    /*
		$booking_status=$this->input->post('booking_status');
		$payment_status=$this->input->post('payment_status');
		$payment_type=$this->input->post('payment_type');
		$partner_id =$this->input->post('partner_id');
		$dateStart=$this->input->post('dateStart');
		$dateEnd=$this->input->post('dateEnd');
		$dataID=$this->input->post('dataID'); bookingType
		*/
        function searchinput(){
            var SearchBooking = $('#SearchBooking').val();
            if(SearchBooking==''){
				var  SearchBooking='all';
			 }
            var datepicker1 = $('#datepicker1').val();				
			 if(datepicker1==''){
				var  datepicker1='all';
			 }
            
            var dataID='all';
            var booking_status='1';
            var cfstatusno1='2';
            var cfstatusno2='3';
            var cfstatus='all';
			
			$.post('<?php echo base_url('PackageCMS/Charterboat_Search')?>' , { booking_status:booking_status , dataID:dataID,datebook:datepicker1, SearchBooking:SearchBooking,cfstatusno1:cfstatusno1 ,cfstatusno2:cfstatusno2,cfstatus:cfstatus } , function(data){ 
				
					$('#showData').empty();		
					$('#showData').html(data);	
			})		
	}
        //--------------------------------------
        	 function windowOpener(windowHeight, windowWidth, windowName, windowUri)
			{
					var centerWidth = (window.screen.width - windowWidth) / 2;
					var centerHeight = (window.screen.height - windowHeight) / 2;
    				newWindow = window.open(windowUri, windowName, 'resizable=1,scrollbars=yes,width=' + windowWidth +  ',height=' + windowHeight +  ',left=' +centerWidth + ',top=' + centerHeight);
					newWindow.focus();
					return newWindow.name;
		}
  
	//------------------------------------
    	function save_data(dataID,table){  
		swal({
           title: 'ต้องการจัดเก็บข้อมูลนี้?',
           //text: "You won't be able to revert this!",
           type: 'warning',
           showCancelButton: true,
           confirmButtonClass: 'btn btn-confirm mt-2',
           cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
           confirmButtonText: 'จัดเก็บข้อมูล'
        }).then(function () {
		   $.post('<?php echo base_url('PackageCMS/saveData')?>' , { dataID : dataID , table : table }, 
			function(data){
				if(data==1){ 
                	swal({
                        title: 'จัดเก็บข้อมูลเรียบร้อยแล้ว',
                        //text: "Your file has been deleted",
                        type: 'success',
                        confirmButtonClass: 'btn btn-confirm mt-2'
                    });
                    setTimeout(function(){ window.location.href = "<?php echo base_url('PackageCMS/bookinglist')?>"; }, 2000);
				}else{
					swal({
						title: 'ไม่สามารถจัดเก็บข้อมูลได้!',
						//text: "You won't be able to revert this!",
						type: 'warning',
						confirmButtonClass: 'btn btn-confirm mt-2'
					})
				}
			})
		})
	}
                 //----------------------          
	
	//----------------------
	function cancel_data(dataID,table){  
		swal({
           title: 'ต้องการยกเลิกข้อมูลนี้?',
           //text: "You won't be able to revert this!",
           type: 'warning',
           showCancelButton: true,
           confirmButtonClass: 'btn btn-confirm mt-2',
           cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
           confirmButtonText: 'ยกเลิกข้อมูล'
        }).then(function () {
		   $.post('<?php echo base_url('PackageCMS/cancelData')?>' , { dataID : dataID , table : table }, 
			function(data){
				if(data==1){ 
                	swal({
                        title: 'ยกเลิกข้อมูลเรียบร้อยแล้ว',
                        //text: "Your file has been deleted",
                        type: 'success',
                        confirmButtonClass: 'btn btn-confirm mt-2'
                    });
                    setTimeout(function(){ window.location.href = "<?php echo base_url('PackageCMS/bookingTransport_view')?>"; }, 2000);
				}else{
					swal({
						title: 'ไม่สามารถยกเลิกข้อมูลได้!',
						//text: "You won't be able to revert this!",
						type: 'warning',
						confirmButtonClass: 'btn btn-confirm mt-2'
					})
				}
			})
		})
	}
	//----------------------
	function updatecfstatus(dataID){ 
        var cfstatus = '1';
		swal({
           title: 'Confrimed?',
           //text: "You won't be able to revert this!",
           type: 'warning',
           showCancelButton: true,
           confirmButtonClass: 'btn btn-confirm mt-2',
           cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
           confirmButtonText: 'Confrimed'
        }).then(function () {
		   $.post('<?php echo base_url('PackageCMS/updatecfstatusch')?>' , { dataID : dataID ,cfstatus:cfstatus}, 
			function(data){
				if(data!='0'){ 
                	swal({
                        title: 'Confrimed Successfully',
                        //text: "Your file has been deleted",
                        type: 'success',
                        confirmButtonClass: 'btn btn-confirm mt-2'
                    });
                    setTimeout(function(){ window.location.href = "<?php echo base_url('PackageCMS/Charterboat_view')?>"; }, 2000);
				}else{
					swal({
						title: 'Can not Confrimed!',
						//text: "You won't be able to revert this!",
						type: 'warning',
						confirmButtonClass: 'btn btn-confirm mt-2'
					})
				}
			})
		})
	}
        //----------------------
	function chBookStatus(textcf,dataID){  
        var textcontrol = '';
        var cfstatus = '';
		swal({
           title: textcf+'?',
           //text: "You won't be able to revert this!",
           type: 'warning',
           showCancelButton: true,
           confirmButtonClass: 'btn btn-confirm mt-2',
           cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
           confirmButtonText: textcf
        }).then(function () {
            if(textcf == 'Cancel'){
                textcontrol = 'updatecfstatusch';
                cfstatus = '3';
            }else if(textcf == 'Save'){
                textcontrol = 'updatecfstatusch';
                cfstatus = '2';
            }else if(textcf == 'Delete'){
                textcontrol = 'deletecharter';
            }
		   $.post('<?php echo base_url('PackageCMS/')?>'+textcontrol , { dataID : dataID ,cfstatus:cfstatus }, 
			function(data){
              
				if(data!='0'){ 
                	swal({
                        title: textcf+' Successfully',
                        //text: "Your file has been deleted",
                        type: 'success',
                        confirmButtonClass: 'btn btn-confirm mt-2'
                    });
                    setTimeout(function(){ window.location.href = "<?php echo base_url('PackageCMS/Charterboat_view')?>"; }, 2000);
				}else{
					swal({
						title: 'Can not '+textcf+'!',
						//text: "You won't be able to revert this!",
						type: 'warning',
						confirmButtonClass: 'btn btn-confirm mt-2'
					})
				}
			})
		})
	}
   //---------------------
	$(document).ready(function(){ searchinput(); });

</script>	
</body>
</html>
