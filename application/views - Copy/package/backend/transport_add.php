<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
          
<style>
	.icon-click {
		cursor: pointer;
		padding: 0 7px 0 7px;
	}
	
	.select-icon {
		font-size: 50px;
		padding: 0 10px 0 10px;
		color: #1d70af;
	}

</style>      
<!-- Begin page -->
        <div id="wrapper">
            	<?php include('side_menu.php')?>
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
                       <h4><?php if ($currentID == '') {echo 'Add Transport';
} else {
    echo 'Transport Detail';
} ?></h4>
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
                <?php 
if ($currentID != '') {
    $transportData = $this->Package_model->list_transportData($currentID);
    foreach ($transportData->result() AS $Data) {
    }
}
?>
              <form enctype="multipart/form-data" id="TransportForm" name="TransportForm">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Transprot :</label>
                    <div class="col-sm-9">
                        <input type="text" id="name" name="name" class="form-control form-control-sm" value="<?php if ($currentID != '') {echo $Data->transport_name_en; } ?> " >
                    </div>
                </div>
                 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Description :</label>
                    <div class="col-sm-9">
                        <textarea id="desc" name="desc" type="text" class="ex"><?php if ($currentID != '') {echo $Data->transport_info_en; } ?></textarea>
                    </div>
                </div>
                  <div class="form-group row">
                                         <label class="col-sm-3 col-form-label">ICON :</label>
                                        <div class="col-md-9 col-sm-12" style="color: #343a40; font-size: x-large;">
											<i class="fa fa-bus icon-click"></i>
											<i class="fa fa-ship icon-click"></i>
											<i class="fa fa-car icon-click"></i>
											<i class="fa fa-taxi icon-click"></i>
											
                                        </div>
                                    </div>
                   <div class="form-group row" >
                    <div class="col-sm-12" style="text-align: center">
                        <button type="button" class="btn btn-primary btn-sm" onClick="Add()">Add / Edit Data</button>
                         <input type="hidden" name="comment" id="comment" >
                        <input type="hidden" name="currentID" id="currentID" value="<?php if ($currentID != '') {echo $Data->id;} ?>" >
                        <input type="hidden" id="icon_class" name="icon_class" value="<?php if($currentID !=''){ echo $Data->icon_class;}?>" >
                    </div>
                </div>					
            </form>
                <?php if ($currentID != '') { ?>
                <br>
                <hr>
                <br>
                <br>
                <div id="showSection" >
                    <div class="form-group row">
                        <label class="col-sm-3 fa fa-file-image-o" style="font-size:16px;font-weight: bold;">
                            Transport Images 
                        </label>
                        <div class="col-9">
                        <form enctype="multipart/form-data" id="imgForm" name="imgForm" method="post">
                            <div class="col-sm-12">
                                <a>choose file</a>
                                <input type="hidden" name="currentID2" id="currentID2" value="<?php if ($currentID != '') {
        echo $Data->id;
    } ?>" >
                                <input type="file" class="btn-light" id="img2" name="img2[]" multiple/>
                                <a class="btn btn-custom waves-effect waves-light" onClick="Addimg()">Add image</a>
                                <br>
                                <div id="showImage" style="margin-top: 5px;"></div>
                            </div>
                        </form>
                            </div>
                    </div>
                </div>
<?php } ?>
            </div>

        </div> <!-- container -->

    </div> <!-- content -->

    <footer class="footer text-right">
        <!--2018 © Highdmin. - Coderthemes.com-->
    </footer>

</div>
        </div>

<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->

<!-- END wrapper --> 