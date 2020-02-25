<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Export_model extends CI_Model {
    // get employee list
    public function employeeList() {
        $this->db->select(array('e.id', 'e.transfer_keygroup', 'e.date_depart', 'e.customer_name', 'e.customer_telephone', 'e.date_booking','e.total_price'));
        $this->db->from('tbl_package_booking as e');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>