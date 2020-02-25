<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller {

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
		 
    }
	//---------------------------
	public function index()
	{
		
		//$this->load->view('control/control_header');
		$data['Error']=0;
		$this->load->view('package/backend/login_body',$data);
		//$this->load->view('control/control_footer');
		//$this->load->view('welcome_message');
	}
	//--------------------------
	 public function gologin(){
		$username=trim($this->input->post('Username'));
		$password=trim($this->input->post('password'));
		$result = $this->Package_model->checklogin($username,$password);
		if($result==1){
			 redirect(base_url('PackageCMS'), 'refresh');
		}else if($result==0){
			$data['Error']=1;
			$this->load->view('package/backend/login_body', $data);
		}
	}
}