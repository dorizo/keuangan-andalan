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

    }
?>