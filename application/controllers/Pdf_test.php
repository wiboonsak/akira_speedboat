<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf_test extends CI_Controller {
    function __construct() {
        parent::__construct(); 
        $this->load->model('Package_model');
        $this->load->model('transport_model');
        $this->load->model('Partner_api_model');
    }
    //-------------------	
    public function index() {
		echo "hahaha, please go back index :)";
    }
	//-------------------
	public function TestCratePDF($FileNo=NULL){
		
		$this->load->library('Pdf');
		
	}
	
}