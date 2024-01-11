<?php
class Package_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
                // $this->db->where("email" , $this->input->post("username"));
                $this->db->where("deleteAt is NULL");
                $db = $this->db->get("package");
                 return $db->result_array();
        }
        public function viewSinggle($role){
            // $this->db->where("email" , $this->input->post("username"));
            // $this->db->where("password" , md5($this->input->post("password")));
            $this->db->where("package_id" , $role);
            $db = $this->db->get("package");
             return $db->row();
        }
        public function submitadd(){
                $param = $this->input->post();
                // $param["password"] = password_hash($this->input->post("password") , PASSWORD_DEFAULT);
                $this->db->insert("package" , $param);
        }
        public function submitedit(){
                $param = $this->input->post();
                $this->db->where("package_id" , $this->input->post("package_id"));
                $this->db->update("package" , $param);
        }
        public function delete($id){
                $this->db->where("package_id" , $id);
                $this->db->update("package" , array("deleteAt" => date("Y-m-d")));
        }
      

}