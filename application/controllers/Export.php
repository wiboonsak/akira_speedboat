<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Export extends CI_Controller {
	// construct
    public function __construct() {
        parent::__construct();
		// load model
        $this->load->model('Export_model', 'export');
    }    
	 // export xlsx|xls file
    public function index() {
        $data['page'] = 'export-excel';
        $data['title'] = 'Export Excel data | TechArise';
        $data['employeeInfo'] = $this->export->employeeList();
		// load view file for output
        $this->load->view('package/backend/export', $data);
    }
	// create xlsx
    public function createXLS() {
		// create file name
        $fileName = 'data-'.time().'.xlsx';  
		// load excel library
        $this->load->library('excel');
        $empInfo = $this->export->employeeList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'transfer_keygroup');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Check in');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Customer name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Customer telephone');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Date booking');       
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Total price');       
        // set Row
        $rowCount = 2;
        foreach ($empInfo as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['transfer_keygroup']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['date_depart']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['customer_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['customer_telephone']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['date_booking']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['total_price']);
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save(ROOT_UPLOAD_IMPORT_PATH.$fileName);
		// download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(HTTP_UPLOAD_IMPORT_PATH.$fileName);        
    }
    
}
?>