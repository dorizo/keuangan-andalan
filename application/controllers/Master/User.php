<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('Master/user_model');
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}


	public function index()
	{
		$data["result"] = $this->user_model->view();
		$data["titlepage"] = "user";
		$data["pluginjs"] = "pengumpulan.js";
		$this->load->view('template/header' , $data);
		$this->load->view('master/user/view' , $data);
		$this->load->view('template/footer');
	}
	public function edit($id){

		$this->form_validation->set_rules('email', 'email', 'required');
        
        $data["dataresult"] = $this->user_model->single($id);
        // $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "Vendor : ";
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('master/user/edit' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->user_model->submitedit();	
            redirect('/Master/user', 'refresh');
		
		}
	}
	
	public function detail($id){
		$this->form_validation->set_rules('role', 'role', 'required');
        $data["titlepage"] = "Admin | Detail Master Role ";
        $data['datadetail'] = $this->db->query("SELECT * FROM `user` b JOIN `role_user` a  ON a.userCode=b.userCode JOIN role c ON c.roleCode=a.roleCode where b.userCode=$id")->result();
        $data["user"] = $this->db->query("select * from user where userCode=$id")->row();
        $data['permission'] = $this->db->get('role')->result();
		$this->load->view('template/header' , $data);
		$this->load->view('master/user/detail' , $data);
		$this->load->view('template/footer');

	}
	public function add_detail(){
		// $role_permission    = $this->input->post('role_permission');
		$p = $this->input->post();
		print_r($p);
		$this->db->insert("role_user" , $p);
		redirect($_SERVER['HTTP_REFERER']);
		// if(!empty($role_permission)){
		// 	foreach($role_permission AS $key => $val){
		// 		$del = $this->db->query("select * from role_permission WHERE permissionCode = '".$role_permission[$key]."' and roleCode = '".$rolecode."'and deleteAt IS NOT NULL")->row();
		// 		if($del){
		// 			$update = array(
		// 				'deleteAt' => NULL,
						
		// 			);
		// 			$update = $this->db->update('role_permission',$update, array('permissionCode' => $role_permission[$key], 'roleCode' => $rolecode));
		// 		}else{
		// 			$result[] = array(
		// 				'permissionCode' => $role_permission[$key],
		// 				'roleCode' => $rolecode,
		// 			);
		// 		}

		// 	}
		// 	if($result){
		// 		$insert = $this->db->insert_batch('role_permission', $result);
		// 		redirect($_SERVER['HTTP_REFERER']);
		// 	}else{
		// 		redirect($_SERVER['HTTP_REFERER']);
		// 	}
			
			
		// }
	} 
	public function delete_detail($id){ 

		$this->db->where("ruCode" , $id);
		$update = $this->db->delete('role_user');
		redirect($_SERVER['HTTP_REFERER']);
	}

    public function add(){

		$this->form_validation->set_rules('email', 'email', 'required');
      $data["titlepage"] = "PROYEK ";
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('master/user/add' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->user_model->submitadd();	
            redirect('/Master/user', 'refresh');
		}
	}
    public function delete($d){
        $this->user_model->delete($d);
        redirect('/Master/user', 'refresh');    
    }
}
