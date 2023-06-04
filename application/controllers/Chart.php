<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('Report_model');
			$this->load->model('Vendor_model');
			$this->load->model('Witel_model');
			
			$this->load->model('Job_model');
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}


	public function index()
	{
        $data["dataresult"] = $this->Report_model->view();
        $data["datavendor"] = $this->Vendor_model->view();
		$data["dataresult2"] = $this->Report_model->witel();
		$data["dataresult3"] = $this->Report_model->nilaiwitel();
		$data["titlepage"] = "Chart Report";
		$data["pluginjs"] = "transaksi.js";
		$this->load->view('template/header' , $data);
		$this->load->view('chart/index' , $data);
		$this->load->view('template/footer');
    }
    public function kat()
	{
        $data["dataresult"] = $this->Report_model->view();
        $data["datavendor"] = $this->Job_model->view();
		$data["dataresult2"] = $this->Report_model->witel();
		$data["dataresult3"] = $this->Report_model->nilaiwitel();
		$data["titlepage"] = "Chart Report";
		$data["pluginjs"] = "transaksi.js";
		$this->load->view('template/header' , $data);
		$this->load->view('chart/kat' , $data);
		$this->load->view('template/footer');
    }
    public function witel()
	{
        $data["dataresult"] = $this->Report_model->view();
        $data["datavendor"] = $this->Witel_model->view();
		$data["dataresult2"] = $this->Report_model->witel();
		$data["dataresult3"] = $this->Report_model->nilaiwitel();
		$data["titlepage"] = "Chart Report";
		$data["pluginjs"] = "transaksi.js";
		$this->load->view('template/header' , $data);
		$this->load->view('chart/witel' , $data);
		$this->load->view('template/footer');
    }
    public function outstanding()
	{
        $data["dataresult"] = $this->Report_model->view();
        $data["datavendor"] = $this->Witel_model->view();
		$data["dataresult2"] = $this->Report_model->witel();
		$data["dataresult3"] = $this->Report_model->nilaiwitel();
		$data["titlepage"] = "Chart Report";
		$data["pluginjs"] = "transaksi.js";
		$this->load->view('template/header' , $data);
		$this->load->view('chart/outstanding' , $data);
		$this->load->view('template/footer');
    }

}