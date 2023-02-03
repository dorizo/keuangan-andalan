<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suratpesanan extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('suratpesanan_model');
			$this->load->model('akunbank_model');
			$this->load->model('project_model');
			$this->load->model('witel_model');
			$this->load->model('akunakutansi_model');
			
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}


	public function index()
	{
		$data["dataresult"] = $this->suratpesanan_model->view();
		$data["titlepage"] = "BIAYA LAINYA";
		$data["pluginjs"] = "vendor.js";
		$this->load->view('template/header' , $data);
		$this->load->view('suratpesanan/view' , $data);
		$this->load->view('template/footer');
	}
	public function edit($id){

		$this->form_validation->set_rules('username', 'username', 'required');
        
        $data["dataresult"] = $this->suratpesanan_model->viewSinggle($id);
        // $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "Vendor : " . $data["dataresult"]->vendorName;
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('suratpesanan/edit' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->suratpesanan_model->submitedit();	
            redirect('/biayalain', 'refresh');
		
		}
	}

    public function add(){

		$this->form_validation->set_rules('NoSuratpesanan', 'NoSuratpesanan', 'required');
      $data["titlepage"] = "PROYEK ";
	  
		$data["akunbank"] = $this->akunbank_model->view();
		$data["witel"] = $this->witel_model->view();
		$data["akunakutansi"] = $this->akunakutansi_model->view();
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('suratpesanan/add' , $data);
		$this->load->view('template/footer');
		
		}else{
			$kd = $this->suratpesanan_model->submitadd();
		
            redirect('/suratpesanan/bagi/'.$kd, 'refresh');
		}
	}

    public function detail($kd){
		$this->form_validation->set_rules('bagi[]', 'bagi', 'required');
		$datax = $this->suratpesanan_model->viewSinggle($kd);
		$data["titlepage"] = "pembagian biaya dari witel =".$datax->witel_id;
		$data["project"] = $this->suratpesanan_model->witelfilterpilih($kd);
	   if ($this->form_validation->run() === FALSE)
        {
		$this->load->view('template/header' , $data);
		$this->load->view('suratpesanan/detail' , $data);
		$this->load->view('template/footer');
		}
    }
	public function bagi($kd){
		$this->form_validation->set_rules('bagi[]', 'bagi', 'required');
		$datax = $this->suratpesanan_model->viewSinggle($kd);
		$data["titlepage"] = "pembagian biaya dari witel =".$datax->witel_id;
		$data["project"] = $this->suratpesanan_model->witelfilter($datax->witel_id);
	   if ($this->form_validation->run() === FALSE)
        {
		$this->load->view('template/header' , $data);
		$this->load->view('suratpesanan/bagi' , $data);
		$this->load->view('template/footer');
		}else{
			// $this->db->where_in("project_id" , $this->input->post("bagi"));
			// $data["result"] = $this->db->get("project")->result_array();
            // foreach($ );
            $datamarga = array();
            foreach ($this->input->post("bagi") as $key => $value) {
                // print_r($value);
                $datamarga[$key]["suratpesananCode"] = $kd;
                $datamarga[$key]["project_id"] =  $value;
				$this->db->query("UPDATE `project` SET `project_status` = 'pemberkasan' WHERE `project_id` = $value");
            }
			$sss = $this->db->insert_batch("suratpesanandetail" , $datamarga);
		if($sss){
			echo "<script>alert('data berhasil Di input');</script>";
			redirect('/suratpesanan', 'refresh'); 
		}
			
		}
	}
	public function finalpost(){
		// print_r($this->input->post("project_id"));
		$arr = array();
		foreach ($this->input->post("project_id") as $key => $value) {
			// print_r($value);
			$arr[$key]["persentase"] =$this->input->post("persentase")[$key]; 
			$arr[$key]["nilaibiaya"] = $this->input->post("nilaibiaya")[$key];
			$arr[$key]["project_id"] =$this->input->post("project_id")[$key]; 
			$arr[$key]["tanggal_transaksi"] = $this->input->post("tanggal_transaksi");
			$arr[$key]["biayalainCode"] = $this->input->post("biayalainCode");
		}
		// print_r($arr);
		$sss = $this->db->insert_batch("suratpesanandetail" , $arr);
		if($sss){
			echo "<script>alert('data berhasil Di input');</script>";
			redirect('/suratpesanan', 'refresh'); 
		}
  	}

    public function delete($d){
        $this->db->where("suratpesananCode" , $d);
        $SS = $this->db->delete("suratpesanandetail");
        if($SS){
            $this->suratpesanan_model->delete($d);
            redirect('/suratpesanan', 'refresh'); 
        }
    }
}
