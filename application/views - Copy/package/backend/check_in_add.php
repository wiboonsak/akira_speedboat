<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
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
                       <h4><?php if ($currentID == '') {echo 'Add Check in Place';
} else {
    echo 'Check in Place Detail';
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
    $checkinData = $this->Package_model->list_checkinData($currentID);
    foreach ($checkinData->result() AS $Data) {
    }
}
?>
              <form enctype="multipart/form-data" id="CheckForm" name="CheckForm">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Check in Place :</label>
                    <div class="col-sm-9">
                        <input type="text" id="name" name="name" class="form-control form-control-sm" value="<?php if ($currentID != '') {echo $Data->checkin_name_en; } ?> " >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Telephone Number :</label>
                    <div class="col-sm-9">
                        <input type="text" id="telephone" name="telephone" class="form-control form-control-sm" value="<?php if ($currentID != '') {echo $Data->checkin_telephone; } ?> " >
                    </div>
                </div>
                 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Map :</label>
                    <div class="col-sm-9">
                        <textarea id="mapcheck" name="mapcheck" type="text" class="ex"><?php if ($currentID != '') {echo $Data->checkin_map; } ?></textarea>
                    </div>
                </div>
                   <div class="form-group row" >
                    <div class="col-sm-12" style="text-align: center">
                        <button type="button" class="btn btn-primary btn-sm" onClick="Add()">Add / Edit Data</button>
                         <input type="hidden" name="comment" id="comment" >
                        <input type="hidden" name="currentID" id="currentID" value="<?php if ($currentID != '') {echo $Data->id;} ?>" >
                    </div>
                </div>					
            </form>
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