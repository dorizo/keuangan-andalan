<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportKategori extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('projectcat_model');
			$this->load->model('witel_model');
			$this->load->model('report_model');
            
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}


	public function index()
	{
        $data["dataresult"] = $this->projectcat_model->view();
        $data["columtable"] = $this->witel_model->view();
		$data["titlepage"] = "REPORT";
		$data["pluginjs"] = "transaksi.js";
		$this->load->view('template/header' , $data);
		$this->load->view('report/viewcat' , $data);
		$this->load->view('template/footer');
    }

	public function keuangan(){
		$data["row"] = $this->report_model->reportresumecount();
        $data["dataresult"] = $this->report_model->reportresume();
        $data["bungaakunbank"] = $this->report_model->bungaakunbank();
        $data["bungaakunbankresult"] = $this->report_model->bungaakunbankresult();
		$data["titlepage"] = "REPORT KEUANGAN";
		$data["pluginjs"] = "transaksi.js";
		$this->load->view('template/header' , $data);
		$this->load->view('report/keuangan' , $data);
		$this->load->view('template/footer');
	}

}