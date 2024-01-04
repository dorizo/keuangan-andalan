<?php
class Witel_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
            $this->db->where("deleteAt is NULL");
            $db = $this->db->get("witel");
            return $db->result_array();
        }

        public function getsingle($id){
            $this->db->where("deleteAt is NULL");
            $this->db->where("witel_code" , $id);
            $db = $this->db->get("witel");
            return $db->row();
        }
        public function getsinglereport($id){
            $this->db->where("deleteAt is NULL");
            $this->db->where("witel_id" , $id);
            $db = $this->db->get("witel");
            return $db->row();
        }

        public function role_witel($userCode){
            $this->db->where("userCode" , $userCode);
           $db =  $this->db->get("role_witel");
            return $db->result();

        }
        
    }

?>