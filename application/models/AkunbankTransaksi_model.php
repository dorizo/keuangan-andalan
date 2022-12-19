<?php
class akunbankTransaksi_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view($id){
            $this->db->where("akunbank_transaksi.project_id" , $id);
            $this->db->join("project" , "project.project_id=akunbank_transaksi.project_id" );
            $db = $this->db->get("akunbank_transaksi");
            return $db->result_array();
        }
        
        public function sumproject($id){
            $this->db->select_sum('transaksiJumlah');
            $this->db->where("project_id" , $id);
            $db = $this->db->get("akunbank_transaksi");
            return $db->row();
        }
        public function viewsingle($kode){
            $this->db->where("akunbank_transaksiCode" , $kode);
            $db = $this->db->get("akunbank_transaksi");
            return $db->row();
        }
        public function submitedit(){
            $this->db->where("akunbank_transaksiCode", $this->input->post("akunbank_transaksiCode"));
            $this->db->update("akunbank_transaksi" , $this->input->post());
        }
        
        public function delete($i){
            $this->db->where("akunbank_transaksiCode",$i);
            $this->db->delete("akunbank_transaksi");
        }
        public function submitadd(){
            $this->db->insert("akunbank_transaksi" , $this->input->post());
        }

       
}