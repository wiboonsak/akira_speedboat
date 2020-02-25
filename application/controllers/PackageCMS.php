<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PackageCMS extends CI_Controller {
    function __construct() {
        parent::__construct();
		
           if($this->session->userdata('user_id')){     
		 	}else{
    		 	redirect(base_url().'login', 'refresh');
		 	}	
		
        $this->load->model('Package_model');
        $this->load->model('transport_model');
    }    //-------------------	
    public function index($currentID=null) {
        $data['currentID'] = $currentID;
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/included_view',$data);
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/included_view_script');
    }    //----------------------------
    public function addFeature() {
        $currentID = $this->input->post('currentID');
        $name = $this->input->post('name');
        $result_id = $this->Package_model->addFeature($currentID, $name);
        echo $result_id;
    }    //------------------------
    public function loadIncluded() {
        $included = $this->Package_model->included();
        ?>
        <form name="includedForm" id="includedForm">
            <table class="table table-bordered table-hover" id="table1">
                <thead>	
                    <tr style="background-color: #F2F2F2">
                        <th width="10" style="text-align:center">No</th>
                        <th width="281" > included name</th>
                        <th width="100" nowrap="nowrap" style="text-align:center">edit </th>
                        <th width="100" nowrap="nowrap" style="text-align:center">delete</th>
                    </tr>
                </thead>	
                <tbody>	
        <?php $n = 1;
        foreach ($included->result() as $included2) { ?>
                        <tr>
                            <td style="text-align:center"><?php echo $n ?></td>
                            <td>
                                <input type="text" id="name<?php echo $included2->id ?>" name="name" class="form-control form-control-sm" value="<?php echo $included2->include_name_en ?>">
                                <input type="hidden" name="dataID" id="dataID<?php echo $included2->id ?>" value="<?php echo $included2->id ?>" >  
                            </td>
                            <td style="text-align:center;" ><button type="button" class="btn btn-success btn-sm" onClick="updateThis('<?php echo $included2->id ?>')"><i class="icon-pencil"></i></button></td>
                            <td style="text-align:center;"><button type="button" class="btn btn-danger btn-sm" onClick="delete_data('<?php echo $included2->id ?>', 'tbl_package_feature')"><i class="icon-trash"></i></button></td>
                        </tr>
            <?php $n++;} ?>
                </tbody>
            </table> 
        </form>
        <script>
            $(document).ready(function () {
                $('#table1').DataTable({
                    searching: false,
                    ordering: false,
                    pageLength: 15,
                    lengthChange: false
                });
                ///////////////////////////////////////	

                $('[data-plugin="switchery"]').each(function (idx, obj) {
                    new Switchery($(this)[0], $(this).data());
                });
            })
        </script> 
        <?php
    }    //-------------------
    public function deleteData() {
        $dataID = $this->input->post('dataID');
        $table = $this->input->post('table');
        $result = $this->Package_model->deleteData($dataID, $table);
        echo $result;
    }    //-------------------
    public function deleteDataroute() {
        $dataID = $this->input->post('dataID');
        $table = $this->input->post('table');
        $result = $this->Package_model->deleteDataroute($dataID, $table);
        echo $result;
    }    //-------------------
    public function deleteData2() {
        $dataID = $this->input->post('dataID');
        $table = $this->input->post('table');
        $result = $this->Package_model->deleteData2($dataID, $table);
        echo $result;
    }    //-------------------
    public function deleteData3() {
        $dataID = $this->input->post('dataID');
        $table = $this->input->post('table');
        $result = $this->Package_model->deleteData3($dataID, $table);
        echo $result;
    }    //-------------------
    public function deleteData4() {
        $dataID = $this->input->post('dataID');
        $table = $this->input->post('table');
        $result = $this->Package_model->deleteData4($dataID, $table);
        echo $result;
    }    //-------------------
    public function deleteData5() {
        $dataID = $this->input->post('dataID');
        $table = $this->input->post('table');
        $result = $this->Package_model->deleteData5($dataID, $table);
        echo $result;
    }    //----------------------------
    public function updateThis() {
        $currentID = $this->input->post('currentID');
        $name = $this->input->post('name');
        $result_id = $this->Package_model->updateseason($currentID, $name);
        echo $result_id;
    }    //----------------------------
    public function updateThis2() {
        $currentID = $this->input->post('currentID');
        $name = $this->input->post('name');
        $result_id = $this->Package_model->updateplace($currentID, $name);
        echo $result_id;
    }    //----------------------------
    public function updateThis1() {
        $currentID = $this->input->post('currentID');
        $name = $this->input->post('name');
        $min = $this->input->post('min');
        $max = $this->input->post('max');
        $Adult = $this->input->post('Adult');
        $Child = $this->input->post('Child');
        $result_id = $this->Package_model->updateoption($currentID, $name,$min,$max,$Adult,$Child);
        echo $result_id;
    }    //-------------------	
    public function packageAdd($currentID=null) {
        $data['currentID'] = $currentID;
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/package_add',$data);
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/package_add_script');
    }    //------------------------------- 	
    public function addpackage() {
        $name = $this->input->post('name');
        $desc = $this->input->post('desc');
        $currentID = $this->input->post('currentID');
        $include = $this->input->post('include');
        $result_id = $this->Package_model->addpackage($currentID, $name, $desc,$include);
        echo $result_id;
    }    //----------------------------
    public function addimg() {
        $currentID = $this->input->post('currentID2');
        $upload_path = './uploadfile/';
        $upload_pathName = 'uploadfile/';
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
        $config['max_size'] = '0';
        $image_data = array();
        $is_file_error = FALSE;
        $Result = 0;
        $this->load->library('upload', $config);
        $countFiles = count($_FILES['img2']['name']);
        if ($countFiles > 0) {
            for ($i = 0; $i < $countFiles; $i++) {    //---------------------------
                $_FILES['file_upload2']['name'] = $_FILES['img2']['name'][$i];
                $_FILES['file_upload2']['type'] = $_FILES['img2']['type'][$i];
                $_FILES['file_upload2']['tmp_name'] = $_FILES['img2']['tmp_name'][$i];
                $_FILES['file_upload2']['error'] = $_FILES['img2']['error'][$i];
                $_FILES['file_upload2']['size'] = $_FILES['img2']['size'][$i];
                $this->upload->initialize($config);
                if ($this->upload->do_upload('file_upload2')) {
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $img = $uploadData[$i]['file_name'];
                 $result_id = $this->Package_model->addimg($img, $currentID);
                }
            }
        }
        echo $currentID;
    }    //----------------------------------
    public function loadImg() {
        $ProID = $this->input->post('ProID');
        $imglist = $this->Package_model->loadImg($ProID);
        echo '<table class="table table-bordered table-hover">';
        foreach ($imglist->result() AS $data) {
            echo '<tr id = "RowImg' . $data->id . '">';
            echo '<td width="400"><span class="text-danger"><img src="' . base_url('uploadfile/') . $data->images_name . '" style="width:150px;" class="thumbnail"></span></td>';
             ?>
            <td style="text-align: -webkit-center;"><input style="text-align:center;width: 200px;" id="order<?php echo $data->id ?>" type="text" class="form-control form-control-sm OrderCate" value="<?php echo $data->sort_number ?>" onChange="updateOrder('<?php echo $data->id ?>', 'sort_number', this.value)">
                <input type="hidden" id="chkOrder<?php echo $data->id ?>" value="<?php echo $data->sort_number ?>"></td><?php
            echo '<td width="30" style="text-align: center"><button type="button" class="btn btn-danger btn-sm" onclick="comfirmDelete(\'' . $data->id . '\' , \'imgfile\', \'' . $data->images_name . '\')"><i class="icon-trash"></i></button></td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    	 //------------------dataID changeValue //
	public  function updateOrder(){
		$dataID = $this->input->post('dataID');
		$changeValue = $this->input->post('changeValue');
		$result = $this->Package_model->updateOrder($dataID,$changeValue);
		echo $result;
		
	}    //-------------------------------
    public function deletepackageimg() {
        $fileType = $this->input->post('fileType');
        $DataID = $this->input->post('DataID');
        $FileName = $this->input->post('FileName');
        $result = $this->Package_model->deletepackageimg($DataID, $fileType, $FileName);
        echo $result;
    }    //-------------------
	public function remove_included(){
		
		$featureid = $this->input->post('featureid');				
		$packageid = $this->input->post('dataID');			
		$result = $this->Package_model->remove_included($featureid, $packageid);		
		echo $result;	
	}    //-------------------	
    public function packagelist() {
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/package_view');
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/package_view_script');
    }    //-------------------
    public function set_ShowOnWeb() {
        $dataID = $this->input->post('dataID');
        $check = $this->input->post('check');
        $table = $this->input->post('table');
        $result = $this->Package_model->ShowOnWeb($dataID, $check, $table);
        echo $result;
    }    //-------------------------------	
    public function Option() {
        $dataid = $this->input->post('packageId');
        $data['packageID'] = $dataid;
        $this->load->view('package/backend/Option',$data);
    }    //------------------------------- 	
    public function addoption() {
        $Option = $this->input->post('Option');
        $minperson = $this->input->post('minperson');
        $maxperson = $this->input->post('maxperson');
        $Adult = $this->input->post('Adult');
        $Child = $this->input->post('Child');
        $currentID = $this->input->post('currentID');
        $currentID2 = $this->input->post('currentID2');
        $result_id = $this->Package_model->addoption($currentID,$currentID2, $Option,$minperson,$maxperson, $Adult, $Child);
        echo $result_id;
    }    //------------------------------------------
	public  function checkoption(){
		$changeValue = $this->input->post('option');
		$result = $this->Package_model->count_option($changeValue);
		echo $result;
		
	}    //----------------------------------	
    public function placeAdd($currentID=null) {
        $data['currentID'] = $currentID;
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/place_add',$data);
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/place_add_script');
    }    //------------------------------- 	
    public function addplace() {
        $name = $this->input->post('name');
        $currentID = $this->input->post('currentID');
        $result_id = $this->Package_model->addplace($currentID, $name);
        echo $result_id;
    }    //--------------------------------	
    public function checkinAdd($currentID=null) {
        $data['currentID'] = $currentID;
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/check_in_add',$data);
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/check_in_add_script');
    }    //------------------------------- 	
    public function addcheckin() {
        $name = $this->input->post('name');
        $telephone = $this->input->post('telephone');
        $comment = $this->input->post('comment');
        $currentID = $this->input->post('currentID');
        $result_id = $this->Package_model->addcheckin($currentID, $name,$telephone, $comment);
        echo $result_id;
    }    //--------------------------------	
    public function transportAdd($currentID=null) {
        $data['currentID'] = $currentID;
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/transport_add',$data);
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/transport_add_script');
    }    //------------------------------- 	
    public function addtransport() {
        $name = $this->input->post('name');
        $comment = $this->input->post('comment');
        $icon_class = $this->input->post('icon_class');
        $currentID = $this->input->post('currentID');
        $result_id = $this->Package_model->addtransport($currentID, $name, $comment,$icon_class);
        echo $result_id;
    }    //----------------------------
    public function addimg2() {
        $currentID = $this->input->post('currentID2');
        $upload_path = './uploadfile/';
        $upload_pathName = 'uploadfile/';
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
        $config['max_size'] = '0';
        $image_data = array();
        $is_file_error = FALSE;
        $Result = 0;
        $this->load->library('upload', $config);
        $countFiles = count($_FILES['img2']['name']);
        if ($countFiles > 0) {
            for ($i = 0; $i < $countFiles; $i++) {    //---------------------------
                $_FILES['file_upload2']['name'] = $_FILES['img2']['name'][$i];
                $_FILES['file_upload2']['type'] = $_FILES['img2']['type'][$i];
                $_FILES['file_upload2']['tmp_name'] = $_FILES['img2']['tmp_name'][$i];
                $_FILES['file_upload2']['error'] = $_FILES['img2']['error'][$i];
                $_FILES['file_upload2']['size'] = $_FILES['img2']['size'][$i];
                $this->upload->initialize($config);
                if ($this->upload->do_upload('file_upload2')) {
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $img = $uploadData[$i]['file_name'];
                     $result_id = $this->Package_model->addimg2($img, $currentID);
                }
            }
        }
        echo $currentID;
    }    //----------------------------------
    public function loadImg2() {
        $ProID = $this->input->post('ProID');
        $imglist = $this->Package_model->loadImg2($ProID);
        echo '<table class="table table-bordered table-hover">';
        foreach ($imglist->result() AS $data) {
            echo '<tr id = "RowImg' . $data->id . '">';
            echo '<td width="400"><span class="text-danger"><img src="' . base_url('uploadfile/') . $data->images . '" style="width:150px;" class="thumbnail"></span></td>';
            echo '<td width="30"><button type="button" class="btn btn-danger btn-sm" onclick="comfirmDelete(\'' . $data->id . '\' , \'imgfile\', \'' . $data->images . '\')"><i class="icon-trash"></i></button></td>';
            echo '</tr>';
        }
        echo '</table>';
    }    //-------------------------------
    public function deletePorductFile1() {
        $fileType = $this->input->post('fileType');
        $DataID = $this->input->post('DataID');
        $FileName = $this->input->post('FileName');
        $result = $this->Package_model->deleteProductFile1($DataID, $fileType, $FileName);
        echo $result;
    }    //------------------------
    public function loadPlace() {
        $packageData = $this->Package_model->list_placeData();
        ?>
        <form name="placeForm" id="placeForm">
            <table class="table table-bordered table-hover" id="table1">
                <thead>	
                    <tr style="background-color: #F2F2F2">
                        <th width="10" style="text-align:center">No</th>
                        <th width="281" >Place</th>
                        <th width="100" nowrap="nowrap" style="text-align:center">edit </th>
                        <th width="100" nowrap="nowrap" style="text-align:center">delete</th>
                    </tr>
                </thead>	
                <tbody>	
        <?php $n = 1;
        foreach ($packageData->result() as $packageData2) { ?>
                        <tr>
                            <td style="text-align:center"><?php echo $n ?></td>
                            <td>
                                <input type="text" id="name<?php echo $packageData2->id ?>" name="name" class="form-control form-control-sm" value="<?php echo $packageData2->place_name_en ?>">
                                <input type="hidden" name="dataID" id="dataID<?php echo $packageData2->id ?>" value="<?php echo $packageData2->id ?>" >  
                            </td>
                            <td style="text-align:center;" ><button type="button" class="btn btn-success btn-sm" onClick="updateThis('<?php echo $packageData2->id ?>')"><i class="icon-pencil"></i></button></td>
                            <td style="text-align:center;"><button type="button" class="btn btn-danger btn-sm" onClick="delete_data('<?php echo $packageData2->id ?>', 'tbl_place_data')"><i class="icon-trash"></i></button></td>
                        </tr>
            <?php $n++;} ?>
                </tbody>
            </table> 
        </form>
        <script>
            $(document).ready(function () {
                $('#table1').DataTable({
                    searching: false,
                    ordering: false,
                    pageLength: 15,
                    lengthChange: false
                });
                ///////////////////////////////////////	

                $('[data-plugin="switchery"]').each(function (idx, obj) {
                    new Switchery($(this)[0], $(this).data());
                });
            })
        </script> 
        <?php
    }    //-------------------	
    public function checkinlist() {
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/checkin_view');
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/checkin_view_script');
    }    //---------------------------------
    public function transportlist() {
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/transport_view');
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/transport_view_script');
    }    //-------------------------------	
   public function cangePassForm(){
	   $this->load->view('package/backend/changepassform');
   }    //-------------------------------  doChangePass') ', { newpass
    public function doChangePass(){
		$newpass = trim($this->input->post('newpass'));
		
		$result = $this->Package_model->doChangePass($newpass);
		echo $result;
	}    //-------------------	
    public function bookinglist() {
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/booking_view');
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/booking_view_script');
    }    //-------------------	
    public function bookingTransport_view() {
		$booking_status='1';
		$payment_status='all';
		$payment_type='all';
		$partner_id ='all';
		$dateStart='all';
		$dateEnd='all';
		$dataID='all';
		$data['checkinData'] =$this->transport_model->transport_booking_list($booking_status,$payment_status,$payment_type,$partner_id,$dateStart,$dateEnd,$dataID);
		
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/bookingTransport_view',$data);
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/bookingTransport_view_script');
    }    
	//-------------------	
	 public function bookingTransport_Search() { 
		$booking_status=$this->input->post('booking_status');
		$payment_status=$this->input->post('payment_status');
		$payment_type=$this->input->post('payment_type');
		$partner_id =$this->input->post('partner_id');
		$dateStart=$this->input->post('dateStart');
		$dateEnd=$this->input->post('dateEnd');
		$dataID=$this->input->post('dataID');
		
		$data['checkinData'] =$this->transport_model->transport_booking_list($booking_status,$payment_status,$payment_type,$partner_id,$dateStart,$dateEnd,$dataID);
		
		$data['booking_status']=$this->input->post('booking_status');;

        $this->load->view('package/backend/bookingTransport_view_search',$data);
        
    }   
	//-------------------   
	public function transportDetail(){
		$data['DataID'] = $this->input->post('DataID');
		$booking_status=$this->input->post('booking_status');;
		$payment_status='all';
		$payment_type='all';
		$partner_id ='all';
		$dateStart='all';
		$dateEnd='all';
		
		$data['checkinData'] =$this->transport_model->transport_booking_list($booking_status,$payment_status,$payment_type,$partner_id,$dateStart,$dateEnd,$data['DataID']);
		
		$this->load->view('package/backend/bookingTransport_view_detail',$data);
		
	}
	//-------------------   booking_status + DataID
	
	
	//-------------------	
    public function ReportTransportbooking() {
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/report_bookingtran_view');
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/report_bookingtran_view_script');
    } 
	//-------------------	
    public function ReportTransportcancel() {
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/report_canceltran_view');
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/report_canceltran_view_script');
    } 
	//-------------------	
    public function ReportTransportcommission() {
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/report_commission_view');
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/report_commission_view_script');
    } 
	//-------------------------------------------
        public function searchdata(){
        $SearchBooking = $this->input->post('SearchBooking');
        $datepicker1 = $this->input->post('datepicker1');

         if(($datepicker1 != '')&&($datepicker1!= '0000-00-00')){
			
			$dateArray = explode("/",$datepicker1);
			$date= $dateArray[0];
			$mon= $dateArray[1];
			$year= $dateArray[2];			
			$datepicker1 = $year."-".$mon."-".$date;
		/*} else {
			$txtWhere2 = '';*/
         }
        $result_id = $this->Package_model->search($SearchBooking,$datepicker1);{?>
   <table id="table2" class="table table-hover">
                                <thead>
                                    <tr>
                                      <th width="5%" style="text-align:center;">Select All <br><input type="checkbox" id="ckbCheckAll"></th>
                                        <th style="text-align:center;">หมายเลขการจอง</th>
                                        <th style="text-align:center;">Check in</th>
                                        <th style="text-align:center;">ชื่อผู้จอง</th>
                                        <th style="text-align:center;">จำนวนเงิน</th>
                                        <th style="text-align:center;">สถานะ</th>
                                        <th style="text-align:center;">วันที่ทำการจอง</th>
                                        <th style="text-align:center;" width="7%">รายละเอียด</th>
                                        <th style="text-align:center;" width="7%">ยกเลิก</th>
                                        <th style="text-align:center;" width="7%">จัดเก็บ</th>
                                        <th style="text-align:center;" width="7%">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
 <?php 
    foreach ($result_id->result() AS $Data) {?>	
		<tr id="row<?php echo $Data->id ?>">
		<th style="text-align:center;"> <input type="checkbox" class="delete_checkbox" value="<?php echo $Data->id ?>" /></th>
			<td><?php echo $Data->transfer_keygroup ?></td>
			<td><?php echo $Data->date_depart ?></td>
			<td><?php echo $Data->customer_name ?><br><?php echo $Data->customer_telephone ?></td>
			<td style="text-align:center;"><?php echo number_format($Data->total_price) ?></td>
			<td style="text-align:center;"><?php if ($Data->cf_status == 1){echo 'Pending';}else if($Data->cf_status == 2){echo 'Confrimed';}else{echo 'Cancel';} ?></td>
			<td style="text-align:center;"><?php echo $this->Package_model->GetEngDateTime($Data->date_booking);?></td>
			<td style="text-align:center;" > <a href="#" onClick="windowOpener('770', '1000', 'windowName', 'email_book_package/<?php echo $Data->transfer_keygroup?>')"><button type="button" class="btn btn-xs btn-info btn-sm" data-toggle="button" style="width: 88.28px" >Detail</button></a></td>
			<td style="text-align:center;" > <a href="#" onClick="windowOpener('770', '1000', 'windowName', 'email_book_package/<?php echo $Data->transfer_keygroup?>')"><button <?php if ($Data->cf_status == 1){ ?> style="cursor: not-allowed;" disabled <?php }?> type="button" class="btn btn-warning btn-sm" data-toggle="button" ><i class="fa fa-archive"></i></button></a></td>

			 <td style="text-align:center;"><button <?php if ($Data->cf_status == 1){ ?> style="cursor: not-allowed;" disabled <?php }?> type="button" class="btn btn-success btn-sm" onClick="save_data('<?php echo $Data->id ?>', ' tbl_package_booking')" ><i class="fa fa-archive"></i></button></td>
			<td style="text-align:center;"><button  <?php if ($Data->cf_status != 1){ ?> style="cursor: not-allowed;" disabled<?php }?> type="button" class="btn btn-danger btn-sm" onClick="delete_data('<?php echo $Data->id ?>', 'tbl_package_booking')" ><i class="icon-trash"></i></button></td>
		</tr>
	<?php }?>
</tbody>
</table>
        <button type="button" name="delete_all" id="delete_all" class="btn btn-danger btn-xs">Delete</button>
<button type="button" name="save_all" id="save_all" class="btn btn-success btn-xs">Archive</button>
  <?php }?>
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
      setTimeout(function(){ window.location.href = "<?php echo base_url('PackageCMS/bookinglist')?>"; }, 2000);
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
      setTimeout(function(){ window.location.href = "<?php echo base_url('PackageCMS/bookinglist')?>"; }, 2000);
    }
   })
  }
  else
  {
   alert('Select atleast one records');
  }
 });

});
</script>
 <?php  }    //-------------------------------------------
        public function searchdatasave(){
        $SearchBooking = $this->input->post('SearchBooking');
        $datepicker1 = $this->input->post('datepicker1');

         if(($datepicker1 != '')&&($datepicker1!= '0000-00-00')){
			
			$dateArray = explode("/",$datepicker1);
			$date= $dateArray[0];
			$mon= $dateArray[1];
			$year= $dateArray[2];			
			$datepicker1 = $year."-".$mon."-".$date;
		/*} else {
			$txtWhere2 = '';*/
         }
        $result_id = $this->Package_model->searchdatasave($SearchBooking,$datepicker1);{?>
   <table id="table2" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">หมายเลขการจอง</th>
                                        <th style="text-align:center;">Check in</th>
                                        <th style="text-align:center;">ชื่อผู้จอง</th>
                                        <th style="text-align:center;">จำนวนเงิน</th>
                                        <th style="text-align:center;">สถานะ</th>
                                        <th style="text-align:center;">วันที่ทำการจอง</th>
                                        <th style="text-align:center;" width="7%">รายละเอียด</th>
                                        <th style="text-align:center;" width="7%">ยกเลิก</th>
                                        <th style="text-align:center;" width="7%">จัดเก็บ</th>
                                        <th style="text-align:center;" width="7%">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
 <?php 
    foreach ($result_id->result() AS $Data) {?>	
                                        <tr id="row<?php echo $Data->id ?>">
                                            <td><?php echo $Data->transfer_keygroup ?></td>
                                            <td><?php echo $Data->date_depart ?></td>
                                            <td><?php echo $Data->customer_name ?><br><?php echo $Data->customer_telephone ?></td>
                                            <td style="text-align:center;"><?php echo number_format($Data->total_price) ?></td>
                                            <td style="text-align:center;"><?php if ($Data->cf_status == 1){echo 'Pending';}else if($Data->cf_status == 2){echo 'Confrimed ';}else{echo 'Cancel';} ?></td>
                                            <td style="text-align:center;"><?php echo $this->Package_model->GetEngDateTime($Data->date_booking);?></td>
                                            <td style="text-align:center;" > <a href="#" onClick="windowOpener('770', '1000', 'windowName', 'email_book_package/<?php echo $Data->transfer_keygroup?>')"><button type="button" class="btn btn-xs btn-info btn-sm" data-toggle="button" style="width: 88.28px" >Detail</button></a></td>
                                            <td style="text-align:center;" > <a href="#" onClick="windowOpener('770', '1000', 'windowName', 'email_book_package/<?php echo $Data->transfer_keygroup?>')"><button <?php if ($Data->cf_status == 1){ ?> style="cursor: not-allowed;" <?php }?> type="button" class="btn btn-warning btn-sm" data-toggle="button" <?php if ($Data->cf_status == 1){ ?> disabled <?php   } ?> ><i class="fa fa-archive"></i></button></a></td>
                                           
                                             <td style="text-align:center;"><button <?php if ($Data->cf_status == 1){ ?> style="cursor: not-allowed;" <?php }?> type="button" class="btn btn-success btn-sm" onClick="save_data('<?php echo $Data->id ?>', ' tbl_package_booking')" <?php if ($Data->cf_status == 1){ ?> disabled <?php   } ?> ><i class="fa fa-archive"></i></button></td>
                                            <td style="text-align:center;"><button  <?php if ($Data->cf_status != 1){ ?> style="cursor: not-allowed;" <?php }?> type="button" class="btn btn-danger btn-sm" onClick="delete_data('<?php echo $Data->id ?>', 'tbl_package_booking')"<?php if ($Data->cf_status != 1){ ?> disabled <?php   } ?> ><i class="icon-trash"></i></button></td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                            </table>
  <?php }?>
                  <script type="text/javascript">
            $(document).ready(function () {
                 $('#table2').DataTable(

);
          });
          </script>
 <?php  }    //-------------------------------------------
        public function searchdatacancel(){
        $SearchBooking = $this->input->post('SearchBooking');
        $datepicker1 = $this->input->post('datepicker1');

         if(($datepicker1 != '')&&($datepicker1!= '0000-00-00')){
			
			$dateArray = explode("/",$datepicker1);
			$date= $dateArray[0];
			$mon= $dateArray[1];
			$year= $dateArray[2];			
			$datepicker1 = $year."-".$mon."-".$date;
		/*} else {
			$txtWhere2 = '';*/
         }
        $result_id = $this->Package_model->searchdatacancel($SearchBooking,$datepicker1);{?>
   <table id="table2" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">หมายเลขการจอง</th>
                                        <th style="text-align:center;">Check in</th>
                                        <th style="text-align:center;">ชื่อผู้จอง</th>
                                        <th style="text-align:center;">จำนวนเงิน</th>
                                        <th style="text-align:center;">สถานะ</th>
                                        <th style="text-align:center;">วันที่ทำการจอง</th>
                                        <th style="text-align:center;" width="7%">รายละเอียด</th>
                                         <th style="text-align:center;" width="7%">ยกเลิก</th>
                                        <th style="text-align:center;" width="7%">จัดเก็บ</th>
                                        <th style="text-align:center;" width="7%">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
 <?php 
    foreach ($result_id->result() AS $Data) {?>	
                                        <tr id="row<?php echo $Data->id ?>">
                                            <td><?php echo $Data->transfer_keygroup ?></td>
                                            <td><?php echo $Data->date_depart ?></td>
                                            <td><?php echo $Data->customer_name ?><br><?php echo $Data->customer_telephone ?></td>
                                            <td style="text-align:center;"><?php echo number_format($Data->total_price) ?></td>
                                            <td style="text-align:center;"><?php if ($Data->cf_status == 1){echo 'Pending';}else if($Data->cf_status == 2){echo 'Confrimed ';}else{echo 'Cancel';} ?></td>
                                            <td style="text-align:center;"><?php echo $this->Package_model->GetEngDateTime($Data->date_booking);?></td>
                                            <td style="text-align:center;" > <a href="#" onClick="windowOpener('770', '1000', 'windowName', 'email_book_package/<?php echo $Data->transfer_keygroup?>')"><button type="button" class="btn btn-xs btn-info btn-sm" data-toggle="button" style="width: 88.28px" >Detail</button></a></td>
                                             <td style="text-align:center;" > <a href="#" onClick="windowOpener('770', '1000', 'windowName', 'email_book_package/<?php echo $Data->transfer_keygroup?>')"><button <?php if ($Data->cf_status == 1){ ?> style="cursor: not-allowed;" <?php }?> type="button" class="btn btn-warning btn-sm" data-toggle="button" <?php if ($Data->cf_status == 1){ ?> disabled <?php   } ?> ><i class="fa fa-archive"></i></button></a></td>
                                           
                                             <td style="text-align:center;"><button <?php if ($Data->cf_status == 1){ ?> style="cursor: not-allowed;" <?php }?> type="button" class="btn btn-success btn-sm" onClick="save_data('<?php echo $Data->id ?>', ' tbl_package_booking')" <?php if ($Data->cf_status == 1){ ?> disabled <?php   } ?> ><i class="fa fa-archive"></i></button></td>
                                            <td style="text-align:center;"><button  <?php if ($Data->cf_status != 1){ ?> style="cursor: not-allowed;" <?php }?> type="button" class="btn btn-danger btn-sm" onClick="delete_data('<?php echo $Data->id ?>', 'tbl_package_booking')"<?php if ($Data->cf_status != 1){ ?> disabled <?php   } ?> ><i class="icon-trash"></i></button></td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                            </table>
  <?php }?>
                  <script type="text/javascript">
            $(document).ready(function () {
                 $('#table2').DataTable(

);
          });
          </script>
 <?php  }    //-------------------------------------------
        public function searchdata2(){
        $SearchBooking = $this->input->post('SearchBooking');
        $datepicker1 = $this->input->post('datepicker1');

         if(($datepicker1 != '')&&($datepicker1!= '0000-00-00')){
			
			$dateArray = explode("/",$datepicker1);
			$date= $dateArray[0];
			$mon= $dateArray[1];
			$year= $dateArray[2];			
			$datepicker1 = $year."-".$mon."-".$date;
		/*} else {
			$txtWhere2 = '';*/
         }
        $result_id = $this->Package_model->search2($SearchBooking,$datepicker1);{?>
   <table id="table2" class="table table-hover">
                                <thead>
                                    <tr>
                                      <th width="5%" style="text-align:center;">Select All <br><input type="checkbox" id="ckbCheckAll"></th>
                                        <th style="text-align:center;">หมายเลขการจอง</th>
                                        <th style="text-align:center;">วันที่เดินทาง</th>
                                        <th style="text-align:center;">ชื่อผู้จอง</th>
                                        <th style="text-align:center;">จำนวนเงิน</th>
                                        <th style="text-align:center;">สถานะ</th>
                                        <th style="text-align:center;">วันที่ทำการจอง</th>
                                        <th style="text-align:center;" width="7%">รายละเอียด</th>
                                        <th style="text-align:center;" width="7%">ยกเลิก</th>
                                        <th style="text-align:center;" width="7%">จัดเก็บ</th>
                                        <th style="text-align:center;" width="7%">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
 <?php $txt = '';
    foreach ($result_id->result() AS $Data) {
        if ($Data->cf_status == 1){$txt = 'Pending';}else if($Data->cf_status == 2){$txt ='Confrimed ';}else{$txt = 'Cancel';}?>	
                                        <tr id="row<?php echo $Data->booking_id ?>">
                                            <th style="text-align:center;"> <input type="checkbox" class="delete_checkbox" value="<?php echo $Data->id ?>" /></th>
                                            <td><?php echo $Data->transfer_keygroup ?></td>
                                            <td><?php echo $Data->date_depart ?></td>
                                            <td><?php echo $Data->cust_name ?><br><?php echo $Data->cust_telephone_num ?></td>
                                            <td style="text-align:center;"><?php echo number_format($Data->total_price) ?></td>
                                            <td style="text-align:center;"><?php echo $txt ?></td>
                                            <td style="text-align:center;"><?php echo $this->Package_model->GetEngDateTime($Data->date_booking);?></td>
                                            <td style="text-align:center;" > <a href="#" onClick="windowOpener('770', '1000', 'windowName', 'email_book_transport/<?php echo $Data->transfer_keygroup?>')"><button type="button" class="btn btn-xs btn-info btn-sm" data-toggle="button" style="width: 88.28px" >Detail</button></a></td>
                                              <td style="text-align:center;" > <a href="#" onClick="windowOpener('770', '1000', 'windowName', 'email_book_transport/<?php echo $Data->transfer_keygroup?>')"><button <?php if ($Data->cf_status == 1){ ?> style="cursor: not-allowed;" <?php }?> type="button" class="btn btn-warning btn-sm" data-toggle="button" <?php if ($Data->cf_status == 1){ ?> disabled <?php   } ?> ><i class="fa fa-archive"></i></button></a></td>
                                           
                                            <td style="text-align:center;"><button <?php if ($Data->cf_status == 1){ ?> style="cursor: not-allowed;" <?php }?> type="button" class="btn btn-success btn-sm" onClick="save_data('<?php echo $Data->id ?>', ' tbl_booking_title')" <?php if ($Data->cf_status == 1){ ?> disabled <?php   } ?> ><i class="fa fa-archive"></i></button></td>
                                            <td style="text-align:center;"><button <?php if ($Data->cf_status != 1){ ?> style="cursor: not-allowed;" <?php }?>  type="button" class="btn btn-danger btn-sm " onClick="delete_data('<?php echo $Data->id ?>', ' tbl_booking_title')" <?php if ($Data->cf_status != 1){ ?> disabled <?php   } ?>><i class="icon-trash"></i></button></td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                            </table>
          <button type="button" name="delete_all" id="delete_all" class="btn btn-danger btn-xs">Delete</button>
<button type="button" name="save_all" id="save_all" class="btn btn-success btn-xs">Archive</button>
  <?php }?>
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
          </script>
 <?php  }    //-------------------------------------------
        public function searchdataTransave(){
   
		$payment_status=$this->input->post('payment_status');
		$payment_type=$this->input->post('payment_type');
		$partner_id =$this->input->post('partner_id');
		$dateStart=$this->input->post('dateStart');
		$dateEnd=$this->input->post('dateEnd');
		$dataID=$this->input->post('dataID');
		
		$data['checkinData'] =$this->Package_model->searchdataTransave($payment_status,$payment_type,$partner_id,$dateStart,$dateEnd,$dataID);
		
		$data['booking_status']=$this->input->post('payment_status');

        $this->load->view('package/backend/bookingTransport_view_search',$data);
  }    //-------------------------------------------
        public function searchdataTrancommis(){
   
		$payment_status=$this->input->post('payment_status');
		$payment_type=$this->input->post('payment_type');
		$partner_id =$this->input->post('partner_id');
		$dateStart=$this->input->post('dateStart');
		$dateEnd=$this->input->post('dateEnd');
		$dataID=$this->input->post('dataID');
		
		$data['checkinData'] =$this->Package_model->searchdataTrancommis($payment_status,$payment_type,$partner_id,$dateStart,$dateEnd,$dataID);
		
		$data['booking_status']=$this->input->post('booking_status');

        $this->load->view('package/backend/bookingTransportcommis_view_search',$data);
  }    //-------------------------------------------
        public function searchdataTrancancel(){
        $booking_status=$this->input->post('booking_status');
		$payment_type=$this->input->post('payment_type');
		$partner_id =$this->input->post('partner_id');
		$dateStart=$this->input->post('dateStart');
		$dateEnd=$this->input->post('dateEnd');
		$dataID=$this->input->post('dataID');
		
		$data['checkinData'] =$this->Package_model->searchdataTrancancel($booking_status,$payment_type,$partner_id,$dateStart,$dateEnd,$dataID);
		
		$data['booking_status']=$this->input->post('booking_status');;

        $this->load->view('package/backend/bookingTransport_view_search',$data);
  }    //---------------------------------------------------------
 function action()
 {
  $this->load->library("excel");
  $object = new PHPExcel();

  $object->setActiveSheetIndex(0);

  $table_columns = array("Transfer keygroup", "Check in", "Customer name", "Customer telephone", "Total price","Date booking","Status");

  $column = 0;

  foreach($table_columns as $field)
  {
$object->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);
   $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
   $column++;
  }

  $employee_data = $this->Package_model->fetch_data();

  $excel_row = 2;

  foreach($employee_data as $row)
  {
      $cf = '';
      if($row->cf_status==1){$cf = 'Pending';}else if($row->cf_status==2){$cf='Confirm';}else{$cf='Cancel';}
   $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->transfer_keygroup);
   $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->date_depart);
   $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->customer_name);
   $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->customer_telephone);
   $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->total_price);
   $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->date_booking);
   $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $cf);
   $excel_row++;
  }
