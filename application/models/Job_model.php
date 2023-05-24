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
        public function getsingle($id){
                $this->db->order_by("job_day" , "ASC");
                $this->db->where("job_id" , $id);
                $db = $this->db->get("job");
            return $db->row();
        }

        public function viewPM(){
                $this->db->order_by("job_day" , "asc");
                $this->db->where("job_name != 'PAID'");
                $db = $this->db->get("job");
            return $db->result_array();
        }
        
        public function view_after($key){
                $this->db->where("job_day >= $key");
                $this->db->order_by("job_day" , "ASC");
                $db = $this->db->get("job");
            return $db->result_array();
        }
       
}