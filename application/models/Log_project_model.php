<?php
class Log_project_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function getlogproject($a){
            $this->db->where("log_project.project_id", $a);
            $this->db->join("project" , "project.project_id=log_project.project_id");
            $this->db->order_by("log_date","desc");
            $db = $this->db->get("log_project");
            return $db->result_array();
        }
        public function view($a=null){
                if($this->input->get("awal")){
                        $this->db->where('log_date BETWEEN "'. date('Y-m-d', strtotime($this->input->get("awal"))). '" and "'. date('Y-m-d', strtotime($this->input->get("akhir"))).'"');
                }
                $this->db->join("project" , "project.project_id=log_project.project_id");
                $this->db->order_by("log_date","desc");
                $this->db->limit(10000);
                $db = $this->db->get("log_project");
                return $db->result_array();
            }
}