$today = date("d-m-Y");
  $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="Report Package Booking '.$today.'.xls"');
  $object_writer->save('php://output');
 }    //---------------------------------------------------------
 function action2()
 {
  $this->load->library("excel");
  $object = new PHPExcel();

  $object->setActiveSheetIndex(0);

  $table_columns = array("Transfer keygroup", "Check in", "Customer name", "Customer telephone", "Total price","Date booking","Status");

  $column = 0;

  foreach($table_columns as $field)
  {
$object->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);
   $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
   $column++;
  }

  $employee_data = $this->Package_model->fetch_data2();

  $excel_row = 2;

  foreach($employee_data as $row)
  {
      $cf = '';
      if($row->cf_status==1){$cf = 'Pending';}else if($row->cf_status==2){$cf='Confirm';}else{$cf='Cancel';}
   $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->transfer_keygroup);
   $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->date_depart);
   $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->customer_name);
   $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->customer_telephone);
   $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->total_price);
   $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->date_booking);
   $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $cf);
   $excel_row++;
  }
$today = date("d-m-Y");
  $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="Report Package Cancel '.$today.'.xls"');
  $object_writer->save('php://output');
 }    //---------------------------------------------------------
 function actionTran()
 {
  $this->load->library("excel");
  $object = new PHPExcel();

  $object->setActiveSheetIndex(0);

  $table_columns = array("หมายเลขการจอง", "ชื่อผู้จอง", "วันที่เดินทาง", "วันที่เดินทางกลับ","จำนวนเงิน", "สถานะ","วันที่ทำการจอง");

  $column = 0;

  foreach($table_columns as $field)
  {
$object->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);
   $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
   $column++;
  }

  $employee_data = $this->Package_model->fetch_datatran();

  $excel_row = 2;

  foreach($employee_data as $Data)
  {
      $totalDepartPrice = ($Data->NAdult*$Data->DAdultPrice)+($Data->NChild*$Data->DChildPrice);
        $totalReturnPrice = ($Data->NAdult*$Data->RAdultPrice)+($Data->NChild*$Data->RChildPrice);
        $totalAll=($totalDepartPrice+$totalReturnPrice);
      $cf = '';
      if($Data->booking_status=='1'){$cf = 'ยืนยันการจอง';}else if
          ($Data->booking_status==0){$cf='ไม่ยืนยันการจอง';}else if
          ($Data->booking_status==3){$cf='ยกเลิกการจอง';}else if
          ($Data->booking_status==2){$cf='ประวัติการจอง';}else {$cf='ประวัติลบการจอง';}
   $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $Data->booking_no);
   $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $Data->cust_name." ".$Data->cust_lastname);
   $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $Data->dateGo."".$Data->DepartTime);
   $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $Data->backDate."".$Data->ReturnDepartTime);
   $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, number_format($totalAll ,2));
   $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $cf);
   $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $Data->date_booking);
   $excel_row++;
  }
