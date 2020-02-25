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
	
		var SearchBooking = $('#SearchBooking option:selected').val();
                var payment_status='1';
                var payment_type='all';
                var dataID='all';
		var datepicker1 = $('#datepicker1').val();
                if(datepicker1==''){
				var  datepicker1='all';
			 }
		var datepicker2 = $('#datepicker2').val();				
		 if(datepicker2==''){
				var  datepicker2='all';
			 }
                $.post('<?php echo base_url('PackageCMS/searchdataTrancommis')?>' , { dateStart : datepicker1 , payment_status:payment_status,payment_type:payment_type , partner_id:SearchBooking , dateEnd:datepicker2 , dataID:dataID } , function(data){
			 
				
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
		var booking_status= 1;
		$.post('<?php echo base_url('PackageCMS/transportDetail')?>' , {DataID:DataID , booking_status:booking_status },function(data){
			    $('#modal_Large .modal-body').empty();
     			$('#modal_Large  .modal-title').html('No. <span class="text-danger">'+booking_no+'</span>');
     			$('#modal_Large .modal-body').html(data);
     			$('#modal_Large').modal('show');
		})
			   
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
        function datepick2(date){
            $('#datepicker2').val(date);
        }

  

</script>	
</body>
</html>
