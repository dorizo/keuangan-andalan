<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perubahanboq extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('vendor_model');
			$this->load->model('witel_model');
			$this->load->model('akunbankTransaksi_model');
			$this->load->library('zip');
			$this->load->model('log_project_model');
			$this->load->model('job_model');
			$this->load->helper(array('form', 'url','directory'));
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}

    public function final($id){
        
        $data["dataall"]  = $this->db->query("select * from requestboq where requstboq_id=$id")->row();
        
        if($data["dataall"]->status != "approve"){
                $this->db->where("requstboq_id" , $id);
                $this->db->update("requestboq" , array("status" =>"approve"));
                
                $this->db->where("project_id" , $data["dataall"]->project_id);
                $this->db->limit(1);
                $nilaixxxxx = $data["dataall"]->nilaiboqbaru - (($data["dataall"]->nilaiboqbaru *2)/100);
                $this->db->update("project" , array("nilai_boq" => $data["dataall"]->nilaiboqbaru , "nilai_project" => $nilaixxxxx));
                
        
        };

        redirect('/perubahanboq/request/'.$data["dataall"]->project_id, 'refresh');
    }

    public function request($id){
        $data["dataresult"] = $this->project_model->viewSinggle($id);
        $data["dataall"]  = $this->db->query("select * from requestboq where project_id=$id")->result();
        
        $data["titlepage"]  = "Request perubahan BOQ : ".$data["dataresult"]->project_code ;
        

		$this->form_validation->set_rules('project_id', 'project_id', 'required');

        if ($this->form_validation->run() === FALSE)
        {
     
		$this->load->view('template/header' , $data);
		$this->load->view('perubahanboq/request' , $data);
		$this->load->view('template/footer');
		
		}else{
            $p =  $this->input->post();
            $p["nilaiboqbaru"] = str_replace(",", "", $this->input->post("nilaiboqbaru"));
            $this->db->insert("requestboq" , $p);
            
				redirect('/perubahanboq/request/'.$id, 'refresh');
		
		}
    }

}