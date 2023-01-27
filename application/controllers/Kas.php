<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kas extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('akunbank_kas_model');
			$this->load->model('akunbank_model');
			$this->load->model('akunakutansi_model');
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}


	public function index()
	{
		$data["titlepage"] = "KAS";
		$data["pluginjs"] = "transaksi.js";
        $data["datatable"] = $this->akunbank_kas_model->view();
		$this->load->view('template/header' , $data);
		$this->load->view('kas/view' , $data);
		$this->load->view('template/footer');
	}
	public function edit($id){

		$this->form_validation->set_rules('project_id', 'project_id', 'required');
        
        $data["dataresult"] = $this->project_model->viewSinggle($id);
        $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "PROYEK " . $data["dataresult"]->project_code;
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('kas/edit' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->project_model->edit();	
            redirect('/project', 'refresh');
		
		}
	}

    public function add(){

		$this->form_validation->set_rules('status', 'status', 'required');
		$data["titlepage"] = "Transaksi Project ";
		$data["akunbank"] = $this->akunbank_model->view();
		$data["akunakutansi"] = $this->akunakutansi_model->view();
	//   print_r($data["akunbank"]);
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('kas/add' , $data);
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
				$this->load->view('kas/add' , $data);
				$this->load->view('template/footer');
			}else{
				// print_r();		
				$this->akunbank_kas_model->submitadd($this->upload->data("file_name"));	
				redirect('/kas', 'refresh');
			}
		}
	}
    public function delete($d){

        $this->akunbank_kas_model->delete($d);
		redirect($_SERVER['HTTP_REFERER']);  
    }
}
