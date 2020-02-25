<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
     <!-- Begin page -->
        <div id="wrapper">
            	<?php //include('side_menu.php')?>
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
                        <h4 class="page-title">Place</h4>
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
    $placeData = $this->Package_model->list_placeData($currentID);
    foreach ($placeData->result() AS $Data) {
    }
}
?>
              <form enctype="multipart/form-data" id="placeForm" name="placeForm">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Place :</label>
                    <div class="col-sm-9">
                        <input type="text" id="sname" name="name" class="form-control form-control-sm" value="<?php if ($currentID != '') {echo $Data->place_name_en; } ?> " >
                    </div>
                </div>
                   <div class="form-group row" >
                    <div class="col-sm-12" style="text-align: center">
                        <button type="button" class="btn btn-success btn-sm" onClick="Add()">Add/Edit Data</button>
                        <input type="hidden" name="currentID" id="currentID" value="<?php if ($currentID != '') {echo $Data->id;} ?>" >
                    </div>
                </div>					
            </form>	

                                                <br>
                                                <hr>
                                                <br>
                                                  <div class="card-box table-responsive" id="showSeason">
        </div>

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
</div>
<!-- END wrapper --> 