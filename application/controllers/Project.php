<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
	}


	public function index()
	{
		$data["dataresult"] = $this->project_model->view();
		$data["titlepage"] = "PROYEK";
		$this->load->view('template/header' , $data);
		$this->load->view('project' , $data);
		$this->load->view('template/footer');
	}
}
