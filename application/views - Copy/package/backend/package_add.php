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
                       <h4><?php if ($currentID == '') {echo 'Add Trip';
} else {
    echo 'Trip detail';
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
    $packageData = $this->Package_model->list_packageData($currentID);
    foreach ($packageData->result() AS $Data) {
    }
}
?>
              <form enctype="multipart/form-data" id="packageForm" name="packageForm">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">package name : <a style="color:red;">*</a></label>
                    <div class="col-sm-9">
                        <input type="text" id="name" name="name" class="form-control form-control-sm" value="<?php if ($currentID != '') {echo $Data->package_name_en;}  ?> " >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">package detail : <a style="color:red;">*</a></label>
                    <div class="col-sm-9">
                        <textarea id="desc" name="desc" type="text" class="summernote "><?php if ($currentID != '') {echo $Data->package_detail; } ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">included name :</label>
                    <div class="col-sm-9 ">
                        <?php $arr = array();
                        if($currentID !=''){
                            $listpackage_include=$this->Package_model->listpackage_include($currentID);
                            $numincluded = $listpackage_include->num_rows();
                            if($numincluded >0){  	
                           foreach($listpackage_include->result() AS $package_include){
                               array_push($arr,$package_include->feature_id);
                           } 
                            }
                        }
                                                                                $datatype='1';
		$listpackage_feature=$this->Package_model->listpackage_feature($datatype);
                                                                                foreach($listpackage_feature->result() AS $data){
                         if(in_array($data->id, $arr)){  $bb = 'checked';  }else { $bb = ''; }                                                            
                                                                                    ?>
                        <div class="col-4 checkbox checkbox-success checkbox-circle">
                       <input type="checkbox" id="include<?php echo $data->id?>"name="include[]" value="<?php echo $data->id?>" <?php echo $bb?> onClick="checkout('<?php echo $data->id?>','<?php echo $currentID?>',this.checked)">
                       <label for="include<?php echo $data->id?>"><?php echo $data->include_name_en?></label>
                        </div>
             <?php }?>
                    </div>
                </div>
                  <div class="form-group row">
                      <div class="col-sm-12 ">
                          <?php
                          if ($currentID != '') {
                          $option = $this->Package_model->listpackage_option($currentID);
                          $numoption = $option->num_rows();
        ?>
                          <?php if($numoption >0){?>
            <table class="table table-bordered table-hover" id="table1">
                <thead>	
                    <tr style="background-color: #F2F2F2">
                        <th width="10" style="text-align:center">No</th>
                        <th width="281" > Price Option</th>
                        <th width="140" > Min Person</th>
                        <th width="140" > Max Person</th>
                        <th width="140" > Adult Price</th>
                        <th width="140" > Child Price</th>
                        <th width="100" nowrap="nowrap" style="text-align:center">edit </th>
                        <th width="100" nowrap="nowrap" style="text-align:center">delete</th>
                    </tr>
                </thead>	
                <tbody>	
        <?php $n = 1;
        foreach ($option->result() as $option2) { ?>
                        <tr>
                            <td style="text-align:center"><?php echo $n ?></td>
                            <td>
                                <input type="text" id="name<?php echo $option2->id ?>" name="name<?php echo $option2->id ?>" class="form-control form-control-sm" value="<?php echo $option2->price_option ?>">
                                </td>
                            <td>
                                <input type="text" id="min<?php echo $option2->id ?>" name="min<?php echo $option2->id ?>" class="form-control form-control-sm" value="<?php echo $option2->min_person ?>">
                                </td>
                            <td>
                                <input type="text" id="max<?php echo $option2->id ?>" name="max<?php echo $option2->id ?>" class="form-control form-control-sm" value="<?php echo $option2->max_person ?>">
                                </td>
                                <td>
                                <input type="text" id="Adult<?php echo $option2->id ?>" name="Adult<?php echo $option2->id ?>" class="form-control form-control-sm" value="<?php echo $option2->adult_price ?>">
                                </td>
                                <td>
                                <input type="text" id="Child<?php echo $option2->id ?>" name="Child<?php echo $option2->id ?>" class="form-control form-control-sm" value="<?php echo $option2->child_price ?>">
                                <input type="hidden" name="dataID" id="dataID<?php echo $option2->id ?>" value="<?php echo $option2->id ?>" >  
                            </td>
                            <td style="text-align:center;" ><button type="button" class="btn btn-success btn-sm" onClick="updateThis('<?php echo $option2->id ?>','<?php echo $Data->id ?>')"><i class="icon-pencil"></i></button></td>
                            <td style="text-align:center;"><button type="button" class="btn btn-danger btn-sm" onClick="delete_data('<?php echo $option2->id ?>', 'tbl_price_option','<?php echo $Data->id ?>')"><i class="icon-trash"></i></button></td>
                        </tr>
            <?php $n++;} ?>
                </tbody>
            </table> 
                          <?php }}?>
                      </div>
                  </div>
                   <div class="form-group row" >
                    <div class="col-sm-12" style="text-align: center">
                        <button type="button" class="btn btn-primary btn-sm" onClick="Add()">Add / Edit Data</button>
                        <?php if ($currentID != '') {?>
                        <button type="button" class="btn btn-success btn-sm" onClick="Option(<?php echo $currentID?>)">Price Option</button>
                        <?php }?>
                        <input type="hidden" name="currentID" id="currentID" value="<?php if ($currentID != '') {echo $Data->id;} ?>" >
                    </div>
                </div>					
            </form>
<?php if ($currentID != '') { ?>
                <br>
                <hr>
                <br>
              <div id="showSection" >
                    <div class="form-group row">
                        <label class="col-sm-3 fa fa-file-image-o" style="font-size:16px;font-weight: bold;"> Package Images additional</label>
                        <form enctype="multipart/form-data" id="imgForm" name="imgForm" method="post">
                            <div class="col-sm-12">
                                <label>&emsp;&emsp;If you want to add a photo Click Browse to select the image file. Then press the Add Photos button. The system can add unlimited images. The image should be no larger than 1024 by 768 pixels high. ( .jpg .gif .png support) </label>
                                <a>choose file</a>
                                <input type="hidden" name="currentID2" id="currentID2" value="<?php if ($currentID != '') {echo $Data->id;} ?>" >
                                <input type="file" class="btn-light" id="img2" name="img2[]" multiple/>
                                <a href="#" class="btn btn-custom waves-effect waves-light" onClick="Addimg()">Add Image</a>
                                <div id="showImage" style="margin-top: 5px;"></div>
                            </div>
                        </form>
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