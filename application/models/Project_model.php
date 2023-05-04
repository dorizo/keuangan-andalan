<?php
class Project_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
        $this->db->select("* ,(select witel_name from witel where witel_id=project.witel_id) as witel , (select vendorID from vendor where vendorCode=project.vendorCode) as vendor ,(select COALESCE(sum(a.transaksiJumlah),0) from akunbank_transaksi a where a.project_id=project.project_id ) as paymentvendor , (select  COALESCE(sum(hitungbunga( b.transaksiJumlah, b.transaksiDate , IF(a.project_paid IS NULL,NOW(),a.project_paid) )),0)  as x from project a JOIN  akunbank_transaksi b ON b.project_id=a.project_id where a.project_id=project.project_id) as totalbungaseluruh , (select COALESCE(sum(a.nilaibiaya), 0) from biayalaindetail a where a.project_id=project.project_id ) as pembayaranAPI");
        $this->db->join("project_cat" , "project.cat_id=project_cat.cat_id");
        $this->db->order_by("project_id" , "DESC");
        $db = $this->db->get("project");
        return $db->result_array();
        }
        public function witelfilter($wid){
                $this->db->select("* ,(select witel_name from witel where witel_id=project.witel_id) as witel , (select vendorID from vendor where vendorCode=project.vendorCode) as vendor ,(select COALESCE(sum(a.transaksiJumlah),0) from akunbank_transaksi a where a.project_id=project.project_id ) as paymentvendor , (select  COALESCE(sum(hitungbunga( b.transaksiJumlah, b.transaksiDate , IF(a.project_paid IS NULL,NOW(),a.project_paid) )),0)  as x from project a JOIN  akunbank_transaksi b ON b.project_id=a.project_id where a.project_id=project.project_id) as totalbungaseluruh, (select COALESCE(sum(a.nilaibiaya), 0) from biayalaindetail a where a.project_id=project.project_id ) as pembayaranAPI");
                $this->db->join("project_cat" , "project.cat_id=project_cat.cat_id");
                $this->db->order_by("project_id" , "DESC");
                $this->db->where("witel_id" , $wid);
                $this->db->where("project_status != 'PAID'");
                $db = $this->db->get("project");
                return $db->result_array();
                }
        

        public function viewSinggle($a){
        $this->db->select("* ,(select sum(a.transaksiJumlah) from akunbank_transaksi a where a.project_id=project.project_id ) as paymentvendor , (select  sum(hitungbunga( b.transaksiJumlah, b.transaksiDate , IF(a.project_paid IS NULL,NOW(),a.project_paid) ))  as x from project a JOIN  akunbank_transaksi b ON b.project_id=a.project_id where a.project_id=project.project_id) as totalbungaseluruh, (select COALESCE(sum(a.nilaibiaya), 0) from biayalaindetail a where a.project_id=project.project_id ) as pembayaranAPI");        
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
        
        public function editpms(){
                $this->db->where("project_id", $this->input->post("project_id"));
                $p = $this->input->post();
                $this->db->update("project" , $p);
          }
        
        public function editboqfinal(){
                $this->db->where("project_id", $this->input->post("project_id"));
                $p = $this->input->post();
                $p["boqfinal"] = str_replace(",", "",$this->input->post("boqfinal"));
                $this->db->update("project" , $p);
          }

        public function editnonnilai(){
                $this->db->where("project_id", $this->input->post("project_id"));
                $p = $this->input->post();
                // $p["nilai_project"] = str_replace(",", "",$this->input->post("nilai_project"));
                // $p["nilai_boq"] = str_replace(",", "", $this->input->post("nilai_boq"));
                $this->db->update("project" , $p);
          }
        
        

        public function doneproject(){
                $this->db->where("project_id", $this->input->post("project_id"));
                $p = $this->input->post();
                $p["nilai_project_paid"] = str_replace(",", "",$this->input->post("nilai_project_paid"));
                $this->db->update("project" , $p);
          }
        public function submitadd(){
                $p = $this->input->post();
                $p["project_status"] = "Pending";
                $this->db->insert("project" , $p);     
        }
        public function projectoutstending(){
                $this->db->select("a.* , b.suratpesananoutstandingCode,b.suratpesananCode,b.nilai_outstanding");
                $this->db->where("status_paid","OUTSTENDING");
                $this->db->JOIN("suratpesananoutstanding b","a.project_id=b.project_id","LEFT");
                $this->db->where("suratpesananoutstandingCode  IS NULL");
                $db = $this->db->get("project a");
                return $db->result_array();
        }
        public function projectoutstendingcount(){
                $this->db->select("(sum(a.nilai_project) - sum(a.nilai_project_paid)) as poin");
                $this->db->where("status_paid","OUTSTENDING");
                $db = $this->db->get("project a");
                return $db->row();
        }

        public function projectoutstendingkode($kode){
                $this->db->select("a.* , b.suratpesananoutstandingCode,b.suratpesananCode,b.nilai_outstanding");
                $this->db->where("status_paid","OUTSTENDING");
                $this->db->JOIN("suratpesananoutstanding b","a.project_id=b.project_id","LEFT");
                $this->db->JOIN("suratpesanan c","c.suratpesananCode=b.suratpesananCode","LEFT");
                $this->db->where("c.suratpesananCode",$kode);
                $db = $this->db->get("project a");
                return $db->result_array();
        }
}