$today = date("d-m-Y");
  $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="Report Transport Booking '.$today.'.xls"');
  $object_writer->save('php://output');
 }    //---------------------------------------------------------
 function actionTran2()
 {
  $this->load->library("excel");
  $object = new PHPExcel();

  $object->setActiveSheetIndex(0);

  $table_columns = array("หมายเลขการจอง", "ชื่อผู้จอง", "วันที่เดินทาง", "วันที่เดินทางกลับ","จำนวนเงิน", "สถานะ","วันที่ทำการจอง");

  $column = 0;

  foreach($table_columns as $field)
  {
$object->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);
   $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
   $column++;
  }

  $employee_data = $this->Package_model->fetch_datatran2();

  $excel_row = 2;

  foreach($employee_data as $Data)
  {
      $totalDepartPrice = ($Data->NAdult*$Data->DAdultPrice)+($Data->NChild*$Data->DChildPrice);
        $totalReturnPrice = ($Data->NAdult*$Data->RAdultPrice)+($Data->NChild*$Data->RChildPrice);
        $totalAll=($totalDepartPrice+$totalReturnPrice);
      $cf = '';
      if($Data->booking_status=='1'){$cf = 'ยืนยันการจอง';}else if
          ($Data->booking_status==0){$cf='ไม่ยืนยันการจอง';}else if
          ($Data->booking_status==3){$cf='ยกเลิกการจอง';}else if
          ($Data->booking_status==2){$cf='ประวัติการจอง';}else {$cf='ประวัติลบการจอง';}
   $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $Data->booking_no);
   $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $Data->cust_name." ".$Data->cust_lastname);
   $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $Data->dateGo."".$Data->DepartTime);
   $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $Data->backDate."".$Data->ReturnDepartTime);
   $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, number_format($totalAll ,2));
   $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $cf);
   $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $Data->date_booking);
   $excel_row++;
  }
