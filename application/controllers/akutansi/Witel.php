<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Witel extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('akutansi/Witel_model');
			date_default_timezone_set("ASIA/JAKARTA");
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}


	public function index()
	{
		$data["result"] = $this->Witel_model->view();
		$data["titlepage"] = "Role";
		$data["pluginjs"] = "pengumpulan.js";
		$this->load->view('template/header' , $data);
		$this->load->view('witelho/view' , $data);
		$this->load->view('template/footer');
	}
	public function edit($id){
		

		$this->form_validation->set_rules('witelhoCode', 'witelhoCode', 'required');
        
        $data["dataresult"] = $this->Witel_model->viewSinggle($id);
        // $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "Vendor : ";
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('witelho/edit' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->Witel_model->submitedit();	
            redirect('akutansi/witel', 'refresh');
		
		}
	}

    public function add(){

		$this->form_validation->set_rules('witelhoCode', 'witelhoCode', 'required');
      $data["titlepage"] = "PROYEK ";
	  print_r($this->input->post());
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('witelho/add' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->Witel_model->submitadd();	
            redirect('akutansi/witel', 'refresh');
		}
	}
    public function delete($d){
        $this->Witel_model->delete($d);
        redirect('akutansi/witel', 'refresh');    
    }

	public function detail($id){
		$this->form_validation->set_rules('role', 'role', 'required');
        $data["titlepage"] = "Admin | Detail Master Role ";
        $data['permission'] = $this->db->query("select * from permission order by description ASC")->result();
        $data["datadetail"] = $this->Witel_model->detail($id)->result();
        $data['role'] = $this->db->get_where('role',  array('roleCode' => $id))->row();
		$this->load->view('template/header' , $data);
		$this->load->view('witelho/detail' , $data);
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
}
