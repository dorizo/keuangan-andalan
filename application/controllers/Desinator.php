<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desinator extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('Designator_model');
			date_default_timezone_set("ASIA/JAKARTA");
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}


	public function index()
	{
		$data["result"] = $this->Designator_model->view();
		$data["titlepage"] = "Desinator";
		$data["pluginjs"] = "pengumpulan.js";
		$this->load->view('template/header' , $data);
		$this->load->view('designator/view' , $data);
		$this->load->view('template/footer');
	}
	public function edit($id){

		$this->form_validation->set_rules('designator_id', 'designator_id', 'required');
        
        $data["dataresult"] = $this->Designator_model->viewSinggle($id);
        // $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "package";
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('designator/edit' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->Designator_model->submitedit();	
            redirect('/desinator', 'refresh');
		
		}
	}

    public function add(){

		$this->form_validation->set_rules('designator_code', 'package_name', 'required');
      $data["titlepage"] = "PROYEK ";
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('designator/add' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->Designator_model->submitadd();	
            redirect('/desinator', 'refresh');
		}
	}
    public function delete($d){
        $this->Designator_model->delete($d);
        redirect('/desinator', 'refresh');    
    }

	public function detail($id){
		$this->form_validation->set_rules('package_id', 'package_id', 'required');
		$data["titlepage"] = "Admin | DETAIL DESIGNATOR";
		$data["permission"] = $this->db->get("package")->result();
		$data["designator"] = $this->Designator_model->viewSinggle($id);
        $data["datadetail"] = $this->Designator_model->detail($id);
        $data['role'] = $this->db->get_where('role',  array('roleCode' => $id))->row();
		if ($this->form_validation->run() === FALSE)
        {
       $this->load->view('template/header' , $data);
		$this->load->view('designator/detail' , $data);
		$this->load->view('template/footer');
		}else{
			$sss = $this->db->query("select * from designator_package where package_id = ".$this->input->post("package_id")." AND designator_id=$id ")->num_rows();
			echo $sss;
			if($sss == 0){
				$this->Designator_model->submitaddpeckage();
		
			}
			redirect($_SERVER['HTTP_REFERER']);
		}

	}
	public function editpaket($id , $detailid){
		$this->form_validation->set_rules('package_id', 'package_id', 'required');
		$data["titlepage"] = "Admin | DETAIL DESIGNATOR";
		$data["permission"] = $this->db->get("package")->result();
		$data["designator"] = $this->Designator_model->viewSinggle($id);
        $data["datadetail"] = $this->Designator_model->detail($id);
        $data['role'] = $this->db->get_where('role',  array('roleCode' => $id))->row();
        $data['editpackage'] = $this->db->get_where('designator_package',  array('designator_package_id' => $detailid))->row();
		if ($this->form_validation->run() === FALSE)
        {
       $this->load->view('template/header' , $data);
		$this->load->view('designator/detailedit' , $data);
		$this->load->view('template/footer');
		}else{
			$sss = $this->db->query("select * from designator_package where package_id = ".$this->input->post("package_id")." AND designator_id=$id ")->num_rows();
				$this->Designator_model->submiteditpeckage();
		
			redirect($_SERVER['HTTP_REFERER']);
		}

	}
	public function add_detail(){
		$role_permission    = $this->input->post('role_permission');
		$rolecode = $this->input->post('role_code');
		if(!empty($role_permission)){
			foreach($role_permission AS $key => $val){
				$del = $this->db->query("select * from role_permission WHERE permissionCode = '".$role_permission[$key]."' and roleCode = '".$rolecode."'and deleteAt IS NOT NULL")->row();
				if($del){
					$update = array(
						'deleteAt' => NULL,
						
					);
					$update = $this->db->update('role_permission',$update, array('permissionCode' => $role_permission[$key], 'roleCode' => $rolecode));
				}else{
					$result[] = array(
						'permissionCode' => $role_permission[$key],
						'roleCode' => $rolecode,
					);
				}

			}
			if($result){
				$insert = $this->db->insert_batch('role_permission', $result);
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				redirect($_SERVER['HTTP_REFERER']);
			}
			
			
		}
	} 
	public function delete_detail($id){ 

		$update = array(
			'deleteAt' => date('Y-m-d H:i:s'),

		);
		$update = $this->db->update('role_permission',$update, array('rpCode' => $id));
		redirect($_SERVER['HTTP_REFERER']);
	}
}
