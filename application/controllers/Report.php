<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

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
		$data["dataresult"] = $this->Report_model->view();
		$data["dataresult2"] = $this->Report_model->witel();
		$data["dataresult3"] = $this->Report_model->nilaiwitel();
		$data["titlepage"] = "PROYEK";
		$data["pluginjs"] = "transaksi.js";
		$this->load->view('template/header' , $data);
		$this->load->view('report/view' , $data);
		$this->load->view('template/footer');
	}
	public function detail(){
		// print_r($this->input->get());
		// $data["titlepage"] = "PROYEK";
		// $data["pluginjs"] = "transaksi.js";
		// $this->load->view('template/header' , $data);
		// $this->load->view('report/detail' , $data);
		// $this->load->view('template/footer');
		$data["titlepage"] = "HOME";
		$data["pluginjs"] = "home.js?1";
		$data["dataresult"] = $this->Report_model->detail($this->input->get());
		$this->load->view('template/header' , $data);
		$this->load->view('home', $data);
		$this->load->view('template/footer');
	// 	$this->form_validation->set_rules('project_id', 'project_id', 'required');
        
    //     $data["dataresult"] = $this->project_model->viewSinggle($id);
    //     $data["datajob"] = $this->job_model->view();
	// 	$data["titlepage"] = "PROYEK " . $data["dataresult"]->project_code;
	//    if ($this->form_validation->run() === FALSE)
    //     {
    //  	$this->load->view('template/header' , $data);
	// 	$this->load->view('projectpart/edit' , $data);
	// 	$this->load->view('template/footer');
		
	// 	}else{
	// 		$this->project_model->edit();	
    //         redirect('/project', 'refresh');
		
	// 	}
	}

    public function add(){

		$this->form_validation->set_rules('total_akunbank', 'total_akunbank', 'required');
      $data["titlepage"] = "PROYEK ";
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('report/add' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->akunbank_model->submitadd();	
            redirect('/akunbank', 'refresh');
		}
	}
    public function delete($d){
        // $this->akunbank_model->delete($d);
        redirect('/akunbank', 'refresh');    
    }

	public function record($r){
		
		$data["titlepage"] = "PROYEK ";
		$data["datatable"] = $this->db->query("select * from akunbank_transaksi at join project p ON at.project_id=p.project_id JOIN akunakutansi aa ON aa.AkunAkuntansiCode=at.AkunAkuntansiCode where at.akunBankCode=$r")->result_array();
		
		$this->load->view('template/header' , $data);
		$this->load->view('report/history' , $data);
		$this->load->view('template/footer');
	}
}
