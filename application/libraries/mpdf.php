<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."third_party/mpdf/src/mpdf.php";

class MY_mpdf extends mPDF {

public function __construct()

{

parent::__construct();

}

}
