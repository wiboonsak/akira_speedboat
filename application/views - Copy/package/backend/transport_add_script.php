<?php $checkURL02 = $this->uri->segment(3);
	  $classIcon = '';	

	  if(isset($checkURL02)){		
		  $curriculumDataX = $this->Package_model->list_researchClusters($checkURL02);
		  foreach($curriculumDataX->result() as $curriculumDataY){	}		  
		  $classIcon = $curriculumDataY->icon_class;
	  }

?>
<script type="text/javascript">
    $(document).ready(function () {
          loadImages('<?php echo $currentID ?>');
           tinymce.init({
            selector: "textarea.ex",
            theme: "modern",
            height: 300,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ]
        });
        /////////////////////////////////	
		
	var url3 = '<?php echo $checkURL02;?>';	
	var	classIcon = '<?php echo $classIcon;?>';
		
	if((url3 !='') && (classIcon !='')){
		
		var classIcon2 = classIcon.replace(' ', '.');
		
		$('.'+classIcon2+'.icon-click').removeClass("icon-click");
		$('.'+classIcon2).addClass('select-icon');			
	}		
    });
              //---------------------- txtTitle catFiles 
    function Add() {
        var name = $('#name').val();
        var icon_class = $('#icon_class').val();
        var desc = tinyMCE.editors[$('#desc').attr('id')].getContent();
        $('#comment').val(desc);
    var currentID = $('#currentID').val();
        if (name == '') {
            swal(
                    {
                        title: 'Please enter Check in Place!',
                        confirmButtonClass: 'btn btn-confirm mt-2',
                        type: 'warning'
                    }
            ) 
     }else if(desc == ''){ 
			    swal(
					{
						title: ' Please enter Map!',
						confirmButtonClass: 'btn btn-confirm mt-2',
						type: 'warning'
					}
				)
     }else if(icon_class == ''){ 
			    swal(
					{
						title: ' Please Select Icon!',
						confirmButtonClass: 'btn btn-confirm mt-2',
						type: 'warning'
					}
				)
        } else {
            //---------------------------------------------
            var postData = new FormData($("#TransportForm")[0]);
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('PackageCMS/addtransport') ?>',
                processData: false,
                contentType: false,
                data: postData,
                success: function (data, status) {
                    console.log(data);
                    $('#currentID').val(data);
                    console.log('data->' + data + '  status->' + status);
                    if (status == 'success') {
                        swal({
                            title: 'Successfully saved.',
                            //text: 'You clicked the button!',
                            type: 'success',
                            confirmButtonClass: 'btn btn-confirm mt-2'
                            });
                     setTimeout(function(){ window.location.href = "<?php echo base_url('PackageCMS/transportAdd/')?>"+data; }, 2000);
        } else {
                        swal({
                            title: 'can not be saved.!',
                            //text: "You won't be able to revert this!",
                            type: 'warning',
                            confirmButtonClass: 'btn btn-confirm mt-2'
                        });
                    }
    }
            });
       }

   }
    //--------------------------------------------------
    $(".fileupload-exists").click(function () {
        $("#upload_preview").empty();
        $("#upload_preview").addClass("fileupload-exists");
        $("#upload_new").removeClass("fileupload-exists");
        $("#img").val("");
        $("[data-provides=fileupload]").removeClass("fileupload-exists");
        $("[data-provides=fileupload]").addClass("fileupload-new");
    });
    
    //--------------------------------------
    function Addimg() {
        var currentID = $('#currentID2').val();
        var postData = new FormData($("#imgForm")[0]);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('PackageCMS/addimg2') ?>',
            processData: false,
            contentType: false,
            data: postData,
            success: function (data, status) {
                $('#currentID').val(data);
                if (status == 'success') {
                    swal({
                        title: 'Successfully saved.',
                        type: 'success',
                        confirmButtonClass: 'btn btn-confirm mt-2'
                    });
                    setTimeout(function () {
                        window.location.href = "<?php echo base_url('PackageCMS/transportAdd/') ?>" + currentID;
                    }, 2000);
                } else {
                    swal({
                        title: 'Can not be saved.!',
                        type: 'warning',
                        confirmButtonClass: 'btn btn-confirm mt-2'
                    });
                }
            }
        });
    }
        //--------------------------- 
    function  loadImages(ProID) {
        $.post('<?php echo base_url('PackageCMS/loadImg2') ?>', {ProID: ProID}, function (data) {
            $('#showImage').empty();
            $('#showImage').html(data);

        });
    }
     //---------------------------------------- 
    function comfirmDelete(DataID, fileType, FileName) {
        var currentID = $('#currentID').val();
        swal({
            title: 'Delete Data ?',
            text: "Please confirm the delete !",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirm delete',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-success mt-2',
            cancelButtonClass: 'btn btn-danger ml-2 mt-2',
            buttonsStyling: false
        }).then(function () {
            $.post('<?php echo base_url('PackageCMS/deletePorductFile1') ?>', {DataID: DataID, fileType: fileType, FileName: FileName}, function (data) {
                console.log(data);
                if (data == '1') {
                    swal({
                        title: 'Deleted !',
                        text: "Data has been successfully deleted.",
                        type: 'success',
                        confirmButtonClass: 'btn btn-confirm mt-2'
                    })
                    setTimeout(function () {
                        window.location.href = "<?php echo base_url('PackageCMS/transportAdd/') ?>" + currentID;
                    }, 2000);
                } else {
                    swal({
                        title: 'Error',
                        text: "Can not be deleted.",
                        type: 'error',
                        confirmButtonClass: 'btn btn-confirm mt-2'
                    })
                }
            });
        }, function (dismiss) {
            if (dismiss === 'cancel') {
                swal({
                    title: 'Cancelled',
                    text: "You have canceled the data.",
                    type: 'error',
                    confirmButtonClass: 'btn btn-confirm mt-2'
                })
            }
        })
    }
    //----------------------------
    	$( ".icon-click" ).click(function() { 
		$(".select-icon").addClass("icon-click");
		$(".select-icon").removeClass("select-icon");
		$(this).removeClass("icon-click");
		var class2 = $(this).attr("class"); 
		$(this).addClass("select-icon");
		 console.log("class2...."+class2);
		
		//var class3 = 
		$("#icon_class").val(class2);
										
	}); 
    

</script>	
</body>
</html>
