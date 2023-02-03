<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pmsetting extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('vendor_model');
			$this->load->model('witel_model');
			$this->load->model('akunbankTransaksi_model');
			$this->load->library('zip');
			$this->load->model('log_project_model');
			$this->load->model('job_model');
			$this->load->helper(array('form', 'url','directory'));
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}
public function setting($id){

		$this->form_validation->set_rules('project_id', 'project_id', 'required');
        
        $data["dataresult"] = $this->project_model->viewSinggle($id);
        $data["vendorresult"] = $this->vendor_model->view();
        $data["witelresult"] = $this->witel_model->view();
        $data["datajob"] = $this->job_model->viewPM();
		$data["titlepage"] = "PROYEK " . $data["dataresult"]->project_code;
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('projectpart/pmsetting' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->project_model->editnonnilai();
			
            redirect('/project', 'refresh');
		
		}
	}

}