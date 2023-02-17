<?php
class Biayalain_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
            $db = $this->db->get("biayalain");
            return $db->result_array();
        }
        public function viewSinggle($kode){
            $this->db->where("biayalainCode" , $kode);
            $db = $this->db->get("biayalain");
            return $db->row();
        }
        public function submitedit(){
            $this->db->where("biayalainCode", $this->input->post("biayalainCode"));
			$p = $this->input->post();
            $this->db->update("biayalain" , $p);
        }
        
        public function delete($i){
            $nm = $this->db->query("SELECT akunBankCode ,biayalain from biayalain where biayalainCode=$i ")->row();

            $a = $this->db->query('Select saldo_sekarang from akunbank where akunBankCode='.$nm->akunBankCode)->row();
            if("DEL" == "CR"){
             // credit saldo mengurangi dan input ke sini
             $saldo = $a->saldo_sekarang - str_replace(",", "",$nm->biayalain);
             $this->db->query("UPDATE `akunbank` SET saldo_sekarang=$saldo where akunBankCode=".$nm->akunBankCode);
             $this->db->query("INSERT INTO `akunbank_debit_kredit`( `akunbankCode`, `debit`, `credit`, `saldo`)VALUES (".$nm->akunBankCode.",0,".$nm->biayalain.",".$saldo.")");
             }else{
                 $saldo = $a->saldo_sekarang + str_replace(",", "",$nm->biayalain);
                 $this->db->query("UPDATE `akunbank` SET saldo_sekarang=$saldo where akunBankCode=".$nm->akunBankCode);
                 $this->db->query("INSERT INTO `akunbank_debit_kredit`( `akunbankCode`, `debit`, `credit`, `saldo`)VALUES (".$nm->akunBankCode.",".$nm->biayalain.",0,".$saldo.")");
                     
             }
            $this->db->where("biayalainCode",$i);
            $this->db->delete("biayalain");
        }
        public function submitadd($add){
            
			$p = $this->input->post();
            $p["upload_file"] =  $add;
            $p["biayalain"] =  str_replace(",", "",$this->input->post("biayalain"));
            $a = $this->db->query('Select saldo_sekarang from akunbank where akunBankCode='.$this->input->post("akunBankCode"))->row();
           if( "CR" == "CR"){
            // credit saldo mengurangi dan input ke sini
            $julahtransaksi = str_replace(",", "",$this->input->post("biayalain"));
            $saldo = $a->saldo_sekarang - str_replace(",", "",$this->input->post("biayalain"));
            $this->db->query("UPDATE `akunbank` SET saldo_sekarang=$saldo where akunBankCode=".$this->input->post("akunBankCode"));
            $this->db->query("INSERT INTO `akunbank_debit_kredit`( `akunbankCode`, `debit`, `credit`, `saldo`)VALUES (".$this->input->post("akunBankCode").",0,".$julahtransaksi.",".$saldo.")");
            }
            $this->db->insert("biayalain" , $p);
            $last_id = $this->db->insert_id();
            return $last_id; 
        }

       
}