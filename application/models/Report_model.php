<?php
class Report_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function view(){
           return $this->db->query("SELECT count(*) as Count ,  COALESCE(SUM(nilai_project),0) as nilai ,project_status FROM project JOIN job
           ON job.job_name=project.project_status GROUP BY project_status ORDER BY job_id ASC")->result_array();
        }
        public function witel(){
            return $this->db->query("SELECT job_name , (SELECT COUNT(*) FROM project Where witel_id=6 and project_status=job_name) as jaktim , (SELECT COUNT(*) FROM project Where witel_id=7 and project_status=job_name) as jaksel , (SELECT COUNT(*) FROM project Where witel_id=8 and project_status=job_name) as jakbar , (SELECT COUNT(*) FROM project Where witel_id=9 and project_status=job_name) as jakpus , (SELECT COUNT(*) FROM project Where witel_id=10 and project_status=job_name) as jakut , (SELECT COUNT(*) FROM project Where witel_id=11 and project_status=job_name) as bogor , (SELECT COUNT(*) FROM project Where witel_id=12 and project_status=job_name) as tanggrang , (SELECT COUNT(*) FROM project Where witel_id=13 and project_status=job_name) as banten, (SELECT COUNT(*) FROM project Where witel_id=14 and project_status=job_name) as cirebon , (SELECT COUNT(*) FROM project Where witel_id=15 and project_status=job_name) as bandung , (SELECT COUNT(*) FROM project Where witel_id=16 and project_status=job_name) as bekasi FROM job;")->result_array();
        }
        
        public function nilaiwitel(){
            return $this->db->query("SELECT job_name , (SELECT  COALESCE(SUM(nilai_project),0) FROM project Where witel_id=6 and project_status=job_name) as jaktim , (SELECT  COALESCE(SUM(nilai_project),0) FROM project Where witel_id=7 and project_status=job_name) as jaksel , (SELECT  COALESCE(SUM(nilai_project),0) FROM project Where witel_id=8 and project_status=job_name) as jakbar , (SELECT  COALESCE(SUM(nilai_project),0) FROM project Where witel_id=9 and project_status=job_name) as jakpus , (SELECT  COALESCE(SUM(nilai_project),0) FROM project Where witel_id=10 and project_status=job_name) as jakut , (SELECT  COALESCE(SUM(nilai_project),0) FROM project Where witel_id=11 and project_status=job_name) as bogor , (SELECT  COALESCE(SUM(nilai_project),0) FROM project Where witel_id=12 and project_status=job_name) as tanggrang , (SELECT  COALESCE(SUM(nilai_project),0) FROM project Where witel_id=13 and project_status=job_name) as banten, (SELECT  COALESCE(SUM(nilai_project),0) FROM project Where witel_id=14 and project_status=job_name) as cirebon , (SELECT  COALESCE(SUM(nilai_project),0) FROM project Where witel_id=15 and project_status=job_name) as bandung , (SELECT  COALESCE(SUM(nilai_project),0) FROM project Where witel_id=16 and project_status=job_name) as bekasi FROM job;")->result_array();
        }
        public function detail($p){
        foreach ($p as $key => $value) {
            # code...
            

            $this->db->where(str_replace("-",".",$key),$value);
        }

            
        $this->db->select("* ,(select witel_name from witel where witel_id=project.witel_id) as witel , (select vendorID from vendor where vendorCode=project.vendorCode) as vendor ,(select COALESCE(sum(a.transaksiJumlah),0) from akunbank_transaksi a where a.project_id=project.project_id ) as paymentvendor , (select  COALESCE(sum(hitungbunga( b.transaksiJumlah, b.transaksiDate , IF(a.project_paid IS NULL,NOW(),a.project_paid) )),0)  as x from project a JOIN  akunbank_transaksi b ON b.project_id=a.project_id where a.project_id=project.project_id) as totalbungaseluruh");
        $this->db->join("project_cat" , "project.cat_id=project_cat.cat_id");
        $this->db->order_by("project_id" , "DESC");
        $db = $this->db->get("project");
        return $db->result_array();
        }

        public function reportcatwitel($catid , $witelid){
            return $this->db->query("select COALESCE(SUM(nilai_project),0) as x FROM project where witel_id='$witelid' AND cat_id='$catid'")->row();
        }
        
        public function reportcategori($witelid){
            return $this->db->query("select COALESCE(SUM(nilai_project),0) as x FROM project where witel_id='$witelid'")->row();
        }
    }
    ?>