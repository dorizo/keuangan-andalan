<?php
class Absensi_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
                // $this->db->where("email" , $this->input->post("username"));
                $this->db->join("karyawan" , "karyawanCode=mappingCode");
                $db = $this->db->get("absen");
                 return $db->result_array();
        }
    }
    ?>