$today = date("d-m-Y");
  $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="Report Transport Booking '.$today.'.xls"');
  $object_writer->save('php://output');
 }    //---------------------------------------------------------
 function actionlandtran($cftatus=NULL)
 {
  $this->load->library("excel");
  $object = new PHPExcel();

  $object->setActiveSheetIndex(0);

  $table_columns = array("หมายเลขการจอง", "ชื่อผู้จอง", "จำนวนเงิน", "สถานะ","วันที่ทำการจอง");

  $column = 0;

  foreach($table_columns as $field)
  {
$object->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);
   $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
   $column++;
  }
 
  $employee_data = $this->Package_model->fetch_datalandtran($cftatus);

  $excel_row = 2;

  foreach($employee_data as $Data)
  {
 if($Data->cf_status =='1'){
     $cf = 'Confrimed';
 }else{
     $cf = 'Pending';
 }
   $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $Data->Booking_id);
   $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $Data->customer_name." ".$Data->customer_Lastname);
   $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, number_format($Data->total_price,2));
   $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $cf);
   $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $Data->date_booking);
   $excel_row++;
  }
$today = date("d-m-Y");
  $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="Report Land Transfer Booking '.$today.'.xls"');
  $object_writer->save('php://output');
 }    //---------------------------------------------------------
 function actioncharter($cftatus=NULL)
 {
  $this->load->library("excel");
  $object = new PHPExcel();

  $object->setActiveSheetIndex(0);

  $table_columns = array("หมายเลขการจอง", "ชื่อผู้จอง", "จำนวนเงิน", "สถานะ","วันที่ทำการจอง");

  $column = 0;

  foreach($table_columns as $field)
  {
$object->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);
   $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
   $column++;
  }
 
  $employee_data = $this->Package_model->fetch_datacharter($cftatus);

  $excel_row = 2;

  foreach($employee_data as $Data)
  {
 if($Data->cf_status =='1'){
     $cf = 'Confrimed';
 }else{
     $cf = 'Pending';
 }
   $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $Data->Booking_id);
   $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $Data->customer_name." ".$Data->customer_Lastname);
   $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, number_format($Data->total_price,2));
   $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $cf);
   $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $Data->date_booking);
   $excel_row++;
  }
