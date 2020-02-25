<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partnercontrol extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 
	 */
	function __construct() {
       parent::__construct();
	   $this->load->model('Package_model');  
	   $this->load->model('Partner_api_model');  
	   $this->load->model('transport_model');
	   $this->load->model('package_model');
		
		if($this->session->userdata('user_id')){     
		 	}else{
    		 	redirect(base_url().'login', 'refresh');
		 	}	
		 
    }
	//---------------------------
	public function index()
	{
		redirect(base_url().'Partnercontrol/spc', 'refresh');
		//$this->load->view('package/backend/header');
        //$this->load->view('package/spc/partner_index');
        //$this->load->view('package/backend/footer');
        //$this->load->view('package/spc/partner_script');
	}
    //--------------------------
	public function spc(){
	  $rout_active='';
	  $routeID='';
	  $partnerID='2';
	  $data['listRoute'] = $this->Partner_api_model->spc_list_Route($rout_active,$routeID,$partnerID);	
		
	  $this->load->view('package/backend/header');
	  $this->load->view('transport/spc/spcmainpage', $data);
	  $this->load->view('transport/backend/footer');
	  $this->load->view('transport/spc/spcmainpage_script');
	}
	//-------------------------
	public function spc_RouteManage(){ 
		$rout_active='';
		$routeID='';
		$partnerID='2';
		$data['listRoute'] = $this->Partner_api_model->spc_list_Route($rout_active,$routeID,$partnerID);
		$this->load->view('transport/spc/spc_routeList_view' , $data);		
	}
	
	//------------------------- // http://dev.spcthailand.com/api/api_route_list.php?access_token=f3ef9a0aa89a5100b6657b35bfd46058&route_id access_token location_Id
	public function spc_getLocation(){
		$access_token=$this->input->post('access_token');
		$location_Id =$this->input->post('location_Id ');
		$act =$this->input->post('act ');
		
		//if($access_token==''){
	    $url='';
		$access_token ='f3ef9a0aa89a5100b6657b35bfd46058';
		//}
		
		if($location_Id ==''){
			$location_Id  ='';
		}
		
		//	https://www.spcthailand.com/api/api_location_list.php?access_token=f3ef9a0aa89a5100b6657b35bfd46058&location_Id
		//$site = "http://dev.spcthailand.com/api/api_location_list.php?access_token=".$access_token."&location_Id=".$location_Id ." ";
		//$site = "http://dev.spcthailand.com/api/api_location_list.php?access_token=".$access_token."&location_Id=".$location_Id;
		$site = "https://www.spcthailand.com/api/api_location_list.php?access_token=f3ef9a0aa89a5100b6657b35bfd46058";
		$data['getLocationList'] =  file_get_contents($site);
		//----auto import-------------
		$partnerID='2'; //  2 spc
		$data['resultLocation'] = $this->Partner_api_model->autoImportLocation($data['getLocationList'],$partnerID);
		//----------------------------
		
		//echo $data['getLocationList'];
		$this->load->view('transport/spc/spc_getlocation_view',$data);
		
	}
	//-------------------------
	public function spc_getRoute(){
		
		$access_token=$this->input->post('access_token');
		$route_id =$this->input->post('route_id');
		$act =$this->input->post('act');
		
		if($access_token==''){
			$access_token ='f3ef9a0aa89a5100b6657b35bfd46058';
		}
		
		if($route_id==''){
			$route_id ='';
		}
		
		 https://www.spcthailand.com/api/api_location_list.php?access_token=f3ef9a0aa89a5100b6657b35bfd46058&location_Id
		//$site = "http://dev.spcthailand.com/api/api_route_list.php?access_token=".$access_token."&route_id=".$route_id ." ";
		$site = "https://www.spcthailand.com/api/api_route_list.php?access_token=f3ef9a0aa89a5100b6657b35bfd46058";
		$data['getRoute'] =  file_get_contents($site);
		
		//echo $data['getLocationList'];
		$this->load->view('transport/spc/spc_getroute_view',$data);
		
	}
	//-------------------------
	function spc_import_route(){
		$routeValue = $this->input->post('routeValue');
		//print_r($routeValue);
		
		/*$routeValue = json_decode($routeValue);
		echo   '\r \n route_id->'.$routeValue->route_id;                 // tbl_route_data.partner_route_id
		echo   '\r \n route_name->'. $routeValue->route_name;               // tbl_route_data.route_name_th
		echo    '\r \n location_id_from->'.$routeValue->location_id_from;         // tbl_route_data.begin_place_id    
		echo    '\r \n location_id_to->'.$routeValue->location_id_to;           // tbl_route_data.destination_place_id 
		echo    '\r \n travel_by->'.$routeValue->travel_by;                // tbl_route_data.partner_travel_by 
		echo    '\r \n type->'.$routeValue->type;        
		
		*/
		$resultImport = $this->Partner_api_model->spc_import_route($routeValue);
		
		echo $resultImport;
		//print_r($resultImport);

	}
	//-------------------------
	  public function spc_set_ShowOnWeb() {
        $dataID = $this->input->post('dataID');
        $check = $this->input->post('check');
        $table = $this->input->post('table');
        $result = $this->Partner_api_model->spcShowOnWeb($dataID, $check, $table);
        echo $result;
    }
	//-------------------------
	public function spc_deleteData(){  
	
		$dataID = $this->input->post('dataID');				
		$table = $this->input->post('table');				
		$Result = $this->Partner_api_model->spc_deleteRoute($dataID,$table);
		echo $Result;	
	}
	//-------------------------
}