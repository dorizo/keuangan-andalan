<?php
class Kategori_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function parent(){
                $this->db->order_by("parentcatCode" , "desc");
                $db = $this->db->get("parent_cat");
                return $db->result_array();
        }
        public function singleparent($id){
            $this->db->where("parentcatCode" , $id);
            $db = $this->db->get("parent_cat");
            return $db->row();
        }
    
    public function editsimpanparent(){
        $this->db->where("parentcatCode" , $this->input->post("parentcatCode"));
        $this->db->update("parent_cat" , $this->input->post());
  }
        public function simpanparent(){
              $db = $this->db->insert("parent_cat" , $this->input->post());
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