$today = date("d-m-Y");
  $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="Report Charter Speed boat Booking '.$today.'.xls"');
  $object_writer->save('php://output');
 }    //---------------------------------------------------------
 function delete_all()
 {
  if($this->input->post('checkbox_value'))
  {
   $id = $this->input->post('checkbox_value');
   for($count = 0; $count < count($id); $count++)
   {
    $this->Package_model->delete($id[$count]);
   }
  }
 }    //----------------------------------
 function delete_alltransport()
 {
  if($this->input->post('checkbox_value'))
  {
   $id = $this->input->post('checkbox_value');
   for($count = 0; $count < count($id); $count++)
   {
    $this->Package_model->delete_alltransport($id[$count]);
   }
  }
 }    //-----------------------------------------
    public function Reportbooking() {
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/report_booking_view');
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/report_booking_view_script');
    }    //-------------------
    public function saveData() {
        $dataID = $this->input->post('dataID');
        $table = $this->input->post('table');
        $result = $this->Package_model->saveData($dataID, $table);
        echo $result;
    }    //-------------------
    public function cancelData() {
        $dataID = $this->input->post('dataID');
        $table = $this->input->post('table');
        $result = $this->Package_model->cancelData($dataID, $table);
        echo $result;
    }    //----------------------------------
 function save_all()
 {
  if($this->input->post('checkbox_value'))
  {
   $id = $this->input->post('checkbox_value');
   for($count = 0; $count < count($id); $count++)
   {
    $this->Package_model->save_all($id[$count]);
   }
  }
 }    //----------------------------------
 function save_allTransport()
 {
  if($this->input->post('checkbox_value'))
  {
   $id = $this->input->post('checkbox_value');
   for($count = 0; $count < count($id); $count++)
   {
    $this->Package_model->save_allTransport($id[$count]);
   }
  }
 }    //-----------------------------------------
    public function Reportcancel() {
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/report_cancel_view');
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/report_cancel_view_script');
    }    //-----------------------------------------
    public function email_book_package() {
        $this->load->view('package/backend/email_book_package');
    }    //-----------------------------------------
    public function email_book_transport() {
        $this->load->view('package/backend/email_book_transport');
    }    //----------------------------
    public function confrim_data() {
        $keygroup = $this->input->post('keygroup');
        $textareapdf = $this->input->post('textareapdf');
        $result_id = $this->Package_model->confrim_data($keygroup,$textareapdf);
        echo $result_id;
    }    //----------------------------
    public function confrim_data1() {
        $keygroup = $this->input->post('keygroup');
        $textareapdf = $this->input->post('textareapdf');
        $result_id = $this->Package_model->confrim_data1($keygroup,$textareapdf);
        if($result_id == 1){
        	$txt=''; $r='';			
                //echo '.................................'.$keygroup;
             $getbooking_title = $this->Package_model->getbooking_title($keygroup);
                        foreach ($getbooking_title->result() AS $getbooking_title2) { }
                        $adultstravel = $getbooking_title2->adult_traveller;
                        $childtravel = $getbooking_title2->child_traveller;
                        $totalpeople = $adultstravel+$childtravel;
             if ($getbooking_title2->cf_status == 1){ $txt='Pending';}else if($getbooking_title2->cf_status == 2){ $txt='Confrimed ';}else{ $txt='Cancel';}
              $route_id = $getbooking_title2->route_id;
          $list_route = $this->transport_model->listRoute($r,$route_id);
          foreach ($list_route->result() AS $list_route2) {}
          $list_placebegin = $this->Package_model->list_placeData($list_route2->begin_place_id);
                        foreach ($list_placebegin->result() AS $list_placebegin2) {}
           $list_placedes = $this->Package_model->list_placeData($list_route2->destination_place_id);
                        foreach ($list_placedes->result() AS $list_placedes2) {}
              $Routetype = $this->transport_model->get_routeType($route_id, $getbooking_title2->route_type_id, $r, 'yes', 'id');
foreach ($Routetype->result() as $Data){}
$dayofweek = date('l', strtotime($getbooking_title2->date_depart));
$times = $this->transport_model->get_timeDetail($r,$r,$r,$r,$getbooking_title2->time_id);	
						   //$numTime = $times->num_rows();
                                                   
						   //if($numTime >0){						   	
                                                                foreach($times->result() as $times2){}  
						   		$times1 = date('H:i', strtotime($times2->arrive_time.'+'.$Data->transfer_h_time.' hours'));	
						   		$times1 = date('H:i', strtotime($times1.'+'.$Data->transfer_m_time.' minutes'));
             $table = 'tbl_package_booking';
		$key_value1 = $this->Package_model->generateRandomString();	
		$key_value3 = $this->Package_model->generateRandomString();	
		$date1 = date("d");
		$key_value2 = $key_value1.$keygroup.'#'.$date1.$key_value3;		
		
		$from_email = 'wiboonsak.suw@gmail.com';
		$subject = "Booking Transport ใบแจ้งการจองเรือ";		
		//$to_email = $editor_data2->email;
		//$to_email = $emaildata;
		$to_email = $getbooking_title2->cust_email;
		$email_body = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Booking Package</title>
<style>
	body{
		margin: 15px 0px 0px;
		
	}
	tr td{
		font-family: tahoma, serif;
		font-size: 10pt;
		color: #56201D; 
	}
</style>
</head>
<body>      
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td height="120" bgcolor="#E7E7E7"><img src="'.base_url().'html/images/email/logo-trip.png" align="left" width="550" height="127" style="margin-top: -55px; padding-left: 15px;"></td>
      <td align="right" bgcolor="#E7E7E7"><img src="'.base_url().'html/images/email/promotion.png" width="167" height="58"  style="padding-right: 50px;" /></td>
    </tr>
    <tr>
      <td height="70" colspan="2" bgcolor="#E7E7E7"><table width="90%"  border="0" cellspacing="2" align="center" cellpadding="0" bgcolor="#FFFFFF">
        <tbody>
          <tr>
            <td width="19%" height="25" align="right"><strong>CUSTOMER NAME  :</strong></td>
            <td height="25" colspan="5" align="left">'.$getbooking_title2->cust_name.' '.$getbooking_title2->cust_lastname.'</td>
          </tr>
          <tr>
            <td height="25" align="right"><strong>TEL :</strong></td>
            <td width="19%" height="25" align="left">'.$getbooking_title2->cust_telephone_num.'</td>
            <td width="9%" height="25" align="left"><strong>EMAIL  :</strong></td>
            <td width="28%" height="25" align="left">'.$getbooking_title2->cust_email.'</td>
            <td width="10%" height="25" align="left"><strong>ID LINE :</strong></td>
            <td width="15%" height="25" align="left">'.$getbooking_title2->cust_line.'</td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td height="197" colspan="2" bgcolor="#E7E7E7">
       <table width="90%" align="center" border="0" cellspacing="4" cellpadding="0" bgcolor="#FFFFFF">
        <tbody>
          <tr>
            <td width="40%" height="25" align="right"><strong>BOOKING ID :</strong></td>
            <td width="62%" height="25" align="left">'.$keygroup.'</td>
          </tr>
          <tr>
            <td height="25" align="right"><strong>ROUTING :</strong></td>
            <td height="25" align="left">'.$list_placebegin2->place_name_en.'  to  '. $list_placedes2->place_name_en.'</td>
          </tr>
          <tr>
            <td width="40%" height="25" align="right"><strong>DEPARTING :</strong></td>
            <td height="25" align="left">'. $dayofweek.','. $this->Package_model->GetEngDateTime2($getbooking_title2->date_depart).'</td>
          </tr>
          <tr>  
            <td width="40%" height="25" align="right"><strong>TIME :</strong></td>
            <td height="25" align="left">'.$times2->arrive_time.' > '. $times1.'</td>
          </tr>
          <tr>
            <td width="40%" height="25" align="right"><strong>ADULT :</strong></td>
            <td height="25" align="left"> '.$adultstravel.'</td>
          </tr>
          <tr>
            <td width="40%" height="25" align="right"><strong>CHILDREN (3-10 YEARS) :</strong></td>
            <td height="25" align="left"> '. $childtravel.'</td>
          </tr>
          <tr>
            <td width="40%" height="25" align="right"><strong>PAYMENT TOTAL : </strong></td>
            <td height="25" align="left">'. number_format($getbooking_title2->total_price).' THB</td>
          </tr>
          <tr>
            <td width="40%" height="25" align="right"><strong>STATUS : </strong></td>
            <td height="25" align="left">'.$txt.'</td>
          </tr>
          
          <tr>
            <td colspan="2">
            	<!------ Trip Detail ------->         
       			<div style="margin:0 auto; padding: 10px; background-color: #FFFFFF; width: 84%">            
				 <h2 class="title-detail" style="color: #2f79b1;">Trip Details:</h2>
				 <!-- Accordion -->
					  <div class="panel-group no-margin" id="accordion">
								  <!-- Accordion 1 -->
								  <div class="panel">
									 <div id="collapseOne" class="panel-collapse collapse in" aria-labelledby="headingOne">';
                                                                         
                                                  $checkDetail = $this->transport_model->checkDetail($getbooking_title2->time_id);
                                                    $a =0; 
                                                 $priceArray = explode("/",$getbooking_title2->adult_price);
                                                 $priceArray2 = explode("/",$getbooking_title2->child_price);
 foreach ($checkDetail->result() as $checkDetail2){
     $checkroute = $this->Package_model->list_placeData($checkDetail2->begin_place_id);  foreach ($checkroute->result() as $checkroute2){}
     $checktransport = $this->Package_model->list_transportData($checkDetail2->transport_id);foreach ($checktransport->result() as $checktransport2){}
     $p1 = $priceArray[$a];
     $p2 = $priceArray2[$a];
     $totalprice = ($adultstravel*$p1)+($childtravel*$p2);
     $checkroute3 = $this->Package_model->list_placeData($checkDetail2->destination_place_id); foreach ($checkroute3->result() as $checkroute4){}
     $booking_textAdmin = $this->Package_model->list_booking_textAdmin($getbooking_title2->booking_id,$checkDetail2->transport_id);
$countbook = $booking_textAdmin->num_rows();
foreach ($booking_textAdmin->result() as $booking_textAdmin2){}
     $email_body = $email_body.'
										 <div class="panel-body" style="padding-top: 10px;">                                                   
											<div class="" style="background-color: #f1f1f1; border: 1px solid #E5E5E5">
												<div class="row" style="padding: 20px 0px 20px 25px;">
													<div class="col-sm-10">
														<div class="item">
															<span><i class="fa fa-map-marker"></i></span>
															<div><strong>'.$checkDetail2->arrive_time.' '.$checkroute2->place_name_en.'</strong></div>														</div>
														<div class="item">															<span><i class="fa fa-ship" aria-hidden="true"  style="color:#2f79b1;"></i></span>
															<div style="color:#2f79b1; padding-top: 20px;  font-size: 14pt"><strong>'.$checktransport2->transport_name_en.'</strong></div>';
     if($booking_textAdmin2->ticket_number !=''){
	 $email_body = $email_body.'														<p>
																<small><strong>Ticket number : </strong>'.$booking_textAdmin2->ticket_number.'<br></small>
															</p>';
     }	 $email_body = $email_body.'
<p>
																<small><strong>Note : </strong>'.$checkDetail2->note_checkin_en;
     if($booking_textAdmin2->note_ckeckin_en !=''){
	 $email_body = $email_body.'                                                                             <br>'.$booking_textAdmin2->note_ckeckin_en.'</small>';
         
    }	 $email_body = $email_body.'
															</p>
														
<p style="font-size: 10pt !important"><strong><?php echo $totalpeople?> Travellers = '.number_format($totalprice).' THB</strong> 			
																<ul style="font-size: 10pt; padding-bottom: 15px !important">
																	<li style="font-size: 10pt; font-weight: 100;">'.$adultstravel.' Adults x '.number_format($p1).' = '. number_format($adultstravel*$p1).' THB</li>
																	<li style="font-size: 10pt; font-weight: 100;">'. $childtravel.' Children x '. number_format($p2).' = '. number_format($childtravel*$p2).' THB</li>
																</ul>
															</p>															
														</div>

														<div class="item-end">
															<span><i class="fa fa-map-marker"></i></span>
															<div><strong>'. $checkDetail2->depart_time.' '.$checkroute4->place_name_en.'</strong></div>																	
														</div>
													</div>														
												</div>                                                    
											 </div>
										 </div>';
 $a++; } 
										 
									$email_body = $email_body.' </div>
									 <!-- End Accordion 1 -->                                          
								   </div>
								   <!-- Accordion -->
								</div>
				 <!------ Trip Detail ------->
			   </div>
            </td>
          </tr>
        </tbody>
      </table>
      
       
      </td>
    </tr>
    
    <tr>
    <td bgcolor="#B8B8B8"><img src="'.base_url().'html/images/email/address.png" align="left" width="287" height="97"/></td>
      <td align="right" bgcolor="#B8B8B8"><img src="'.base_url().'html/images/email/logo-header.png" style="padding-right: 50px;" /></td>
    </tr>
  </tbody>
</table>
</body>
</html>';		
		
		$this->email->from($from_email, 'Booking Transport Moonlight Travel'); 
        $this->email->to($to_email);
        $this->email->subject($subject); 
       	$this->email->message($email_body); 
//        //Send mail 
//		//$this->email->send();  
//		if($this->email->send()){ 
//                    $subject = "[For Admin] Booking Transport ใบแจ้งการจองเรือ";		
//                    $this->email->from($from_email, 'Booking Transport Moonlight Travel'); 
//        $this->email->to($from_email);
//        $this->email->subject($subject); 
//       	$this->email->message($email_body); 
        if($this->email->send()){ 
		   	$result2 = '1';		
        }	
          	$result = $result2;  
        //}				
    }
        echo $result;
    }    //----------------------------
    public function cancel_data() {
        $keygroup = $this->input->post('keygroup');
        $textareapdf = $this->input->post('textareapdf');

        $result_id = $this->Package_model->cancel_data($keygroup,$textareapdf);
        echo $result_id;
    }    //----------------------------
    public function cancel_data1() {
        $keygroup = $this->input->post('keygroup');
        $textareapdf = $this->input->post('textareapdf');
        $result_id = $this->Package_model->cancel_data1($keygroup,$textareapdf);
        echo $result_id;
    }
    //-----------
    public function insertnotecheckin() {
       //$ticket = $this->input->post('ticket');
        $countTicket = count($this->input->post('ticket'));
        //$Place = $this->input->post('Place');
        $booking_id = $this->input->post('booking_id');
        //$transport_id = $this->input->post('transport_id'); 
        if($countTicket >0){
            for($i=0; $i<$countTicket; $i++){
         $ticket = $this->input->post('ticket')[$i];
         $Place = $this->input->post('Place')[$i];
         $transport_id = $this->input->post('transport_id')[$i];
         $TicketBook = $this->input->post('TicketBook')[$i];
        
         if(($TicketBook =='')&&($ticket !='')&&($Place != '')){
         $result_id = $this->Package_model->insertnotecheckin($ticket,$Place,$booking_id,$transport_id,$TicketBook);
         }
         else if(($TicketBook !='')&&($ticket !='')&&($Place != '')){
         $result_id = $this->Package_model->insertnotecheckin($ticket,$Place,$booking_id,$transport_id,$TicketBook);
         }   
         else if(($TicketBook !='')&&($ticket =='')&&($Place == '')){
         $result_id = $this->Package_model->deletenotecheckin($TicketBook);
         }   
            
         }
        $result_id = 1;
        
            }
         echo $result_id;
    }

    //----- เริ่ม  transport 
      public function commissionadd($currentID=null) {
        $data['currentID'] = $currentID;
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/commissionadd',$data);
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/commissionadd_script');
    }    //------------------------------- 	
    	  public function addcommission() {
        $name = $this->input->post('name');
        $commis = $this->input->post('commis');
        $currentID = $this->input->post('currentID');
        $result_id = $this->Package_model->addcommission($currentID, $name,$commis);
        echo $result_id;
    }    //---------------------------
       public function loadCommis() {
        $commissionData = $this->Package_model->list_commissionData();
        ?>
        <form name="placeForm" id="placeForm">
            <table class="table table-bordered table-hover" id="table1">
                <thead>	
                    <tr style="background-color: #F2F2F2">
                        <th width="10" style="text-align:center">No</th>
                        <th width="200" >Name</th>
                        <th width="200" >Commission %</th>
                        <th width="100" nowrap="nowrap" style="text-align:center">edit </th>
                    </tr>
                </thead>	
                <tbody>	
        <?php $n = 1;
        foreach ($commissionData->result() as $Data) { ?>
                        <tr>
                            <td style="text-align:center"><?php echo $n ?></td>
                            <td>
                                <input type="text" id="name<?php echo $Data->id ?>" name="name" class="form-control form-control-sm" value="<?php echo $Data->Name ?>">
                                <input type="hidden" name="dataID" id="dataID<?php echo $Data->id ?>" value="<?php echo $Data->id ?>" >  
                            </td>
                            <td>
                                <input type="text" id="commis<?php echo $Data->id ?>" name="commis" class="form-control form-control-sm" value="<?php echo $Data->commission ?>">
                            </td>
                            <td style="text-align:center;" ><button type="button" class="btn btn-success btn-sm" onClick="updateThis('<?php echo $Data->id ?>')"><i class="icon-pencil"></i></button></td>
                            
                        </tr>
            <?php $n++;} ?>
                </tbody>
            </table> 
        </form>
        <script>
            $(document).ready(function () {
                $('#table1').DataTable({
                    searching: false,
                    ordering: false,
                    pageLength: 15,
                    lengthChange: false
                });
                ///////////////////////////////////////	

                $('[data-plugin="switchery"]').each(function (idx, obj) {
                    new Switchery($(this)[0], $(this).data());
                });
            })
        </script> 
        <?php
    }    //-------------------	
      public function updateThiscommis() {
        $currentID = $this->input->post('currentID');
        $name = $this->input->post('name');
        $commis = $this->input->post('commis');
        $result_id = $this->Package_model->updatecommis($currentID, $name,$commis);
        echo $result_id;
    }    //----------------------------
     function actionTran3()
 {
  $this->load->library("excel");
  $object = new PHPExcel();

  $object->setActiveSheetIndex(0);

  $table_columns = array("หมายเลขการจอง", "เที่ยวไป", "เที่ยวกลับ", "ชื่อผู้จอง","จำนวนเงิน", "คอมมิชชั่น","คงเหลือ","วันที่ทำการจอง");

  $column = 0;

  foreach($table_columns as $field)
  {
$object->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);
   $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
   $column++;
  }

  $employee_data = $this->Package_model->fetch_datatran();

  $excel_row = 2;

  foreach($employee_data as $Data)
  {
      $totalDepartPrice = ($Data->NAdult*$Data->DAdultPrice)+($Data->NChild*$Data->DChildPrice);
        $totalReturnPrice = ($Data->NAdult*$Data->RAdultPrice)+($Data->NChild*$Data->RChildPrice);
        $totalAll=($totalDepartPrice+$totalReturnPrice);
        $commission = ($totalAll*$Data->commission)/100;
        $balance = $totalAll-$commission;
      $cf = '';
      if($Data->booking_status=='1'){$cf = 'ยืนยันการจอง';}else if
          ($Data->booking_status==0){$cf='ไม่ยืนยันการจอง';}else if
          ($Data->booking_status==3){$cf='ยกเลิกการจอง';}else if
          ($Data->booking_status==2){$cf='ประวัติการจอง';}else {$cf='ประวัติลบการจอง';}
   $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $Data->booking_no);
   $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $Data->departName.''.$Data->dateGo.''.$Data->DepartTime);
   $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $Data->returnName.''.$Data->backDate.''.$Data->ReturnDepartTime);
   $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $Data->cust_name." ".$Data->cust_lastname);
   $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, number_format($totalAll ,2));
   $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, number_format($commission,2));
   $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, number_format($balance,2));
   $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $Data->date_booking);
   $excel_row++;
  }
