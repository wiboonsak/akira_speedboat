<style>
.removeRow
{

}
</style>
<script type="text/javascript">
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
    url:"<?php echo base_url(); ?>PackageCMS/delete_all",
    method:"POST",
    data:{checkbox_value:checkbox_value},
    success:function()
    {
     $('.removeRow').fadeOut(1500);
     $("#ckbCheckAll").prop('checked',false);
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
    url:"<?php echo base_url(); ?>PackageCMS/save_all",
    method:"POST",
    data:{checkbox_value:checkbox_value},
    success:function()
    {
     $('.removeRow').fadeOut(1500);
     $("#ckbCheckAll").prop('checked',false);
    }
   })
  }
  else
  {
   alert('Select atleast one records');
  }
 });

});
    
        //-------------------------------------------
            function searchinput(){
            var SearchBookingpart = $('#SearchBookingpart').val();
            if(SearchBookingpart==''){
                var SearchBookingpart = 'all';
            }
	    var  SearchBooking='all';
            var datepicker1 = $('#datepicker1').val();				
			 if(datepicker1==''){
				var  datepicker1='all';
			 }
            
            var dataID='all';
            var booking_status='1';
            var cfstatusno1='all';
            var cfstatusno2='all';
            var cfstatus='2';
			
			$.post('<?php echo base_url('PackageCMS/landTransfer_Search')?>' , { booking_status:booking_status , dataID:dataID,datebook:datepicker1, SearchBooking:SearchBooking,cfstatusno1:cfstatusno1 ,cfstatusno2:cfstatusno2,cfstatus:cfstatus,SearchBookingpart:SearchBookingpart } , function(data){ 
				
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
                function ShowBookDetail(DataID,booking_no){
		var booking_status= '1';
		$.post('<?php echo base_url('PackageCMS/landtransferDetail')?>' , {DataID:DataID , booking_status:booking_status },function(data){
			    $('#modal_Large .modal-body').empty();
     			$('#modal_Large  .modal-title').html('No. <span class="text-danger">'+booking_no+'</span>');
     			$('#modal_Large .modal-body').html(data);
     			$('#modal_Large').modal('show');
		})
			   
	}
           function datepick2(date){
            $('#datepicker2').val(date);
        }
                function printData()
{
   var divToPrint=document.getElementById("table2");
    var htmlToPrint = '' +
        '<style type="text/css">' +
        'table th, table td {' +
        'border:1px solid #000;' +
        '}' +
        '</style>';
 htmlToPrint += divToPrint.outerHTML;
   newWin= window.open("");
   newWin.document.write(htmlToPrint);
   newWin.print();
   newWin.close();
}
  

</script>	
</body>
</html>
