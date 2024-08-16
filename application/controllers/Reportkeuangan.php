<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportKeuangan extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('Report_model');
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}


	public function index()
	{

		$data["titlepage"] = "Report Keuangan";
		$data["pluginjs"] = "transaksi.js";
        $mulai = date("Y-m-d");
        $selesai = date("Y-m-d");
        if($this->input->get("mulai") and $this->input->get("selesai")){
            $mulai = $this->input->get("mulai");
            $selesai = $this->input->get("selesai");
           
        }
        $querycari = 'select   DATE_FORMAT(a.transaksiDate, \'%d-%m-%Y\') as transaksiDate, MONTH(a.transaksiDate) as bulan , b.project_code ,d.AkunAkutansiName , d.AkunAkutansiCodeName , "tidak ada" as akun, "tidak ada" as kategori , witel_name , region_name , cat_name , a.transaksiNote, CASE WHEN a.statusTransaksi="DB" THEN a.transaksiJumlah ELSE NULL END AS debit , CASE WHEN a.statusTransaksi="CR" THEN a.transaksiJumlah ELSE NULL END AS kredit , vendorName from akunbank_transaksi a JOIN project b ON b.project_id=a.project_id  JOIN akunbank c ON a.akunBankCode=c.akunBankCode JOIN akunakutansi d ON d.AkunAkuntansiCode=a.AkunAkuntansiCode JOIN project e ON e.project_id=a.project_id JOIN witel f ON f.witel_id=e.witel_id JOIN region g ON g.region_id=f.region_id JOIN project_cat h ON e.cat_id=h.cat_id JOIN vendor i ON i.vendorCode=e.vendorCode where date(a.transaksiDate) between date("'.$mulai.'")  AND date("'.$selesai.'")  order by transaksiDate desc';
        $data["tabledata"] = $this->db->query($querycari)->result_array(); 
        $nilaiboq = 'select sum(nilai_boq) as nilai from project a where date(a.project_start) between date("'.$mulai.'")  AND date("'.$selesai.'")';
        $data["nilaiboq"] =  $this->db->query($nilaiboq)->row(); 
        $nilaikeluar = 'select sum(transaksiJumlah) as nilai from akunbank_transaksi a where date(a.transaksiDate)  between date("'.$mulai.'")  AND date("'.$selesai.'")';
        $data["nilaikeluar"] =  $this->db->query($nilaikeluar)->row(); 
        $projectpaid = 'select sum(nilai_project_paid) as nilai from project a where date(a.project_paid) between date("'.$mulai.'")  AND date("'.$selesai.'")';
        $data["projectpaid"] =  $this->db->query($projectpaid)->row(); 
        $projectcash = 'select sum(nilai_project_paid) as nilai from project a where date(a.tanggal_cashbank) between date("'.$mulai.'")  AND date("'.$selesai.'")';
        $data["projectcash"] =  $this->db->query($projectcash)->row(); 
        $oprasional = 'select sum(kredit) as nilai from oprasional a where date(a.tanggal) between date("'.$mulai.'")  AND date("'.$selesai.'")';
        $data["oprasional"] =  $this->db->query($oprasional)->row(); 
     
        $this->load->view('template/header' , $data);
		$this->load->view('reportkeuangan/view' , $data);
		$this->load->view('template/footer');
    }

    public function export(){
        $date =$this->input->get("mulai");
        $result =[];
        $s = 1;
        while (strtotime($date) <= strtotime($this->input->get("selesai"))) {
           $transaksiproject = $this->db->query("select   DATE_FORMAT(a.transaksiDate, '%Y-%m-%d') as transaksiDate, MONTH(a.transaksiDate) as bulan , b.project_code ,d.AkunAkutansiName , d.AkunAkutansiCodeName , 'tidak ada' as akun, 'tidak ada' as kategori , witel_name , region_name , cat_name , a.transaksiNote, CASE WHEN a.statusTransaksi='DB' THEN a.transaksiJumlah ELSE NULL END AS debit , CASE WHEN a.statusTransaksi='CR' THEN a.transaksiJumlah ELSE NULL END AS kredit , vendorName from akunbank_transaksi a JOIN project b ON b.project_id=a.project_id  JOIN akunbank c ON a.akunBankCode=c.akunBankCode JOIN akunakutansi d ON d.AkunAkuntansiCode=a.AkunAkuntansiCode JOIN project e ON e.project_id=a.project_id JOIN witel f ON f.witel_id=e.witel_id JOIN region g ON g.region_id=f.region_id JOIN project_cat h ON e.cat_id=h.cat_id JOIN vendor i ON i.vendorCode=e.vendorCode where DATE_FORMAT(a.transaksiDate, '%Y-%m-%d') ='$date'")->result_array();
            foreach ($transaksiproject as $key => $value) {
                $row = array();
                # code...
                $row[]=$value["transaksiDate"];
                $row[]= date("M",strtotime($value["transaksiDate"]));
                $row[]=$value["project_code"];
                $row[]=$value["AkunAkutansiName"];
                $row[]=$value["AkunAkutansiCodeName"];
                $row[]=$value["akun"];
                $row[]=$value["kategori"];
                $row[]=$value["witel_name"];
                $row[]=null;
                $row[]=$value["region_name"];
                $row[]=$value["cat_name"];
                $row[]=$value["transaksiNote"];
                $row[]=null;
                $row[]=$value["kredit"];
                $row[]=null;
                $row[]=null;
                $row[]=$value["vendorName"];
                $result[] = $row;
                $s++;
            }
            // echo "select * from oprasional a where DATE_FORMAT(a.tanggal, '%Y-%m-%d') ='$date'";
            
            $this->db->join("akutansi_akun b" , "b.kode_akun=a.kode_akun");
            $this->db->join("witelho c" , "c.witelhoID=a.witel_id");
            $this->db->join("sto d" , "d.stoCode=a.stoCode");
            $this->db->join("pekerjaan f" , "f.pekerjaanCode=a.pekerjaanCode");
            $this->db->where("DATE_FORMAT(a.tanggal, '%Y-%m-%d')=" , $date);
            $db = $this->db->get("oprasional a");
            $transaksiproject2 =  $db->result_array();
            // $transaksiproject2 = $this->db->query("select * from oprasional a where DATE_FORMAT(a.tanggal, '%Y-%m-%d') ='$date'")->result_array();
            foreach ($transaksiproject2 as $key => $value) {
            
                # code...
                $row = array();
                # code...
                $row[]=$value["tanggal"];
                $row[]= date("M",strtotime($value["tanggal"]));
                $row[]=$value["kode_project"];
                $row[]=$value["nama_akun"];
                $row[]=$value["kode_akun"];
                $row[]=$value["nama_akun"];
                $row[]=$value["kategori"];
                $row[]=$value["witelhoName"];
                $row[]=$value["stoName"];
                $row[]=$value["regional_id"];
                $row[]=$value["pekerjaanName"];
                $row[]=$value["keterangan"];
                $row[]=$value["debit"];
                $row[]=$value["kredit"];
                $row[]=$value["diterimaoleh"];
                $row[]=$value["dikirimoleh"];
                $row[]=$value["mandor"];
                $result[] = $row;
            }
            
            $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
        }
        
        echo json_encode($result); 
    }

}
?>