$today = date("d-m-Y");
  $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="Report Transport Booking '.$today.'.xls"');
  $object_writer->save('php://output');
 }
 //-------------------------------------------------
     public function landTransfer_view() {
		$cfstatus='all';
		$cfstatusno1='2';
		$cfstatusno2='3';
		$booking_status='1';
		$dataID='all';
		$datebook='all';
		$SearchBooking='all';
		$data['checkinData'] =$this->transport_model->landbook_booking_list($booking_status,$dataID,$datebook,$SearchBooking,$cfstatusno1,$cfstatusno2,$cfstatus);
		
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/landTransfer_view',$data);
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/landTransfer_view_script');
    }
    //-------------------	
	 public function landTransfer_Search() { 
		$booking_status=$this->input->post('booking_status');
		$datebook=$this->input->post('datebook');
		$SearchBooking=$this->input->post('SearchBooking');
		$dataID=$this->input->post('dataID');
		$cfstatus=$this->input->post('cfstatus');
		$cfstatusno1=$this->input->post('cfstatusno1');
		$cfstatusno2=$this->input->post('cfstatusno2');
                $SearchBookingpart=$this->input->post('SearchBookingpart');
                if($SearchBookingpart==''){
                    $SearchBookingpart = 'all';
                }
		
		$data['checkinData'] =$this->transport_model->landbook_booking_list($booking_status,$dataID,$datebook,$SearchBooking,$cfstatusno1,$cfstatusno2,$cfstatus,$SearchBookingpart);
		
		$data['booking_status']=$this->input->post('booking_status');

        $this->load->view('package/backend/landtransfer_view_search',$data);
 
}
//-------------------   
	public function landtransferDetail(){
		$data['DataID'] = $this->input->post('DataID');
		$booking_status=$this->input->post('booking_status');
		$datebook = 'all';
		$SearchBooking = 'all';
		$cfstatus = 'all';
		$cfstatusno1='all';
		$cfstatusno2='all';
		
		$data['checkinData'] =$this->transport_model->landbook_booking_list($booking_status,$data['DataID'],$datebook,$SearchBooking,$cfstatusno1,$cfstatusno2,$cfstatus);
		
		$this->load->view('package/backend/landtransfer_view_detail',$data);
		
	}
   //-----------------------------------------
    public function updatecfstatus() {
        $dataID = $this->input->post('dataID');
        $cfstatus = $this->input->post('cfstatus');
        $result_id = $this->transport_model->updatecfstatus($dataID,$cfstatus);
        echo $result_id;
    }    //------------------------
    	//-------------------	
    public function Reportlandsferbooking() {
        $cfstatus='2';
		$cfstatusno1='all';
		$cfstatusno2='all';
		$booking_status='1';
		$dataID='all';
		$datebook='all';
		$SearchBooking='all';
		$data['checkinData'] =$this->transport_model->landbook_booking_list($booking_status,$dataID,$datebook,$SearchBooking,$cfstatusno1,$cfstatusno2,$cfstatus);
                $data['cfstatus'] = '2';
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/report_landtransfer_view',$data);
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/report_landtransfer_view_script');
    } 
    	//-------------------	
    public function ReportlandsferCancel() {
        $cfstatus='3';
		$cfstatusno1='all';
		$cfstatusno2='all';
		$booking_status='1';
		$dataID='all';
		$datebook='all';
                $SearchBooking='all';
		$data['checkinData'] =$this->transport_model->landbook_booking_list($booking_status,$dataID,$datebook,$SearchBooking,$cfstatusno1,$cfstatusno2,$cfstatus);
                $data['cfstatus'] = '3';
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/report_landtransfer_view',$data);
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/report_landtransfercancel_view_script');
    }
    //----------------------------------
     public function Boatadd($currentID=null) {
        $data['currentID'] = $currentID;
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/boat_add',$data);
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/boat_add_script');
    }    //------------------------------- 	
     public function loadboat() {
        $boatData = $this->Package_model->list_boatData();
        ?>
        <form name="placeForm" id="placeForm">
            <table class="table table-bordered table-hover" id="table1">
                <thead>	
                    <tr style="background-color: #F2F2F2">
                        <th width="10" style="text-align:center">No</th>
                        <th width="281" >Boat size</th>
                        <th width="100" nowrap="nowrap" style="text-align:center">edit </th>
                        <th width="100" nowrap="nowrap" style="text-align:center">delete</th>
                    </tr>
                </thead>	
                <tbody>	
        <?php $n = 1;
        foreach ($boatData->result() as $boatData) { ?>
                        <tr>
                            <td style="text-align:center"><?php echo $n ?></td>
                            <td>
                                <input type="text" id="name<?php echo $boatData->id ?>" name="name" class="form-control form-control-sm" value="<?php echo $boatData->boat_size ?>">
                                <input type="hidden" name="dataID" id="dataID<?php echo $boatData->id ?>" value="<?php echo $boatData->id ?>" >  
                            </td>
                            <td style="text-align:center;" ><button type="button" class="btn btn-success btn-sm" onClick="updateThis('<?php echo $boatData->id ?>')"><i class="icon-pencil"></i></button></td>
                            <td style="text-align:center;"><button type="button" class="btn btn-danger btn-sm" onClick="delete_data('<?php echo $boatData->id ?>', 'tbl_boatsize')"><i class="icon-trash"></i></button></td>
                        </tr>
            <?php $n++;} ?>
                </tbody>
            </table> 
        </form>
        <script>
            $(document).ready(function () {
                $('#table1').DataTable({
                    searching: false,
                    ordering: false,
                    pageLength: 15,
                    lengthChange: false
                });
                ///////////////////////////////////////	

                $('[data-plugin="switchery"]').each(function (idx, obj) {
                    new Switchery($(this)[0], $(this).data());
                });
            })
        </script> 
        <?php
    }    //-------------------	
    public function addboat() {
        $name = $this->input->post('name');
        $currentID = $this->input->post('currentID');
        $result_id = $this->Package_model->addboat($currentID, $name);
        echo $result_id;
    }    //--------------------------------	
     public function updateboat() {
        $currentID = $this->input->post('currentID');
        $name = $this->input->post('name');
        $result_id = $this->Package_model->updateboat($currentID, $name);
        echo $result_id;
    }    //----------------------------
     public function set_datastauts() {
        $dataID = $this->input->post('dataID');
        $check = $this->input->post('check');
        $table = $this->input->post('table');
        $result = $this->Package_model->datastauts($dataID, $check, $table);
        echo $result;
    }    //-------------------------------	
     //----------------------------------
     public function Boattripadd($currentID=null) {
        $data['currentID'] = $currentID;
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/boattrip_add',$data);
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/boattrip_add_script');
    }    //------------------------------- 	
     public function loadboattrip() {
        $boatData = $this->Package_model->list_boattripData();
        ?>
        <form name="placeForm" id="placeForm">
            <table class="table table-bordered table-hover" id="table1">
                <thead>	
                    <tr style="background-color: #F2F2F2">
                        <th width="10" style="text-align:center">No</th>
                        <th width="281" >Boat size</th>
                        <th width="100" nowrap="nowrap" style="text-align:center">edit </th>
                        <th width="100" nowrap="nowrap" style="text-align:center">delete</th>
                    </tr>
                </thead>	
                <tbody>	
        <?php $n = 1;
        foreach ($boatData->result() as $boatData) { ?>
                        <tr>
                            <td style="text-align:center"><?php echo $n ?></td>
                            <td>
                                <input type="text" id="name<?php echo $boatData->id ?>" name="name" class="form-control form-control-sm" value="<?php echo $boatData->boat_trip ?>">
                                <input type="hidden" name="dataID" id="dataID<?php echo $boatData->id ?>" value="<?php echo $boatData->id ?>" >  
                            </td>
                            <td style="text-align:center;" ><button type="button" class="btn btn-success btn-sm" onClick="updateThis('<?php echo $boatData->id ?>')"><i class="icon-pencil"></i></button></td>
                            <td style="text-align:center;"><button type="button" class="btn btn-danger btn-sm" onClick="delete_data('<?php echo $boatData->id ?>', 'tbl_boat_trip')"><i class="icon-trash"></i></button></td>
                        </tr>
            <?php $n++;} ?>
                </tbody>
            </table> 
        </form>
        <script>
            $(document).ready(function () {
                $('#table1').DataTable({
                    searching: false,
                    ordering: false,
                    pageLength: 15,
                    lengthChange: false
                });
                ///////////////////////////////////////	

                $('[data-plugin="switchery"]').each(function (idx, obj) {
                    new Switchery($(this)[0], $(this).data());
                });
            })
        </script> 
        <?php
    }    //-------------------	
    public function addboattrip() {
        $name = $this->input->post('name');
        $currentID = $this->input->post('currentID');
        $result_id = $this->Package_model->addboattrip($currentID, $name);
        echo $result_id;
    }    //--------------------------------	
     public function updateboattrip() {
        $currentID = $this->input->post('currentID');
        $name = $this->input->post('name');
        $result_id = $this->Package_model->updateboattrip($currentID, $name);
        echo $result_id;
    }    //----------------------------
      	//-------------------	
    public function Reportcharterbooking() {
        $cfstatus='2';
		$cfstatusno1='all';
		$cfstatusno2='all';
		$booking_status='1';
		$dataID='all';
		$datebook='all';
		$SearchBooking='all';
		$data['checkinData'] =$this->transport_model->charter_booking_list($booking_status,$dataID,$datebook,$SearchBooking,$cfstatusno1,$cfstatusno2,$cfstatus);
                $data['cfstatus'] = '2';
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/report_charterboat_view',$data);
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/report_charterboat_view_script');
    } 
    	//-------------------	
    public function ReportcharterCancel() {
        $cfstatus='3';
		$cfstatusno1='all';
		$cfstatusno2='all';
		$booking_status='1';
		$dataID='all';
		$datebook='all';
                $SearchBooking='all';
		$data['checkinData'] =$this->transport_model->charter_booking_list($booking_status,$dataID,$datebook,$SearchBooking,$cfstatusno1,$cfstatusno2,$cfstatus);
                $data['cfstatus'] = '3';
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/report_charterboat_view',$data);
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/report_charterboatcancal_view_script');
    }
    //-------------------------------------------------
     public function Charterboat_view() {
		$cfstatus='all';
		$cfstatusno1='2';
		$cfstatusno2='3';
		$booking_status='1';
		$dataID='all';
		$datebook='all';
		$SearchBooking='all';
		$data['checkinData'] =$this->transport_model->charter_booking_list($booking_status,$dataID,$datebook,$SearchBooking,$cfstatusno1,$cfstatusno2,$cfstatus);
		
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/charterboat_view',$data);
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/charterboat_view_script');
    }
    //-------------------	
	 public function Charterboat_Search() { 
		$booking_status=$this->input->post('booking_status');
		$datebook=$this->input->post('datebook');
		$SearchBooking=$this->input->post('SearchBooking');
		$dataID=$this->input->post('dataID');
		$cfstatus=$this->input->post('cfstatus');
		$cfstatusno1=$this->input->post('cfstatusno1');
		$cfstatusno2=$this->input->post('cfstatusno2');
                $SearchBookingpart=$this->input->post('SearchBookingpart');
                if($SearchBookingpart==''){
                    $SearchBookingpart = 'all';
                }
		
		$data['checkinData'] =$this->transport_model->charter_booking_list($booking_status,$dataID,$datebook,$SearchBooking,$cfstatusno1,$cfstatusno2,$cfstatus,$SearchBookingpart);
		
		$data['booking_status']=$this->input->post('booking_status');

        $this->load->view('package/backend/charterboat_view_search',$data);
 
}
//-------------------   
	public function CharterboatDetail(){
		$data['DataID'] = $this->input->post('DataID');
		$booking_status=$this->input->post('booking_status');
		$datebook = 'all';
		$SearchBooking = 'all';
		$cfstatus = 'all';
		$cfstatusno1='all';
		$cfstatusno2='all';
		
		$data['checkinData'] =$this->transport_model->charter_booking_list($booking_status,$data['DataID'],$datebook,$SearchBooking,$cfstatusno1,$cfstatusno2,$cfstatus);
		
		$this->load->view('package/backend/charterboat_view_detail',$data);
		
	}
        //-----------------------------------------
    public function updatecfstatusch() {
        $dataID = $this->input->post('dataID');
        $cfstatus = $this->input->post('cfstatus');
        $result_id = $this->transport_model->updatecfstatusch($dataID,$cfstatus);
        echo $result_id;
    }  
     public function deleteland() {
        $dataID = $this->input->post('dataID');
        $result = $this->transport_model->deleteland($dataID);
        echo $result;
    }    //-------------------
     public function deletecharter() {
        $dataID = $this->input->post('dataID');
        $result = $this->transport_model->deletecharter($dataID);
        echo $result;
    }    //-------------------
     public function Transport_Add($currentID=null) {
        $data['currentID'] = $currentID;
        $this->load->view('package/backend/header');
        $this->load->view('package/backend/transportforland',$data);
        $this->load->view('package/backend/footer');
        $this->load->view('package/backend/transportforland_script');
    }    //------------------------------- 	
     public function loadTransport() {
        $transferData = $this->Package_model->list_transferData();
        ?>
        <form name="placeForm" id="placeForm">
            <table class="table table-bordered table-hover" id="table1">
                <thead>	
                    <tr style="background-color: #F2F2F2">
                        <th width="10" style="text-align:center">No</th>
                        <th width="281" >Transport</th>
                        <th width="100" nowrap="nowrap" style="text-align:center">edit </th>
                        <th width="100" nowrap="nowrap" style="text-align:center">delete</th>
                    </tr>
                </thead>	
                <tbody>	
        <?php $n = 1;
        foreach ($transferData->result() as $transferData2) { ?>
                        <tr>
                            <td style="text-align:center"><?php echo $n ?></td>
                            <td>
                                <input type="text" id="name<?php echo $transferData2->id ?>" name="name" class="form-control form-control-sm" value="<?php echo $transferData2->transport_name ?>">
                                <input type="hidden" name="dataID" id="dataID<?php echo $transferData2->id ?>" value="<?php echo $transferData2->id ?>" >  
                            </td>
                            <td style="text-align:center;" ><button type="button" class="btn btn-success btn-sm" onClick="updateThis('<?php echo $transferData2->id ?>')"><i class="icon-pencil"></i></button></td>
                            <td style="text-align:center;"><button type="button" class="btn btn-danger btn-sm" onClick="delete_data('<?php echo $transferData2->id ?>', 'tbl_transportforland')"><i class="icon-trash"></i></button></td>
                        </tr>
            <?php $n++;} ?>
                </tbody>
            </table> 
        </form>
        <script>
            $(document).ready(function () {
                $('#table1').DataTable({
                    searching: false,
                    ordering: false,
                    pageLength: 15,
                    lengthChange: false
                });
                ///////////////////////////////////////	

                $('[data-plugin="switchery"]').each(function (idx, obj) {
                    new Switchery($(this)[0], $(this).data());
                });
            })
        </script> 
        <?php
    }    //-------------------	
    public function addtransfer() {
        $name = $this->input->post('name');
        $currentID = $this->input->post('currentID');
        $result_id = $this->Package_model->addtransfer($currentID, $name);
        echo $result_id;
    }    //--------------------------------
      public function updatetransfer() {
        $currentID = $this->input->post('currentID');
        $name = $this->input->post('name');
        $result_id = $this->Package_model->updatetransfer($currentID, $name);
        echo $result_id;
    }    //----------------------------
     public function deletelandchart() {
        $dataID = $this->input->post('dataID');
        $table = $this->input->post('table');
        $result = $this->Package_model->deletelandchart($dataID, $table);
        echo $result;
    }    //-------------------
}

