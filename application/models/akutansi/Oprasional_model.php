<?php
class Oprasional_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
                // $this->db->where("email" , $this->input->post("username"));
                // $this->db->where("a.deleteAt is NULL");
                $this->db->join("akutansi_akun b" , "b.kode_akun=a.kode_akun");
                $this->db->join("witel c" , "c.witel_id=a.witel_id");
                $this->db->join("sto d" , "d.stoCode=a.stoCode");
                $this->db->join("pekerjaan f" , "f.pekerjaanCode=a.pekerjaanCode");
                $this->db->order_by("ID" , "DESC");
                $db = $this->db->get("oprasional a");

                 return $db->result_array();
        }
        public function viewSinggle($role){
            // $this->db->where("email" , $this->input->post("username"));
            // $this->db->where("password" , md5($this->input->post("password")));
            $this->db->where("oprasionalCode" , $role);
            $db = $this->db->get("oprasional");
             return $db->row();
        }
        public function submitadd(){
                $param = $this->input->post();
                // $param["password"] = password_hash($this->input->post("password") , PASSWORD_DEFAULT);
                $this->db->insert("oprasional" , $param);
        }
        public function submitedit(){
                $param = $this->input->post();
                $this->db->where("oprasionalCode" , $this->input->post("oprasionalCode"));
                $this->db->update("oprasional" , $param);
        }
        public function delete($id){
                $this->db->where("oprasionalCode" , $id);
                $this->db->update("oprasional" , array("deleteAt" => date("Y-m-d")));
        }
        public function detail($id){
            $this->db->select('*');
            $this->db->from('role as a');
            $this->db->join('role_permission as b', 'a.oprasionalCode = b.oprasionalCode');
            $this->db->join('permission as c', 'b.permissionCode= c.permissionCode');
            $this->db->where('a.oprasionalCode =', $id);
            $this->db->where('b.deleteAt IS NULL', NULL, FALSE);
            $this->db->order_by('c.permission','ASC');
            return $query = $this->db->get();

        }

}