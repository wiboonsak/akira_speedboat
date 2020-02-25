<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class travelCheckout extends CI_Controller {
    function __construct() {
        parent::__construct(); 
        $this->load->model('Package_model');
        $this->load->model('transport_model');
        $this->load->model('Partner_api_model');
    }
	//--------------------------------
	public function index(){
		if($this->session->userdata('booking_no')==''){
			redirect(base_url(), 'refresh');
		}else{
			 $booking_no = $this->session->userdata('booking_no');
			 $data['bookingDetail'] = $this->transport_model->getBookingDetail($booking_no);
			 $data['bookingDetail'] = $this->transport_model->getBookingDetail($booking_no);
			 $this->load->view('package/fontend/travelcheckoutpage' , $data);
		}
	}
	
	
	
	
}//end class