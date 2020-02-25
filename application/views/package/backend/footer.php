<!-- Modal -->
<!-- sample modal content -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title titleA" id="myModalLabel">Modal Heading</h4>
            </div>
            <div class="modal-body bodyA"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modal_Large" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: white">
            <style>
            </style>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
            </div>
            
            <div class="modal-body"></div>
           
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>          
               <button type="button" id="Print" class="btn btn-primary">Print</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- sample modal content -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- jQuery  -->
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/popper.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/metisMenu.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/waves.js')?>"></script> 
<script src="<?php echo base_url('assets/plugins/custombox/js/custombox.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/custombox/js/legacy.min.js') ?>"></script>
        <!-- App js -->
<script src="<?php echo base_url('assets/js/jquery.mockjax.js')?>"></script>
<script src="<?php echo base_url('assets/js/jquery.slimscroll.js')?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap-filestyle.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js')?>"></script>
        <!-- App js -->
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script> 
        <!-- App js -->
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap4.min.js')?>"></script>

<script src="<?php echo base_url('assets/plugins/moment/moment.js')?>" type="text/javascript"></script>	
<script src="<?php echo base_url('assets/plugins/tinymce/tinymce.min.js') ?>"></script>	
<script src="<?php echo base_url('assets/plugins/bootstrap-xeditable/js/bootstrap-editable.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/summernote/summernote-bs4.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/sweet-alert/sweetalert2.min.js')?>"></script>
<script src="<?php echo base_url('assets/pages/jquery.sweet-alert.init.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/switchery/switchery.min.js')?>"></script>

<script src="<?php echo base_url('assets/js/jquery.core.js')?>"></script>
<script src="<?php echo base_url('assets/js/jquery.app.js')?>"></script>
<script>
    document.getElementById("Print").onclick = function () {
    printElement(document.getElementById("printThis"));
};

function printElement(elem) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
}
			function cangePassForm(){
				$.post('<?php echo base_url('PackageCMS/cangePassForm')?>' , { }, function(data){
						$('#myModal .modal-body').empty();
						$('#myModalLabel').text('เปลี่ยนรหัสผ่าน');
						$('.bodyA').html(data);
						$('#myModal').modal('show');	
				})
			}
			//-----------------------newpass cnewpass
			function DoChangePass(){
				var newpass = $('#newpass').val();
				var cnewpass = $('#cnewpass').val();
				if(newpass==''){
					$('#ShowError').html('<span class="text-danger">กรุณาใส่รหัสผ่านใหม่</span>');
					return false;
				}else if(cnewpass==''){
					$('#ShowError').html('<span class="text-danger">กรุณายืนยันรหัสผ่านใหม่</span>');
					return false;	
				}else if(newpass!=cnewpass){
					$('#ShowError').html('<span class="text-danger">รหัสผ่านและยืนยันรหัสผ่านต้องตรงกัน</span>');
					return false;	
				}else{
					$('#ShowError').empty();
					$.post('<?php echo base_url('PackageCMS/doChangePass')?>', { newpass : newpass  }, function(data){
						if(data==1){
							alert('เปลียนรหัสผ่านเรียบร้อย');
							$('#myModal').modal('hide');	
						}else{
							$('#ShowError').html('<span class="text-danger">Error ไม่สามารถเปลียนรหัสผ่านได้</span>');
						}
					})
				}
			}
		</script>
 