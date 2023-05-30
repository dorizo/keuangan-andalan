<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('Report_model');
			
			$this->load->model('vendor_model');
			$this->load->model('witel_model');
			$this->load->model('akunbankTransaksi_model');
			$this->load->library('zip');
			$this->load->model('log_project_model');
			$this->load->model('Projectcat_model');
			
			$this->load->model('job_model');
			$this->load->helper(array('form', 'url','directory'));
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}


	public function index()
	{
		$data["pluginjs"] = "project.js?22";

		if($this->input->get()){
			$data["dataresult"] = $this->Report_model->detail($this->input->get());
	
		}else{
			$data["dataresult"] = $this->project_model->view();
	
		}
		$data["witelresult"] = $this->witel_model->view();
        $data["datajob"] = $this->job_model->view();
        $data["Projectcat"] = $this->Projectcat_model->view();
		
		
		$data["titlepage"] = "PROYEK";
		$this->load->view('template/header' , $data);
		$this->load->view('project' , $data);
		$this->load->view('template/footer');
	}
	public function setting($id){

		$this->form_validation->set_rules('project_id', 'project_id', 'required');
        
        $data["dataresult"] = $this->project_model->viewSinggle($id);
        $data["vendorresult"] = $this->vendor_model->view();
        $data["witelresult"] = $this->witel_model->view();
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

	public function boqfinal($id){

		$this->form_validation->set_rules('project_id', 'project_id', 'required');
        
        $data["dataresult"] = $this->project_model->viewSinggle($id);
        $data["vendorresult"] = $this->vendor_model->view();
        $data["witelresult"] = $this->witel_model->view();
        $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "PROYEK " . $data["dataresult"]->project_code;
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('projectpart/boqfinal' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->project_model->editboqfinal();
			
            redirect('/project', 'refresh');
		
		}
	}

	public function edit($id){

		$data["kategori"] = $this->db->query("select * from project_cat")->result_array();
		$this->form_validation->set_rules('project_id', 'project_id', 'required');
        
        $data["dataresult"] = $this->project_model->viewSinggle($id);
        $data["vendorresult"] = $this->vendor_model->view();
        $data["witelresult"] = $this->witel_model->view();
        $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "PROYEK " . $data["dataresult"]->project_code;
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('projectpart/edit' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->project_model->editpms();
			
            redirect('/project', 'refresh');
		
		}
	}

	public function generate($id){
		$data = $this->project_model->viewSinggle($id);
		$tgl =date("Y" ,strtotime($data->project_date));
		$parameter = explode("-", $data->project_code);
		// echo;
		$witel = $this->db->query("select * from witel where witel_id=".$data->witel_id)->row();
		$search = $witel->region_id."-".$witel->witel_code."-".$tgl;
		$codetahun = $this->db->query("SELECT * ,  (SUBSTRING( project_code , 11) * 1) as mn FROM project where project_code LIKE '%-".$tgl."-%' order by mn desc" )->row();
		// print_r( $codetahun);
		$generetecallcenter =  $search."-".str_pad(($codetahun->mn+1), 4, '0', STR_PAD_LEFT);
		if(count($parameter) == 4){
			$dataddd["titlepage"] = "<div class='bg-danger'>ERROR <hr />PROJECT UNTUK COLCANTER INI TELAH DI BUAT = ".$data->project_code."<hr /><a href='".BASE_URL("project")."'>BACK</a></div>";	
			$this->load->view('template/header' , $dataddd);
			$this->load->view('template/footer');
		}else{
			$dataddd["titlepage"] = "<div class='bg-primary card-body'>GENERATE CODE <hr />PROJECT  COLCANTER INI AKAN DIBUAT DENGAN CODE <hr />".$generetecallcenter."<hr /><a class='btn btn-danger' href='".BASE_URL("project")."'>CANCEL</a> <a class='btn btn-danger' href='".BASE_URL("project/generatesubmit/".$id."/".$generetecallcenter)."'>GENERATE</a></div>";	
			$this->load->view('template/header' , $dataddd);
			$this->load->view("projectpart/generate");
			$this->load->view('template/footer');
			// $this->load->view();
			// $data = array("project_code" => $generetecallcenter );
			// $this->db->where("project_id" , $id);
			// $sss = $this->db->update("project" ,$data);
			// if($sss){
				
			// 	redirect('/project', 'refresh');
			// }
		
		}
		// ;
		// $this->

	}
	public function generatesubmit($id,$generetecallcenter){
		$data = array("project_code" => $generetecallcenter );
			$this->db->where("project_id" , $id);
			$sss = $this->db->update("project" ,$data);
			if($sss){
				
				redirect('/project', 'refresh');
			}
	}
	
	public function done($id){

		$this->form_validation->set_rules('project_id', 'project_id', 'required');
        
        $data["dataresult"] = $this->project_model->viewSinggle($id);
        $data["vendorresult"] = $this->vendor_model->view();
        $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "PROYEK " . $data["dataresult"]->project_code;
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('projectpart/done' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->project_model->doneproject();
            redirect('/project', 'refresh');
		}
	}
	public function download($id){
		$x = explode("/",$_SERVER['DOCUMENT_ROOT']);
		unset($x[4]);
		unset($x[5]);
		unset($x[6]);
		$path =  implode("/",$x)."/api/assets/".$id."/";
	
		// $path = $_SERVER["DOCUMENT_ROOT"]."/../../api/assets/".$id."/";
		// $path =  $_SERVER["DOCUMENT_ROOT"]."/backend_andalanpratama/assets/".$id."/";

		$this->zip->read_dir($path);

		// Download the file to your desktop. Name it "my_backup.zip"
		$this->zip->download('my_backup.zip');

	}
	public function detail($id){
        $data["dataresult"] = $this->project_model->viewSinggle($id);
		$data["logproject"] = $this->log_project_model->getlogproject($id);
		$data["sumproject"] = $this->akunbankTransaksi_model->sumproject($id);
		$data["transaksiproject"] = $this->akunbankTransaksi_model->view($id);
        $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "PROYEK " . $data["dataresult"]->project_code;
		// echo $_SERVER["DOCUMENT_ROOT"]."/../../api/assets/".$id."/";
		
			$x = explode("/",$_SERVER['DOCUMENT_ROOT']);
			unset($x[4]);
			unset($x[5]);
			unset($x[6]);
			// print_r($x);
		 $file =  implode("/",$x)."/api/assets/".$id."/";
		//local dir
		// $file =  $_SERVER["DOCUMENT_ROOT"]."/backend_andalanpratama/assets/".$id."/";
        $map = directory_map($file, false , true);
		$data["map"] =  $map;
		$this->load->view('template/header' , $data);
		$this->load->view('projectpart/detail' , $data);
		$this->load->view('template/footer');
	}

	
	public function add(){
		
        $data["vendorresult"] = $this->vendor_model->view();
        $data["witelresult"] = $this->witel_model->view();
		$data["titlepage"] = "Tambah Project";
		$data["kategori"] = $this->db->query("select * from project_cat")->result_array();
			$this->form_validation->set_rules('project_name', 'project_name', 'required');
		 if ($this->form_validation->run() === FALSE)
		  {
		   $this->load->view('template/header' , $data);
		  $this->load->view('projectpart/addproject' , $data);
		  $this->load->view('template/footer');
		  
		  }else{
			  $this->project_model->submitadd();	
			  redirect('/', 'refresh');
		  }
	}
}
