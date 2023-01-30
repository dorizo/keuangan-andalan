<?php
class Report_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
           return $this->db->query("SELECT count(*) as Count , sum(nilai_project) as nilai ,project_status FROM project GROUP BY project_status")->result_array();
        }
    }
    ?>