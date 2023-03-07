<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('Report_model');
			$this->load->model('job_model');
			$this->load->model('witel_model');
			$this->load->model('Projectcat_model');
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
			// print_r($user_logged_in);
			
	}

	public function index()
	{
		$data["titlepage"] = "HOME";
		$data["pluginjs"] = "home.js?1";
		if($this->input->get()){
			$data["dataresult"] = $this->Report_model->detail($this->input->get());
	
		}else{
			$data["dataresult"] = $this->project_model->view();
	
		}
		
		$data["witelresult"] = $this->witel_model->view();
        $data["datajob"] = $this->job_model->view();
        $data["Projectcat"] = $this->Projectcat_model->view();
		$this->load->view('template/header' , $data);
		$this->load->view('home', $data);
		$this->load->view('template/footer');
	}
}
