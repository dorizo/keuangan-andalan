<?php
class akunbank_kas_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
            $db = $this->db->get("akunbank_kas");
            return $db->result_array();
        }
        
        public function sumproject($id){
            $this->db->select_sum('transaksiJumlah');
            $this->db->where("project_id" , $id);
            $db = $this->db->get("akunbank_kas");
            return $db->row();
        }
        public function viewsingle($kode){
            $this->db->where("akunbank_kasCode" , $kode);
            $db = $this->db->get("akunbank_kas");
            return $db->row();
        }
        public function submitedit(){
            $this->db->where("akunbank_kasCode", $this->input->post("akunbank_kasCode"));
            $this->db->update("akunbank_kas" , $this->input->post());
        }
        
        public function delete($i){
            $this->db->where("akunbank_kasCode",$i);
            $this->db->delete("akunbank_kas");
        }
        public function submitadd($add){
            
            $this->db->trans_begin();
            $p =  $this->input->post();
            $julahtransaksi = str_replace(",", "",$this->input->post("transaksiJumlah"));
            $p["transaksiJumlah"] =  str_replace(",", "",$this->input->post("transaksiJumlah"));
            $p["upload_file"] =  $add;
            $this->db->insert("akunbank_kas" , $p);
            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
            }
            else
            {
                    $this->db->trans_commit();
            }
        }

       
}