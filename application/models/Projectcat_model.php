<?php
class Projectcat_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
        $db = $this->db->get("project_cat");
        return $db->result_array();
        }
        public function getsingle($id){
                // $this->db->order_by("cat_id" , "ASC");
                $this->db->where("cat_id" , $id);
                $db = $this->db->get("project_cat");
            return $db->row();
        }

    }
?>