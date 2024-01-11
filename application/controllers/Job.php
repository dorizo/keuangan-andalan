<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('job_model');
			date_default_timezone_set("ASIA/JAKARTA");
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}


	public function index()
	{
		$data["result"] = $this->job_model->view();
		$data["titlepage"] = "Role";
		$data["pluginjs"] = "pengumpulan.js";
		$this->load->view('template/header' , $data);
		$this->load->view('job/view' , $data);
		$this->load->view('template/footer');
	}
	public function edit($id){

		$this->form_validation->set_rules('job_name', 'job_name', 'required');
        $data["dataresult"] = $this->job_model->getsingle($id);
        $data["project"] = $this->db->query("select * from project where project_status='".$data["dataresult"]->job_name."'")->result_array();
        // $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "EDIT PROJECT STATUS";
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('job/edit' , $data);
		$this->load->view('template/footer');
		}else{
            $this->db->where("job_id" ,$this->input->post("job_id"));
            $this->db->update("job" , array("job_name" => $this->input->post("job_name"),"job_day" => $this->input->post("job_day"),"job_percent" => $this->input->post("job_percent")));
            $updateproject = $this->db->query("select * from project where project_status='".$this->input->post("job_nameold")."'")->result_array();
            foreach ($updateproject as $key => $value) {
                
                $this->db->limit(1);
                $this->db->where("project_id" , $value["project_id"]);
                $this->db->update("project" , array("project_status" => $this->input->post("job_name")));
            }
            $this->load->view('template/header' , $data);
            $this->load->view('job/success' , $data);
            $this->load->view('template/footer');
        
		
		}
	}

    public function add(){

		$this->form_validation->set_rules('job_name', 'job_name', 'required');
      $data["titlepage"] = "PROYEK ";
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('job/add' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->job_model->submitadd();	
            redirect('/job', 'refresh');
		}
	}
    public function delete($d){
        $this->Akunakutansi_model->delete($d);
        redirect('/job', 'refresh');    
    }

	public function detail($id){
		$this->form_validation->set_rules('role', 'role', 'required');
        $data["titlepage"] = "Admin | Detail Master Role ";
        $data['permission'] = $this->db->query("select * from permission order by description ASC")->result();
        $data["datadetail"] = $this->Akunakutansi_model->detail($id)->result();
        $data['role'] = $this->db->get_where('role',  array('roleCode' => $id))->row();
		$this->load->view('template/header' , $data);
		$this->load->view('job/detail' , $data);
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
