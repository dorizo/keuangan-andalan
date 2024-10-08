<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oprasional extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('akutansi/Oprasional_model');
			$this->load->model('akutansi/Akun_model');
			$this->load->model('akutansi/Sto_model');
			$this->load->model('akutansi/Pekerjaan_model');
			$this->load->model('akutansi/Witel_model');
			$this->load->model('Akunakutansi_model');
			
			date_default_timezone_set("ASIA/JAKARTA");
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}


	public function index()
	{
		$data["result"] = $this->Oprasional_model->view();
		$data["titlepage"] = "Oprasional";
		$data["pluginjs"] = "pengumpulan.js";
		$this->load->view('template/header' , $data);
		$this->load->view('oprasional/view' , $data);
		$this->load->view('template/footer');
	}
	public function edit($id){
		

		$data["akun"] = $this->Akun_model->view();
		$data["sto"] = $this->Sto_model->view();
		$data["witel"] = $this->Witel_model->view();
		$data["Pekerjaan"] = $this->Pekerjaan_model->view();
		$this->form_validation->set_rules('stoCode', 'stoCode', 'required');
        $data["dataresult"] = $this->Oprasional_model->viewSinggle($id);
		$data["titlepage"] = "Vendor : ";
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('oprasional/edit' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->Oprasional_model->submitedit();	
            redirect('akutansi/oprasional', 'refresh');
		
		}
	}

    public function add(){

		$this->form_validation->set_rules('stoCode', 'stoCode', 'required');
      $data["titlepage"] = "PROYEK ";
	  
		$data["akun"] = $this->Akun_model->view();
		$data["sto"] = $this->Sto_model->view();
		$data["witel"] = $this->Witel_model->view();
		$data["Pekerjaan"] = $this->Pekerjaan_model->view();
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('oprasional/add' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->Oprasional_model->submitadd();	
            redirect('akutansi/oprasional', 'refresh');
		}
	}
    public function delete($d){
        $this->Oprasional_model->delete($d);
        redirect('akutansi/oprasional', 'refresh');    
    }

	public function detail($id){
		$this->form_validation->set_rules('role', 'role', 'required');
        $data["titlepage"] = "Admin | Detail Master Role ";
        $data['permission'] = $this->db->query("select * from permission order by description ASC")->result();
        $data["datadetail"] = $this->Oprasional_model->detail($id)->result();
        $data['role'] = $this->db->get_where('role',  array('roleCode' => $id))->row();
		$this->load->view('template/header' , $data);
		$this->load->view('oprasional/detail' , $data);
		$this->load->view('template/footer');

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
	public function reject($id){ 
		$update = array(
			'kategoriakutansi' => "reject",

		);
		$update = $this->db->update('oprasionalrequest',$update, array('orCode' => $id));
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function pengajuan($id){
		$this->form_validation->set_rules('stoCode', 'stoCode', 'required');
      $data["titlepage"] = "PROYEK ";
		$this->db->join("witelho c" , "c.witelhoID=a.witel_id");
		$this->db->join("sto d" , "d.stoCode=a.stoCode");
		$this->db->join("pekerjaan f" , "f.pekerjaanCode=a.pekerjaanCode");
		$this->db->where("kategoriakutansi" , "pending");
		$this->db->where("orCode" , $id);
		$data["result"] = $this->db->get("oprasionalrequest a")->row();
		$data["orCode"] = $id;
	  
		$data["akun"] = $this->Akun_model->view();
		$data["sto"] = $this->Sto_model->view();
		$data["witel"] = $this->Witel_model->view();
		$data["Pekerjaan"] = $this->Pekerjaan_model->view();
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('oprasional/pengajuan' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->db->set("kategoriakutansi" , "approve");
			$this->db->where("orCode" , $id);
			$this->db->update("oprasionalrequest");
			$this->Oprasional_model->submitadd();	
            redirect('akutansi/oprasional', 'refresh');
		}
	}

	
}
