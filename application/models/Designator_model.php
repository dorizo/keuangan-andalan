<?php
class Designator_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
                // $this->db->where("email" , $this->input->post("username"));
                $this->db->where("deleteAt is NULL");
                $db = $this->db->get("designator");
                 return $db->result_array();
        }
        public function viewSinggle($role){
            // $this->db->where("email" , $this->input->post("username"));
            // $this->db->where("password" , md5($this->input->post("password")));
            $this->db->where("designator_id" , $role);
            $db = $this->db->get("designator");
             return $db->row();
        }
        public function submitadd(){
                $param = $this->input->post();
                // $param["password"] = password_hash($this->input->post("password") , PASSWORD_DEFAULT);
                $this->db->insert("designator" , $param);
        }
        
        public function submiteditpeckage(){
                $p = $this->input->post();
                
		$p["material_price"] = str_replace(",", "",$this->input->post("material_price"));
		$p["service_price"] = str_replace(",", "", $this->input->post("service_price"));
                $this->db->where("designator_package_id" , $this->input->post("designator_package_id"));
                $this->db->update("designator_package" , $p);
        }
        public function submitaddpeckage(){
                
			$p=$this->input->post();
			$p["material_price"] = str_replace(",", "",$this->input->post("material_price"));
			$p["service_price"] = str_replace(",", "", $this->input->post("service_price"));
                        $this->db->insert("designator_package" , $p);
        }
        public function submitedit(){
                $param = $this->input->post();
                $this->db->where("designator_id" , $this->input->post("designator_id"));
                $this->db->update("designator" , $param);
        }
        public function detail($id){
                $this->db->where("designator_id" , $id);
                $this->db->join("package" , "designator_package.package_id=package.package_id");
                $db = $this->db->get("designator_package");
                return $db->result_array();
        }
      

}