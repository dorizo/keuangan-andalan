<?php
class Job_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
                $this->db->order_by("job_day" , "ASC");
                $db = $this->db->get("job");
            return $db->result_array();
        }

        public function viewPM(){
                $this->db->order_by("job_day" , "asc");
                $this->db->where("job_name != 'PAID'");
                $db = $this->db->get("job");
            return $db->result_array();
        }
       
}