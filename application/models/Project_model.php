<?php
class Project_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
        $this->db->join("project_cat" , "project.cat_id=project_cat.cat_id");
        $db = $this->db->get("project");
        return $db->result_array();
        }

        public function viewSinggle($a){
                
        $this->db->where("project_id", $a);
        $this->db->join("project_cat" , "project.cat_id=project_cat.cat_id");
        $db = $this->db->get("project");
        return $db->row();
        }

        public function edit(){
              $this->db->where("project_id", $this->input->post("project_id"));
              $p = $this->input->post();
              $p["nilai_project"] = str_replace(",", "",$this->input->post("nilai_project"));
              $p["nilai_boq"] = str_replace(",", "", $this->input->post("nilai_boq"));
              $this->db->update("project" , $p);
        }
}