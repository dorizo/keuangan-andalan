<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('akunbankTransaksi_model');
			
			$this->load->model('log_project_model');
			$this->load->model('job_model');
			$this->load->helper(array('form', 'url','directory'));
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}


	public function index()
	{
		$data["dataresult"] = $this->project_model->view();
		$data["titlepage"] = "PROYEK";
		$this->load->view('template/header' , $data);
		$this->load->view('project' , $data);
		$this->load->view('template/footer');
	}
	public function setting($id){

		$this->form_validation->set_rules('project_id', 'project_id', 'required');
        
        $data["dataresult"] = $this->project_model->viewSinggle($id);
        $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "PROYEK " . $data["dataresult"]->project_code;
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('projectpart/Settingnilaiproject' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->project_model->edit();
			
            redirect('/project', 'refresh');
		
		}
	}
	public function detail($id){
        $data["dataresult"] = $this->project_model->viewSinggle($id);
		$data["logproject"] = $this->log_project_model->getlogproject($id);
		$data["sumproject"] = $this->akunbankTransaksi_model->sumproject($id);
		$data["transaksiproject"] = $this->akunbankTransaksi_model->view($id);
        $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "PROYEK " . $data["dataresult"]->project_code;
		$file =  $_SERVER["DOCUMENT_ROOT"]."/../../api/assets/".$id."/";
		//local dir
		// $file =  $_SERVER["DOCUMENT_ROOT"]."/backend_andalanpratama/assets/".$id."/";
        $map = directory_map($file, false , true);
		$data["map"] =  $map;
		$this->load->view('template/header' , $data);
		$this->load->view('projectpart/detail' , $data);
		$this->load->view('template/footer');
	}
}
