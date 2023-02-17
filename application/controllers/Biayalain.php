<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Biayalain extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('biayalain_model');
			$this->load->model('akunbank_model');
			$this->load->model('project_model');
			$this->load->model('witel_model');
			$this->load->model('akunakutansi_model');
			$this->load->model('akunbank_pengajuan_model');
			
			
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}


	public function index()
	{
		$data["dataresult"] = $this->biayalain_model->view();
		$data["titlepage"] = "BIAYA LAINYA";
		$data["pluginjs"] = "vendor.js";
		$this->load->view('template/header' , $data);
		$this->load->view('biayalain/view' , $data);
		$this->load->view('template/footer');
	}
	public function edit($id){

		$this->form_validation->set_rules('username', 'username', 'required');
        
        $data["dataresult"] = $this->biayalain_model->viewSinggle($id);
        // $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "Vendor : " . $data["dataresult"]->vendorName;
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('biayalain/edit' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->biayalain_model->submitedit();	
            redirect('/biayalain', 'refresh');
		
		}
	}

    public function add($pengajuanCode=0){

		$this->form_validation->set_rules('biayalain', 'username', 'required');
     	$data["titlepage"] = "PROYEK ";
	 	$data["pengajuan"] = $this->akunbank_pengajuan_model->pengajuanlainlain();
		
		 $data["resultdata"] = $this->akunbank_pengajuan_model->viewsinglebiayalain($pengajuanCode);
	//   $data["pengajuanCode"]
		$data["pengajuanCode"] = $pengajuanCode;
		$data["akunbank"] = $this->akunbank_model->view();
		$data["witel"] = $this->witel_model->view();
		$data["akunakutansi"] = $this->akunakutansi_model->view();
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('biayalain/add' , $data);
		$this->load->view('template/footer');
		
		}else{

			$config['upload_path']          = './pembayaran/';
			$config['allowed_types']        = '*';
			$config['max_size']             = 1000;
			$config['max_width']            = 10240;
			$config['max_height']           = 7680;
			$config['encrypt_name']           = TRUE;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('file'))
			{
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
				$this->load->view('template/header' , $data);
			   $this->load->view('biayalain/add' , $data);
			   $this->load->view('template/footer');
			}else{
				$kd = $this->biayalain_model->submitadd($this->upload->data("file_name"));
				
			$this->db->query("UPDATE `akunbank_pengajuan` SET `statusTransaksi` = 'APPROVE' WHERE `akunbank_pengajuanCode` =".$pengajuanCode);				
            redirect('/biayalain/bagi/'.$kd, 'refresh');
			}
		}
	}

	public function addsp($pengajuanCode=0){

		$this->form_validation->set_rules('biayalain', 'username', 'required');
     	$data["titlepage"] = "PROYEK ";
	 	$data["pengajuan"] = $this->akunbank_pengajuan_model->pengajuanlainlain();
		
		 $data["resultdata"] = $this->akunbank_pengajuan_model->viewsinglebiayalainsp($pengajuanCode);
	//   $data["pengajuanCode"]
		$data["pengajuanCode"] = $pengajuanCode;
		$data["akunbank"] = $this->akunbank_model->view();
		$data["witel"] = $this->witel_model->view();
		$data["akunakutansi"] = $this->akunakutansi_model->view();
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('biayalain/addsp' , $data);
		$this->load->view('template/footer');
		
		}else{


			$config['upload_path']          = './pembayaran/';
			$config['allowed_types']        = '*';
			$config['max_size']             = 1000;
			$config['max_width']            = 10240;
			$config['max_height']           = 7680;
			$config['encrypt_name']           = TRUE;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('file'))
			{
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
				$this->load->view('template/header' , $data);
			   $this->load->view('biayalain/addsp' , $data);
			   $this->load->view('template/footer');
			}else{
				$kd = $this->biayalain_model->submitadd($this->upload->data("file_name"));
				$this->db->query("UPDATE `akunbank_pengajuan` SET `statusTransaksi` = 'APPROVE' WHERE `akunbank_pengajuanCode` =".$pengajuanCode);				
				redirect('/biayalain/bagisp/'.$kd, 'refresh');
			}
			
		}
	}
	public function bagi($kd){
		$this->form_validation->set_rules('bagi[]', 'bagi', 'required');
		$datax = $this->biayalain_model->viewSinggle($kd);
		$data["datax"] =$datax;
		$data["resultdata"] = $this->akunbank_pengajuan_model->viewsinglebiayalain($datax->pengajuanCode);
		$data["titlepage"] = "pembagian biaya dari witel =".$datax->witel_id;
		$data["project"] = $this->project_model->witelfilter($datax->witel_id);
	   if ($this->form_validation->run() === FALSE)
        {
		$this->load->view('template/header' , $data);
		$this->load->view('biayalain/bagi' , $data);
		$this->load->view('template/footer');
		}else{
			$this->db->select("sum(nilai_project) as total");
			$this->db->where_in("project_id" , $this->input->post("bagi"));
			$data["param"] = $this->db->get("project")->row();
			$this->db->where_in("project_id" , $this->input->post("bagi"));
			$data["result"] = $this->db->get("project")->result_array();
			$data["nilaibagi"] = $datax;
			// print_r($pquery);
					$this->load->view('template/header' , $data);
					$this->load->view('biayalain/formbagi' , $data);
					$this->load->view('template/footer');
			
		}
	}

	public function bagisp($kd){
		$this->form_validation->set_rules('bagi[]', 'bagi', 'required');
		$datax = $this->biayalain_model->viewSinggle($kd);
		$data["datax"] =$datax;
		$data["resultdata"] = $this->akunbank_pengajuan_model->viewsinglebiayalainsp($datax->pengajuanCode);
		$data["titlepage"] = "pembagian biaya dari witel =".$datax->witel_id;
		$data["project"] = $this->project_model->witelfilter($datax->witel_id);
	   if ($this->form_validation->run() === FALSE)
        {
		$this->load->view('template/header' , $data);
		$this->load->view('biayalain/bagisp' , $data);
		$this->load->view('template/footer');
		}else{
			$this->db->select("sum(nilai_project) as total");
			$this->db->where_in("project_id" , $this->input->post("bagi"));
			$data["param"] = $this->db->get("project")->row();
			$this->db->where_in("project_id" , $this->input->post("bagi"));
			$data["result"] = $this->db->get("project")->result_array();
			$data["nilaibagi"] = $datax;
			// print_r($pquery);
					$this->load->view('template/header' , $data);
					$this->load->view('biayalain/formbagi' , $data);
					$this->load->view('template/footer');
			
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
		$sss = $this->db->insert_batch("biayalaindetail" , $arr);
		if($sss){
			echo "<script>alert('data berhasil Di input');</script>";
			redirect('/biayalain', 'refresh'); 
		}
  	}

    public function delete($d){
        $this->biayalain_model->delete($d);
        redirect('/biayalain', 'refresh');    
    }
}
