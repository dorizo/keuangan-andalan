<?php
class Biayalain_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
            $db = $this->db->get("biayalain");
            return $db->result_array();
        }
        public function viewSinggle($kode){
            $this->db->where("biayalainCode" , $kode);
            $db = $this->db->get("biayalain");
            return $db->row();
        }
        public function submitedit(){
            $this->db->where("biayalainCode", $this->input->post("biayalainCode"));
			$p = $this->input->post();
            $this->db->update("biayalain" , $p);
        }
        
        public function delete($i){
            $this->db->where("biayalainCode",$i);
            $this->db->delete("biayalain");
        }
        public function submitadd(){
            
			$p = $this->input->post();
            $p["biayalain"] =  str_replace(",", "",$this->input->post("biayalain"));
            $this->db->insert("biayalain" , $p);
            $last_id = $this->db->insert_id();
            return $last_id; 
        }

       
}