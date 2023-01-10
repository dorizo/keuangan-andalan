<?php
class akunbank_pengajuan_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view($id){
            $this->db->where("akunbank_pengajuan.project_id" , $id);
            $this->db->join("project" , "project.project_id=akunbank_pengajuan.project_id" );
            $db = $this->db->get("akunbank_pengajuan");
            return $db->result_array();
        }
        
        public function sumproject($id){
            $this->db->select_sum('transaksiJumlah');
            $this->db->where("project_id" , $id);
            $db = $this->db->get("akunbank_pengajuan");
            return $db->row();
        }
        public function viewsingle($kode){
            $this->db->where("akunbank_pengajuanCode" , $kode);
            $db = $this->db->get("akunbank_pengajuan");
            return $db->row();
        }
        public function submitedit(){
            $this->db->where("akunbank_pengajuanCode", $this->input->post("akunbank_pengajuanCode"));
            $this->db->update("akunbank_pengajuan" , $this->input->post());
        }
        
        public function delete($i){
            $this->db->where("akunbank_pengajuanCode",$i);
            $this->db->delete("akunbank_pengajuan");
        }
        public function submitadd($add){
            
            $this->db->trans_begin();
            $p =  $this->input->post();
            $julahtransaksi = str_replace(",", "",$this->input->post("transaksiJumlah"));
            $p["transaksiJumlah"] =  str_replace(",", "",$this->input->post("transaksiJumlah"));
            $p["upload_file"] =  $add;
            $this->db->insert("akunbank_pengajuan" , $p);
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